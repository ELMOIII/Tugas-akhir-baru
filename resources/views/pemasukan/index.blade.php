@extends('layout.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">Pemasukan Lomba</h2>

{{-- SUCCESS --}}
@if(session('success'))
<div class="bg-green-200 p-3 mb-3 rounded">
    {{ session('success') }}
</div>
@endif

{{-- BUTTON TAMBAH --}}
<a href="/pemasukan/create"
   class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-blue-700">
   + Tambah Pemasukan
</a>

<div class="overflow-x-auto">
<table class="w-full border border-gray-200">

    <thead class="bg-gray-200">
        <tr>
            <th class="p-3">No</th>
            <th class="p-3">Tanggal</th>
            <th class="p-3">Sesi</th>
            <th class="p-3">Peserta</th>
            <th class="p-3">Harga Tiket</th>
            <th class="p-3">Total</th>
            <th class="p-3">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse($data as $d)
        <tr class="border-t text-center hover:bg-gray-100">

            <td class="p-3">{{ $loop->iteration }}</td>
            <td class="p-3">{{ $d->tanggal }}</td>
            <td class="p-3">{{ $d->nama_lomba }}</td>
            <td class="p-3">{{ $d->jumlah_peserta }}</td>
            <td class="p-3">Rp {{ number_format($d->harga_tiket) }}</td>
            <td class="p-3 font-bold text-green-600">
                Rp {{ number_format($d->total) }}
            </td>

            <td class="p-3 flex justify-center gap-2">

                <form action="/pemasukan/{{ $d->id }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button onclick="return confirm('Hapus data ini?')"
                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                        Hapus
                    </button>
                </form>

            </td>

        </tr>

        @empty
        <tr>
            <td colspan="7" class="p-4 text-center">
                Belum ada data
            </td>
        </tr>
        @endforelse
    </tbody>

</table>
</div>

@endsection