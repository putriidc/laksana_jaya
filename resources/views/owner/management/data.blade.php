@extends('owner.layout')
@section('content')
    <div>
        <h1 class="font-bold text-2xl mb-4">Data Management Proyek</h1>
        <section>
            <a href="{{ route('pinjamanKaryawans.create') }}"><button
                    class="cursor-pointer px-5 py-2 border-[#9A9A9A] border-2 rounded-lg flex items-center gap-x-2 bg-white mb-5">
                    <span class="text-[#72686B]">Cetak Data</span>
                    <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                </button></a>
            <div class="rounded-lg shadow-[1px_1px_10px_rgba(0,0,0,0.1)] pt-4 pb-6 max-[1200px]:overflow-x-auto">
                <table class="table-auto text-center text-sm w-full max-[1200px]:w-[1200px]">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[10%]">No</th>
                        <th class="py-2 w-[20%]">Nama Proyek</th>
                        <th class="py-2 w-[18%]">Nilai Kontrak</th>
                        <th class="py-2 w-[18%]">Keuntungan</th>
                        <th class="py-2 w-[18%]">Real Untung</th>
                        <th class="py-2 2-[15%]">Detail</th>
                    </thead>
                    <tbody>
                        @foreach ($kontrak as $i => $item)
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">{{ $i + 1 }}</td>
                                <td class="py-2">{{ $item->nama_proyek }}</td>
                                <td class="py-2">Rp {{ number_format($item->nilai_kontrak, 0, ',', '.') }}</td>
                                <td class="py-2">Rp {{ number_format($item->keuntungan, 0, ',', '.') }}</td>
                                <td class="py-2">Rp {{ number_format($item->real_untung, 0, ',', '.') }}</td>
                                <td class="py-2">
                                    <button class="text-blue-400 hover:underline cursor-pointer font-medium"
                                        onclick="detailManagement(
                    '{{ $item->nama_proyek }}',
                    '{{ number_format($item->nilai_kontrak, 0, ',', '.') }}',
                    '{{ number_format($item->dpp, 0, ',', '.') }}',
                    '{{ number_format($item->ppn, 0, ',', '.') }}',
                    '{{ number_format($item->pph, 0, ',', '.') }}',
                    '{{ number_format($item->sisa_potong_pajak, 0, ',', '.') }}',
                    '{{ number_format($item->fee_dinas, 0, ',', '.') }}',
                    '{{ number_format($item->net, 0, ',', '.') }}',
                    '{{ number_format($item->keuntungan, 0, ',', '.') }}',
                    '{{ number_format($item->real_untung, 0, ',', '.') }}'
                )">
                                        Lihat Detail
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </section>
        <script>
            function detailManagement(nama, nilaiKontrak, dpp, ppn, pph, sisaPotong, feeDinas, net, keuntungan, realUntung) {
                Swal.fire({
                    html: `
            <section class="py-3">
                <h1 class="font-bold text-2xl mb-8 uppercase text-start max-[570px]:text-xl">Detail Data Management Proyek</h1>
                <div class="flex flex-col gap-y-5">
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:items-start max-[570px]:gap-y-2">
                        <span class="font-semibold w-[240px] text-start">Nama Proyek</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">${nama}</span>
                    </div>
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:items-start max-[570px]:gap-y-2">
                        <span class="font-semibold w-[240px] text-start">Nilai Kontrak</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp ${nilaiKontrak}</span>
                    </div>
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:items-start max-[570px]:gap-y-2">
                        <span class="font-semibold w-[240px] text-start">DPP</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp ${dpp}</span>
                    </div>
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:items-start max-[570px]:gap-y-2">
                        <span class="font-semibold w-[240px] text-start">PPN</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp ${ppn}</span>
                    </div>
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:items-start max-[570px]:gap-y-2">
                        <span class="font-semibold w-[240px] text-start">PPh</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp ${pph}</span>
                    </div>
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:items-start max-[570px]:gap-y-2">
                        <span class="font-semibold w-[240px] text-start">Sisa Potong Pajak</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp ${sisaPotong}</span>
                    </div>
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:items-start max-[570px]:gap-y-2">
                        <span class="font-semibold w-[240px] text-start">Fee Dinas</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp ${feeDinas}</span>
                    </div>
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:items-start max-[570px]:gap-y-2">
                        <span class="font-semibold w-[240px] text-start">Dana Target</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp ${net}</span>
                    </div>
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:items-start max-[570px]:gap-y-2">
                        <span class="font-semibold w-[240px] text-start">Keuntungan</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp ${keuntungan}</span>
                    </div>
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:items-start max-[570px]:gap-y-2">
                        <span class="font-semibold w-[240px] text-start">Real Untung</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp ${realUntung}</span>
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
