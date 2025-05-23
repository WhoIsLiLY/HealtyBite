<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Basket;
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
    public function getBasketInfo($restaurant_id)
    {
        $basket = Basket::with(['items.menu', 'items.addons.addon'])->where('user_id', Auth::guard('customer')->id())
            ->where('restaurant_id', $restaurant_id)->first();
        // dd($basket);
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
                if ($item->menu_id == $menuId) {
                    $item->addons()->delete();
                    $item->delete();
                    return response()->json(['message' => 'Item berhasil dihapus'], 200);
                }
            }
        }

        return response()->json(['message' => 'Item gagal dihapus'], 500);
    }

}
