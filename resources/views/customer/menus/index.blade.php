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
                <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}"
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
                <label class="block mb-2 font-medium">Your Orders:</label>
                @csrf
                <div id="basketList" class="space-y-3 max-h-[450px] overflow-y-auto pr-1">
                    <!-- Akan diisi oleh jQuery AJAX -->
                    <p class="text-gray-500 text-sm" id="loadingOrder">Memuat Order...</p>
                </div>
            </div>
            <div class="flex w-full justify-between" id="basketModalFooter">
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

        function reset() {
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
                reset();
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
            reset();
            $('#addonModal').addClass('hidden');
        }



        function openBasketModal() {
            $('#basketList').html('<p class="text-gray-500 text-sm" id="loadingOrder">Memuat order...</p>');

            $('#basketModal').removeClass('hidden');

            $.ajax({
                url: `/customer/basket/` + $('#restaurant_id').val().toString(),
                method: 'GET',
                success: function(response) {
                    if(response.basket == null){
                        $('#basketList').html(
                            '<p class="text-gray-500 text-sm">Kamu belum memesan apapun... Pesan dulu yuk!</p>'
                        );
                        $('#basketModalFooter').addClass('hidden');

                        return;
                    }
                    const basket = response.basket.items;
                    let totalPrice = 0;
                    console.table(basket);
                    if (basket.length === 0) {
                        $('#basketList').html(
                            '<p class="text-gray-500 text-sm">Kamu belum memesan apapun... Pesan dulu yuk!</p>'
                        );
                        return;
                    }

                    let html = '';
                    basket.forEach(function(item) {
                        html += `
                                    <div class="border rounded-xl p-4 mb-4 shadow-sm bg-white">
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <div class="text-lg font-semibold text-gray-900">${item.menu.name}</div>
                                                <div class="text-sm text-gray-500">${item.menu.description ?? ''}</div>
                                                <div class="text-sm text-gray-600 mt-1">Jumlah: <span class="font-medium">${item.quantity ?? 1}</span></div>
                                                ${item.note ? `<div class="text-xs mt-1 text-yellow-600 italic">Note: ${item.note}</div>` : ''}
                                            </div>
                                            <div class="text-right">
                                                <div class="text-base text-green-600 font-medium">Rp ${(Number(item.menu.price) * (item.quantity ?? 1)).toLocaleString('id-ID')}</div>
                                            </div>
                                        </div>
                            `;
                        totalPrice += parseFloat((item.menu.price) * (item.quantity ?? 1));
                        if (item.addons.length > 0) {
                            html += `<div class="mt-3 border-t pt-2 space-y-1">`;
                            item.addons.forEach(function(addon) {
                                if (addon) {
                                    html += `<div class="flex justify-between text-sm text-gray-700">
                                                <div class="flex items-center space-x-2">
                                                    <span class="text-green-500">+ ${addon.addon.name}</span>
                                                </div>
                                                <div>Rp ${Number(addon.addon.price).toLocaleString('id-ID')}</div>
                                            </div>`;
                                }
                                totalPrice += parseFloat(addon.addon.price);
                            });
                        }
                        html += `</div></div>`;
                    });
                    $('#basketList').html(html);
                    $('#totalPriceBasket').text(totalPrice.toLocaleString('id-ID'));
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
                    $('#basketList').html(
                        '<p class="text-gray-500 text-sm">Kamu belum memesan apapun... Pesan dulu yuk!</p>'
                    );
                    $('#totalPriceBasket').text('0');
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
    </script>
@endpush
