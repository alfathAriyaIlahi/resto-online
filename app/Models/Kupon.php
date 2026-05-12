<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kupon extends Model
{
    use HasFactory;

    protected $table = 'kupons';

    protected $fillable = [
        'kode_kupon',
        'jenis_diskon',
        'nilai_diskon',
        'min_pembelian',
        'berlaku_sampai',
        'kuota',
        'is_active',
    ];

    protected $casts = [
        'berlaku_sampai' => 'date',
        'is_active' => 'boolean',
        'nilai_diskon' => 'integer',
        'min_pembelian' => 'integer',
        'kuota' => 'integer',
    ];
}
