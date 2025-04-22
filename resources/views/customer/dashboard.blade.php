@extends('layouts.main')

{{-- Data Dummy --}}
@php
$restaurants = [
    (object)[
        'id' => 1,
        'name' => 'Green Bowl',
        'description' => 'Salad segar dan smoothies organik.',
        'image_url' => 'https://via.placeholder.com/300x200?text=Green+Bowl',
    ],
    (object)[
        'id' => 2,
        'name' => 'Fit Meal',
        'description' => 'Makanan sehat dengan kalori terkontrol.',
        'image_url' => 'https://via.placeholder.com/300x200?text=Fit+Meal',
    ],
    (object)[
        'id' => 3,
        'name' => 'Vita Kitchen',
        'description' => 'Masakan rumahan sehat untuk harian kamu.',
        'image_url' => 'https://via.placeholder.com/300x200?text=Vita+Kitchen',
    ],
    (object)[
        'id' => 4,
        'name' => 'Healthy Bites',
        'description' => 'Snack sehat rendah gula dan lemak.',
        'image_url' => 'https://via.placeholder.com/300x200?text=Healthy+Bites',
    ],
    (object)[
        'id' => 5,
        'name' => 'NutriBox',
        'description' => 'Paket makan sehat harian dengan nutrisi seimbang.',
        'image_url' => 'https://via.placeholder.com/300x200?text=NutriBox',
    ],
    (object)[
        'id' => 6,
        'name' => 'Lean Feast',
        'description' => 'Hidangan tinggi protein untuk diet dan gym.',
        'image_url' => 'https://via.placeholder.com/300x200?text=Lean+Feast',
    ],
    (object)[
        'id' => 7,
        'name' => 'Zen Eatery',
        'description' => 'Menu vegetarian dan vegan sehat.',
        'image_url' => 'https://via.placeholder.com/300x200?text=Zen+Eatery',
    ],
    (object)[
        'id' => 8,
        'name' => 'Clean Kitchen',
        'description' => 'Semua bahan organik dan tanpa MSG.',
        'image_url' => 'https://via.placeholder.com/300x200?text=Clean+Kitchen',
    ],
    (object)[
        'id' => 9,
        'name' => 'Salad & Co',
        'description' => 'Beragam pilihan salad dari sayur segar.',
        'image_url' => 'https://via.placeholder.com/300x200?text=Salad+%26+Co',
    ],
    (object)[
        'id' => 10,
        'name' => 'Healthy Express',
        'description' => 'Cepat saji sehat dengan bahan pilihan.',
        'image_url' => 'https://via.placeholder.com/300x200?text=Healthy+Express',
    ],
];
@endphp

@section('content')
    <h2 class="text-3xl font-bold mb-6">Welcome to Healthy Food Ordering</h2>
    <p class="mb-4">Order healthy and delicious food easily!</p>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach ($restaurants as $restaurant)
            <div class="bg-white shadow-md rounded-2xl overflow-hidden">
                <img src="{{ $restaurant->image_url }}" alt="{{ $restaurant->name }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold mb-2">{{ $restaurant->name }}</h3>
                    <p class="text-gray-600 mb-4">{{ $restaurant->description }}</p>
                    {{-- <a href="{{ route('test/menus', $restaurant->id) }}" class="inline-block bg-green-500 text-white px-4 py-2 rounded-xl hover:bg-green-600 transition">Pesan</a> --}}
                    
                    {{-- Sementara --}}
                    <a href="/menus/{{ $restaurant->id }}"
                        class="inline-block bg-green-500 text-white px-4 py-2 rounded-xl hover:bg-green-600 transition">
                        Pesan
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    {{-- <a href="/menu" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Explore Menu</a> --}}
@endsection
