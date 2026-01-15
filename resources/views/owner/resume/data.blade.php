@extends('owner.layout')
@section('content')
    <div>
        <h1 class="font-bold text-2xl mb-4 uppercase">Resume Proyek</h1>
        <section>
            <a target="_blank" href="{{ route('resume.print') }}"><button
                    class="cursor-pointer px-5 py-2 border-[#9A9A9A] border-2 rounded-lg flex items-center gap-x-2 bg-white mb-5">
                    <span class="text-[#72686B]">Cetak Data</span>
                    <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                </button></a>
            <div class="rounded-lg shadow-[1px_1px_10px_rgba(0,0,0,0.1)] pt-4 pb-6 max-[1200px]:overflow-x-auto">
                <table class="table-auto text-center text-sm w-full max-[1200px]:w-[1200px]">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[10%]">No</th>
                        <th class="py-2 w-[15%]">Tgl Mulai</th>
                        <th class="py-2 w-[20%]">Nama Proyek</th>
                        <th class="py-2 w-[20%]">Nilai Proyek</th>
                        <th class="py-2 w-[15%]">Status</th>
                        <th class="py-2 w-[20%]">Detail</th>
                    </thead>
                    <tbody>
                        @foreach ($resume as $i => $item)
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">{{ $i + 1 }}</td>
                                <td class="py-2">{{ \Carbon\Carbon::parse($item['tgl_mulai'])->format('d/m/Y') }}</td>
                                <td class="py-2">{{ $item['nama_proyek'] }}</td>
                                <td class="py-2">Rp. {{ number_format($item['nilai_kontrak'], 0, ',', '.') }}</td>
                                <td class="py-2">
                                    @php $persen = $item['persentase']; @endphp
                                    @if ($persen >= 100)
                                        <span class="bg-[#DD4049] px-5 py-1 rounded-xl text-white">FULL</span>
                                    @elseif($persen >= 80)
                                        <span class="bg-[#F98C2D] px-5 py-1 rounded-xl text-white">WARNING</span>
                                    @elseif($persen >= 50)
                                        <span class="bg-[#F9E52D] px-5 py-1 rounded-xl text-black">CAREFULL</span>
                                    @elseif($persen <= 25)
                                        <span class="bg-[#45D03E] px-5 py-1 rounded-xl text-white">SAVE</span>
                                    @else
                                        <span class="bg-[#F9E52D] px-5 py-1 rounded-xl text-black">CAREFULL</span>
                                    @endif
                                </td>
                                <td class="py-2">
                                    <button class="text-blue-400 hover:underline cursor-pointer font-medium"
                                        onclick="detailResume(
                                        '{{ $item['nama_proyek'] }}',
                                        '{{ \Carbon\Carbon::parse($item['tgl_mulai'])->format('d/m/Y') }}',
                                        '{{ number_format($item['total_pengeluaran'], 0, ',', '.') }}',
                                        '{{ number_format($item['piutang_vendor'], 0, ',', '.') }}',
                                        '{{ number_format($item['total_tp_pv'], 0, ',', '.') }}',
                                        '{{ $item['jenis_proyek'] }}',
                                        '{{ number_format($item['net'], 0, ',', '.') }}',
                                        '{{ number_format($item['persentase'], 2, ',', '.') }}',
                                        '{{ number_format($item['total_progres'], 2, ',', '.') }}',
                                        '{{ number_format($item['sisa'], 0, ',', '.') }}',
                                        '{{ $persen >= 100 ? 'FULL' : ($persen >= 80 ? 'WARNING' : ($persen >= 50 ? 'CAREFULL' : ($persen <= 25 ? 'SAVE' : 'CAREFULL'))) }}'
                                            )">
                                        Lihat Detail
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                        {{-- <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">2</td>
                                <td class="py-2">11/12/2025</td>
                                <td class="py-2">Kantor AR4N</td>
                                <td class="py-2">
                                    <span class="bg-[#F98C2D] px-5 py-1 rounded-xl">WARNING</span>
                                </td>
                                <td class="py-2">
                                    <button class="text-blue-400 hover:underline cursor-pointer font-medium" onclick="detailResume()">Lihat Detail</button>
                                </td>
                            </tr>
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">3</td>
                                <td class="py-2">11/12/2025</td>
                                <td class="py-2">Kantor AR4N</td>
                                <td class="py-2">
                                    <span class="bg-[#F9E52D] px-5 py-1 rounded-xl">CAREFULL</span>
                                </td>
                                <td class="py-2">
                                    <button class="text-blue-400 hover:underline cursor-pointer font-medium" onclick="detailResume()">Lihat Detail</button>
                                </td>
                            </tr>
                            <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">4</td>
                                <td class="py-2">11/12/2025</td>
                                <td class="py-2">Kantor AR4N</td>
                                <td class="py-2">
                                    <span class="bg-[#45D03E] px-5 py-1 rounded-xl">SAVE</span>
                                </td>
                                <td class="py-2">
                                    <button class="text-blue-400 hover:underline cursor-pointer font-medium" onclick="detailResume()">Lihat Detail</button>
                                </td>
                            </tr> --}}
                    </tbody>
                </table>
            </div>
        </section>
        <script>
            function detailResume(nama, tglMulai, totalPengeluaran, piutangVendor, totalTPPV, jenisProyek, nett, persentase, total_progres, sisa, status) {
    Swal.fire({
        html: `
            <section class="py-3">
                <h1 class="font-bold text-2xl mb-8 uppercase text-start max-[570px]:text-xl">Detail Resume Proyek</h1>
                <div class="flex flex-col gap-y-5">
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:gap-y-2 max-[570px]:items-start">
                        <span class="font-semibold w-[240px] text-start">Nama Proyek</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 px-6 py-2 rounded-lg">${nama}</span>
                    </div>
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:gap-y-2 max-[570px]:items-start">
                        <span class="font-semibold w-[240px] text-start">Tanggal Mulai</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 px-6 py-2 rounded-lg">${tglMulai}</span>
                    </div>
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:gap-y-2 max-[570px]:items-start">
                        <span class="font-semibold w-[240px] text-start">Total Pengeluaran</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 px-6 py-2 rounded-lg">Rp. ${totalPengeluaran}</span>
                    </div>
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:gap-y-2 max-[570px]:items-start">
                        <span class="font-semibold w-[240px] text-start">Piutang Vendor</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 px-6 py-2 rounded-lg">Rp. ${piutangVendor}</span>
                    </div>
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:gap-y-2 max-[570px]:items-start">
                        <span class="font-semibold w-[240px] text-start">Total TP + PV</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 px-6 py-2 rounded-lg">Rp. ${totalTPPV}</span>
                    </div>
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:gap-y-2 max-[570px]:items-start">
                        <span class="font-semibold w-[240px] text-start">Jenis Proyek</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 px-6 py-2 rounded-lg">${jenisProyek}</span>
                    </div>
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:gap-y-2 max-[570px]:items-start">
                        <span class="font-semibold w-[240px] text-start">NETT</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 px-6 py-2 rounded-lg">Rp. ${nett}</span>
                    </div>
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:gap-y-2 max-[570px]:items-start">
                        <span class="font-semibold w-[240px] text-start">Persentase</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 px-6 py-2 rounded-lg">${persentase}%</span>
                    </div>
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:gap-y-2 max-[570px]:items-start">
                        <span class="font-semibold w-[240px] text-start">Bobot</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 px-6 py-2 rounded-lg">${total_progres}%</span>
                    </div>
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:gap-y-2 max-[570px]:items-start">
                        <span class="font-semibold w-[240px] text-start">Sisa</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 px-6 py-2 rounded-lg">Rp. ${sisa}</span>
                    </div>
                    <div class="flex justify-start items-center">
                        <span class="font-semibold w-[160px] text-start">Status</span>
                        ${status === 'FULL' ? `<span class="bg-[#DD4049] px-5 py-1 rounded-xl text-white">FULL</span>` : ""}
                        ${status === 'WARNING' ? `<span class="bg-[#F98C2D] px-5 py-1 rounded-xl text-white">WARNING</span>` : ""}
                        ${status === 'CAREFULL' ? `<span class="bg-[#F9E52D] px-5 py-1 rounded-xl text-black">CAREFULL</span>` : ""}
                        ${status === 'SAVE' ? `<span class="bg-[#45D03E] px-5 py-1 rounded-xl text-white">SAVE</span>` : ""}
                    </div>
                </div>
            </section>
        `,
        width: 600,
        showCancelButton: false,
        showConfirmButton: false,
        showCloseButton: true,
    });
}

        </script>
    </div>
@endsection
