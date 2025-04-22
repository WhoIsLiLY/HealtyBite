<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $orders = [];
        // $orders = Auth::user()->orders;
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
}
