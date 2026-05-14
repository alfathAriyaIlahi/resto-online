<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan; // Pastikan model Pesanan kamu namanya ini
use Illuminate\Http\Request;

class PesananAdminController extends Controller
{
    public function index()
    {
        // Mengambil semua data pesanan dari yang paling baru
        $pesanans = Pesanan::latest()->get(); 
        
        return view('admin.pesanan.index', compact('pesanans'));
    }
}