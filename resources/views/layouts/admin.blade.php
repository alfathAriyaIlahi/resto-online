<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - MakanYuk</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-white border-r border-gray-200 hidden md:block">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-orange-600">Admin Panel</h2>
                <p class="text-xs text-gray-400">MakanYuk Control Center</p>
            </div>
            <nav class="mt-4 px-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition group">
                    <span class="font-medium">Dashboard Overview</span>
                </a>
                <a href="{{ route('admin.kategori.index') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition">
                    <span class="font-medium">Kategori Produk</span>
                </a>
                <a href="{{ route('admin.produk.index') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition">
                    <span class="font-medium">Daftar Produk</span>
                </a>
                <a href="{{ route('admin.reservasi.index') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition">
                    <span class="font-medium">Reservasi</span>
                </a>
            </nav>
        </aside>

        <main class="flex-1">

            <header class="bg-white border-b border-gray-200 px-8 py-4 flex justify-between items-center">
                <div class="text-sm text-gray-500">Selamat datang kembali, <strong>{{ Auth::user()->name }}</strong></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm font-semibold text-red-500 hover:text-red-700">Logout</button>
                </form>
            </header>

            <div class="p-8">
                @yield('admin_content')
            </div>
        </main>
    </div>
</body>
</html>
