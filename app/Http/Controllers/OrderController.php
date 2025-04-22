<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $menu = Menu::findOrFail($request->menu_id);

        $order = Order::create([
            'user_id' => Auth::id(),
            'restaurant_id' => $menu->restaurant_id,
            'menu_id' => $menu->id,
            'quantity' => $request->quantity,
            'total_price' => $menu->price * $request->quantity,
        ]);

        return redirect()->route('customer.orders')->with('success', 'Order placed.');
    }
}
