<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    // TAMBAHKAN FUNGSI INI
    public function index()
    {
        // Mengambil semua data reservasi terbaru
        $pesanans = Reservasi::latest()->get();

        // Mengirim data ke view admin/reservasi/index.blade.php
        return view('admin.reservasi.index', compact('pesanans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'nomor_hp' => 'required',
            'jumlah_orang' => 'required|numeric',
            'waktu_reservasi' => 'required',
            'catatan' => 'nullable'
        ]);

        Reservasi::create([
            'nama_pelanggan' => $request->nama,
            'email'          => $request->email,
            'nomor_hp'       => $request->nomor_hp,
            'jumlah_orang'   => $request->jumlah_orang,
            'waktu_reservasi'=> $request->waktu_reservasi,
            'catatan'        => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Reservasi berhasil dikirim!');
    }
}
