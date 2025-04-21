<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CategoryController;

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
    // $testimonials = [
    //     // Contoh data testimonial
    //     [
    //         'name' => 'John Doe',
    //         'image' => 'https://via.placeholder.com/150',
    //         'username' => 'johndoe',
    //         'testimonial' => 'Great work!'
    //     ],
    //     // Tambahkan testimonial lainnya
    // ];

    // $firstRow = array_slice($testimonials, 0, count($testimonials) / 2);
    // $secondRow = array_slice($testimonials, count($testimonials) / 2);

    // return view('home', compact('firstRow', 'secondRow'));
    return view("index");
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
Route::get('/welcome', [WelcomeController::class, 'index'])->name("home");

Route::get("/welcome", 
[TestController::class, "welcome"])->name
("home");

// Route::get("/before_order", function () {
//     return view("before");
// });

Route::get("/before_order", 
    [TestController::class, "beforeOrder"]);

// Route::get("/menu/{type?}", function ($type = "") {
//     if ($type == "dinein") {
//         return "tampilan menu-menu yang bisa dipesan dalam dine-in";
//     } else if ($type == "takeaway") {
//         return "tampilan menu-menu yang bisa dipesan dalam takeaway.";
//     }
//     return "404 not found";
// })->name(name: "menu");

Route::get("/menu/{type?}",
[TestController::class, "menu"] )->name
(name: "menu");

// Route::get("/admin/{type?}", function ($type = "") {
//     if ($type == "categories") {
//         //return "daftar kategori menu bentuk table seperti: appetizer, main-course, dessert";
//         return view("admin", 
//         ["type" => $type] );
//     } else if ($type == "order") {
//         //return "daftar seluruh order bentuk table";
//         return view("admin", 
//         ["type" => $type] );
//     } else if ($type == "members") {
//         // return "daftar member bentuk table";
//         return view("admin", 
//         ["type" => $type] );
//     }
//     return "404 not found";
// });

Route::get("/admin/{type?}", 
[TestController::class, "admin"]);
Route::post("/categories/showListFoods", [CategoryController::class, "showListFoods"])->name("category.showListFoods");

// Route::get("/categories/showListFoods", [CategoryController::class, "showListFoods"])->name("category.showListFoods");
Route::resource("/categories", CategoryController::class);

Route::resource("/food", FoodController::class);

Route::get("/tesquery", 
[TestController::class,"tesQuery"]);

//Route::get("/categories/showTotalFoods", [CategoryController::class, "showTotalFoods"]);

Route::get("/testemplate/home/", function(){
    return view("testemplate.home");
});

Route::get("/testemplate/search/", function(){
    return view("testemplate.search");
});

Route::get("/testemplate/produk/{id}", function($id){
    return view("testemplate.product", ["id" => $id]);
});