<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Basket;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Traits\ToStringFormat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $customer = Customer::where('id', Auth::guard('customer')->id())->first();
        
        $recommendedMenus = Menu::with('restaurant')
            ->withCount(['listOrders as sales_count' => function ($query) {
                
                $query->whereHas('order', function($q){
                    $q->where('status', 'completed');
                });
            }])
            ->orderBy('sales_count', 'desc') 
            ->take(4) 
            ->get();
    
        $activeOrder = Order::where('customers_id', Auth::guard('customer')->id())
            ->whereIn('status', ['preparing', 'ready'])
            ->latest()
            ->first();

        $customer = Customer::where('id', Auth::guard('customer')->id())->first();
        return view('customer.dashboard', compact('activeOrder', 'customer', 'recommendedMenus'));
    }

    public function orders()
    {
        $orders = Order::select('orders.*', 'restaurants.name as restaurant_name')
            ->join('restaurants', 'orders.restaurants_id', '=', 'restaurants.id')
            ->where('orders.customers_id', Auth::guard('customer')->id())
            ->orderBy('orders.created_at', 'desc')
            ->get();
            // dd($orders);
        return view('customer.orders.index', compact('orders'));
    }

    public function showOrder($id)
    {
        $order = Order::with('listOrders.menu')->where('id', $id)->firstOrFail();
        return view('partials.order_detail', compact('order'));
    }
    public function showRegisterForm()
    {
        return view('customer.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|string',
            // 'balance' => 'required|numeric',
            // 'point' => 'required|numeric',
            'phone_number' => 'required|string|max:20',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'balance' => 0,
            'point' => 0,
            'card_number' => "",
            'password' => Hash::make($request->password),
            'created_at' => now(),
        ]);

        if ($customer) {
            return redirect()->route('customer.dashboard')->with('success', 'Registrasi berhasil, silahkan login');
        }

        return redirect()->back()->with('error', 'Registrasi gagal, Silahkan coba lagi')->withInput();
    }
    public function getBasketInfo($restaurant_id)
    {
        $basket = Basket::with(['items.menu', 'items.addons.addon'])->where('user_id', Auth::guard('customer')->id())
            ->where('restaurant_id', $restaurant_id)->first();
        return response()->json([
            'basket' => $basket
        ]);
    }

    public function insertDataBasket(Request $request)
    {
        $restaurantId = $request->input('restaurant_id');
        $menuId = $request->input('menu_id');
        $quantity = $request->input('quantity');
        $addons = $request->input('addons'); // Ini adalah array dari JavaScript
        if ($addons == null) $addons = [];
        $note = $request->input('note');

        // Tambah item ke basket
        $basket = Basket::firstOrCreate([
            'user_id' => Auth::guard('customer')->id(),
            'restaurant_id' => $restaurantId
        ]);

        // Tambah item ke basket
        $item = $basket->items()->create([
            'menu_id' => $menuId,
            'quantity' => $quantity,
            'note' => $note
        ]);

        // Tambah addons
        foreach ($addons as $addon) {
            $item->addons()->create([
                'addon_id' => $addon['id'],
            ]);
        }


        // $menuDetail = Menu::findOrFail($menuId)->toArray();
        // $selectedMenu = array_merge($menuDetail, ['quantity' => $quantity, 'addons' => $addons]);
        // $selectedOrder = array_merge($selectedMenu, ['note' => $note]);

        // $selectedMenus = json_decode(request()->cookie('selectedMenus'), true);
        // if ($selectedMenus == null) $selectedMenus = [];
        // array_push($selectedMenus, $selectedOrder);
        // $cookie = cookie('selectedMenus', json_encode($selectedMenus), 60); // 60 menit

        return response()->json([
            'message' => 'Data inserted into basket',
            'menus_received' => $addons,
        ]);
    }
    public function deleteDataBasket()
    {
        $userId = Auth::guard('customer')->id();

        // echo $currentRestaurantId . "<br>" . $userId;
        $baskets = Basket::where('user_id', $userId)
            ->with('items.addons')
            ->get();

        foreach ($baskets as $basket) {
            foreach ($basket->items as $item) {
                $item->addons()->delete();
            }
            $basket->items()->delete();
            $basket->delete();
        }

        return response()->json(['message' => 'Semua basket berhasil dihapus']);
    }
    public function deleteDataBasketItem(Request $request)
    {
        $userId = Auth::guard('customer')->id();
        $menuId = $request->input('menu_id');
        // echo $currentRestaurantId . "<br>" . $userId;
        $baskets = Basket::where('user_id', $userId)
            ->with('items.addons')
            ->get();

        foreach ($baskets as $basket) {
            foreach ($basket->items as $item) {
                if ($item->id == $menuId) {
                    $item->addons()->delete();
                    $item->delete();
                    return response()->json(['message' => 'Item berhasil dihapus'], 200);
                }
            }
        }

        return response()->json(['message' => 'Item gagal dihapus. menuId: ' . $menuId], 500);
    }
}
