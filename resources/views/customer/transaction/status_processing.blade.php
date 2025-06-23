{{-- resources/views/order/partials/status_processing.blade.php --}}
@php
    $statuses = ['preparing', 'ready', 'completed'];
    $currentStatusIndex = array_search($order->status, $statuses);
@endphp
<div class="absolute top-0 left-0 mt-4 ml-4 z-10">
    <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-800 p-4 my-6 text-left rounded-r-lg" role="alert"
        style="width: 300px;">
        <p class="font-bold mb-2">Petunjuk Pengambilan</p>
        <p>Tunjukkan <span class="font-semibold">Nomor Pesanan</span> berikut ini kepada kasir untuk mengambil
            pesanan Anda:</p>
        <div class="text-center bg-blue-100 p-3 mt-3 rounded-lg">
            <span class="text-3xl font-bold tracking-widest text-blue-900">{{ $order->id }}</span>
        </div>
    </div>
</div>

<div class="bg-white p-8 rounded-2xl shadow-lg text-center">
    @if ($order->status == 'preparing')
        <div class="mb-6 flex justify-center items-center">
            <dotlottie-player src="https://lottie.host/16f368c7-2ce0-45be-a287-cd57b8419928/9uA6qC9B9O.lottie"
                background="transparent" speed="1" style="width: 300px; height: 300px" loop
                autoplay></dotlottie-player>
        </div>
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Pesanan Anda Sedang Disiapkan!</h2>
        <p class="text-gray-500 mb-8">Kami sedang bekerja keras menyiapkan pesanan Anda. Anda bisa memantau progres di
            bawah
            ini.</p>
    @elseif ($order->status == 'ready')
        <div class="mb-6 flex justify-center items-center">
            <dotlottie-player src="https://lottie.host/a07afeeb-d7a5-4b7d-b84f-201ffbf65207/Wwqh10INht.lottie"
                background="transparent" speed="1" style="width: 300px; height: 300px" loop
                autoplay></dotlottie-player>
        </div>
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Pesanan Anda Sudah Siap Diambil!</h2>
        <p class="text-gray-500 mb-8">Pesanan Anda sudah siap diambil. Anda bisa memantau progres di bawah
            ini.</p>
    @elseif ($order->status == 'completed')
        <div class="mb-6">
            <lottie-player src="https://lottie.host/9f4eaf57-7d49-4c2e-9e8b-d3a5e7fccf45/KLmYnD3pRt.json"
                background="transparent" speed="1" style="width: 150px; height: 150px; margin: auto;" loop
                autoplay>
            </lottie-player>
        </div>
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Pesanan Anda Sudah Selesai!</h2>
        <p class="text-gray-500 mb-8">Pesanan Anda sudah selesai. Anda bisa keluar dari halaman ini
            ini.</p>
    @endif

    <div class="w-full">
        <ol class="flex items-center justify-between w-full relative">
            @foreach ($statuses as $index => $status)
                <li class="flex flex-col items-center relative z-10">
                    <span
                        class="flex items-center justify-center w-10 h-10 rounded-full lg:h-12 lg:w-12 shrink-0 {{ $index <= $currentStatusIndex ? 'bg-blue-100' : 'bg-white border-2 border-gray-200' }}">
                        @if ($index <= $currentStatusIndex)
                            <svg class="w-5 h-5 text-blue-600 lg:w-6 lg:h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        @else
                            <span class="text-sm font-semibold text-gray-400 lg:text-base">
                                {{ $index + 1 }}
                            </span>
                        @endif
                    </span>

                    <!-- Status Text -->
                    <span
                        class="text-xs font-semibold mt-2 {{ $index <= $currentStatusIndex ? 'text-blue-600' : 'text-gray-400' }}">
                        {{ ucfirst($status) }}
                    </span>
                </li>
            @endforeach
        </ol>
    </div>
</div>
<div class="border-t border-gray-200 pt-6 text-left">
    <h3 class="text-lg font-bold text-gray-800 mb-4 text-center">Detail Pesanan</h3>

    <div class="space-y-4">
        {{-- Loop untuk setiap item pesanan --}}
        @foreach ($order->listOrders as $item)
            <div class="flex justify-between items-start">
                <div class="flex-grow pr-4">
                    <p class="font-semibold text-gray-800">{{ $item->menu->name }}</p>
                    {{-- Tampilkan detail (addons/notes) jika ada --}}
                    @if ($item->detail)
                        <p class="text-xs text-gray-500 italic mt-1">{{ $item->detail }}</p>
                    @endif
                </div>
                <div class="text-right flex-shrink-0">
                    <p class="font-semibold text-gray-900">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-500">Qty: {{ $item->quantity }}</p>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Garis Pemisah --}}
    <div class="border-t border-dashed my-6"></div>

    {{-- Rincian Total Biaya --}}
    <div class="space-y-2 text-sm">
        @php
            // Kalkulasi untuk ditampilkan
            $subtotalFromItems = $order->listOrders->sum('subtotal');
            $tax = $subtotalFromItems * 0.1;
            $deliveryFee = $order->total_price - $subtotalFromItems - $tax;
        @endphp
        <div class="flex justify-between">
            <span class="text-gray-600">Subtotal</span>
            <span class="font-medium text-gray-900">Rp {{ number_format($subtotalFromItems, 0, ',', '.') }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-gray-600">Pajak (10%)</span>
            <span class="font-medium text-gray-900">Rp {{ number_format($tax, 0, ',', '.') }}</span>
        </div>
        @if ($deliveryFee > 0)
            <div class="flex justify-between">
                <span class="text-gray-600">Biaya Pengiriman</span>
                <span class="font-medium text-gray-900">Rp {{ number_format($deliveryFee, 0, ',', '.') }}</span>
            </div>
        @endif
        <div class="flex justify-between text-base pt-2 border-t border-gray-200 mt-2">
            <span class="font-bold text-gray-900">Total Pembayaran</span>
            <span class="font-bold text-blue-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
        </div>
        @if ($order->status == 'preparing')
            <div class="border-t border-gray-200 mt-6 pt-6">
                <form action="{{ route('order.cancel', $order->id) }}" method="POST"
                    onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?');">
                    @csrf
                    <button type="submit"
                        class="w-full inline-flex justify-center items-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Cancel Order
                    </button>
                </form>
                <p class="text-xs text-gray-400 text-center mt-2">Pesanan hanya dapat dibatalkan saat dalam tahap
                    'Preparing'.</p>
            </div>
        @endif
    </div>
</div>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
