<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;
use App\Models\Kategori;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $makanan = Kategori::where('nama_kategori', 'Makanan')->first();
        $minuman = Kategori::where('nama_kategori', 'Minuman')->first();
        $umpan   = Kategori::where('nama_kategori', 'Umpan')->first();

        Barang::insert([

            // 🍜 MAKANAN
            [
                'nama_barang' => 'Indomie Goreng',
                'kategori_id' => $makanan->id,
                'harga_beli' => 6000,
                'harga_jual' => 13000,
                'stok' => 50,
                'stok_minimum' => 10
            ],
            [
                'nama_barang' => 'Indomie Rebus',
                'kategori_id' => $makanan->id,
                'harga_beli' => 6000,
                'harga_jual' => 13000,
                'stok' => 50,
                'stok_minimum' => 10
            ],
            [
                'nama_barang' => 'Nasi Goreng',
                'kategori_id' => $makanan->id,
                'harga_beli' => 9000,
                'harga_jual' => 13000,
                'stok' => 50,
                'stok_minimum' => 10
            ],

            // 🥤 MINUMAN
            [
                'nama_barang' => 'Fanta',
                'kategori_id' => $minuman->id,
                'harga_beli' => 4000,
                'harga_jual' => 7000,
                'stok' => 40,
                'stok_minimum' => 5
            ],
            [
                'nama_barang' => 'Sprite',
                'kategori_id' => $minuman->id,
                'harga_beli' => 4000,
                'harga_jual' => 7000,
                'stok' => 40,
                'stok_minimum' => 5
            ],
            [
                'nama_barang' => 'Pucuk',
                'kategori_id' => $minuman->id,
                'harga_beli' => 2500,
                'harga_jual' => 5000,
                'stok' => 50,
                'stok_minimum' => 20
            ],
            [
                'nama_barang' => 'Aqua',
                'kategori_id' => $minuman->id,
                'harga_beli' => 2500,
                'harga_jual' => 5000,
                'stok' => 100,
                'stok_minimum' => 30
            ],
            [
                'nama_barang' => 'Kopi Abc',
                'kategori_id' => $minuman->id,
                'harga_beli' => 2800,
                'harga_jual' => 5000,
                'stok' => 40,
                'stok_minimum' => 10
            ],
            [
                'nama_barang' => 'Golda',
                'kategori_id' => $minuman->id,
                'harga_beli' => 2000,
                'harga_jual' => 5000,
                'stok' => 50,
                'stok_minimum' => 20
            ],
            [
                'nama_barang' => 'Teh Jahe',
                'kategori_id' => $minuman->id,
                'harga_beli' => 4000,
                'harga_jual' => 7000,
                'stok' => 40,
                'stok_minimum' => 5
            ],
            [
                'nama_barang' => 'Teh Susu',
                'kategori_id' => $minuman->id,
                'harga_beli' => 4000,
                'harga_jual' => 7000,
                'stok' => 40,
                'stok_minimum' => 5
            ],
            [
                'nama_barang' => 'Teh Panas',
                'kategori_id' => $minuman->id,
                'harga_beli' => 2000,
                'harga_jual' => 5000,
                'stok' => 24,
                'stok_minimum' => 5
            ],
            [
                'nama_barang' => 'Teh Dingin',
                'kategori_id' => $minuman->id,
                'harga_beli' => 3000,
                'harga_jual' => 7000,
                'stok' => 24,
                'stok_minimum' => 5
            ],
            [
                'nama_barang' => 'Kopi Hitam',
                'kategori_id' => $minuman->id,
                'harga_beli' => 2000,
                'harga_jual' => 5000,
                'stok' => 50,
                'stok_minimum' => 5
            ],
            [
                'nama_barang' => 'Kopi Susu',
                'kategori_id' => $minuman->id,
                'harga_beli' => 4000,
                'harga_jual' => 8000,
                'stok' => 24,
                'stok_minimum' => 5
            ],
            [
                'nama_barang' => 'Kopi Luwak panas',
                'kategori_id' => $minuman->id,
                'harga_beli' => 2000,
                'harga_jual' => 8000,
                'stok' => 40,
                'stok_minimum' => 5
            ],
            [
                'nama_barang' => 'Kopi Luwak dingin',
                'kategori_id' => $minuman->id,
                'harga_beli' => 3000,
                'harga_jual' => 10000,
                'stok' => 40,
                'stok_minimum' => 5
            ],
            [
                'nama_barang' => 'Goodday Cappuccino Panas',
                'kategori_id' => $minuman->id,
                'harga_beli' => 2000,
                'harga_jual' => 8000,
                'stok' => 18,
                'stok_minimum' => 5
            ],
                        [
                'nama_barang' => 'Goodday Cappuccino Dingin',
                'kategori_id' => $minuman->id,
                'harga_beli' => 3000,
                'harga_jual' => 12000,
                'stok' => 18,
                'stok_minimum' => 5
            ],
            [
                'nama_barang' => 'Teh Tarik Panas',
                'kategori_id' => $minuman->id,
                'harga_beli' => 2000,
                'harga_jual' => 8000,
                'stok' => 24,
                'stok_minimum' => 5
            ],
                        [
                'nama_barang' => 'Teh Tarik Dingin',
                'kategori_id' => $minuman->id,
                'harga_beli' => 3000,
                'harga_jual' => 12000,
                'stok' => 30,
                'stok_minimum' => 5
            ],

            // 🎣 UMPAN
            [
                'nama_barang' => 'Roti',
                'kategori_id' => $umpan->id,
                'harga_beli' => 7000,
                'harga_jual' => 10000,
                'stok' => 99,
                'stok_minimum' => 10
            ],
            [
                'nama_barang' => 'Chicken',
                'kategori_id' => $umpan->id,
                'harga_beli' => 10000,
                'harga_jual' => 15000,
                'stok' => 99,
                'stok_minimum' => 20
            ],
            [
                'nama_barang' => 'Cacing',
                'kategori_id' => $umpan->id,
                'harga_beli' => 5000,
                'harga_jual' => 10000,
                'stok' => 20,
                'stok_minimum' => 5
            ],
            [
                'nama_barang' => 'Kail Daichi ukuran 17',
                'kategori_id' => $umpan->id,
                'harga_beli' => 10000,
                'harga_jual' => 12000,
                'stok' => 200,
                'stok_minimum' => 20
            ],
            [
                'nama_barang' => 'Kinoy',
                'kategori_id' => $umpan->id,
                'harga_beli' => 5000,
                'harga_jual' => 7000,
                'stok' => 9,
                'stok_minimum' => 5
            ],
            [
                'nama_barang' => 'Telur Ayam',
                'kategori_id' => $umpan->id,
                'harga_beli' => 2000,
                'harga_jual' => 3000,
                'stok' => 46,
                'stok_minimum' => 20
            ],
            [
                'nama_barang' => 'Telur Bebek',
                'kategori_id' => $umpan->id,
                'harga_beli' => 3500,
                'harga_jual' => 5000,
                'stok' => 48,
                'stok_minimum' => 5
            ],

        ]);
    }
}