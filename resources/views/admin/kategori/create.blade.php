@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-lg px-4 py-8">
    <nav class="flex mb-4 text-sm text-gray-500">
        <a href="{{ route('admin.kategori.index') }}" class="hover:text-orange-600">Kategori</a>
        <span class="mx-2">/</span>
        <span class="text-gray-900 font-medium">Tambah Baru</span>
    </nav>

    <div class="rounded-lg bg-white p-8 shadow-lg border border-gray-100">
        <h2 class="text-2xl font-bold mb-6 text-gray-900">Tambah Kategori Baru</h2>

        <form action="{{ route('admin.kategori.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="nama_kategori" class="block text-sm font-medium text-gray-700">
                    Nama Kategori
                </label>
                <input
                    type="text"
                    name="nama_kategori"
                    id="nama_kategori"
                    class="mt-1 w-full rounded-lg border-gray-300 p-3 shadow-sm border focus:border-orange-500 focus:ring-1 focus:ring-orange-500 @error('nama_kategori') border-red-500 @enderror"
                    placeholder="Contoh: Makanan Berat atau Minuman"
                    value="{{ old('nama_kategori') }}"
                    required
                >

                @error('nama_kategori')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-xs text-gray-500">Slug akan dibuat otomatis berdasarkan nama ini.</p>
            </div>

            <div class="flex items-center gap-4">
                <button
                    type="submit"
                    class="rounded-lg bg-orange-600 px-8 py-3 text-white font-bold hover:bg-orange-700 transition-colors"
                >
                    Simpan Kategori
                </button>

                <a
                    href="{{ route('admin.kategori.index') }}"
                    class="text-sm text-gray-600 hover:underline"
                >
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
