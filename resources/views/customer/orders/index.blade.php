@extends('layouts.main')
@section('content')
    <section class="py-8 px-2 md:px-10 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="mb-10">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Your Order History</h2>
                <p class="text-gray-600 mt-2">Review your past orders and reorder your favorites</p>
            </div>

            @if ($orders->count() === 0)
                <div class="flex flex-col items-center justify-center py-12 text-center">
                    <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">You haven't ordered anything yet</h2>
                    <p class="text-gray-600 max-w-md mb-6">Browse our restaurants to discover healthy meal options</p>
                    <a href="{{ route('restaurants.index') }}"
                        class="px-6 py-3 bg-gradient-to-r from-green-500 to-blue-500 text-white rounded-full hover:shadow-md transition-all transform hover:scale-105">
                        Explore Restaurants
                    </a>
                </div>
            @else
                <!-- Order Cards -->
                <div class="grid grid-cols-1 gap-6">
                    @foreach ($orders as $order)
                        <div
                            class="order-card bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300">
                            <div class="p-6">
                                <!-- Order Header -->
                                <div class="flex justify-between items-center start mb-4">
                                    <div>
                                        <div class="flex gap-2">
                                            <h3 class="text-lg font-bold text-gray-800">Order #{{ $order->id }} - {{ $order->restaurant_name }}</h3>
                                            <span
                                                class="px-3 py-1 rounded-full text-xs font-medium 
                                            {{ $order->status == 'delivered'
                                                ? 'bg-green-100 text-green-800'
                                                : ($order->status == 'cancelled'
                                                    ? 'bg-red-100 text-red-800'
                                                    : 'bg-blue-100 text-blue-800') }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </div>

                                        <p class="text-sm text-gray-500 mt-1">
                                            {{ $order->created_at->format('F j, Y \a\t g:i A') }}</p>
                                    </div>


                                    <div class="flex items-center justify-center h-full">
                                        <div class="text-right">
                                            <p class="text-2xl font-bold text-gray-800">
                                                Rp{{ number_format($order->total_price, 2) }}</p>
                                        </div>
                                    </div>

                                </div>

                                <button onclick="showOrderDetails('{{ $order->id }}')"
                                    class="open-modal-btn px-4 py-2 bg-gradient-to-r from-green-500 to-blue-500 hover:bg-gray-200 rounded-full text-sm font-medium transition text-white">
                                    View Details
                                </button>
                            </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Modal -->
    <div id="foodModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white p-6 rounded-lg max-w-3xl max-h-xl w-full relative">
            <button id="closeModal" class="absolute top-2 right-4 text-gray-500 hover:text-gray-800">×</button>

            <div id="modalContent">
                Loading...
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function showOrderDetails(id) {
            $('#modalContent').html('Loading...');
            $('#foodModal').removeClass('hidden');

            $.ajax({
                url: `/customer/orders/detail/${id}`,
                type: 'GET',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                },
                success: function(response) {
                    $('#modalContent').html(response);
                },
                error: function() {
                    $('#modalContent').html('<p class="text-red-500">Failed to load data.</p>');
                }
            });
        }

        $('#closeModal').on('click', function() {
            $('#foodModal').addClass('hidden');
        });
    </script>
@endpush
