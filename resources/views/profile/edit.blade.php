<x-app-layout>

    <div class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-yellow-50 py-14 relative overflow-hidden">

        {{-- GLOW --}}
        <div class="absolute -top-40 -right-40 h-[500px] w-[500px] rounded-full bg-orange-300/20 blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 h-[500px] w-[500px] rounded-full bg-yellow-300/20 blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- HEADER --}}
            <div class="text-center mb-10">

                <span class="inline-block rounded-full bg-orange-100 px-5 py-2 text-sm font-bold tracking-wide text-orange-600 shadow-sm">
                    PROFILE
                </span>

                <h1 class="mt-5 text-5xl font-black tracking-tight text-gray-900">
                    Profil Saya
                </h1>

                <p class="mt-4 text-base text-gray-600 max-w-2xl mx-auto">
                    Kelola informasi akun dan keamanan profile Anda dengan mudah.
                </p>

            </div>

            {{-- PROFILE CARD --}}
            <div class="overflow-hidden rounded-[32px] border border-white/60 bg-white/80 shadow-2xl backdrop-blur-xl">

                <div class="grid grid-cols-1 lg:grid-cols-3">

                    {{-- LEFT --}}
                    <div class="relative overflow-hidden bg-gradient-to-br from-orange-500 to-orange-600 p-10 flex flex-col items-center justify-center text-center">

                        <div class="absolute inset-0 opacity-20">
                            <div class="absolute -top-10 -left-10 h-40 w-40 rounded-full bg-white blur-3xl"></div>
                            <div class="absolute bottom-0 right-0 h-52 w-52 rounded-full bg-yellow-200 blur-3xl"></div>
                        </div>

                        <div class="relative h-40 w-40 rounded-full border-4 border-white/30 bg-white/20 backdrop-blur-xl flex items-center justify-center text-6xl font-black text-white shadow-2xl">

                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                        </div>

                        <h2 class="relative mt-8 text-3xl font-black text-white">
                            {{ Auth::user()->name }}
                        </h2>

                        <p class="relative mt-3 text-sm tracking-widest text-orange-100 uppercase">
                            {{ Auth::user()->email }}
                        </p>

                    </div>

                    {{-- RIGHT --}}
                    <div class="lg:col-span-2 p-10">

                        <div class="mb-8">

                            <h3 class="text-3xl font-black text-gray-900">
                                Informasi Akun
                            </h3>

                            <p class="mt-2 text-sm text-gray-500">
                                Perbarui informasi profile Anda agar data tetap terbaru.
                            </p>

                        </div>

                        <div class="max-w-2xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>

                    </div>

                </div>

            </div>

            {{-- SECURITY --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                {{-- EMAIL --}}
                <div class="rounded-[32px] border border-white/60 bg-white/80 p-10 shadow-2xl backdrop-blur-xl transition-all duration-300 hover:-translate-y-2 hover:shadow-orange-200/50">

                    <div class="flex items-center gap-4">

                        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-orange-100 text-orange-600 shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m0 0l4-4m-4 4l4 4" />
                            </svg>
                        </div>

                        <div>

                            <h3 class="text-2xl font-black text-gray-900">
                                Alamat Email
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Email aktif akun Anda
                            </p>

                        </div>

                    </div>

                    <div class="mt-8 rounded-2xl bg-orange-50 p-5 border border-orange-100">

                        <p class="text-sm font-semibold text-gray-700">
                            {{ Auth::user()->email }}
                        </p>

                    </div>

                    <button class="mt-8 w-full rounded-2xl border-2 border-orange-500 py-4 text-sm font-black uppercase tracking-wide text-orange-600 transition-all duration-300 hover:bg-orange-500 hover:text-white active:scale-95">

                        Ubah Email

                    </button>

                </div>

                {{-- PASSWORD --}}
                <div class="rounded-[32px] border border-white/60 bg-white/80 p-10 shadow-2xl backdrop-blur-xl transition-all duration-300 hover:-translate-y-2 hover:shadow-orange-200/50">

                    <div class="flex items-center gap-4">

                        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gray-100 text-gray-800 shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2h-1V9a5 5 0 00-10 0v2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                            </svg>
                        </div>

                        <div>

                            <h3 class="text-2xl font-black text-gray-900">
                                Keamanan
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Jaga keamanan akun Anda
                            </p>

                        </div>

                    </div>

                    <div class="mt-10">
                        @include('profile.partials.update-password-form')
                    </div>

                </div>

            </div>

            {{-- DELETE ACCOUNT --}}
            <div class="rounded-[32px] border border-red-100 bg-white/80 p-10 shadow-2xl backdrop-blur-xl">

                <div class="mb-6">

                    <h3 class="text-3xl font-black text-red-600">
                        Hapus Akun
                    </h3>

                    <p class="mt-2 text-sm text-gray-500">
                        Tindakan ini bersifat permanen dan tidak dapat dikembalikan.
                    </p>

                </div>

                <div class="max-w-2xl">
                    @include('profile.partials.delete-user-form')
                </div>

            </div>

        </div>

    </div>

</x-app-layout>