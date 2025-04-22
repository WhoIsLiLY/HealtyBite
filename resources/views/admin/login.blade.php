@extends('layouts.main')

@section('content')
    <div class="flex justify-center items-center min-h-screen bg-gradient-to-r from-green-400 to-blue-500">
        <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-sm">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Login</h2>
            <form action="{{ route('admin.login') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-semibold">Email</label>
                    <input type="email" id="email" name="email"
                        class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 bg-white text-gray-800"
                        required>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                    <input type="password" id="password" name="password"
                        class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 bg-white text-gray-800"
                        required>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="w-full py-3 bg-green-600 text-white text-lg font-semibold rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-600 transition duration-300">
                        Login
                    </button>
                </div>

                <!-- Forgot Password Link -->
                <div class="text-center text-sm">
                    <a href="" class="text-green-600 hover:underline">Forgot Password?</a>
                </div>
            </form>
        </div>
    </div>
@endsection
