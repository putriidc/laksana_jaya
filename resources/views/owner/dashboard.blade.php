@extends('owner.layout')
@section('content')
<div>
    <h1 class="text-2xl font-bold">Dashboard</h1>
    <div class="p-6">
    <div class="grid grid-cols-1 gap-6">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="font-bold text-gray-800 mb-6">Laba/Rugi Bulan Ini</h3>
            <div class="flex flex-col md:flex-row items-center gap-6">
                <div class="relative w-[300px] h-[300px]">
                    <canvas id="chartLabaRugi"></canvas>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-xl font-bold text-green-500">
                            @php
                                // Hindari pembagian dengan nol jika pendapatan masih kosong
                                $persentaseLaba = $pendapatanCurr > 0 ? ($labaTahunBerjalan / $pendapatanCurr) * 100 : 0;
                            @endphp
                           {{ number_format($persentaseLaba, 1) }}%
                        </span>
                    </div>
                </div>
                <div class="flex-1 space-y-3 w-full">
                    <div class="flex justify-between text-sm">
                        <span><span class="inline-block w-3 h-3 rounded-full bg-green-400 mr-2"></span>Pendapatan</span>
                        <span class="font-bold">Rp {{ number_format($pendapatanCurr, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span><span class="inline-block w-3 h-3 rounded-full bg-red-400 mr-2"></span>Pengeluaran</span>
                        {{-- Total Biaya dikurangi Biaya Material --}}
                        <span class="font-bold">Rp {{ number_format($biayaCurr , 0, ',', '.') }}</span>
                    </div>
                    <div class="border-t pt-2 flex justify-between font-bold text-lg">
                        <span>Laba</span>
                        <span class="text-green-500">Rp {{ number_format($labaTahunBerjalan, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="font-bold text-gray-800 mb-6">Trend Saldo Kas (7 Hari Terakhir)</h3>
            <div class="relative h-[350px]">
                <canvas id="chartTrendKas"></canvas>
            </div>
        </div>

    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                <p class="text-gray-500 text-sm font-medium">Total Aktiva</p>
                <h2 class="text-2xl font-bold text-green-600 mt-1">Rp. {{ number_format(($totalTetap + $totalLancar + $totalKas), 0, ',', '.') }}</h2>
                <div class="flex flex-col gap-y-[2px] text-[10px] text-gray-400 mt-4">
                    <span>Aktiva Lancar: Rp. {{ number_format(($totalLancar + $totalKas), 0, ',', '.') }}</span>
                    <span>Aktiva Tetap: Rp. {{ number_format($totalTetap, 0, ',', '.') }}</span>
                </div>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                <p class="text-gray-500 text-sm font-medium">Total Pasiva</p>
                <h2 class="text-2xl font-bold text-green-600 mt-1">Rp. {{ number_format($saldoModal + $labaDitahan + $labaTahunBerjalan - $totalKewajiban, 0, ',', '.') }}</h2>
                <div class="flex flex-col gap-y-[2px] text-[10px] text-gray-400 mt-4">
                    <span>Jumlah Kewajiban: Rp. {{ number_format($totalKewajiban, 0, ',', '.') }}</span>
                    <span>Jumlah Modal: Rp. {{ number_format($saldoModal + $labaDitahan + $labaTahunBerjalan, 0, ',', '.') }}</span>
                </div>
            </div>
{{--
            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                <p class="text-gray-500 text-sm font-medium">Total Kewajiban</p>
                <h2 class="text-2xl font-bold text-red-500 mt-1">Rp. {{ number_format($totalKewajiban, 0, ',', '.') }}</h2>
                <p class="text-[10px] text-gray-400 mt-3 italic">*Total hutang usaha, vendor, dll</p>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                <p class="text-gray-500 text-sm font-medium">Total Pasiva</p>
                <h2 class="text-2xl font-bold text-blue-600 mt-1">Rp. {{ number_format((($saldoModal + $labaDitahan + $labaTahunBerjalan) + $totalKewajiban), 0, ',', '.') }}</h2>
                <div class="flex gap-x-2 mt-3 text-[10px] text-gray-400">
                    <span>Modal: Rp. {{ number_format(($saldoModal + $labaDitahan + $labaTahunBerjalan), 0, ',', '.') }}</span>
                </div>
            </div> --}}
        </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // 1. DATA DARI LARAVEL
    const labelsKas = @json($formattedLabels ?? []);
    const seriesKas = @json($seriesData ?? []);

    // Data Laba Rugi
    // 1. Ambil data dari Laravel ke JavaScript
            // Kita bagi biaya menjadi dua: HPP (Material) dan Biaya Lainnya
            const totalPendapatan = {{ $pendapatanCurr }};
            const detailBiaya = @json($biayaFinal);

            // Logika sederhana memisahkan HPP (Material) dari total biaya
            const nilaiHPP = detailBiaya.find(item => item.nama_perkiraan === 'Biaya Material')?.total || 0;
            const pengeluaranLain = {{ $biayaCurr }};

            // 2. Inisialisasi Chart
            const ctxLR = document.getElementById('chartLabaRugi').getContext('2d');
            new Chart(ctxLR, {
                type: 'doughnut',
                data: {
                    labels: ['Pendapatan', 'Pengeluaran'],
                    datasets: [{
                        // Masukkan data variabel JS di sini
                        data: [totalPendapatan, pengeluaranLain],
                        backgroundColor: ['#4ade80', '#facc15', '#f87171'],
                        cutout: '85%',
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } }
                }
            });

    // --- CHART 2: TREND KAS (Multi-Line Chart.js) ---
    const ctxKas = document.getElementById('chartTrendKas');
    if (ctxKas && seriesKas.length > 0) {
        // Map data series dari Laravel ke format Chart.js
        const datasetsKas = seriesKas.map((item, index) => {
            const colors = [
                '#3b82f6', '#4ade80', '#facc15', '#f87171', '#a855f7',
                '#ec4899', '#06b6d4', '#84cc16', '#f59e0b', '#6366f1',
                '#14b8a6', '#f43f5e', '#8b5cf6', '#10b981', '#fbbf24',
                '#2dd4bf', '#fb7185', '#60a5fa', '#34d399', '#fb923c'
            ];
            return {
                label: item.name,
                data: item.data,
                borderColor: colors[index % colors.length],
                backgroundColor: colors[index % colors.length] + '20', // transparansi
                borderWidth: 3,
                tension: 0.4, // Membuat garis smooth
                fill: true
            };
        });

        new Chart(ctxKas, {
            type: 'line',
            data: {
                labels: labelsKas,
                datasets: datasetsKas
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: false,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': Rp ' + context.raw.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    }
});
</script>
</div>
@endsection
