<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nomor_hp' => 'required',
            'metode_pengiriman' => 'required|in:ambil_sendiri,pesan_antar',
            'alamat_lengkap' => 'required_if:metode_pengiriman,pesan_antar',
            'items' => 'required|array',
            'total_harga' => 'required|numeric',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $pesanan = Pesanan::create([
                    'user_id'           => Auth::id(),
                    'nama_pelanggan'    => Auth::user()->name,
                    'nomor_hp'          => $request->nomor_hp,
                    'metode_pengiriman' => $request->metode_pengiriman,
                    'alamat_lengkap'    => $request->alamat_lengkap,
                    'kode_promo'        => $request->kode_promo,
                    'total_harga'       => $request->total_harga,
                    'status'            => 'pending',
                ]);

                foreach ($request->items as $item) {
                    if ($item['jumlah'] > 0) {
                        DetailPesanan::create([
                            'pesanan_id' => $pesanan->id,
                            'produk_id'  => $item['produk_id'],
                            'jumlah'     => $item['jumlah'],
                            'subtotal'   => $item['subtotal'],
                        ]);
                    }
                }
            });

            return redirect()->back()->with('success', 'Pesanan Anda berhasil dikirim! Silakan tunggu konfirmasi kami.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pesanan: ' . $e->getMessage());
        }
    }
}
