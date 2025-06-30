<div class="bg-white rounded-2xl shadow-sm p-6">
    <!-- Order Header -->
    <div class="flex justify-between items-start mb-6 pb-6 border-b border-gray-200">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Order #{{ $order->id }}</h2>
            <p class="text-gray-500 mt-1">
                {{ $order->created_at->format('F j, Y \a\t g:i A') }}
            </p>
        </div>
        <div class="text-right">
            <span
                class="px-3 py-1 rounded-full text-xs font-medium 
                  {{ $order->status == 'delivered'
                      ? 'bg-green-100 text-green-800'
                      : ($order->status == 'cancelled'
                          ? 'bg-red-100 text-red-800'
                          : 'bg-blue-100 text-blue-800') }}">
                {{ ucfirst($order->status) }}
            </span>
            <p class="text-sm text-gray-500 mt-2">
                From: <span class="font-medium">{{ $order->restaurant->name }}</span>
            </p>
        </div>
    </div>

    <!-- Order Items -->
    <div class="mb-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Items Ordered</h3>
        <ul class="divide-y divide-gray-200">
            @foreach ($order->listOrders as $item)
                <li class="py-4">
                    <div class="flex justify-between">
                        <div class="flex">
                            <div class="h-16 w-16 rounded-md overflow-hidden border border-gray-200 flex-shrink-0">
                                <img src="/storage/assets/img/menus/{{ $item->menu->menu_image }}"
                                    alt="{{ $item->menu->name }}" class="h-full w-full object-cover">
                            </div>
                            <div class="ml-4">
                                <h4 class="text-md font-medium text-gray-900">{{ $item->menu->name }}</h4>
                                <p class="text-sm text-gray-500 mt-1">{{ $item->menu->description }}</p>
                                @if ($item->detail)
                                    <p class="text-xs text-gray-500 mt-1">
                                        <span class="font-medium">Note:</span> {{ $item->detail }}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-gray-900 font-medium">Rp{{ number_format($item->subtotal, 2) }}</p>
                            <p class="text-sm text-gray-500">Rp{{ number_format($item->menu->price, 2) }} ×
                                {{ $item->quantity }}</p>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Order Summary -->
    <div class="flex justify-between">
        <span class="text-sm font-medium text-gray-500">Service Fee</span>
        <span class="text-sm font-medium text-gray-900">Rp 10.000</span>
    </div>
    <div class="flex justify-between pb-6 pt-2">
        <span class="text-sm font-medium text-gray-500">Tax (10%)</span>
        <span class="text-sm font-medium text-gray-900">Rp
            {{ number_format(($order->total_price-10000)*10/110, 0, ',', '.') }}</span>
    </div>
    <div class="border-t border-gray-200 pt-3">
        <div class="flex justify-between py-2">
            <span class="text-gray-600">Total</span>
            <span class="font-medium">Rp{{ number_format($order->total_price, 2) }}</span>
        </div>

    </div>
</div>
