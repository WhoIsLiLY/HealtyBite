<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Addon;
use App\Models\Order;
use App\Models\Basket;
use App\Models\FoodTag;
use App\Models\Restaurant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\RestaurantCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\FacadesStorage;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::with(['reviews', 'category'])->get();
        $restaurants = $restaurants->map(function ($restaurant) {
            $restaurant->rating = $restaurant->reviews->avg('rating') ?? 0;
            $restaurant->review_count = $restaurant->reviews->count();
            return $restaurant;
        });
        $basket = Basket::where('user_id', Auth::guard('customer')->id())->first();
        // dd($restaurants);
        return view('customer.restaurants.index', compact('restaurants', 'basket'));
    }

    public function show($id)
    {
        $restaurant = Restaurant::with('menus')->findOrFail($id);
        $basket = Basket::with(['items.menu', 'items.addons.addon'])->where('user_id', Auth::guard('customer')->id())->first();
        if ($basket != null && $basket->restaurant_id != $id) {
            $controller = new CustomerController();
            $controller->deleteDataBasket();
        }
        // return response()->json($basket);
        return view('customer.menus.index', compact('restaurant'));
    }

    public function dashboard()
    {
        $restaurant = Auth::guard('admin')->user();
        $dailyRevenue = $this->DailyRevenue();
        $menus = $restaurant->menus;

        $orders = Order::where('restaurants_id', $restaurant->id)
            ->where('status', 'completed')
            ->with(['customer', 'listOrders.menu']) // eager load for better performance
            ->latest()
            ->get();

        return view('restaurant.dashboard', compact('restaurant', 'dailyRevenue', 'menus', 'orders'));
    }

    public function orders(Request $request)
    {
        // $orders = Auth::guard('admin')->user()->orders;
        // return view('restaurant.orders.index', compact('orders'));

        $restaurant = Auth::guard('admin')->user();

        // $orders = Order::with(['listOrders.menu', 'customer'])
        //     ->where('restaurants_id', $restaurant->id)
        //     ->latest()
        //     ->get();

        // return view('restaurant.orders.index', compact('orders'));

        $orders = Order::with(['customer', 'listOrders.menu'])
            ->where('restaurants_id', Auth::guard('admin')->id())
            ->get()
            ->groupBy('status');

        $perPage = $request->per_page ?? 10;

        $query = Order::with(['customer', 'listOrders.menu'])
            ->where('restaurants_id', Auth::guard('admin')->id())
            ->latest(); 

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                ->orWhereHas('customer', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            });
        }

        $allOrders = $query->paginate($perPage);
        
        return view('restaurant.orders.index', compact('allOrders','orders'));
    }

    public function topOrders()
    {
        $orders = Auth::guard('admin')->user()->orders()
            ->orderBy('total_price', 'desc')
            ->take(5)
            ->with('customer')
            ->get();

        foreach ($orders as $order) {
            echo "Order ID: " . $order->id . "<br>";
            echo "Customer Name: " . $order->customer->name . "<br>";
            echo "Total Price: Rp" . number_format($order->total_price, 0, ',', '.') . "<br>";
            echo "Order Type: " . $order->order_type . "<br>";
            echo "Status: " . $order->status . "<br>";
            echo "<hr>";
        }
    }

    public function orderByPayment()
    {
        $ordersByPaymentMethod = DB::table('orders')
            ->join('payment_methods', 'orders.payment_methods_id', '=', 'payment_methods.id')
            ->select('payment_methods.name as payment_method_name', DB::raw('COUNT(orders.id) as order_count'))
            ->where('orders.restaurants_id', Auth::guard('admin')->id())
            ->groupBy('payment_methods.name')
            ->get();

        foreach ($ordersByPaymentMethod as $order) {
            echo "Payment Method: " . $order->payment_method_name . "<br>";
            echo "Order Count: " . $order->order_count . "<br><br>";
        }
    }

    public function menuIndex()
    {
        $menus = Auth::guard('admin')->user()->menus;
        return view('restaurant.menus.index', compact('menus'));
    }

    public function menuCreate()
    {
        return view('restaurant.menus.create');
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        return back()->with('success', 'Status berhasil diubah.');
    }

    public function menuStore(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string',
            'kalori' => 'required|integer',
            'nutrition_facts' => 'required|string',
            'tersedia' => 'required|boolean',
            'gambar' => 'nullable|image|max:2048', // max 2MB
            // Tags validation (arrays)
            'tags_name' => 'nullable|array',
            'tags_name.*' => 'required_with:tags_description|string|max:255',
            'tags_description' => 'nullable|array',
            'tags_description.*' => 'required_with:tags_name|string|max:500',
            // Addons validation (arrays)
            'addons_name' => 'nullable|array',
            'addons_name.*' => 'required_with_all:addons_price,addons_type,addons_available|string|max:255',
            'addons_price' => 'nullable|array',
            'addons_price.*' => 'required_with_all:addons_name,addons_type,addons_available|numeric|min:0',
            'addons_type' => 'nullable|array',
            'addons_type.*' => 'required_with_all:addons_name,addons_price,addons_available|in:extra,topping',
            'addons_available' => 'nullable|array',
            'addons_available.*' => 'required_with_all:addons_name,addons_price,addons_type|boolean',
        ]);

        $restaurant = Auth::guard('admin')->user();

        // Buat menu baru
        $menu = $restaurant->menus()->create([
            'name' => $request->nama,
            'price' => $request->harga,
            'description' => $request->deskripsi,
            'calorie' => $request->kalori,
            'nutrition_facts' => $request->nutrition_facts,
            'isAvailable' => $request->tersedia,
        ]);

        if ($request->hasFile('gambar')) {
            // Buat nama file berdasarkan id menu + ekstensi file asli
            $extension = $request->file('gambar')->getClientOriginalExtension();
            $filename = 'menu_' . $menu->id . '.' . $extension;

            // Simpan gambar ke folder public/menus dengan nama baru
            $request->file('gambar')->storeAs('public/assets/img/menus', $filename);

            // Update kolom gambar di menu dengan path file
            $menu->update(['menu_image' => $filename]);
        }
        // Simpan tags (jika ada)
        if ($request->filled('tags_name') && $request->filled('tags_description')) {
            foreach ($request->tags_name as $index => $tagName) {
                $tagDesc = $request->tags_description[$index] ?? '';

                $tag = FoodTag::where('name', $tagName)
                    ->where('description', $tagDesc)
                    ->first();

                if (!$tag) {
                    $tag = FoodTag::create([
                        'name' => $tagName,
                        'description' => $tagDesc,
                    ]);
                }

                $menu->foodTags()->syncWithoutDetaching($tag->id);
            }
        }

        // Simpan addons (jika ada)
        if ($request->filled('addons_name') && $request->filled('addons_price') && $request->filled('addons_type') && $request->filled('addons_available')) {
            foreach ($request->addons_name as $index => $addonName) {
                $menu->addons()->create([
                    'name' => $addonName,
                    'price' => $request->addons_price[$index] ?? 0,
                    'type' => $request->addons_type[$index] ?? 'extra',
                    'isAvailable' => $request->addons_available[$index] ?? true,
                ]);
            }
        }

        return redirect()->route('restaurant.menus')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function menuEdit($id)
    {
        $menus = Auth::guard('admin')->user()->menus()->findOrFail($id);
        return view('restaurant.menus.edit', compact('menus'));
    }

    public function menuUpdate(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string',
            'kalori' => 'required|integer',
            'nutrition_facts' => 'required|string',
            'tersedia' => 'required|boolean',
            'gambar' => 'nullable|image|max:2048', // max 2MB
            // Tags validation (arrays)
            'tags_name' => 'nullable|array',
            'tags_name.*' => 'required_with:tags_description|string|max:255',
            'tags_description' => 'nullable|array',
            'tags_description.*' => 'required_with:tags_name|string|max:500',
            // Addons validation (arrays)
            'addons_name' => 'nullable|array',
            'addons_name.*' => 'required_with_all:addons_price,addons_type,addons_available|string|max:255',
            'addons_price' => 'nullable|array',
            'addons_price.*' => 'required_with_all:addons_name,addons_type,addons_available|numeric|min:0',
            'addons_type' => 'nullable|array',
            'addons_type.*' => 'required_with_all:addons_name,addons_price,addons_available|in:extra,topping',
            'addons_available' => 'nullable|array',
            'addons_available.*' => 'required_with_all:addons_name,addons_price,addons_type|boolean',
        ]);

        $menus = Auth::guard('admin')->user()->menus()->findOrFail($id);
        $menus->update([
            'name' => $request->nama,
            'price' => $request->harga,
            'description' => $request->deskripsi,
            'calorie' => $request->kalori,
            'nutrition_facts' => $request->nutrition_facts,
            'isAvailable' => $request->tersedia,
        ]);

        // Ambil tag-tag lama yang terhubung ke menu
        $existingTags = $menus->foodTags()->get(); // Kumpulan tag yang sudah ada
        $updatedTagIds = []; // Untuk menyimpan ID tag yang akan tetap terhubung

        // Loop semua inputan tag dari form
        if ($request->filled('tags_name') && $request->filled('tags_description')) {
            foreach ($request->tags_name as $index => $tagName) {
                $tagDesc = $request->tags_description[$index] ?? '';

                // Cari tag berdasarkan name & description
                $tag = FoodTag::where('name', $tagName)
                    ->where('description', $tagDesc)
                    ->first();

                // Jika tidak ada, buat tag baru
                if (!$tag) {
                    $tag = FoodTag::create([
                        'name' => $tagName,
                        'description' => $tagDesc,
                    ]);
                }

                // Tambahkan ke daftar tag yang harus tetap terhubung
                $updatedTagIds[] = $tag->id;
            }

            // Sinkronisasi tag yang aktif saja, yang lainnya akan ter-detach otomatis
            $menus->foodTags()->sync($updatedTagIds);
        } else {
            // Jika tidak ada input tag sama sekali, detach semua
            $menus->foodTags()->detach();
        }

        // Ambil semua ID addon lama yang terhubung dengan menu
        $existingAddons = $menus->addons()->get();
        $existingAddonIds = $existingAddons->pluck('id')->toArray();

        // Untuk menyimpan ID yang akan tetap ada (update atau tetap)
        $processedIds = [];

        // Proses inputan addon jika ada
        if ($request->filled('addons_name')) {
            foreach ($request->addons_name as $index => $addonName) {
                $addonPrice = $request->addons_price[$index] ?? 0;
                $addonType = $request->addons_type[$index] ?? 'extra';
                $addonAvailable = $request->input("addons_available.$index", 1);
                $addonId = $request->addons_id[$index] ?? null; // hanya ada kalau addon lama

                if ($addonId && in_array($addonId, $existingAddonIds)) {
                    // Update existing addon
                    $addon = Addon::find($addonId);
                    if ($addon) {
                        $addon->update([
                            'name' => $addonName,
                            'price' => $addonPrice,
                            'type' => $addonType,
                            'isAvailable' => $addonAvailable,
                        ]);
                        $processedIds[] = $addon->id;
                    }
                } else {
                    // Tambahkan addon baru
                    $newAddon = $menus->addons()->create([
                        'name' => $addonName,
                        'price' => $addonPrice,
                        'type' => $addonType,
                        'isAvailable' => $addonAvailable,
                    ]);
                    $processedIds[] = $newAddon->id;
                }
            }

            // Hapus semua addon yang tidak termasuk dalam request (berarti dihapus)
            $menus->addons()->whereNotIn('id', $processedIds)->delete();
        } else {
            // Jika input kosong, hapus semua addon
            $menus->addons()->delete();
        }

        if ($request->hasFile('gambar')) {
            // Gambar
            if ($menus->menu_image && Storage::disk('public')->exists('assets/img/menus/' . $menus->menu_image)) {
                Storage::disk('public')->delete('assets/img/menus/' . $menus->menu_image);
            }

            // Buat nama file berdasarkan ID menu + ekstensi file asli
            $extension = $request->file('gambar')->getClientOriginalExtension();
            $filename = 'menu_' . $menus->id . '.' . $extension;

            // Simpan gambar ke folder storage/app/public/assets/img/menus dengan nama baru
            $request->file('gambar')->storeAs('public/assets/img/menus', $filename);

            // Update kolom menu_image di database
            $menus->update(['menu_image' => $filename]);
        }

        return redirect()->route('restaurant.menus')->with('success', 'Menu berhasil diubah.');
    }

    public function menuDelete($id)
    {
        $menu = Auth::guard('admin')->user()->menus()->findOrFail($id);
        $hasAddons = $menu->addons()->exists();
        $hasTags = $menu->foodTags()->exists();

        // Hapus relasi jika ada
        if ($hasAddons) {
            $menu->addons()->delete();
        }

        if ($hasTags) {
            $menu->foodTags()->detach();
        }

        $menu->delete();

        // Tentukan pesan sesuai kondisi
        if ($hasAddons && $hasTags) {
            $message = 'Menu berhasil dihapus beserta addons dan tags-nya.';
        } elseif ($hasAddons) {
            $message = 'Menu berhasil dihapus beserta addons-nya.';
        } elseif ($hasTags) {
            $message = 'Menu berhasil dihapus beserta tags-nya.';
        } else {
            $message = 'Menu berhasil dihapus.';
        }

        return redirect()->route('restaurant.menus')->with('success', $message);
    }

    public function topMenu()
    {
        $topMenus = Menu::where('restaurants_id', Auth::guard('admin')->user()->id)
            ->withCount('listOrders')
            ->orderByDesc('list_orders_count')
            ->take(5)
            ->get();

        foreach ($topMenus as $menu) {
            echo "Menu Name: " . $menu->name . "<br>";
            echo "Order Count: " . $menu->list_orders_count . "<br><br>";
        }
    }

    public function getReview()
    {
        $review = Auth::guard('admin')->user()->reviews;
        echo "<h3>Reviews</h3>";
        foreach ($review as $r) {
            echo "Title: " . $r->title . "<br>";
            echo "Review: " . $r->comment . "<br>";
            echo "Rating: " . $r->rating . "<br><br>";
        }
    }

    public function DailyRevenue()
    {
        $dailyRevenue = Order::selectRaw('DATE(created_at) as date, SUM(total_price) as total_revenue')
            ->where('restaurants_id', Auth::guard('admin')->user()->id)
            ->groupByRaw('DATE(created_at)')
            ->orderBy('date', 'desc')
            ->get();

        $html = "";

        foreach ($dailyRevenue as $revenue) {
            $html .= $revenue->date . " ";
            $html .= $revenue->total_revenue;
        }
        return $html;
    }

    public function showRegisterForm()
    {
        return view('admin.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'restaurant_category' => 'required|string|max:255',
            'email' => 'required|email|unique:restaurants,email',
            'phone_number' => 'required|string|max:20',
            'password' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $category = RestaurantCategory::firstOrCreate([
            'name' => $request->restaurant_category,
        ]);

        $restaurant = Restaurant::create([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'restaurant_categories_id' => $category->id,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
        ]);

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = 'restaurant_' . $restaurant->id . '.' . $extension;

            // Store the image in storage/app/public/assets/img/restaurants/
            $request->file('image')->storeAs('public/assets/img/restaurants', $filename);

            $restaurant->update(['restaurant_image' => $filename]);

        }

        if ($restaurant) {
            return redirect()->route('admin.login')->with('success', 'Registrasi berhasil, silahkan login');
        }

        return redirect()->back()->with('error', 'Registrasi gagal, Silahkan coba lagi')->withInput();
    }

    public function showEditForm($id)
    {
        $restaurant = Restaurant::with('category')->findOrFail($id);
        return view('restaurant.edit', compact('restaurant'));
    }

    public function showReportPage()
    {
        $restaurantId = Auth::guard('admin')->id();

        // 1. Total Omzet (dari pesanan yang sudah selesai)
        $totalOmzet = Order::where('restaurants_id', $restaurantId)
                           ->where('status', 'completed')
                           ->sum('total_price');

        // 2. Transaksi Terbanyak (jumlah pesanan yang selesai)
        $totalTransaksi = Order::where('restaurants_id', $restaurantId)
                               ->where('status', 'completed')
                               ->count();

        // 3. Member Teraktif (berdasarkan jumlah order)
        $memberTeraktif = Order::where('restaurants_id', $restaurantId)
            ->select('customers_id', DB::raw('count(id) as total_orders'))
            ->groupBy('customers_id')
            ->orderBy('total_orders', 'desc')
            ->with('customer') // Eager load data customer
            ->take(5) // Ambil 5 teratas
            ->get();

        // 4. Member Terbanyak Membeli (berdasarkan total belanja)
        $memberTopSpender = Order::where('restaurants_id', $restaurantId)
            ->where('status', 'completed')
            ->select('customers_id', DB::raw('sum(total_price) as total_spent'))
            ->groupBy('customers_id')
            ->orderBy('total_spent', 'desc')
            ->with('customer')
            ->take(5) // Ambil 5 teratas
            ->get();

        // 5. Produk Terlaris
        $produkTerlaris = Menu::where('restaurants_id', $restaurantId)
            ->withCount(['listOrders as sales_count' => function ($query) {
                $query->whereHas('order', function($q){
                    $q->where('status', 'completed');
                });
            }])
            ->orderBy('sales_count', 'desc')
            ->take(5)
            ->get();

        // 6. Produk yang Perlu Diendorse (Paling sedikit terjual)
        $produkPerluEndorse = Menu::where('restaurants_id', $restaurantId)
            ->withCount(['listOrders as sales_count' => function ($query) {
                $query->whereHas('order', function($q){
                    $q->where('status', 'completed');
                });
            }])
            ->orderBy('sales_count', 'asc')
            ->take(5)
            ->get();

        return view('restaurant.report', compact(
            'totalOmzet',
            'totalTransaksi',
            'memberTeraktif',
            'memberTopSpender',
            'produkTerlaris',
            'produkPerluEndorse'
        ));
    }

    public function updateRestaurant(Request $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'restaurant_category' => 'required|string|max:255',
            'email' => 'required|email|unique:restaurants,email,' . $restaurant->id,
            'phone_number' => 'required|string|max:20',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $category = RestaurantCategory::firstOrCreate([
            'name' => $request->restaurant_category,
        ]);

        $restaurant->update([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'restaurant_categories_id' => $category->id,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ]);

        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = 'restaurant_' . $restaurant->id . '.' . $extension;

            $request->file('image')->storeAs('public/assets/img/restaurants', $filename);
            $restaurant->update(['restaurant_image' => $filename]);
        }

        return redirect()->route('restaurant.dashboard', $restaurant->id)
            ->with('success', 'Profil restoran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Find the restaurant by ID or fail with 404
        $restaurant = Restaurant::findOrFail($id);

        // Optional: delete the restaurant image file from storage if exists
        if ($restaurant->image && Storage::disk('public')->exists($restaurant->image)) {
            Storage::disk('public')->delete($restaurant->image);
        }

        // Delete the restaurant record from DB
        $restaurant->delete();

        // Redirect back with success message
        return redirect()->route('restaurant.dashboard')->with('success', 'Restoran berhasil dihapus.');
    }
}
