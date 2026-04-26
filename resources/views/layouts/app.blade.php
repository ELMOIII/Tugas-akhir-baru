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
            :root {
                --pink-100: #ffe3ef;
                --pink-500: #ec7fad;
                --blue-100: #dcefff;
                --blue-500: #6aa9df;
                --ink: #263247;
                --muted: #6d7688;
                --line: #e8ecf5;
                --shadow: 0 22px 70px rgba(82, 105, 138, 0.16);
            }

            body {
                font-family: "Figtree", ui-sans-serif, system-ui, sans-serif;
                color: var(--ink);
                background:
                    radial-gradient(circle at top left, rgba(255, 199, 222, 0.52), transparent 34rem),
                    radial-gradient(circle at bottom right, rgba(185, 220, 255, 0.55), transparent 32rem),
                    linear-gradient(135deg, #fff8fb 0%, #f2f9ff 100%);
            }

            .breeze-app {
                min-height: 100vh;
            }

            .breeze-header {
                border-bottom: 1px solid rgba(255, 255, 255, 0.75);
                background: rgba(255, 255, 255, 0.68);
                backdrop-filter: blur(18px);
                box-shadow: 0 12px 38px rgba(82, 105, 138, 0.1);
            }

            .breeze-header h2 {
                color: var(--ink);
                font-size: 24px;
                font-weight: 800;
            }

            .breeze-main {
                width: min(1180px, 100%);
                margin: 0 auto;
                padding: 30px 18px;
            }

            .breeze-main .bg-white,
            .breeze-main section {
                border: 1px solid rgba(255, 255, 255, 0.72);
                border-radius: 18px;
                background: rgba(255, 255, 255, 0.86) !important;
                box-shadow: var(--shadow);
            }

            .breeze-main input {
                border-color: #dbe5f3;
                border-radius: 14px;
            }

            .breeze-main input:focus {
                border-color: var(--blue-500);
                box-shadow: 0 0 0 4px rgba(106, 169, 223, 0.18);
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="breeze-app">
            @include('layouts.navigation')

            @isset($header)
                <header class="breeze-header">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="breeze-main">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
