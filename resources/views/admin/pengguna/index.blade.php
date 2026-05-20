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
                Pengguna
            </span>

            <h1 class="mt-5 text-5xl font-black tracking-tight text-white">
                Daftar Pengguna
            </h1>

            <p class="mt-3 max-w-xl text-sm leading-relaxed text-orange-50">
                Pantau seluruh pelanggan yang telah terdaftar pada sistem MakanYuk.
            </p>

        </div>

        <div class="rounded-3xl border border-white/20 bg-white/15 px-8 py-6 backdrop-blur-xl shadow-2xl">

            <p class="text-xs font-black uppercase tracking-widest text-orange-100">
                Total Pengguna
            </p>

            <div class="mt-3 flex items-center gap-3">

                <div class="h-4 w-4 rounded-full bg-green-300 shadow-lg shadow-green-300/50"></div>

                <h2 class="text-5xl font-black text-white">
                    {{ $total_users }}
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
                        No
                    </th>

                    <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-gray-500">
                        Pengguna
                    </th>

                    <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-gray-500">
                        Email
                    </th>

                    <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-gray-500">
                        Nomor HP
                    </th>

                    <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-gray-500">
                        Alamat
                    </th>

                    <th class="px-6 py-5 text-xs font-black uppercase tracking-widest text-gray-500 text-right">
                        Tanggal Daftar
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($users as $index => $user)

                    <tr class="border-b border-orange-50 transition-all duration-300 hover:bg-orange-50/40">

                        {{-- NOMOR --}}
                        <td class="px-6 py-5">

                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-orange-500 to-orange-600 text-sm font-black text-white shadow-lg shadow-orange-200">

                                {{ $index + 1 }}

                            </div>

                        </td>

                        {{-- USER --}}
                        <td class="px-6 py-5">

                            <div class="flex items-center gap-4">

                                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-100 text-lg font-black text-orange-600 shadow-sm">

                                    {{ strtoupper(substr($user->name, 0, 1)) }}

                                </div>

                                <div>

                                    <div class="text-sm font-black capitalize text-gray-900">
                                        {{ $user->name }}
                                    </div>

                                    <div class="mt-1 text-xs text-gray-400">
                                        Pelanggan
                                    </div>

                                </div>

                            </div>

                        </td>

                        {{-- EMAIL --}}
                        <td class="px-6 py-5">

                            <div class="rounded-2xl bg-white/70 border border-orange-100 px-4 py-3 shadow-sm">

                                <div class="text-sm font-bold text-gray-700">
                                    {{ $user->email }}
                                </div>

                            </div>

                        </td>

                        {{-- HP --}}
                        <td class="px-6 py-5">

                            <span class="inline-flex rounded-full bg-orange-100 px-4 py-2 text-xs font-black text-orange-600 shadow-sm">

                                {{ $user->nomor_hp ?? '-' }}

                            </span>

                        </td>

                        {{-- ALAMAT --}}
                        <td class="px-6 py-5">

                            <div class="max-w-xs rounded-2xl border border-orange-100 bg-white/70 px-4 py-3 text-sm text-gray-600 shadow-sm truncate"
                                 title="{{ $user->alamat }}">

                                {{ $user->alamat ?? 'Belum diisi' }}

                            </div>

                        </td>

                        {{-- TANGGAL --}}
                        <td class="px-6 py-5 text-right">

                            <div class="text-sm font-bold text-gray-700">
                                {{ $user->created_at->format('d M Y') }}
                            </div>

                            <div class="mt-1 text-xs text-gray-400">
                                {{ $user->created_at->format('H:i') }} WIB
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
                                          d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z">
                                    </path>

                                </svg>

                            </div>

                            <h3 class="mt-8 text-3xl font-black text-gray-900">
                                Belum Ada Pengguna
                            </h3>

                            <p class="mt-3 text-sm text-gray-500">
                                Data pelanggan yang mendaftar akan tampil di halaman ini.
                            </p>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection