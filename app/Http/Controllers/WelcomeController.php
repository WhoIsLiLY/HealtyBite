<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class WelcomeController extends Controller
{
    function index(){
        $menus = Menu::query()
            ->with('restaurant')
            ->withCount(['listOrders as sales_count' => function ($query) {
                $query->whereHas('order', function($q) {
                    $q->where('status', 'completed');
                });
            }])
            ->orderByDesc('sales_count')
            ->take(4)
            ->get();
        
        return view('welcome', compact('menus'));
    }
}
