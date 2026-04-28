@extends('layout.app')

@section('content')
<div class="page-header">
    <div>
        <p class="page-kicker">Pemasukan</p>
        <h1 class="page-title">Pemasukan Lomba</h1>
        <p class="page-subtitle">Rekap pendapatan dari sesi lomba berdasarkan jumlah peserta dan harga tiket.</p>
    </div>
    <a href="/pemasukan/create" class="btn btn-primary">Tambah Pemasukan</a>
</div>

<div class="page-header">
    </div>

    

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="metric-grid" style="margin-bottom: 2rem;">
    <div class="metric-card">
        <p class="metric-label">Total Pendapatan</p>
        <p class="metric-value">Rp {{ number_format($totalPendapatan) }}</p>
    </div>
    <div class="metric-card">
        <p class="metric-label">Total Keuntungan Bersih (20%)</p>
        <p class="metric-value positive">Rp {{ number_format($totalLaba) }}</p>
    </div>
    
    <div class="metric-card">
        <p class="metric-label">Total Pemancing</p>
        <p class="metric-value">{{ number_format($totalPeserta) }} Orang</p>
    </div>
</div>

<div class="content-card">
    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
            <th>Tanggal</th>
            <th>Sesi</th>
            <th>Peserta</th>
            <th>Harga Tiket</th>
            <th>Total</th>
            <th>Laba/Tiket (20%)</th>
            <th>Total Laba</th>
            <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                <td>{{ $d->tanggal }}</td>
                <td><strong>{{ $d->nama_lomba }}</strong></td>
                <td>{{ $d->jumlah_peserta }}</td>
                <td>Rp {{ number_format($d->harga_tiket) }}</td>
                <td>Rp {{ number_format($d->total) }}</td>
                
                <td>Rp {{ number_format($d->laba_per_tiket) }}</td>
                <td class="positive" style="font-weight: bold;">
                    Rp {{ number_format($d->total_laba) }}
                </td>
                        <td>
                            <form action="/pemasukan/{{ $d->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Hapus data ini?')" class="btn btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center;">Belum ada data pemasukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
