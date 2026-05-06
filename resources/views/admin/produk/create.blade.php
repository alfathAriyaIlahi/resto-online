@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-2xl px-4 py-8">
    <div class="rounded-lg bg-white p-8 shadow-lg border border-gray-100">
        <h2 class="text-2xl font-bold mb-6">Tambah Menu Baru</h2>

        <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium">Nama Menu</label>
                <input type="text" name="nama_produk" class="mt-1 w-full rounded-lg border-gray-300 p-3 border" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Pilih Kategori</label>
                <select name="kategori_id" class="mt-1 w-full rounded-lg border-gray-300 p-3 border focus:ring-orange-500" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium">Harga (IDR)</label>
                <input type="number" name="harga" class="mt-1 w-full rounded-lg border-gray-300 p-3 border" placeholder="Contoh: 25000" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Foto Menu</label>
                <input type="file" name="foto" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="flex-1 rounded-lg bg-orange-600 px-5 py-3 text-white font-bold hover:bg-orange-700">Simpan Menu</button>
                <a href="{{ route('admin.produk.index') }}" class="px-5 py-3 text-gray-600 border rounded-lg hover:bg-gray-50">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
