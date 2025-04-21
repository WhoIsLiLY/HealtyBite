@extends('layouts.main')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Customize Your Order</h2>
    <form action="/checkout" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="size" class="block text-sm font-medium">Select Size</label>
            <select id="size" name="size" class="w-full p-2 border border-gray-300 rounded-md">
                <option value="small">Small</option>
                <option value="medium">Medium</option>
                <option value="large">Large</option>
            </select>
        </div>

        <div>
            <label for="allergies" class="block text-sm font-medium">Allergies</label>
            <input type="text" id="allergies" name="allergies" placeholder="List your allergies (if any)" class="w-full p-2 border border-gray-300 rounded-md">
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Proceed to Checkout</button>
    </form>
@endsection
