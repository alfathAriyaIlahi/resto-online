@extends('layouts.admin')

@section('admin_content')

<div class="relative overflow-hidden rounded-[36px] bg-gradient-to-br from-orange-500 via-orange-400 to-yellow-300 p-8 mb-10 shadow-2xl">

    {{-- GLOW --}}
    <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full bg-white/20 blur-3xl"></div>
    <div class="absolute -bottom-24 -left-24 h-72 w-72 rounded-full bg-yellow-100/30 blur-3xl"></div>

    {{-- PATTERN --}}
    <div class="absolute inset-0 opacity-[0.08]"
         style="background-image: radial-gradient(white 1px, transparent 1px); background-size: 22px 22px;">
    </div>

    <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-6">

        <div>

            <span class="inline-flex rounded-full bg-white/20 px-4 py-2 text-xs font-black uppercase tracking-widest text-white backdrop-blur">
                Promo & Diskon
            </span>

            <h1 class="mt-5 text-5xl font-black tracking-tight text-white">
                Manajemen Kupon
            </h1>

            <p class="mt-3 max-w-2xl text-sm leading-relaxed text-orange-50">
                Buat dan kelola kupon promo pelanggan MakanYuk dengan tampilan admin modern dan lebih interaktif.
            </p>

        </div>

    </div>

</div>

@if(session('success'))

    <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-bold text-green-700 shadow-sm">

        {{ session('success') }}

    </div>

@endif

