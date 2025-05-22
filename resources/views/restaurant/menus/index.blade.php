@extends('layouts.main')

@section('content')
    <div class="min-h-screen bg-gray-100 px-4 pt-4 pb-20">
        <!-- Success Tabs -->
        @if (session('success'))
            <div class="mb-4 px-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Sukses! </strong><span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Header -->
        <div class="w-full mb-4 lg:mb-0 align-left p-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-green-600">Menu Anda</h1>
            
            <!-- Tombol Create Menu -->
            <a href="{{ route('restaurant.menus.create') }}"
                class="bg-green-500 hover:bg-green-600 text-white font-medium px-4 py-2 rounded-lg transition">
                + Tambah Menu
            </a>
        </div>

        <div class="space-y-4">
            @foreach ($menus as $menu)
                <div class="flex items-start bg-white rounded-xl shadow-sm hover:shadow-md transition p-4">

                    <!-- Gambar Menu -->
                    <img src="{{ asset('storage/' . $menu->menu_image) }}" alt="{{ $menu->name }}"
                        class="w-24 h-24 object-cover rounded-lg mr-4 border border-gray-200">

                    <!-- Info Menu -->
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $menu->name }}</h3>
                        <p class="text-sm text-gray-500 mb-2">{{ $menu->description ?? 'Tidak ada deskripsi.' }}</p>
                        <p class="text-green-600 font-semibold">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                    </div>

                    <!-- Tombol Detail -->
                    <div class="h-24 flex items-center justify-center">
                        <button type="button"
                            class="bg-green-500 hover:bg-green-600 text-white font-medium px-4 py-2 rounded-lg transition"
                            onclick="openDetailModal({{ $menu->id }})">
                            Detail
                        </button>
                    </div>
                </div>

                <!-- Menambah Data Menu -->
                <script type="application/json" id="menu-data-{{ $menu->id }}">
                    {!! json_encode([
                        'name' => $menu->name,
                        'description' => $menu->description,
                        'price' => $menu->price,
                        'menu_image' => asset('storage/' . $menu->menu_image),
                        'calorie' => $menu->calorie,
                        'nutrition_facts' => $menu->nutrition_facts,
                        'stock' => $menu->isAvailable,
                        'tags' => $menu->foodTags->pluck('name'),
                        'addons' => $menu->addons->pluck('name')
                    ]) !!}
                </script>
            @endforeach
        </div>
    </div>

    <!-- Halaman Modal -->
    <div id="menuDetailModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 hidden">
        <!-- Modal Content -->
        <div id="menuDetailContent" class="bg-white rounded-lg p-6 w-full max-w-md relative">
            <button onclick="closeDetailModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-xl font-bold">
                &times;
            </button>
            <div class="flex flex-col md:flex-row">
                <!-- Kiri -->
                <div class="md:w-1/2 space-y-2">
                    <h2 id="modalMenuName" class="text-2xl font-bold text-green-600"></h2>
                    <img id="modalMenuImage" src="" alt="Gambar Menu" class="w-full h-48 object-cover rounded">
                    <p id="modalMenuDescription"></p>
                    <p id="modalMenuPrice" class="text-green-700 font-semibold"></p>
                </div>

                <!-- Garis Adaptif -->
                <div class="block md:hidden h-px bg-gray-300 my-2"></div>
                <div class="hidden md:block w-px bg-gray-300 mx-2"></div>

                <!-- Kanan -->
                <div class="md:w-1/2 space-y-2">
                    <p id="modalMenuCalories"><strong>Kalori</strong> = </p>
                    <p id="modalMenuNutrition"><strong>Nutrition Facts</strong> = </p>
                    <p id="modalMenuStock"><strong>Tersedia</strong> = </p>
                    <div id="modalMenuTags">
                        <strong>Tags</strong> =
                        <ul class="list-disc list-inside text-sm mt-1" id="modalMenuTagsList"></ul>
                    </div>
                    <div id="modalAddons">
                        <strong>Addons</strong> =
                        <ul class="list-disc list-inside text-sm mt-1" id="modalAddonsList"></ul>
                    </div>
                </div>
            </div>
            <!-- Button Edit & Delete -->
            <div class="flex space-x-2 mt-3">
                <a id="modalMenuEditBtn"
                    href="#"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                    Edit
                </a>
                <form id="deleteMenuForm" method="POST" action="#">
                    @csrf
                    @method('DELETE')
                    <button id="deleteMenuButton"
                        type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            let currentMenu = null;
            document.getElementById('deleteMenuButton').addEventListener('click', function (event) {
                let tagList = currentMenu.tags && currentMenu.tags.length ? `Termasuk tags "${currentMenu.tags.join(', ')}" ` : "";
                let addonList = "";
                if(tagList!=""){
                    addonList = currentMenu.addons && currentMenu.addons.length ? `dan addons "${currentMenu.addons.join(', ')}".` : "";
                } else {
                    addonList = currentMenu.addons && currentMenu.addons.length ? `Termasuk addons "${currentMenu.addons.join(', ')}".` : "";
                }

                let confirmed = confirm(
                    `Apakah Anda yakin ingin menghapus menu "${currentMenu.name}"?\n` +
                    `${tagList}${addonList}`
                );

                if (!confirmed) {
                    event.preventDefault();
                }
            });

            function openDetailModal(menuId) {
                const menuDataEl = document.getElementById(`menu-data-${menuId}`);
                if (!menuDataEl) return;

                const menu = JSON.parse(menuDataEl.textContent);
                currentMenu = menu;

                // Kiri
                document.getElementById('modalMenuName').textContent = menu.name;
                document.getElementById('modalMenuDescription').textContent = menu.description;
                document.getElementById('modalMenuPrice').textContent = 'Rp ' + parseInt(menu.price).toLocaleString();
                document.getElementById('modalMenuImage').src = menu.menu_image;
                document.getElementById('modalMenuImage').alt = menu.name;

                // Kanan
                document.getElementById('modalMenuCalories').innerHTML = `<strong>Kalori</strong> = ${menu.calorie ?? '-'}`;
                document.getElementById('modalMenuNutrition').innerHTML = `<strong>Nutrition Facts</strong> = ${menu.nutrition_facts ?? '-'}`;
                document.getElementById('modalMenuStock').innerHTML = `<strong>Tersedia</strong> = ${menu.stock == 1 ? 'Iya' : 'Tidak'}`;

                // Button
                document.getElementById('modalMenuEditBtn').href = `/restaurant/menu/${menuId}/edit`;
                document.getElementById('deleteMenuForm').action = `/restaurant/menu/${menuId}`;

                const tagList = document.getElementById('modalMenuTagsList');
                tagList.innerHTML = '';
                if (menu.tags && menu.tags.length > 0) {
                    menu.tags.forEach(tag => {
                        const li = document.createElement('li');
                        li.textContent = tag;
                        tagList.appendChild(li);
                    });
                } else {
                    tagList.innerHTML = '<li>-</li>';
                }

                const addonList = document.getElementById('modalAddonsList');
                addonList.innerHTML = '';
                if (menu.addons && menu.addons.length > 0) {
                    menu.addons.forEach(addon => {
                        const li = document.createElement('li');
                        li.textContent = addon;
                        addonList.appendChild(li);
                    });
                } else {
                    addonList.innerHTML = '<li>-</li>';
                }

                document.getElementById('menuDetailModal').classList.remove('hidden');
            }

            function closeDetailModal() {
                document.getElementById('menuDetailModal').classList.add('hidden');
            }

            // Tutup modal jika klik di luar kontennya
            window.addEventListener('click', function (event) {
                const modal = document.getElementById('menuDetailModal');
                const content = document.getElementById('menuDetailContent');
                if (event.target === modal) {
                    closeDetailModal();
                }
            });
        </script>
    @endpush
@endsection
