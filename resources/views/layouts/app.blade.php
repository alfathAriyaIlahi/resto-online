<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.clientKey') }}">
    </script>

    <title>{{ config('app.name', 'MakanYuk') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 flex flex-col">

        @include('layouts.navigation')

        @isset($header)
            <header class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main class="flex-grow">
            @if(isset($slot))
                {{ $slot }}
            @else
                @yield('content')
            @endif
        </main>

        <footer class="bg-gray-900 text-gray-300 mt-auto">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                    <div>
                        <h3 class="text-white text-lg font-bold mb-4">
                            MakanYuk.
                        </h3>

                        <p class="text-sm">
                            Menyajikan hidangan terbaik dengan bahan segar pilihan setiap hari langsung ke meja Anda.
                        </p>
                    </div>

                    <div>
                        <h4 class="text-white font-semibold mb-4">
                            Navigasi
                        </h4>

                        <ul class="text-sm space-y-2">
                            <li>
                                <a href="{{ route('home') }}" class="text-white hover:text-orange-400 transition font-semibold">
                                    Home
                                </a>
                            </li>

                            @if(request()->routeIs('home'))
                                <li>
                                    <a href="#menu" class="hover:text-white transition">
                                        Menu
                                    </a>
                                </li>

                                <li>
                                    <a href="#reservasi-form" class="hover:text-white transition">
                                        Reservasi
                                    </a>
                                </li>

                                <li>
                                    <a href="#tentang-kami" class="hover:text-white transition">
                                        Tentang Kami
                                    </a>
                                </li>
                            @else
                                <li>
                                    <span class="text-gray-600 cursor-not-allowed">
                                        Menu
                                    </span>
                                </li>

                                <li>
                                    <span class="text-gray-600 cursor-not-allowed">
                                        Reservasi
                                    </span>
                                </li>

                                <li>
                                    <span class="text-gray-600 cursor-not-allowed">
                                        Tentang Kami
                                    </span>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <div>
                        <h4 class="text-white font-semibold mb-4">
                            Kontak
                        </h4>

                        <p class="text-sm">
                            Jl. Teuku Umar No. 12, Bandar Lampung
                        </p>

                        <p class="text-sm">
                            Email: info@makanyuk.id
                        </p>
                    </div>

                </div>

                <div class="border-t border-gray-800 mt-10 pt-8 text-center text-xs">
                    <p>
                        &copy; {{ date('Y') }} MakanYuk. Semua Hak Dilindungi.
                    </p>
                </div>

            </div>
        </footer>

    </div>
</body>

</html>