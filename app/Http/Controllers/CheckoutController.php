<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Basket;
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
        return view('customer.checkout', compact('basket'));
    }
    public function processCheckout(Request $request)
    {
        // 1. Ambil data keranjang dari database menggunakan model Basket
        // Menggunakan guard 'customer' sesuai koreksi Anda
        $basket = Basket::with(['items.menu', 'items.addons.addon'])
            ->where('user_id', Auth::guard('customer')->id())
            ->first();

        // Pastikan keranjang ada dan tidak kosong
        if (!$basket || $basket->items->isEmpty()) {
            return redirect()->route('home')->with('error', 'Your basket is empty.');
        }

        // Gunakan Database Transaction
        DB::beginTransaction();

        try {
            // 2. Hitung ulang total di sisi server untuk keamanan
            $subtotal = 0;
            // Akses data menggunakan properti objek, bukan array
            foreach ($basket->items as $item) {
                // Kalkulasi total per item (harga menu * kuantitas)
                $itemTotal = $item->menu->price * $item->quantity;

                // Tambahkan harga addons jika ada
                foreach ($item->addons as $basketAddon) {
                    $itemTotal += $basketAddon->addon->price;
                }
                $subtotal += $itemTotal;
            }

            $deliveryFee = 10000; // Hardcode atau ambil dari konfigurasi
            $tax = $subtotal * 0.10; // Pajak 10%
            $totalPrice = $subtotal + $tax + $deliveryFee;

            // 3. Buat record Order baru
            $order = Order::create([
                'customers_id' => Auth::guard('customer')->id(), // Gunakan guard yang benar
                'restaurants_id' => $basket->restaurant_id, // Ambil langsung dari basket
                'payment_methods_id' => '1', // TODO: Ganti dengan ID metode pembayaran dari request
                'total_price' => $totalPrice,
                'order_type' => 'dine-in', // Asumsi berdasarkan konteks delivery
                'status' => 'preparing',
                'created_at' => now(), // Tambahkan timestamp
                'updated_at' => now(), // Tambahkan timestamp
            ]);

            // 4. Buat record ListOrder untuk setiap item di keranjang
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
                    'created_at' => now(), // Tambahkan timestamp
                    'updated_at' => now(), // Tambahkan timestamp
                ];
            }
            // Masukkan semua list order sekaligus untuk efisiensi
            ListOrder::insert($listOrdersData);

            // Jika semua berhasil, commit transaksi
            DB::commit();

            // 5. HAPUS keranjang dari database setelah order berhasil dibuat
            // Asumsi relasi di model BasketItem di-set 'onDelete(cascade)'
            $basket->delete();

            // 6. Redirect ke halaman sukses
            // Anda perlu membuat route dan view untuk 'order.success'
            return redirect()->route('customer.dashboard', $order->id)->with('success', 'Your order has been placed successfully!');
        } catch (\Exception $e) {
            // Jika terjadi error, batalkan semua query
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while placing your order. Please try again.');
        }
    }

    // Anda perlu membuat metode untuk halaman sukses
    public function orderSuccess(Order $order)
    {
        // Pastikan order ini milik user yang sedang login
        if ($order->customers_id !== Auth::guard('customer')->id()) {
            abort(404);
        }

        // Tampilkan view konfirmasi pesanan
        return view('order.success', compact('order'));
    }
}
