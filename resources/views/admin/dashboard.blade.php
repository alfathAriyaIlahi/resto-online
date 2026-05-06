@extends('layouts.app')

@section('content')
<div class="flex overflow-hidden bg-white">
    <aside class="fixed inset-y-0 left-0 z-20 flex-col flex-shrink-0 hidden w-64 pt-16 font-normal duration-75 lg:flex transition-width" aria-label="Sidebar">
        <div class="relative flex flex-col flex-1 min-h-0 pt-0 bg-white border-r border-gray-200">
            <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
                <div class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-200">
                    <ul class="pb-2 space-y-2">
                        <li>
                            <a href="{{ route('admin.kategori.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('admin.kategori.*') ? 'bg-gray-100' : '' }}">
                                <span class="ml-3">Manajemen Kategori</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.produk.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('admin.produk.*') ? 'bg-gray-100' : '' }}">
                                <span class="ml-3">Manajemen Produk</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.reservasi.index') }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group {{ request()->routeIs('admin.reservasi.*') ? 'bg-gray-100' : '' }}">
                                <span class="ml-3">Reservasi</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>

    <div class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64">
        <div class="px-4 pt-6">
            <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                @yield('admin_content')
            </div>
        </div>
    </div>
</div>
@endsection
