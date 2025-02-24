<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>

    <!-- CSS Libraries -->
    @vite(['resources/css/app.css'])
    @stack('styles') {{-- Untuk menambahkan CSS khusus di halaman lain --}}
</head>
<body class="">

    <!-- Navbar -->
    @yield('navbar')

    <!-- Content -->
    <div class="container mt-4">
        @yield('content')
    </div>
    
    @vite(['resources/js/app.js']) {{-- Jika menggunakan Vite --}}
    
    @stack('scripts') {{-- Untuk menambahkan JS khusus di halaman lain --}}
</body>
</html>
