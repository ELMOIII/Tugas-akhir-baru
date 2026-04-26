@extends('layout.app')

@section('content')
<div class="page-header">
    <div>
        <p class="page-kicker">Pemasukan</p>
        <h1 class="page-title">Tambah Pemasukan Lomba</h1>
        <p class="page-subtitle">Total pemasukan dihitung otomatis dari jumlah peserta dan harga tiket.</p>
    </div>
    <a href="/pemasukan" class="btn btn-soft">Kembali</a>
</div>

@if($errors->any())
    <div class="alert alert-error">
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<form action="/pemasukan" method="POST" class="form-card">
    @csrf

    <div class="field-grid">
        <div class="field">
            <label for="tanggal">Tanggal</label>
            <input id="tanggal" type="date" name="tanggal" value="{{ old('tanggal') }}" class="form-input">
        </div>

        <div class="field">
            <label for="nama_lomba">Nama Sesi</label>
            <select id="nama_lomba" name="nama_lomba" class="form-select">
                <option value="Sesi Pagi" {{ old('nama_lomba') === 'Sesi Pagi' ? 'selected' : '' }}>Sesi Pagi</option>
                <option value="Sesi Malam" {{ old('nama_lomba') === 'Sesi Malam' ? 'selected' : '' }}>Sesi Malam</option>
            </select>
        </div>

        <div class="field">
            <label for="peserta">Jumlah Peserta</label>
            <input id="peserta" type="number" name="jumlah_peserta" value="{{ old('jumlah_peserta') }}" class="form-input" min="1">
        </div>

        <div class="field">
            <label for="tiket">Harga Tiket</label>
            <input id="tiket" type="number" name="harga_tiket" value="{{ old('harga_tiket') }}" class="form-input" min="0">
        </div>
    </div>

    <div class="metric-card" style="margin-top: 18px;">
        <p class="metric-label">Estimasi Total</p>
        <p class="metric-value">Rp <span id="total">0</span></p>
    </div>

    <div class="toolbar" style="margin-top: 22px; margin-bottom: 0;">
        <button class="btn btn-primary">Simpan Pemasukan</button>
        <a href="/pemasukan" class="btn btn-soft">Batal</a>
    </div>
</form>

@push('scripts')
<script>
    function formatNumber(value) {
        return new Intl.NumberFormat('id-ID').format(value || 0);
    }

    document.addEventListener('input', function () {
        const peserta = parseInt(document.getElementById('peserta').value, 10) || 0;
        const tiket = parseInt(document.getElementById('tiket').value, 10) || 0;

        document.getElementById('total').innerText = formatNumber(peserta * tiket);
    });
</script>
@endpush
@endsection
