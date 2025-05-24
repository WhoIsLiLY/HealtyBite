<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Registration</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">
    <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-xl">
        <h2 class="text-3xl font-bold text-center text-blue-600 mb-6">Register Your Restaurant</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4 text-center">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="bg-red-100 text-red-800 p-4 rounded mb-4 text-center">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.register.create') }}" enctype="multipart/form-data"
            class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block font-medium text-gray-700">Restaurant Name</label>
                <input id="name" type="text" name="name" required value="{{ old('name') }}"
                    class="mt-1 w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="location" class="block font-medium text-gray-700">Location</label>
                <input id="location" type="text" name="location" required value="{{ old('location') }}"
                    class="mt-1 w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="description" class="block font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="3"
                    class="mt-1 w-full p-2 border rounded resize-none focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
            </div>

            <div>
                <label for="restaurant_category" class="block font-medium text-gray-700">Restaurant Category</label>
                <input id="restaurant_category" type="text" name="restaurant_category" required
                    value="{{ old('restaurant_category') }}"
                    class="mt-1 w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="image" class="block font-medium text-gray-700">Restaurant Image</label>
                <input id="image" type="file" name="image" accept="image/*"
                    class="mt-1 w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
            </div>

            <div>
                <label for="email" class="block font-medium text-gray-700">Email</label>
                <input id="email" type="email" name="email" required value="{{ old('email') }}"
                    class="mt-1 w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="phone_number" class="block font-medium text-gray-700">Phone Number</label>
                <input id="phone_number" type="text" name="phone_number" required value="{{ old('phone_number') }}"
                    class="mt-1 w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="password" class="block font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password" required
                    class="mt-1 w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white font-semibold py-2 rounded hover:bg-blue-700 transition duration-200">
                Register
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Already have an account?
            <a href="{{ route('admin.login') }}" class="text-blue-600 hover:underline">Login here</a>.
        </p>
    </div>
</body>

</html>