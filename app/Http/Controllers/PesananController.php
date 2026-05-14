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
        $request->validate([
            'metode_pengiriman' => 'required|in:ambil_sendiri,pesan_antar',
            'alamat_lengkap' => 'required_if:metode_pengiriman,pesan_antar',
            'items' => 'required|array',
            'total_harga' => 'required|numeric',
        ]);

        try {
            $snapToken = DB::transaction(function () use ($request) {

                $pesanan = Pesanan::create([
                    'user_id'           => Auth::id(),
                    'nama_pelanggan'    => Auth::user()->name,
                    'nomor_hp'          => $request->nomor_hp ?? '-',
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
                            'produk_id'  => $item['id'] ?? $item['produk_id'],
                            'jumlah'     => $item['jumlah'],
                            'subtotal'   => ($item['price'] ?? $item['subtotal'] / $item['jumlah']) * $item['jumlah'],
                        ]);
                    }
                }

                Config::$serverKey = env('MIDTRANS_SERVER_KEY');
                Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
                Config::$isSanitized = true;
                Config::$is3ds = true;

                $midtrans_order_id = $pesanan->id . '-' . time();

                $params = [
                    'transaction_details' => [
                        'order_id' => $midtrans_order_id,
                        'gross_amount' => (int) $request->total_harga,
                    ],
                    'customer_details' => [
                        'first_name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                        'phone' => $request->nomor_hp ?? '-',
                    ],
                ];

                return Snap::getSnapToken($params);
            });

            return response()->json([
                'status' => 'success',
                'snap_token' => $snapToken
            ]);

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Midtrans Error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memproses pesanan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function callback(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');

        $orderIdRaw = $request->order_id;
        $orderId = explode('-', $orderIdRaw)[0];

        $hashed = hash("sha512", $orderIdRaw . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            $pesanan = Pesanan::find($orderId);
            if ($pesanan) {
                if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                    $pesanan->update(['status' => 'dibayar']);
                } elseif (in_array($request->transaction_status, ['cancel', 'expire', 'deny'])) {
                    $pesanan->update(['status' => 'gagal']);
                }
            }
        }

        return response()->json(['message' => 'Sukses']);
    }
}
