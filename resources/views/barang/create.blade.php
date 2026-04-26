@extends('layout.app')

@section('content')
<div class="page-header">
    <div>
        <p class="page-kicker">Inventori</p>
        <h1 class="page-title">Tambah Barang</h1>
        <p class="page-subtitle">Masukkan informasi barang dengan harga dan batas stok yang jelas agar laporan tetap akurat.</p>
    </div>
    <a href="/barang" class="btn btn-soft">Kembali</a>
</div>

@if ($errors->any())
    <div class="alert alert-error">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<form action="/barang" method="POST" class="form-card">
    @csrf

    <div class="field-grid">
        <div class="field field-full">
            <label for="nama_barang">Nama Barang</label>
            <input id="nama_barang" type="text" name="nama_barang" value="{{ old('nama_barang') }}" class="form-input">
        </div>

        <div class="field field-full">
            <label for="kategori_id">Kategori</label>
            <select id="kategori_id" name="kategori_id" class="form-select">
                <option value="">Pilih Kategori</option>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="field">
            <label for="harga_beli">Harga Beli</label>
            <input id="harga_beli" type="number" name="harga_beli" value="{{ old('harga_beli') }}" class="form-input">
        </div>

        <div class="field">
            <label for="harga_jual">Harga Jual</label>
            <input id="harga_jual" type="number" name="harga_jual" value="{{ old('harga_jual') }}" class="form-input">
        </div>

        <div class="field">
            <label for="stok">Stok</label>
            <input id="stok" type="number" name="stok" value="{{ old('stok') }}" class="form-input">
        </div>

        <div class="field">
            <label for="stok_minimum">Stok Minimum</label>
            <input id="stok_minimum" type="number" name="stok_minimum" value="{{ old('stok_minimum') }}" class="form-input">
        </div>
    </div>

    <div class="toolbar" style="margin-top: 22px; margin-bottom: 0;">
        <button class="btn btn-primary">Simpan Barang</button>
        <a href="/barang" class="btn btn-soft">Batal</a>
    </div>
</form>
@endsection
