@extends('layouts.main')

@php
$addons = [
    (object)[ 'id' => 1, 'name' => 'Extra Salad', 'price' => 8000 ],
    (object)[ 'id' => 2, 'name' => 'Double Protein', 'price' => 15000 ],
    (object)[ 'id' => 3, 'name' => 'Cheese Topping', 'price' => 5000 ],
    (object)[ 'id' => 4, 'name' => 'Whole Grain Bread', 'price' => 6000 ],
    (object)[ 'id' => 5, 'name' => 'Avocado Slice', 'price' => 10000 ],
];
@endphp

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white rounded-xl shadow" x-data="addonForm()">
    <!-- Nama Menu dan Harga Menu -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">{{ $menu->name }}</h2>
        <span class="text-xl font-semibold text-green-500">
            Rp {{ number_format($menu->price, 0, ',', '.') }}
        </span>
    </div>

    <!-- Deskripsi Menu -->
    <p class="text-gray-600 mb-4">{{ $menu->description }}</p>

    <!-- Tulisan Add-on -->
    <h3 class="text-xl font-semibold mb-3 border-b pb-1">Add-on</h3>

    <!-- Daftar Add-on -->
    <form action="{{ route('addon.store', ['resto_id' => $id_resto, 'menu_id' => $menu->id]) }}" method="POST">
        @csrf
        <div class="space-y-3">
            @foreach ($addons as $addon)
                <div class="flex items-center justify-between border p-3 rounded-lg">
                    <div class="text-gray-800">{{ $addon->name }}</div>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600 text-sm">Rp {{ number_format($addon->price, 0, ',', '.') }}</span>
                        <input 
                            type="checkbox" 
                            name="addons[]" 
                            value="{{ $addon->id }}" 
                            class="w-5 h-5 text-green-500 rounded border-gray-300"
                            @change="toggleAddon({{ $addon->price }})"
                        >
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Tombol Tambah -->
        <div class="mt-6 text-center">
            <button type="submit"
                class="bg-green-600 text-white px-6 py-2 rounded-xl hover:bg-green-700 transition">
                Tambahkan Pembelian - Rp <span x-text="formatRupiah(total)"></span>
            </button>
        </div>
    </form>
</div>

<script src="//unpkg.com/alpinejs" defer></script>
<script>
    function addonForm() {
        return {
            total: {{ $menu->price }},
            toggleAddon(price) {
                // Checkbox: tambah jika dicentang, kurangi jika tidak
                this.total += event.target.checked ? price : -price;
            },
            formatRupiah(angka) {
                return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        }
    }
</script>
@endsection