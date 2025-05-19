<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\FoodTag;
use App\Models\Addon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('customer.restaurants.index', compact('restaurants'));
    }

    public function show($id)
    {
        $restaurant = Restaurant::with('menus')->findOrFail($id);
        return view('customer.menus.index', compact('restaurant'));
    }
    public function dashboard()
    {
        // $restaurant = [];
        $restaurant = Auth::guard('admin')->user();
        $dailyRevenue = $this->DailyRevenue();
        $menus = $restaurant->menus;

        return view('restaurant.dashboard', compact('restaurant', 'dailyRevenue', 'menus'));
    }

    public function orders()
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

        return view('restaurant.orders.index', compact('orders'));
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
            $path = $request->file('gambar')->storeAs('menus', $filename, 'public');

            // Update kolom gambar di menu dengan path file
            $menu->update(['menu_image' => $path]);
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

        // dd($request->addons_name, $request->addons_price, $request->addons_type, $request->addons_available);
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
        // $menu = Auth::user()->restaurant->menus()->findOrFail($id);
        return view('restaurant.menus.edit', compact('menus'));
    }

    public function menuUpdate(Request $request, $id)
    {
        $menu = Auth::user()->restaurant->menus()->findOrFail($id);
        $menu->update($request->all());

        return redirect()->route('restaurant.menus')->with('success', 'Menu updated.');
    }

    public function menuDelete($id)
    {
        $menu = Auth::user()->restaurant->menus()->findOrFail($id);
        $menu->delete();

        return redirect()->route('restaurant.menus')->with('success', 'Menu deleted.');
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
}
