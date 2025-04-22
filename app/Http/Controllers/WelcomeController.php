<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    function index(){
        $menus = [
            ['title' => 'Avocado Chicken Salad', 'desc' => 'Ayam panggang, alpukat, dan sayur organik.', 'img' => 'salad'],
            ['title' => 'Berry Smoothie', 'desc' => 'Buah beri segar tanpa gula tambahan.', 'img' => 'smoothie'],
            ['title' => 'Salmon Rice Bowl', 'desc' => 'Salmon panggang, nasi merah & sayuran kukus.', 'img' => 'bowl']
        ];
        return view('welcome', compact('menus'));
    }
}
