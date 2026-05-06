@extends('layouts.admin')

@section('admin_content')
<div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Dashboard Overview</h1>
        <p class="text-sm text-gray-500 mt-1">Pantau performa dan ringkasan aktivitas MakanYuk hari ini.</p>
    </div>
    <div class="mt-4 md:mt-0">
        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
            Sistem Aktif
        </span>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Menu</div>
            <div class="p-2 bg-blue-50 rounded-lg">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-gray-800">{{ \App\Models\Produk::count() }}</div>
        <div class="text-xs text-gray-500 mt-2">Produk terdaftar di katalog</div>
    </div>

    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow border-l-4 border-l-orange-500">
        <div class="flex items-center justify-between mb-4">
            <div class="text-xs font-bold text-gray-400 uppercase tracking-wider">Reservasi</div>
            <div class="p-2 bg-orange-50 rounded-lg">
                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-orange-600">{{ \App\Models\Reservasi::count() }}</div>
        <div class="text-xs text-gray-500 mt-2">Total pesanan meja masuk</div>
    </div>

    <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="text-xs font-bold text-gray-400 uppercase tracking-wider">Kategori</div>
            <div class="p-2 bg-purple-50 rounded-lg">
                <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </div>
        </div>
        <div class="text-3xl font-bold text-gray-800">{{ \App\Models\Kategori::count() }}</div>
        <div class="text-xs text-gray-500 mt-2">Pengelompokan jenis menu</div>
    </div>
</div>

<div class="relative overflow-hidden bg-orange-600 rounded-2xl shadow-lg">
    <div class="absolute top-0 right-0 -m-4 opacity-10">
        <svg class="w-48 h-48" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
        </svg>
    </div>
    <div class="relative p-8 md:p-10">
        <h2 class="text-2xl font-bold text-white mb-2">Selamat Datang!</h2>
        <p class="text-orange-100 max-w-md">
        </p>
        <div class="mt-6 flex gap-3">
            <a href="{{ route('admin.reservasi.index') }}" class="inline-flex items-center px-4 py-2 bg-white text-orange-600 text-sm font-bold rounded-lg hover:bg-orange-50 transition">
                Cek Reservasi Sekarang
            </a>
            <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-orange-700 text-white text-sm font-bold rounded-lg hover:bg-orange-800 transition">
                Lihat Website
            </a>
        </div>
    </div>
</div>
@endsection
