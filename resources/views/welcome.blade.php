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
                    <p class="mt-2 text-sm font-semibold text-gray-500">- Dina, Mahasiswa</p>
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
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-25 z-[9999] hidden overlay"></div>
    <div id="loginUI"
        class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-[10000] hidden
    w-full max-w-[500px] min-h-[55vh] bg-white rounded-lg shadow-lg flex justify-center items-center p-6">


        <!-- Close Button -->
        <button id="closeLoginModal"
            class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl font-bold">&times;</button>

        <!-- Login Content -->
        <div class="flex flex-col justify-center w-full pt-6">
            <!-- Logo & Title -->
            <div class="text-center">
                <img class="mx-auto h-20 w-auto" src="/assets/img/logo.png" alt="Your Company">
                <h1 class="mt-2 text-4xl font-bold tracking-tight text-gray-900">Welcome Back!</h1>
            </div>

            <!-- Login Form -->
            <div class="mt-8">
                <form id="/customerLoginForm" class="space-y-6" action="{{ route('customer.login') }}" method="POST">
                    @csrf

                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-900">Email address</label>
                        <input type="email" id="email" name="email"
                            class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 bg-white text-gray-800"
                            required>
                    </div>

                    <!-- Password Input -->
                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
                            <a href="#" class="text-sm font-semibold text-indigo-600 hover:text-indigo-500">
                                Forgot password?
                            </a>
                        </div>
                        <input type="password" id="password" name="password"
                            class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 bg-white text-gray-800"
                            required>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="w-full flex justify-center rounded-md bg-green-600 px-4 py-2 text-base 
                        font-semibold text-white shadow-sm hover:bg-green-500 
                        focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600">
                            Sign in
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function toggleUI() {
            $('#overlay').fadeToggle();
            $('#loginUI').fadeToggle();
        }
        $(document).ready(function() {
            $('#openLoginModal').click(function() {
                toggleUI();
            });

            $('#closeLoginModal').click(function() {
                toggleUI();
            });

            $('#loginModal').click(function(e) {
                if (e.target === this) {
                    $(this).fadeOut();
                }
            });
            $('#customerLoginForm').on('submit', function(e) {
                e.preventDefault();

                var formArray = $(this).serializeArray();
                var formData = {};
                formArray.forEach(function(item) {
                    formData[item.name] = item.value;
                });

                // Tambahkan type jika dibutuhkan
                formData.type = "user";

                $.ajax({
                    url: '/api/login',
                    type: 'POST',
                    data: JSON.stringify(formData),
                    contentType: 'application/json',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        window.location.href = response.redirect_url;
                    },
                    error: function(jqXHR) {
                        if (jqXHR.responseText) {
                            console.error(jqXHR.responseText);
                        }
                        var errorMessage = JSON.parse(jqXHR.responseText);
                        if (jqXHR.status == 400) {
                            // Create the error message element
                            var errorMessageCss = $(
                                '<div id="errMessage" class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative" role="alert">' +
                                '<span class="block sm:inline">' + errorMessage.message +
                                '</span>' +
                                '</div>');

                            // Append the error message element to the form
                            if (!$('#errMessage').is(':Visible')) {
                                $('form').prepend(errorMessageCss);
                                // Hide the error message after a delay (e.g., 5 seconds)
                                setTimeout(function() {
                                    $('#errMessage').fadeOut('slow', function() {
                                        $('#errMessage').remove();
                                        errorMessageCss = null;
                                    });
                                }, 4000); // 5000 milliseconds = 5 seconds
                            }
                        }
                    }
                });
            });
        });
    </script>
@endpush
