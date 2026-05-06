@extends('layouts.admin')

@section('admin_content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Kategori</h1>
        <a href="{{ route('admin.kategori.create') }}" class="bg-orange-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-orange-700 transition duration-150">
            + Tambah Kategori
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel Kategori -->
    <div class="overflow-hidden border border-gray-200 rounded-lg">
        <table class="w-full text-left border-collapse bg-white">
            <thead class="bg-gray-50">
                <tr class="border-b border-gray-200">
                    <th class="py-4 px-6 text-sm font-semibold text-gray-600">Nama Kategori</th>
                    <th class="py-4 px-6 text-sm font-semibold text-gray-600 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($kategoris as $kategori)
                <tr class="hover:bg-gray-50 transition duration-75">
                    {{-- Di sini perubahannya: menggunakan nama_kategori --}}
                    <td class="py-4 px-6 text-gray-700 font-medium">
                        {{ $kategori->nama_kategori }}
                    </td>

                    <td class="py-4 px-6 text-right space-x-2">
                        <a href="{{ route('admin.kategori.edit', $kategori->id) }}" class="text-blue-600 font-medium hover:text-blue-800">
                            Edit
                        </a>

                        <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="text-red-600 font-medium hover:text-red-800">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="py-10 text-center text-gray-500">
                        Belum ada data kategori.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
