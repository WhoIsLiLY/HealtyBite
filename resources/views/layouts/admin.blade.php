<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-800 text-white">
    @include('partials.admin_navbar')

    <div class="container mx-auto py-8">
        @yield('content')
    </div>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>
