<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Galatama TMB</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @vite('resources/css/app.css')

    <style>
        :root {
            --pink-50: #fff1f7;
            --pink-100: #ffe3ef;
            --pink-200: #ffc7de;
            --pink-500: #ec7fad;
            --blue-50: #eff8ff;
            --blue-100: #dcefff;
            --blue-200: #b9dcff;
            --blue-500: #6aa9df;
            --ink: #263247;
            --muted: #6d7688;
            --line: #e8ecf5;
            --surface: rgba(255, 255, 255, 0.86);
            --shadow: 0 22px 70px rgba(82, 105, 138, 0.16);
            --radius: 18px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Figtree", ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at top left, rgba(255, 199, 222, 0.52), transparent 34rem),
                radial-gradient(circle at bottom right, rgba(185, 220, 255, 0.55), transparent 32rem),
                linear-gradient(135deg, #fff8fb 0%, #f2f9ff 100%);
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .app-shell {
            display: grid;
            grid-template-columns: 270px minmax(0, 1fr);
            min-height: 100vh;
        }

        .app-sidebar {
            position: sticky;
            top: 0;
            height: 100vh;
            padding: 24px 18px;
            background: linear-gradient(180deg, rgba(255, 227, 239, 0.94), rgba(220, 239, 255, 0.94));
            border-right: 1px solid rgba(255, 255, 255, 0.72);
            box-shadow: 18px 0 60px rgba(120, 149, 190, 0.16);
        }

        .brand-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px;
            margin-bottom: 22px;
            border-radius: 22px;
            background: rgba(255, 255, 255, 0.58);
            border: 1px solid rgba(255, 255, 255, 0.75);
        }

        .brand-mark {
            display: grid;
            place-items: center;
            width: 44px;
            height: 44px;
            border-radius: 16px;
            color: #fff;
            font-weight: 800;
            background: linear-gradient(135deg, var(--pink-500), var(--blue-500));
            box-shadow: 0 12px 26px rgba(106, 169, 223, 0.32);
        }

        .brand-title {
            margin: 0;
            font-size: 18px;
            font-weight: 800;
            letter-spacing: 0;
        }

        .brand-subtitle {
            margin: 2px 0 0;
            color: var(--muted);
            font-size: 12px;
            font-weight: 600;
        }

        .nav-list {
            display: grid;
            gap: 8px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 11px;
            min-height: 46px;
            padding: 0 14px;
            border-radius: 16px;
            color: #48566f;
            font-size: 14px;
            font-weight: 700;
            transition: background 160ms ease, color 160ms ease, transform 160ms ease, box-shadow 160ms ease;
        }

        .nav-link:hover,
        .nav-link.is-active {
            color: #253149;
            background: rgba(255, 255, 255, 0.74);
            box-shadow: 0 12px 30px rgba(128, 156, 194, 0.18);
            transform: translateY(-1px);
        }

        .nav-icon {
            display: grid;
            place-items: center;
            width: 30px;
            height: 30px;
            border-radius: 11px;
            background: linear-gradient(135deg, rgba(255, 199, 222, 0.95), rgba(185, 220, 255, 0.95));
            color: #4c6280;
            font-size: 15px;
        }

        .app-main {
            min-width: 0;
            padding: 30px;
        }

        .page-shell {
            width: min(1180px, 100%);
            margin: 0 auto;
        }

        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 18px;
        }

        .page-kicker {
            margin: 0 0 6px;
            color: var(--pink-500);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .page-title {
            margin: 0;
            color: var(--ink);
            font-size: clamp(24px, 3vw, 34px);
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: 0;
        }

        .page-subtitle {
            margin: 8px 0 0;
            max-width: 650px;
            color: var(--muted);
            font-size: 14px;
            line-height: 1.6;
        }

        .content-card,
        .form-card,
        .summary-card {
            width: 100%;
            border: 1px solid rgba(255, 255, 255, 0.72);
            border-radius: var(--radius);
            background: var(--surface);
            box-shadow: var(--shadow);
            backdrop-filter: blur(18px);
        }

        .content-card {
            padding: 18px;
        }

        .form-card {
            max-width: 760px;
            padding: 24px;
        }

        .summary-card {
            max-width: 620px;
            padding: 24px;
        }

        .toolbar {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
        }

        .filter-bar {
            display: flex;
            flex-wrap: wrap;
            align-items: end;
            gap: 12px;
            padding: 14px;
            margin-bottom: 18px;
            border: 1px solid var(--line);
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.62);
        }

        .field-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .field,
        .field-full {
            display: grid;
            gap: 7px;
        }

        .field-full {
            grid-column: 1 / -1;
        }

        .field label {
            color: #526075;
            font-size: 13px;
            font-weight: 800;
        }

        .form-input,
        .form-select,
        input[type="date"],
        input[type="number"],
        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            min-height: 44px;
            padding: 10px 13px;
            border: 1px solid #dbe5f3;
            border-radius: 14px;
            color: var(--ink);
            background: rgba(255, 255, 255, 0.88);
            outline: none;
            transition: border 160ms ease, box-shadow 160ms ease, background 160ms ease;
        }

        .form-input:focus,
        .form-select:focus,
        input:focus,
        select:focus {
            border-color: var(--blue-500);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(106, 169, 223, 0.18);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 42px;
            padding: 0 16px;
            border: 0;
            border-radius: 14px;
            font-weight: 800;
            font-size: 14px;
            cursor: pointer;
            transition: transform 160ms ease, box-shadow 160ms ease, background 160ms ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            color: #fff;
            background: linear-gradient(135deg, var(--pink-500), var(--blue-500));
            box-shadow: 0 14px 26px rgba(106, 169, 223, 0.26);
        }

        .btn-secondary {
            color: #45607e;
            background: #eef7ff;
            border: 1px solid #d7e9fb;
        }

        .btn-danger {
            color: #a43661;
            background: #ffe5ef;
            border: 1px solid #ffc5da;
        }

        .btn-soft {
            color: #53637c;
            background: #f7f9fd;
            border: 1px solid var(--line);
        }

        .table-wrap {
            overflow-x: auto;
            border: 1px solid var(--line);
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.72);
        }

        .data-table {
            width: 100%;
            min-width: 780px;
            border-collapse: collapse;
        }

        .data-table th {
            padding: 14px 16px;
            color: #526075;
            background: linear-gradient(135deg, rgba(255, 227, 239, 0.8), rgba(220, 239, 255, 0.8));
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.05em;
            text-align: left;
            text-transform: uppercase;
        }

        .data-table td {
            padding: 14px 16px;
            border-top: 1px solid var(--line);
            color: #334055;
            font-size: 14px;
            vertical-align: middle;
        }

        .data-table tr:hover td {
            background: rgba(255, 246, 251, 0.7);
        }

        .table-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .money {
            color: #2f719b;
            font-weight: 800;
        }

        .positive {
            color: #2f8a78;
            font-weight: 800;
        }

        .negative {
            color: #c34a78;
            font-weight: 800;
        }

        .alert {
            padding: 13px 15px;
            margin-bottom: 16px;
            border-radius: 15px;
            font-weight: 700;
        }

        .alert-success {
            color: #2f7165;
            background: #e7fbf6;
            border: 1px solid #c8f0e6;
        }

        .alert-error {
            color: #9a345d;
            background: #fff0f6;
            border: 1px solid #ffc7de;
        }

        .metric-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 18px;
        }

        .metric-card {
            padding: 18px;
            border: 1px solid rgba(255, 255, 255, 0.72);
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.76);
            box-shadow: 0 14px 38px rgba(82, 105, 138, 0.12);
        }

        .metric-label {
            margin: 0 0 7px;
            color: var(--muted);
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .metric-value {
            margin: 0;
            color: var(--ink);
            font-size: 24px;
            font-weight: 800;
        }

        .select2-container--default .select2-selection--single {
            height: 44px;
            border: 1px solid #dbe5f3;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.88);
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 42px;
            color: var(--ink);
            padding-left: 13px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 42px;
        }

        @media (max-width: 980px) {
            .app-shell {
                grid-template-columns: 1fr;
            }

            .app-sidebar {
                position: relative;
                height: auto;
                padding: 18px;
            }

            .nav-list {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .app-main {
                padding: 18px;
            }

            .page-header {
                flex-direction: column;
            }

            .metric-grid,
            .field-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 560px) {
            .nav-list {
                grid-template-columns: 1fr;
            }

            .content-card,
            .form-card,
            .summary-card {
                padding: 16px;
                border-radius: 16px;
            }

            .btn {
                width: 100%;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <div class="app-shell">
        <aside class="app-sidebar">
            <div class="brand-card">
                <div class="brand-mark">TMB</div>
                <div>
                    <p class="brand-title">Galatama TMB</p>
                    <p class="brand-subtitle">Kasir & laporan harian</p>
                </div>
            </div>

            <ul class="nav-list">
                <li>
                    <a href="/barang" class="nav-link {{ request()->is('barang*') ? 'is-active' : '' }}">
                        <span class="nav-icon">B</span>
                        <span>Data Barang</span>
                    </a>
                </li>
                <li>
                    <a href="/transaksi" class="nav-link {{ request()->is('transaksi*') ? 'is-active' : '' }}">
                        <span class="nav-icon">K</span>
                        <span>Transaksi</span>
                    </a>
                </li>
                <li>
                    <a href="/laporan" class="nav-link {{ request()->is('laporan') ? 'is-active' : '' }}">
                        <span class="nav-icon">L</span>
                        <span>Pemasukan Warung</span>
                    </a>
                </li>
                <li>
                    <a href="/pemasukan" class="nav-link {{ request()->is('pemasukan*') ? 'is-active' : '' }}">
                        <span class="nav-icon">M</span>
                        <span>Pemasukan Lomba</span>
                    </a>
                </li>
                
                <li>
                    <a href="/pengeluaran" class="nav-link {{ request()->is('pengeluaran*') ? 'is-active' : '' }}">
                        <span class="nav-icon">P</span>
                        <span>Pengeluaran</span>
                    </a>
                </li>
                <li>
                    <a href="/laporan/laba-bersih" class="nav-link {{ request()->is('laporan/laba-bersih') ? 'is-active' : '' }}">
                        <span class="nav-icon">R</span>
                        <span>Laba Rugi</span>
                    </a>
                </li>
                <li>
                    <a href="/grafik" class="nav-link {{ request()->is('grafik') ? 'is-active' : '' }}">
                        <span class="nav-icon">G</span>
                        <span>Grafik</span>
                    </a>
                </li>
            </ul>
        </aside>

        <main class="app-main">
            <div class="page-shell">
                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
</body>
</html>
