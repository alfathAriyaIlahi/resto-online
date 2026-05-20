<nav x-data="{ open: false }"
     class="sticky top-0 z-50 border-b border-white/30 bg-gradient-to-r from-orange-50 via-white to-orange-100/90 backdrop-blur-xl shadow-lg transition-all duration-500">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between items-center h-20">

            <div class="flex items-center gap-10">

                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset('images/logos.png') }}"
                         alt="MakanYuk Logo"
                         class="h-16 w-auto object-contain transition-all duration-300 hover:scale-110">
                </a>

                <div class="hidden sm:flex items-center gap-8">

                    <a href="{{ route('home') }}"
                       class="text-sm font-semibold text-gray-700 transition-all duration-300 hover:text-orange-600 hover:scale-110 hover:-translate-y-0.5">
                        Home
                    </a>

                    @if(request()->routeIs('home'))

                        <a href="#menu"
                           class="text-sm font-semibold text-gray-700 transition-all duration-300 hover:text-orange-600 hover:scale-110 hover:-translate-y-0.5">
                            Menu
                        </a>

                        <a href="#reservasi-form"
                           class="text-sm font-semibold text-gray-700 transition-all duration-300 hover:text-orange-600 hover:scale-110 hover:-translate-y-0.5">
                            Reservasi
                        </a>

                        <a href="#tentang-kami"
                           class="text-sm font-semibold text-gray-700 transition-all duration-300 hover:text-orange-600 hover:scale-110 hover:-translate-y-0.5">
                            Tentang Kami
                        </a>

                    @else

                        <span class="text-sm font-medium text-gray-400 cursor-not-allowed">
                            Menu
                        </span>

                        <span class="text-sm font-medium text-gray-400 cursor-not-allowed">
                            Reservasi
                        </span>

                        <span class="text-sm font-medium text-gray-400 cursor-not-allowed">
                            Tentang Kami
                        </span>

                    @endif

                    @auth
                        @if(Auth::user()->role === 'admin')

                            <a href="{{ route('admin.kategori.index') }}"
                               class="text-sm font-semibold text-gray-700 transition-all duration-300 hover:text-orange-600 hover:scale-110 hover:-translate-y-0.5">
                                Kategori
                            </a>

                            <a href="{{ route('admin.produk.index') }}"
                               class="text-sm font-semibold text-gray-700 transition-all duration-300 hover:text-orange-600 hover:scale-110 hover:-translate-y-0.5">
                                Produk
                            </a>

                            <a href="{{ route('admin.kupon.index') }}"
                               class="text-sm font-semibold text-gray-700 transition-all duration-300 hover:text-orange-600 hover:scale-110 hover:-translate-y-0.5">
                                Kupon
                            </a>

                            <a href="{{ route('admin.pesanan.index') }}"
                               class="text-sm font-semibold text-gray-700 transition-all duration-300 hover:text-orange-600 hover:scale-110 hover:-translate-y-0.5">
                                Pesanan
                            </a>

                        @endif
                    @endauth

                </div>
            </div>

            <div class="hidden sm:flex sm:items-center">

                @auth

                    <x-dropdown align="right" width="48">

                        <x-slot name="trigger">
                            <button class="inline-flex items-center gap-2 rounded-xl px-4 py-2 text-sm font-semibold text-gray-600 transition-all duration-300 hover:text-orange-600 hover:bg-orange-50 hover:scale-105">

                                <span>{{ Auth::user()->name }}</span>

                                <svg class="h-4 w-4 fill-current"
                                     xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd" />
                                </svg>

                            </button>
                        </x-slot>

                        <x-slot name="content">

                            <x-dropdown-link :href="route('profile.edit')">
                                Profile
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>

                        </x-slot>

                    </x-dropdown>

                @else

                    <div class="flex items-center gap-5">

                        <a href="{{ route('login') }}"
                           class="text-sm font-semibold text-gray-600 transition-all duration-300 hover:text-orange-600 hover:scale-110 hover:-translate-y-0.5">
                            Log In
                        </a>

                        <a href="{{ route('register') }}"
                           class="rounded-xl bg-orange-600 px-5 py-2 text-sm font-semibold text-white shadow-lg shadow-orange-100 transition-all duration-300 hover:bg-orange-700 hover:scale-105 active:scale-95">
                            Register
                        </a>

                    </div>

                @endauth

            </div>

        </div>
    </div>
</nav>