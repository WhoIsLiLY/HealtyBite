<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\OrderController;
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

Route::get('/test', function () {
    return view('customer.dashboard');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [App\Http\Controllers\LoginController::class, 'login']);

Route::get('/dashboard', function () {
    if (auth()->user()->is_restaurant) {
        return redirect()->route('restaurant.dashboard');
    }
    return redirect()->route('customer.dashboard');
});

// ======= CUSTOMER ROUTES ======= //
Route::prefix('customer')->middleware('auth')->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
    Route::get('/orders', [CustomerController::class, 'orders'])->name('customer.orders');
    Route::get('/order/{id}', [CustomerController::class, 'showOrder'])->name('customer.order.show');
});

// ======= RESTAURANT ROUTES ======= //
Route::prefix('restaurant')->middleware('auth')->group(function () {
    Route::get('/dashboard', [RestaurantController::class, 'dashboard'])->name('restaurant.dashboard');
    Route::get('/orders', [RestaurantController::class, 'orders'])->name('restaurant.orders');
    Route::get('/menu', [RestaurantController::class, 'menuIndex'])->name('restaurant.menu');
    Route::get('/menu/create', [RestaurantController::class, 'menuCreate'])->name('restaurant.menu.create');
    Route::post('/menu', [RestaurantController::class, 'menuStore'])->name('restaurant.menu.store');
    Route::get('/menu/{id}/edit', [RestaurantController::class, 'menuEdit'])->name('restaurant.menu.edit');
    Route::put('/menu/{id}', [RestaurantController::class, 'menuUpdate'])->name('restaurant.menu.update');
    Route::delete('/menu/{id}', [RestaurantController::class, 'menuDelete'])->name('restaurant.menu.delete');
});

// ======= MENU & RESTAURANT DETAIL (UMUM / GUEST) ======= //
Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
Route::get('/restaurant/{id}', [RestaurantController::class, 'show'])->name('restaurants.show');

// ======= ORDER (PEMESANAN MENU) ======= //
Route::post('/order', [OrderController::class, 'store'])->middleware('auth')->name('order.store');
