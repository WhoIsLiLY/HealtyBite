@extends('layouts.admin')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Admin Dashboard</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold">Total Orders</h3>
            <p class="text-xl">{{ $totalOrders }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold">Total Revenue</h3>
            <p class="text-xl">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold">Top Product</h3>
            <p class="text-xl">{{ $topProduct }}</p>
        </div>
    </div>
@endsection
