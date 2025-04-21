<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthy Food Ordering</title>
    @vite('resources/css/app.css') <!-- Gunakan Tailwind atau stylesheet lainnya -->
</head>
<body class="bg-gray-100">
    @include('partials.navbar')

    <div class="container mx-auto py-8">
        @yield('content')
    </div>

    @include('partials.footer')

    @stack('scripts') <!-- Untuk menambahkan JS atau script tambahan -->
</body>
</html>
