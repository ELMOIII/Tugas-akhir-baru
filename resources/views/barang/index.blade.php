@extends('layout.app')

@section('content')
<div class="page-header">
    <div>
        <p class="page-kicker">Inventori</p>
        <h1 class="page-title">Data Barang</h1>
        <p class="page-subtitle">Kelola menu, umpan, harga jual, harga beli, dan batas minimum stok dalam satu tampilan.</p>
    </div>
    <a href="/barang/create" class="btn btn-primary">Tambah Barang</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="content-card">
    <form method="GET" action="/barang" class="filter-bar">
        <div class="field" style="min-width: 240px;">
            <label for="kategori_id">Kategori</label>
            <select id="kategori_id" name="kategori_id" class="form-select">
                <option value="">Semua Kategori</option>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Filter</button>
        <a href="/barang" class="btn btn-soft">Reset</a>
    </form>

    <div class="table-wrap">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th>Stok Minimum</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($barangs as $barang)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $barang->nama_barang }}</strong></td>
                        <td>{{ $barang->kategori->nama_kategori ?? '-' }}</td>
                        <td>Rp {{ number_format($barang->harga_beli) }}</td>
                        <td class="money">Rp {{ number_format($barang->harga_jual) }}</td>
                        <td>{{ $barang->stok }}</td>
                        <td>{{ $barang->stok_minimum }}</td>
                        <td>
                            <div class="table-actions">
                                <a href="/barang/{{ $barang->id }}/edit" class="btn btn-secondary">Edit</a>
                                <form action="/barang/{{ $barang->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin mau hapus barang ini?')" class="btn btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center;">Data barang belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($warning->count())
    @push('scripts')
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Stok menipis',
                html: @json($warning->map(fn ($item) => $item->nama_barang.' ('.$item->stok.')')->implode('<br>')),
                confirmButtonColor: '#ec7fad'
            });
        </script>
    @endpush
@endif
@endsection
