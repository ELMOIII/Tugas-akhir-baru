@extends('layout.app')

@section('content')
<div class="page-header">
    <div>
        <p class="page-kicker">Kasir</p>
        <h1 class="page-title">Transaksi Baru</h1>
        <p class="page-subtitle">Cari barang, atur jumlah, dan hitung pembayaran dalam tampilan kasir yang lebih bersih.</p>
    </div>
</div>

@if(session('error'))
    <div class="alert alert-error">{{ session('error') }}</div>
@endif

<form action="/transaksi" method="POST" class="content-card">
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
                    <td class="harga money">0</td>
                    <td>
                        <input type="number" name="jumlah[]" class="jumlah form-input" value="1" min="1">
                    </td>
                    <td class="subtotal money">0</td>
                    <td>
                        <button type="button" class="hapus btn btn-danger">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="toolbar" style="margin-top: 16px;">
        <button type="button" id="tambah" class="btn btn-secondary">Tambah Baris</button>
    </div>

    <div class="metric-grid">
        <div class="metric-card">
            <p class="metric-label">Total Belanja</p>
            <p class="metric-value">Rp <span id="total">0</span></p>
        </div>
        <div class="metric-card">
            <p class="metric-label">Uang Bayar</p>
            <p class="metric-value">Rp <span id="preview-bayar">0</span></p>
        </div>
        <div class="metric-card">
            <p class="metric-label">Kembalian</p>
            <p class="metric-value">Rp <span id="kembalian">0</span></p>
        </div>
    </div>

    <div class="form-card" style="max-width: none; box-shadow: none; background: rgba(255,255,255,0.64);">
        <div class="field-grid">
            <div class="field">
                <label for="metode">Metode Pembayaran</label>
                <select name="metode_pembayaran" id="metode" class="form-select">
                    <option value="cash">Cash</option>
                    <option value="transfer">Transfer</option>
                    <option value="qris">QRIS</option>
                </select>
            </div>

            <div class="field">
                <label for="bayar">Uang Bayar</label>
                <input type="number" name="bayar" id="bayar" class="form-input" min="1">
            </div>
        </div>
    </div>

    <div class="toolbar" style="margin-top: 18px; margin-bottom: 0;">
        <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
    </div>
</form>

@push('scripts')
<script>
$(document).ready(function () {
    function initSelect2(scope) {
        $(scope).find('.select2').select2({
            placeholder: 'Cari barang...',
            width: '100%'
        });
    }

    function formatNumber(value) {
        return new Intl.NumberFormat('id-ID').format(value || 0);
    }

    function parseNumber(value) {
        return parseInt(value, 10) || 0;
    }

    function hitungTotal() {
        let total = 0;

        $('.row-item').each(function () {
            const harga = parseNumber($(this).find('.harga').data('value'));
            const jumlah = parseNumber($(this).find('.jumlah').val());
            const subtotal = harga * jumlah;

            $(this).find('.subtotal').data('value', subtotal).text(formatNumber(subtotal));
            total += subtotal;
        });

        $('#total').data('value', total).text(formatNumber(total));

        if ($('#metode').val() === 'qris') {
            $('#bayar').val(total);
        }

        hitungKembalian();
    }

    function hitungKembalian() {
        const bayar = parseNumber($('#bayar').val());
        const total = parseNumber($('#total').data('value'));
        const kembalian = bayar - total;

        $('#preview-bayar').text(formatNumber(bayar));
        $('#kembalian').text(formatNumber(kembalian > 0 ? kembalian : 0));
    }

    initSelect2(document);

    $(document).on('change', '.barang', function () {
        const harga = parseNumber($(this).find(':selected').data('harga'));
        const row = $(this).closest('tr');
        const selectedId = $(this).val();

        row.find('.harga').data('value', harga).text(formatNumber(harga));

        $('.barang').not(this).each(function () {
            if ($(this).val() === selectedId && selectedId !== '') {
                const existingRow = $(this).closest('tr');
                const existingQty = parseNumber(existingRow.find('.jumlah').val());
                const newQty = parseNumber(row.find('.jumlah').val()) || 1;

                existingRow.find('.jumlah').val(existingQty + newQty).trigger('input');
                row.remove();

                Swal.fire({
                    icon: 'info',
                    title: 'Barang sudah ada',
                    text: 'Jumlah barang ditambahkan ke baris sebelumnya.',
                    confirmButtonColor: '#6aa9df'
                });

                return false;
            }
        });

        hitungTotal();
    });

    $(document).on('input', '.jumlah', hitungTotal);
    $('#bayar').on('input', hitungKembalian);

    $('#metode').on('change', function () {
        const total = parseNumber($('#total').data('value'));

        if ($(this).val() === 'qris') {
            $('#bayar').val(total).prop('readonly', true);
        } else {
            $('#bayar').val('').prop('readonly', false);
        }

        hitungKembalian();
    });

    $('#tambah').click(function () {
        const row = $('.row-item:first').clone();

        row.find('.select2-container').remove();
        row.find('select')
            .removeClass('select2-hidden-accessible')
            .removeAttr('data-select2-id aria-hidden tabindex')
            .val('');
        row.find('option').removeAttr('data-select2-id');
        row.find('input').val(1);
        row.find('.harga, .subtotal').data('value', 0).text('0');

        $('#table-transaksi tbody').append(row);
        initSelect2(row);
    });

    $(document).on('click', '.hapus', function () {
        if ($('#table-transaksi tbody tr').length > 1) {
            $(this).closest('tr').remove();
            hitungTotal();
        }
    });
});
</script>
@endpush
@endsection
