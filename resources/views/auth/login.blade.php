<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - MakanYuk</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes pulseGlow {
            0%, 100% {
                opacity: .4;
                transform: scale(1);
            }

            50% {
                opacity: .7;
                transform: scale(1.1);
            }
        }

        .float-animation {
            animation: float 5s ease-in-out infinite;
        }

        .glow-animation {
            animation: pulseGlow 4s ease-in-out infinite;
        }
    </style>

</head>

<body class="font-sans antialiased">

    <div class="relative min-h-screen flex items-center justify-center overflow-hidden px-4 py-12">

        {{-- BACKGROUND IMAGE --}}
        <div class="absolute inset-0">
            <img src="{{ asset('images/makanann.webp') }}"
                 alt="Background"
                 class="h-full w-full object-cover opacity-40">
        </div>

        {{-- OVERLAY --}}
        <div class="absolute inset-0 bg-white/70 backdrop-blur-sm"></div>

        {{-- GLOW EFFECT --}}
        <div class="absolute top-20 left-20 h-72 w-72 rounded-full bg-orange-300 blur-3xl opacity-30 glow-animation"></div>

        <div class="absolute bottom-20 right-20 h-80 w-80 rounded-full bg-yellow-200 blur-3xl opacity-30 glow-animation"></div>

        {{-- FLOAT ICON --}}
        <div class="absolute top-32 right-32 text-6xl opacity-20 float-animation">
            🍽️
        </div>

        <div class="absolute bottom-32 left-32 text-6xl opacity-20 float-animation">
            🥘
        </div>

        {{-- LOGIN CARD --}}
        <div class="relative z-10 w-full max-w-md">

            <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-white p-8">

                {{-- LOGO --}}
                <div class="text-center mb-8">

                    <img src="{{ asset('images/logos.png') }}"
                         alt="MakanYuk Logo"
                         class="mx-auto h-24 w-auto object-contain mb-4">

                    <h1 class="text-3xl font-black text-gray-900">
                        Selamat Datang
                    </h1>

                    <p class="mt-2 text-sm text-gray-500">
                        Masuk untuk melanjutkan pesanan dan reservasi Anda.
                    </p>

                </div>

                {{-- STATUS --}}
                <x-auth-session-status class="mb-4" :status="session('status')" />

                {{-- FORM --}}
                <form method="POST"
                      action="{{ route('login') }}"
                      class="space-y-5">

                    @csrf

                    {{-- EMAIL --}}
                    <div>

                        <label for="email"
                               class="block text-xs font-bold uppercase tracking-widest text-gray-500">
                            Email
                        </label>

                        <input id="email"
                               type="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autofocus
                               autocomplete="username"
                               class="mt-2 block w-full rounded-2xl border border-gray-200 bg-white px-4 py-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-200">

                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

                    </div>

                    {{-- PASSWORD --}}
                    <div>

                        <label for="password"
                               class="block text-xs font-bold uppercase tracking-widest text-gray-500">
                            Password
                        </label>

                        <input id="password"
                               type="password"
                               name="password"
                               required
                               autocomplete="current-password"
                               class="mt-2 block w-full rounded-2xl border border-gray-200 bg-white px-4 py-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-200">

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />

                    </div>

                    {{-- REMEMBER --}}
                    <div class="flex items-center justify-between">

                        <label for="remember_me"
                               class="inline-flex items-center">

                            <input id="remember_me"
                                   type="checkbox"
                                   name="remember"
                                   class="rounded border-gray-300 text-orange-600 focus:ring-orange-500">

                            <span class="ms-2 text-sm text-gray-600">
                                Ingat saya
                            </span>

                        </label>

                        @if (Route::has('password.request'))

                            <a href="{{ route('password.request') }}"
                               class="text-sm font-semibold text-orange-600 hover:text-orange-700">
                                Lupa password?
                            </a>

                        @endif

                    </div>

                    {{-- BUTTON --}}
                    <button type="submit"
                            class="w-full rounded-2xl bg-orange-600 py-4 text-sm font-bold text-white shadow-lg shadow-orange-200 transition hover:bg-orange-700 active:scale-95">

                        Masuk

                    </button>

                    {{-- REGISTER --}}
                    <p class="text-center text-sm text-gray-500">

                        Belum punya akun?

                        <a href="{{ route('register') }}"
                           class="font-bold text-orange-600 hover:text-orange-700">

                            Daftar sekarang

                        </a>

                    </p>

                </form>

            </div>

            {{-- BACK --}}
            <div class="mt-6 text-center">

                <a href="{{ route('home') }}"
                   class="text-sm font-semibold text-gray-600 hover:text-orange-600">

                    ← Kembali ke Beranda

                </a>

            </div>

        </div>

    </div>

</body>
</html>