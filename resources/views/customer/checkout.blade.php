@extends('layouts.main')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  <!-- Checkout Header -->
  <div class="flex items-center mb-8">
    <a href="javascript:history.back()" class="mr-4 p-2 rounded-full hover:bg-gray-100 transition-colors">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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

  <!-- Order Summary Card -->
  <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
    <div class="p-6 border-b border-gray-100">
      <h2 class="text-xl font-semibold text-gray-900 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
        </svg>
        Your Order
      </h2>
    </div>
    
    <div class="divide-y divide-gray-100">
      @foreach ($basket["items"] as $item)
      <div class="p-6 hover:bg-gray-50 transition-colors duration-150">
        <div class="flex">
          <div class="flex-shrink-0 mr-4">
            <img src="/images/{{ $item['menu']['menu_image'] }}" alt="{{ $item['menu']['name'] }}" 
                 class="w-20 h-20 object-cover rounded-lg border border-gray-200">
          </div>
          <div class="flex-1 min-w-0">
            <div class="flex justify-between">
              <h3 class="text-lg font-medium text-gray-900 truncate">{{ $item['menu']['name'] }}</h3>
              <p class="text-lg font-semibold text-gray-900 ml-4">Rp {{ number_format($item['menu']['price'], 0, ',', '.') }}</p>
            </div>
            <p class="text-sm text-gray-500 mt-1">{{ $item['menu']['description'] }}</p>
            
            <div class="mt-2 flex items-center text-xs text-gray-400">
              <span class="inline-flex items-center mr-3">
                <svg class="h-3 w-3 text-red-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
                </svg>
                {{ $item['menu']['calorie'] }} cal
              </span>
              <span>{{ $item['menu']['nutrition_facts'] }}</span>
            </div>
            
            @if ($item['addons'])
            <div class="mt-3">
              <h4 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Add-ons</h4>
              <ul class="space-y-1">
                @foreach ($item['addons'] as $addon)
                <li class="flex justify-between text-sm">
                  <span class="text-gray-600">+ {{ $addon['addon']['name'] }}</span>
                  <span class="text-gray-900 font-medium">Rp {{ number_format($addon['addon']['price'], 0, ',', '.') }}</span>
                </li>
                @endforeach
              </ul>
            </div>
            @endif
            
            @if ($item['note'])
            <div class="mt-3 flex items-start">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
              </svg>
              <span class="text-sm text-gray-600 ml-1">{{ $item['note'] }}</span>
            </div>
            @endif
            
            <div class="mt-3 flex items-center justify-between">
              <div class="flex items-center border border-gray-200 rounded-full px-3 py-1">
                <span class="text-sm font-medium text-gray-700">Qty: {{ $item['quantity'] }}</span>
              </div>
              @php
                $itemTotal = $item['menu']['price'] * $item['quantity'];
                foreach ($item['addons'] as $addon) {
                  $itemTotal += $addon['addon']['price'];
                }
              @endphp
              <div class="text-right">
                <p class="text-sm text-gray-500">Subtotal</p>
                <p class="font-semibold text-gray-900">Rp {{ number_format($itemTotal, 0, ',', '.') }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    
    <!-- Order Summary Footer -->
    <div class="bg-gray-50 px-6 py-5">
      <div class="space-y-3">
        <div class="flex justify-between">
          <span class="text-sm font-medium text-gray-500">Subtotal</span>
          @php
            $subtotal = 0;
            foreach ($basket['items'] as $item) {
              $subtotal += $item['menu']['price'] * $item['quantity'];
              foreach ($item['addons'] as $addon) {
                $subtotal += $addon['addon']['price'];
              }
            }
          @endphp
          <span class="text-sm font-medium text-gray-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
        </div>
        <div class="flex justify-between">
          <span class="text-sm font-medium text-gray-500">Delivery Fee</span>
          <span class="text-sm font-medium text-gray-900">Rp 10.000</span>
        </div>
        <div class="flex justify-between">
          <span class="text-sm font-medium text-gray-500">Tax (10%)</span>
          <span class="text-sm font-medium text-gray-900">Rp {{ number_format($subtotal * 0.1, 0, ',', '.') }}</span>
        </div>
        <div class="border-t border-gray-200 pt-3 flex justify-between">
          <span class="text-base font-bold text-gray-900">Total</span>
          @php
            $total = $subtotal + ($subtotal * 0.1) + 10000;
          @endphp
          <span class="text-xl font-bold text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
        </div>
      </div>
      
      <div class="mt-6">
        <button class="w-full bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-3 px-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
          </svg>
          Proceed to Payment
        </button>
      </div>
      
      <div class="mt-4 text-center">
        <p class="text-xs text-gray-500">By placing your order, you agree to our <a href="#" class="text-blue-500 hover:underline">Terms of Service</a> and <a href="#" class="text-blue-500 hover:underline">Privacy Policy</a></p>
      </div>
    </div>
  </div>
  
  <!-- Delivery Information -->
  <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
    <div class="p-6 border-b border-gray-100">
      <h2 class="text-xl font-semibold text-gray-900 flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
        </svg>
        Delivery Information
      </h2>
    </div>
    <div class="p-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <h3 class="text-sm font-medium text-gray-500 mb-2">Delivery Address</h3>
          <p class="text-gray-900 font-medium">Jl. Sudirman No. 123</p>
          <p class="text-gray-600">Jakarta Selatan, DKI Jakarta 12190</p>
          <p class="text-gray-600">Indonesia</p>
          <button class="mt-2 text-sm text-blue-500 hover:text-blue-700 font-medium flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            Change address
          </button>
        </div>
        <div>
          <h3 class="text-sm font-medium text-gray-500 mb-2">Delivery Time</h3>
          <div class="flex items-center space-x-2">
            <div class="flex-1">
              <select class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                <option>ASAP (20-30 min)</option>
                <option>Schedule for later</option>
              </select>
            </div>
          </div>
          <div class="mt-4">
            <h3 class="text-sm font-medium text-gray-500 mb-2">Delivery Instructions</h3>
            <textarea rows="2" class="block w-full shadow-sm sm:text-sm focus:ring-blue-500 focus:border-blue-500 border border-gray-300 rounded-md" placeholder="Leave at door, call when arrived, etc."></textarea>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection