@extends('layouts.main')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Checkout</h2>
    <div class="mb-4">
        <p class="text-lg">Your Order: {{ $food->name }}</p>
        <p>Size: {{ $size }}</p>
        <p>Allergies: {{ $allergies ?? 'None' }}</p>
    </div>

    <a href="/payment" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Proceed to Payment</a>
    
@endsection