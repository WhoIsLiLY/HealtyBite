@extends('layouts.main') 

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Laporan Restoran</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-500">Total Omzet</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">Rp {{ number_format($totalOmzet, 0, ',', '.') }}</p>
            <p class="text-sm text-gray-400">Dari pesanan yang selesai</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-500">Total Transaksi</h3>
            <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalTransaksi }}</p>
            <p class="text-sm text-gray-400">Jumlah pesanan berhasil</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        
        <div>
            <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                <h3 class="text-xl font-bold text-gray-700 mb-4">Member Teraktif (Top 5)</h3>
                <ul class="space-y-3">
                    @forelse ($memberTeraktif as $member)
                        <li class="flex justify-between items-center">
                            <span class="text-gray-600">{{ $member->customer->name ?? 'Customer Dihapus' }}</span>
                            <span class="font-semibold text-blue-500 bg-blue-100 px-2 py-1 rounded">{{ $member->total_orders }} Pesanan</span>
                        </li>
                    @empty
                        <p class="text-gray-500">Belum ada data pesanan.</p>
                    @endforelse
                </ul>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-bold text-gray-700 mb-4">Member dengan Pembelian Terbanyak (Top 5)</h3>
                <ul class="space-y-3">
                    @forelse ($memberTopSpender as $member)
                        <li class="flex justify-between items-center">
                            <span class="text-gray-600">{{ $member->customer->name ?? 'Customer Dihapus' }}</span>
                            <span class="font-semibold text-green-500 bg-green-100 px-2 py-1 rounded">Rp {{ number_format($member->total_spent, 0, ',', '.') }}</span>
                        </li>
                    @empty
                        <p class="text-gray-500">Belum ada data pesanan.</p>
                    @endforelse
                </ul>
            </div>
        </div>

        <div>
            <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                <h3 class="text-xl font-bold text-gray-700 mb-4">Produk Terlaris (Top 5)</h3>
                <ul class="space-y-3">
                    @forelse ($produkTerlaris as $menu)
                        <li class="flex justify-between items-center">
                            <span class="text-gray-600">{{ $menu->name }}</span>
                            <span class="font-semibold text-purple-500 bg-purple-100 px-2 py-1 rounded">{{ $menu->sales_count }}x terjual</span>
                        </li>
                    @empty
                        <p class="text-gray-500">Belum ada produk yang terjual.</p>
                    @endforelse
                </ul>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-bold text-gray-700 mb-4">Produk Perlu Perhatian (Paling Sedikit Terjual)</h3>
                <ul class="space-y-3">
                     @forelse ($produkPerluEndorse as $menu)
                        <li class="flex justify-between items-center">
                            <span class="text-gray-600">{{ $menu->name }}</span>
                            <span class="font-semibold text-red-500 bg-red-100 px-2 py-1 rounded">{{ $menu->sales_count }}x terjual</span>
                        </li>
                    @empty
                        <p class="text-gray-500">Semua produk memiliki penjualan.</p>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection