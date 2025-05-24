@extends('layouts.main')

@section('content')
    <div class="min-h-screen bg-gray-100 px-4 pt-4 pb-20">
        <!-- Header -->
        <div class="w-full lg:mb-0 align-left p-4 flex">
            <h1 class="text-2xl font-bold text-green-600">Tambah Menu</h1>
        </div>
        <div class="flex items-start bg-white rounded-xl shadow-sm hover:shadow-md transition p-4">
            <form action="{{ route('restaurant.menus.store') }}" method="POST" enctype="multipart/form-data" class="w-full space-y-4">
                @csrf
                <div class="flex flex-col md:flex-row gap-6 w-full">
                    <!-- Kiri -->
                    <div class="w-full md:w-1/2 space-y-4">
                        <!-- Nama Menu -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Nama Menu <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:outline-none focus:ring-2 px-3 py-2" required>
                            @error('nama')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Deskripsi <span class="text-red-500">*</span>
                            </label>
                            <textarea name="deskripsi" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:outline-none focus:ring-2 px-3 py-2" required></textarea>
                            @error('deskripsi')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Harga -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Harga (Rp) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="harga" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:outline-none focus:ring-2 px-3 py-2" required>
                            @error('harga')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Gambar -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Gambar
                            </label>
                            <input type="file" name="gambar" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-green-100 file:text-green-700 hover:file:bg-green-200">
                            @error('gambar')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kalori -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Kalori <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="kalori" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 px-3 py-2" required>
                            @error('kalori')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nutrition Facts -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Nutrition Facts <span class="text-red-500">*</span>
                            </label>
                            <textarea name="nutrition_facts" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:outline-none focus:ring-2 px-3 py-2" placeholder="Contoh: Protein 10g, Lemak 5g, Karbohidrat 20g" required></textarea>
                            @error('nutrition_facts')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tersedia -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Tersedia? <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-2 flex items-center space-x-6">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="tersedia" value="1" class="text-green-600 focus:ring-green-500" checked required>
                                    <span class="ml-2 text-gray-700">Iya</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="tersedia" value="0" class="text-green-600 focus:ring-green-500" required>
                                    <span class="ml-2 text-gray-700">Tidak</span>
                                </label>
                            </div>
                            @error('tersedia')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tags -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 w-full">
                                Tags
                            </label>

                            <div id="tagsContainer" class="space-y-4 mt-2">
                                <!-- Input tags dinamis akan muncul di sini -->
                            </div>

                            <button 
                                type="button" 
                                id="addTagBtn" 
                                class="mt-3 inline-flex items-center px-3 py-1.5 bg-green-600 text-white rounded hover:bg-green-700 transition"
                            >
                                + Tambah Tags
                            </button>
                        </div>
                    </div>

                    <!-- Garis Adaptif -->
                    <div class="block md:hidden h-px bg-gray-300 my-2"></div>
                    <div class="hidden md:block w-px bg-gray-300 mx-2"></div>

                    <!-- Kanan -->
                    <div class="md:w-1/2 space-y-4">
                        <!-- Addons -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 w-full mb-2">
                                Addons
                            </label>

                            <div id="addonsContainer" class="space-y-4 mt-2">
                                <!-- Input addons dinamis akan muncul di sini -->
                            </div>

                            <button 
                                type="button" 
                                id="addAddonBtn" 
                                class="mt-3 inline-flex items-center px-3 py-1.5 bg-green-600 text-white rounded hover:bg-green-700 transition"
                            >
                                + Tambah Addon
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="pt-4">
                    <button type="submit" class="w-full bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition">
                        Simpan Menu
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tagsContainer = document.getElementById('tagsContainer');
            const addTagBtn = document.getElementById('addTagBtn');

            function createTagInput() {
                // Buat wrapper div flex
                const wrapper = document.createElement('div');
                wrapper.className = 'flex flex-col md:flex-row md:space-x-2 space-y-2 md:space-y-0 items-start';

                // Wrapper nama tag (label + input)
                const nameWrapper = document.createElement('div');
                nameWrapper.className = 'flex flex-col flex-1';

                const nameLabel = document.createElement('label');
                nameLabel.innerHTML = 'Nama Tags <span class="text-red-500">*</span>';
                nameLabel.className = 'text-sm font-medium text-gray-700 mb-1';

                const inputName = document.createElement('input');
                inputName.type = 'text';
                inputName.name = 'tags_name[]';
                inputName.required = true;
                inputName.className = 'rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500';

                nameWrapper.appendChild(nameLabel);
                nameWrapper.appendChild(inputName);

                // Wrapper deskripsi tag (label + input)
                const descWrapper = document.createElement('div');
                descWrapper.className = 'flex flex-col flex-1';

                const descLabel = document.createElement('label');
                descLabel.innerHTML = 'Deskripsi Tags <span class="text-red-500">*</span>';
                descLabel.className = 'text-sm font-medium text-gray-700 mb-1';

                const inputDesc = document.createElement('input');
                inputDesc.type = 'text';
                inputDesc.name = 'tags_description[]';
                inputDesc.required = true;
                inputDesc.className = 'rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500';

                descWrapper.appendChild(descLabel);
                descWrapper.appendChild(inputDesc);

                // Tombol trash
                const trashBtn = document.createElement('button');
                trashBtn.type = 'button';
                trashBtn.className = 'text-red-600 hover:text-red-800 mt-6 md:mt-8';
                trashBtn.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1m-4 0h4" />
                    </svg>
                `;
                trashBtn.title = 'Hapus tag';
                trashBtn.addEventListener('click', () => {
                    wrapper.remove();
                });

                wrapper.appendChild(nameWrapper);
                wrapper.appendChild(descWrapper);
                wrapper.appendChild(trashBtn);

                return wrapper;
            }

            // Event tambah tag baru
            addTagBtn.addEventListener('click', () => {
                const newTagInput = createTagInput();
                tagsContainer.appendChild(newTagInput);
            });

            const addonsContainer = document.getElementById('addonsContainer');
            const addAddonBtn = document.getElementById('addAddonBtn');

            let addonIndex = 0;
            function createAddonInput() {
                const wrapper = document.createElement('div');
                wrapper.className = 'flex flex-col md:flex-row md:space-x-2 space-y-2 md:space-y-0 items-start';

                // Nama Addon
                const nameWrapper = document.createElement('div');
                nameWrapper.className = 'flex flex-col flex-1';

                const nameLabel = document.createElement('label');
                nameLabel.innerHTML = 'Nama Addon <span class="text-red-500">*</span>';
                nameLabel.className = 'text-sm font-medium text-gray-700 mb-1';

                const inputName = document.createElement('input');
                inputName.type = 'text';
                inputName.name = 'addons_name[]';
                inputName.required = true;
                inputName.className = 'rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500';

                nameWrapper.appendChild(nameLabel);
                nameWrapper.appendChild(inputName);

                // Harga Addon
                const priceWrapper = document.createElement('div');
                priceWrapper.className = 'flex flex-col flex-1';

                const priceLabel = document.createElement('label');
                priceLabel.innerHTML = 'Harga (Rp) <span class="text-red-500">*</span>';
                priceLabel.className = 'text-sm font-medium text-gray-700 mb-1';

                const inputPrice = document.createElement('input');
                inputPrice.type = 'number';
                inputPrice.name = 'addons_price[]';
                inputPrice.required = true;
                inputPrice.min = 0;
                inputPrice.className = 'rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500';

                priceWrapper.appendChild(priceLabel);
                priceWrapper.appendChild(inputPrice);

                // Tipe Addon
                const typeWrapper = document.createElement('div');
                typeWrapper.className = 'flex flex-col flex-1';

                const typeLabel = document.createElement('label');
                typeLabel.innerHTML = 'Tipe <span class="text-red-500">*</span>';
                typeLabel.className = 'text-sm font-medium text-gray-700 mb-1';

                const selectType = document.createElement('select');
                selectType.name = 'addons_type[]';
                selectType.required = true;
                selectType.className = 'rounded-md border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500';

                const optionExtra = document.createElement('option');
                optionExtra.value = 'extra';
                optionExtra.textContent = 'Extra';

                const optionTopping = document.createElement('option');
                optionTopping.value = 'topping';
                optionTopping.textContent = 'Topping';

                selectType.appendChild(optionExtra);
                selectType.appendChild(optionTopping);

                typeWrapper.appendChild(typeLabel);
                typeWrapper.appendChild(selectType);

                // Tersedia Addon
                const stockWrapper = document.createElement('div');
                stockWrapper.className = 'flex flex-col flex-1';

                const stockLabel = document.createElement('label');
                stockLabel.innerHTML = 'Tersedia? <span class="text-red-500">*</span>';
                stockLabel.className = 'text-sm font-medium text-gray-700 mb-1';

                const radioWrapper = document.createElement('div');
                radioWrapper.className = 'flex space-x-4';

                // Radio iya
                const labelYes = document.createElement('label');
                labelYes.className = 'inline-flex items-center';

                const inputYes = document.createElement('input');
                inputYes.type = 'radio';
                inputYes.name = `addons_available[${addonIndex}]`;
                inputYes.value = '1';
                inputYes.checked = true;
                inputYes.className = 'text-green-600 focus:ring-green-500';

                const spanYes = document.createElement('span');
                spanYes.className = 'ml-2 text-gray-700';
                spanYes.textContent = 'Iya';

                labelYes.appendChild(inputYes);
                labelYes.appendChild(spanYes);

                // Radio tidak
                const labelNo = document.createElement('label');
                labelNo.className = 'inline-flex items-center';

                const inputNo = document.createElement('input');
                inputNo.type = 'radio';
                inputNo.name = `addons_available[${addonIndex}]`;
                inputNo.value = '0';
                inputNo.className = 'text-green-600 focus:ring-green-500';

                const spanNo = document.createElement('span');
                spanNo.className = 'ml-2 text-gray-700';
                spanNo.textContent = 'Tidak';

                labelNo.appendChild(inputNo);
                labelNo.appendChild(spanNo);

                radioWrapper.appendChild(labelYes);
                radioWrapper.appendChild(labelNo);

                stockWrapper.appendChild(stockLabel);
                stockWrapper.appendChild(radioWrapper);

                // Tombol trash
                const trashBtn = document.createElement('button');
                trashBtn.type = 'button';
                trashBtn.className = 'text-red-600 hover:text-red-800 mt-6 md:mt-8';
                trashBtn.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1m-4 0h4" />
                    </svg>
                `;
                trashBtn.title = 'Hapus addon';
                trashBtn.addEventListener('click', () => {
                    addonIndex--;
                    wrapper.remove();
                });

                addonIndex++;

                // Append semua ke wrapper
                wrapper.appendChild(nameWrapper);
                wrapper.appendChild(priceWrapper);
                wrapper.appendChild(typeWrapper);
                wrapper.appendChild(stockWrapper);
                wrapper.appendChild(trashBtn);

                return wrapper;
            }

            // Event tambah addon baru
            addAddonBtn.addEventListener('click', () => {
                const newAddonInput = createAddonInput();
                addonsContainer.appendChild(newAddonInput);
            });
        });
    </script>
    @endpush
@endsection
