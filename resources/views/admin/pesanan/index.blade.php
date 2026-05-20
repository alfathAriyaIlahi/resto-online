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
                Pesanan
            </span>

            <h1 class="mt-5 text-5xl font-black tracking-tight text-white">
                Daftar Pesanan
            </h1>

            <p class="mt-3 max-w-xl text-sm leading-relaxed text-orange-50">
                Pantau pembayaran pelanggan dan status pesanan secara real-time dari dashboard admin.
            </p>

        </div>

        <div class="rounded-3xl border border-white/20 bg-white/15 px-8 py-6 backdrop-blur-xl shadow-2xl">

            <p class="text-xs font-black uppercase tracking-widest text-orange-100">
                Total Pesanan
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

    {{-- BACKGROUND --}}
    <div class="absolute inset-0 bg-gradient-to-br from-orange-50/40 via-white to-yellow-50/40"></div>

    <div class="absolute top-0 right-0 h-72 w-72 rounded-full bg-orange-200/30 blur-3xl"></div>

    <div class="absolute bottom-0 left-0 h-72 w-72 rounded-full bg-yellow-200/30 blur-3xl"></div>

    <div class="relative overflow-x-auto">

        <table class="w-full border-collapse text-left">

            <thead>

                <tr class="border-b border-orange-100 bg-white/70 backdrop-blur-xl">

                    <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-gray-500">
                        ID Order
                    </th>

                    <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-gray-500">
                        Pelanggan
                    </th>

                    <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-gray-500">
                        Total Harga
                    </th>

                    <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-gray-500">
                        Metode
                    </th>

                    <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-gray-500 text-center">
                        Status
                    </th>

                    <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-gray-500 text-right">
                        Tanggal
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse ($pesanans as $item)

                    <tr class="border-b border-orange-50 transition-all duration-300 hover:bg-orange-50/40">

                        {{-- ORDER --}}
                        <td class="px-6 py-5">

                            <div class="flex items-center gap-3">

                                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-orange-500 to-orange-600 text-sm font-black text-white shadow-lg shadow-orange-200">

                                    #{{ $item->id }}

                                </div>

                                <div>

                                    <div class="text-sm font-black text-gray-900">
                                        ORDER
                                    </div>

                                    <div class="text-xs text-gray-400">
                                        MIDTRANS
                                    </div>

                                </div>

                            </div>

                        </td>

                        {{-- PELANGGAN --}}
                        <td class="px-6 py-5">

                            <div>

                                <div class="text-sm font-black capitalize text-gray-900">
                                    {{ $item->nama_pelanggan }}
                                </div>

                                <div class="mt-1 text-xs text-gray-400">
                                    {{ $item->nomor_hp }}
                                </div>

                            </div>

                        </td>

                        {{-- HARGA --}}
                        <td class="px-6 py-5">

                            <span class="inline-flex rounded-full bg-orange-100 px-4 py-2 text-xs font-black text-orange-600 shadow-sm">

                                Rp {{ number_format($item->total_harga, 0, ',', '.') }}

                            </span>

                        </td>

                        {{-- METODE --}}
                        <td class="px-6 py-5">

                            <div class="rounded-2xl bg-white/70 border border-orange-100 px-4 py-3 text-xs font-bold uppercase tracking-wide text-gray-600 shadow-sm inline-flex">

                                {{ str_replace('_', ' ', $item->metode_pengiriman) }}

                            </div>

                        </td>

                        {{-- STATUS --}}
                        <td class="px-6 py-5 text-center">

                            @if($item->status == 'pending')

                                <span class="inline-flex rounded-full bg-yellow-100 px-4 py-2 text-[11px] font-black uppercase tracking-wide text-yellow-700 shadow-sm">

                                    Menunggu Pembayaran

                                </span>

                            @elseif($item->status == 'dibayar')

                                <span class="inline-flex rounded-full bg-green-100 px-4 py-2 text-[11px] font-black uppercase tracking-wide text-green-700 shadow-sm">

                                    Sudah Dibayar

                                </span>

                            @else

                                <span class="inline-flex rounded-full bg-red-100 px-4 py-2 text-[11px] font-black uppercase tracking-wide text-red-700 shadow-sm">

                                    {{ $item->status }}

                                </span>

                            @endif

                        </td>

                        {{-- TANGGAL --}}
                        <td class="px-6 py-5 text-right">

                            <div class="text-sm font-bold text-gray-700">
                                {{ $item->created_at->format('d M Y') }}
                            </div>

                            <div class="mt-1 text-xs text-gray-400">
                                {{ $item->created_at->format('H:i') }} WIB
                            </div>

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
                                          d="M3 3h18v18H3V3z">
                                    </path>

                                </svg>

                            </div>

                            <h3 class="mt-8 text-3xl font-black text-gray-900">
                                Belum Ada Pesanan
                            </h3>

                            <p class="mt-3 text-sm text-gray-500">
                                Pesanan pelanggan akan muncul di halaman ini.
                            </p>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection