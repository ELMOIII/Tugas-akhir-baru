@extends('layout.app')

@section('content')
<div class="page-header">
    <div>
        <p class="page-kicker">Laporan</p>
        <h1 class="page-title">Laporan Transaksi</h1>
        <p class="page-subtitle">Pantau transaksi, total penjualan, dan keuntungan sesuai rentang tanggal.</p>
    </div>
</div>

<div class="metric-grid">
    <div class="metric-card">
        <p class="metric-label">Total Pendapatan</p>
        <p class="metric-value">Rp {{ number_format($total) }}</p>
    </div>
    <div class="metric-card">
        <p class="metric-label">Total Keuntungan</p>
        <p class="metric-value positive">Rp {{ number_format($totalKeuntungan) }}</p>
    </div>
    <div class="metric-card">
        <p class="metric-label">Jumlah Transaksi</p>
        <p class="metric-value">{{ $transaksis->count() }}</p>
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
        <a href="/laporan" class="btn btn-soft">Reset</a>
    </form>

    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksis as $trx)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($trx->tanggal)->format('d-m-Y H:i') }}</td>
                        <td class="money">Rp {{ number_format($trx->total) }}</td>
                        <td>{{ ucfirst($trx->metode_pembayaran) }}</td>
                        <td>
                            <a href="/transaksi/{{ $trx->id }}" class="btn btn-secondary">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center;">Tidak ada transaksi pada rentang ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
