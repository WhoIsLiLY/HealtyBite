<?php

use App\Http\Controllers\WelcomeController;
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
    $testimonials = [
        // Contoh data testimonial
        [
            'name' => 'John Doe',
            'image' => 'https://via.placeholder.com/150',
            'username' => 'johndoe',
            'testimonial' => 'Great work!'
        ],
        // Tambahkan testimonial lainnya
    ];

    $firstRow = array_slice($testimonials, 0, count($testimonials) / 2);
    $secondRow = array_slice($testimonials, count($testimonials) / 2);

    return view('home', compact('firstRow', 'secondRow'));
});
Route::get('/welcome', function () {
    return 'Selamat Datang';
});
Route::get('/before-order', function () {
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

//name itu biasanya digunakan ketika mengakses route dengan <a href={{ route("home") }}> atau <a href={{ url("welcome") }}>
Route::get('/welcome', function(){
    return view('welcome');
})->name('home');

//name itu biasanya digunakan ketika mengakses route dengan <a href={{ route("home", [type->...]) }}> atau <a href={{ url("welcome") }}>
Route::get('/welcome/{type}', function($type=""){
    return view('welcome');
})->name('home');


/* JENIS ROUTING */
// Langsung kembalikan view sesuai route tertentu menggunakan syntax view
Route::view('/view', 'welcome');

// Menggunakan http method GET atau yang lainnya untuk mengembalikan view
Route::get('/welcome', function(){
    return view('welcome');
});

// Menyertakan parameter untuk dikembalikan bersama view
Route::get('/welcome', function($name){
    return view('welcome', compact($name));
});

// Melewati controller terlebih dahulu untuk mengembalikan view
Route::get('/welcome', [WelcomeController::class, 'index']);