<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FoodController extends Controller
{
    public function index(){
        $food = Food::all();
        // dd($food);
        $data = DB::table("foods as f")
                ->join("categories as c", "f.category_id", "=", "c.id")
                ->select(["f.id","f.name", "f.price", "f.description", "f.nutrition_fact", "c.name as category"])
                ->orderBy("f.name", "asc")->get();
        // dd($data);
        return view("foods.index", ["food"=> $data]);
        // return $food;
        //// raw query
        // $data = DB::select("select * from foods limit 10,5");
        // $data = DB::select("select * from foods where price > ? and category_id = ?", [50000, 1]);
        
        //// query builder
        // $data = DB::table("foods")->limit(5)->offset(10)->get();
        //// eloquent
        // $data = Food::limit(5)->offset(10)->get();

        // //GROUP BY + SELECT + HAVING
        // $data = DB::table("foods")->select(["category_id", DB::raw("count(*)")])->having("count", ">", 15)->groupBy("category_id")->get();
    }
}
