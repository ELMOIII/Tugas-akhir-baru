<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lombas', function (Blueprint $table) {
            $table->id(); // Otomatis jadi 'No'
            $table->date('tanggal'); // Sesuai <th>Tanggal</th>
            $table->string('sesi'); // Sesuai <th>Sesi</th> (pakai string biar bisa diisi "Sesi 1", "Pagi", dll)
            
            // 👇 Asumsi 'Peserta' adalah jumlah tiket/orang. 
            // Kalau maksudmu 'Peserta' adalah NAMA orangnya, ubah jadi $table->string('nama_peserta');
            $table->integer('jumlah_peserta'); 
            
            $table->integer('harga_tiket'); // Sesuai <th>Harga Tiket</th>
            $table->integer('total'); // Sesuai <th>Total</th>
            
            $table->timestamps(); // Bawaan Laravel (created_at, updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lombas');
    }
};