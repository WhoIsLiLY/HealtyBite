@extends('layouts.main')

@section('content')
    <div class="min-h-screen bg-gray-100 px-4 pt-4 pb-20">
        <!-- Header -->
        <div class="bg-white rounded-xl shadow p-4 mb-6 flex flex-col lg:items-center lg:justify-between">
            <!-- User Greeting -->
            <div class="w-full mb-4 lg:mb-0 align-left p-4">
                <h2 class="text-sm text-gray-500">Selamat Datang,</h2>
                <h1 class="text-2xl font-bold text-green-600">Willy 👋</h1>
            </div>
            <!-- Wallet Info -->
            <div class="w-full flex-1 lg:ml-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Saldo -->
                <div class="bg-green-50 border border-green-200 rounded-xl p-4 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Saldo</p>
                        <p class="text-lg font-bold text-green-700">Rp 125.000</p>
                    </div>
                    <button class="bg-green-600 text-white px-3 py-1 text-sm rounded-full hover:bg-green-700 transition">
                        Top Up
                    </button>
                </div>

                <!-- Poin -->
                <div class="bg-green-50 border border-green-200 rounded-xl p-4 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Poin</p>
                        <p class="text-lg font-bold text-green-700">320 Poin</p>
                    </div>
                    <button class="bg-green-600 text-white px-3 py-1 text-sm rounded-full hover:bg-green-700 transition">
                        Tukar
                    </button>
                </div>

                <!-- Notifikasi -->
                <div class="bg-white border border-gray-200 rounded-xl p-4 flex items-center justify-between">
                    <div class="text-gray-600">
                        <p class="text-sm">Notifikasi</p>
                        <p class="text-lg font-semibold">3 Pesan Baru</p>
                    </div>
                    <button class="relative">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path
                                d="M15 17h5l-1.405-1.405M19 13v-2a7 7 0 10-14 0v2l-1.405 1.595A1 1 0 005 17h5m4 0v1a3 3 0 11-6 0v-1m6 0H9">
                            </path>
                        </svg>
                        <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full px-1">3</span>
                    </button>
                </div>
            </div>
        </div>


        <!-- Search -->
        <div class="mb-4">
            <form action="{{ route('restaurants.index') }}" method="get">
                <input type="text" placeholder="Cari makanan atau minuman..."
                    class="w-full p-3 rounded-xl border border-gray-300 focus:ring-green-500 focus:outline-none bg-white">
            </form>
        </div>

        <!-- Categories -->
        <div class="flex overflow-x-auto space-x-4 mb-4">
            @foreach (['Makanan', 'Minuman', 'Promo', 'Snack', 'Populer'] as $item)
                <button
                    class="min-w-max px-4 py-2 bg-green-100 text-green-700 font-medium rounded-full hover:bg-green-200 transition">
                    {{ $item }}
                </button>
            @endforeach
        </div>

        <!-- Promo Banner -->
        <div class="mb-6">
            <div class="relative rounded-2xl overflow-hidden">
                <img src="/storage/menus/avocado-chiken-salad.png" alt="Promo" class="w-full h-40 object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                    <h3 class="text-white text-xl font-bold">Diskon 50% Hari Ini!</h3>
                </div>
            </div>
        </div>

        <!-- Recommended -->
        <div>
            <h2 class="text-lg font-semibold text-gray-700 mb-3">Rekomendasi Untuk Kamu</h2>
            <div class="grid grid-cols-2 gap-4">
                @for ($i = 0; $i < 4; $i++)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <img src="/storage/menus/avocado-chiken-salad.png" alt="Food" class="w-full h-24 object-cover">
                        <div class="p-2">
                            <h3 class="font-medium text-gray-800">Nasi Ayam Geprek</h3>
                            <p class="text-sm text-green-600 font-semibold">Rp 18.000</p>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
@endsection
