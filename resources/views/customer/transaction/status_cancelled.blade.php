{{-- resources/views/order/partials/status_cancelled.blade.php --}}
<div class="bg-white p-8 rounded-2xl shadow-lg text-center">
    <div class="mb-6">
        <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_pNx6yH.json" background="transparent"  speed="1"  style="width: 150px; height: 150px; margin: auto;" autoplay></lottie-player>
    </div>
    <h2 class="text-2xl font-bold text-red-600 mb-2">Pesanan Dibatalkan</h2>
    <p class="text-gray-600 mb-2">Mohon maaf, pesanan #{{ $order->id }} Anda telah dibatalkan.</p>
    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 text-left" role="alert">
      <p class="font-bold">Informasi Pengembalian Dana</p>
      <p>Total biaya pesanan sebesar <strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong> akan dikembalikan ke metode pembayaran awal Anda dalam 1-3 hari kerja.</p>
    </div>
    <a href="{{ route('customer.dashboard') }}" class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
        Kembali ke Beranda
    </a>
</div>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>