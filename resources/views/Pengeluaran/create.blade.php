@extends('layout.app')

@section('content')
<div class="page-header">
    <div>
        <p class="page-kicker">Keuangan</p>
        <h1 class="page-title">Tambah Pengeluaran</h1>
        <p class="page-subtitle">Simpan biaya harian dengan kategori yang konsisten untuk memudahkan rekap.</p>
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

<form method="POST" action="/pengeluaran" class="form-card">
    @csrf

    <div class="field-grid">
        <div class="field">
            <label for="tanggal">Tanggal</label>
            <input id="tanggal" type="date" name="tanggal" value="{{ old('tanggal') }}" class="form-input">
        </div>

        <div class="field field-full">
            <label for="keterangan">Keterangan</label>
            <input id="keterangan" type="text" name="keterangan" value="{{ old('keterangan') }}" class="form-input">
        </div>

        <div class="field">
            <label for="jumlah">Jumlah</label>
            <input id="jumlah" type="number" name="jumlah" value="{{ old('jumlah') }}" class="form-input" min="1">
        </div>
    </div>

    <div class="toolbar" style="margin-top: 22px; margin-bottom: 0;">
        <button class="btn btn-primary">Simpan Pengeluaran</button>
        <a href="/pengeluaran" class="btn btn-soft">Batal</a>
    </div>
</form>
@endsection
