@extends('owner.layout')
@section('content')
    <div>
        <h1 class="font-bold text-2xl mb-4 uppercase">Resume Proyek</h1>
        <section>
            <a href="{{ route('pinjamanKaryawans.create') }}"><button class="cursor-pointer px-5 py-2 border-[#9A9A9A] border-2 rounded-lg flex items-center gap-x-2 bg-white mb-5">
                <span class="text-[#72686B]">Cetak Data</span>
                <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
            </button></a>
            <div class="rounded-lg shadow-[1px_1px_10px_rgba(0,0,0,0.1)] pt-4 pb-6">
                <table class="table-auto text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[15%]">No</th>
                        <th class="py-2 w-[20%]">Tgl Mulai</th>
                        <th class="py-2 w-[25%]">Nama Proyek</th>
                        <th class="py-2 w-[15%]">Status</th>
                        <th class="py-2 2-[10%]">Detail</th>
                    </thead>
                    <tbody>
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">1</td>
                                <td class="py-2">11/12/2025</td>
                                <td class="py-2">Kantor AR4N</td>
                                <td class="py-2">
                                    <span class="bg-[#DD4049] px-5 py-1 rounded-xl">FULL</span>
                                </td>
                                <td class="py-2">
                                    <button class="text-blue-400 hover:underline cursor-pointer font-medium" onclick="detailResume()">Lihat Detail</button>
                                </td>
                            </tr>
                            <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
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
                            </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <script>
            function detailResume() {
               Swal.fire({
                    html: `
                        <section class="py-3">
                            <h1 class="font-bold text-2xl mb-8 uppercase text-start">Detail Resume Proyek</h1>
                            <div class="flex flex-col gap-y-5">
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold w-[240px] text-start">Nama Proyek</span>
                                    <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Kantor AR4N</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold w-[240px] text-start">Tanggal Mulai</span>
                                    <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">11/12/2025</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold w-[240px] text-start">Total Pengeluaran</span>
                                    <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp. 10.261.000</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold w-[240px] text-start">Piutang Vendor</span>
                                    <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp. 24.858.000</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold w-[240px] text-start">Total TP + PV</span>
                                    <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp. 10.261.000</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold w-[240px] text-start">Jenis Proyek</span>
                                    <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">PEMDA</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold w-[240px] text-start">NETT</span>
                                    <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp. 10.000.000</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold w-[240px] text-start">Persentage</span>
                                    <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">103%</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold w-[240px] text-start">Sisa</span>
                                    <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">- Rp. 261.000</span>
                                </div>
                                <div class="flex justify-start items-center">
                                    <span class="font-semibold w-[160px] text-start">Status</span>
                                    <span class="bg-[#F9E52D] px-8 py-2 rounded-xl text-black">CAREFULL</span>
                                </div>
                            </div>
                        </section>
                    `,
                    width: 600,
                    showCancelButton: false,
                    showConfirmButton: false,
                    showCloseButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kirim data ke server
                        const form = document.getElementById('form-tambah');
                        // Periksa apakah form ditemukan
                        if (form) {
                            // PENTING: Submit form secara paksa
                            form.submit();
                        } else {
                            // Handle jika form tidak ditemukan (jarang terjadi)
                            Swal.fire('Error!', 'Form tidak ditemukan.', 'error');
                        }
                    }
                })
            }
        </script>
    </div>
@endsection
