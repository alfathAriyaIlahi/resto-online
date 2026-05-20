@extends('layouts.app')

@section('content')

<div class="relative min-h-screen overflow-hidden bg-gradient-to-br from-orange-50 via-white to-yellow-50 py-14">

    <div class="absolute -top-40 -right-40 h-[500px] w-[500px] rounded-full bg-orange-300/20 blur-3xl"></div>
    <div class="absolute -bottom-40 -left-40 h-[500px] w-[500px] rounded-full bg-yellow-300/20 blur-3xl"></div>

    <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

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

        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div class="overflow-hidden rounded-[32px] border border-white/60 bg-white/80 shadow-2xl backdrop-blur-xl">
                <div class="grid grid-cols-1 lg:grid-cols-3">

                    <div class="relative overflow-hidden bg-gradient-to-br from-orange-500 to-orange-600 p-10 flex flex-col items-center justify-center text-center">
                        <div class="absolute inset-0 opacity-20">
                            <div class="absolute -top-10 -left-10 h-40 w-40 rounded-full bg-white blur-3xl"></div>
                            <div class="absolute bottom-0 right-0 h-52 w-52 rounded-full bg-yellow-200 blur-3xl"></div>
                        </div>

                        <div class="relative group">
                            <img id="preview-foto"
                                 src="{{ $user->foto_profil ? asset('storage/profiles/'.$user->foto_profil) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=FFEDD5&color=EA580C&size=256' }}"
                                 class="h-40 w-40 rounded-full object-cover border-4 border-white/30 shadow-2xl">

                            <label class="absolute inset-0 flex items-center justify-center rounded-full bg-black/50 opacity-0 transition group-hover:opacity-100 cursor-pointer">
                                <span class="text-xs font-black uppercase tracking-widest text-white">
                                    Ganti Foto
                                </span>

                                <input type="file"
                                       name="foto_profil"
                                       class="hidden"
                                       onchange="previewImage(event)">
                            </label>
                        </div>

                        <h2 class="relative mt-8 text-3xl font-black text-white">
                            {{ $user->name }}
                        </h2>

                        <p class="relative mt-3 text-sm tracking-widest text-orange-100 uppercase">
                            {{ $user->email }}
                        </p>
                    </div>

                    <div class="lg:col-span-2 p-10">
                        <div class="mb-8">
                            <h3 class="text-3xl font-black text-gray-900">
                                Informasi Akun
                            </h3>

                            <p class="mt-2 text-sm text-gray-500">
                                Perbarui informasi profile Anda agar data tetap terbaru.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="mb-2 block text-xs font-black uppercase tracking-widest text-gray-400">
                                    Nama Lengkap
                                </label>

                                <input name="name"
                                       type="text"
                                       value="{{ old('name', $user->name) }}"
                                       class="w-full rounded-2xl border border-gray-200 bg-white p-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100"
                                       required>
                            </div>

                            <div>
                                <label class="mb-2 block text-xs font-black uppercase tracking-widest text-gray-400">
                                    Nomor Handphone
                                </label>

                                <input name="nomor_hp"
                                       type="tel"
                                       value="{{ old('nomor_hp', $user->nomor_hp) }}"
                                       placeholder="08xxxxxx"
                                       class="w-full rounded-2xl border border-gray-200 bg-white p-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100">
                            </div>
                        </div>

                        <input type="hidden" name="email" value="{{ $user->email }}">

                        <div class="mt-5">
                            <label class="mb-2 block text-xs font-black uppercase tracking-widest text-gray-400">
                                Alamat Pengiriman
                            </label>

                            <textarea name="alamat"
                                      rows="4"
                                      class="w-full rounded-2xl border border-gray-200 bg-white p-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100"
                                      placeholder="Tuliskan alamat lengkap rumah/kantor...">{{ old('alamat', $user->alamat) }}</textarea>
                        </div>

                        <button type="submit"
                                class="mt-8 w-full rounded-2xl bg-orange-600 py-4 text-sm font-black uppercase tracking-wide text-white shadow-lg shadow-orange-200 transition-all duration-300 hover:-translate-y-1 hover:bg-orange-700 active:scale-95">
                            Simpan Profil
                        </button>
                    </div>

                </div>
            </div>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <div x-data="{ open: false }"
                 class="rounded-[32px] border border-white/60 bg-white/80 p-10 shadow-2xl backdrop-blur-xl transition-all duration-300 hover:shadow-orange-200/50">

                <h3 class="text-2xl font-black text-gray-900">
                    Alamat Email
                </h3>

                <p class="mt-3 text-sm text-gray-500">
                    Email aktif akun Anda:
                </p>

                <div class="mt-5 rounded-2xl bg-orange-50 border border-orange-100 p-5">
                    <p class="text-sm font-bold text-gray-700">
                        {{ $user->email }}
                    </p>
                </div>

                <button @click="open = true"
                        type="button"
                        class="mt-8 w-full rounded-2xl border-2 border-orange-500 py-4 text-sm font-black uppercase tracking-wide text-orange-600 transition-all duration-300 hover:bg-orange-500 hover:text-white active:scale-95">
                    Ubah Email
                </button>

                <template x-teleport="body">
                    <div x-show="open"
                         x-cloak
                         x-transition
                         class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">

                        <div @click.away="open = false"
                             class="relative w-full max-w-md rounded-[32px] bg-white p-8 shadow-2xl">

                            <button @click="open = false"
                                    class="absolute top-5 right-5 text-gray-400 transition hover:text-gray-700">
                                ✕
                            </button>

                            <div class="mb-8 text-center">
                                <h3 class="text-3xl font-black uppercase text-gray-900">
                                    Ubah Email
                                </h3>

                                <p class="mt-2 text-sm text-gray-500">
                                    Gunakan email aktif yang valid.
                                </p>
                            </div>

                            <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
                                @csrf
                                @method('patch')

                                <input type="hidden" name="name" value="{{ $user->name }}">
                                <input type="hidden" name="nomor_hp" value="{{ $user->nomor_hp }}">
                                <input type="hidden" name="alamat" value="{{ $user->alamat }}">

                                <div>
                                    <label class="mb-2 block text-xs font-black uppercase tracking-widest text-gray-400">
                                        Email Baru
                                    </label>

                                    <input name="email"
                                           type="email"
                                           value="{{ $user->email }}"
                                           class="w-full rounded-2xl border border-gray-200 bg-gray-50 p-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100"
                                           required>
                                </div>

                                <button type="submit"
                                        class="w-full rounded-2xl bg-orange-600 py-4 text-sm font-black uppercase tracking-wide text-white shadow-lg shadow-orange-200 transition-all duration-300 hover:bg-orange-700 active:scale-95">
                                    Konfirmasi Email
                                </button>
                            </form>

                        </div>
                    </div>
                </template>
            </div>

            <div x-data="{ open: false }"
                 class="rounded-[32px] border border-white/60 bg-white/80 p-10 shadow-2xl backdrop-blur-xl transition-all duration-300 hover:shadow-orange-200/50">

                <h3 class="text-2xl font-black text-gray-900">
                    Keamanan
                </h3>

                <p class="mt-3 text-sm text-gray-500">
                    Ganti password secara berkala agar akun tetap aman.
                </p>

                <button @click="open = true"
                        type="button"
                        class="mt-8 w-full rounded-2xl bg-gray-900 py-4 text-sm font-black uppercase tracking-wide text-white shadow-lg transition hover:bg-black active:scale-95">
                    Ganti Password
                </button>

                <template x-teleport="body">
                    <div x-show="open"
                         x-cloak
                         x-transition
                         class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">

                        <div @click.away="open = false"
                             class="relative w-full max-w-md rounded-[32px] bg-white p-8 shadow-2xl">

                            <button @click="open = false"
                                    class="absolute top-5 right-5 text-gray-400 transition hover:text-gray-700">
                                ✕
                            </button>

                            <div class="mb-8 text-center">
                                <h3 class="text-3xl font-black uppercase text-gray-900">
                                    Ubah Password
                                </h3>

                                <p class="mt-2 text-sm text-gray-500">
                                    Gunakan password yang kuat dan aman.
                                </p>
                            </div>

                            <form method="post" action="{{ route('password.update') }}" class="space-y-4">
                                @csrf
                                @method('put')

                                <div>
                                    <label class="mb-2 block text-xs font-black uppercase tracking-widest text-gray-400">
                                        Password Saat Ini
                                    </label>

                                    <input name="current_password"
                                           type="password"
                                           class="w-full rounded-2xl border border-gray-200 bg-gray-50 p-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100"
                                           required>
                                </div>

                                <div>
                                    <label class="mb-2 block text-xs font-black uppercase tracking-widest text-gray-400">
                                        Password Baru
                                    </label>

                                    <input name="password"
                                           type="password"
                                           class="w-full rounded-2xl border border-gray-200 bg-gray-50 p-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100"
                                           required>
                                </div>

                                <div>
                                    <label class="mb-2 block text-xs font-black uppercase tracking-widest text-gray-400">
                                        Konfirmasi Password
                                    </label>

                                    <input name="password_confirmation"
                                           type="password"
                                           class="w-full rounded-2xl border border-gray-200 bg-gray-50 p-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100"
                                           required>
                                </div>

                                <button type="submit"
                                        class="w-full rounded-2xl bg-orange-600 py-4 text-sm font-black uppercase tracking-wide text-white shadow-lg shadow-orange-200 transition-all duration-300 hover:bg-orange-700 active:scale-95">
                                    Update Password
                                </button>
                            </form>

                        </div>
                    </div>
                </template>
            </div>

        </div>

        @if (session('status') === 'password-updated' || session('status') === 'profile-updated')
            <div x-data="{ show: true }"
                 x-show="show"
                 x-init="setTimeout(() => show = false, 3000)"
                 class="fixed bottom-10 left-1/2 z-[100] -translate-x-1/2 rounded-2xl bg-gray-900 px-8 py-4 font-bold text-white shadow-2xl">
                ✅ Perubahan Berhasil Disimpan!
            </div>
        @endif

    </div>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();

        reader.onload = function () {
            const output = document.getElementById('preview-foto');
            output.src = reader.result;
        };

        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>

@endsection