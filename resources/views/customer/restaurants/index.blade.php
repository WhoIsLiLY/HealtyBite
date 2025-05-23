@extends('layouts.main')

@section('content')
    <section class="bg-green-50 py-16 px-4 md:px-10 rounded-2xl shadow-inner text-center">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-4xl md:text-5xl font-extrabold text-green-800 mb-6 leading-tight">
                Welcome to Healthy Food Ordering
            </h2>
            <p class="text-lg md:text-xl text-green-900 mb-8">
                Order healthy and delicious food from top-rated restaurants with just a few clicks!
            </p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($restaurants as $restaurant)
                <div
                    class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition transform hover:scale-[1.02] duration-300">
                    <div class="overflow-hidden">
                        <img src="{{ $restaurant->image_url }}" alt="{{ $restaurant->name }}"
                            class="w-full aspect-[4/3] object-cover hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="p-5">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-2">{{ $restaurant->name }}</h3>
                        <p class="text-gray-500 mb-4">{{ $restaurant->description }}</p>
                        <a href="#"
                            class="order-button inline-block bg-green-600 text-white px-5 py-2 rounded-xl hover:bg-green-700 transition"
                            data-restaurant-id="{{ $restaurant->id }}"
                            data-href="/customer/restaurant/{{ $restaurant->id }}">
                            Pesan Sekarang
                        </a>

                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
@push('scripts')
<script>
    const basketRestaurantId = {{ $basket->restaurant_id ?? 'null' }};

    document.querySelectorAll('.order-button').forEach(button => {
        button.addEventListener('click', function (e) {
            const selectedRestaurantId = parseInt(this.dataset.restaurantId);
            const href = this.dataset.href;

            if (basketRestaurantId && basketRestaurantId !== selectedRestaurantId) {
                const confirmChange = confirm("Keranjangmu berisi pesanan dari restoran lain. Jika kamu lanjut, keranjang akan dikosongkan. Lanjutkan?");
                if (!confirmChange) return;

                // Opsional: Ajax call untuk mengosongkan keranjang sebelum redirect
            }

            window.location.href = href;
        });
    });
</script>
    
@endpush
