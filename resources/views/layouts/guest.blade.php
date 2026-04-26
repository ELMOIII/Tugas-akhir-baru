<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Galatama TMB') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: "Figtree", ui-sans-serif, system-ui, sans-serif;
                color: #263247;
                background:
                    radial-gradient(circle at top left, rgba(255, 199, 222, 0.58), transparent 30rem),
                    radial-gradient(circle at bottom right, rgba(185, 220, 255, 0.6), transparent 30rem),
                    linear-gradient(135deg, #fff8fb 0%, #f2f9ff 100%);
            }

            .auth-shell {
                min-height: 100vh;
                display: grid;
                place-items: center;
                padding: 26px;
            }

            .auth-brand {
                text-align: center;
                margin-bottom: 18px;
            }

            .auth-mark {
                display: grid;
                place-items: center;
                width: 58px;
                height: 58px;
                margin: 0 auto 12px;
                border-radius: 20px;
                color: #fff;
                font-weight: 800;
                background: linear-gradient(135deg, #ec7fad, #6aa9df);
                box-shadow: 0 16px 34px rgba(106, 169, 223, 0.3);
            }

            .auth-title {
                margin: 0;
                font-size: 26px;
                font-weight: 800;
            }

            .auth-subtitle {
                margin: 6px 0 0;
                color: #6d7688;
                font-size: 14px;
                font-weight: 600;
            }

            .auth-card {
                width: min(460px, 100%);
                margin: 0 auto;
                padding: 28px;
                border: 1px solid rgba(255, 255, 255, 0.76);
                border-radius: 22px;
                background: rgba(255, 255, 255, 0.88);
                box-shadow: 0 22px 70px rgba(82, 105, 138, 0.16);
                backdrop-filter: blur(18px);
            }

            .auth-card input {
                min-height: 44px;
                border-color: #dbe5f3;
                border-radius: 14px;
                background: rgba(255, 255, 255, 0.92);
            }

            .auth-card input:focus {
                border-color: #6aa9df;
                box-shadow: 0 0 0 4px rgba(106, 169, 223, 0.18);
            }

            .auth-card button[type="submit"] {
                border-radius: 14px;
                background: linear-gradient(135deg, #ec7fad, #6aa9df);
                box-shadow: 0 14px 26px rgba(106, 169, 223, 0.26);
            }

            .auth-card a {
                color: #5f8ebf;
                font-weight: 700;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="auth-shell">
            <div style="width: 100%;">
                <div class="auth-brand">
                    <a href="/" class="auth-mark">TMB</a>
                    <h1 class="auth-title">Galatama TMB</h1>
                    <p class="auth-subtitle">Masuk ke kasir dan laporan harian</p>
                </div>

                <div class="auth-card">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
