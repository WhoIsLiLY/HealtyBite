<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Addon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    function getAddons(Request $request, $id)
    {
        $menu = Menu::with('addons')->findOrFail($id);
        $addons = $menu->addons;
        return response()->json([
            'menu' => $menu,
            'addons' => $addons,
        ]);
    }
}
