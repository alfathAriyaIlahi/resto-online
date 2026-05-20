<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        Admin Panel - MakanYuk
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- FONT --}}
    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">

    {{-- ALPINE JS --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
            defer></script>

</head>

<body class="bg-gradient-to-br from-[#fff7ed] via-[#fffaf5] to-[#fef3c7] antialiased overflow-x-hidden"
      style="font-family: 'Plus Jakarta Sans', sans-serif;">

    <div class="flex min-h-screen">

        {{-- SIDEBAR --}}
        <aside class="hidden md:flex md:w-72 flex-col relative overflow-hidden border-r border-orange-200/20 bg-gradient-to-b from-[#1c1c1c] via-[#242424] to-[#111111] shadow-[0_0_80px_rgba(0,0,0,0.45)]">

            {{-- GLOW --}}
            <div class="absolute -top-20 -left-20 h-72 w-72 rounded-full bg-orange-500/20 blur-3xl"></div>

            <div class="absolute bottom-0 right-0 h-72 w-72 rounded-full bg-yellow-500/10 blur-3xl"></div>

            {{-- GRID PATTERN --}}
            <div class="absolute inset-0 opacity-[0.03]"
                 style="background-image: radial-gradient(white 1px, transparent 1px); background-size: 24px 24px;">
            </div>

            {{-- BRAND --}}
            <div class="relative p-8 border-b border-white/10">

                <div class="flex items-center gap-4">

                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-orange-500 to-orange-400 text-xl font-black text-white shadow-2xl shadow-orange-500/30">

                        M

                    </div>

                    <div>

                        <h2 class="text-3xl font-extrabold tracking-tight text-white">
                            MakanYuk
                        </h2>

                        <p class="mt-1 text-xs font-semibold tracking-wide text-orange-300/70">
                            Admin Control Center
                        </p>

                    </div>

                </div>

            </div>

            {{-- NAVIGATION --}}
            <nav class="relative flex-1 px-5 py-6 space-y-3">

                <a href="{{ route('admin.dashboard') }}"
                   class="group flex items-center gap-4 rounded-2xl px-5 py-4 text-sm transition-all duration-300
                   {{ request()->routeIs('admin.dashboard')
                        ? 'bg-gradient-to-r from-orange-500 to-orange-400 text-white font-extrabold shadow-2xl shadow-orange-500/20'
                        : 'text-gray-300 hover:bg-white/10 hover:text-white hover:translate-x-1' }}">

                    <span class="font-bold">
                        Dashboard Overview
                    </span>

                </a>

                <a href="{{ route('admin.kategori.index') }}"
                   class="group flex items-center gap-4 rounded-2xl px-5 py-4 text-sm transition-all duration-300
                   {{ request()->routeIs('admin.kategori.*')
                        ? 'bg-gradient-to-r from-orange-500 to-orange-400 text-white font-extrabold shadow-2xl shadow-orange-500/20'
                        : 'text-gray-300 hover:bg-white/10 hover:text-white hover:translate-x-1' }}">

                    <span class="font-bold">
                        Kategori Produk
                    </span>

                </a>

                <a href="{{ route('admin.produk.index') }}"
                   class="group flex items-center gap-4 rounded-2xl px-5 py-4 text-sm transition-all duration-300
                   {{ request()->routeIs('admin.produk.*')
                        ? 'bg-gradient-to-r from-orange-500 to-orange-400 text-white font-extrabold shadow-2xl shadow-orange-500/20'
                        : 'text-gray-300 hover:bg-white/10 hover:text-white hover:translate-x-1' }}">

                    <span class="font-bold">
                        Daftar Produk
                    </span>

                </a>

                <a href="{{ route('admin.reservasi.index') }}"
                   class="group flex items-center gap-4 rounded-2xl px-5 py-4 text-sm transition-all duration-300
                   {{ request()->routeIs('admin.reservasi.*')
                        ? 'bg-gradient-to-r from-orange-500 to-orange-400 text-white font-extrabold shadow-2xl shadow-orange-500/20'
                        : 'text-gray-300 hover:bg-white/10 hover:text-white hover:translate-x-1' }}">

                    <span class="font-bold">
                        Reservasi
                    </span>

                </a>

                <a href="{{ route('admin.pesanan.index') }}"
                   class="group flex items-center gap-4 rounded-2xl px-5 py-4 text-sm transition-all duration-300
                   {{ request()->routeIs('admin.pesanan.*')
                        ? 'bg-gradient-to-r from-orange-500 to-orange-400 text-white font-extrabold shadow-2xl shadow-orange-500/20'
                        : 'text-gray-300 hover:bg-white/10 hover:text-white hover:translate-x-1' }}">

                    <span class="font-bold">
                        Daftar Pesanan
                    </span>

                </a>

                <a href="{{ route('admin.kupon.index') }}"
                   class="group flex items-center gap-4 rounded-2xl px-5 py-4 text-sm transition-all duration-300
                   {{ request()->routeIs('admin.kupon.*')
                        ? 'bg-gradient-to-r from-orange-500 to-orange-400 text-white font-extrabold shadow-2xl shadow-orange-500/20'
                        : 'text-gray-300 hover:bg-white/10 hover:text-white hover:translate-x-1' }}">

                    <span class="font-bold">
                        Manajemen Kupon
                    </span>

                </a>

                <a href="{{ route('admin.pengguna.index') }}"
                   class="group flex items-center gap-4 rounded-2xl px-5 py-4 text-sm transition-all duration-300
                   {{ request()->routeIs('admin.pengguna.*')
                        ? 'bg-gradient-to-r from-orange-500 to-orange-400 text-white font-extrabold shadow-2xl shadow-orange-500/20'
                        : 'text-gray-300 hover:bg-white/10 hover:text-white hover:translate-x-1' }}">

                    <span class="font-bold">
                        Daftar Pengguna
                    </span>

                </a>

            </nav>

            {{-- BOTTOM --}}
            <div class="relative p-5 border-t border-white/10">

                <a href="{{ route('home') }}"
                   target="_blank"
                   class="mb-3 flex items-center justify-center rounded-2xl bg-white/10 px-5 py-4 text-sm font-extrabold text-white transition hover:bg-white/20">

                    Lihat Website

                </a>

                <form method="POST"
                      action="{{ route('logout') }}">

                    @csrf

                    <button type="submit"
                            class="w-full rounded-2xl bg-red-500/10 px-5 py-4 text-sm font-extrabold text-red-300 transition hover:bg-red-500/20">

                        Logout

                    </button>

                </form>

            </div>

        </aside>

        {{-- MAIN --}}
        <main class="flex-1 min-w-0 relative">

            {{-- TOPBAR --}}
            <header class="sticky top-0 z-40 border-b border-white/20 bg-white/50 backdrop-blur-2xl px-6 py-5 shadow-lg md:px-8">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-xs font-black uppercase tracking-widest text-orange-500">
                            Admin Dashboard
                        </p>

                        <h1 class="mt-1 text-lg font-extrabold text-gray-900">
                            Selamat datang kembali, {{ Auth::user()->name }}
                        </h1>

                    </div>

                    <div class="hidden sm:flex items-center gap-4">

                        <div class="flex items-center gap-2 rounded-2xl bg-green-100 px-5 py-3 shadow-sm">

                            <div class="h-2.5 w-2.5 rounded-full bg-green-500 animate-pulse"></div>

                            <span class="text-sm font-bold text-green-700">
                                Online
                            </span>

                        </div>

                    </div>

                </div>

            </header>

            {{-- CONTENT --}}
            <div class="relative p-6 md:p-8">

                {{-- BACKGROUND GLOW --}}
                <div class="pointer-events-none absolute top-0 right-0 h-96 w-96 rounded-full bg-orange-200/20 blur-3xl"></div>

                <div class="pointer-events-none absolute bottom-0 left-0 h-96 w-96 rounded-full bg-yellow-200/20 blur-3xl"></div>

                <div class="relative">

                    @yield('admin_content')

                </div>

            </div>

        </main>

    </div>

</body>

</html>