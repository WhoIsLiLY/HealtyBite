@extends('layouts.main')

@php

@endphp


@section('content')
    <!-- Header Resto Section -->
    <div class="bg-white rounded-xl shadow-sm p-4 mb-6 border border-gray-100">
        <div class="flex items-center space-x-4">
            <!-- Icon / Thumbnail Placeholder -->
            <div class="bg-green-100 text-green-600 rounded-full p-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M3 3h18M3 9h18M3 15h18M3 21h18" />
                </svg>
            </div>

            <div class="flex-1">
                <input type="hidden" name="restaurant_id" id="restaurant_id" value="{{ $restaurant->id }}">
                <!-- Restaurant Name -->
                <h1 class="text-2xl font-bold text-gray-900">{{ $restaurant->name }}</h1>

                <!-- Description or Default Text -->
                <p class="text-sm text-gray-500 mt-1">
                    {{ $restaurant->description ?: 'Deskripsi tidak tersedia untuk restoran ini.' }}
                </p>
            </div>
        </div>

        <!-- Info tambahan: rating, waktu buka, promo, dll -->
        <div class="mt-4 flex flex-wrap items-center text-sm text-gray-600 space-x-4">
            <div class="flex items-center space-x-1">
                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 15l-5.878 3.09 1.123-6.545L.49 6.91l6.561-.955L10 0l2.949 5.955 6.561.955-4.755 4.635 1.123 6.545z" />
                </svg>
                <span>4.8 • 1K+ ulasan</span>
            </div>

            <div class="flex items-center space-x-1">
                <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M5 13l4 4L19 7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span>Terbuka • 08:00–22:00</span>
            </div>

            <div class="flex items-center space-x-1">
                <svg class="w-4 h-4 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M9 14l6-6M9 8l6 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span>Promo ongkir</span>
            </div>
        </div>
    </div>


    <div class="space-y-4" x-data="{ totalOrder: 0 }">
        @foreach ($restaurant->menus as $menu)
            <div class="flex items-start bg-white rounded-xl shadow-sm hover:shadow-md transition p-4">

                <!-- Gambar Menu -->
                <img src="/storage/assets/img/menus/{{ $menu->menu_image }}" alt="{{ $menu->name }}"
                    class="w-24 h-24 object-cover rounded-lg mr-4 border border-gray-200">

                <!-- Info Menu -->
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $menu->name }}</h3>
                    <p class="text-sm text-gray-500 mb-2">{{ $menu->description ?? 'Tidak ada deskripsi.' }}</p>
                    <p class="text-green-600 font-semibold">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                </div>

                <!-- Tombol Tambah -->
                <div class="h-24 flex items-center justify-center">
                    <button type="button"
                        class="bg-green-500 hover:bg-green-600 text-white font-medium px-4 py-2 rounded-lg transition"
                        onclick="openAddonModal({{ $menu->id }}, '{{ $menu->name }}')">
                        + Keranjang
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Tombol Lihat Keranjang -->
    <button onclick="openBasketModal()"
        class="fixed bottom-20 right-5 bg-green-600 hover:bg-green-700 text-white p-4 rounded-full shadow-xl transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h11.1M16 16a2 2 0 11-4 0 2 2 0 014 0zM9 16a2 2 0 11-4 0 2 2 0 014 0z">
            </path>
        </svg>
    </button>

    <!-- Modal Overlay -->
    <div id="addonModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <!-- Modal Box -->
        <div class="bg-white rounded-lg shadow-lg w-full max-w-lg relative p-6" id="addonModalBox">
            <!-- Tombol Close -->
            <button id="closeAddonModal"
                class="absolute top-3 right-4 text-gray-500 hover:text-red-500 text-2xl">&times;</button>

            <input type="hidden" name="menu_id" id="menu_id">

            <!-- Judul Modal -->
            <h2 class="text-xl font-semibold mb-4" id="menuName">Nama Menu</h2>

            <!-- Quantity Selector -->
            <div class="mb-4">
                <label for="quantity" class="block mb-2 text-sm font-semibold text-gray-700">Jumlah Pesanan</label>

                <div class="flex items-center border border-gray-300 rounded-lg w-fit overflow-hidden shadow-sm">
                    <button type="button" class="bg-gray-100 text-gray-700 px-3 py-2 hover:bg-gray-200"
                        onclick="adjustQuantity(-1)">
                        –
                    </button>

                    <input type="number" id="quantityMenu" name="quantity" value="1" min="1"
                        class="w-14 text-center text-gray-800 outline-none border-0 focus:ring-0 bg-white"
                        oninput="updateTotalPrice()">

                    <button type="button" class="bg-gray-100 text-gray-700 px-3 py-2 hover:bg-gray-200"
                        onclick="adjustQuantity(1)">
                        +
                    </button>
                </div>
            </div>


            <!-- Addons -->
            <div class="mb-4">
                <label class="block mb-2 font-medium">Pilih Addon:</label>
                @csrf
                <div id="addonList" class="space-y-3">
                    <!-- Akan diisi oleh jQuery AJAX -->
                    <p class="text-gray-500 text-sm" id="loadingAddons">Memuat addons...</p>
                </div>
            </div>

            <!-- Catatan -->
            <div class="mb-4">
                <label for="note" class="block mb-2 font-medium">Catatan:</label>
                <textarea name="note" id="note" rows="2" class="w-full border border-gray-300 p-2 rounded"></textarea>
            </div>

            <!-- Submit -->
            <div class="text-right">
                <button id="submitOrderToBasket" onclick="submitOrderToBasket()" type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded">Tambahkan
                    Pembelian - Rp <span id="totalMenuPrice">0</span>
                </button>
            </div>
        </div>
    </div>
    <!-- Modal Overlay -->
    <div id="basketModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <!-- Modal Box -->
        <div class="bg-white rounded-lg shadow-lg w-full max-w-lg relative p-6" id="basketModalBox">
            <!-- Tombol Close -->
            <button id="closeBasketModal"
                class="absolute top-3 right-4 text-gray-500 hover:text-red-500 text-2xl">&times;</button>

            <!-- Orders -->
            <div class="mb-4">
                <label class="block mb-2 font-medium flex items-center"><svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>Your Orders:</label>
                @csrf
                <div id="basketList" class="space-y-3 max-h-[450px] overflow-y-auto pr-1">
                    <!-- Akan diisi oleh jQuery AJAX -->
                    <p class="text-gray-500 text-sm" id="loadingOrder">Memuat Order...</p>
                </div>
            </div>
            <div class="mt-3 flex w-full justify-between hidden" id="basketModalFooter">
                <!-- Delete Basket -->
                <div class="text-left">
                    <button id="deleteBasket" onclick="deleteBasket()" type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-2 rounded">
                        Delete All
                    </button>
                </div>

                <!-- Submit -->
                <div class="text-right">
                    <button id="submitToCheckout" onclick="submitToCheckout()" type="submit"
                        class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded">Lanjutkan
                        ke Checkout - Rp <span id="totalPriceBasket">0</span>
                    </button>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script>
        let defaultMenuPrice = 0;
        let currentMenuPrice = 0;
        let addonsPrice = 0;
        let totalMenuPrice = 0;
        let selectedAddons = [];

        let menuId = 0;
        let menuName = "";

        function resetAddonModal() {
            $('#addonModal').addClass('hidden');
            $("#totalMenuPrice").text(0);
            $('#quantityMenu').val(1);
            $('#note').val('');
            totalMenuPrice = 0;
            defaultMenuPrice = 0;
            currentMenuPrice = 0;
            addonsPrice = 0;
            selectedAddons = [];
            $('#addonList').html('');
        }

        function openAddonModal(id, name) {
            menuId = id;
            menuName = name;

            $('#menu_id').val(menuId);
            $('#menuName').text(menuName);
            $('#addonList').html('<p class="text-gray-500 text-sm" id="loadingAddons">Memuat addons...</p>');

            $('#addonModal').removeClass('hidden');

            $.ajax({
                url: `/customer/addons/menu/` + id.toString(),
                method: 'GET',
                success: function(response) {
                    const menu = response.menu;
                    const addons = response.addons;
                    if (addons.length === 0) {
                        $('#addonList').html(
                            '<p class="text-gray-500 text-sm">Tidak ada addon untuk menu ini.</p>');
                        defaultMenuPrice = parseFloat(menu.price);
                        totalMenuPrice = defaultMenuPrice;
                        currentMenuPrice = defaultMenuPrice
                        $('#totalMenuPrice').text(totalMenuPrice.toLocaleString('id-ID'));
                        return;
                    }
                    defaultMenuPrice = parseFloat(menu.price);
                    totalMenuPrice = defaultMenuPrice;
                    currentMenuPrice = defaultMenuPrice
                    $('#totalMenuPrice').text(totalMenuPrice.toLocaleString('id-ID'));

                    let html = '';
                    addons.forEach(function(addon) {
                        html += `
                                <div class="flex items-center justify-between border p-3 rounded-lg">
                                    <div class="text-gray-800">${addon.name}</div>
                                    <div class="flex items-center space-x-4">
                                        <span class="text-gray-600 text-sm">Rp ${Number(addon.price).toLocaleString('id-ID')}</span>
                                        <input type="checkbox" name="addons[]" value="${addon.id}" class="w-5 h-5 text-green-500 rounded border-gray-300 addon-checkbox" data-price="${addon.price}" data-name="${addon.name}">
                                    </div>
                                </div>
                                `;
                    });
                    $('#addonList').html(html);
                },
                error: function(jqXHR) {
                    if (jqXHR.responseText) {
                        console.error(jqXHR.responseText);
                    }
                    var errorMessage = JSON.parse(jqXHR.responseText);
                    if (jqXHR.status == 400) {

                        var errorMessageCss = $(
                            '<div id="errMessage" class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative" role="alert">' +
                            '<span class="block sm:inline">' + errorMessage.message +
                            '</span>' +
                            '</div>');


                        if (!$('#errMessage').is(':Visible')) {
                            $('form').prepend(errorMessageCss);

                            setTimeout(function() {
                                $('#errMessage').fadeOut('slow', function() {
                                    $('#errMessage').remove();
                                    errorMessageCss = null;
                                });
                            }, 4000);
                        }
                    }
                }
            });

            // Hapus dulu event listener sebelumnya agar tidak menumpuk
            $(document).off('change', '.addon-checkbox');

            $(document).on('change', '.addon-checkbox', function() {
                const checkbox = $(this);
                const addonId = checkbox.val();
                const addonPrice = parseFloat(checkbox.data('price'));
                const addonName = checkbox.data('name');
                // alert(addonName);
                // alert(totalMenuPrice);
                // alert(addonPrice);
                if (checkbox.is(':checked')) {

                    addonsPrice += addonPrice;

                    selectedAddons.push({
                        id: addonId,
                        name: addonName,
                        price: addonPrice
                    });
                } else {
                    addonsPrice -= addonPrice;

                    selectedAddons = selectedAddons.filter(function(item) {
                        return item.id != addonId;
                    });
                }
                updateTotalMenuPrice();
                console.log("Total Harga: Rp " + totalMenuPrice.toLocaleString('id-ID'));
                console.log("Addons Terpilih: ", selectedAddons);
                $('#totalMenuPrice').text(totalMenuPrice.toLocaleString('id-ID'));
            });
        }

        $('#closeAddonModal, #addonModal').on('click', function(e) {
            if (e.target.id === 'addonModal' || e.target.id === 'closeAddonModal') {
                resetAddonModal();
            }
            // alert(totalMenuPrice);
        });

        function submitOrderToBasket() {
            document.cookie = `selectedMenus=${encodeURIComponent(JSON.stringify({
                menuId: menuId,
                quantity: $('#quantityMenu').val(),
                addons: selectedAddons
            }))}; path=/`;
            $.ajax({
                url: `/customer/basket/`,
                method: 'POST',
                data: {
                    restaurant_id: $('#restaurant_id').val(),
                    menu_id: $('#menu_id').val(),
                    quantity: $('#quantityMenu').val(),
                    addons: selectedAddons,
                    note: $('#note').val(),
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(jqXHR) {
                    if (jqXHR.responseText) {
                        console.error(jqXHR.responseText);
                    }
                    var errorMessage = JSON.parse(jqXHR.responseText);
                    if (jqXHR.status == 400) {

                        var errorMessageCss = $(
                            '<div id="errMessage" class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative" role="alert">' +
                            '<span class="block sm:inline">' + errorMessage.message +
                            '</span>' +
                            '</div>');


                        if (!$('#errMessage').is(':Visible')) {
                            $('form').prepend(errorMessageCss);

                            setTimeout(function() {
                                $('#errMessage').fadeOut('slow', function() {
                                    $('#errMessage').remove();
                                    errorMessageCss = null;
                                });
                            }, 4000);
                        }
                    }
                }
            });
            alert("Order berhasil ditambahkan");
            resetAddonModal();
            $('#addonModal').addClass('hidden');
        }



        function openBasketModal() {
            $('#basketList').html(`<div class="text-center py-8">
                <p class="mt-1 text-gray-500">Memuat Order...</p>
            </div>`);

            $('#basketModal').removeClass('hidden');

            $.ajax({
                url: `/customer/basket/` + $('#restaurant_id').val().toString(),
                method: 'GET',
                success: function(response) {
                    if (response.basket == null) {
                        resetBasketModal();
                        return;
                    }
                    $('#basketModalFooter').removeClass('hidden');

                    const basket = response.basket.items;
                    let totalPrice = 0;

                    if (basket.length === 0) {
                        $('#basketList').html(`
            <div class="text-center py-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">Keranjang Kosong</h3>
                <p class="mt-1 text-gray-500">Kamu belum memesan apapun... Pesan dulu yuk!</p>
                <div class="mt-6">
                    <a href="/menu" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Lihat Menu
                    </a>
                </div>
            </div>
        `);
                        $('#basketModalFooter').addClass('hidden');
                        return;
                    }

                    let html = '';
                    basket.forEach(function(item) {
                        const itemSubtotal = (Number(item.menu.price) * (item.quantity ?? 1));
                        totalPrice += itemSubtotal;

                        html += `
        <div class="border border-gray-200 rounded-lg p-4 mb-4 bg-white shadow-sm hover:shadow-md transition-shadow duration-200">
            <div class="flex">
                <div class="flex-shrink-0 mr-4">
                    <img src="/storage/assets/img/menus/${item.menu.menu_image}" alt="${item.menu.name}" class="h-16 w-16 object-cover rounded-md border border-gray-200">
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex justify-between">
                        <h3 class="text-lg font-semibold text-gray-900 truncate">${item.menu.name}</h3>
                        <button class="text-gray-400 hover:text-red-500 delete-item" data-id="${item.id}" onclick="deleteBasketItem(${item.id})">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                    
                    <p class="text-sm text-gray-500 mt-1">${item.menu.description ?? ''}</p>
                    
                    <div class="mt-2 flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="text-sm text-gray-600 mt-1">Jumlah: <span class="font-medium">${item.quantity ?? 1}</span></div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-500">Subtotal</p>
                            <p class="text-base font-semibold text-green-600">Rp ${itemSubtotal.toLocaleString('id-ID')}</p>
                        </div>
                    </div>
                    
                    ${item.note ? `
                                            <div class="mt-2 flex items-start">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                                </svg>
                                                <span class="text-sm text-orange-600 ml-1"><i>${item.note}</i></span>
                                            </div>` : ''}
                    
                    ${item.addons.length > 0 ? `
                                            <div class="mt-3 pt-2 border-t border-gray-100">
                                                <h4 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Tambahan</h4>
                                                <ul class="space-y-1">
                                                    ${item.addons.map(addon => {
                                                        if (addon) {
                                                            totalPrice += parseFloat(addon.addon.price);
                                                            return `
                                    <li class="flex justify-between text-sm">
                                        <span class="text-green-600">+ ${addon.addon.name}</span>
                                        <span class="text-green-900 font-medium">Rp ${Number(addon.addon.price).toLocaleString('id-ID')}</span>
                                    </li>`;
                                                        }
                                                    }).join('')}
                                                </ul>
                                            </div>` : ''}
                </div>
            </div>
        </div>`;
                    });

                    // Add service fee and tax calculations
                    const serviceFee = 10000;
                    const tax = totalPrice * 0.1;
                    const grandTotal = totalPrice + serviceFee + tax;

                    html += `
    <div class="bg-gray-50 rounded-lg p-4 mt-6 border border-gray-200">
        <div class="space-y-2">
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Subtotal</span>
                <span class="text-sm font-medium text-gray-900">Rp ${totalPrice.toLocaleString('id-ID')}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Biaya Pengiriman</span>
                <span class="text-sm font-medium text-gray-900">Rp ${serviceFee.toLocaleString('id-ID')}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-sm text-gray-600">Pajak (10%)</span>
                <span class="text-sm font-medium text-gray-900">Rp ${tax.toLocaleString('id-ID')}</span>
            </div>
            <div class="border-t border-gray-200 pt-2 mt-2 flex justify-between">
                <span class="text-base font-bold text-gray-900">Total</span>
                <span class="text-lg font-bold text-green-600">Rp ${grandTotal.toLocaleString('id-ID')}</span>
            </div>
        </div>
    </div>`;

                    $('#basketList').html(html);
                    $('#totalPriceBasket').text(grandTotal.toLocaleString('id-ID'));
                    $('#basketModalFooter').removeClass('hidden');

                    // Add event listeners for quantity buttons and delete buttons
                    $('.quantity-btn').on('click', function() {
                        // Your quantity update logic here
                    });

                    $('.delete-item').on('click', function() {
                        // Your delete item logic here
                    });
                },
                error: function(jqXHR) {
                    if (jqXHR.responseText) {
                        console.error(jqXHR.responseText);
                    }
                    var errorMessage = JSON.parse(jqXHR.responseText);
                    if (jqXHR.status == 400) {
                        var errorMessageCss = $(`
            <div id="errMessage" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">${errorMessage.message}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3 close-error">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Close</title>
                        <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                    </svg>
                </span>
            </div>
        `);
                        $('#basketList').prepend(errorMessageCss);
                        $('.close-error').on('click', function() {
                            $('#errMessage').remove();
                        });
                    }
                }
            });
        }

        function deleteBasket() {
            if (!confirm("Apakah kamu yakin ingin menghapus semua pesanan di keranjang?")) return;

            $.ajax({
                url: "{{ route('customer.basket.delete') }}",
                type: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'restaurant_id': $('#restaurant_id').val()
                },
                success: function(response) {
                    alert('Keranjang berhasil dikosongkan.');
                    // Kosongkan tampilan basket di halaman
                    resetBasketModal();
                },
                error: function(jqXHR) {
                    if (jqXHR.responseText) {
                        console.error(jqXHR.responseText);
                    }
                    var errorMessage = JSON.parse(jqXHR.responseText);
                    if (jqXHR.status == 400) {

                        var errorMessageCss = $(
                            '<div id="errMessage" class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative" role="alert">' +
                            '<span class="block sm:inline">' + errorMessage.message +
                            '</span>' +
                            '</div>');


                        if (!$('#errMessage').is(':Visible')) {
                            $('form').prepend(errorMessageCss);

                            setTimeout(function() {
                                $('#errMessage').fadeOut('slow', function() {
                                    $('#errMessage').remove();
                                    errorMessageCss = null;
                                });
                            }, 4000);
                        }
                    }
                }
            });
        }

        function deleteBasketItem(menuId) {
            if (!confirm("Apakah kamu yakin ingin menghapus semua pesanan di keranjang?")) return;

            $.ajax({
                url: "{{ route('customer.basket.item.delete') }}",
                type: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'menu_id': menuId.toString()
                },
                success: function(response) {
                    alert('Item berhasil didelete.');
                    // Kosongkan tampilan basket di halaman
                    openBasketModal();
                },
                error: function(jqXHR) {
                    if (jqXHR.responseText) {
                        console.error(jqXHR.responseText);
                    }
                    var errorMessage = JSON.parse(jqXHR.responseText);
                    if (jqXHR.status == 400) {

                        var errorMessageCss = $(
                            '<div id="errMessage" class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded relative" role="alert">' +
                            '<span class="block sm:inline">' + errorMessage.message +
                            '</span>' +
                            '</div>');


                        if (!$('#errMessage').is(':Visible')) {
                            $('form').prepend(errorMessageCss);

                            setTimeout(function() {
                                $('#errMessage').fadeOut('slow', function() {
                                    $('#errMessage').remove();
                                    errorMessageCss = null;
                                });
                            }, 4000);
                        }
                    }
                }
            });
        }


        $('#closeBasketModal, #basketModal').on('click', function(e) {
            if (e.target.id === 'basketModal' || e.target.id === 'closeBasketModal') {
                $('#basketModal').addClass('hidden');
                resetBasketModal();
            }
        });

        function updateTotalMenuPrice() {
            totalMenuPrice = currentMenuPrice + addonsPrice;
            $('#totalMenuPrice').text(totalMenuPrice.toLocaleString('id-ID'));
        }

        function adjustQuantity(num) {
            const quantityMenu = document.getElementById('quantityMenu');
            const newQuantity = parseInt(quantityMenu.value) + num;
            if (newQuantity < 1) {
                return;
            }
            quantityMenu.value = newQuantity.toString();

            currentMenuPrice = newQuantity * defaultMenuPrice;
            updateTotalMenuPrice();
        }

        function submitToCheckout() {
            window.location.href = '/customer/checkout';
        }

        function resetBasketModal() {
            $('#basketList').html(`
            <div class="text-center py-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">Keranjang Kosong</h3>
                <p class="mt-1 text-gray-500">Kamu belum memesan apapun... Pesan dulu yuk!</p>
                <div class="mt-6">
                    <a href="/menu" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Lihat Menu
                    </a>
                </div>
            </div>
        `);
            $('#basketModalFooter').addClass('hidden');
            $('#totalPriceBasket').text('0');
        }
    </script>
@endpush
