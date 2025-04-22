<nav class="bg-green-600 p-4">
    <div class="flex justify-between items-center">
        <a href="/" class="text-white font-bold text-xl">Healthy Food</a>

        <div>
            @if (auth('customer')->check() || auth('admin')->check())
                <!-- Sudah login -->
                @if (auth('customer')->check())
                    <a href="/menu" class="text-white mx-4">Menu</a>
                    <a href="/orders" class="text-white mx-4">Orders</a>
                @elseif(auth('admin')->check())
                    <a href="/dashboard" class="text-white mx-4">Dashboard</a>
                    <a href="/manage-menu" class="text-white mx-4">Manage Menu</a>
                    <a href="/manage-orders" class="text-white mx-4">Manage Orders</a>
                @endif
                <!-- Tombol Logout -->
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-white hover:underline">Logout</button>
                </form>
            @else
                <!-- Belum login -->
                <a href="{{ route('customer.login') }}" class="text-white mx-4">Login</a>
            @endif
        </div>
    </div>
</nav>
