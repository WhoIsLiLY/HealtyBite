@extends('layouts.main')

@section('content')
    <div class="min-h-screen bg-gray-50 px-4 pt-6 pb-20" x-data="{ showModal: false }">
        <!-- Header Section -->
        <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <!-- User Greeting -->
                <div class="flex-1">
                    <h2 class="text-sm text-gray-500 font-medium">Selamat Datang,</h2>
                    <div class="flex items-center mt-1">
                        <h1 class="text-2xl font-bold text-green-700">{{ $restaurant->name }}</h1>
                        <span class="ml-2 text-2xl">👋</span>
                    </div>
                </div>
                
                <!-- Info Cards -->
                <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Detail Button -->
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-100 rounded-xl p-4 flex items-center justify-between shadow-sm">
                        <p class="text-sm text-gray-700">Detail Restoran</p>
                        <button @click="showModal = true"
                            class="bg-green-600 text-white px-3 py-1.5 text-xs rounded-lg hover:bg-green-700 transition-all shadow-sm">
                            Lihat
                        </button>
                    </div>

                    <!-- Location -->
                    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border border-blue-100 rounded-xl p-4 flex items-center justify-between shadow-sm">
                        <div>
                            <p class="text-xs text-gray-600 font-medium">Lokasi</p>
                            <p class="text-sm font-medium text-gray-800 mt-1 truncate">{{$restaurant->location}}</p>
                        </div>
                        <button class="bg-blue-600 text-white px-3 py-1.5 text-xs rounded-lg hover:bg-blue-700 transition-all shadow-sm">
                            Edit
                        </button>
                    </div>

                    <!-- Phone -->
                    <div class="bg-gradient-to-r from-purple-50 to-violet-50 border border-purple-100 rounded-xl p-4 flex items-center justify-between shadow-sm">
                        <div>
                            <p class="text-xs text-gray-600 font-medium">Telepon</p>
                            <p class="text-sm font-medium text-gray-800 mt-1">{{$restaurant->phone_number}}</p>
                        </div>
                        <button class="bg-purple-600 text-white px-3 py-1.5 text-xs rounded-lg hover:bg-purple-700 transition-all shadow-sm">
                            Edit
                        </button>
                    </div>

                    <!-- Notifications -->
                    <div class="bg-white border border-gray-200 rounded-xl p-4 flex items-center justify-between shadow-sm">
                        <div>
                            <p class="text-xs text-gray-600 font-medium">Notifikasi</p>
                            <p class="text-sm font-semibold text-gray-800 mt-1">3 Pesan Baru</p>
                        </div>
                        <button class="relative">
                            <div class="relative">
                                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"></path>
                                </svg>
                                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Section -->
        <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-green-700">Menu Anda</h2>
                <a href="{{ route('restaurant.menus') }}"
                    class="flex items-center text-sm bg-green-600 text-white px-4 py-2 rounded-full hover:bg-green-700 transition-all shadow-sm">
                    <span>Selengkapnya</span>
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            @if ($menus->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($menus as $menu)
                        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all">
                            <div class="relative h-48 overflow-hidden">
                                <img src="/storage/assets/img/menus/{{ $menu->menu_image}}" alt="{{ $menu->name }}"
                                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                                <span class="absolute top-2 right-2 text-xs px-2 py-1 rounded-full font-semibold
                                    {{ $menu->isAvailable ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $menu->isAvailable ? 'Tersedia' : 'Tidak Tersedia' }}
                                </span>
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $menu->name }}</h3>
                                <p class="text-green-700 font-semibold">
                                    Rp {{ number_format($menu->price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada menu</h3>
                    <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan menu pertama Anda.</p>
                    <div class="mt-6">
                        <a href="{{ route('restaurant.menus.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Menu
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Orders Section -->
        <div class="bg-white rounded-2xl shadow-md p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-green-700">Pesanan Masuk</h2>
                <a href="{{ route('restaurant.orders') }}"
                    class="flex items-center text-sm bg-green-600 text-white px-4 py-2 rounded-full hover:bg-green-700 transition-all shadow-sm">
                    <span>Selengkapnya</span>
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            @if ($orders->where('status', 'preparing')->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($orders->where('status', 'preparing') as $order)
                        <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                            <div class="p-4 border-b border-gray-200 bg-gray-50">
                                <div class="flex justify-between items-start">
                                    <h3 class="text-lg font-semibold text-green-700">
                                        #{{ $order->id }} - {{ $order->customer->name }}
                                    </h3>
                                    <span class="px-2 py-1 text-xs font-semibold bg-yellow-100 text-yellow-800 rounded-full">
                                        Preparing
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ $order->created_at->format('d M Y H:i') }}
                                </p>
                            </div>
                            
                            <div class="p-4">
                                <ul class="space-y-2">
                                    @foreach ($order->listOrders as $item)
                                        <li class="flex justify-between text-sm">
                                            <span class="text-gray-700">
                                                {{ $item->menu->name ?? 'Menu dihapus' }} x{{ $item->quantity }}
                                            </span>
                                            <span class="text-gray-900 font-medium">
                                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                                
                                <div class="mt-4 pt-4 border-t border-gray-200">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm font-medium text-gray-700">Total:</span>
                                        <span class="text-lg font-bold text-green-700">
                                            Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                        </span>
                                    </div>
                                    
                                    <p class="mt-2 text-xs text-gray-500">
                                        <span class="font-medium">Catatan:</span> {{ $order->notes ?? '-' }}
                                    </p>
                                </div>
                            </div>
                            
                            <div class="px-4 py-3 bg-gray-50 flex justify-end space-x-2">
                                <form action="{{ route('restaurant.dashboard', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="px-3 py-1.5 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700 transition-all shadow-sm">
                                        Terima
                                    </button>
                                </form>
                                <form action="{{ route('restaurant.dashboard', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="px-3 py-1.5 bg-red-500 text-white text-sm rounded-lg hover:bg-red-600 transition-all shadow-sm">
                                        Tolak
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada pesanan</h3>
                    <p class="mt-1 text-sm text-gray-500">Tidak ada pesanan yang sedang diproses saat ini.</p>
                </div>
            @endif
        </div>

        <!-- Restaurant Detail Modal -->
        <div x-show="showModal" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div @click.away="showModal = false" x-show="showModal"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                class="bg-white rounded-2xl shadow-xl w-full max-w-md max-h-[90vh] overflow-y-auto">
                <!-- Close Button -->
                <button @click="showModal = false"
                    class="absolute top-4 right-4 p-1 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 hover:text-gray-800 transition">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <div class="p-6">
                    <!-- Restaurant Image -->
                    @if ($restaurant->image)
                        <div class="mb-4 rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $restaurant->image) }}" alt="Restaurant Image"
                                class="w-full h-48 object-cover">
                        </div>
                    @endif

                    <h2 class="text-2xl font-bold text-green-700 mb-2">{{ $restaurant->name }}</h2>

                    <div class="space-y-3 text-sm text-gray-700 mb-6">
                        <div class="flex items-start">
                            <svg class="flex-shrink-0 h-5 w-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p><span class="font-medium">Deskripsi:</span> {{ $restaurant->description ?? '-' }}</p>
                        </div>
                        <div class="flex items-start">
                            <svg class="flex-shrink-0 h-5 w-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <p><span class="font-medium">Alamat:</span> {{ $restaurant->location }}</p>
                        </div>
                        <div class="flex items-start">
                            <svg class="flex-shrink-0 h-5 w-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <p><span class="font-medium">Telepon:</span> {{ $restaurant->phone_number }}</p>
                        </div>
                        <div class="flex items-start">
                            <svg class="flex-shrink-0 h-5 w-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <p><span class="font-medium">Email:</span> {{ $restaurant->email }}</p>
                        </div>
                        <div class="flex items-start">
                            <svg class="flex-shrink-0 h-5 w-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            <p><span class="font-medium">Kategori:</span> {{ $restaurant->category->name ?? 'Tidak diketahui' }}</p>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                        <a href="{{ route('restaurant.edit', $restaurant->id) }}"
                            class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition flex items-center shadow-sm">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('restaurant.delete', $restaurant->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus restoran ini?')"
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition flex items-center shadow-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection