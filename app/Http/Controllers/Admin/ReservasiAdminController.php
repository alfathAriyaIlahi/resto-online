<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class ReservasiAdminController extends Controller
{
    public function index()
    {
        $pesanans = Reservasi::latest()->get();
        return view('admin.reservasi.index', compact('pesanans'));
    }

    public function destroy($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->delete();
        return redirect()->back()->with('success', 'Data reservasi berhasil dihapus');
    }
}
