@extends('layouts.main')

@section('content')
    <section class="bg-green-50 py-10 px-4 md:px-10 rounded-2xl shadow-inner h-[87vh] flex justify-center items-center">
        <div class="max-w-4xl mx-auto text-center">
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
                <a href="{{ route('restaurant.menu.top') }}"
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
        </div>
    </section>
@endsection
