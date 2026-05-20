@extends('layouts.admin')

@section('admin_content')

<div class="relative overflow-hidden rounded-[36px] bg-gradient-to-br from-orange-500 via-orange-400 to-yellow-300 p-8 mb-10 shadow-2xl">

    {{-- GLOW --}}
    <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full bg-white/20 blur-3xl"></div>
    <div class="absolute -bottom-24 -left-24 h-72 w-72 rounded-full bg-yellow-100/30 blur-3xl"></div>

    {{-- PATTERN --}}
    <div class="absolute inset-0 opacity-[0.08]"
         style="background-image: radial-gradient(white 1px, transparent 1px); background-size: 22px 22px;">
    </div>

    <div class="relative">

        <span class="inline-flex rounded-full bg-white/20 px-4 py-2 text-xs font-black uppercase tracking-widest text-white backdrop-blur">
            Admin Menu
        </span>

        <h1 class="mt-5 text-5xl font-black tracking-tight text-white">
            Tambah Menu Baru
        </h1>

        <p class="mt-3 max-w-2xl text-sm leading-relaxed text-orange-50">
            Tambahkan menu baru beserta topping dan variasi ukuran dengan tampilan modern dan lebih interaktif.
        </p>

    </div>

</div>

<div class="relative overflow-hidden rounded-[36px] border border-white/60 bg-white/80 shadow-2xl backdrop-blur-xl">

    {{-- BACKGROUND EFFECT --}}
    <div class="absolute inset-0 bg-gradient-to-br from-orange-50/40 via-white to-yellow-50/40"></div>

    <div class="absolute top-0 right-0 h-72 w-72 rounded-full bg-orange-200/30 blur-3xl"></div>

    <div class="absolute bottom-0 left-0 h-72 w-72 rounded-full bg-yellow-200/30 blur-3xl"></div>

    <div class="relative p-8 md:p-10">

        <form action="{{ route('admin.produk.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-8">

            @csrf

            {{-- INFORMASI MENU --}}
            <div>

                <div class="flex items-center gap-3 mb-6">

                    <div class="h-10 w-10 rounded-2xl bg-orange-100 flex items-center justify-center text-orange-600 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M3 7h18M3 12h18M3 17h18"/>
                        </svg>
                    </div>

                    <div>

                        <h2 class="text-2xl font-black text-gray-900">
                            Informasi Menu
                        </h2>

                        <p class="text-sm text-gray-500">
                            Lengkapi data menu makanan atau minuman.
                        </p>

                    </div>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- NAMA MENU --}}
                    <div>

                        <label class="mb-2 block text-xs font-black uppercase tracking-widest text-gray-400">
                            Nama Menu
                        </label>

                        <input type="text"
                               name="nama_produk"
                               class="w-full rounded-2xl border border-gray-200 bg-white p-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100"
                               placeholder="Contoh: Nasi Goreng Spesial"
                               required>

                    </div>

                    {{-- KATEGORI --}}
                    <div>

                        <label class="mb-2 block text-xs font-black uppercase tracking-widest text-gray-400">
                            Pilih Kategori
                        </label>

                        <select name="kategori_id"
                                class="w-full rounded-2xl border border-gray-200 bg-white p-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100"
                                required>

                            <option value="">-- Pilih Kategori --</option>

                            @foreach($kategoris as $kat)

                                <option value="{{ $kat->id }}">
                                    {{ $kat->nama_kategori }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- HARGA --}}
                    <div>

                        <label class="mb-2 block text-xs font-black uppercase tracking-widest text-gray-400">
                            Harga
                        </label>

                        <input type="number"
                               name="harga"
                               class="w-full rounded-2xl border border-gray-200 bg-white p-4 text-sm outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-100"
                               placeholder="Contoh: 25000"
                               required>

                    </div>

                    {{-- FOTO --}}
                    <div>

                        <label class="mb-2 block text-xs font-black uppercase tracking-widest text-gray-400">
                            Foto Menu
                        </label>

                        <div class="rounded-2xl border border-dashed border-orange-200 bg-orange-50/50 p-4">

                            <input type="file"
                                   name="foto"
                                   class="block w-full text-sm text-gray-500
                                          file:mr-4
                                          file:rounded-full
                                          file:border-0
                                          file:bg-orange-500
                                          file:px-5
                                          file:py-3
                                          file:text-sm
                                          file:font-black
                                          file:text-white
                                          hover:file:bg-orange-600">

                        </div>

                    </div>

                </div>

            </div>

            {{-- OPSI --}}
            <div class="rounded-[32px] border border-orange-100 bg-white/80 p-6 shadow-lg">

                <div class="flex items-center justify-between flex-wrap gap-4 mb-6">

                    <div class="flex items-center gap-3">

                        <div class="h-10 w-10 rounded-2xl bg-orange-100 flex items-center justify-center text-orange-600 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                            </svg>
                        </div>

                        <div>

                            <h3 class="text-xl font-black text-gray-900">
                                Opsi Tambahan
                            </h3>

                            <p class="text-sm text-gray-500">
                                Tambahkan topping atau ukuran menu.
                            </p>

                        </div>

                    </div>

                    <button type="button"
                            onclick="tambahBarisOpsi()"
                            class="inline-flex items-center gap-2 rounded-2xl bg-orange-500 px-5 py-3 text-xs font-black uppercase tracking-widest text-white shadow-lg shadow-orange-200 transition hover:-translate-y-1 hover:bg-orange-600 active:scale-95">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="h-4 w-4"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="3">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M12 4v16m8-8H4"/>

                        </svg>

                        Tambah Opsi

                    </button>

                </div>

                <div id="wrapper-opsi" class="space-y-4">

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 rounded-3xl border border-orange-100 bg-orange-50/60 p-5">

                        <div>

                            <label class="mb-2 block text-[10px] font-black uppercase tracking-widest text-gray-400">
                                Jenis
                            </label>

                            <select name="opsi[0][jenis]"
                                    class="w-full rounded-2xl border border-gray-200 bg-white p-3 text-sm outline-none">

                                <option value="topping">Topping</option>
                                <option value="size">Size</option>

                            </select>

                        </div>

                        <div>

                            <label class="mb-2 block text-[10px] font-black uppercase tracking-widest text-gray-400">
                                Nama Opsi
                            </label>

                            <input name="opsi[0][nama_opsi]"
                                   type="text"
                                   class="w-full rounded-2xl border border-gray-200 bg-white p-3 text-sm outline-none"
                                   placeholder="Contoh: Extra Cheese">

                        </div>

                        <div>

                            <label class="mb-2 block text-[10px] font-black uppercase tracking-widest text-gray-400">
                                Harga Tambahan
                            </label>

                            <input name="opsi[0][harga_tambahan]"
                                   type="number"
                                   class="w-full rounded-2xl border border-gray-200 bg-white p-3 text-sm outline-none"
                                   placeholder="0">

                        </div>

                        <div class="flex items-end">

                            <button type="button"
                                    disabled
                                    class="w-full rounded-2xl bg-gray-200 px-4 py-3 text-xs font-black uppercase tracking-wide text-gray-400 cursor-not-allowed">

                                Tidak Bisa Dihapus

                            </button>

                        </div>

                    </div>

                </div>

            </div>

            {{-- BUTTON --}}
            <div class="flex flex-wrap gap-4 pt-4">

                <button type="submit"
                        class="flex-1 rounded-2xl bg-orange-600 px-6 py-4 text-sm font-black uppercase tracking-wide text-white shadow-xl shadow-orange-200 transition-all duration-300 hover:-translate-y-1 hover:bg-orange-700 active:scale-95">

                    Simpan Menu

                </button>

                <a href="{{ route('admin.produk.index') }}"
                   class="rounded-2xl border border-gray-200 bg-white px-6 py-4 text-sm font-black uppercase tracking-wide text-gray-600 transition hover:bg-gray-50">

                    Batal

                </a>

            </div>

        </form>

    </div>

