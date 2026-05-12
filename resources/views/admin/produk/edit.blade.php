@extends('layouts.admin')

@section('admin_content')
<div class="container mx-auto px-4 py-8 max-w-3xl">
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 border-b pb-4">Edit Menu: {{ $produk->nama_produk }}</h2>

        <form action="{{ route('admin.produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Produk</label>
                <input type="text" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" class="w-full border border-gray-300 p-3 rounded-xl outline-none focus:border-orange-500" required>
            </div>

            <div class="mb-5">
                <label class="block text-sm font-bold text-gray-700 mb-2">Harga Utama (Rp)</label>
                <input type="number" name="harga" value="{{ old('harga', $produk->harga) }}" class="w-full border border-gray-300 p-3 rounded-xl outline-none focus:border-orange-500" required>
            </div>

            <div class="mb-5">
                <label class="block text-sm font-bold text-gray-700 mb-2">Kategori</label>
                <select name="kategori_id" class="w-full border border-gray-300 p-3 rounded-xl outline-none focus:border-orange-500" required>
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat->id }}" {{ $produk->kategori_id == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Foto Produk (Biarkan kosong jika tidak diganti)</label>
                @if($produk->foto)
                    <div class="mb-3">
                        @php
                            $fileName = str_replace(['public/', 'storage/', 'produk/'], '', $produk->foto);
                            $path = 'produk/' . $fileName;
                        @endphp
                        <img src="{{ asset('storage/' . $path) }}" alt="Foto Lama" class="h-24 w-24 object-cover rounded-lg border">
                    </div>
                @endif
                <input type="file" name="foto" class="w-full border border-gray-300 p-2 rounded-xl text-sm">
            </div>

            <div class="mb-8 p-6 bg-gray-50 rounded-xl border border-gray-200">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-gray-900">Opsi Tambahan (Topping / Ukuran)</h3>
                    <button type="button" onclick="addOpsi()" class="bg-gray-800 text-white text-xs px-4 py-2 rounded-lg font-bold hover:bg-gray-900 transition">
                        + Tambah Opsi
                    </button>
                </div>

                <div id="opsi-container" class="space-y-3">
                    @if($produk->options && count($produk->options) > 0)
                        @foreach($produk->options as $index => $opsi)
                            <div class="flex gap-2 items-center bg-white p-3 rounded-lg border border-gray-200">

                                <select name="opsi[{{$index}}][jenis]" class="border p-2 rounded-lg w-1/3 text-sm outline-none focus:border-orange-500" required>
                                    <option value="topping" {{ strtolower($opsi->jenis) == 'topping' ? 'selected' : '' }}>Topping Tambahan</option>
                                    <option value="size" {{ strtolower($opsi->jenis) == 'size' ? 'selected' : '' }}>Pilihan Ukuran (Size)</option>
                                </select>

                                <input type="text" name="opsi[{{$index}}][nama_opsi]" value="{{ $opsi->nama_opsi }}" placeholder="Nama (cth: Keju Mozzarella)" class="border p-2 rounded-lg w-1/3 text-sm outline-none" required>
                                <input type="number" name="opsi[{{$index}}][harga_tambahan]" value="{{ $opsi->harga_tambahan }}" placeholder="Harga Tambahan" class="border p-2 rounded-lg w-1/3 text-sm outline-none" required>
                                <button type="button" onclick="this.parentElement.remove()" class="bg-red-100 text-red-600 px-3 py-2 rounded-lg font-bold hover:bg-red-200">X</button>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="flex gap-4">
                <a href="{{ route('admin.produk.index') }}" class="block text-center w-1/3 py-3 rounded-xl border border-gray-300 text-gray-700 font-bold hover:bg-gray-50 transition">Batal</a>
                <button type="submit" class="w-2/3 bg-orange-600 py-3 rounded-xl text-white font-bold shadow-lg shadow-orange-200 hover:bg-orange-700 transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // JS Untuk Menambah Form Topping Baru Secara Dinamis
    let opsiIndex = {{ isset($produk->options) ? count($produk->options) : 0 }};

    function addOpsi() {
        const container = document.getElementById('opsi-container');
        const row = document.createElement('div');
        row.className = 'flex gap-2 items-center bg-white p-3 rounded-lg border border-gray-200';

        // DROPDOWN JENIS UNTUK BARIS BARU (Ubah Sini)
        row.innerHTML = `
            <select name="opsi[${opsiIndex}][jenis]" class="border p-2 rounded-lg w-1/3 text-sm outline-none focus:border-orange-500" required>
                <option value="topping">Topping Tambahan</option>
                <option value="size">Pilihan Ukuran (Size)</option>
            </select>
            <input type="text" name="opsi[${opsiIndex}][nama_opsi]" placeholder="Nama (cth: Keju)" class="border p-2 rounded-lg w-1/3 text-sm outline-none" required>
            <input type="number" name="opsi[${opsiIndex}][harga_tambahan]" placeholder="Harga Tambahan (cth: 3000)" class="border p-2 rounded-lg w-1/3 text-sm outline-none" value="0" required>
            <button type="button" onclick="this.parentElement.remove()" class="bg-red-100 text-red-600 px-3 py-2 rounded-lg font-bold hover:bg-red-200">X</button>
        `;
        container.appendChild(row);
        opsiIndex++;
    }
</script>
@endsection
