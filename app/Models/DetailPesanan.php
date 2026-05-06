<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pesanan_id',
        'produk_id',
        'jumlah',
        'subtotal'
    ];

    // Relasi balik ke produk (Untuk tahu nama makanan yang dibeli)
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
