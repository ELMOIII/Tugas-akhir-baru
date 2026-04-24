<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    protected $fillable = [
    'tanggal',
    'nama_lomba',
    'jumlah_peserta',
    'harga_tiket',
    'total'
];
}
