<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function getCheckout(Request $request)
    {
        $basket = Basket::with(['items.menu', 'items.addons.addon'])->where('user_id', Auth::guard('customer')->id())->first(); 
        if ($basket == null) {
            return redirect()->route('restaurants.index');
        }
        return view('customer.checkout', compact('basket'));
    }
}
