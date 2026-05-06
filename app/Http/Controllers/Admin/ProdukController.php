<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Menampilkan daftar semua produk.
     */
    public function index()
    {
        // Mengambil semua produk beserta data kategorinya (eager loading)
        $produks = Produk::with('kategori')->get();
        return view('admin.produk.index', compact('produks'));
    }

    /**
     * Menampilkan form untuk menambah produk baru.
     */
    public function create()
    {
        // Kita butuh data kategori agar bisa dipilih di form dropdown
        $kategoris = Kategori::all();
        return view('admin.produk.create', compact('kategoris'));
    }

    /**
     * Menyimpan produk baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga'       => 'required|numeric',
            'kategori_id' => 'required|exists:kategoris,id',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        // Logika upload foto ke folder storage/app/public/produk
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('produk', 'public');
        }

        Produk::create($data);

        return redirect()->route('admin.produk.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    /**
     * Menghapus produk dari database.
     */
    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);

        // Hapus file foto dari storage jika ada sebelum menghapus data di DB
        if ($produk->foto) {
            Storage::disk('public')->delete($produk->foto);
        }

        $produk->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Menu berhasil dihapus!');
    }
}
