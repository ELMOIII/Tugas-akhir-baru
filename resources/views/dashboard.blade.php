<x-app-layout>
    <x-slot name="header">
        <h2>Dashboard</h2>
    </x-slot>

    <div style="display:grid; gap:18px;">
        <div style="padding:24px; border:1px solid rgba(255,255,255,.72); border-radius:20px; background:rgba(255,255,255,.86); box-shadow:0 22px 70px rgba(82,105,138,.16);">
            <p style="margin:0 0 6px; color:#ec7fad; font-size:12px; font-weight:800; letter-spacing:.08em; text-transform:uppercase;">Ringkasan</p>
            <h1 style="margin:0; color:#263247; font-size:32px; font-weight:800;">Selamat datang di Galatama TMB</h1>
            <p style="margin:8px 0 0; color:#6d7688; max-width:680px;">
                Gunakan menu di bawah untuk masuk ke data barang, transaksi kasir, laporan, dan pengeluaran.
            </p>
        </div>

        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:16px;">
            <a href="/barang" style="padding:20px; border-radius:18px; background:rgba(255,255,255,.84); border:1px solid rgba(255,255,255,.74); box-shadow:0 16px 44px rgba(82,105,138,.12);">
                <p style="margin:0 0 8px; color:#6d7688; font-size:12px; font-weight:800; text-transform:uppercase;">Inventori</p>
                <strong style="color:#263247; font-size:20px;">Data Barang</strong>
            </a>

            <a href="/transaksi" style="padding:20px; border-radius:18px; background:rgba(255,255,255,.84); border:1px solid rgba(255,255,255,.74); box-shadow:0 16px 44px rgba(82,105,138,.12);">
                <p style="margin:0 0 8px; color:#6d7688; font-size:12px; font-weight:800; text-transform:uppercase;">Kasir</p>
                <strong style="color:#263247; font-size:20px;">Transaksi</strong>
            </a>

            <a href="/laporan" style="padding:20px; border-radius:18px; background:rgba(255,255,255,.84); border:1px solid rgba(255,255,255,.74); box-shadow:0 16px 44px rgba(82,105,138,.12);">
                <p style="margin:0 0 8px; color:#6d7688; font-size:12px; font-weight:800; text-transform:uppercase;">Laporan</p>
                <strong style="color:#263247; font-size:20px;">Penjualan</strong>
            </a>

            <a href="/pengeluaran" style="padding:20px; border-radius:18px; background:rgba(255,255,255,.84); border:1px solid rgba(255,255,255,.74); box-shadow:0 16px 44px rgba(82,105,138,.12);">
                <p style="margin:0 0 8px; color:#6d7688; font-size:12px; font-weight:800; text-transform:uppercase;">Keuangan</p>
                <strong style="color:#263247; font-size:20px;">Pengeluaran</strong>
            </a>
        </div>
    </div>
</x-app-layout>
