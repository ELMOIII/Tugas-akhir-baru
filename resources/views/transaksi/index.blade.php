@extends('layout.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
.select2-container {
    width: 100% !important;
}
.select2-selection {
    height: 42px !important;
}
</style>

<h2 class="text-2xl font-bold mb-4">Transaksi</h2>

<form action="/transaksi" method="POST">
@csrf

<table class="w-full border table-fixed" id="table-transaksi">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2 w-[300px]">Barang</th>
            <th class="p-2 w-[150px] text-center">Harga</th>
            <th class="p-2 w-[150px] text-center">Jumlah</th>
            <th class="p-2 w-[150px] text-center">Subtotal</th>
            <th class="p-2 w-[100px] text-center">Aksi</th>
        </tr>
    </thead>

    <tbody>
    <tr class="row-item">
        <td class="p-2">
            <select name="barang_id[]" class="barang select2 w-full">
                <option value="">Pilih Barang</option>
                @foreach ($barangs as $barang)
                    <option value="{{ $barang->id }}" data-harga="{{ $barang->harga_jual }}">
                        {{ $barang->nama_barang }}
                    </option>
                @endforeach
            </select>
        </td>

        <td class="p-2 text-center harga">0</td>

        <td class="p-2">
            <input type="number" name="jumlah[]" class="jumlah border p-2 w-full" value="1">
        </td>

        <td class="p-2 text-center subtotal">0</td>

        <td class="p-2 text-center">
            <button type="button" class="hapus bg-red-500 text-white px-2 rounded">X</button>
        </td>
    </tr>
    </tbody>
</table>

<button type="button" id="tambah"
    class="bg-green-600 text-white px-4 py-2 mt-3 rounded">
    + Tambah Baris
</button>

<h3 class="text-xl font-bold mt-4">
    Total: Rp <span id="total">0</span>
</h3>

<!-- PEMBAYARAN -->
<div class="mt-4 space-y-2">

    <div>
        <label>Metode Pembayaran</label>
        <select name="metode_pembayaran" id="metode" class="border p-2 w-full rounded">
            <option value="cash">Cash</option>
            <option value="transfer">Transfer</option>
            <option value="qris">QRIS</option>
        </select>
    </div>

    <div>
        <label>Uang Bayar</label>
        <input type="number" name="bayar" id="bayar"
               class="border p-2 w-full rounded">
    </div>

    <div class="font-bold">
        Kembalian: Rp <span id="kembalian">0</span>
    </div>

</div>

<button type="submit"
    class="bg-blue-600 text-white px-4 py-2 mt-3 rounded">
    Simpan Transaksi
</button>

</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function () {

    function initSelect2() {
        $('.select2').select2({
            placeholder: "Cari barang...",
            width: '100%'
        });
    }

    initSelect2();

    // =========================
    // 🔥 HITUNG TOTAL REALTIME
    // =========================
    function hitungTotal() {
        let total = 0;

        $(".row-item").each(function () {
            let harga = parseInt($(this).find('.harga').text()) || 0;
            let jumlah = parseInt($(this).find('.jumlah').val()) || 0;

            let subtotal = harga * jumlah;

            $(this).find('.subtotal').text(subtotal);

            total += subtotal;
        });

        $("#total").text(total);

        // 🔥 AUTO QRIS
        if ($("#metode").val() === 'qris') {
            $("#bayar").val(total);
            $("#kembalian").text(0);
        }
    }

    // =========================
    // 🔥 PILIH BARANG
    // =========================
    $(document).on('change', '.barang', function () {

        let harga = $(this).find(':selected').data('harga') || 0;
        let row = $(this).closest('tr');

        row.find('.harga').text(harga);

        hitungTotal();

        // 🔥 CEK DUPLIKAT
        let selectedId = $(this).val();
        let currentRow = row;

        $(".barang").not(this).each(function () {

            if ($(this).val() == selectedId && selectedId != '') {

                let existingRow = $(this).closest('tr');

                let existingQty = parseInt(existingRow.find('.jumlah').val()) || 0;
                let newQty = parseInt(currentRow.find('.jumlah').val()) || 1;

                existingRow.find('.jumlah').val(existingQty + newQty).trigger('input');

                currentRow.remove();

                alert('Barang sudah ada, jumlah ditambahkan!');
                return false;
            }
        });

    });

    // =========================
    // 🔥 INPUT JUMLAH
    // =========================
    $(document).on('input', '.jumlah', function () {
        hitungTotal();
    });

    // =========================
    // 🔥 TAMBAH BARIS
    // =========================
    $("#tambah").click(function () {

        let row = $(".row-item:first").clone();

        row.find("select").val('').removeClass('select2-hidden-accessible').next('.select2').remove();
        row.find("input").val(1);
        row.find(".harga, .subtotal").text(0);

        $("#table-transaksi tbody").append(row);

        row.find('.select2').select2({
            placeholder: "Cari barang...",
            width: '100%'
        });

    });

    // =========================
    // 🔥 HAPUS BARIS
    // =========================
    $(document).on('click', '.hapus', function () {
        if ($("#table-transaksi tbody tr").length > 1) {
            $(this).closest('tr').remove();
            hitungTotal();
        }
    });

    // =========================
    // 🔥 QRIS AUTO BAYAR
    // =========================
    $("#metode").on('change', function () {

        let total = parseInt($("#total").text()) || 0;

        if ($(this).val() === 'qris') {
            $("#bayar").val(total).prop('readonly', true);
            $("#kembalian").text(0);
        } else {
            $("#bayar").val('').prop('readonly', false);
        }
    });

    // =========================
    // 🔥 KEMBALIAN
    // =========================
    $("#bayar").on('input', function () {

        let bayar = parseInt($(this).val()) || 0;
        let total = parseInt($("#total").text()) || 0;

        let kembalian = bayar - total;

        $("#kembalian").text(kembalian > 0 ? kembalian : 0);
    });

});
</script>

@endsection