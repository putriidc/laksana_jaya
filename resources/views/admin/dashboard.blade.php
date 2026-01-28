@extends('admin.layout') @section('content')
<div class="">
    @if(session('success'))
    <div
        id="flash-message"
        data-type="success"
        data-message="{{ session('success') }}"
    ></div>
    @endif
    <h1 class="font-bold text-2xl mb-4">Dashboard</h1>
    <section class="flex flex-col gap-y-2">
        @if (Auth::user()->role == "Admin 1" || Auth::user()->role == "Admin 2")
        <div class="flex items-center gap-x-4">
            {{-- <div class="w-[60%] rounded-xl py-6 px-8 shadow-sm border border-gray-100 h-[400px] overflow-y-auto">
                <h3 class="font-bold text-lg mb-5">Saldo Kas</h3>
                <section class="flex items-center flex-wrap gap-4">
                @foreach ($kasFinal as $item)
                    <div class="flex items-center justify-between border border-[#DD4049] px-6 py-4 rounded-lg w-[270px]">
                        <div class="flex flex-col">
                            <span class="font-medium">{{ $item['nama_perkiraan'] }}</span>
                            <span class="font-bold">Rp. {{ number_format($item['total'], 0, ',', '.') }}</span>
                        </div>
                        <div class="bg-gradient-to-b from-[#DD4049] to-[#F9E52D] p-6 rounded-xl w-fit">
                            <img src="{{ asset('assets/card-send.png') }}" alt="card icon" class="w-[20px] h-[20px]">
                        </div>
                    </div>
                @endforeach
                </section>
            </div> --}}
            <div class="bg-white py-5 rounded-2xl shadow-sm border border-gray-100 grow">
                <div class="flex pb-5 items-center justify-between px-6 shadow-[0px_2px_5px_rgba(0,0,0,0.1)] rounded-b-2xl">
                    <h3 class="font-bold text-gray-800">Saldo Kas</h3>
                </div>
                <div class="h-[300px] flex flex-col w-full px-6 py-4 gap-y-4 overflow-y-auto">
                   @foreach ($kasFinal as $item)
                    <div class="flex items-center gap-x-3 w-full border-b border-gray-500 pb-3">
                        <div class="bg-gray-400 rounded-full px-3 py-2">
                            <img src="{{ asset('assets/dolar.png') }}" alt="dolar icon" class="w-[15px] h-[25px]">
                        </div>
                        <div class="flex flex-col text-sm leading-[22px] w-[60%]">
                            <span class="font-bold">{{ $item['nama_perkiraan'] }}</span>
                        </div>
                        <div class="ml-auto bg-green-400 px-2 py-1 rounded-lg text-sm">
                            <span class="text-white">Rp. {{ number_format($item['total'], 0, ',', '.') }}</span>
                        </div>
                   </div>
                   @endforeach
                </div>
            </div>
            <div class="bg-white py-5 rounded-2xl shadow-sm border border-gray-100 grow">
                <div class="flex pb-5 items-center justify-between px-6 shadow-[0px_2px_5px_rgba(0,0,0,0.1)] rounded-b-2xl">
                    <h3 class="font-bold text-gray-800">Biaya Pengeluaran</h3>
                    <span class="bg-blue-600 px-4 py-1 rounded-lg text-sm text-white">Total Biaya: Rp. {{ number_format($totalBiaya, 0, ',', '.') }}</span>
                </div>
                <div class="h-[300px] flex flex-col w-full px-6 py-4 gap-y-4 overflow-y-auto">
                   @foreach ($biayaFinal as $item)
                    <div class="flex items-center gap-x-3 w-full border-b border-gray-500 pb-3">
                        <div class="bg-gray-400 rounded-full px-3 py-2">
                            <img src="{{ asset('assets/dolar.png') }}" alt="dolar icon" class="w-[15px] h-[25px]">
                        </div>
                        <div class="flex flex-col text-sm leading-[22px] w-[60%]">
                            <span class="font-bold">{{ $item['nama_perkiraan'] }}</span>
                        </div>
                        <div class="ml-auto bg-red-500 px-2 py-1 rounded-lg text-sm">
                            <span class="text-white">Rp. {{ number_format($item['total'], 0, ',', '.') }}</span>
                        </div>
                   </div>
                   @endforeach
                </div>
            </div>
         </div>
        @endif
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="font-bold text-gray-800 mb-6">Alur Kas Dalam Sebulan</h3>
            <div class="relative h-[350px]">
                <canvas id="chartTrendKas"></canvas>
            </div>
        </div>
        <div class="flex items-center gap-x-4">
            <div class="bg-white py-5 rounded-2xl shadow-sm border border-gray-100 grow">
                <div class="flex pb-5 items-center justify-between px-6 shadow-[0px_2px_5px_rgba(0,0,0,0.1)] rounded-b-2xl">
                    <h3 class="font-bold text-gray-800">Karyawan</h3>
                    <span class="bg-blue-600 px-4 py-1 rounded-lg text-sm text-white">Total Karyawan: {{ $karyawans->count() }}</span>
                </div>
                <div class="h-[300px] flex flex-col w-full px-6 py-4 gap-y-4 overflow-y-auto">
                   @foreach ($karyawans as $item)
                    <div class="flex items-center gap-x-3 w-full border-b border-gray-500 pb-3">
                        <div class="bg-gray-400 rounded-full p-1">
                            <img src="{{ asset('assets/user.png') }}" alt="user icon" class="w-[40px] h-[40px]">
                        </div>
                        <div class="flex flex-col leading-[22px]">
                            <span class="font-bold">{{ $item->nama }}</span>
                            <span>{{ $item->email }}</span>
                        </div>
                        <div class="ml-auto bg-green-800 px-2 py-1 rounded-lg">
                            <span class="text-white">{{ $item->kode_akun }}</span>
                        </div>
                   </div>
                   @endforeach
                </div>
            </div>
            <div class="bg-white py-5 rounded-2xl shadow-sm border border-gray-100 grow">
                <div class="flex pb-5 items-center justify-between px-6 shadow-[0px_2px_5px_rgba(0,0,0,0.1)] rounded-b-2xl">
                    <h3 class="font-bold text-gray-800">Hutang Vendor</h3>
                    <span class="bg-blue-600 px-4 py-1 rounded-lg text-sm text-white">Belum Dibayar: {{ $hutangVendors->count() }}</span>
                </div>
                <div class="h-[300px] flex flex-col w-full px-6 py-4 gap-y-4 overflow-y-auto">
                   @foreach ($hutangVendors as $item)
                   <div class="flex items-center gap-x-3 w-full border-b border-gray-500 pb-3">
                        <div class="bg-gray-400 rounded-full p-1">
                            <img src="{{ asset('assets/user.png') }}" alt="user icon" class="w-[40px] h-[40px]">
                        </div>
                        <div class="flex flex-col leading-[22px]">
                            <span class="font-bold">{{ $item->supplier?->nama ?? '-' }}</span>
                            <span>{{ $item->proyek?->nama_proyek ?? '-' }}</span>
                        </div>
                        <div class="ml-auto flex flex-col gap-y-1">
                            <span class="text-white bg-green-800 px-2 py-1 rounded-lg text-xs text-center">Rp {{ number_format($item->nominal, 0, ',', '.') }}</span>
                            <span class="text-white bg-red-500 px-2 py-1 rounded-lg text-xs text-center">{{ \Carbon\Carbon::parse($item->tgl_jatuh_tempo)->format('d/m/Y') }}</span>
                        </div>
                   </div>
                   @endforeach
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const labelsKas = @json($formattedLabels);
            const seriesKas = @json($seriesData);
            // --- CHART: TREND KAS (Multi-Line Chart.js) ---
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
                        spanGaps: true, // Menghubungkan garis jika ada data yang kosong (jika diinginkan)
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
