<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Healthy Food Ordering</title>
    @vite('resources/css/app.css') <!-- Gunakan Tailwind atau stylesheet lainnya -->
</head>
<body class="bg-gray-100 text-gray-900 font-sans antialiased">
    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
