@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-200 hidden md:block">
        <div class="p-6">
            <h2 class="text-lg font-bold text-orange-600">Admin Panel</h2>
        </div>
        <nav class="mt-2">
            <a href="{{ route('admin.kategori.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-600 {{ request()->routeIs('admin.kategori.*') ? 'bg-orange-50 text-orange-600 border-r-4 border-orange-600' : '' }}">
                <span class="mx-3">Kategori Produk</span>
            </a>
            <a href="{{ route('admin.produk.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-600 {{ request()->routeIs('admin.produk.*') ? 'bg-orange-50 text-orange-600 border-r-4 border-orange-600' : '' }}">
                <span class="mx-3">Daftar Produk</span>
            </a>
            <a href="{{ route('admin.reservasi.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-600 {{ request()->routeIs('admin.reservasi.*') ? 'bg-orange-50 text-orange-600 border-r-4 border-orange-600' : '' }}">
                <span class="mx-3">Reservasi</span>
            </a>
        </nav>
    </aside>

    <div class="flex-1 p-8">
        <div class="bg-white rounded-lg shadow-sm p-6">
            @yield('admin_content')
        </div>
    </div>
</div>
@endsection
