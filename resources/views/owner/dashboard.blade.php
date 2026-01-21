@extends('owner.layout')
@section('content')
<div>
    <h1 class="text-2xl font-bold">Dashboard</h1>
    <div class="p-6">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="font-bold text-gray-800 mb-6">Laba/Rugi Tahun Ini</h3>
            <div class="flex flex-col md:flex-row items-center gap-6">
                <div class="relative w-[200px] h-[200px]">
                    <canvas id="chartLabaRugi"></canvas>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-xl font-bold text-green-500">
                            @php
                                // Hindari pembagian dengan nol jika pendapatan masih kosong
                                $persentaseLaba = $totalPendapatan > 0 ? ($totalLabaRugi / $totalPendapatan) * 100 : 0;
                            @endphp
                           {{ number_format($persentaseLaba, 1) }}%
                        </span>
                    </div>
                </div>
                <div class="flex-1 space-y-3 w-full">
                    <div class="flex justify-between text-sm">
                        <span><span class="inline-block w-3 h-3 rounded-full bg-green-400 mr-2"></span>Pendapatan</span>
                        <span class="font-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span><span class="inline-block w-3 h-3 rounded-full bg-yellow-400 mr-2"></span>Nilai HPP</span>
                        {{-- Kita ambil khusus Biaya Material dari koleksi --}}
                        <span class="font-bold">Rp {{ number_format($biayaFinal->where('nama_perkiraan', 'Biaya Material')->first()['total'] ?? 0, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span><span class="inline-block w-3 h-3 rounded-full bg-red-400 mr-2"></span>Pengeluaran</span>
                        {{-- Total Biaya dikurangi Biaya Material --}}
                        <span class="font-bold">Rp {{ number_format($totalBiaya - ($biayaFinal->where('nama_perkiraan', 'Biaya Material')->first()['total'] ?? 0), 0, ',', '.') }}</span>
                    </div>
                    <div class="border-t pt-2 flex justify-between font-bold text-lg">
                        <span>Laba</span>
                        <span class="text-green-500">Rp {{ number_format($totalLabaRugi, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="font-bold text-gray-800 mb-6">Arus Kas</h3>
            <div class="h-[300px] w-full">
                <canvas id="chartArusKas"></canvas>
            </div>
        </div>

    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                <p class="text-gray-500 text-sm font-medium">Total Aktiva</p>
                <h2 class="text-2xl font-bold text-green-600 mt-1">Rp. {{ number_format(($totalTetap + $totalLancar + $totalKas), 0, ',', '.') }}</h2>
                <div class="flex gap-x-2 mt-3 text-[10px] text-gray-400">
                    <span>Lancar: Rp. {{ number_format(($totalLancar + $totalKas), 0, ',', '.') }}</span>
                    <span>•</span>
                    <span>Tetap: Rp. {{ number_format($totalTetap, 0, ',', '.') }}</span>
                </div>
            </div>

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
            </div>
        </div>
</div>
<script>
    window.onload = function() {
        // Cek apakah library Chart sudah masuk
        if (typeof Chart !== 'undefined') {
            
            // 1. Ambil data dari Laravel ke JavaScript
            // Kita bagi biaya menjadi dua: HPP (Material) dan Biaya Lainnya
            const totalPendapatan = {{ $totalPendapatan }};
            const detailBiaya = @json($biayaFinal);
            
            // Logika sederhana memisahkan HPP (Material) dari total biaya
            const nilaiHPP = detailBiaya.find(item => item.nama_perkiraan === 'Biaya Material')?.total || 0;
            const pengeluaranLain = {{ $totalBiaya }} - nilaiHPP;

            // 2. Inisialisasi Chart
            const ctxLR = document.getElementById('chartLabaRugi').getContext('2d');
            new Chart(ctxLR, {
                type: 'doughnut',
                data: {
                    labels: ['Pendapatan', 'Nilai HPP', 'Pengeluaran'],
                    datasets: [{
                        // Masukkan data variabel JS di sini
                        data: [totalPendapatan, nilaiHPP, pengeluaranLain], 
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

            // 2. Chart Arus Kas
            // 1. Ambil data dari Laravel (Global)
            const cashIn = @json($cashInGL);
            const cashOut = @json($cashOutGL);

            // 2. Proses data agar dikelompokkan berdasarkan tanggal (7 hari terakhir sebagai contoh)
            // Kita ambil label tanggal unik dari kedua data tersebut
            const labels = [...new Set([...cashIn.map(i => i.tanggal), ...cashOut.map(o => o.tanggal)])]
                            .sort().slice(-7); // Ambil 7 tanggal terakhir

            // Hitung total masuk per tanggal
            const dataMasuk = labels.map(tgl => {
                return cashIn.filter(i => i.tanggal === tgl).reduce((a, b) => a + parseFloat(b.debit), 0);
            });

            // Hitung total keluar per tanggal (kita jadikan negatif untuk grafik bar bawah)
            const dataKeluar = labels.map(tgl => {
                const total = cashOut.filter(o => o.tanggal === tgl).reduce((a, b) => a + parseFloat(b.kredit), 0);
                return -total; 
            });

            // Hitung Kas Bersih (Line Chart) -> Selisih Masuk & Keluar
            const dataBersih = dataMasuk.map((val, index) => val + dataKeluar[index]);

            // 3. Inisialisasi Chart Arus Kas
            const ctxAK = document.getElementById('chartArusKas').getContext('2d');
            new Chart(ctxAK, {
                data: {
                    labels: labels.map(tgl => {
                        // Format tanggal agar lebih cantik (Contoh: 5 Des)
                        const d = new Date(tgl);
                        return d.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
                    }),
                    datasets: [
                        {
                            type: 'bar',
                            label: 'Cash In',
                            data: dataMasuk,
                            backgroundColor: '#4ade80', // Hijau
                            borderRadius: 5
                        },
                        {
                            type: 'bar',
                            label: 'Cash Out',
                            data: dataKeluar,
                            backgroundColor: '#f87171', // Merah
                            borderRadius: 5
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return value.toLocaleString('id-ID'); // Format angka ribuan
                                }
                            }
                        },
                        x: { grid: { display: false } }
                    },
                    plugins: {
                        legend: { position: 'bottom' }
                    }
                }
            });

        } else {
            alert("Gagal memuat Chart.js! Pastikan 'npm run dev' sedang berjalan.");
        }
    };
</script>
</div>
@endsection