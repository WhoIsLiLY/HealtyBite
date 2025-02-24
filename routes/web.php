<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function(){
    return view('home');
});
Route::get('/welcome', function () {
    return 'Selamat Datang';
});
Route::get('/before_order', function () {
    return 'Pilih DINE-IN atau Take Away';
});
Route::get('/menu/dinein/{id?}', function ($id="") {
    return view('Daftar menu Dine-in');
});
Route::get('/menu/takeaway/{id}', function ($id="") {
    return view('Daftar menu Take-away');
});
Route::get('/admin/{page?}/', function ($page="dashboard") {
    if($page == "dashboard") return view('Portal Management: Daftar Kategori');
});
