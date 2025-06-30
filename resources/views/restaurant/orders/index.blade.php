@extends('layouts.main')

@section('content')
    <div class="min-h-screen bg-gray-100 px-4 pt-4 pb-20" x-data="{ tab: 'preparing' }">
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-6">Daftar Pesanan</h1>

            <!-- Tabs -->
            <div class="flex space-x-2 mb-6">
                @foreach (['preparing', 'ready', 'completed', 'cancelled'] as $status)
                    <button class="px-4 py-2 rounded-full text-sm font-medium transition 
                                        focus:outline-none" :class="tab === '{{ $status }}'
                    ? 'bg-green-600 text-white'
                    : 'bg-white text-green-600 border border-green-600'" @click="tab = '{{ $status }}'">
                        {{ ucfirst($status) }}
                    </button>
                @endforeach
            </div>

            <!-- Order Containers -->
            @foreach (['preparing','ready', 'completed', 'cancelled'] as $status)
                <div x-show="tab === '{{ $status }}'">
                    @forelse($orders[$status] ?? [] as $order)
                        <div class="mb-6 p-4 bg-white shadow rounded-xl">
                            <h2 class="font-semibold text-lg">
                                Order #{{ $order->id }} - {{ $order->customer->name }}
                            </h2>
                            <p>Status: {{ ucfirst($order->status) }} | Total: Rp
                                {{ number_format($order->total_price, 0, ',', '.') }}
                            </p>
                            <p>Catatan: {{ $order->notes ?? '-' }}</p>

                            <ul class="list-disc pl-6 mt-2">
                                @foreach ($order->listOrders as $item)
                                    <li>
                                        {{ $item->menu->name ?? 'Menu dihapus' }}
                                        x{{ $item->quantity }} -
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @empty
                        <p class="text-gray-500">Belum ada pesanan dengan status "{{ ucfirst($status) }}".</p>
                    @endforelse
                </div>
            @endforeach
        </div>
    </div>
@endsection