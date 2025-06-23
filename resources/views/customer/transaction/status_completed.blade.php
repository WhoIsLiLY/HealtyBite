{{-- resources/views/order/partials/status_completed.blade.php --}}
<div class="bg-white p-8 rounded-2xl shadow-lg text-center">
     <div class="mb-6">
        <lottie-player src="https://assets5.lottiefiles.com/packages/lf20_xwmj0hsk.json" background="transparent"  speed="1"  style="width: 150px; height: 150px; margin: auto;" autoplay></lottie-player>
    </div>
    <h2 class="text-2xl font-bold text-green-600 mb-2">Pesanan Selesai!</h2>
    <p class="text-gray-600 mb-6">Pesanan #{{ $order->id }} Anda telah berhasil diantar. Terima kasih telah memesan!</p>
    <a href="{{ route('customer.dashboard') }}" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">
        Pesan Lagi
    </a>
</div>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>