<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        Kategori::insert([
            ['nama_kategori' => 'Makanan'],
            ['nama_kategori' => 'Minuman'],
            ['nama_kategori' => 'Umpan'],
            ['nama_kategori' => 'DLL'],
        ]);
    }
}