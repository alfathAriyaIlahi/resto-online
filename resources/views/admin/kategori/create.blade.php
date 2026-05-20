@extends('layouts.admin')

@section('admin_content')

<div class="relative overflow-hidden rounded-[36px] bg-gradient-to-br from-orange-500 via-orange-400 to-yellow-300 p-8 mb-10 shadow-2xl">

    <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full bg-white/20 blur-3xl"></div>
    <div class="absolute -bottom-24 -left-24 h-72 w-72 rounded-full bg-yellow-100/30 blur-3xl"></div>

    <div class="absolute inset-0 opacity-[0.08]"
         style="background-image: radial-gradient(white 1px, transparent 1px); background-size: 22px 22px;">
    </div>

    <div class="relative">
        <span class="inline-flex rounded-full bg-white/20 px-4 py-2 text-xs font-black uppercase tracking-widest text-white backdrop-blur">
            Kategori Menu
        </span>

        <h1 class="mt-5 text-5xl font-black tracking-tight text-white">
            Tambah Kategori
        </h1>

        <p class="mt-3 max-w-xl text-sm leading-relaxed text-orange-50">
            Tambahkan kategori baru agar katalog menu MakanYuk terlihat lebih rapi.
        </p>
    </div>

</div>

<div class="relative mx-auto max-w-2xl overflow-hidden rounded-[36px] border border-white/60 bg-white/80 shadow-2xl backdrop-blur-xl">

    <div class="absolute inset-0 bg-gradient-to-br from-orange-50/40 via-white to-yellow-50/40"></div>
    <div class="absolute top-0 right-0 h-72 w-72 rounded-full bg-orange-200/30 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 h-72 w-72 rounded-full bg-yellow-200/30 blur-3xl"></div>

    <div class="relative p-8 md:p-10">

        <nav class="mb-8 flex text-sm font-bold text-gray-500">
            <a href="{{ route('admin.kategori.index') }}" class="transition hover:text-orange-600">
                Kategori
            </a>

            <span class="mx-2">
                /
            </span>

            <span class="text-orange-600">
                Tambah Baru
            </span>
        </nav>

        <div class="mb-8">
            <h2 class="text-3xl font-black text-gray-900">
                Tambah Kategori Baru
            </h2>

            <p class="mt-2 text-sm text-gray-500">
                Masukkan nama kategori yang akan ditampilkan pada katalog menu.
            </p>
        </div>

        <form action="{{ route('admin.kategori.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="nama_kategori" class="mb-2 block text-xs font-black uppercase tracking-widest text-gray-400">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    name="nama_kategori"
                    id="nama_kategori"
                    class="w-full rounded-2xl border border-gray-200 bg-white p-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100 @error('nama_kategori') border-red-500 @enderror"
                    placeholder="Contoh: Makanan Berat atau Minuman"
                    value="{{ old('nama_kategori') }}"
                    required
                >

                @error('nama_kategori')
                    <p class="mt-2 text-sm font-semibold text-red-600">
                        {{ $message }}
                    </p>
                @enderror

                <p class="mt-3 text-xs text-gray-500">
                    Slug akan dibuat otomatis berdasarkan nama kategori ini.
                </p>
            </div>

            <div class="flex flex-wrap gap-4 pt-4">

                <button
                    type="submit"
                    class="flex-1 rounded-2xl bg-orange-600 px-8 py-4 text-sm font-black uppercase tracking-wide text-white shadow-xl shadow-orange-200 transition-all duration-300 hover:-translate-y-1 hover:bg-orange-700 active:scale-95"
                >
                    Simpan Kategori
                </button>

                <a
                    href="{{ route('admin.kategori.index') }}"
                    class="rounded-2xl border border-gray-200 bg-white px-8 py-4 text-sm font-black uppercase tracking-wide text-gray-600 transition hover:bg-gray-50"
                >
                    Batal
                </a>

            </div>
        </form>

    </div>

</div>

@endsection