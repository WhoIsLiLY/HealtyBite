<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
