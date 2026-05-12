<?php

namespace App\Http\Controllers;

use App\Models\Kupon;
use Illuminate\Http\Request;

class KuponController extends Controller
{
    // 1. Fungsi INDEX untuk nampilin halaman daftar kupon
    public function index()
    {
        $kupons = Kupon::latest()->get(); // Ambil semua data kupon
        return view('admin.kupon.index', compact('kupons'));
    }

    // 2. Fungsi STORE untuk simpan kupon baru
    public function store(Request $request)
    {
        $request->validate([
            'kode_kupon' => 'required|unique:kupons,kode_kupon',
            'jenis_diskon' => 'required|in:nominal,persen',
            'nilai_diskon' => 'required|numeric',
            'min_pembelian' => 'required|numeric',
            'berlaku_sampai' => 'required|date',
            'kuota' => 'required|numeric',
        ]);

        Kupon::create([
            'kode_kupon' => strtoupper($request->kode_kupon),
            'jenis_diskon' => $request->jenis_diskon,
            'nilai_diskon' => $request->nilai_diskon,
            'min_pembelian' => $request->min_pembelian,
            'berlaku_sampai' => $request->berlaku_sampai,
            'kuota' => $request->kuota,
            'is_active' => true
        ]);

        return back()->with('success', 'Kupon berhasil dibuat!');
    }

    // 3. Fungsi DESTROY untuk hapus kupon
    public function destroy($id)
    {
        Kupon::findOrFail($id)->delete();
        return back()->with('success', 'Kupon berhasil dihapus!');
    }

    // 4. Fungsi CEK KUPON untuk sisi pelanggan (Ajax)
    public function cekKupon(Request $request)
    {
        $kode = strtoupper($request->kode);
        $totalBelanja = $request->total_belanja;

        $kupon = Kupon::where('kode_kupon', $kode)->first();

        if (!$kupon) {
            return response()->json(['valid' => false, 'message' => 'Kupon tidak terdaftar!']);
        }

        if (!$kupon->is_active || $kupon->kuota <= 0) {
            return response()->json(['valid' => false, 'message' => 'Kupon sudah habis/tidak aktif!']);
        }

        if (now() > $kupon->berlaku_sampai) {
            return response()->json(['valid' => false, 'message' => 'Kupon sudah kadaluarsa!']);
        }

        if ($totalBelanja < $kupon->min_pembelian) {
            return response()->json([
                'valid' => false,
                'message' => 'Min. belanja Rp ' . number_format($kupon->min_pembelian, 0, ',', '.')
            ]);
        }

        return response()->json([
            'valid' => true,
            'jenis' => $kupon->jenis_diskon,
            'nilai' => $kupon->nilai_diskon,
            'message' => 'Kupon berhasil dipasang!'
        ]);
    }
}
