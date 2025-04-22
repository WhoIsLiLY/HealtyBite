@extends('layouts.main')

@section('content')
    <h2 class="text-3xl font-bold mb-6">Welcome to Healthy Food Ordering</h2>
    <p class="mb-4">Order healthy and delicious food easily!</p>
    <p class="mb-4">Today Revenue: {{$dailyRevenue}}</p>
    <a href="{{ route('restaurant.orders.top') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Top Order</a>
    <a href="{{ route('restaurant.menu.top') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Top Menu</a>
    <a href="{{ route('restaurant.reviews') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Review</a>
    <a href="{{ route('restaurant.orders.payment') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Order By Payment</a>

@endsection
