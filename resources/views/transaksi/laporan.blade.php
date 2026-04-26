@extends('layout.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">Laporan Transaksi</h2>

<form method="GET" class="flex gap-2 mb-4">

    <input type="date" name="tanggal_awal"
        value="{{ request('tanggal_awal') }}"
        class="border p-2 rounded">

    <input type="date" name="tanggal_akhir"
        value="{{ request('tanggal_akhir') }}"
        class="border p-2 rounded">

    <button class="bg-blue-600 text-white px-4 py-2 rounded">
        Filter
    </button>

    <a href="/laporan"
       class="bg-gray-500 text-white px-4 py-2 rounded">
       Reset
    </a>

</form>

<table class="w-full border">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2">No</th>
            <th class="p-2">Tanggal</th>
            <th class="p-2">Total</th>
            <th class="p-2">Pembayaran</th>
            <th class="p-2">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($transaksis as $trx)
        <tr class="text-center border-t">
            <td class="p-2">{{ $loop->iteration }}</td>

            <td class="p-2">
                {{ \Carbon\Carbon::parse($trx->tanggal)->format('d-m-Y H:i') }}
            </td>

            <td class="p-2">
                Rp {{ number_format($trx->total) }}
            </td>

            <td class="p-2">
                {{ ucfirst($trx->metode_pembayaran) }}
            </td>

            <td class="p-2">
                <a href="/transaksi/{{ $trx->id }}"
                   class="bg-green-600 text-white px-3 py-1 rounded">
                   Detail
                </a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center p-3">
                Tidak ada data
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4 text-right font-bold text-lg">
    Total Pendapatan: Rp {{ number_format($total) }}
    <div class="mt-2 text-right font-bold text-green-600 text-lg">
    Total Keuntungan: Rp {{ number_format($totalKeuntungan) }}
</div>

@endsection