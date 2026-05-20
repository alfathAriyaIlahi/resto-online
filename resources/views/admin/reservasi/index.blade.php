@extends('layouts.admin')

@section('admin_content')

<div class="relative overflow-hidden rounded-[36px] bg-gradient-to-br from-orange-500 via-orange-400 to-yellow-300 p-8 mb-10 shadow-2xl">

    {{-- GLOW --}}
    <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full bg-white/20 blur-3xl"></div>
    <div class="absolute -bottom-24 -left-24 h-72 w-72 rounded-full bg-yellow-100/30 blur-3xl"></div>

    {{-- GRID --}}
    <div class="absolute inset-0 opacity-[0.08]"
         style="background-image: radial-gradient(white 1px, transparent 1px); background-size: 22px 22px;">
    </div>

    <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-6">

        <div>

            <span class="inline-flex rounded-full bg-white/20 px-4 py-2 text-xs font-black uppercase tracking-widest text-white backdrop-blur">
                Reservasi
            </span>

            <h1 class="mt-5 text-5xl font-black tracking-tight text-white">
                Data Reservasi
            </h1>

            <p class="mt-3 max-w-xl text-sm leading-relaxed text-orange-50">
                Kelola seluruh data reservasi pelanggan MakanYuk dengan tampilan modern dan lebih interaktif.
            </p>

        </div>

        <div class="rounded-3xl border border-white/20 bg-white/15 px-8 py-6 backdrop-blur-xl shadow-2xl">

            <p class="text-xs font-black uppercase tracking-widest text-orange-100">
                Total Reservasi
            </p>

            <div class="mt-3 flex items-center gap-3">

                <div class="h-4 w-4 rounded-full bg-green-300 shadow-lg shadow-green-300/50"></div>

                <h2 class="text-5xl font-black text-white">
                    {{ $pesanans->count() }}
                </h2>

            </div>

        </div>

    </div>

</div>

<div class="relative overflow-hidden rounded-[36px] border border-white/60 bg-white/80 shadow-2xl backdrop-blur-xl">

    {{-- BACKGROUND EFFECT --}}
    <div class="absolute inset-0 bg-gradient-to-br from-orange-50/50 via-white to-yellow-50/50"></div>

    <div class="absolute top-0 right-0 h-72 w-72 rounded-full bg-orange-200/30 blur-3xl"></div>

    <div class="absolute bottom-0 left-0 h-72 w-72 rounded-full bg-yellow-200/30 blur-3xl"></div>

    <div class="relative overflow-x-auto">

        <table class="w-full border-collapse text-left">

            <thead>

                <tr class="border-b border-orange-100 bg-white/70 backdrop-blur-xl">

                    <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-gray-500">
                        Waktu
                    </th>

                    <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-gray-500">
                        Pelanggan
                    </th>

                    <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-gray-500">
                        Tipe
                    </th>

                    <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-gray-500">
                        Detail Reservasi
                    </th>

                    <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-gray-500 text-center">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($pesanans as $pesan)

                <tr class="border-b border-orange-50 transition-all duration-300 hover:bg-orange-50/40">

                    {{-- WAKTU --}}
                    <td class="px-6 py-5 align-top">

                        <div class="rounded-2xl bg-white/80 p-4 shadow-sm border border-orange-50">

                            <div class="text-sm font-black text-gray-900">
                                {{ $pesan->created_at->format('d M Y') }}
                            </div>

                            <div class="mt-1 text-xs text-gray-400">
                                {{ $pesan->created_at->format('H:i') }} WIB
                            </div>

                        </div>

                    </td>

                    {{-- PELANGGAN --}}
                    <td class="px-6 py-5 align-top">

                        <div class="flex items-start gap-4">

                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-orange-500 to-orange-600 text-lg font-black text-white shadow-lg shadow-orange-200">

                                {{ strtoupper(substr($pesan->nama_pelanggan, 0, 1)) }}

                            </div>

                            <div>

                                <h3 class="text-sm font-black text-gray-900">
                                    {{ $pesan->nama_pelanggan }}
                                </h3>

                                <p class="mt-1 text-xs text-gray-500">
                                    {{ $pesan->nomor_hp }}
                                </p>

                            </div>

                        </div>

                    </td>

                    {{-- TIPE --}}
                    <td class="px-6 py-5 align-top">

                        <span class="inline-flex rounded-full bg-orange-100 px-4 py-2 text-[11px] font-black uppercase tracking-wide text-orange-600 shadow-sm">

                            Reservasi

                        </span>

                    </td>

                    {{-- DETAIL --}}
                    <td class="px-6 py-5 align-top">

                        <div class="rounded-2xl border border-orange-100 bg-white/80 p-5 shadow-sm">

                            <div class="flex items-center gap-2">

                                <div class="h-2 w-2 rounded-full bg-orange-500"></div>

                                <span class="text-sm font-black text-gray-900">
                                    {{ $pesan->jumlah_orang }} Orang
                                </span>

                            </div>

                            <div class="mt-3 text-xs leading-relaxed text-gray-500">

                                <span class="font-bold text-gray-700">
                                    Catatan:
                                </span>

                                {{ $pesan->catatan ?? 'Tidak ada catatan tambahan.' }}

                            </div>

                        </div>

                    </td>

                    {{-- AKSI --}}
                    <td class="px-6 py-5 align-top text-center">

                        <form action="{{ route('admin.reservasi.destroy', $pesan->id) }}"
                              method="POST"
                              onsubmit="return confirm('Hapus data reservasi ini?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="inline-flex items-center rounded-2xl bg-red-500 px-5 py-3 text-xs font-black uppercase tracking-wide text-white shadow-lg shadow-red-100 transition-all duration-300 hover:-translate-y-1 hover:bg-red-600 active:scale-95">

                                Hapus

                            </button>

                        </form>

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
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>

                        </div>

                        <h3 class="mt-8 text-3xl font-black text-gray-900">
                            Belum Ada Reservasi
                        </h3>

                        <p class="mt-3 text-sm text-gray-500">
                            Reservasi pelanggan akan tampil di halaman ini.
                        </p>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection