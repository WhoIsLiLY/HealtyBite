@if (auth('customer')->check())
    <!-- Bottom Navigation -->
    <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 flex justify-around py-2">
        <a href="/customer/dashboard" class="flex flex-col items-center text-green-600">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m0 0H5a2 2 0 01-2-2v-5m14 7v-8m0 0l2 2m-2-2l-7-7"></path>
            </svg>
            <span class="text-xs">Home</span>
        </a>
        <a href="/customer/restaurants" class="flex flex-col items-center text-gray-500">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M5 13l4 4L19 7"></path>
            </svg>
            <span class="text-xs">Resto</span>
        </a>
        <a href="#" class="flex flex-col items-center text-gray-500">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M5 13l4 4L19 7"></path>
            </svg>
            <span class="text-xs">Pesanan</span>
        </a>
        <a href="#" class="flex flex-col items-center text-gray-500">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M20 21v-2a4 4 0 00-3-3.87M4 7V5a4 4 0 014-4h8a4 4 0 014 4v2"></path>
            </svg>
            <span class="text-xs">Akun</span>
        </a>
    </div>
@else
    <footer class="bg-gray-700 text-white p-4 text-center">
        <p>&copy; 2025 Healthy Food Ordering System. All rights reserved.</p>
    </footer>
@endif