<div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

    {{-- FORM --}}
    <div class="relative overflow-hidden rounded-[32px] border border-white/60 bg-white/80 shadow-2xl backdrop-blur-xl">

        {{-- BACKGROUND --}}
        <div class="absolute inset-0 bg-gradient-to-br from-orange-50/40 via-white to-yellow-50/40"></div>

        <div class="absolute top-0 right-0 h-56 w-56 rounded-full bg-orange-200/30 blur-3xl"></div>

        <div class="relative p-8">

            <div class="mb-8">

                <span class="inline-flex rounded-full bg-orange-100 px-4 py-2 text-[11px] font-black uppercase tracking-widest text-orange-600 shadow-sm">
                    Tambah Kupon
                </span>

                <h2 class="mt-4 text-3xl font-black text-gray-900">
                    Buat Promo Baru
                </h2>

                <p class="mt-2 text-sm text-gray-500">
                    Isi detail promo untuk pelanggan MakanYuk.
                </p>

            </div>

            <form action="{{ route('admin.kupon.store') }}"
                  method="POST"
                  class="space-y-5">

                @csrf

                {{-- KODE --}}
                <div>

                    <label class="mb-2 block text-xs font-black uppercase tracking-widest text-gray-400">
                        Kode Kupon
                    </label>

                    <input type="text"
                           name="kode_kupon"
                           class="w-full rounded-2xl border border-gray-200 bg-white p-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100"
                           placeholder="Contoh: MAKANYUKHEMAT"
                           required>

                </div>

                {{-- JENIS & NILAI --}}
                <div class="grid grid-cols-2 gap-4">

                    <div>

                        <label class="mb-2 block text-xs font-black uppercase tracking-widest text-gray-400">
                            Jenis
                        </label>

                        <select name="jenis_diskon"
                                class="w-full rounded-2xl border border-gray-200 bg-white p-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100">

                            <option value="nominal">
                                Rupiah (Rp)
                            </option>

                            <option value="persen">
                                Persen (%)
                            </option>

                        </select>

                    </div>

                    <div>

                        <label class="mb-2 block text-xs font-black uppercase tracking-widest text-gray-400">
                            Nilai
                        </label>

                        <input type="number"
                               name="nilai_diskon"
                               class="w-full rounded-2xl border border-gray-200 bg-white p-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100"
                               placeholder="5000"
                               required>

                    </div>

                </div>

                {{-- MIN PEMBELIAN --}}
                <div>

                    <label class="mb-2 block text-xs font-black uppercase tracking-widest text-gray-400">
                        Minimum Pembelian
                    </label>

                    <input type="number"
                           name="min_pembelian"
                           value="0"
                           class="w-full rounded-2xl border border-gray-200 bg-white p-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100"
                           required>

                </div>

                {{-- KUOTA & EXPIRED --}}
                <div class="grid grid-cols-2 gap-4">

                    <div>

                        <label class="mb-2 block text-xs font-black uppercase tracking-widest text-gray-400">
                            Kuota
                        </label>

                        <input type="number"
                               name="kuota"
                               class="w-full rounded-2xl border border-gray-200 bg-white p-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100"
                               placeholder="50"
                               required>

                    </div>

                    <div>

                        <label class="mb-2 block text-xs font-black uppercase tracking-widest text-gray-400">
                            Expired
                        </label>

                        <input type="date"
                               name="berlaku_sampai"
                               class="w-full rounded-2xl border border-gray-200 bg-white p-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100"
                               required>

                    </div>

                </div>

                {{-- BUTTON --}}
                <button type="submit"
                        class="w-full rounded-2xl bg-orange-600 py-4 text-sm font-black uppercase tracking-wide text-white shadow-xl shadow-orange-200 transition-all duration-300 hover:-translate-y-1 hover:bg-orange-700 active:scale-95">

                    Simpan Kupon Promo

                </button>

            </form>

        </div>

    </div>

    {{-- TABLE --}}
    <div class="xl:col-span-2 relative overflow-hidden rounded-[32px] border border-white/60 bg-white/80 shadow-2xl backdrop-blur-xl">

        {{-- BACKGROUND --}}
        <div class="absolute inset-0 bg-gradient-to-br from-orange-50/40 via-white to-yellow-50/40"></div>

        <div class="absolute bottom-0 left-0 h-72 w-72 rounded-full bg-yellow-200/20 blur-3xl"></div>

        <div class="relative">

            <div class="flex items-center justify-between border-b border-orange-100 px-8 py-6">

                <div>

                    <h2 class="text-2xl font-black text-gray-900">
                        Daftar Kupon Aktif
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Semua promo yang tersedia untuk pelanggan.
                    </p>

                </div>

                <div class="rounded-2xl bg-orange-100 px-5 py-3 text-sm font-black text-orange-600 shadow-sm">

                    {{ $kupons->count() }} Kupon

                </div>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full border-collapse text-left">

                    <thead>

                        <tr class="border-b border-orange-100 bg-white/60 backdrop-blur-xl">

                            <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-gray-500">
                                Kode
                            </th>

                            <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-gray-500">
                                Potongan
                            </th>

                            <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-gray-500">
                                Min. Belanja
                            </th>

                            <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-gray-500">
                                Kuota
                            </th>

                            <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-gray-500">
                                Expired
                            </th>

                            <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-gray-500 text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($kupons as $k)

                            <tr class="border-b border-orange-50 transition-all duration-300 hover:bg-orange-50/40">

                                {{-- KODE --}}
                                <td class="px-6 py-5">

                                    <span class="inline-flex rounded-full bg-orange-100 px-4 py-2 text-xs font-black uppercase tracking-wide text-orange-600 shadow-sm">

                                        {{ $k->kode_kupon }}

                                    </span>

                                </td>

                                {{-- DISKON --}}
                                <td class="px-6 py-5">

                                    <div class="text-sm font-black text-gray-900">

                                        {{ $k->jenis_diskon == 'nominal'
                                            ? 'Rp '.number_format($k->nilai_diskon, 0, ',', '.')
                                            : $k->nilai_diskon.'%' }}

                                    </div>

                                </td>

                                {{-- MIN --}}
                                <td class="px-6 py-5">

                                    <div class="rounded-2xl bg-white/70 border border-orange-100 px-4 py-3 text-sm font-bold text-gray-700 shadow-sm inline-flex">

                                        Rp {{ number_format($k->min_pembelian, 0, ',', '.') }}

                                    </div>

                                </td>

                                {{-- KUOTA --}}
                                <td class="px-6 py-5">

                                    <span class="inline-flex rounded-full bg-yellow-100 px-4 py-2 text-xs font-black text-yellow-700 shadow-sm">

                                        {{ $k->kuota }} Kali

                                    </span>

                                </td>

                                {{-- EXPIRED --}}
                                <td class="px-6 py-5">

                                    @if($k->berlaku_sampai->isPast())

                                        <span class="inline-flex rounded-full bg-red-100 px-4 py-2 text-xs font-black text-red-700 shadow-sm">

                                            {{ $k->berlaku_sampai->format('d M Y') }}

                                        </span>

                                    @else

                                        <span class="inline-flex rounded-full bg-green-100 px-4 py-2 text-xs font-black text-green-700 shadow-sm">

                                            {{ $k->berlaku_sampai->format('d M Y') }}

                                        </span>

                                    @endif

                                </td>

                                {{-- AKSI --}}
                                <td class="px-6 py-5 text-center">

                                    <form action="{{ route('admin.kupon.destroy', $k->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus kupon ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="inline-flex rounded-2xl bg-red-500 px-5 py-3 text-xs font-black uppercase tracking-wide text-white shadow-lg shadow-red-100 transition-all duration-300 hover:-translate-y-1 hover:bg-red-600 active:scale-95">

                                            Hapus

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="px-6 py-24 text-center">

                                    <div class="mx-auto flex h-28 w-28 items-center justify-center rounded-full bg-gradient-to-br from-orange-100 to-yellow-100 shadow-2xl">

                                        <svg class="h-14 w-14 text-orange-500"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M12 8c-1.657 0-3 1.343-3 3m0 0c0 1.657 1.343 3 3 3m-3-3h6">
                                            </path>

                                        </svg>

                                    </div>

                                    <h3 class="mt-8 text-3xl font-black text-gray-900">
                                        Belum Ada Kupon
                                    </h3>

                                    <p class="mt-3 text-sm text-gray-500">
                                        Kupon promo yang dibuat akan tampil di halaman ini.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection