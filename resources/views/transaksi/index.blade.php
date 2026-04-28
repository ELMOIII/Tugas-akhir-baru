@extends('layout.app')

@section('content')
<div class="page-header">
    <div>
        <p class="page-kicker">Kasir</p>
        <h1 class="page-title">Transaksi Baru</h1>
        <p class="page-subtitle">Cari barang, atur jumlah, dan hitung pembayaran.</p>
    </div>
</div>

@if(session('error'))
    <div class="alert alert-error" style="background: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
        {{ session('error') }}
    </div>
@endif

<form action="/transaksi" method="POST" class="content-card" id="form-transaksi">
    @csrf

    <div class="table-wrap">
        <table class="data-table" id="table-transaksi">
            <thead>
                <tr>
                    <th style="width: 34%;">Barang</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="row-item">
                    <td>
                        <select name="barang_id[]" class="barang select2 form-select">
                            <option value="">Pilih Barang</option>
                            @foreach ($barangs as $barang)
                                <option value="{{ $barang->id }}" data-harga="{{ $barang->harga_jual }}">
                                    {{ $barang->nama_barang }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td class="harga money" data-value="0">0</td>
                    <td>
                        <input type="number" name="jumlah[]" class="jumlah form-input" value="1" min="1">
                    </td>
                    <td class="subtotal money" data-value="0">0</td>
                    <td>
                        <button type="button" class="hapus btn btn-danger">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="toolbar" style="margin-top: 16px;">
        <button type="button" id="tambah" class="btn btn-secondary">+ Tambah Baris</button>
    </div>

    <div class="content-card mb-4" style="margin-top: 1rem; border: 1px solid #e5e7eb; padding: 15px; background: #f9fafb;">
        <h4 style="margin-bottom: 15px;">🏆 Input Tiket Sesi (Opsional)</h4>
        <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 15px;">
            <div class="field">
                <label>Sesi</label>
                <input type="text" name="sesi" id="sesi" class="form-input" placeholder="Contoh: Sesi Pagi">
            </div>
            <div class="field">
                <label>Harga Tiket (Rp)</label>
                <input type="number" name="harga_tiket" id="harga_tiket" class="form-input" value="0">
            </div>
            <div class="field">
                <label>Jumlah Peserta</label>
                <input type="number" name="jumlah_peserta" id="jumlah_peserta" class="form-input" value="0">
            </div>
        </div>
    </div>

    <div class="metric-grid">
        <div class="metric-card">
            <p class="metric-label">Total Harus Dibayar</p>
            <p class="metric-value">Rp <span id="total" data-value="0">0</span></p>
        </div>
        <div class="metric-card">
            <label class="metric-label" style="display:block; margin-bottom: 5px;">Uang Bayar (Cash)</label>
            <input type="number" name="bayar" id="bayar" class="form-input" style="font-size: 1.25rem; font-weight: bold;" value="0">
        </div>
        <div class="metric-card">
            <p class="metric-label">Kembalian</p>
            <p class="metric-value">Rp <span id="kembalian">0</span></p>
        </div>
    </div>

    <div class="form-card" style="max-width: none; box-shadow: none; background: rgba(255,255,255,0.64); margin-top: 1rem;">
        <div class="field">
            <label for="metode">Metode Pembayaran</label>
            <select name="metode_pembayaran" id="metode" class="form-select">
                <optgroup label="Manual">
                    <option value="cash">Cash (Tunai)</option>
                    <option value="transfer">Transfer Manual</option>
                </optgroup>
                <optgroup label="Otomatis">
                    <option value="Midtrans">Midtrans (QRIS/VA/E-Wallet)</option>
                </optgroup>
            </select>
        </div>
    </div>

    <div class="toolbar" style="margin-top: 18px;">
        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px;">Simpan Transaksi</button>
    </div>
</form>

@push('scripts')
<script>
$(document).ready(function () {
    function formatNumber(val) { return new Intl.NumberFormat('id-ID').format(val || 0); }
    function parseNumber(val) { return parseInt(val) || 0; }

    function hitungTotal() {
        let total = 0;

        // 1. Hitung Barang
        $('.row-item').each(function () {
            const harga = parseNumber($(this).find('.harga').data('value'));
            const jumlah = parseNumber($(this).find('.jumlah').val());
            const subtotal = harga * jumlah;
            $(this).find('.subtotal').data('value', subtotal).text(formatNumber(subtotal));
            total += subtotal;
        });

        // 2. Hitung Tiket
        total += (parseNumber($('#harga_tiket').val()) * parseNumber($('#jumlah_peserta').val()));

        // 3. Update UI
        $('#total').data('value', total).text(formatNumber(total));

        // 4. Handle Midtrans Auto-Fill
        if ($('#metode').val() === 'Midtrans') {
            $('#bayar').val(total).prop('readonly', true);
        } else {
            $('#bayar').prop('readonly', false);
        }
        hitungKembalian();
    }

    function hitungKembalian() {
        const bayar = parseNumber($('#bayar').val());
        const total = parseNumber($('#total').data('value'));
        const sisa = bayar - total;
        $('#kembalian').text(formatNumber(sisa > 0 ? sisa : 0));
    }

    // Event Listeners
    $(document).on('change', '.barang', function() {
        const harga = $(this).find(':selected').data('harga') || 0;
        $(this).closest('tr').find('.harga').data('value', harga).text(formatNumber(harga));
        hitungTotal();
    });

    $(document).on('input', '.jumlah, #harga_tiket, #jumlah_peserta, #bayar', hitungTotal);
    $('#metode').on('change', hitungTotal);

    // Tambah Baris
    $('#tambah').click(function() {
        const newRow = $('.row-item').first().clone();
        newRow.find('input').val(1);
        newRow.find('.harga, .subtotal').data('value', 0).text('0');
        newRow.find('select').val('');
        $('#table-transaksi tbody').append(newRow);
    });

    $(document).on('click', '.hapus', function() {
        if ($('.row-item').length > 1) $(this).closest('tr').remove();
        hitungTotal();
    });

    // Submit Logic
    $('#form-transaksi').on('submit', function(e) {
        if ($('#metode').val() === 'Midtrans') {
            e.preventDefault();
            const btn = $(this).find('button[type="submit"]');
            btn.prop('disabled', true).text('Menghubungkan Midtrans...');

            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: $(this).serialize(),
                success: function(res) {
                    if (res.snap_token) {
                        window.snap.pay(res.snap_token, {
                            onSuccess: (result) => window.location.href = '/transaksi/' + res.transaksi_id,
                            onPending: (result) => window.location.href = '/transaksi/' + res.transaksi_id,
                            onError: () => { alert("Gagal!"); btn.prop('disabled', false).text('Simpan Transaksi'); }
                        });
                    }
                },
                error: (xhr) => { alert("Error: " + xhr.responseText); btn.prop('disabled', false).text('Simpan Transaksi'); }
            });
        }
    });
});
</script>
@endpush
@endsection