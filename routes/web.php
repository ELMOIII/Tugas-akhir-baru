<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::post('/payment/callback', [PaymentController::class, 'callback']);


// 🔐 SEMUA FITUR MASUK AUTH
Route::middleware(['auth'])->group(function () {
    Route::post('/payment/get-token', [PaymentController::class, 'getSnapToken']);

    // =========================
    // 📦 PROFILE
    // =========================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // =========================
    // 📦 DATA UTAMA
    // =========================
    Route::resource('barang', BarangController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::resource('pengeluaran', PengeluaranController::class);


    // =========================
    // 🎣 PEMASUKAN LOMBA
    // =========================
    Route::get('/pemasukan', [PemasukanController::class, 'index']);
    Route::get('/pemasukan/create', [PemasukanController::class, 'create']);
    Route::post('/pemasukan', [PemasukanController::class, 'store']);
    Route::delete('/pemasukan/{id}', [PemasukanController::class, 'destroy']);


    // =========================
    // 📊 LAPORAN
    // =========================
    Route::get('/laporan', [TransaksiController::class, 'laporan']);
    Route::get('/laporan/laba-bersih', [LaporanController::class, 'labaBersih']);

    // 🔥 LABA RUGI (FINAL)
    Route::get('/laba-rugi', [LaporanController::class, 'labaRugi']);

    // 📈 GRAFIK
    Route::get('/grafik', [LaporanController::class, 'grafik']);

});

require __DIR__.'/auth.php';