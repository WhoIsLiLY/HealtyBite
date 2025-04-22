@extends('layouts.main')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Menu</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($foods as $food)
            <div class="bg-white p-4 rounded-lg shadow-md">
                <img src="{{ $food->image }}" alt="{{ $food->name }}" class="w-full h-40 object-cover rounded-md mb-3">
                <h3 class="text-lg font-semibold">{{ $food->name }}</h3>
                <p class="text-gray-600">Price: Rp{{ number_format($food->price, 0, ',', '.') }}</p>
                <a href="{{ route('customize', $food->id) }}" class="mt-2 text-blue-600 hover:underline">Customize</a>
            </div>
        @endforeach
    </div>
@endsection
