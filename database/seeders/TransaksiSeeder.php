<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Carbon\Carbon;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kita bikin perulangan 5 kali untuk membuat 5 transaksi
        for ($i = 1; $i <= 5; $i++) {
            
            // Bikin angka acak (dummy)
            $jumlahBarang = rand(1, 4);
            $hargaJual = rand(10, 50) * 1000; // Harga antara 10.000 - 50.000
            $labaPerItem = rand(2, 5) * 1000; // Keuntungan antara 2.000 - 5.000

            $subtotal = $hargaJual * $jumlahBarang;
            $totalKeuntungan = $labaPerItem * $jumlahBarang;

            // 1. Simpan ke tabel transaksis
            $transaksi = Transaksi::create([
                'tanggal' => Carbon::now()->subDays(rand(0, 10)), // Tanggal diacak dari hari ini sampai 10 hari ke belakang
                'total' => $subtotal,
                
                // ⚠️ NOTE: Jika di migration transaksis kamu ada kolom di bawah ini (seperti di controller), buka komentarnya:
                // 'metode_pembayaran' => 'cash',
                // 'bayar' => $subtotal + 10000,
                // 'kembalian' => 10000,
                // 'user_id' => 1,
            ]);

            // 2. Simpan ke tabel detail_transaksis
            DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'barang_id' => rand(1, 3), // Asumsi dari BarangSeeder kamu punya minimal 3 barang dengan id 1, 2, atau 3
                'jumlah' => $jumlahBarang,
                'subtotal' => $subtotal,
                'keuntungan' => $totalKeuntungan // Saya pakai 'keuntungan' mengikuti controllermu
                // 'laba' => $totalKeuntungan // Gunakan 'laba' jika di databasemu kolomnya masih laba
            ]);
        }
    }
}