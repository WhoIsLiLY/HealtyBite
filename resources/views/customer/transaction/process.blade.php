@extends('layouts.main')

@section('content')
<div class="bg-gray-50 min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div 
        id="order-status-container" 
        class="max-w-md w-full space-y-8" 
        data-order-id="{{ $order->id }}"
        data-initial-status="{{ $order->status }}"
        data-status-url="{{ route('order.status', $order->id) }}"
    >

        @if(in_array($order->status, ['preparing', 'ready']))
            @include('customer.transaction.status_processing', ['order' => $order])
        
        @elseif($order->status == 'completed')
            @include('customer.transaction.status_completed', ['order' => $order])

        @elseif($order->status == 'cancelled')
            @include('customer.transaction.status_cancelled', ['order' => $order])
        @endif
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('order-status-container');
    const orderId = container.dataset.orderId;
    const initialStatus = container.dataset.initialStatus;
    const statusUrl = container.dataset.statusUrl;

    const checkOrderStatus = async () => {
        try {
            const response = await fetch(statusUrl);
            if (!response.ok) {
                console.error('Failed to fetch order status');
                return;
            }
            const data = await response.json();
            const newStatus = data.status;

            if (newStatus !== window.currentStatus) {
                console.log(`Status changed from ${window.currentStatus} to ${newStatus}. Reloading page...`);
                clearInterval(pollingInterval);
                window.location.reload();
            }
        } catch (error) {
            console.error('Error checking order status:', error);
        }
    };

    window.currentStatus = initialStatus;
    let pollingInterval;

    if (['preparing', 'ready'].includes(initialStatus)) {
        console.log('Starting real-time status check...');
        pollingInterval = setInterval(checkOrderStatus, 7000);
    } else {
        console.log('Order is already completed or cancelled. No need for real-time checks.');
    }
});
</script>
@endpush