@extends('layouts.main')

@section('content')
<div class="bg-gray-50/50 min-h-screen p-4 sm:p-6 lg:p-8">
    <div class="max-w-7xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Laporan Restoran</h1>
            <p class="text-gray-500 mt-1">Analisis performa penjualan dan interaksi pelanggan.</p>

            <div class="mt-4 flex items-center space-x-2">
                <button class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow-sm hover:bg-blue-700">Bulan Ini</button>
                <button class="px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50">Bulan Lalu</button>
                <button class="px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50">Semua Waktu</button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200/50 flex items-start justify-between">
                <div>
                    <h3 class="text-base font-semibold text-gray-500">Total Omzet</h3>
                    <p class="text-3xl font-bold text-green-600 mt-2">Rp {{ number_format($totalOmzet, 0, ',', '.') }}</p>
                    <p class="text-xs text-gray-400 mt-1">Dari pesanan yang selesai</p>
                </div>
                <div class="bg-green-100 p-2 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01"></path></svg>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200/50 flex items-start justify-between">
                <div>
                    <h3 class="text-base font-semibold text-gray-500">Total Transaksi</h3>
                    <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalTransaksi }}</p>
                    <p class="text-xs text-gray-400 mt-1">Jumlah pesanan berhasil</p>
                </div>
                 <div class="bg-blue-100 p-2 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200/50 flex items-start justify-between">
                <div>
                    <h3 class="text-base font-semibold text-gray-500">Rata-rata/Transaksi</h3>
                    <p class="text-3xl font-bold text-indigo-600 mt-2">Rp {{ $totalTransaksi > 0 ? number_format($totalOmzet / $totalTransaksi, 0, ',', '.') : 0 }}</p>
                    <p class="text-xs text-gray-400 mt-1">Nilai pesanan rata-rata</p>
                </div>
                 <div class="bg-indigo-100 p-2 rounded-lg">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200/50 flex items-start justify-between">
                <div>
                    <h3 class="text-base font-semibold text-gray-500">Pelanggan Unik</h3>
                    <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $memberTeraktif->count() }}</p>
                    <p class="text-xs text-gray-400 mt-1">Total pelanggan bertransaksi</p>
                </div>
                 <div class="bg-yellow-100 p-2 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <div class="space-y-8">
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200/50">
                    <h3 class="text-xl font-bold text-gray-700 mb-4 flex items-center"><svg class="w-6 h-6 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>Produk Terlaris (Top 5)</h3>
                    <ul class="space-y-4">
                        @forelse ($produkTerlaris as $menu)
                            <li class="flex justify-between items-center text-sm">
                                <span class="text-gray-600">{{ $menu->name }}</span>
                                <span class="font-semibold text-purple-600 bg-purple-100 px-3 py-1 rounded-full">{{ $menu->sales_count }}x terjual</span>
                            </li>
                        @empty
                            <p class="text-gray-500 text-sm">Belum ada produk yang terjual.</p>
                        @endforelse
                    </ul>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200/50">
                    <h3 class="text-xl font-bold text-gray-700 mb-4 flex items-center"><svg class="w-6 h-6 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path></svg>Produk Perlu Perhatian</h3>
                    <ul class="space-y-4">
                        @forelse ($produkPerluEndorse as $menu)
                            <li class="flex justify-between items-center text-sm">
                                <span class="text-gray-600">{{ $menu->name }}</span>
                                <span class="font-semibold text-red-600 bg-red-100 px-3 py-1 rounded-full">{{ $menu->sales_count }}x terjual</span>
                            </li>
                        @empty
                            <p class="text-gray-500 text-sm">Semua produk memiliki penjualan.</p>
                        @endforelse
                    </ul>
                </div>
            </div>

            <div class="space-y-8">
                 <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200/50">
                    <h3 class="text-xl font-bold text-gray-700 mb-4 flex items-center"><svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>Member Teraktif (Top 5)</h3>
                    <ul class="space-y-4">
                        @forelse ($memberTeraktif as $member)
                            <li class="flex justify-between items-center text-sm">
                                <span class="text-gray-600">{{ $member->customer->name ?? 'Customer Dihapus' }}</span>
                                <span class="font-semibold text-blue-600 bg-blue-100 px-3 py-1 rounded-full">{{ $member->total_orders }} Pesanan</span>
                            </li>
                        @empty
                            <p class="text-gray-500 text-sm">Belum ada data pesanan.</p>
                        @endforelse
                    </ul>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200/50">
                    <h3 class="text-xl font-bold text-gray-700 mb-4 flex items-center"><svg class="w-6 h-6 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01"></path></svg>Member Top Spender (Top 5)</h3>
                    <ul class="space-y-4">
                        @forelse ($memberTopSpender as $member)
                            <li class="flex justify-between items-center text-sm">
                                <span class="text-gray-600">{{ $member->customer->name ?? 'Customer Dihapus' }}</span>
                                <span class="font-semibold text-green-600 bg-green-100 px-3 py-1 rounded-full">Rp {{ number_format($member->total_spent, 0, ',', '.') }}</span>
                            </li>
                        @empty
                            <p class="text-gray-500 text-sm">Belum ada data pesanan.</p>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection