<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Struk Transaksi</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            font-family: "Figtree", ui-sans-serif, system-ui, sans-serif;
            color: #263247;
            background:
                radial-gradient(circle at top left, rgba(255, 199, 222, 0.55), transparent 28rem),
                radial-gradient(circle at bottom right, rgba(185, 220, 255, 0.62), transparent 28rem),
                linear-gradient(135deg, #fff8fb, #f2f9ff);
        }

        .receipt {
            width: min(380px, calc(100vw - 28px));
            padding: 24px;
            border: 1px solid rgba(255, 255, 255, 0.82);
            border-radius: 22px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 22px 70px rgba(82, 105, 138, 0.16);
        }

        .brand {
            text-align: center;
            margin-bottom: 18px;
        }

        .brand h1 {
            margin: 0;
            font-size: 24px;
        }

        .brand p,
        .meta p {
            margin: 4px 0;
            color: #6d7688;
            font-size: 13px;
        }

        .line {
            border-top: 1px dashed #cdd8e8;
            margin: 16px 0;
        }

        .row {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            margin: 8px 0;
            font-size: 14px;
        }

        .item-name {
            margin: 12px 0 4px;
            font-weight: 800;
        }

        .total {
            font-size: 18px;
            font-weight: 800;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 18px;
        }

        .btn {
            flex: 1;
            min-height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 14px;
            font-weight: 800;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-primary {
            color: white;
            background: linear-gradient(135deg, #ec7fad, #6aa9df);
        }

        .btn-soft {
            color: #45607e;
            background: #eef7ff;
        }

        @media print {
            body {
                display: block;
                background: white;
            }

            .receipt {
                width: 300px;
                padding: 0;
                margin: auto;
                border: 0;
                border-radius: 0;
                box-shadow: none;
            }

            .actions {
                display: none;
            }
        }
    </style>
</head>
<body>
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        timer: 1800,
        showConfirmButton: false
    });
</script>
@endif

<main class="receipt">
    <div class="brand">
        <h1>Galatama TMB</h1>
        <p>Struk transaksi penjualan</p>
    </div>

    <div class="meta">
        <p>Tanggal: {{ \Carbon\Carbon::parse($transaksi->created_at)->format('d-m-Y') }}</p>
        <p>Jam: {{ \Carbon\Carbon::parse($transaksi->created_at)->format('H:i:s') }}</p>
        <p>Kasir: {{ $transaksi->user->name ?? '-' }}</p>
        <p>No Transaksi: #{{ $transaksi->id }}</p>
    </div>

    <div class="line"></div>

    @foreach($transaksi->details as $d)
        <div>
            <div class="item-name">{{ $d->barang->nama_barang }}</div>
            <div class="row">
                <span>{{ $d->jumlah }} x Rp {{ number_format($d->barang->harga_jual) }}</span>
                <span>Rp {{ number_format($d->subtotal) }}</span>
            </div>
        </div>
    @endforeach

    <div class="line"></div>

    <div class="row total">
        <span>Total</span>
        <span>Rp {{ number_format($transaksi->total) }}</span>
    </div>
    <div class="row">
        <span>Bayar</span>
        <span>Rp {{ number_format($transaksi->bayar) }}</span>
    </div>
    <div class="row">
        <span>Kembalian</span>
        <span>Rp {{ number_format($transaksi->kembalian) }}</span>
    </div>
    <div class="row">
        <span>Pembayaran</span>
        <span>{{ ucfirst($transaksi->metode_pembayaran) }}</span>
    </div>

    <div class="line"></div>

    <p style="text-align:center; color:#6d7688;">Terima kasih</p>

    <div class="actions">
        <button onclick="window.print()" class="btn btn-primary">Print</button>
        <a href="/transaksi" class="btn btn-soft">Kembali</a>
    </div>
</main>
</body>
</html>
