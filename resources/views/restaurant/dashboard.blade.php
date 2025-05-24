@extends('layouts.main')

@section('content')
    <div class="min-h-screen bg-gray-100 px-4 pt-4 pb-20" x-data="{ showModal: false }">

        <!-- Header -->
        <div class="bg-white rounded-xl shadow p-4 mb-6 flex flex-col lg:items-center lg:justify-between">
            <!-- User Greeting -->
            <div class="w-full mb-4 lg:mb-0 align-left p-4">
                <h2 class="text-sm text-gray-500">Selamat Datang,</h2>
                <h1 class="text-2xl font-bold text-green-600">{{ $restaurant->name }} 👋</h1>
            </div>
            <!-- Wallet Info -->
            <div class="w-full flex-1 lg:ml-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                <!-- Detail Button -->
                <div class="bg-green-50 border border-green-200 rounded-xl p-4 flex items-center justify-between">
                    <p class="text-sm text-gray-700">Lihat Detail Restoran</p>
                    <button @click="showModal = true"
                        class="bg-green-600 text-white px-3 py-1 text-sm rounded-full hover:bg-green-700 transition">
                        Detail
                    </button>
                </div>

                <!-- Saldo -->
                <div class="bg-green-50 border border-green-200 rounded-xl p-4 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Location</p>
                        <p class="text-lg font-bold text-green-700">{{$restaurant->location}}</p>
                    </div>
                    <button class="bg-green-600 text-white px-3 py-1 text-sm rounded-full hover:bg-green-700 transition">
                        Edit
                    </button>
                </div>

                <!-- Poin -->
                <div class="bg-green-50 border border-green-200 rounded-xl p-4 flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Phone Number</p>
                        <p class="text-lg font-bold text-green-700">{{$restaurant->phone_number}}</p>
                    </div>
                    <button class="bg-green-600 text-white px-3 py-1 text-sm rounded-full hover:bg-green-700 transition">
                        Edit
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

        <!-- Menu Title -->
        <div class="bg-white rounded-xl shadow p-4 mb-6 flex items-center justify-between items-start relative">
            <div class="w-full">
                <h2 class="text-2xl font-bold text-green-600">Menu Anda</h2>
                <!-- Menu Cards -->
                @if ($menus->count())
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
                        @foreach ($menus as $menu)
                            <div
                                class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow hover:shadow-lg transition">
                                <img src="{{ asset('storage/' . $menu->menu_image) }}" alt="{{ $menu->name }}"
                                    class="w-full h-40 object-cover">
                                <div class="p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <h3 class="text-lg font-bold text-green-800">{{ $menu->name }}</h3>
                                        <span
                                            class="text-xs px-2 py-1 rounded-full font-semibold
                                                                        {{ $menu->isAvailable ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            {{ $menu->isAvailable ? 'Tersedia' : 'Tidak Tersedia' }}
                                        </span>
                                    </div>
                                    <p class="text-green-700 font-semibold mt-2">
                                        Rp {{ number_format($menu->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500 mt-2">Belum ada menu yang dibuat.</p>
                @endif
            </div>
            <a href="{{ route('restaurant.menus') }}"
                class="absolute top-4 right-4 bg-green-600 text-white px-4 py-2 text-sm rounded-full hover:bg-green-700 transition">
                Selengkapnya
            </a>
        </div>

        <!-- Order Title -->
        <div class="bg-white rounded-xl shadow p-4 mb-6 flex items-center justify-between items-start relative">
            <div>
                <h2 class="text-2xl font-bold text-green-600">Order Anda</h2>
                <!-- Order Cards -->
                @if ($orders->where('status', 'preparing')->count())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                        @foreach ($orders->where('status', 'preparing') as $order)
                            <div class="bg-white rounded-xl shadow p-4 border border-green-200">
                                <h3 class="text-lg font-semibold text-green-700 mb-2">
                                    Order #{{ $order->id }} - {{ $order->customer->name }}
                                </h3>
                                <p>Status: <span class="text-yellow-600 font-medium">Preparing</span></p>
                                <p>Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                <p class="text-sm text-gray-600">Catatan: {{ $order->notes ?? '-' }}</p>

                                <ul class="list-disc pl-5 my-2 text-sm text-gray-700">
                                    @foreach ($order->listOrders as $item)
                                        <li>
                                            {{ $item->menu->name ?? 'Menu dihapus' }} x{{ $item->quantity }} -
                                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="flex justify-end gap-2 mt-4">
                                    <form action="{{ route('restaurant.dashboard', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="bg-green-600 text-white px-4 py-1 rounded-full text-sm hover:bg-green-700 transition">
                                            Accept
                                        </button>
                                    </form>
                                    <form action="{{ route('restaurant.dashboard', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="bg-red-500 text-white px-4 py-1 rounded-full text-sm hover:bg-red-600 transition">
                                            Decline
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500 mt-2">Tidak ada pesanan yang sedang diproses.</p>
                @endif
            </div>
            <a href="{{ route('restaurant.orders') }}"
                class="absolute top-4 right-4 bg-green-600 text-white px-4 py-2 text-sm rounded-full hover:bg-green-700 transition">
                Selengkapnya
            </a>
        </div>

        <!-- <div class="max-w-4xl mx-auto text-center">

                                                <h2 class="text-4xl font-extrabold text-green-800 mb-4">
                                                    Welcome to Healthy Food Ordering
                                                </h2>
                                                <p class="text-lg text-green-900 mb-6">
                                                    Order healthy and delicious food easily!
                                                </p>
                                                <p class="text-md text-gray-700 font-medium mb-8">
                                                    <span class="font-semibold text-green-700">Today's Revenue:</span> Rp {{ $dailyRevenue }}
                                                </p>

                                                <div class="flex flex-wrap justify-center gap-4">
                                                    <a href="{{ route('restaurant.orders.top') }}"
                                                        class="bg-green-600 text-white font-semibold px-5 py-3 rounded-xl hover:bg-green-700 transition">
                                                        Top Order
                                                    </a>
                                                    <a href="{{ route('restaurant.menus.top') }}"
                                                        class="bg-green-600 text-white font-semibold px-5 py-3 rounded-xl hover:bg-green-700 transition">
                                                        Top Menu
                                                    </a>
                                                    <a href="{{ route('restaurant.reviews') }}"
                                                        class="bg-green-600 text-white font-semibold px-5 py-3 rounded-xl hover:bg-green-700 transition">
                                                        Reviews
                                                    </a>
                                                    <a href="{{ route('restaurant.orders.payment') }}"
                                                        class="bg-green-600 text-white font-semibold px-5 py-3 rounded-xl hover:bg-green-700 transition">
                                                        Orders by Payment
                                                    </a>
                                                </div>
                                            </div> -->
        <!-- Modal -->
        <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-md relative">
                <!-- Close Button -->
                <button @click="showModal = false"
                    class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 text-xl">&times;</button>

                <!-- Restaurant Image -->
                @if ($restaurant->image)
                    <img src="{{ asset('storage/' . $restaurant->image) }}" alt="Restaurant Image"
                        class="w-full h-40 object-cover rounded-lg mb-4">
                @endif

                <h2 class="text-xl font-bold mb-2 text-green-700">{{ $restaurant->name }}</h2>

                <p class="mb-1"><strong>Deskripsi:</strong> {{ $restaurant->description ?? '-' }}</p>
                <p class="mb-1"><strong>Alamat:</strong> {{ $restaurant->location }}</p>
                <p class="mb-1"><strong>Kategori:</strong> {{ $restaurant->category->name ?? 'Tidak diketahui' }}</p>
                <p class="mb-1"><strong>No. Telepon:</strong> {{ $restaurant->phone_number }}</p>
                <p class="mb-4"><strong>Email:</strong> {{ $restaurant->email }}</p>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('restaurant.edit', $restaurant->id) }}"
                        class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                        Edit
                    </a>

                    <form action="{{ route('restaurant.delete', $restaurant->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus restoran ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection