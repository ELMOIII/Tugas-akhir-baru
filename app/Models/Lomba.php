<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lomba extends Model
{
    protected $fillable = [
        'tanggal', 
        'sesi', 
        'jumlah_peserta', // Sesuaikan jika kamu pakai 'nama_peserta'
        'harga_tiket', 
        'total'
    ];
}
