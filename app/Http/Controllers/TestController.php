<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    function welcome()
    {
        return "tampilan splash screen berisi judul aplikasi, 
        deskripsi, dan ada tombol Start Order";
    }

    function beforeOrder()
    {
        return view("before");
    }

    function menu($type)
    {
        if ($type == "dinein") {
            return "tampilan menu-menu yang bisa dipesan dalam dine-in";
        } else if ($type == "takeaway") {
            return "tampilan menu-menu yang bisa dipesan dalam takeaway.";
        }
        return "404 not found";
    }

    function admin($type)
    {
        if ($type == "categories") {
            //return "daftar kategori menu bentuk table seperti: appetizer, main-course, dessert";
            return view(
                "admin",
                ["type" => $type]
            );
        } else if ($type == "order") {
            //return "daftar seluruh order bentuk table";
            return view(
                "admin",
                ["type" => $type]
            );
        } else if ($type == "members") {
            // return "daftar member bentuk table";
            return view(
                "admin",
                ["type" => $type]
            );
        }
        return "404 not found";
    }

    function tesQuery()
    {
        // return "Hello Query!";
        // select *, count(*) from ... join ... where ... order bt ... limit ...,...
        // WHERE
        // $data = DB::select(
        //     "select * from foods where price > ? and category_id = ?",
        //     [50000, 1]
        // );

        // dd(DB::select("select * from foodsb where price > 50000"));

        // raw query
        // $data = DB::select("select * from foods where price > 50000");

        // query builder
        // $data = DB::table("foods")
        //    ->where("price",">",50000)
        //     ->get();

        // Eloquent
        // $data = Food::all()->where("price", ">", 50000);

        // LIMIT OFFSET
        // raw query

        // konversi dari page number ke offset
        // 1 -> 0
        // 2 -> 5
        // 3 -> 10
        // 4 -> 15
        // x -> (x-1) * 5
        // $data = DB::select("select * from foods limit 5, 5");

        // query builder
        //$data = DB::table("foods")->limit(5)->offset(10)->get();

        // Eloquent
        //$data = Food::limit(5)->offset(10)->get();

        // GROUP BY + SELECT + HAVING (query builder)
        // $data = DB::table("foods")
        //     ->select(["category_id", DB::raw("count(*) as count")])
        //     ->having("count", ">", 15)
        //     ->groupBy("category_id")
        //     ->get();

        // INNER JOIN + order by (query builder)
        // $data = DB::table("foods as f")
        //     ->join(
        //         "categories as c",
        //         "f.category_id",
        //         "=",
        //         "c.id"
        //     )
        //     ->select(["f.name as name", "f.price as price", "c.name as category"])
        //     ->orderBy("f.name", "asc")
        //     ->get();

        // sub query (query builder)
        $data = DB::table("foods")
            ->select(["category_id", DB::raw("count(*) as count")])
            ->groupBy("category_id")
            ->get();
        $avg = 0;
        foreach ($data as $d) {
            $avg += $d->count;
        }
        $avg /= count($data);

        $data = DB::table("foods")
            ->select(["category_id", DB::raw("count(*) as count")])
            ->having("count", ">", $avg)
            ->groupBy("category_id")
            ->get();

        return response()->json($data);
    }
}
