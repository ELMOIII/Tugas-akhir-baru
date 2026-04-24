<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Galatama</title>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @vite('resources/css/app.css')

    <!-- 🔥 PINDAHKAN KE SINI -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body class="bg-gray-100">

<div class="flex">

    <!-- 🔵 SIDEBAR -->
    <div class="w-64 bg-blue-700 text-white min-h-screen p-5">
        <h1 class="text-xl font-bold mb-5">Galatama</h1>

        <ul>
            <li class="mb-2">
                <a href="/barang"
                class="block p-2 rounded {{ request()->is('barang*') ? 'bg-blue-600' : 'hover:bg-blue-600' }}">
                    Data Barang
                </a>
            </li>

            <li class="mb-2">
                <a href="/transaksi"
                class="block p-2 rounded {{ request()->is('transaksi*') ? 'bg-blue-600' : 'hover:bg-blue-600' }}">
                    Transaksi
                </a>
            </li>

            <li class="mb-2">
                <a href="/laporan"
                class="block p-2 rounded {{ request()->is('laporan') ? 'bg-blue-600' : 'hover:bg-blue-600' }}">
                    Laporan
                </a>
            </li>

            <!-- 🔥 TAMBAHKAN DI SINI -->
            <li class="mb-2">
                <a href="/laporan/laba-bersih"
                class="block p-2 rounded {{ request()->is('laporan/laba-bersih') ? 'bg-blue-600' : 'hover:bg-blue-600' }}">
                    Laba Bersih
                </a>
            </li>

            <li class="mb-2">
            <a href="/pengeluaran"
            class="block p-2 rounded {{ request()->is('pengeluaran*') ? 'bg-blue-600' : 'hover:bg-blue-600' }}">
                Pengeluaran
            </a>
            </li>
        
            <li>
                <a href="/grafik" class="block p-2 hover:bg-blue-600 rounded">
                    Grafik
                </a>
            </li>

        <li class="mb-2">
            <a href="/pemasukan"
            class="block p-2 rounded hover:bg-blue-600">
                Pemasukan Lomba
            </a>
        </li>

        </ul>
    </div>

    <!-- ⚪ CONTENT -->
    <div class="flex-1 p-6">
        @yield('content')
    </div>

</div>

</body>
</html>