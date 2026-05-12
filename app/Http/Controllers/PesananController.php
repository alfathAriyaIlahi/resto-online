<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\DetailPesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class PesananController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'metode_pengiriman' => 'required|in:ambil_sendiri,pesan_antar',
            'alamat_lengkap' => 'required_if:metode_pengiriman,pesan_antar',
            'items' => 'required|array',
            'total_harga' => 'required|numeric',
        ]);

        try {
            $snapToken = DB::transaction(function () use ($request) {
                // 2. Simpan Header Pesanan
                $pesanan = Pesanan::create([
                    'user_id'           => Auth::id(),
                    'nama_pelanggan'    => Auth::user()->name,
                    'nomor_hp'          => $request->nomor_hp ?? '-', // Default jika kosong
                    'metode_pengiriman' => $request->metode_pengiriman,
                    'alamat_lengkap'    => $request->alamat_lengkap,
                    'kode_promo'        => $request->kode_promo,
                    'total_harga'       => $request->total_harga,
                    'status'            => 'pending',
                ]);

                // 3. Simpan Detail Item
                foreach ($request->items as $item) {
                    if ($item['jumlah'] > 0) {
                        DetailPesanan::create([
                            'pesanan_id' => $pesanan->id,
                            'produk_id'  => $item['id'] ?? $item['produk_id'], // Penyesuaian key JS
                            'jumlah'     => $item['jumlah'],
                            'subtotal'   => $item['price'] * $item['jumlah'], // Hitung subtotal
                        ]);
                    }
                }

                // 4. Konfigurasi Midtrans
                Config::$serverKey = config('services.midtrans.serverKey');
                Config::$isProduction = config('services.midtrans.isProduction');
                Config::$isSanitized = config('services.midtrans.isSanitized');
                Config::$is3ds = config('services.midtrans.is3ds');

                // 5. Buat Parameter Transaksi Midtrans
                $params = [
                    'transaction_details' => [
                        'order_id' => 'MAKAN-' . $pesanan->id . '-' . time(),
                        'gross_amount' => (int) $request->total_harga,
                    ],
                    'customer_details' => [
                        'first_name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                        'phone' => $request->nomor_hp,
                    ],
                ];

                // 6. Dapatkan Snap Token
                return Snap::getSnapToken($params);
            });

            // Kembalikan JSON untuk diproses JavaScript di welcome.blade.php
            return response()->json([
                'status' => 'success',
                'snap_token' => $snapToken
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memproses pesanan: ' . $e->getMessage()
            ], 500);
        }
    }
}
