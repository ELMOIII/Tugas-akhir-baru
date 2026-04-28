<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengeluaran;
use Carbon\Carbon;

class PengeluaranSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'tanggal' => Carbon::now()->subDays(2),
                'kategori' => 'Operasional',
                'keterangan' => 'Bayar Listrik',
                'jumlah' => 250000
            ],
            [
                'tanggal' => Carbon::now()->subDays(1),
                'kategori' => 'Belanja',
                'keterangan' => 'Beli Stok Plastik & Kresek',
                'jumlah' => 100000
            ],
            [
                'tanggal' => Carbon::now(),
                'kategori' => 'Lain-lain',
                'keterangan' => 'Kebersihan Lingkungan',
                'jumlah' => 20000
            ],
        ];

        foreach ($data as $item) {
            Pengeluaran::create($item);
        }
    }
}