<?php

use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RestaurantController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/customer/register', [CustomerController::class, 'showRegisterForm'])->name('customer.register');
Route::post('/customer/register/create', [CustomerController::class, 'register'])->name('customer.register.create');
Route::get('/restaurant/register', [RestaurantController::class, 'showRegisterForm'])->name('admin.register');
Route::post('/restaurant/register/create', [RestaurantController::class, 'register'])->name('admin.register.create');

Route::middleware('guest')->group(function () {
    Route::get('/', [WelcomeController::class, 'index']);
    Route::get('/customer/login', [LoginController::class, 'showCustomerLoginForm'])->name('customer.login');
    Route::post('/customer/login', [LoginController::class, 'customerLogin'])->name('customer.login');
    Route::get('/restaurant/login', [LoginController::class, 'showAdminLoginForm'])->name('admin.login');
    Route::post('/restaurant/login', [LoginController::class, 'adminLogin'])->name('admin.login');
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ======= CUSTOMER ROUTES ======= //
Route::prefix('customer')->middleware('auth-customer')->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
    // ======= MENU & RESTAURANT DETAIL (UMUM / GUEST) ======= //
    Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
    Route::get('/restaurant/{id}', [RestaurantController::class, 'show'])->name('restaurants.show');
    Route::get('/addons/menu/{id}', [MenuController::class, 'getAddons'])->name('addons.menu');
    Route::get('/basket/{id}', [CustomerController::class, 'getBasketInfo'])->name('customer.basket');
    Route::post('/basket', [CustomerController::class, 'insertDataBasket'])->name('customer.basket.add');
    Route::delete('/basket', [CustomerController::class, 'deleteDataBasket'])->name('customer.basket.delete');
    Route::delete('/basket/item', [CustomerController::class, 'deleteDataBasketItem'])->name('customer.basket.item.delete');
    Route::get('/checkout', [CheckoutController::class, 'getCheckout'])->name('customer.checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/orders', [CustomerController::class, 'orders'])->name('orders.index');
    Route::get('/orders/detail/{id}', [CustomerController::class, 'showOrder'])->name('orders.detail');
    Route::get('/order/process/{order}', [CheckoutController::class, 'index'])->name('order.index');
    Route::get('/order/status/{order}', [CheckoutController::class, 'getOrderStatus'])->name('order.status');
    Route::post('/order/cancel/{order}', [CheckoutController::class, 'cancelOrder'])->name('order.cancel');
});

// ======= RESTAURANT ROUTES ======= //
Route::prefix('restaurant')->middleware('auth-admin')->group(function () {
    Route::get('/dashboard', [RestaurantController::class, 'dashboard'])->name('restaurant.dashboard');
    Route::get('/orders', [RestaurantController::class, 'orders'])->name('restaurant.orders');
    Route::get('/orders/top-order', [RestaurantController::class, 'topOrders'])->name('restaurant.orders.top');
    Route::get('/orders/payment', [RestaurantController::class, 'orderByPayment'])->name('restaurant.orders.payment');
    Route::get('/menu', [RestaurantController::class, 'menuIndex'])->name('restaurant.menus');
    Route::get('/menu/top-menu', [RestaurantController::class, 'topMenu'])->name('restaurant.menus.top');
    Route::get('/menu/create', [RestaurantController::class, 'menuCreate'])->name('restaurant.menus.create');
    Route::post('/menu', [RestaurantController::class, 'menuStore'])->name('restaurant.menus.store');
    Route::get('/menu/{id}/edit', [RestaurantController::class, 'menuEdit'])->name('restaurant.menus.edit');
    Route::put('/menu/{id}', [RestaurantController::class, 'menuUpdate'])->name('restaurant.menus.update');
    Route::delete('/menu/{id}', [RestaurantController::class, 'menuDelete'])->name('restaurant.menus.delete');
    Route::get('/review', [RestaurantController::class, 'getReview'])->name('restaurant.reviews');
    Route::get('/revenue', [RestaurantController::class, 'DailyRevenue'])->name('restaurant.revenue');
    Route::get('/report', [RestaurantController::class, 'showReportPage'])->name('restaurant.report');
    Route::get('/{id}/edit', [RestaurantController::class, 'showEditForm'])->name('restaurant.edit');
    Route::put('/{id}', [RestaurantController::class, 'updateRestaurant'])->name('restaurant.update');
    Route::delete('/{id}', [RestaurantController::class, 'destroy'])->name('restaurant.delete');
});



// ======= ORDER (PEMESANAN MENU) ======= //
Route::post('/order', [OrderController::class, 'store'])->middleware('auth')->name('order.store');


// // PUNYA RAMA
// Route::get('/menus/{id}', function ($id) {
//     return view('customer.menus.index', ['id' => $id]);
// });


Route::post('/menu/{resto_id}/addon/{menu_id}', function (Request $request, $resto_id, $menu_id) {
    // Ambil addons dari checkbox
    $addons = $request->input('addons', []); // default ke array kosong kalau tidak ada

    // Simpan ke session (contoh)
    session()->put("selected_addons.$menu_id", $addons);

    // Simpan status bahwa menu sudah ditambahkan
    $added = session()->get('added_menu_ids', []);
    if (!in_array($menu_id, $added)) {
        session()->push('added_menu_ids', $menu_id);
    }

    // Redirect kembali ke halaman menu
    return redirect("/menus/$resto_id");
})->name('addon.store');

//Hapus session addon
Route::get('/menus/{resto_id}/remove/{menu_id}', function ($resto_id, $menu_id) {
    $added = session()->get('added_menu_ids', []);
    $filtered = array_filter($added, fn($id) => $id != $menu_id);
    session()->put('added_menu_ids', $filtered);
    session()->forget("selected_addons.$menu_id");

    return response()->noContent();
});
