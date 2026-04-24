@extends('layout.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">Tambah Pemasukan Lomba</h2>

@if($errors->any())
<div class="bg-red-200 p-3 mb-3 rounded">
    <ul>
        @foreach($errors->all() as $error)
            <li>- {{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="/pemasukan" method="POST" class="space-y-4">
@csrf

<div>
    <label class="block mb-1">Tanggal</label>
    <input type="date" name="tanggal"
           class="border p-2 w-full rounded">
</div>

<div>
    <label class="block mb-1">Nama Sesi</label>
    <select name="nama_lomba" class="border p-2 w-full rounded">
        <option value="Sesi Pagi">Sesi Pagi</option>
        <option value="Sesi Malam">Sesi Malam</option>
    </select>
</div>

<div>
    <label class="block mb-1">Jumlah Peserta</label>
    <input type="number" name="jumlah_peserta"
           class="border p-2 w-full rounded"
           id="peserta">
</div>

<div>
    <label class="block mb-1">Harga Tiket</label>
    <input type="number" name="harga_tiket"
           class="border p-2 w-full rounded"
           id="tiket">
</div>

<div class="font-bold text-lg">
    Total: Rp <span id="total">0</span>
</div>

<button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
    Simpan
</button>

<a href="/pemasukan" class="ml-3 text-gray-600">Kembali</a>

</form>

{{-- 🔥 AUTO HITUNG TOTAL --}}
<script>
document.addEventListener('input', function() {
    let peserta = parseInt(document.getElementById('peserta').value) || 0;
    let tiket = parseInt(document.getElementById('tiket').value) || 0;

    document.getElementById('total').innerText = peserta * tiket;
});
</script>

@endsection