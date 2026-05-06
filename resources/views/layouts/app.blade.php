<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'MakanYuk') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 flex flex-col">

            {{-- 1. Navigasi User/Admin (Breeze) --}}
            @include('layouts.navigation')

            {{-- 2. HEADER RESTORAN (Navigasi Utama Resto) --}}
            <nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-40">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16">
                        <!-- Nama Resto/Logo -->
                        <div class="flex items-center">
                            <a href="{{ route('home') }}" class="text-2xl font-bold text-orange-600">
                                MakanYuk<span class="text-gray-800">.</span>
                            </a>
                        </div>

                        <!-- Link Navigasi (Opsional) -->
                        <div class="hidden md:flex space-x-6">
                            <a href="{{ route('home') }}" class="text-sm font-medium text-gray-700 hover:text-orange-600">Katalog Menu</a>
                            <a href="#" class="text-sm font-medium text-gray-700 hover:text-orange-600">Promo</a>
                            <a href="#" class="text-sm font-medium text-gray-700 hover:text-orange-600">Tentang Kami</a>
                        </div>
                    </div>
                </div>
            </nav>

            {{-- 3. HEADER HALAMAN (Hanya muncul di halaman tertentu seperti Dashboard) --}}
            @isset($header)
                <header class="bg-white shadow-sm">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            {{-- 4. KONTEN UTAMA --}}
            <main class="flex-grow">
                @if(isset($slot))
                    {{ $slot }}
                @else
                    @yield('content')
                @endif
            </main>

            {{-- 5. FOOTER RESTORAN --}}
            <footer class="bg-gray-900 text-gray-300 mt-auto">
                <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div>
                            <h3 class="text-white text-lg font-bold mb-4">MakanYuk.</h3>
                            <p class="text-sm">Menyajikan hidangan terbaik dengan bahan segar pilihan setiap hari langsung ke meja Anda.</p>
                        </div>
                        <div>
                            <h4 class="text-white font-semibold mb-4">Navigasi</h4>
                            <ul class="text-sm space-y-2">
                                <li><a href="{{ route('home') }}" class="hover:text-white">Beranda</a></li>
                                <li><a href="#" class="hover:text-white">Menu Favorit</a></li>
                                <li><a href="#" class="hover:text-white">Reservasi</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="text-white font-semibold mb-4">Kontak</h4>
                            <p class="text-sm">Jl. Teuku Umar No. 12, Bandar Lampung</p>
                            <p class="text-sm">Email: info@makanyuk.id</p>
                        </div>
                    </div>
                    <div class="border-t border-gray-800 mt-10 pt-8 text-center text-xs">
                        <p>&copy; {{ date('Y') }} MakanYuk. Semua Hak Dilindungi.</p>
                    </div>
                </div>
            </footer>

        </div>
    </body>
</html>
