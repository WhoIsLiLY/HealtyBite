@extends('layouts.main')

{{-- Data Dummy --}}
@php
    // $restaurants = [
    //     (object) [
    //         'id' => 1,
    //         'name' => 'Green Bowl',
    //         'description' => 'Salad segar dan smoothies organik.',
    //         'image_url' => '/storage/restaurants/image.png',
    //     ],
    //     (object) [
    //         'id' => 2,
    //         'name' => 'Fit Meal',
    //         'description' => 'Makanan sehat dengan kalori terkontrol.',
    //         'image_url' => '/storage/restaurants/image.png',
    //     ],
    //     (object) [
    //         'id' => 3,
    //         'name' => 'Vita Kitchen',
    //         'description' => 'Masakan rumahan sehat untuk harian kamu.',
    //         'image_url' => '/storage/restaurants/image.png',
    //     ],
    //     (object) [
    //         'id' => 4,
    //         'name' => 'Healthy Bites',
    //         'description' => 'Snack sehat rendah gula dan lemak.',
    //         'image_url' => '/storage/restaurants/image.png',
    //     ],
    //     (object) [
    //         'id' => 5,
    //         'name' => 'NutriBox',
    //         'description' => 'Paket makan sehat harian dengan nutrisi seimbang.',
    //         'image_url' => '/storage/restaurants/image.png',
    //     ],
    //     (object) [
    //         'id' => 6,
    //         'name' => 'Lean Feast',
    //         'description' => 'Hidangan tinggi protein untuk diet dan gym.',
    //         'image_url' => '/storage/restaurants/image.png',
    //     ],
    //     (object) [
    //         'id' => 7,
    //         'name' => 'Zen Eatery',
    //         'description' => 'Menu vegetarian dan vegan sehat.',
    //         'image_url' => '/storage/restaurants/image.png',
    //     ],
    //     (object) [
    //         'id' => 8,
    //         'name' => 'Clean Kitchen',
    //         'description' => 'Semua bahan organik dan tanpa MSG.',
    //         'image_url' => '/storage/restaurants/image.png',
    //     ],
    //     (object) [
    //         'id' => 9,
    //         'name' => 'Salad & Co',
    //         'description' => 'Beragam pilihan salad dari sayur segar.',
    //         'image_url' => '/storage/restaurants/image.png',
    //     ],
    //     (object) [
    //         'id' => 10,
    //         'name' => 'Healthy Express',
    //         'description' => 'Cepat saji sehat dengan bahan pilihan.',
    //         'image_url' => '/storage/restaurants/image.png',
    //     ],
    // ];
@endphp

@section('content')
    <section class="bg-green-50 py-16 px-4 md:px-10 rounded-2xl shadow-inner text-center">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-4xl md:text-5xl font-extrabold text-green-800 mb-6 leading-tight">
                Welcome to Healthy Food Ordering
            </h2>
            <p class="text-lg md:text-xl text-green-900 mb-8">
                Order healthy and delicious food from top-rated restaurants with just a few clicks!
            </p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($restaurants as $restaurant)
                <div
                    class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition transform hover:scale-[1.02] duration-300">
                    <div class="overflow-hidden">
                        <img src="{{ $restaurant->image_url }}" alt="{{ $restaurant->name }}"
                            class="w-full aspect-[4/3] object-cover hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="p-5">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-2">{{ $restaurant->name }}</h3>
                        <p class="text-gray-500 mb-4">{{ $restaurant->description }}</p>
                        <a href="/customer/restaurant/{{ $restaurant->id }}"
                            class="inline-block bg-green-600 text-white px-5 py-2 rounded-xl hover:bg-green-700 transition">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
