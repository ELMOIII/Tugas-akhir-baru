@extends('layout.app')

@section('content')
<div class="page-header">
    <div>
        <p class="page-kicker">Grafik</p>
        <h1 class="page-title">Grafik Penjualan</h1>
        <p class="page-subtitle">Visualisasi total penjualan harian untuk melihat pola pemasukan dengan cepat.</p>
    </div>
</div>

<div class="content-card">
    <div style="height: 420px;">
        <canvas id="chart"></canvas>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($labels),
        datasets: [{
            label: 'Penjualan',
            data: @json($totals),
            borderColor: '#6aa9df',
            backgroundColor: 'rgba(236, 127, 173, 0.16)',
            pointBackgroundColor: '#ec7fad',
            pointBorderColor: '#ffffff',
            borderWidth: 3,
            tension: 0.35,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                labels: {
                    color: '#526075',
                    font: { weight: '700' }
                }
            }
        },
        scales: {
            x: {
                ticks: { color: '#6d7688' },
                grid: { color: 'rgba(232, 236, 245, 0.8)' }
            },
            y: {
                ticks: { color: '#6d7688' },
                grid: { color: 'rgba(232, 236, 245, 0.8)' }
            }
        }
    }
});
</script>
@endpush
@endsection
