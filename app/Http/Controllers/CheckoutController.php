<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Basket;
use App\Models\Customer;
use App\Models\ListOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function getCheckout(Request $request)
    {
        $basket = Basket::with(['items.menu', 'items.addons.addon'])->where('user_id', Auth::guard('customer')->id())->first();
        if ($basket->items->count() === 0) {
            return redirect()->route('restaurants.index');
        }
        return view('customer.transaction.checkout', compact('basket'));
    }
    public function processCheckout(Request $request)
    {
        $basket = Basket::with(['items.menu', 'items.addons.addon'])
            ->where('user_id', Auth::guard('customer')->id())
            ->first();

        if (!$basket || $basket->items->isEmpty()) {
            return redirect()->route('customer.dashboard')->with('error', 'Your basket is empty.');
        }

        DB::beginTransaction();

        try {
            $subtotal = 0;
            foreach ($basket->items as $item) {
                $itemTotal = $item->menu->price * $item->quantity;

                foreach ($item->addons as $basketAddon) {
                    $itemTotal += $basketAddon->addon->price;
                }
                $subtotal += $itemTotal;
            }

            $deliveryFee = 10000;
            $tax = $subtotal * 0.10;
            $totalPrice = $subtotal + $tax + $deliveryFee;

            // dd(Customer::find(Auth::guard('customer')->id())->balance < $totalPrice);
            if (Customer::find(Auth::guard('customer')->id())->balance < $totalPrice) {
                DB::rollBack();
                return redirect()->back()->with('error', 'Insufficient balance.');
            } else {
                Customer::where('id', Auth::guard('customer')->id())->update([
                    'balance' => DB::raw('balance - ' . $totalPrice),
                ]);
                $order = Order::create([
                    'customers_id' => Auth::guard('customer')->id(),
                    'restaurants_id' => $basket->restaurant_id,
                    'payment_methods_id' => $request->input('payment_method'),
                    'total_price' => $totalPrice,
                    'order_type' => $request->input('order_type'),
                    'status' => 'preparing',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $listOrdersData = [];
                foreach ($basket->items as $item) {
                    // Siapkan detail dari addons dan catatan
                    $detailNotes = [];
                    if ($item->addons->isNotEmpty()) {
                        $addonNames = $item->addons->map(fn($basketAddon) => '+ ' . $basketAddon->addon->name)->all();
                        $detailNotes[] = "Add-ons: " . implode(', ', $addonNames);
                    }
                    if (!empty($item->note)) {
                        $detailNotes[] = "Note: " . $item->note;
                    }

                    // Hitung subtotal per item untuk disimpan di ListOrder
                    $itemSubtotal = $item->menu->price * $item->quantity;
                    foreach ($item->addons as $basketAddon) {
                        $itemSubtotal += $basketAddon->addon->price;
                    }

                    $listOrdersData[] = [
                        'orders_id' => $order->id,
                        'menus_id' => $item->menu_id,
                        'quantity' => $item->quantity,
                        'subtotal' => $itemSubtotal,
                        'detail' => implode(' | ', $detailNotes),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                ListOrder::insert($listOrdersData);

                DB::commit();

                $basket->delete();

                return redirect()->route('order.process', $order->id)->with('success', 'Your order has been placed successfully!');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while placing your order. Please try again.');
        }
    }

    public function orderSuccess(Order $order)
    {
        if ($order->customers_id !== Auth::guard('customer')->id()) {
            abort(404);
        }

        return view('customer.transaction.success', compact('order'));
    }
    public function showOrderProcessPage(Order $order)
    {
        if ($order->customers_id !== Auth::guard('customer')->id()) {
            abort(403, 'Unauthorized Access');
        }
        $order->load(['listOrders.menu']);

        return view('customer.transaction.process', compact('order'));
    }
    public function getOrderStatus(Order $order)
    {
        if ($order->customers_id !== Auth::guard('customer')->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        return response()->json(['status' => $order->status]);
    }
    public function cancelOrder(Order $order)
    {
        if ($order->customers_id !== Auth::guard('customer')->id()) {
            abort(403, 'Unauthorized Access');
        }

        if ($order->status !== 'preparing') {
            return redirect()->back()->with('error', 'Pesanan sudah tidak dapat dibatalkan.');
        }

        $order->status = 'cancelled';
        $order->save();

        $totalPrice = $order->total_price;

        Customer::where('id', Auth::guard('customer')->id())->update([
            'balance' => DB::raw('balance + ' . $totalPrice),
        ]);

        return redirect()->route('order.process', $order->id)->with('success', 'Pesanan Anda telah berhasil dibatalkan.');
    }
}
