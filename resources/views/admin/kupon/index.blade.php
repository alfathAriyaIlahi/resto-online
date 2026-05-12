@extends('layouts.admin')

@section('admin_content')
<div class="p-6">
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Manajemen Kupon Promo</h1>
            <p class="text-sm text-gray-500">Buat dan atur potongan harga untuk pelanggan MakanYuk.</p>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 text-sm rounded shadow-sm">
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 h-fit">
            <h2 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Tambah Kupon
            </h2>

            <form action="{{ route('admin.kupon.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Kode Kupon</label>
                    <input type="text" name="kode_kupon" class="w-full border-gray-200 rounded-xl p-3 text-sm focus:ring-orange-500 focus:border-orange-500" placeholder="CONTOH: KENYANGHEMAT" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Jenis</label>
                        <select name="jenis_diskon" class="w-full border-gray-200 rounded-xl p-3 text-sm">
                            <option value="nominal">Rupiah (Rp)</option>
                            <option value="persen">Persen (%)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nilai Diskon</label>
                        <input type="number" name="nilai_diskon" class="w-full border-gray-200 rounded-xl p-3 text-sm" placeholder="5000" required>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Min. Pembelian (Rp)</label>
                    <input type="number" name="min_pembelian" class="w-full border-gray-200 rounded-xl p-3 text-sm" value="0" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Kuota</label>
                        <input type="number" name="kuota" class="w-full border-gray-200 rounded-xl p-3 text-sm" placeholder="50" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Berlaku Sampai</label>
                        <input type="date" name="berlaku_sampai" class="w-full border-gray-200 rounded-xl p-3 text-sm" required>
                    </div>
                </div>

                <button type="submit" class="w-full bg-orange-600 text-white font-bold py-4 rounded-xl hover:bg-orange-700 transition-all shadow-lg shadow-orange-200">
                    Simpan Kupon Promo
                </button>
            </form>
        </div>

        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-50">
                <h2 class="text-lg font-bold text-gray-800">Daftar Kupon Aktif</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="p-4 text-xs font-bold text-gray-500 uppercase">Kode</th>
                            <th class="p-4 text-xs font-bold text-gray-500 uppercase">Potongan</th>
                            <th class="p-4 text-xs font-bold text-gray-500 uppercase">Min. Belanja</th>
                            <th class="p-4 text-xs font-bold text-gray-500 uppercase">Sisa Kuota</th>
                            <th class="p-4 text-xs font-bold text-gray-500 uppercase">Expired</th>
                            <th class="p-4 text-xs font-bold text-gray-500 uppercase text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($kupons as $k)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4">
                                <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-full font-bold text-xs">
                                    {{ $k->kode_kupon }}
                                </span>
                            </td>
                            <td class="p-4 text-sm font-semibold text-gray-700">
                                {{ $k->jenis_diskon == 'nominal' ? 'Rp '.number_format($k->nilai_diskon, 0, ',', '.') : $k->nilai_diskon.'%' }}
                            </td>
                            <td class="p-4 text-sm text-gray-600">
                                Rp {{ number_format($k->min_pembelian, 0, ',', '.') }}
                            </td>
                            <td class="p-4 text-sm text-gray-600">
                                {{ $k->kuota }} Kali
                            </td>
                            <td class="p-4 text-sm {{ $k->berlaku_sampai->isPast() ? 'text-red-500 font-bold' : 'text-gray-600' }}">
                                {{ $k->berlaku_sampai->format('d M Y') }}
                            </td>
                            <td class="p-4 text-center">
                                <form action="{{ route('admin.kupon.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Hapus kupon ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 text-red-400 hover:text-red-600 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-10 text-center text-gray-400 text-sm">Belum ada kupon yang dibuat.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
