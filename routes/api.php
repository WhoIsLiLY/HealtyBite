<?php

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// RESTful ROUTING (Ini cuma digunakan untuk ajax/javascript) 

// AUTH
Route::post('/register', 'AuthController@register');
Route::post('/login', [LoginController::class, 'customerLogin']);

// CUSTOMERS
Route::get('/customers', 'CustomerController@index');
Route::get('/customers/{id}', 'CustomerController@show');
Route::post('/customers', 'CustomerController@store');
Route::put('/customers/{id}', 'CustomerController@update');
Route::delete('/customers/{id}', 'CustomerController@destroy');

// CUSTOMER EXTRA
Route::get('/customers/{id}/points', 'CustomerController@getPoints');
Route::put('/customers/{id}/points', 'CustomerController@updatePoints');
Route::get('/customers/{id}/reviews', 'ReviewController@getByCustomer');
Route::get('/customers/{id}/orders', 'OrderController@getByCustomer');

// RESTAURANTS
Route::get('/restaurants', 'RestaurantController@index');
Route::get('/restaurants/{id}', 'RestaurantController@show');
Route::post('/restaurants', 'RestaurantController@store');
Route::put('/restaurants/{id}', 'RestaurantController@update');
Route::delete('/restaurants/{id}', 'RestaurantController@destroy');

// RESTAURANTS BY CATEGORY
Route::get('/restaurants/category/{categoryId}', 'RestaurantController@getByCategory');

// RESTAURANT REVIEWS
Route::get('/restaurants/{id}/reviews', 'ReviewController@getByRestaurant');
Route::post('/restaurants/{id}/reviews', 'ReviewController@store');

// RESTAURANT MENUS
Route::get('/restaurants/{id}/menus', 'MenuController@getByRestaurant');

// RESTAURANT CATEGORIES
Route::get('/restaurant-categories', 'RestaurantCategoryController@index');
Route::get('/restaurant-categories/{id}', 'RestaurantCategoryController@show');
Route::post('/restaurant-categories', 'RestaurantCategoryController@store');
Route::put('/restaurant-categories/{id}', 'RestaurantCategoryController@update');
Route::delete('/restaurant-categories/{id}', 'RestaurantCategoryController@destroy');

// MENUS
Route::get('/menus', 'MenuController@index');
Route::get('/menus/{id}', 'MenuController@show');
Route::post('/menus', 'MenuController@store');
Route::put('/menus/{id}', 'MenuController@update');
Route::delete('/menus/{id}', 'MenuController@destroy');

// ADDONS
Route::get('/addons', 'AddonController@index');
Route::get('/addons/{id}', 'AddonController@show');
Route::post('/addons', 'AddonController@store');
Route::put('/addons/{id}', 'AddonController@update');
Route::delete('/addons/{id}', 'AddonController@destroy');

// ADDONS BY MENU
Route::get('/menus/{id}/addons', 'AddonController@getByMenu');
Route::post('/menus/{id}/addons', 'AddonController@storeForMenu');

// MENU TAGS (food_tags)
Route::get('/menus/{id}/tags', 'MenuTagController@getTags');
Route::post('/menus/{id}/tags/{tagId}', 'MenuTagController@attachTag');
Route::delete('/menus/{id}/tags/{tagId}', 'MenuTagController@detachTag');

// FOOD TAGS
Route::get('/food-tags', 'FoodTagController@index');
Route::get('/food-tags/{id}', 'FoodTagController@show');
Route::post('/food-tags', 'FoodTagController@store');
Route::put('/food-tags/{id}', 'FoodTagController@update');
Route::delete('/food-tags/{id}', 'FoodTagController@destroy');

// ORDERS
Route::get('/orders', 'OrderController@index');
Route::get('/orders/{id}', 'OrderController@show');
Route::post('/orders', 'OrderController@store');
Route::put('/orders/{id}', 'OrderController@update');
Route::delete('/orders/{id}', 'OrderController@destroy');

// ORDER STATUS
Route::put('/orders/{id}/status', 'OrderController@updateStatus');

// ORDER LIST / DETAILS
Route::get('/orders/{orderId}/items', 'ListOrderController@index');
Route::post('/orders/{orderId}/items', 'ListOrderController@store');
Route::put('/orders/items/{id}', 'ListOrderController@update');
Route::delete('/orders/items/{id}', 'ListOrderController@destroy');

// PAYMENT METHODS
Route::get('/payment-methods', 'PaymentMethodController@index');
Route::get('/payment-methods/{id}', 'PaymentMethodController@show');
Route::post('/payment-methods', 'PaymentMethodController@store');
Route::put('/payment-methods/{id}', 'PaymentMethodController@update');
Route::delete('/payment-methods/{id}', 'PaymentMethodController@destroy');
