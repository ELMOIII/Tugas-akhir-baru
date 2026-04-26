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

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

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
                        <td class="positive">Rp {{ number_format($d->total) }}</td>
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
