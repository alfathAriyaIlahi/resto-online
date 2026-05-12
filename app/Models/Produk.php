<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    protected $fillable = [
        'nama_produk',
        'kategori_id',
        'harga',
        'foto',
    ];

    protected $with = ['options'];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    public function options(): HasMany
    {
        return $this->hasMany(ProdukOption::class, 'produk_id');
    }
}
