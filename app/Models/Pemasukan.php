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
    'transaksi_id',
    'total'
];

// 🔥 Fungsi untuk menghitung keuntungan per tiket (20%)
    public function getLabaPerTiketAttribute()
    {
        return $this->harga_tiket * 0.2;
    }

    // 🔥 Fungsi untuk menghitung total keuntungan bersih per baris
    public function getTotalLabaAttribute()
    {
        return $this->total * 0.2;
    }
}
