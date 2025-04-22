<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthy Food Ordering</title>
    @vite('resources/css/app.css') <!-- Gunakan Tailwind atau stylesheet lainnya -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100">
    @include('partials.navbar')
    
    @yield('content')

    @include('partials.footer')

    @stack('scripts') <!-- Untuk menambahkan JS atau script tambahan -->
</body>
</html>
