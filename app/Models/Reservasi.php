<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
protected $fillable = [
    'nama_pelanggan',
    'email',
    'nomor_hp',
    'jumlah_orang',
    'waktu_reservasi',
    'catatan'
];
}