</div>

<script>

    let barisIndex = 1;

    function tambahBarisOpsi() {

        const wrapper = document.getElementById('wrapper-opsi');

        const template = `
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 rounded-3xl border border-orange-100 bg-orange-50/60 p-5 animate-slide-in">

                <div>

                    <select name="opsi[${barisIndex}][jenis]"
                            class="w-full rounded-2xl border border-gray-200 bg-white p-3 text-sm outline-none">

                        <option value="topping">Topping</option>
                        <option value="size">Size</option>

                    </select>

                </div>

                <div>

                    <input name="opsi[${barisIndex}][nama_opsi]"
                           type="text"
                           class="w-full rounded-2xl border border-gray-200 bg-white p-3 text-sm outline-none"
                           placeholder="Nama opsi...">

                </div>

                <div>

                    <input name="opsi[${barisIndex}][harga_tambahan]"
                           type="number"
                           class="w-full rounded-2xl border border-gray-200 bg-white p-3 text-sm outline-none"
                           placeholder="0">

                </div>

                <div class="flex items-end">

                    <button type="button"
                            onclick="this.parentElement.parentElement.remove()"
                            class="w-full rounded-2xl bg-red-500 px-4 py-3 text-xs font-black uppercase tracking-wide text-white transition hover:bg-red-600">

                        Hapus

                    </button>

                </div>

            </div>
        `;

        wrapper.insertAdjacentHTML('beforeend', template);

        barisIndex++;

    }

</script>

<style>

    @keyframes slide-in {

        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }

    }

    .animate-slide-in {
        animation: slide-in 0.25s ease-out forwards;
    }

</style>

@endsection