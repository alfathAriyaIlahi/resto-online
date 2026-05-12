<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'produk_id',
        'jenis',
        'nama_opsi',
        'harga_tambahan'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
