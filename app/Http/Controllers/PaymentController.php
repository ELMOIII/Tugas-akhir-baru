<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Pemasukan, Transaksi};
use Midtrans\{Config, Snap};

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function getSnapToken(Request $request)
    {
        $id = $request->id;
        $data = ($request->type == 'lomba') ? Pemasukan::find($id) : Transaksi::find($id);

        if (!$data) return response()->json(['error' => 'Data tidak ditemukan'], 404);

        $params = [
            'transaction_details' => [
                'order_id' => strtoupper($request->type ?? 'TRX') . '-' . $data->id . '-' . time(),
                'gross_amount' => (int)$data->total,
            ],
            'item_details' => [[
                'id' => $id,
                'price' => (int)$data->total,
                'quantity' => 1,
                'name' => ($request->type == 'lomba') ? 'Tiket Sesi' : 'Belanja Barang',
            ]]
        ];

        return response()->json(['snap_token' => Snap::getSnapToken($params)]);
    }
}