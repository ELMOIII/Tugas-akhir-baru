@extends('layout.app')

@section('content')
<div class="page-header">
    <div>
        <p class="page-kicker">Laporan</p>
        <h1 class="page-title">Laporan Laba Rugi</h1>
        <p class="page-subtitle">Ringkasan pendapatan dan pengeluaran dalam model pastel yang sama dengan halaman laporan lain.</p>
    </div>
</div>

<div class="content-card">
    <form method="GET" class="filter-bar">
        <div class="field">
            <label for="tanggal_awal">Tanggal Awal</label>
            <input id="tanggal_awal" type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}" class="form-input">
        </div>

        <div class="field">
            <label for="tanggal_akhir">Tanggal Akhir</label>
            <input id="tanggal_akhir" type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}" class="form-input">
        </div>

        <button class="btn btn-primary">Filter</button>
    </form>

    <div class="metric-grid" style="margin-bottom: 0;">
        <div class="metric-card">
            <p class="metric-label">Total Pendapatan</p>
            <p class="metric-value">Rp {{ number_format($totalPendapatan ?? 0) }}</p>
        </div>

        <div class="metric-card">
            <p class="metric-label">Total Pengeluaran</p>
            <p class="metric-value">Rp {{ number_format($totalPengeluaran ?? 0) }}</p>
        </div>

        <div class="metric-card">
            <p class="metric-label">Laba / Rugi</p>
            <p class="metric-value {{ ($laba ?? 0) >= 0 ? 'positive' : 'negative' }}">
                Rp {{ number_format($laba ?? 0) }}
            </p>
        </div>
    </div>
</div>
@endsection
