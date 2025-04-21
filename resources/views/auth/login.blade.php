@extends('layouts.main')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Login</h2>
    <form action="{{ route('login') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="email" class="block text-sm font-medium">Email</label>
            <input type="email" id="email" name="email" class="w-full p-2 border border-gray-300 rounded-md" required>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium">Password</label>
            <input type="password" id="password" name="password" class="w-full p-2 border border-gray-300 rounded-md" required>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Login</button>
    </form>
@endsection
