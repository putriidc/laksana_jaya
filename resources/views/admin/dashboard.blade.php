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
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="font-bold text-gray-800 mb-6">CashIn & CashOut</h3>
            <div class="h-[300px] w-full">
                <canvas id="chartArusKas"></canvas>
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
        window.onload = function() {
            // Pastikan variabel didefinisikan di luar if agar tidak error
            if (typeof Chart !== 'undefined') {
                // Mengambil data yang dikirim dari Controller lewat compact
                const labels = @json($labels);
                const dataCashIn = @json($cashIn);
                const dataCashOut = @json($cashOut);

                const canvasAK = document.getElementById('chartArusKas');
                if(!canvasAK) return;

                const ctxAK = canvasAK.getContext('2d');
                
                new Chart(ctxAK, {
                    type: 'line',
                    data: {
                        labels: labels, 
                        datasets: [
                            {
                                label: 'Cash In (Hari Ini)',
                                data: dataCashIn,
                                borderColor: '#10b981',
                                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                                fill: true,
                                tension: 0.4
                            },
                            {
                                label: 'Cash Out (Hari Ini)',
                                data: dataCashOut,
                                borderColor: '#ef4444',
                                backgroundColor: 'rgba(239, 68, 68, 0.1)',
                                fill: true,
                                tension: 0.4
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp ' + value.toLocaleString('id-ID');
                                    }
                                }
                            }
                        }
                    }
                });
            } else {
                console.error("Chart.js tidak ditemukan! Pastikan library terpasang.");
            }
        };
        </script>
</div>
@endsection
