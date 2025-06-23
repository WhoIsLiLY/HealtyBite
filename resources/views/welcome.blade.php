@extends('layouts.main')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-white to-green-50 overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
            <div
                class="absolute top-20 left-10 w-40 h-40 bg-blue-100 rounded-full filter blur-3xl opacity-30 animate-float1">
            </div>
            <div
                class="absolute top-1/3 right-20 w-60 h-60 bg-green-100 rounded-full filter blur-3xl opacity-30 animate-float2">
            </div>
            <div
                class="absolute bottom-20 left-1/4 w-80 h-80 bg-teal-100 rounded-full filter blur-3xl opacity-20 animate-float3">
            </div>
        </div>

        <!-- Hero Section -->
        <section class="relative z-10 container mx-auto px-6 md:px-12 py-16 md:py-24 mt-2">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-12 md:mb-0">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight mb-6">
                        <span class="bg-clip-text text-transparent bg-gradient-to-r from-green-600 to-blue-500">Makan
                            Sehat</span><br>
                        <span class="text-gray-800">Tak Pernah Semudah Ini</span>
                    </h1>
                    <p class="text-lg text-gray-600 mb-8 max-w-lg">
                        HealthyBite menghadirkan makanan sehat berkualitas dengan pengiriman super cepat. Nikmati hidup
                        sehat tanpa ribet!
                    </p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <button id="openLoginModal2"
                            class="px-8 py-3 bg-gradient-to-r from-green-500 to-blue-500 text-white rounded-full font-semibold hover:shadow-lg transition-all transform hover:scale-105 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            Pesan Sekarang
                        </button>
                        <button
                            class="px-8 py-3 border-2 border-green-500 text-green-600 rounded-full font-semibold hover:bg-green-50 transition flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Demo Aplikasi
                        </button>
                    </div>
                    <div class="mt-8 flex items-center space-x-4">
                        <div class="flex -space-x-2">
                            <img class="w-10 h-10 rounded-full border-2 border-white"
                                src="https://randomuser.me/api/portraits/women/12.jpg" alt="User">
                            <img class="w-10 h-10 rounded-full border-2 border-white"
                                src="https://randomuser.me/api/portraits/men/32.jpg" alt="User">
                            <img class="w-10 h-10 rounded-full border-2 border-white"
                                src="https://randomuser.me/api/portraits/women/45.jpg" alt="User">
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-700">10.000+ pengguna puas</p>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                    </path>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-700">4.9 (2.500+ reviews)</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/2 relative">
                    <div class="relative max-w-md mx-auto">
                        <div
                            class="absolute -top-10 -left-10 w-64 h-64 bg-green-100 rounded-full filter blur-xl opacity-30 animate-pulse">
                        </div>
                        <div
                            class="absolute -bottom-10 -right-10 w-64 h-64 bg-blue-100 rounded-full filter blur-xl opacity-30 animate-pulse">
                        </div>
                        <div class="relative z-10">
                            <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                                alt="Healthy Food"
                                class="rounded-2xl shadow-2xl transform rotate-2 hover:rotate-0 transition duration-500">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Partner Logos -->
        <section class="relative z-10 py-12 bg-white bg-opacity-50 backdrop-filter backdrop-blur-sm">
            <div class="container mx-auto px-6">
                <p class="text-center text-gray-500 mb-8">Bekerja sama dengan mitra terbaik</p>
                <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16">
                    <img src="/storage/assets/img/logos/gopay.png" alt="Partner"
                        class="h-20 opacity-60 hover:opacity-100 transition">
                    <img src="/storage/assets/img/logos/ovo.png" alt="Partner"
                        class="h-10 opacity-60 hover:opacity-100 transition">
                    <img src="/storage/assets/img/logos/gopay.png" alt="Partner"
                        class="h-20 opacity-60 hover:opacity-100 transition">
                    <img src="/storage/assets/img/logos/ovo.png" alt="Partner"
                        class="h-10 opacity-60 hover:opacity-100 transition">
                    <img src="/storage/assets/img/logos/gopay.png" alt="Partner"
                        class="h-20 opacity-60 hover:opacity-100 transition">
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="relative z-10 py-20">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Kenapa HealthyBite?</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">Kami membuat hidup sehat menjadi mudah, cepat, dan
                        menyenangkan</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div
                        class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                        <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Pengiriman Kilat</h3>
                        <p class="text-gray-600">Makanan sehat diantar dalam 30 menit atau gratis. Kami menggunakan
                            teknologi routing canggih seperti Gojek/Grab.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div
                        class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                        <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">100% Organik</h3>
                        <p class="text-gray-600">Bahan-bahan pilihan langsung dari petani lokal terpercaya. Setiap hidangan
                            melalui quality control ketat.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div
                        class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-2">
                        <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Harga Terjangkau</h3>
                        <p class="text-gray-600">Hidangan sehat dengan harga terjangkau. Berlangganan lebih hemat dengan
                            paket mingguan/bulanan.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Menu Carousel -->
        <section class="relative z-10 py-20 bg-gradient-to-r from-green-50 to-blue-50">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Menu Populer Minggu Ini</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">Pilihan terbaik dari chef kami untuk kesehatan
                        optimal</p>
                </div>

                <div class="relative">
                    <div class="flex overflow-x-auto pb-8 scrollbar-hide space-x-6 px-2">
                        @foreach ($menus as $menu)
                            <div
                                class="flex-shrink-0 w-72 bg-white rounded-2xl shadow-lg overflow-hidden transform hover:scale-105 transition duration-300">
                                <div class="relative h-48 overflow-hidden">
                                    <img src="/storage/menus/avocado-chiken-salad.png" alt=" $menu['title'] }}"
                                        class="w-full h-full object-cover">
                                    <div
                                        class="absolute top-4 right-4 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                        BESTSELLER</div>
                                </div>
                                <div class="p-6">
                                    <h3 class="font-bold text-lg text-gray-800 mb-1"> $menu['title'] }}</h3>
                                    <p class="text-gray-600 text-sm mb-4"> $menu['desc'] }}</p>
                                    <div class="flex justify-between items-center">
                                        <span class="font-bold text-green-600">Rp number_format($menu['price'], 0, ',',
                                            '.') }}</span>
                                        <button
                                            class="text-white bg-green-500 hover:bg-green-600 px-4 py-2 rounded-full text-sm font-medium transition">
                                            + Tambah
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <section class="relative z-10 py-20">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Apa Kata Mereka?</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">Testimoni dari pelanggan setia HealthyBite</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Testimonial 1 -->
                    <div class="bg-white p-8 rounded-2xl shadow-lg">
                        <div class="flex items-center mb-6">
                            <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="User"
                                class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h4 class="font-bold text-gray-800">Sarah Wijaya</h4>
                                <p class="text-gray-500 text-sm">Karyawan Kantoran</p>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">"Sejak pakai HealthyBite, badan lebih fit dan berat badan turun 5kg
                            dalam 2 bulan. Pengiriman selalu tepat waktu!"</p>
                        <div class="flex">
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                        </div>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="bg-white p-8 rounded-2xl shadow-lg">
                        <div class="flex items-center mb-6">
                            <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="User"
                                class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h4 class="font-bold text-gray-800">Budi Santoso</h4>
                                <p class="text-gray-500 text-sm">Atlet Fitness</p>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">"Kalori dan nutrisi tercatat dengan detail. Sangat membantu untuk
                            program diet dan fitness saya. Rasa makanan juga enak!"</p>
                        <div class="flex">
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                        </div>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="bg-white p-8 rounded-2xl shadow-lg">
                        <div class="flex items-center mb-6">
                            <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="User"
                                class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <h4 class="font-bold text-gray-800">Dewi Lestari</h4>
                                <p class="text-gray-500 text-sm">Ibu Rumah Tangga</p>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">"Aplikasinya sangat mudah digunakan. Sekarang tidak perlu repot masak
                            untuk sarapan sehat. Anak-anak juga suka!"</p>
                        <div class="flex">
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- App Download -->
        <section class="relative z-10 py-20 bg-gradient-to-br from-green-600 to-blue-600 text-white">
            <div class="container mx-auto px-6">
                <div class="flex flex-col md:flex-row items-center">
                    <div class="md:w-1/2 mb-12 md:mb-0">
                        <h2 class="text-3xl md:text-4xl font-bold mb-6">Download Aplikasi HealthyBite</h2>
                        <p class="text-lg mb-8 opacity-90">Nikmati kemudahan pesan makanan sehat langsung dari smartphone
                            Anda. Dapatkan notifikasi promo eksklusif!</p>
                        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                            <button
                                class="flex items-center justify-center bg-black bg-opacity-20 hover:bg-opacity-30 px-6 py-3 rounded-lg transition">
                                <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.8 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.04zm-5.16-14.3c-.58-.69-1.04-1.62-.92-2.58 1-.08 2.07.39 2.73 1.08.6.66 1.03 1.6.89 2.54-1.11.04-2.13-.45-2.7-1.04z">
                                    </path>
                                </svg>
                                <div class="text-left">
                                    <p class="text-xs">Download on the</p>
                                    <p class="text-lg font-semibold">App Store</p>
                                </div>
                            </button>
                            <button
                                class="flex items-center justify-center bg-black bg-opacity-20 hover:bg-opacity-30 px-6 py-3 rounded-lg transition">
                                <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3.9 12c0-1.71 1.39-3.1 3.1-3.1h4V7H7c-2.76 0-5 2.24-5 5s2.24 5 5 5h4v-1.9H7c-1.71 0-3.1-1.39-3.1-3.1zM8 13h8v-2H8v2zm9-6h-4v1.9h4c1.71 0 3.1 1.39 3.1 3.1s-1.39 3.1-3.1 3.1h-4V17h4c2.76 0 5-2.24 5-5s-2.24-5-5-5z">
                                    </path>
                                </svg>
                                <div class="text-left">
                                    <p class="text-xs">Get it on</p>
                                    <p class="text-lg font-semibold">Google Play</p>
                                </div>
                            </button>
                        </div>
                    </div>
                    <div class="md:w-1/2 flex justify-center">
                        <img src="/assets/img/app_example.png" alt="App Screenshot"
                            class="w-80 h-auto rounded-xl shadow-2xl transform rotate-1 hover:rotate-0 transition duration-500">
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="relative z-10 bg-gray-900 text-gray-400 py-16">
            <div class="container mx-auto px-6">
                <div class="grid md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-white text-lg font-bold mb-4">HealthyBite</h3>
                        <p class="mb-4">Membawa hidup sehat ke genggaman Anda dengan teknologi modern dan bahan-bahan
                            terbaik.</p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-white transition">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z">
                                    </path>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.058 1.032-.057 1.407-.057 3.864v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.032.048 1.407.058 3.864.058h.468c2.456 0 2.784-.011 3.807-.058.975-.045 1.504-.207 1.857-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.032.058-1.407.058-3.864v-.468c0-2.456-.011-2.784-.058-3.807-.045-.975-.207-1.504-.344-1.857a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.032-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z">
                                    </path>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-white text-lg font-bold mb-4">Perusahaan</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:text-white transition">Tentang Kami</a></li>
                            <li><a href="#" class="hover:text-white transition">Karir</a></li>
                            <li><a href="#" class="hover:text-white transition">Blog</a></li>
                            <li><a href="#" class="hover:text-white transition">Mitra Kami</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-white text-lg font-bold mb-4">Bantuan</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:text-white transition">Pusat Bantuan</a></li>
                            <li><a href="#" class="hover:text-white transition">Kebijakan Privasi</a></li>
                            <li><a href="#" class="hover:text-white transition">Syarat & Ketentuan</a></li>
                            <li><a href="#" class="hover:text-white transition">Kontak Kami</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-white text-lg font-bold mb-4">Kontak</h3>
                        <ul class="space-y-2">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-2 mt-0.5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>Jl. Jl. Raya Kalirungkut, Kali Rungkut, Kec. Rungkut, Surabaya, Jawa Timur 60293</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                                <span>(021) 1234-5678</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span>willyhimaw@gmail.com</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-gray-800 mt-12 pt-8 text-center">
                    <p>&copy; 2025 HealthyBite. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Animation Styles -->
    <style>
        @keyframes float1 {

            0%,
            100% {
                transform: translateY(0) translateX(0);
            }

            50% {
                transform: translateY(-20px) translateX(10px);
            }
        }

        @keyframes float2 {

            0%,
            100% {
                transform: translateY(0) translateX(0);
            }

            50% {
                transform: translateY(20px) translateX(-15px);
            }
        }

        @keyframes float3 {

            0%,
            100% {
                transform: translateY(0) translateX(0);
            }

            50% {
                transform: translateY(30px) translateX(20px);
            }
        }

        .animate-float1 {
            animation: float1 8s ease-in-out infinite;
        }

        .animate-float2 {
            animation: float2 10s ease-in-out infinite;
        }

        .animate-float3 {
            animation: float3 12s ease-in-out infinite;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
    <div id="overlay" class="fixed inset-0 bg-black bg-opacity-30 backdrop-blur-sm z-[9999] hidden overlay transition-opacity duration-300"></div>

<div id="loginUI"
    class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-[10000] hidden
    w-full max-w-md bg-white rounded-xl shadow-2xl overflow-hidden p-0">
    
    <!-- Close Button -->
    <button id="closeLoginModal"
        class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors duration-200
        rounded-full p-1 bg-gray-100 hover:bg-gray-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <!-- Login Content -->
    <div class="flex flex-col w-full">
        <!-- Header with gradient -->
        <div class="bg-gradient-to-r from-green-500 to-blue-500 py-6 px-8 text-center">
            <img class="mx-auto h-16 w-auto" src="/assets/img/logo.png" alt="HealthyBite">
            <h1 class="mt-4 text-2xl font-bold text-white">Welcome Back!</h1>
            <p class="mt-1 text-white/90">Sign in to continue your healthy journey</p>
        </div>

        <!-- Form Container -->
        <div class="px-8 py-8">
            <form id="customerLoginForm" class="space-y-6" action="#" method="POST">
                @csrf

                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                        </div>
                        <input type="email" id="email" name="email" autocomplete="email"
                            class="block w-full pl-10 pr-3 py-3 bg-white border border-gray-300 rounded-lg 
                            focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500
                            transition duration-200"
                            placeholder="your@email.com" required>
                    </div>
                </div>

                <!-- Password Input -->
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <a href="#" class="text-sm font-medium text-green-600 hover:text-green-500 transition-colors">
                            Forgot password?
                        </a>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="password" id="password" name="password" autocomplete="current-password"
                            class="block w-full pl-10 pr-3 py-3 bg-white border border-gray-300 rounded-lg 
                            focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500
                            transition duration-200"
                            placeholder="••••••••" required>
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" id="loginButton"
                        class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg
                        shadow-sm text-white bg-gradient-to-r from-green-600 to-green-500
                        hover:from-green-700 hover:to-green-600
                        focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500
                        transition-all duration-200 font-medium">
                        <span class="mr-2">Sign in</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </form>

            <!-- Alternative Login -->
            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">Or login as</span>
                    </div>
                </div>

                <div class="mt-4 text-center">
                    <a href="/restaurant/login" 
                        class="inline-flex items-center text-green-600 hover:text-green-700 font-medium
                        transition-colors duration-200">
                        <span>Restaurant Partner</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
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
            $('#openLoginModal2').click(function() {
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

                formData.type = "user";

                var $signInBtn = $('#loginButton');
                var originalText = $signInBtn.html();

                $signInBtn.html(`
                    <svg class="animate-spin h-5 w-5 mx-auto text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 00-8 8h4z"></path>
                    </svg>
                `).attr('disabled', true);

                $.ajax({
                    url: '/customer/login',
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
                            var errorMessageCss = $(
                                '<div id="errMessage" class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative" role="alert">' +
                                '<span class="block sm:inline">' + errorMessage.message +
                                '</span>' +
                                '</div>');

                            if (!$('#errMessage').is(':Visible')) {
                                $('form').prepend(errorMessageCss);
                                setTimeout(function() {
                                    $('#errMessage').fadeOut('slow', function() {
                                        $('#errMessage').remove();
                                        errorMessageCss = null;
                                    });
                                }, 4000);
                            }
                        }
                    },
                    complete: function() {
                        // Kembalikan tombol ke kondisi semula
                        $signInBtn.html(originalText).attr('disabled', false);
                    }
                });
            });
        });
    </script>
@endpush
