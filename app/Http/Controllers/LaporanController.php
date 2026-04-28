<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use App\Models\Pengeluaran;
use App\Models\Pemasukan;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
public function labaBersih(Request $request)
    {
        // 1. Query Penjualan Barang
        $queryBarang = DetailTransaksi::query();
        
        // 2. Query Pemasukan Lomba
        $queryLomba = Pemasukan::query();
        
        // 3. Query Pengeluaran
        $queryKeluar = Pengeluaran::query();

        // 🔍 FILTER TANGGAL UNTUK SEMUA TABEL
        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $queryBarang->whereHas('transaksi', function ($q) use ($request) {
                $q->whereBetween('tanggal', [
                    $request->tanggal_awal,
                    $request->tanggal_akhir
                ]);
            });

            $queryLomba->whereBetween('tanggal', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);

            $queryKeluar->whereBetween('tanggal', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }

        // 💰 HITUNG LABA PENJUALAN BARANG (menggunakan kolom 'keuntungan' di database)
        $labaBarang = $queryBarang->sum('keuntungan'); // Atau pakai 'laba' jika nama kolom di DB-mu adalah laba

        // 💰 HITUNG LABA LOMBA (20% dari total pendapatan tiket)
        $totalTiket = $queryLomba->sum('total');
        $labaLomba = $totalTiket * 0.2;

        // 🔥 TOTAL PENDAPATAN (GABUNGAN BARANG + LOMBA)
        $totalPendapatan = $labaBarang + $labaLomba;

        // 🔥 TOTAL PENGELUARAN (Listrik, gaji, restok, dll)
        $totalPengeluaran = $queryKeluar->sum('jumlah');

        // 🏆 LABA BERSIH AKHIR (Sisa uang bersih)
        $labaBersihAkhir = $totalPendapatan - $totalPengeluaran;

        // Kirim semua variabel ke view
        return view('laporan.laba-bersih', [
            'labaBarang' => $labaBarang,
            'labaLomba' => $labaLomba,
            'totalPendapatan' => $totalPendapatan,
            'pengeluaran' => $totalPengeluaran,
            'labaBersihAkhir' => $labaBersihAkhir
        ]);
    }

    public function grafik()
    {
        // 1. Ambil Data Pemasukan Warung (Tabel transaksis)
        $warung = Transaksi::select(
                DB::raw('DATE(tanggal) as tanggal'), 
                DB::raw('SUM(total) as total_pendapatan')
            )
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        $labelsWarung = $warung->pluck('tanggal');
        $totalsWarung = $warung->pluck('total_pendapatan');

        // 2. Ambil Data Pemasukan Lomba (Tabel pemasukans)
        $lomba = Pemasukan::select(
                DB::raw('DATE(tanggal) as tanggal'), 
                DB::raw('SUM(total) as total_pendapatan')
            )
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        $labelsLomba = $lomba->pluck('tanggal');
        $totalsLomba = $lomba->pluck('total_pendapatan');

        return view('laporan.grafik', compact( // Sesuaikan nama view-nya dengan punyamu
            'labelsWarung', 'totalsWarung',
            'labelsLomba', 'totalsLomba'
        ));
    }
}