@extends('layouts.admin')

@section('content')
    <h2 class="text-3xl font-bold text-gray-800 mb-8">Admin Dashboard</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Total Orders -->
        <div class="bg-gradient-to-r from-blue-100 to-blue-200 p-6 rounded-2xl shadow hover:shadow-lg transition duration-300">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-semibold text-blue-900">Total Orders</h3>
                <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M3 3h18v18H3z" />
                </svg>
            </div>
            <p class="text-3xl font-bold text-blue-800">{{ $totalOrders }}</p>
        </div>

        <!-- Total Revenue -->
        <div class="bg-gradient-to-r from-green-100 to-green-200 p-6 rounded-2xl shadow hover:shadow-lg transition duration-300">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-semibold text-green-900">Total Revenue</h3>
                <svg class="w-6 h-6 text-green-700" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M12 8c-2.5 0-4 1.5-4 4s1.5 4 4 4 4-1.5 4-4-1.5-4-4-4z" />
                    <path d="M12 2v2m0 16v2m8-8h2M2 12H0m17.657-6.343l1.414-1.414M4.929 19.071l-1.414 1.414M19.071 19.071l1.414-1.414M4.929 4.929L3.515 3.515" />
                </svg>
            </div>
            <p class="text-3xl font-bold text-green-800">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>

        <!-- Top Product -->
        <div class="bg-gradient-to-r from-purple-100 to-purple-200 p-6 rounded-2xl shadow hover:shadow-lg transition duration-300">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-semibold text-purple-900">Top Product</h3>
                <svg class="w-6 h-6 text-purple-700" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.26" />
                </svg>
            </div>
            <p class="text-2xl font-bold text-purple-800">{{ $topProduct }}</p>
        </div>
    </div>
@endsection
