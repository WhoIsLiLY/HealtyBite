@extends('layouts.main')

@section('content')
    <div class="min-h-screen bg-gray-100 px-4 pt-4 pb-20" x-data="{ tab: 'recent' }">
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-6">Daftar Pesanan</h1>

            <!-- Tabs -->
            <div class="flex space-x-2 mb-6">
                <button
                    class="px-4 py-2 rounded-full text-sm font-medium transition 
                                focus:outline-none"
                    :class="tab === 'recent'
                        ?
                            'bg-green-600 text-white' :
                            'bg-white text-green-600 border border-green-600'"
                    @click="tab = 'recent'">
                    Recent
                </button>
                @foreach (['preparing', 'ready', 'completed', 'cancelled'] as $status)
                    <button
                        class="px-4 py-2 rounded-full text-sm font-medium transition 
                                        focus:outline-none"
                        :class="tab === '{{ $status }}'
                            ?
                            'bg-green-600 text-white' :
                            'bg-white text-green-600 border border-green-600'"
                        @click="tab = '{{ $status }}'">
                        {{ ucfirst($status) }}
                    </button>
                @endforeach
            </div>

            <!-- Recent Orders Tab -->
            <div x-show="tab === 'recent'" style="display: none;">
                <div class="mb-4 flex justify-between items-center">
                    <form action="" method="GET" class="flex items-center space-x-4">
                        <input type="text" name="search" placeholder="Cari nama pelanggan..." 
                            class="px-4 py-2 border rounded-lg" value="{{ request('search') }}">
                        <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-all shadow-sm">
                            Cari
                        </button>
                        @if(request('search'))
                            <a href="{{ route('restaurant.orders') }}" class="text-gray-500 hover:text-gray-700">
                                Reset
                            </a>
                        @endif
                    </form>

                    <!-- Tambahkan dropdown pagination di sini -->
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-600">Items per page:</span>
                        <select 
                            x-on:change="window.location.href = '{{ request()->url() }}?per_page=' + $event.target.value + '&{{ http_build_query(request()->except('per_page', 'page')) }}'"
                            class="px-2 py-1 border rounded-lg text-sm"
                        >
                            @foreach([5, 10, 25, 100] as $perPage)
                                <option value="{{ $perPage }}" {{ request('per_page', 10) == $perPage ? 'selected' : '' }}>
                                    {{ $perPage }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-sm text-gray-500">
                            Total: {{ $allOrders->total() }} pesanan
                        </span>
                    </div>
                </div>

                <div class="bg-white shadow rounded-xl overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Items</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($allOrders as $order)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $order->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $order->customer->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $order->notes ?: '-' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $order->created_at->format('d M Y H:i') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <ul class="list-disc pl-4">
                                        @foreach ($order->listOrders as $item)
                                            <li>{{ $item->menu->name ?? 'Menu dihapus' }} x{{ $item->quantity }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($order->status == 'completed') bg-green-100 text-green-800
                                        @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                                        @elseif($order->status == 'ready') bg-yellow-100 text-yellow-800
                                        @else bg-blue-100 text-blue-800 @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    @if (in_array($order->status, ['preparing', 'ready']))
                                        <div class="flex space-x-2">
                                            @if ($order->status == 'preparing')
                                                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="ready">
                                                    <button type="submit" title="Tandai Siap"
                                                        class="p-1 text-yellow-600 hover:text-yellow-900">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                    </button>
                                                </form>

                                                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="cancelled">
                                                    <button type="submit" title="Batalkan"
                                                        class="p-1 text-red-600 hover:text-red-900">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif

                                            @if ($order->status == 'ready')
                                                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="completed">
                                                    <button type="submit" title="Tandai Selesai"
                                                        class="p-1 text-green-600 hover:text-green-900">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Tidak ada pesanan
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $allOrders->links() }}
                </div>
            </div>

            <!-- Order Containers -->
            @foreach (['preparing', 'ready', 'completed', 'cancelled'] as $status)
                <div x-show="tab === '{{ $status }}'" style="display: none;">
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

                            @if (in_array($order->status, ['preparing', 'ready']))
                                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                                    @if ($order->status == 'preparing')
                                        <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="ready">
                                            <button type="submit"
                                                class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
                                                Tandai Siap
                                            </button>
                                        </form>

                                        <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit"
                                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition">
                                            Batalkan Pesanan
                                        </button>
                                    </form>
                                    @endif

                                    @if ($order->status == 'ready')
                                        <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="completed">
                                            <button type="submit"
                                                class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
                                                Tandai Selesai
                                            </button>
                                        </form>
                                    @endif

                                    
                                </div>
                            @endif

                        </div>


                    @empty
                        <p class="text-gray-500">Belum ada pesanan dengan status "{{ ucfirst($status) }}".</p>
                    @endforelse
                </div>
            @endforeach
        </div>
    </div>
@endsection
