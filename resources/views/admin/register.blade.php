<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Registration</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">Register Restaurant</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.register.create') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700">Restaurant Name</label>
                <input type="text" name="name" required class="w-full p-2 border rounded" value="{{ old('name') }}">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Location</label>
                <input type="text" name="location" required class="w-full p-2 border rounded"
                    value="{{ old('location') }}">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Restaurant Category</label>
                <input type="text" name="restaurant_category" required class="w-full p-2 border rounded"
                    value="{{ old('restaurant_category') }}">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" required class="w-full p-2 border rounded" value="{{ old('email') }}">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Phone Number</label>
                <input type="text" name="phone_number" required class="w-full p-2 border rounded"
                    value="{{ old('phone_number') }}">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password" required class="w-full p-2 border rounded">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                Register
            </button>
        </form>

        <p class="mt-4 text-center text-sm">
            Already have an account? <a href="{{ route('admin.login') }}" class="text-blue-600 hover:underline">Login
                here</a>.
        </p>
    </div>
</body>

</html>