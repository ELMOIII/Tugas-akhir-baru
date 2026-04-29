@extends('layout.app')

@section('content')
<div class="page-header">
    <div>
        <p class="page-kicker">Keuangan</p>
        <h1 class="page-title">Edit Pengeluaran</h1>
        <p class="page-subtitle">Perbarui catatan biaya operasional agar laporan tetap sinkron.</p>
    </div>
    <a href="/pengeluaran" class="btn btn-soft">Kembali</a>
</div>

@if ($errors->any())
    <div class="alert alert-error">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<form method="POST" action="/pengeluaran/{{ $pengeluaran->id }}" class="form-card">
    @csrf
    @method('PUT')

    <div class="field-grid">
        <div class="field">
            <label for="tanggal">Tanggal</label>
            <input id="tanggal" type="date" name="tanggal" value="{{ old('tanggal', $pengeluaran->tanggal) }}" class="form-input">
        </div>

        <div class="field field-full">
            <label for="keterangan">Keterangan</label>
            <input id="keterangan" type="text" name="keterangan" value="{{ old('keterangan', $pengeluaran->keterangan) }}" class="form-input">
        </div>

        <div class="field">
            <label for="jumlah">Jumlah</label>
            <input id="jumlah" type="number" name="jumlah" value="{{ old('jumlah', $pengeluaran->jumlah) }}" class="form-input" min="1">
        </div>
    </div>

    <div class="toolbar" style="margin-top: 22px; margin-bottom: 0;">
        <button class="btn btn-primary">Update Pengeluaran</button>
        <a href="/pengeluaran" class="btn btn-soft">Batal</a>
    </div>
</form>
@endsection
