@extends('layouts.admin')

@section('admin_content')

<div class="relative overflow-hidden rounded-[36px] bg-gradient-to-br from-orange-500 via-orange-400 to-yellow-300 p-8 mb-10 shadow-2xl">

    <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full bg-white/20 blur-3xl"></div>
    <div class="absolute -bottom-24 -left-24 h-72 w-72 rounded-full bg-yellow-100/30 blur-3xl"></div>

    <div class="absolute inset-0 opacity-[0.08]"
         style="background-image: radial-gradient(white 1px, transparent 1px); background-size: 22px 22px;">
    </div>

    <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <span class="inline-flex rounded-full bg-white/20 px-4 py-2 text-xs font-black uppercase tracking-widest text-white backdrop-blur">
                Produk Menu
            </span>

            <h1 class="mt-5 text-5xl font-black tracking-tight text-white">
                Daftar Produk
            </h1>

            <p class="mt-3 max-w-xl text-sm leading-relaxed text-orange-50">
                Kelola menu makanan, minuman, harga, kategori, dan foto produk MakanYuk.
            </p>
        </div>

        <a href="{{ route('admin.produk.create') }}"
           class="inline-flex items-center justify-center rounded-2xl bg-white px-6 py-4 text-sm font-black uppercase tracking-wide text-orange-600 shadow-xl transition-all duration-300 hover:-translate-y-1 hover:bg-orange-50 active:scale-95">
            + Tambah Produk
        </a>
    </div>

</div>

@if(session('success'))
    <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-bold text-green-700 shadow-sm">
        {{ session('success') }}
    </div>
@endif

<div class="relative overflow-hidden rounded-[36px] border border-white/60 bg-white/80 shadow-2xl backdrop-blur-xl">

    <div class="absolute inset-0 bg-gradient-to-br from-orange-50/40 via-white to-yellow-50/40"></div>
    <div class="absolute top-0 right-0 h-72 w-72 rounded-full bg-orange-200/30 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 h-72 w-72 rounded-full bg-yellow-200/30 blur-3xl"></div>

    <div class="relative overflow-x-auto">

        <table class="w-full border-collapse text-left">

            <thead>
                <tr class="border-b border-orange-100 bg-white/70 backdrop-blur-xl">
                    <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-gray-500">
                        Gambar
                    </th>

                    <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-gray-500">
                        Nama Menu
                    </th>

                    <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-gray-500">
                        Harga
                    </th>

                    <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-gray-500">
                        Kategori
                    </th>

                    <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-gray-500 text-right">
                        Aksi
                    </th>
                </tr>
            </thead>

            <tbody>

                @forelse($produks as $produk)

                    <tr class="border-b border-orange-50 transition-all duration-300 hover:bg-orange-50/50">

                        <td class="px-6 py-5">
                            @if($produk->foto)
                                @php
                                    $fileName = str_replace(['public/', 'storage/', 'produk/'], '', $produk->foto);
                                    $path = 'produk/' . $fileName;
                                @endphp

                                <img src="{{ asset('storage/' . $path) }}"
                                     class="h-24 w-24 rounded-2xl object-cover border-4 border-white shadow-xl"
                                     alt="{{ $produk->nama_produk }}"
                                     onerror="this.onerror=null;this.src='https://via.placeholder.com/150?text=404';">
                            @else
                                <div class="flex h-24 w-24 items-center justify-center rounded-2xl border border-dashed border-orange-200 bg-orange-50 text-[10px] font-bold uppercase text-orange-400">
                                    No Image
                                </div>
                            @endif
                        </td>

                        <td class="px-6 py-5">
                            <h3 class="text-sm font-black text-gray-900">
                                {{ $produk->nama_produk }}
                            </h3>

                            <p class="mt-1 text-xs text-gray-400">
                                ID Produk: #{{ $produk->id }}
                            </p>
                        </td>

                        <td class="px-6 py-5">
                            <span class="inline-flex rounded-full bg-orange-100 px-4 py-2 text-xs font-black text-orange-600 shadow-sm">
                                Rp{{ number_format($produk->harga, 0, ',', '.') }}
                            </span>
                        </td>

                        <td class="px-6 py-5">
                            <span class="inline-flex rounded-full bg-gray-100 px-4 py-2 text-xs font-bold text-gray-600">
                                {{ $produk->kategori->nama_kategori ?? 'Umum' }}
                            </span>
                        </td>

                        <td class="px-6 py-5 text-right">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('admin.produk.edit', $produk->id) }}"
                                   class="inline-flex rounded-2xl bg-blue-500 px-5 py-3 text-xs font-black uppercase tracking-wide text-white shadow-lg shadow-blue-100 transition-all duration-300 hover:-translate-y-1 hover:bg-blue-600 active:scale-95">
                                    Edit
                                </a>

                                <form action="{{ route('admin.produk.destroy', $produk->id) }}"
                                      method="POST"
                                      class="inline"
                                      onsubmit="return confirm('Hapus menu ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="inline-flex rounded-2xl bg-red-500 px-5 py-3 text-xs font-black uppercase tracking-wide text-white shadow-lg shadow-red-100 transition-all duration-300 hover:-translate-y-1 hover:bg-red-600 active:scale-95">
                                        Hapus
                                    </button>

                                </form>
                            </div>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="px-6 py-24 text-center">
                            <div class="mx-auto flex h-28 w-28 items-center justify-center rounded-full bg-gradient-to-br from-orange-100 to-yellow-100 shadow-2xl">
                                <svg class="h-14 w-14 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M3 7h18M3 12h18M3 17h18">
                                    </path>
                                </svg>
                            </div>

                            <h3 class="mt-8 text-3xl font-black text-gray-900">
                                Belum Ada Produk
                            </h3>

                            <p class="mt-3 text-sm text-gray-500">
                                Produk menu yang ditambahkan akan muncul di halaman ini.
                            </p>

                            <a href="{{ route('admin.produk.create') }}"
                               class="mt-8 inline-flex rounded-2xl bg-orange-600 px-6 py-4 text-sm font-black uppercase tracking-wide text-white shadow-lg shadow-orange-200 transition hover:bg-orange-700">
                                Tambah Produk
                            </a>
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection