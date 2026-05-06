@extends('layouts.admin')

@section('admin_content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Produk (Menu)</h1>
        <a href="{{ route('admin.produk.create') }}" class="bg-orange-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-orange-700 transition duration-150">
            + Tambah Produk
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-hidden border border-gray-200 rounded-lg shadow-sm">
        <table class="w-full text-left border-collapse bg-white">
            <thead class="bg-gray-50">
                <tr class="border-b border-gray-200">
                    <th class="py-4 px-6 text-sm font-semibold text-gray-600">Gambar</th>
                    <th class="py-4 px-6 text-sm font-semibold text-gray-600">Nama</th>
                    <th class="py-4 px-6 text-sm font-semibold text-gray-600">Harga</th>
                    <th class="py-4 px-6 text-sm font-semibold text-gray-600">Kategori</th>
                    <th class="py-4 px-6 text-sm font-semibold text-gray-600 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($produks as $produk)
                <tr class="hover:bg-gray-50 transition duration-75">
                    <td class="py-4 px-6">
                        {{-- Menggunakan kolom 'foto' sesuai image_a3720c.png --}}
                        @if($produk->foto)
                            @php
                                // Membersihkan path agar tepat mengarah ke folder produk
                                $fileName = str_replace(['public/', 'storage/', 'produk/'], '', $produk->foto);
                                $path = 'produk/' . $fileName;
                            @endphp
                            <img src="{{ asset('storage/' . $path) }}"
                                 class="w-20 h-20 object-cover rounded-lg border border-gray-100 shadow-sm"
                                 alt="{{ $produk->nama_produk }}"
                                 onerror="this.onerror=null;this.src='https://via.placeholder.com/150?text=404';">
                        @else
                            <div class="w-20 h-20 bg-gray-100 flex items-center justify-center rounded-lg text-[10px] text-gray-400 border border-dashed">
                                No Image
                            </div>
                        @endif
                    </td>
                    <td class="py-4 px-6 text-gray-700 font-bold">
                        {{-- Menggunakan kolom 'nama_produk' sesuai database --}}
                        {{ $produk->nama_produk }}
                    </td>
                    <td class="py-4 px-6 text-gray-700 font-medium">
                        Rp{{ number_format($produk->harga, 0, ',', '.') }}
                    </td>
                    <td class="py-4 px-6">
                        <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-full">
                            {{ $produk->kategori->nama_kategori ?? 'Umum' }}
                        </span>
                    </td>
                    <td class="py-4 px-6 text-right space-x-3">
                        <a href="{{ route('admin.produk.edit', $produk->id) }}" class="text-blue-600 font-semibold hover:underline">Edit</a>
                        <form action="{{ route('admin.produk.destroy', $produk->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus menu ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 font-semibold hover:underline">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-12 text-center text-gray-500 italic">Belum ada produk terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
