@extends('layouts.admin') {{-- Pastikan nama file layout admin kamu benar, misalnya 'layouts.admin' --}}

@section('admin_content')
<div class="bg-white rounded-3xl p-8 shadow-xl shadow-gray-200/50">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Daftar Pesanan</h1>
            <p class="text-sm text-gray-500 mt-1">Pantau status pembayaran pelanggan secara real-time.</p>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-xs font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">
                    <th class="pb-4 px-4">ID Order</th>
                    <th class="pb-4 px-4">Pelanggan</th>
                    <th class="pb-4 px-4">Total Harga</th>
                    <th class="pb-4 px-4">Metode</th>
                    <th class="pb-4 px-4 text-center">Status</th>
                    <th class="pb-4 px-4 text-right">Tgl. Pesan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($pesanans as $item)
                    <tr class="group hover:bg-gray-50 transition-colors">
                        <td class="py-5 px-4 text-sm font-bold text-gray-900">#{{ $item->id }}</td>
                        <td class="py-5 px-4">
                            <div class="text-sm font-bold text-gray-900 capitalize">{{ $item->nama_pelanggan }}</div>
                            <div class="text-[10px] text-gray-400">{{ $item->nomor_hp }}</div>
                        </td>
                        <td class="py-5 px-4 text-sm font-black text-orange-600">
                            Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                        </td>
                        <td class="py-5 px-4 text-xs font-medium text-gray-600">
                            {{ str_replace('_', ' ', $item->metode_pengiriman) }}
                        </td>
                        <td class="py-5 px-4 text-center">
                            @if($item->status == 'pending')
                                <span class="px-3 py-1 rounded-full bg-yellow-50 text-yellow-600 text-[10px] font-black uppercase tracking-tighter">
                                    Menunggu Pembayaran
                                </span>
                            @elseif($item->status == 'dibayar')
                                <span class="px-3 py-1 rounded-full bg-green-50 text-green-600 text-[10px] font-black uppercase tracking-tighter">
                                    Sudah Dibayar
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full bg-red-50 text-red-600 text-[10px] font-black uppercase tracking-tighter">
                                    {{ $item->status }}
                                </span>
                            @endif
                        </td>
                        <td class="py-5 px-4 text-right text-[11px] text-gray-400 font-medium">
                            {{ $item->created_at->format('d M Y, H:i') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-20 text-center text-gray-400 italic text-sm">
                            Belum ada pesanan yang masuk hari ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
