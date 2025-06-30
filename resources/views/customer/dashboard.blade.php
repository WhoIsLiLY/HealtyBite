@extends('layouts.main')

@section('content')
    <div class="min-h-screen bg-gray-50 px-4 pt-6 pb-20">
        <!-- Header Section -->
        <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <!-- User Greeting -->
                <div class="flex-1">
                    <h2 class="text-sm text-gray-500 font-medium">Selamat Datang,</h2>
                    <div class="flex items-center mt-1">
                        <h1 class="text-2xl font-bold text-gray-800">{{ $customer->name }}</h1>
                        <span class="ml-2 text-2xl">👋</span>
                    </div>
                </div>

                <!-- Wallet Info Cards -->
                <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Balance Card -->
                    <div
                        class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-100 rounded-xl p-4 flex items-center justify-between shadow-sm">
                        <div>
                            <p class="text-xs text-gray-600 font-medium">Saldo</p>
                            <p class="text-lg font-bold text-gray-800 mt-1">{{ $customer->balance }}</p>
                        </div>
                        <button
                            class="bg-green-600 text-white px-3 py-1.5 text-xs rounded-lg hover:bg-green-700 transition-all shadow-sm">
                            Top Up
                        </button>
                    </div>

                    <!-- Points Card -->
                    <div
                        class="bg-gradient-to-r from-amber-50 to-yellow-50 border border-amber-100 rounded-xl p-4 flex items-center justify-between shadow-sm">
                        <div>
                            <p class="text-xs text-gray-600 font-medium">Poin</p>
                            <p class="text-lg font-bold text-gray-800 mt-1">{{ $customer->point }}</p>
                        </div>
                        <button
                            class="bg-amber-500 text-white px-3 py-1.5 text-xs rounded-lg hover:bg-amber-600 transition-all shadow-sm">
                            Tukar
                        </button>
                    </div>

                    <!-- Notification Card -->
                    <div class="bg-white border border-gray-200 rounded-xl p-4 flex items-center justify-between shadow-sm">
                        <div>
                            <p class="text-xs text-gray-600 font-medium">Order</p>
                            <p class="text-lg font-semibold text-gray-800 mt-1">Tidak ada order</p>
                        </div>
                        <button class="relative">
                            <div class="relative">
                                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="1.5"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0">
                                    </path>
                                </svg>
                                <span
                                    class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                            </div>
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <!-- Search Section -->
        <div class="mb-6">
            <form action="{{ route('restaurants.index') }}" method="get" class="relative">
                <input type="text" placeholder="Cari makanan atau minuman..."
                    class="w-full p-4 pr-12 rounded-xl border border-gray-200 focus:ring-2 focus:ring-green-400 focus:border-green-400 focus:outline-none bg-white shadow-sm transition-all">
                <button type="submit" class="absolute right-3 top-3.5 text-gray-400 hover:text-green-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </form>
        </div>

        <!-- Categories Section -->
        <div class="flex overflow-x-auto pb-3 mb-6 scrollbar-hide">
            <div class="flex space-x-3">
                @foreach (['Semua', 'Makanan', 'Minuman', 'Promo', 'Snack', 'Populer'] as $item)
                    <button class="px-4 py-2 bg-white border border-gray-200 text-gray-700 font-medium rounded-full hover:bg-gray-50 transition whitespace-nowrap shadow-sm
                                {{ $loop->first ? '!bg-green-600 !text-white !border-green-600' : '' }}">
                        {{ $item }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Promo Banner -->
        <div class="mb-8">
            <div class="relative rounded-2xl overflow-hidden shadow-md">
                <img src="/storage/menus/avocado-chiken-salad.png" alt="Promo" class="w-full h-48 object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-6">
                    <div>
                        <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">PROMO</span>
                        <h3 class="text-white text-xl font-bold mt-2">Diskon 50% Hari Ini!</h3>
                        <p class="text-white/90 text-sm mt-1">Khusus untuk pembelian pertama</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recommended Section -->
        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-gray-800">Rekomendasi Untuk Kamu</h2>
                <a href="#" class="text-sm text-green-600 font-medium flex items-center">
                    Lihat Semua
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-2 gap-4">
                @forelse ($recommendedMenus as $menu)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-all">
                        <div class="relative">
                            <img src="/storage/assets/img/menus/{{ $menu->menu_image }}" alt="{{ $menu->name }}"
                                class="w-full h-32 object-cover">
                            <button
                                class="absolute top-2 right-2 p-1.5 bg-white/80 rounded-full backdrop-blur-sm hover:bg-white transition">
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        <div class="p-3">
                            <h3 class="font-medium text-gray-800 truncate">{{ $menu->name }}</h3>
                            <div class="flex items-center justify-between mt-2">
                                <p class="text-green-600 font-semibold">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                                <button class="text-green-600 hover:text-green-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 text-center text-gray-500 py-8">
                        <p>Saat ini belum ada menu yang direkomendasikan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
@endpush