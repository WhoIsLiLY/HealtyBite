@if (auth('customer')->check())

@elseif(auth('admin')->check())
    <footer class="bg-gray-700 text-white p-4 text-center">
        <p>&copy; 2025 Healthy Food Ordering System. All rights reserved.</p>
    </footer>
@endif
