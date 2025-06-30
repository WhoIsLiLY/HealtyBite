@extends('layouts.main')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Checkout Header -->
        <div class="flex items-center mb-8">
            <a href="javascript:history.back()" class="mr-4 p-2 rounded-full hover:bg-gray-100 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Checkout</h1>
            <div class="ml-auto flex items-center space-x-2">
                <span class="text-sm font-medium text-gray-500">Step 1 of 2</span>
                <div class="flex">
                    <div class="h-1 w-6 bg-blue-600 rounded-full"></div>
                    <div class="h-1 w-6 bg-gray-300 rounded-full ml-1"></div>
                </div>
            </div>
        </div>
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif
        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <!-- Order Summary Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
                <div class="p-6 border-b border-gray-100">
                    <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        Your Order
                    </h2>
                </div>

                <div class="divide-y divide-gray-100">
                    @foreach ($basket['items'] as $item)
                        <div class="p-6 hover:bg-gray-50 transition-colors duration-150">
                            <div class="flex">
                                <div class="flex-shrink-0 mr-4">
                                    <img src="/storage/assets/img/menus/{{ $item['menu']['menu_image'] }}"
                                        alt="{{ $item['menu']['name'] }}"
                                        class="w-20 h-20 object-cover rounded-lg border border-gray-200">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between">
                                        <h3 class="text-lg font-medium text-gray-900 truncate">{{ $item['menu']['name'] }}
                                        </h3>
                                        <p class="text-lg font-semibold text-gray-900 ml-4">Rp
                                            {{ number_format($item['menu']['price'], 0, ',', '.') }}</p>
                                    </div>
                                    <p class="text-sm text-gray-500 mt-1">{{ $item['menu']['description'] }}</p>

                                    <div class="mt-2 flex items-center text-xs text-gray-400">
                                        <span class="inline-flex items-center mr-3">
                                            <svg class="h-3 w-3 text-red-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            {{ $item['menu']['calorie'] }} cal
                                        </span>
                                        <span>{{ $item['menu']['nutrition_facts'] }}</span>
                                    </div>

                                    @if ($item['addons'])
                                        <div class="mt-3">
                                            <h4 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">
                                                Add-ons
                                            </h4>
                                            <ul class="space-y-1">
                                                @foreach ($item['addons'] as $addon)
                                                    <li class="flex justify-between text-sm">
                                                        <span class="text-gray-600">+ {{ $addon['addon']['name'] }}</span>
                                                        <span class="text-gray-900 font-medium">Rp
                                                            {{ number_format($addon['addon']['price'], 0, ',', '.') }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if ($item['note'])
                                        <div class="mt-3 flex items-start">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4 text-blue-500 mt-0.5 flex-shrink-0" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                            </svg>
                                            <span class="text-sm text-gray-600 ml-1">{{ $item['note'] }}</span>
                                        </div>
                                    @endif

                                    <div class="mt-3 flex items-center justify-between">
                                        <div class="flex items-center border border-gray-200 rounded-full px-3 py-1">
                                            <span class="text-sm font-medium text-gray-700">Qty:
                                                {{ $item['quantity'] }}</span>
                                        </div>
                                        @php
                                            $itemTotal = $item['menu']['price'] * $item['quantity'];
                                            foreach ($item['addons'] as $addon) {
                                                $itemTotal += $addon['addon']['price'];
                                            }
                                        @endphp
                                        <div class="text-right">
                                            <p class="text-sm text-gray-500">Subtotal</p>
                                            <p class="font-semibold text-gray-900">Rp
                                                {{ number_format($itemTotal, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
                    <div class="p-6 border-b border-gray-100">
                        <h2 class="text-xl font-semibold text-gray-900">Pilih Metode Layanan</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <input type="radio" id="order_type_takeaway" name="order_type" value="take-away"
                                    class="hidden peer" checked>
                                <label for="order_type_takeaway"
                                    class="flex flex-col items-center justify-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:bg-blue-50 hover:bg-gray-50">
                                    <svg class="w-10 h-10 mb-2 text-gray-500 peer-checked:text-blue-600" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    <span class="text-lg font-semibold peer-checked:text-blue-600">Takeaway</span>
                                    <span class="text-sm text-gray-500">Bawa pulang pesanan Anda</span>
                                </label>
                            </div>
                            <div>
                                <input type="radio" id="order_type_dine_in" name="order_type" value="dine-in"
                                    class="hidden peer">
                                <label for="order_type_dine_in"
                                    class="flex flex-col items-center justify-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:bg-blue-50 hover:bg-gray-50">
                                    <svg class="w-10 h-10 mb-2 text-gray-500 peer-checked:text-blue-600" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v.01M12 12v.01M12 16v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-lg font-semibold peer-checked:text-blue-600">Dine-In</span>
                                    <span class="text-sm text-gray-500">Makan di tempat</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
                    <div class="p-6 border-b border-gray-100">
                        <h2 class="text-xl font-semibold text-gray-900">Pilih Metode Pembayaran</h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @php
                                $paymentMethods = [
                                    2 => [
                                        'name' => 'QRIS (GoPay, OVO, Dana)',
                                        'logo' => 'https://upload.wikimedia.org/wikipedia/commons/e/e0/QRIS_Logo.svg',
                                    ],
                                    3 => [
                                        'name' => 'Virtual Account',
                                        'logo' =>
                                            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRmtR-eUqgVMkC_kSwhNkKdMe9dSKtB8ucAOw&s',
                                    ],
                                    1 => [
                                        'name' => 'Kartu Kredit/Debit',
                                        'logo' =>
                                            'https://vccmurah.net/wp-content/uploads/2014/12/visa-vs-mastercard.png',
                                    ],
                                    4 => [
                                        'name' => 'Gerai Retail (Indomaret)',
                                        'logo' =>
                                            'https://upload.wikimedia.org/wikipedia/commons/9/9d/Logo_Indomaret.png',
                                    ],
                                ];
                            @endphp

                            @foreach ($paymentMethods as $key => $method)
                                <div>
                                    <input type="radio" id="payment_{{ $key }}" name="payment_method"
                                        value="{{ $key }}" class="hidden peer"
                                        {{ $loop->first ? 'checked' : '' }}>
                                    <label for="payment_{{ $key }}"
                                        class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 hover:bg-gray-50">
                                        <img src="{{ $method['logo'] }}" alt="{{ $method['name'] }}"
                                            class="h-8 w-12 object-contain mr-4">
                                        <span
                                            class="text-md font-semibold text-gray-900 peer-checked:text-blue-600">{{ $method['name'] }}</span>
                                        <svg class="w-6 h-6 ml-auto text-blue-600 opacity-0 peer-checked:opacity-100"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Order Summary Footer -->
                <div class="bg-gray-50 px-6 py-5">
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Subtotal</span>
                            @php
                                $subtotal = 0;
                                foreach ($basket['items'] as $item) {
                                    $itemTotal = $item['menu']['price'] * $item['quantity'];
                                    foreach ($item['addons'] as $addon) {
                                        $itemTotal += $addon['addon']['price'];
                                    }
                                    $subtotal += $itemTotal;
                                }
                                $tax = $subtotal * 0.1;
                                $deliveryFee = 10000; // Default delivery fee
                                $total = $subtotal + $tax + $deliveryFee;
                            @endphp
                            <span class="text-sm font-medium text-gray-900">Rp
                                {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Service Fee</span>
                            <span class="text-sm font-medium text-gray-900">Rp 10.000</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm font-medium text-gray-500">Tax (10%)</span>
                            <span class="text-sm font-medium text-gray-900">Rp
                                {{ number_format($subtotal * 0.1, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t border-gray-200 pt-3 flex justify-between">
                            <span class="text-base font-bold text-gray-900">Total</span>
                            @php
                                $total = $subtotal + $subtotal * 0.1 + 10000;
                            @endphp
                            <span class="text-xl font-bold text-blue-600">Rp
                                {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-3 px-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                            Proceed to Payment
                        </button>
                    </div>

                    <div class="mt-4 text-center">
                        <p class="text-xs text-gray-500">By placing your order, you agree to our <a href="#"
                                class="text-blue-500 hover:underline">Terms of Service</a> and <a href="#"
                                class="text-blue-500 hover:underline">Privacy Policy</a></p>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const orderTypeRadios = document.querySelectorAll('input[name="order_type"]');
            const deliveryInfoSection = document.getElementById('delivery-info-section');
            const deliveryFeeRow = document.getElementById('delivery-fee-row');
            const deliveryFeeDisplay = document.getElementById('delivery-fee-display');
            const totalPriceDisplay = document.getElementById('total-price-display');

            // -- Data Harga dari PHP --
            const subtotal = {{ $subtotal }};
            const tax = {{ $tax }};
            const deliveryFee = {{ $deliveryFee }};

            function updateCheckoutView() {
                const selectedType = document.querySelector('input[name="order_type"]:checked').value;

                if (selectedType === 'dine-in') {
                    deliveryInfoSection.style.display = 'none';
                    deliveryFeeRow.style.display = 'none';

                    const newTotal = subtotal + tax;
                    totalPriceDisplay.textContent = 'Rp ' + newTotal.toLocaleString('id-ID');
                } else {
                    deliveryInfoSection.style.display = 'block';
                    deliveryFeeRow.style.display = 'flex';

                    const newTotal = subtotal + tax + deliveryFee;
                    deliveryFeeDisplay.textContent = 'Rp ' + deliveryFee.toLocaleString('id-ID');
                    totalPriceDisplay.textContent = 'Rp ' + newTotal.toLocaleString('id-ID');
                }
            }

            orderTypeRadios.forEach(radio => {
                radio.addEventListener('change', updateCheckoutView);
            });

            updateCheckoutView();
        });
    </script>
@endpush
