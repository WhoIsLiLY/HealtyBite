@extends('layouts.main')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow-md mt-10">
    <h2 class="text-2xl font-bold mb-6 text-center text-green-700">Edit Profil Restoran</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('restaurant.update', $restaurant->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nama Restoran</label>
            <input type="text" name="name" value="{{ old('name', $restaurant->name) }}"
                   class="w-full border rounded p-2 @error('name') border-red-500 @enderror">
            @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Alamat</label>
            <input type="text" name="location" value="{{ old('location', $restaurant->location) }}"
                   class="w-full border rounded p-2 @error('location') border-red-500 @enderror">
            @error('location') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Kategori Restoran</label>
            <input type="text" name="restaurant_category" value="{{ old('restaurant_category', $restaurant->category->name ?? '') }}"
                   class="w-full border rounded p-2 @error('restaurant_category') border-red-500 @enderror">
            @error('restaurant_category') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nomor Telepon</label>
            <input type="text" name="phone_number" value="{{ old('phone_number', $restaurant->phone_number) }}"
                   class="w-full border rounded p-2 @error('phone_number') border-red-500 @enderror">
            @error('phone_number') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Email</label>
            <input type="email" name="email" value="{{ old('email', $restaurant->email) }}"
                   class="w-full border rounded p-2 @error('email') border-red-500 @enderror">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Deskripsi</label>
            <textarea name="description" rows="4"
                      class="w-full border rounded p-2 @error('description') border-red-500 @enderror">{{ old('description', $restaurant->description) }}</textarea>
            @error('description') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block mb-1 font-semibold">Foto Restoran (Opsional)</label>
            @if ($restaurant->image)
                <img src="{{ asset('storage/' . $restaurant->image) }}" alt="Restaurant Image" class="w-32 mb-2">
            @endif
            <input type="file" name="image"
                   class="w-full border rounded p-2 @error('image') border-red-500 @enderror">
            @error('image') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded w-full">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection
