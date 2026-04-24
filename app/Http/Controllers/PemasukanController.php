<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pemasukan::latest()->get();
        return view('pemasukan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemasukan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'tanggal' => 'required|date',
            'nama_lomba' => 'required',
            'jumlah_peserta' => 'required|numeric|min:1',
            'harga_tiket' => 'required|numeric|min:0',
        ]);

        $total = $request->jumlah_peserta * $request->harga_tiket;

        Pemasukan::create([
            'tanggal' => $request->tanggal,
            'nama_lomba' => $request->nama_lomba,
            'jumlah_peserta' => $request->jumlah_peserta,
            'harga_tiket' => $request->harga_tiket,
            'total' => $total
        ]);

        return redirect('/pemasukan')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemasukan $pemasukan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemasukan $pemasukan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemasukan $pemasukan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Pemasukan::findOrFail($id)->delete();
        return back()->with('success', 'Data dihapus');
    }
}
