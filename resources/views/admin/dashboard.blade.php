@extends('layouts.admin')

@section('admin_content')

<div class="relative overflow-hidden rounded-[32px] bg-gradient-to-br from-orange-600 via-orange-500 to-yellow-400 p-8 mb-8 shadow-2xl">

    <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full bg-white/20 blur-3xl"></div>
    <div class="absolute -bottom-24 -left-24 h-72 w-72 rounded-full bg-yellow-200/30 blur-3xl"></div>

    <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-6">

        <div>
            <span class="inline-flex rounded-full bg-white/20 px-4 py-2 text-xs font-bold uppercase tracking-widest text-white">
                Admin Panel
            </span>

            <h1 class="mt-5 text-4xl font-black text-white">
                Dashboard Overview
            </h1>

            <p class="mt-3 max-w-xl text-sm leading-relaxed text-orange-50">
                Pantau performa menu, reservasi, kategori, dan aktivitas MakanYuk secara cepat dari satu halaman.
            </p>
        </div>

        <div class="rounded-3xl bg-white/20 px-6 py-5 backdrop-blur-xl border border-white/30">
            <p class="text-xs font-bold uppercase tracking-widest text-orange-50">
                Status Sistem
            </p>

            <div class="mt-2 flex items-center gap-2">
                <span class="h-3 w-3 rounded-full bg-green-300 shadow-lg shadow-green-300/50"></span>
                <span class="text-lg font-black text-white">
                    Aktif
                </span>
            </div>
        </div>

    </div>

</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

    <div class="group relative overflow-hidden rounded-[28px] border border-white/60 bg-white p-7 shadow-xl transition-all duration-300 hover:-translate-y-2 hover:shadow-orange-200/70">
        <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-blue-100"></div>

        <div class="relative flex items-center justify-between mb-6">
            <div>
                <p class="text-xs font-black text-gray-400 uppercase tracking-widest">
                    Total Menu
                </p>

                <h2 class="mt-3 text-4xl font-black text-gray-900">
                    {{ \App\Models\Produk::count() }}
                </h2>
            </div>

            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-blue-500 transition group-hover:scale-110">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
        </div>

        <p class="relative text-sm text-gray-500">
            Produk aktif yang sudah terdaftar di katalog menu.
        </p>
    </div>

    <div class="group relative overflow-hidden rounded-[28px] border border-orange-100 bg-white p-7 shadow-xl transition-all duration-300 hover:-translate-y-2 hover:shadow-orange-200/70">
        <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-orange-100"></div>

        <div class="relative flex items-center justify-between mb-6">
            <div>
                <p class="text-xs font-black text-gray-400 uppercase tracking-widest">
                    Reservasi
                </p>

                <h2 class="mt-3 text-4xl font-black text-orange-600">
                    {{ \App\Models\Reservasi::count() }}
                </h2>
            </div>

            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-50 text-orange-500 transition group-hover:scale-110">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        </div>

        <p class="relative text-sm text-gray-500">
            Total permintaan meja yang masuk dari pelanggan.
        </p>
    </div>

    <div class="group relative overflow-hidden rounded-[28px] border border-white/60 bg-white p-7 shadow-xl transition-all duration-300 hover:-translate-y-2 hover:shadow-orange-200/70">
        <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-purple-100"></div>

        <div class="relative flex items-center justify-between mb-6">
            <div>
                <p class="text-xs font-black text-gray-400 uppercase tracking-widest">
                    Kategori
                </p>

                <h2 class="mt-3 text-4xl font-black text-gray-900">
                    {{ \App\Models\Kategori::count() }}
                </h2>
            </div>

            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-purple-50 text-purple-500 transition group-hover:scale-110">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </div>
        </div>

        <p class="relative text-sm text-gray-500">
            Pengelompokan menu agar katalog terlihat rapi.
        </p>
    </div>

</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <div class="lg:col-span-2 relative overflow-hidden rounded-[32px] bg-gray-900 p-8 shadow-2xl">

        <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full bg-orange-500/30 blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 h-72 w-72 rounded-full bg-yellow-400/20 blur-3xl"></div>

        <div class="relative">
            <span class="inline-flex rounded-full bg-orange-500/20 px-4 py-2 text-xs font-black uppercase tracking-widest text-orange-300">
                Quick Action
            </span>

            <h2 class="mt-5 text-3xl font-black text-white">
                Selamat Datang di Dashboard Admin
            </h2>

            <p class="mt-3 max-w-xl text-sm leading-relaxed text-gray-300">
                Kelola data menu, kategori, reservasi, kupon, dan pesanan pelanggan dengan tampilan yang lebih cepat dan nyaman.
            </p>

            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('admin.reservasi.index') }}"
                   class="inline-flex items-center rounded-2xl bg-white px-5 py-3 text-sm font-black text-gray-900 shadow-lg transition hover:-translate-y-1 hover:bg-orange-50">
                    Cek Reservasi
                </a>

                <a href="{{ route('admin.produk.index') }}"
                   class="inline-flex items-center rounded-2xl bg-orange-600 px-5 py-3 text-sm font-black text-white shadow-lg shadow-orange-900/30 transition hover:-translate-y-1 hover:bg-orange-700">
                    Kelola Menu
                </a>

                <a href="{{ route('home') }}" target="_blank"
                   class="inline-flex items-center rounded-2xl border border-white/20 bg-white/10 px-5 py-3 text-sm font-black text-white backdrop-blur transition hover:-translate-y-1 hover:bg-white/20">
                    Lihat Website
                </a>
            </div>
        </div>

    </div>

    <div class="rounded-[32px] border border-white/60 bg-white p-8 shadow-2xl">
        <h3 class="text-xl font-black text-gray-900">
            Ringkasan Hari Ini
        </h3>

        <div class="mt-6 space-y-4">
            <div class="flex items-center justify-between rounded-2xl bg-orange-50 p-4">
                <span class="text-sm font-bold text-gray-600">
                    Menu
                </span>
                <span class="text-sm font-black text-orange-600">
                    {{ \App\Models\Produk::count() }}
                </span>
            </div>

            <div class="flex items-center justify-between rounded-2xl bg-gray-50 p-4">
                <span class="text-sm font-bold text-gray-600">
                    Reservasi
                </span>
                <span class="text-sm font-black text-gray-900">
                    {{ \App\Models\Reservasi::count() }}
                </span>
            </div>

            <div class="flex items-center justify-between rounded-2xl bg-purple-50 p-4">
                <span class="text-sm font-bold text-gray-600">
                    Kategori
                </span>
                <span class="text-sm font-black text-purple-600">
                    {{ \App\Models\Kategori::count() }}
                </span>
            </div>
        </div>
    </div>

</div>

@endsection