<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use App\Models\Review;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class RestaurantController extends Controller
{
    public function dashboard()
    {
        $restaurant = Auth::user()->restaurant;
        return view('restaurant.dashboard', compact('restaurant'));
    }

    public function orders()
    {
        $orders = Auth::user()->restaurant->orders;
        return view('restaurant.orders.index', compact('orders'));
    }


    public function topOrders()
    {
        $orders =  $orders = Auth::user()->restaurant->orders()
        ->orderByDesc('total_price')
        ->take(5)
        ->with('customer') 
        ->get();;
        return view('restaurant.orders.index', compact('orders'));
    }

    public function orderByPayment()
    {
        $ordersByPaymentMethod = Order::select('payment_method', DB::raw('COUNT(id) as order_count'))
            ->where('restaurant_id', Auth::user()->restaurant->id)
            ->groupBy('payment_method')
            ->get();
    }

    public function menuIndex()
    {
        $menus = Auth::user()->restaurant->menus;
        return view('restaurant.menu.index', compact('menus'));
    }

    public function menuCreate()
    {
        return view('restaurant.menu.create');
    }

    public function menuStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'nullable',
        ]);

        Auth::user()->restaurant->menus()->create($request->all());

        return redirect()->route('restaurant.menu')->with('success', 'Menu added.');
    }

    public function menuEdit($id)
    {
        $menu = Auth::user()->restaurant->menus()->findOrFail($id);
        return view('restaurant.menu.edit', compact('menu'));
    }

    public function menuUpdate(Request $request, $id)
    {
        $menu = Auth::user()->restaurant->menus()->findOrFail($id);
        $menu->update($request->all());

        return redirect()->route('restaurant.menu')->with('success', 'Menu updated.');
    }

    public function menuDelete($id)
    {
        $menu = Auth::user()->restaurant->menus()->findOrFail($id);
        $menu->delete();

        return redirect()->route('restaurant.menu')->with('success', 'Menu deleted.');
    }

    public function topMenu(){
        $restaurant = Auth::user()->restaurant; 
        $topMenus = $restaurant->menus() 
            ->withCount(['listOfOrders as order_count' => function ($query) {
                $query->join('orders', 'orders.id', '=', 'list_of_orders.orders_id');
            }])
            ->orderBy('order_count', 'desc')
            ->limit(5)
            ->get(['name', 'order_count']);
    }

    public function getReview()
    {
        $review = Auth::user()->restaurant->reviews();
    }

    public function DailyRevenue()
    {
        $dailyRevenue = Order::selectRaw('DATE(time) as date, SUM(total_price) as total_revenue')
        ->where('restaurant_id', Auth::user()->restaurant->id)
        ->groupByRaw('DATE(time)')
        ->orderBy('date', 'desc')
        ->get();
    }

    public function index()
    {
        $restaurants = Restaurant::all();
        return view('restaurants.index', compact('restaurants'));
    }

    public function show($id)
    {
        $restaurant = Restaurant::with('menus')->findOrFail($id);
        return view('restaurants.show', compact('restaurant'));
    }
}
