@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-2xl px-4 py-8">
    <div class="rounded-lg bg-white p-8 shadow-lg border border-gray-100">
        <h2 class="text-2xl font-bold mb-6 text-left">Tambah Menu Baru</h2>

        <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-left">Nama Menu</label>
                <input type="text" name="nama_produk" class="mt-1 w-full rounded-lg border-gray-300 p-3 border outline-none focus:ring-orange-500 focus:border-orange-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 text-left">Pilih Kategori</label>
                <select name="kategori_id" class="mt-1 w-full rounded-lg border-gray-300 p-3 border focus:ring-orange-500 outline-none" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-left">Harga (IDR)</label>
                <input type="number" name="harga" class="mt-1 w-full rounded-lg border-gray-300 p-3 border outline-none focus:ring-orange-500 focus:border-orange-500" placeholder="Contoh: 25000" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-left">Foto Menu</label>
                <input type="file" name="foto" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
            </div>

            <div class="mt-8 border-t border-gray-100 pt-6 text-left">
                <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" /></svg>
                    Opsi Tambahan (Topping / Size)
                </h3>

                <div id="wrapper-opsi" class="space-y-3">
                    <div class="flex flex-wrap md:flex-nowrap gap-3 items-end bg-gray-50 p-4 rounded-2xl border border-gray-100">
                        <div class="flex-1 min-w-[100px]">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 ml-1">Jenis</label>
                            <select name="opsi[0][jenis]" class="w-full rounded-xl border-gray-200 text-sm focus:ring-orange-500 border p-2 outline-none">
                                <option value="topping">Topping</option>
                                <option value="size">Size</option>
                            </select>
                        </div>
                        <div class="flex-[2] min-w-[150px]">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 ml-1">Nama Opsi</label>
                            <input name="opsi[0][nama_opsi]" type="text" class="w-full rounded-xl border-gray-200 p-2 text-sm border outline-none" placeholder="Contoh: Keju / Large">
                        </div>
                        <div class="flex-1 min-w-[100px]">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase mb-1 ml-1">Harga +</label>
                            <input name="opsi[0][harga_tambahan]" type="number" class="w-full rounded-xl border-gray-200 p-2 text-sm border outline-none" placeholder="0">
                        </div>
                        <div class="pb-1">
                            <button type="button" class="p-2 text-gray-300 cursor-not-allowed" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <button type="button" onclick="tambahBarisOpsi()" class="mt-4 inline-flex items-center gap-2 text-[10px] font-black text-orange-600 hover:text-orange-700 transition uppercase tracking-widest bg-orange-50 px-3 py-2 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                    Tambah Opsi
                </button>
            </div>
            <div class="flex gap-4 pt-8">
                <button type="submit" class="flex-1 rounded-lg bg-orange-600 px-5 py-3 text-white font-bold hover:bg-orange-700 transition shadow-lg shadow-orange-100">Simpan Menu</button>
                <a href="{{ route('admin.produk.index') }}" class="px-5 py-3 text-gray-600 border rounded-lg hover:bg-gray-50 transition">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
    let barisIndex = 1;
    function tambahBarisOpsi() {
        const wrapper = document.getElementById('wrapper-opsi');
        const template = `
            <div class="flex flex-wrap md:flex-nowrap gap-3 items-end bg-gray-50 p-4 rounded-2xl border border-gray-100 animate-slide-in">
                <div class="flex-1 min-w-[100px]">
                    <select name="opsi[${barisIndex}][jenis]" class="w-full rounded-xl border-gray-200 text-sm border p-2 outline-none focus:ring-orange-500">
                        <option value="topping">Topping</option>
                        <option value="size">Size</option>
                    </select>
                </div>
                <div class="flex-[2] min-w-[150px]">
                    <input name="opsi[${barisIndex}][nama_opsi]" type="text" class="w-full rounded-xl border-gray-200 p-2 text-sm border outline-none focus:border-orange-500" placeholder="Nama opsi...">
                </div>
                <div class="flex-1 min-w-[100px]">
                    <input name="opsi[${barisIndex}][harga_tambahan]" type="number" class="w-full rounded-xl border-gray-200 p-2 text-sm border outline-none focus:border-orange-500" placeholder="0">
                </div>
                <div class="pb-1">
                    <button type="button" onclick="this.parentElement.parentElement.remove()" class="p-2 text-red-500 hover:bg-red-50 rounded-xl transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    </button>
                </div>
            </div>`;
        wrapper.insertAdjacentHTML('beforeend', template);
        barisIndex++;
    }
</script>

<style>
    @keyframes slide-in {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-slide-in { animation: slide-in 0.2s ease-out forwards; }
</style>
@endsection
