@extends('layout.app')

@section('content')
<div class="page-header">
    <div>
        <p class="page-kicker">Laporan</p>
        <h1 class="page-title">Laporan Laba Bersih</h1>
        <p class="page-subtitle">Bandingkan keuntungan penjualan dengan pengeluaran pada periode yang dipilih.</p>
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
        <a href="/laporan/laba-bersih" class="btn btn-soft">Reset</a>
    </form>

    <div class="metric-grid" style="margin-bottom: 0;">
        <div class="metric-card">
            <p class="metric-label">Total Pendapatan</p>
            <p class="metric-value">Rp {{ number_format($pendapatan) }}</p>
        </div>

        <div class="metric-card">
            <p class="metric-label">Total Pengeluaran</p>
            <p class="metric-value">Rp {{ number_format($pengeluaran) }}</p>
        </div>

        <div class="metric-card">
            <p class="metric-label">Laba Bersih</p>
            <p class="metric-value {{ $laba >= 0 ? 'positive' : 'negative' }}">
                Rp {{ number_format($laba) }}
            </p>
        </div>
    </div>
</div>
@endsection
