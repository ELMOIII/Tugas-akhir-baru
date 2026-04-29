@extends('layout.app')

@section('content')
<div class="page-header">
    <div>
        <p class="page-kicker">Keuangan</p>
        <h1 class="page-title">Data Pengeluaran</h1>
        <p class="page-subtitle">Catat biaya operasional agar laporan laba bersih tetap terukur.</p>
    </div>
    <a href="/pengeluaran/create" class="btn btn-primary">Tambah Pengeluaran</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="content-card">
    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengeluarans as $p)
                    <tr>
                        <td>{{ $p->tanggal ?? '-' }}</td>
                        <td><strong>{{ $p->keterangan }}</strong></td>
                        <td class="money">Rp {{ number_format($p->jumlah) }}</td>
                        <td>
                            <div class="table-actions">
                                <a href="/pengeluaran/{{ $p->id }}/edit" class="btn btn-secondary">Edit</a>
                                <form action="/pengeluaran/{{ $p->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" onclick="return confirm('Hapus pengeluaran ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center;">Belum ada data pengeluaran.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
