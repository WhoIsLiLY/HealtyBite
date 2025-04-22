<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CustomerController;
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

Route::middleware('guest')->group(function(){
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
    Route::get('/orders', [CustomerController::class, 'orders'])->name('customer.orders');
    Route::get('/order/{id}', [CustomerController::class, 'showOrder'])->name('customer.order.show');
});

// ======= RESTAURANT ROUTES ======= //
Route::prefix('restaurant')->middleware('auth-admin')->group(function () {
    Route::get('/dashboard', [RestaurantController::class, 'dashboard'])->name('restaurant.dashboard');
    Route::get('/orders', [RestaurantController::class, 'orders'])->name('restaurant.orders');
    Route::get('/orders/top-order', [RestaurantController::class, 'topOrders'])->name('restaurant.orders.top');
    Route::get('/orders/payment', [RestaurantController::class, 'orderByPayment'])->name('restaurant.orders.payment');
    Route::get('/menu', [RestaurantController::class, 'menuIndex'])->name('restaurant.menu');
    Route::get('/menu/top-menu', [RestaurantController::class, 'topMenu'])->name('restaurant.menu.top');
    Route::get('/menu/create', [RestaurantController::class, 'menuCreate'])->name('restaurant.menu.create');
    Route::post('/menu', [RestaurantController::class, 'menuStore'])->name('restaurant.menu.store');
    Route::get('/menu/{id}/edit', [RestaurantController::class, 'menuEdit'])->name('restaurant.menu.edit');
    Route::put('/menu/{id}', [RestaurantController::class, 'menuUpdate'])->name('restaurant.menu.update');
    Route::delete('/menu/{id}', [RestaurantController::class, 'menuDelete'])->name('restaurant.menu.delete');
    Route::get('review', [RestaurantController::class, 'getReview'])->name('restaurant.reviews');
    Route::get('revenue', [RestaurantController::class, 'DailyRevenue'])->name('restaurant.revenue');
});

// ======= MENU & RESTAURANT DETAIL (UMUM / GUEST) ======= //
Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
Route::get('/restaurant/{id}', [RestaurantController::class, 'show'])->name('restaurants.show');

// ======= ORDER (PEMESANAN MENU) ======= //
Route::post('/order', [OrderController::class, 'store'])->middleware('auth')->name('order.store');
