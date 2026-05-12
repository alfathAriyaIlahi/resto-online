<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\ProdukOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategori')->get();
        return view('admin.produk.index', compact('produks'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.produk.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga'       => 'required|numeric',
            'kategori_id' => 'required|exists:kategoris,id',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'opsi.*.nama_opsi' => 'nullable|string',
            'opsi.*.harga_tambahan' => 'nullable|numeric'
        ]);

        $data = $request->except('opsi');

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('produk', 'public');
        }

        $produk = Produk::create($data);

        if ($request->has('opsi')) {
            foreach ($request->opsi as $item) {
                if (!empty($item['nama_opsi'])) {
                    $produk->options()->create([
                        'jenis' => $item['jenis'],
                        'nama_opsi' => $item['nama_opsi'],
                        'harga_tambahan' => $item['harga_tambahan'] ?? 0,
                    ]);
                }
            }
        }

        return redirect()->route('admin.produk.index')->with('success', 'Menu dan opsi berhasil ditambahkan!');
    }

    // --- INI FUNGSI BARU YANG DITAMBAHKAN BIAR BISA KLIK EDIT ---
    public function edit(string $id)
    {
        $produk = Produk::with('options')->findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.produk.edit', compact('produk', 'kategoris'));
    }

    // --- INI FUNGSI BARU BIAR PAS KLIK SIMPAN SAAT EDIT GAK ERROR ---
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga'       => 'required|numeric',
            'kategori_id' => 'required|exists:kategoris,id',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'opsi.*.nama_opsi' => 'nullable|string',
            'opsi.*.harga_tambahan' => 'nullable|numeric'
        ]);

        $produk = Produk::findOrFail($id);
        $data = $request->except('opsi');

        // Kalau admin upload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($produk->foto) {
                Storage::disk('public')->delete($produk->foto);
            }
            $data['foto'] = $request->file('foto')->store('produk', 'public');
        }

        // Update data dasar produk
        $produk->update($data);

        // Update opsi / topping
        if ($request->has('opsi')) {
            // Hapus semua opsi lama, ganti dengan yang baru dari form edit
            $produk->options()->delete();

            foreach ($request->opsi as $item) {
                if (!empty($item['nama_opsi'])) {
                    $produk->options()->create([
                        'jenis' => $item['jenis'],
                        'nama_opsi' => $item['nama_opsi'],
                        'harga_tambahan' => $item['harga_tambahan'] ?? 0,
                    ]);
                }
            }
        }

        return redirect()->route('admin.produk.index')->with('success', 'Menu dan opsi berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->foto) {
            Storage::disk('public')->delete($produk->foto);
        }

        $produk->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Menu berhasil dihapus!');
    }
}
