@extends('layouts.main')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-green-50 to-blue-50 py-20 px-4 md:px-10 rounded-3xl shadow-sm">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-6 leading-tight">
                Discover Healthy <span class="bg-clip-text text-transparent bg-gradient-to-r from-green-600 to-blue-500">Dining Options</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                Order nutritious meals from our partner restaurants that care about your health and wellbeing.
            </p>
            <div class="relative max-w-md mx-auto">
                <input type="text" placeholder="Search restaurants..." 
                       class="w-full py-3 px-5 pr-12 rounded-full border border-gray-200 focus:outline-none focus:ring-2 focus:ring-green-400 shadow-sm">
                <svg class="absolute right-4 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>
    </section>

    <!-- Restaurant Listing -->
    <section class="py-16 px-4 md:px-10">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-10">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Featured Restaurants</h2>
                <div class="flex space-x-2">
                    <button class="filter-btn active px-4 py-2 bg-green-600 text-white rounded-full text-sm font-medium" data-filter="all">All</button>
                    <button class="filter-btn px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-full text-sm font-medium transition" data-filter="organic">Organic</button>
                    <button class="filter-btn px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-full text-sm font-medium transition" data-filter="vegan">Vegan</button>
                    <button class="filter-btn px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-full text-sm font-medium transition" data-filter="keto">Keto</button>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($restaurants as $restaurant)
                    <div class="restaurant-card bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                         data-category="{{ $restaurant->category }}">
                        <div class="relative overflow-hidden h-56">
                            <img src="/storage/assets/img/restaurants/{{ $restaurant->restaurant_image }}" alt="{{ $restaurant->name }}"
                                class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                            <div class="absolute top-4 left-4 bg-white bg-opacity-90 px-3 py-1 rounded-full shadow-sm">
                                <span class="text-sm font-medium text-gray-800">{{ $restaurant->category->name }}</span>
                            </div>
                            <div class="absolute top-4 right-4">
                                <button class="heart-btn p-2 bg-white bg-opacity-80 rounded-full shadow-sm hover:bg-red-100 transition">
                                    <svg class="w-5 h-5 text-gray-400 hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-xl font-bold text-gray-800">{{ $restaurant->name }}</h3>
                                <div class="flex items-center bg-green-50 px-2 py-1 rounded">
                                    <svg class="w-4 h-4 text-green-600 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-xs font-medium text-green-600">Verified</span>
                                </div>
                            </div>
                            <p class="text-gray-600 mb-4">{{ Str::limit($restaurant->description, 100) }}</p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-gray-700 ml-1">{{ $restaurant->rating }}</span>
                                    <span class="text-sm text-gray-500 ml-1">({{ $restaurant->review_count }})</span>
                                </div>
                                <a href="/customer/restaurant/{{ $restaurant->id }}" 
                                   class="order-btn inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-blue-500 text-white rounded-full hover:shadow-md transition-all transform hover:scale-105"
                                   data-restaurant-id="{{ $restaurant->id }}">
                                    Order Now
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 text-center">
                <button class="px-6 py-3 bg-white border border-gray-200 rounded-full text-gray-700 font-medium hover:bg-gray-50 hover:shadow-sm transition">
                    Load More Restaurants
                </button>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    const basketRestaurantId = {{ $basket->restaurant_id ?? 'null' }};

    // Restaurant filtering
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active', 'bg-green-600', 'text-white'));
            this.classList.add('active', 'bg-green-600', 'text-white');
            
            const filter = this.dataset.filter;
            document.querySelectorAll('.restaurant-card').forEach(card => {
                if (filter === 'all' || card.dataset.category === filter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // Order button with basket check
    document.querySelectorAll('.order-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const selectedRestaurantId = parseInt(this.dataset.restaurantId);
            const href = this.href;

            if (basketRestaurantId && basketRestaurantId !== selectedRestaurantId) {
                Swal.fire({
                    title: 'Your basket contains items from another restaurant',
                    text: "If you continue, your basket will be cleared. Do you want to proceed?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#10B981',
                    cancelButtonColor: '#6B7280',
                    confirmButtonText: 'Yes, continue',
                    cancelButtonText: 'No, keep items'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            } else {
                window.location.href = href;
            }
        });
    });

    // Favorite button toggle
    document.querySelectorAll('.heart-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const heartIcon = this.querySelector('svg');
            heartIcon.classList.toggle('text-red-500');
            heartIcon.classList.toggle('fill-current');
        });
    });
</script>
@endpush

@push('styles')
<style>
    .restaurant-card:hover .heart-btn svg {
        color: #EF4444;
    }
    .heart-btn svg.fill-current {
        fill: #EF4444;
    }
    .filter-btn.active {
        box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.2), 0 2px 4px -1px rgba(16, 185, 129, 0.12);
    }
</style>
@endpush