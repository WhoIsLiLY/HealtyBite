<nav class="sticky z-50 py-6 px-6 md:px-12 flex justify-between items-center bg-gradient-to-br from-white to-green-50">
    <!-- Logo/Brand -->
    <div class="flex-shrink-0 flex items-center">
        <a href="/" class="flex items-center space-x-2">
            <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                    clip-rule="evenodd"></path>
            </svg>
            <span
                class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-green-600 to-blue-500">HealthyBite</span>
        </a>
    </div>
    <!-- Desktop Navigation -->
    <div class="hidden md:flex items-center space-x-8">
        @if (auth('customer')->check() || auth('admin')->check())
            <!-- Authenticated Links -->
            @if (auth('customer')->check())
                <a href="/customer/restaurants"
                    class="text-gray-700 hover:text-green-600 font-medium transition duration-300 relative group">
                    Restaurant
                    <span
                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-green-600 transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="/orders"
                    class="text-gray-700 hover:text-green-600 font-medium transition duration-300 relative group">
                    Orders
                    <span
                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-green-600 transition-all duration-300 group-hover:w-full"></span>
                </a>
            @elseif(auth('admin')->check())
                <a href="/"
                    class="text-gray-700 hover:text-green-600 font-medium transition duration-300 relative group">
                    Dashboard
                    <span
                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-green-600 transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="/restaurant/menu"
                    class="text-gray-700 hover:text-green-600 font-medium transition duration-300 relative group">
                    Manage Menu
                    <span
                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-green-600 transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="/restaurant/orders"
                    class="text-gray-700 hover:text-green-600 font-medium transition duration-300 relative group">
                    Manage Orders
                    <span
                        class="absolute bottom-0 left-0 w-0 h-0.5 bg-green-600 transition-all duration-300 group-hover:w-full"></span>
                </a>
            @endif

            <!-- User Dropdown -->
            <div class="relative ml-4">
                <button id="user-menu-button" class="flex items-center space-x-2 focus:outline-none">
                    <span class="text-gray-700 font-medium">{{ auth('customer')->name }}</span>
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div id="user-dropdown"
                    class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-300">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        @else
            <!-- Guest Links -->
            <button id="openLoginModal"
                class="hidden md:block px-4 py-2 text-gray-700 hover:text-green-600 font-medium transition">
                Login
            </button>
            <button
                class="px-4 py-2 bg-gradient-to-r from-green-500 to-blue-500 text-white rounded-full font-medium hover:shadow-lg transition-all transform hover:scale-105">
                Sign Up
            </button>
        @endif
    </div>

    <!-- Mobile menu button -->
    <div class="md:hidden flex items-center">
        <button id="mobile-menu-button" class="text-gray-700 hover:text-green-600 focus:outline-none">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>
    </div>
</nav>

<script>
    // Toggle mobile menu
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });

    // Toggle user dropdown
    document.getElementById('user-menu-button').addEventListener('click', function() {
        const dropdown = document.getElementById('user-dropdown');
        dropdown.classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('user-dropdown');
        const button = document.getElementById('user-menu-button');

        if (!button.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>
