@extends('layouts.app')

@section('content')
<nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between items-center">
            <a href="/" class="text-2xl font-bold text-orange-600">MakanYuk<span class="text-gray-800">.</span></a>
            <a href="{{ route('dashboard') }}" class="text-sm font-bold text-gray-600 hover:text-orange-600 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali
            </a>
        </div>
    </div>
</nav>

<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <div class="px-4 sm:px-0 mb-6 text-left">
            <h2 class="text-3xl font-black text-gray-900 uppercase tracking-tight">Profil Saya</h2>
            <p class="text-gray-500 mt-1">Kelola informasi akun dan pengaturan keamanan Anda.</p>
        </div>

        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('patch')

            <div class="p-8 bg-white shadow-sm border border-gray-100 sm:rounded-3xl">
                <div class="flex flex-col md:flex-row gap-12">

                    <div class="md:w-1/3 flex flex-col items-center border-r border-gray-50 pr-8 text-center">
                        <div class="relative group">
                            <img id="preview-foto" src="{{ $user->foto_profil ? asset('storage/profiles/'.$user->foto_profil) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=FFEDD5&color=EA580C&size=256' }}"
                                 class="size-48 rounded-full object-cover border-4 border-white shadow-xl">
                            <label class="absolute inset-0 flex items-center justify-center bg-black/40 rounded-full opacity-0 group-hover:opacity-100 transition cursor-pointer text-white text-xs font-bold uppercase">
                                Ganti Foto
                                <input type="file" name="foto_profil" class="hidden" onchange="previewImage(event)">
                            </label>
                        </div>
                        <h4 class="mt-4 font-black text-gray-900">{{ $user->name }}</h4>
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">{{ $user->email }}</p>
                    </div>

                    <div class="md:w-2/3 space-y-5 text-left">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-2 tracking-widest">Nama Lengkap</label>
                                <input name="name" type="text" class="w-full rounded-2xl border-gray-200 p-4 text-sm focus:ring-orange-500 focus:border-orange-500 border transition outline-none" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-2 tracking-widest">Nomor Handphone</label>
                                <input name="nomor_hp" type="tel" class="w-full rounded-2xl border-gray-200 p-4 text-sm focus:ring-orange-500 focus:border-orange-500 border transition outline-none" value="{{ old('nomor_hp', $user->nomor_hp) }}" placeholder="08xxxxxx">
                            </div>
                        </div>

                        <input type="hidden" name="email" value="{{ $user->email }}">

                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase mb-2 tracking-widest">Alamat Pengiriman</label>
                            <textarea name="alamat" rows="3" class="w-full rounded-2xl border-gray-200 p-4 text-sm focus:ring-orange-500 focus:border-orange-500 border transition outline-none" placeholder="Tuliskan alamat lengkap rumah/kantor...">{{ old('alamat', $user->alamat) }}</textarea>
                        </div>

                        <div class="flex items-center gap-4 pt-4 border-t border-gray-50">
                            <button type="submit" class="rounded-2xl bg-orange-600 px-10 py-4 text-sm font-bold text-white hover:bg-orange-700 transition shadow-lg shadow-orange-100 active:scale-95">
                                Simpan Profil
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div x-data="{ open: false }" class="p-8 bg-white shadow-sm border border-gray-100 rounded-3xl text-left">
                <h3 class="text-lg font-bold text-gray-900 uppercase tracking-widest">Alamat Email</h3>
                <p class="text-xs text-gray-500 mt-1 mb-6">Email aktif: <strong>{{ $user->email }}</strong></p>
                <button @click="open = true" type="button" class="w-full rounded-2xl border-2 border-gray-900 px-6 py-4 text-sm font-bold text-gray-900 hover:bg-gray-900 hover:text-white transition active:scale-95">
                    Ubah Email
                </button>

                <div x-show="open" x-cloak class="fixed inset-0 z-[70] flex items-center justify-center bg-gray-900/60 backdrop-blur-sm p-4">
                    <div @click.away="open = false" class="bg-white w-full max-w-md rounded-3xl p-8 shadow-2xl relative">
                        <button @click="open = false" class="absolute top-6 right-6 text-gray-400 hover:text-gray-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                        <div class="text-center mb-8">
                            <h3 class="text-2xl font-black text-gray-900 uppercase">Ubah Email</h3>
                        </div>
                        <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="name" value="{{ $user->name }}">
                            <input type="hidden" name="nomor_hp" value="{{ $user->nomor_hp }}">
                            <input type="hidden" name="alamat" value="{{ $user->alamat }}">
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-2 tracking-widest text-left">Email Baru</label>
                                <input name="email" type="email" class="w-full rounded-2xl border-gray-200 p-4 text-sm focus:ring-orange-500 border outline-none" value="{{ $user->email }}" required>
                            </div>
                            <button type="submit" class="w-full rounded-2xl bg-orange-600 py-4 text-sm font-bold text-white shadow-lg hover:bg-orange-700 transition">Konfirmasi Email</button>
                        </form>
                    </div>
                </div>
            </div>

            <div x-data="{ open: false }" class="p-8 bg-white shadow-sm border border-gray-100 rounded-3xl text-left">
                <h3 class="text-lg font-bold text-gray-900 uppercase tracking-widest">Keamanan</h3>
                <p class="text-xs text-gray-500 mt-1 mb-6">Ganti password secara berkala agar akun tetap aman.</p>
                <button @click="open = true" type="button" class="w-full rounded-2xl bg-gray-900 px-6 py-4 text-sm font-bold text-white hover:bg-black transition shadow-lg active:scale-95">
                    Ganti Password
                </button>

                <div x-show="open" x-cloak class="fixed inset-0 z-[70] flex items-center justify-center bg-gray-900/60 backdrop-blur-sm p-4">
                    <div @click.away="open = false" class="bg-white w-full max-w-md rounded-3xl p-8 shadow-2xl relative">
                        <button @click="open = false" class="absolute top-6 right-6 text-gray-400 hover:text-gray-600"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor font-bold"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg></button>
                        <div class="text-center mb-8">
                            <h3 class="text-2xl font-black text-gray-900 uppercase">Ubah Password</h3>
                        </div>
                        <form method="post" action="{{ route('password.update') }}" class="space-y-4">
                            @csrf
                            @method('put')
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-2 tracking-widest text-left">Password Saat Ini</label>
                                <input name="current_password" type="password" class="w-full rounded-2xl border-gray-200 p-4 text-sm focus:ring-orange-500 border outline-none" required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-2 tracking-widest text-left">Password Baru</label>
                                <input name="password" type="password" class="w-full rounded-2xl border-gray-200 p-4 text-sm focus:ring-orange-500 border outline-none" required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-2 tracking-widest text-left">Konfirmasi Password</label>
                                <input name="password_confirmation" type="password" class="w-full rounded-2xl border-gray-200 p-4 text-sm focus:ring-orange-500 border outline-none" required>
                            </div>
                            <button type="submit" class="w-full rounded-2xl bg-orange-600 py-4 text-sm font-bold text-white shadow-lg hover:bg-orange-700 transition">Update Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if (session('status') === 'password-updated' || session('status') === 'profile-updated')
            <div
                x-data="{ show: true }"
                x-show="show"
                x-init="setTimeout(() => show = false, 3000)"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-10"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-500"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-10"
                class="fixed bottom-10 left-1/2 -translate-x-1/2 bg-gray-900 text-white px-8 py-4 rounded-2xl shadow-2xl z-[100] font-bold flex items-center gap-2"
            >
                <span>✅ Perubahan Berhasil Disimpan!</span>
            </div>
        @endif

    </div>
</div>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('preview-foto');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsectionc
