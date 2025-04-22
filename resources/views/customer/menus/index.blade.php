@extends('layouts.main')

@php
$menus = [
    (object)[
        'id' => '1',
        'name' => 'Grilled Chicken Salad',
        'description' => 'Salad segar dengan dada ayam panggang rendah lemak.',
        'price' => 45000,
        'image_url' => 'https://via.placeholder.com/100x100?text=Salad',
    ],
    (object)[
        'id' => '2',
        'name' => 'Smoothie Berry',
        'description' => 'Minuman sehat dari buah berry alami tanpa gula tambahan.',
        'price' => 30000,
        'image_url' => 'https://via.placeholder.com/100x100?text=Smoothie',
    ],
    (object)[
        'id' => '3',
        'name' => 'Quinoa Bowl',
        'description' => 'Semangkuk quinoa dengan sayuran kukus dan saus tahini.',
        'price' => 50000,
        'image_url' => 'https://via.placeholder.com/100x100?text=Quinoa',
    ],
];
@endphp


@section('content')
    <h2 class="text-3xl font-bold mb-6">Menu dari resto id {{$id}}</h2>
    <p class="mb-4">Deskripsi resto</p>
    <div class="mb-4 space-y-0" x-data="{ totalOrder: 0 }">
        @foreach ($menus as $menu)
            <div class="flex items-center w-full bg-white border-b border-gray-200 p-4"
                x-data="{
                added: '{{ in_array($menu->id, session('added_menu_ids', [])) ? 'true' : 'false' }}' === 'true',
                qty: 1,
                base: {{ $menu->price + (session('selected_addons.' . $menu->id) ? collect(session('selected_addons.' . $menu->id))->map(function($id) {
                    $addonsDummy = [
                        [ 'id' => 1, 'price' => 8000 ],
                        [ 'id' => 2, 'price' => 15000 ],
                        [ 'id' => 3, 'price' => 5000 ],
                        [ 'id' => 4, 'price' => 6000 ],
                        [ 'id' => 5, 'price' => 10000 ],
                    ];
                    return collect($addonsDummy)->firstWhere('id', $id)['price'] ?? 0;
                })->sum() : 0) }},
                updateTotal() {
                    if (this.added) {
                        $root.totalOrder += this.base * this.qty;
                    }
                }
                }"
                x-init="updateTotal()"
                x-effect="$watch('qty', () => { $root.totalOrder = 0; document.querySelectorAll('[x-data]').forEach(e => { if(e.__x) e.__x.$data.updateTotal && e.__x.$data.updateTotal(); }); })"
            >

                <!-- Gambar -->
                <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="w-24 h-24 object-cover rounded-xl mr-4">

                <!-- Info Menu -->
                <div class="flex-1">
                    <h3 class="text-lg font-semibold">{{ $menu->name }}</h3>
                    <p class="text-sm text-gray-600">{{ $menu->description }}</p>
                </div>

                <!-- Harga -->
                <div class="text-right mr-4 w-24">
                    <p class="text-md font-semibold text-gray-800">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                </div>

                <script src="//unpkg.com/alpinejs" defer></script>

                <!-- Kontrol Penambahan -->
                <template x-if="!added">
                    <a href="/test/menus/{{ $id }}/addon/{{ $menu->id }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                        Tambah
                    </a>
                </template>

                <template x-if="added">
                    @php
                        $selectedAddons = session("selected_addons.$menu->id", []);
                        $addonDetails = collect($selectedAddons)->map(function($addonId) {
                            $addonsDummy = [
                                [ 'id' => 1, 'name' => 'Extra Salad', 'price' => 8000 ],
                                [ 'id' => 2, 'name' => 'Double Protein', 'price' => 15000 ],
                                [ 'id' => 3, 'name' => 'Cheese Topping', 'price' => 5000 ],
                                [ 'id' => 4, 'name' => 'Whole Grain Bread', 'price' => 6000 ],
                                [ 'id' => 5, 'name' => 'Avocado Slice', 'price' => 10000 ],
                            ];
                            return collect($addonsDummy)->firstWhere('id', $addonId);
                        })->filter();
                        $totalAddon = $addonDetails->sum('price');
                    @endphp

                    @if ($addonDetails->count())
                        <div>
                            <div class="bg-gray-100 rounded-lg p-3 shadow-sm">
                                <h4 class="text-sm font-semibold text-gray-700 mb-1">Add-ons:</h4>
                                <ul class="text-sm text-gray-600 list-disc list-inside">
                                    @foreach ($addonDetails as $addon)
                                        <li class="flex justify-between">
                                            <span>{{ $addon['name'] }}</span>
                                            <span>Rp {{ number_format($addon['price'], 0, ',', '.') }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="mt-2 text-right font-bold text-green-600">
                                    Total Add-on: Rp {{ number_format($totalAddon, 0, ',', '.') }}
                                </div>
                            </div>

                            <div class="flex items-center space-x-2">
                                <button class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600" 
                                @click="
                                if (qty <= 1) {
                                    added = false;
                                    qty = 1;
                                    fetch('/test/menus/{{ $id }}/remove/{{ $menu->id }}')
                                    {{-- Endpoint hapus session --}}
                                } else {
                                    qty--
                                }">-</button>
                                <span class="w-6 text-center" x-text="qty"></span>
                                <button class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600" @click="qty++">+</button>
                                <a href="/test/menus/{{ $id }}/addon/{{ $menu->id }}"
                                class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition text-sm">
                                    Edit
                                </a>
                            </div>
                        </div>
                    @endif
                </template>
            </div>
        @endforeach
        
        <a href="#"
        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700"
        x-text="'Order - Rp ' + new Intl.NumberFormat('id-ID').format(totalOrder)">
        </a>
    </div>
@endsection