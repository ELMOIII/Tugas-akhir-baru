<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('transaksi.index', compact('barangs'));
    }

    public function show($id)
    {
        $transaksi = Transaksi::with('details.barang', 'user')->findOrFail($id);
        return view('transaksi.struk', compact('transaksi'));
    }

public function laporan(Request $request)
{
    $query = Transaksi::query();

    // 🔍 FILTER TANGGAL
    if ($request->tanggal_awal && $request->tanggal_akhir) {
        $query->whereBetween('tanggal', [
            $request->tanggal_awal,
            $request->tanggal_akhir
        ]);
    }

    $transaksis = $query->latest()->get();

    // 💰 1. TOTAL PENDAPATAN (OMSET)
    $total = $transaksis->sum('total');

    // 📈 2. TOTAL KEUNTUNGAN / LABA BERSIH PENJUALAN
    // Menghitung total kolom 'keuntungan' dari detail transaksi yang terfilter
    $totalKeuntungan = DetailTransaksi::whereHas('transaksi', function ($q) use ($request) {
        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $q->whereBetween('tanggal', [
                $request->tanggal_awal,
                $request->tanggal_akhir
            ]);
        }
    })->sum('keuntungan');

    return view('transaksi.laporan', compact(
        'transaksis',
        'total',
        'totalKeuntungan'
    ));
}

    public function store(Request $request)
    {
        $request->validate([
            'barang_id.*' => 'required|exists:barangs,id',
            'jumlah.*' => 'required|numeric|min:1',
            'metode_pembayaran' => 'required',
            'bayar' => 'required|numeric|min:1'
        ]);

        DB::beginTransaction();

        try {
            $total = 0;
            $items = [];

            foreach ($request->barang_id as $key => $barang_id) {

                if (!$barang_id) continue;

                $barang = Barang::findOrFail($barang_id);
                $jumlah = $request->jumlah[$key];

                if ($barang->stok < $jumlah) {
                    DB::rollBack();
                    return back()->with('error', 'Stok tidak cukup untuk ' . $barang->nama_barang);
                }

                $subtotal = $barang->harga_jual * $jumlah;
                $keuntungan = ($barang->harga_jual - $barang->harga_beli) * $jumlah;

                $items[] = [
                    'barang' => $barang,
                    'barang_id' => $barang_id,
                    'jumlah' => $jumlah,
                    'subtotal' => $subtotal,
                    'keuntungan' => $keuntungan
                ];

                $total += $subtotal;
            }

            if ($request->bayar < $total) {
                DB::rollBack();
                return back()->with('error', 'Uang tidak cukup!');
            }

            $transaksi = Transaksi::create([
                'tanggal' => now(),
                'total' => $total,
                'metode_pembayaran' => $request->metode_pembayaran,
                'bayar' => $request->bayar,
                'kembalian' => $request->bayar - $total,
                'user_id' => auth()->id()
            ]);

            foreach ($items as $item) {

                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id' => $item['barang_id'],
                    'jumlah' => $item['jumlah'],
                    'subtotal' => $item['subtotal'],
                    'keuntungan' => $item['keuntungan']
                ]);

                $item['barang']->stok -= $item['jumlah'];
                $item['barang']->save();
            }

            DB::commit();

            return redirect('/transaksi/' . $transaksi->id)
                ->with('success', 'Transaksi berhasil');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
}