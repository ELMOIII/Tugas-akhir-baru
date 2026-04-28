@extends('layout.app')

@section('content')
<div class="page-header">
    <div>
        <p class="page-kicker">Laporan</p>
        <h1 class="page-title">Laporan Laba Rugi</h1>
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

    <div class="metric-grid" style="margin-bottom: 1.5rem;">
        <div class="metric-card">
            <p class="metric-label">Keuntungan Jual Barang</p>
            <p class="metric-value">Rp {{ number_format($labaBarang) }}</p>
        </div>
        
        <div class="metric-card">
            <p class="metric-label">Keuntungan Lomba (20%)</p>
            <p class="metric-value">Rp {{ number_format($labaLomba) }}</p>
        </div>

        <div class="metric-card">
            <p class="metric-label">Total Pemasukan Kotor</p>
            <p class="metric-value positive">Rp {{ number_format($totalPendapatan) }}</p>
        </div>
    </div>

    <div class="metric-grid" style="margin-bottom: 0; grid-template-columns: 1fr 1fr;">
        <div class="metric-card" style="border-top: 4px solid #ef4444;"> 
            <p class="metric-label">Total Pengeluaran</p>
            <p class="metric-value" style="color: #ef4444;">
                - Rp {{ number_format($pengeluaran) }}
            </p>
        </div>

        <div class="metric-card" style="border-top: 4px solid #10b981;"> 
            <p class="metric-label">LABA BERSIH AKHIR (Sisa Keuntungan)</p>
            <p class="metric-value {{ $labaBersihAkhir >= 0 ? 'positive' : 'negative' }}" style="font-size: 1.5rem; font-weight: bold;">
                Rp {{ number_format($labaBersihAkhir) }}
            </p>
        </div>
    </div>
</div>
@endsection
