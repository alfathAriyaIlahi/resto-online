@extends('layouts.admin')

@section('admin_content')
    <h1 class="text-2xl font-bold mb-6">Reservasi</h1>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50">
                <tr>
                    <th class="py-3 px-4 border-b font-semibold text-gray-700">Waktu</th>
                    <th class="py-3 px-4 border-b font-semibold text-gray-700">Pelanggan</th>
                    <th class="py-3 px-4 border-b font-semibold text-gray-700">Tipe</th>
                    <th class="py-3 px-4 border-b font-semibold text-gray-700">Detail</th>
                    <th class="py-3 px-4 border-b font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pesanans as $pesan)
                <tr class="border-b hover:bg-gray-50 transition duration-75">
                    <td class="py-3 px-4 text-sm text-gray-500">
                        {{ $pesan->created_at->format('d M, H:i') }}
                    </td>
                    <td class="py-3 px-4 font-medium text-gray-800">
                        {{ $pesan->nama_pelanggan }}
                        <br>
                        <span class="text-xs text-gray-400 font-normal">{{ $pesan->nomor_hp }}</span>
                    </td>
                    <td class="py-3 px-4">
                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full font-semibold">
                            RESERVASI
                        </span>
                    </td>
                    <td class="py-3 px-4 text-sm text-gray-600">
                        <div class="font-semibold">{{ $pesan->jumlah_orang }} Orang</div>
                        <div class="text-xs italic text-gray-400">Catatan: {{ $pesan->catatan ?? '-' }}</div>
                    </td>
                    <td class="py-3 px-4">
                        <div class="flex items-center space-x-2">
                            <form action="{{ route('admin.reservasi.destroy', $pesan->id) }}" method="POST" onsubmit="return confirm('Hapus data reservasi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1 rounded transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-10 text-center text-gray-500 italic">
                        Belum ada data reservasi masuk.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
