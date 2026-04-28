<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Pemasukan;
use App\Models\Lomba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class TransaksiController extends Controller
{
    // --- METODE LAMA YANG KEMBALI DIMASUKKAN ---

    public function index()
    {
        // Mengambil data barang dan lomba untuk dropdown di view
        $barangs = Barang::all();
        $lombas = Lomba::all(); 
        return view('transaksi.index', compact('barangs', 'lombas'));
    }

    public function show($id)
    {
        // Menampilkan struk transaksi[cite: 3]
        $transaksi = Transaksi::with('details.barang', 'user')->findOrFail($id);
        return view('transaksi.struk', compact('transaksi'));
    }

    public function laporan(Request $request)
    {
        $query = Transaksi::query();

        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $query->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        $transaksis = $query->latest()->get();
        $total = $transaksis->sum('total');

        $totalKeuntungan = DetailTransaksi::whereHas('transaksi', function ($q) use ($request) {
            if ($request->tanggal_awal && $request->tanggal_akhir) {
                $q->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir]);
            }
        })->sum('keuntungan');

        return view('transaksi.laporan', compact('transaksis', 'total', 'totalKeuntungan'));
    }

    // --- METODE STORE YANG SUDAH DI-FIX PEMBAYARANNYA ---

    public function store(Request $request)
    {
        $request->validate([
            'barang_id.*' => 'nullable|exists:barangs,id',
            'metode_pembayaran' => 'required',
            'bayar' => 'required|numeric|min:0', // Pastikan bayar masuk[cite: 1, 3]
        ]);

        DB::beginTransaction();
        try {
            $totalKeseluruhan = 0;
            $dataBarang = [];

            // 1. Proses Barang
            if ($request->has('barang_id')) {
                foreach ($request->barang_id as $key => $id) {
                    if (!$id) continue;
                    $barang = Barang::findOrFail($id);
                    $qty = $request->jumlah[$key];

                    if ($barang->stok < $qty) throw new \Exception("Stok $barang->nama_barang tidak cukup!");

                    $subtotal = $barang->harga_jual * $qty;
                    $untung = ($barang->harga_jual - $barang->harga_beli) * $qty;
                    
                    $dataBarang[] = [
                        'id' => $id,
                        'qty' => $qty,
                        'subtotal' => $subtotal,
                        'keuntungan' => $untung
                    ];
                    $totalKeseluruhan += $subtotal;
                }
            }

            // 2. Proses Tiket Lomba
            $totalLomba = (int)$request->harga_tiket * (int)$request->jumlah_peserta;
            $totalKeseluruhan += $totalLomba;

            // 3. Cek Saldo Pembayaran (Khusus Cash)
            if ($request->metode_pembayaran !== 'Midtrans' && $request->bayar < $totalKeseluruhan) {
                throw new \Exception('Uang bayar kurang!');
            }

            // 4. Simpan Transaksi
            $transaksi = Transaksi::create([
                'tanggal' => now(),
                'total' => $totalKeseluruhan,
                'metode_pembayaran' => $request->metode_pembayaran,
                'bayar' => $request->bayar,
                'kembalian' => ($request->metode_pembayaran === 'Midtrans') ? 0 : ($request->bayar - $totalKeseluruhan),
                'user_id' => Auth::id() ?? 1,
                'status' => ($request->metode_pembayaran === 'Midtrans') ? 'pending' : 'lunas'
            ]);

            // 5. Simpan Detail Transaksi & Kurangi Stok
            foreach ($dataBarang as $db) {
                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id' => $db['id'],
                    'jumlah' => $db['qty'],
                    'subtotal' => $db['subtotal'],
                    'keuntungan' => $db['keuntungan']
                ]);
                Barang::find($db['id'])->decrement('stok', $db['qty']);
            }

            // 6. Simpan Pemasukan Lomba
            if ($totalLomba > 0) {
    Pemasukan::create([
        'tanggal' => now(),
        'nama_lomba' => $request->sesi ?? 'Sesi Umum', // Tetap simpan ke kolom nama_lomba
        'jumlah_peserta' => $request->jumlah_peserta,
        'harga_tiket' => $request->harga_tiket,
        'total' => $totalLomba,
        'transaksi_id' => $transaksi->id
    ]);
}

            DB::commit();

            // 7. Respon Midtrans vs Cash
            if ($request->metode_pembayaran === 'Midtrans') {
                Config::$serverKey = env('MIDTRANS_SERVER_KEY');
                Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
                
                $params = [
                    'transaction_details' => [
                        'order_id' => 'TRX-' . $transaksi->id . '-' . time(),
                        'gross_amount' => (int)$totalKeseluruhan,
                    ],
                    'customer_details' => [
                        'name' => Auth::user()->name ?? 'Pelanggan',
                    ]
                ];

                return response()->json([
                    'snap_token' => Snap::getSnapToken($params),
                    'transaksi_id' => $transaksi->id
                ]);
            }

            return redirect("/transaksi/{$transaksi->id}")->with('success', 'Transaksi Berhasil!');

        } catch (\Exception $e) {
            DB::rollBack();
            return $request->ajax() 
                ? response()->json(['error' => $e->getMessage()], 400) 
                : back()->with('error', $e->getMessage())->withInput();
        }
    }
}