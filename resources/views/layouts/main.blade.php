<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Healthy Food Ordering</title>
    @vite('resources/css/app.css') <!-- Gunakan Tailwind atau stylesheet lainnya -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-100">
    @include('partials.navbar')

    @yield('content')

    @include('partials.footer')

    @stack('scripts') <!-- Untuk menambahkan JS atau script tambahan -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>

</html>