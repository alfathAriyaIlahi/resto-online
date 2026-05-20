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
                Kategori Menu
            </span>

            <h1 class="mt-5 text-5xl font-black tracking-tight text-white">
                Manajemen Kategori
            </h1>

            <p class="mt-3 max-w-xl text-sm leading-relaxed text-orange-50">
                Kelola kategori menu agar katalog makanan dan minuman terlihat lebih rapi.
            </p>
        </div>

        <a href="{{ route('admin.kategori.create') }}"
           class="inline-flex items-center justify-center rounded-2xl bg-white px-6 py-4 text-sm font-black uppercase tracking-wide text-orange-600 shadow-xl transition-all duration-300 hover:-translate-y-1 hover:bg-orange-50 active:scale-95">
            + Tambah Kategori
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
                        Nama Kategori
                    </th>

                    <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-gray-500 text-right">
                        Aksi
                    </th>
                </tr>
            </thead>

            <tbody>

                @forelse($kategoris as $kategori)

                    <tr class="border-b border-orange-50 transition-all duration-300 hover:bg-orange-50/50">

                        <td class="px-6 py-5">
                            <div class="flex items-center gap-4">

                                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-orange-500 to-orange-600 text-lg font-black text-white shadow-lg shadow-orange-200">
                                    {{ strtoupper(substr($kategori->nama_kategori, 0, 1)) }}
                                </div>

                                <div>
                                    <h3 class="text-sm font-black text-gray-900">
                                        {{ $kategori->nama_kategori }}
                                    </h3>

                                    <p class="mt-1 text-xs text-gray-400">
                                        Kategori menu MakanYuk
                                    </p>
                                </div>

                            </div>
                        </td>

                        <td class="px-6 py-5 text-right">
                            <div class="flex justify-end gap-3">

                                <a href="{{ route('admin.kategori.edit', $kategori->id) }}"
                                   class="inline-flex rounded-2xl bg-blue-500 px-5 py-3 text-xs font-black uppercase tracking-wide text-white shadow-lg shadow-blue-100 transition-all duration-300 hover:-translate-y-1 hover:bg-blue-600 active:scale-95">
                                    Edit
                                </a>

                                <form action="{{ route('admin.kategori.destroy', $kategori->id) }}"
                                      method="POST"
                                      class="inline"
                                      onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">

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
                        <td colspan="2" class="px-6 py-24 text-center">

                            <div class="mx-auto flex h-28 w-28 items-center justify-center rounded-full bg-gradient-to-br from-orange-100 to-yellow-100 shadow-2xl">
                                <svg class="h-14 w-14 text-orange-500"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M4 6h16M4 12h16m-7 6h7">
                                    </path>
                                </svg>
                            </div>

                            <h3 class="mt-8 text-3xl font-black text-gray-900">
                                Belum Ada Kategori
                            </h3>

                            <p class="mt-3 text-sm text-gray-500">
                                Kategori menu yang ditambahkan akan tampil di halaman ini.
                            </p>

                            <a href="{{ route('admin.kategori.create') }}"
                               class="mt-8 inline-flex rounded-2xl bg-orange-600 px-6 py-4 text-sm font-black uppercase tracking-wide text-white shadow-lg shadow-orange-200 transition hover:bg-orange-700">
                                Tambah Kategori
                            </a>

                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection