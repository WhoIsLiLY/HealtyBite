@extends('layouts.main')

@section('content')
    <div class="bg-gradient-to-tr from-green-50 via-blue-50 to-white p-10 rounded-3xl shadow-xl animate-fadeIn ">
        <!-- Hero Section -->
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h1 class="text-5xl md:text-6xl font-extrabold text-green-800 leading-tight">
                    Selamat Datang di <span class="text-blue-600">HealthyBite</span> 🍃
                </h1>
                <p class="mt-4 text-xl text-gray-700">
                    Nikmati pengalaman pesan makanan sehat dengan cara modern, cepat, dan hemat!
                </p>
                <a href="#menu"
                    class="mt-6 inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-8 rounded-full transition duration-300 shadow-md">
                    Jelajahi Menu Kami
                </a>
            </div>

            <!-- Highlight Section -->
            <div class="grid md:grid-cols-3 gap-8 mb-16">
                <!-- Promo -->
                <div
                    class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition duration-300 border-l-4 border-yellow-400">
                    <h2 class="text-xl font-bold text-yellow-600 mb-2">🎉 Promo Spesial April</h2>
                    <ul class="list-disc list-inside text-gray-600 space-y-1">
                        <li>Diskon hingga 50% untuk menu pilihan</li>
                        <li>Gratis ongkir se-Indonesia</li>
                        <li>Cashback hingga Rp20.000</li>
                    </ul>
                </div>

                <!-- Why Us -->
                <div
                    class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition duration-300 border-l-4 border-green-500">
                    <h2 class="text-xl font-bold text-green-700 mb-2">Kenapa Memilih Kami?</h2>
                    <ul class="space-y-1 text-gray-600">
                        <li>✅ 100% bahan organik & segar</li>
                        <li>✅ Pengiriman instan dalam 30 menit</li>
                        <li>✅ Mitra restoran sehat bersertifikasi</li>
                        <li>✅ UI/UX pemesanan super cepat</li>
                    </ul>
                </div>

                <!-- Testimoni -->
                <div
                    class="bg-white p-6 rounded-2xl shadow hover:shadow-xl transition duration-300 border-l-4 border-blue-500">
                    <h2 class="text-xl font-bold text-blue-700 mb-2">Apa Kata Pelanggan? 💬</h2>
                    <p class="text-gray-600 italic">“HealthyBite bikin hidupku lebih sehat dan praktis. Cuma 2 klik, makanan
                        sehat udah sampai di meja!”</p>
                    <p class="mt-2 text-sm font-semibold text-gray-500">– Dina, Mahasiswa</p>
                </div>
            </div>

            <!-- Menu Showcase -->
            <div id="menu">
                <h2 class="text-3xl font-bold text-center text-green-800 mb-10">🍽️ Menu Favorit Minggu Ini</h2>
                <div class="grid md:grid-cols-3 gap-8">

                    @foreach ($menus as $menu)
                        <div
                            class="bg-white rounded-2xl shadow-md hover:shadow-lg transform hover:-translate-y-1 transition duration-300">
                            <img src="/storage/menus/avocado-chiken-salad.png"
                                class="rounded-t-2xl w-full h-52 object-cover">
                            <div class="p-5">
                                <h3 class="font-semibold text-lg text-green-700 mb-1">{{ $menu['title'] }}</h3>
                                <p class="text-gray-600 text-sm">{{ $menu['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Call to Action -->
            <div class="text-center mt-20">
                <h2 class="text-2xl font-bold text-blue-700">Yuk mulai hidup sehat dari sekarang!</h2>
                <a href="/register"
                    class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-full font-semibold transition duration-300 shadow-lg">
                    Daftar Sekarang Gratis!
                </a>
            </div>
        </div>
    </div>
    <div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden justify-center items-center">
        <!-- Modal Box -->
        <div class="bg-white p-8 rounded-xl shadow-xl w-full max-w-md relative">
            <!-- Close Button -->
            <button id="closeLoginModal"
                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl font-bold">&times;</button>

            <h2 class="text-2xl font-bold text-center text-green-700 mb-6">Login ke HealthyBite</h2>

            <form method="POST" action="{{ route('customer.login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" required
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-green-200">
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring focus:ring-green-200">
                </div>

                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-md font-semibold transition duration-300">
                    Login
                </button>
            </form>
        </div>
    </div>
@endsection
