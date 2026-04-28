@extends('layout.app')

@section('content')
<div class="page-header">
    <div>
        <p class="page-kicker">Grafik</p>
        <h1 class="page-title">Grafik Pendapatan</h1>
        <p class="page-subtitle">Visualisasi tren pemasukan warung dan pemasukan lomba harian.</p>
    </div>
</div>

<div class="content-card" style="margin-bottom: 2rem;">
    <h3 style="margin-bottom: 1rem; color: #374151;">📈 Grafik Pemasukan Warung</h3>
    <div style="height: 420px;">
        <canvas id="chartWarung"></canvas>
    </div>
</div>

<div class="content-card">
    <h3 style="margin-bottom: 1rem; color: #374151;">🏆 Grafik Pemasukan Lomba</h3>
    <div style="height: 420px;">
        <canvas id="chartLomba"></canvas>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Konfigurasi umum untuk sumbu Y agar selalu mulai dari 0
    const commonScales = {
        y: {
            beginAtZero: true, // 🔥 Ini supaya grafik tidak melayang
            ticks: { color: '#6d7688' },
            grid: { color: 'rgba(232, 236, 245, 0.8)' }
        },
        x: {
            ticks: { color: '#6d7688' },
            grid: { color: 'rgba(232, 236, 245, 0.8)' }
        }
    };

    // 1. Inisiasi Grafik Warung (Warna Biru)
    const ctxWarung = document.getElementById('chartWarung');
    new Chart(ctxWarung, {
        type: 'line',
        data: {
            labels: @json($labelsWarung),
            datasets: [{
                label: 'Penjualan Warung (Rp)',
                data: @json($totalsWarung),
                borderColor: '#3b82f6', // Biru
                backgroundColor: 'rgba(59, 130, 246, 0.15)',
                pointBackgroundColor: '#2563eb',
                pointBorderColor: '#ffffff',
                borderWidth: 3,
                tension: 0.35,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: commonScales
        }
    });

    // 2. Inisiasi Grafik Lomba (Warna Hijau)
    const ctxLomba = document.getElementById('chartLomba');
    new Chart(ctxLomba, {
        type: 'line',
        data: {
            labels: @json($labelsLomba),
            datasets: [{
                label: 'Penjualan Tiket Lomba (Rp)',
                data: @json($totalsLomba),
                borderColor: '#10b981', // Hijau
                backgroundColor: 'rgba(16, 185, 129, 0.15)',
                pointBackgroundColor: '#059669',
                pointBorderColor: '#ffffff',
                borderWidth: 3,
                tension: 0.35,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: commonScales
        }
    });
</script>
@endpush
@endsection