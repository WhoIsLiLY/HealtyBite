<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $orders = [];
        // $orders = Auth::user()->orders;
        // session()->flush();
        return view('customer.dashboard', compact('orders'));
    }

    public function orders()
    {
        $orders = Auth::user()->orders;
        return view('customer.orders.index', compact('orders'));
    }

    public function showOrder($id)
    {
        $order = Auth::user()->orders->findOrFail($id);
        return view('customer.orders.show', compact('order'));
    }
    public function getBasketInfo()
    {
        $selectedMenus = json_decode(request()->cookie('selectedMenus'), true);
        if($selectedMenus == null) $selectedMenus = [];
        return response()->json([
            'basket' => $selectedMenus
        ]);
    }

    public function insertDataBasket(Request $request)
    {
        $menuId = $request->input('menu_id');
        $quantity = $request->input('quantity');
        $addons = $request->input('addons'); // Ini adalah array dari JavaScript
        $note = $request->input('note');

        $menuDetail = Menu::findOrFail($menuId)->toArray();
        $selectedMenu = array_merge($menuDetail, ['quantity' => $quantity, 'addons' => $addons]);
        $selectedOrder = array_merge($selectedMenu, ['note' => $note]);

        $selectedMenus = json_decode(request()->cookie('selectedMenus'), true);
        if($selectedMenus == null) $selectedMenus = [];
        array_push($selectedMenus, $selectedOrder);
        $cookie = cookie('selectedMenus', json_encode($selectedMenus), 60); // 60 menit

        return response()->json([
            'message' => 'Data inserted into basket',
            'menus_received' => $addons,
        ])->cookie($cookie);
    }
}
