<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    // =========================
    // 📌 LIST
    // =========================
    public function index()
    {
        $pengeluarans = Pengeluaran::latest()->get();
        return view('pengeluaran.index', compact('pengeluarans'));
    }

    // =========================
    // 📌 FORM TAMBAH
    // =========================
    public function create()
    {
        return view('pengeluaran.create');
    }

    // =========================
    // 📌 SIMPAN
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'keterangan' => 'required',
            'jumlah' => 'required|numeric|min:1'
        ]);

        Pengeluaran::create([
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'jumlah' => $request->jumlah,
            'user_id' => auth()->id()
        ]);

        return redirect('/pengeluaran')->with('success', 'Pengeluaran berhasil ditambahkan');
    }

    // =========================
    // 📌 FORM EDIT
    // =========================
    public function edit($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        return view('pengeluaran.edit', compact('pengeluaran'));
    }

    // =========================
    // 📌 UPDATE
    // =========================
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required',
            'keterangan' => 'required',
            'jumlah' => 'required|numeric|min:1'
        ]);

        $pengeluaran = Pengeluaran::findOrFail($id);

        $pengeluaran->update($request->all());

        return redirect('/pengeluaran')->with('success', 'Pengeluaran berhasil diupdate');
    }

    // =========================
    // 📌 HAPUS
    // =========================
    public function destroy($id)
    {
        Pengeluaran::destroy($id);
        return redirect('/pengeluaran')->with('success', 'Pengeluaran berhasil dihapus');
    }
}