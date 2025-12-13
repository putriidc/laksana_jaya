@extends('kepala-gudang.layout') @section('content')
    <div>
        <div class="flex flex-col mb-6">
        <section class="mb-5 pb-10 border-b-2 border-[#B6B6B6]">
            <h1 class="font-bold text-2xl mb-4 text-[#C0C0C0]">Form Pengajuan EAF</h1>
            <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6">
                <table class="table-auto text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[5%]">No</th>
                        <th class="py-2 w-[10%]">Tgl Pengajuan</th>
                        <th class="py-2 w-[15%]">Nama Proyek</th>
                        <th class="py-2 w-[15%]">PIC</th>
                        <th class="py-2 w-[20%]">Nominal</th>
                        <th class="py-2 w-[15%]">Keterangan</th>
                        <th class="py-2 w-[20%]">Action</th>
                    </thead>
                    <tbody>
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">1</td>
                                <td class="py-2">11/02/2025</td>
                                <td class="py-2">Proyek Pa Dwi</td>
                                <td class="py-2">Rhama</td>
                                <td class="py-2">Rp. 5.000.000</td>
                                <td class="py-2">
                                    <span onclick="detailBiaya()" class="hover:underline text-blue-400 cursor-pointer">Lihat Detail</span>
                                </td>
                                <td class="py-2 flex justify-center items-center">
                                    <form action="" class="flex items-center gap-x-2">
                                        <button type="submit" class="bg-[#8CE987] px-4 py-2 rounded-lg cursor-pointer">Accept</button>
                                        <button type="button" class="bg-[#DD4049] px-4 py-2 rounded-lg cursor-pointer text-white" onclick="modalDecline()">Decline</button>
                                    </form>
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <section class="mb-5">
            <h1 class="font-bold text-2xl mb-4 text-[#C0C0C0]">Form ACC EAF</h1>
            <a href="" class="px-4 py-2 border-2 border-[#9A9A9A] rounded-lg w-fit flex items-center gap-x-2 mb-4">
                <span class="text-[#72686B]">Cetak Laporan</span>
                <img src="{{ asset('assets/printer.png') }}" alt="printer icon">
            </a>
            <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6">
                <table class="table-auto text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[5%]">No</th>
                        <th class="py-2 w-[10%]">Tgl Pengajuan</th>
                        <th class="py-2 w-[15%]">Nama Proyek</th>
                        <th class="py-2 w-[15%]">PIC</th>
                        <th class="py-2 w-[20%]">Nominal</th>
                        <th class="py-2 w-[15%]">Keterangan</th>
                        <th class="py-2 w-[15%]">Action</th>
                    </thead>
                    <tbody>
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">1</td>
                                <td class="py-2">11/02/2025</td>
                                <td class="py-2">Aby</td>
                                <td class="py-2">Pengajuan Kasbon</td>
                                <td class="py-2">Rp. 500.000</td>
                                <td class="py-2">
                                    <span onclick="detailBiaya()" class="hover:underline text-blue-400 cursor-pointer">Lihat Detail</span>
                                </td>
                                <td class="py-2 flex justify-center items-center">
                                    <span class="bg-[#8CE987] px-4 py-2 rounded-lg cursor-pointer">Accept</span>
                                </td>
                            </tr>
                            <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">1</td>
                                <td class="py-2">11/02/2025</td>
                                <td class="py-2">Aby</td>
                                <td class="py-2">Pengajuan Kasbon</td>
                                <td class="py-2">Rp. 500.000</td>
                                <td class="py-2">
                                    <span onclick="detailBiaya()" class="hover:underline text-blue-400 cursor-pointer">Lihat Detail</span>
                                </td>
                                <td class="py-2 flex justify-center items-center">
                                    <span class="bg-[#DD4049] px-4 py-2 rounded-lg cursor-pointer">Decline</span>
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <script>
            function modalDecline() {
                Swal.fire({
                    html: `
                        <form action="" method="POST" id="form-tambah" class="flex gap-x-4 w-full justify-center items-center h-[100px]">
                            @csrf
                            <a href="/create-pengajuan" class="bg-[#8CE987] px-4 py-2 rounded-lg cursor-pointer">Ajukan Nominal Baru</a>
                            <button type="submit" class="bg-[#DD4049] px-4 py-2 rounded-lg cursor-pointer">Tolak Pengajuan</button>
                        </form>
                    `,
                    showCancelButton: false,
                    showCloseButton: false,
                    showConfirmButton: false,
                    
                })
            }

            function detailBiaya() {
            Swal.fire({
                html: `
                    <div class="flex flex-col gap-y-4 items-center">
                        <h1 class="font-bold text-2xl text-center mb-5">Detail Biaya</h1>
                        <div class="px-4 py-4 bg-[#D9D9D9]/40 w-full">
                            Uang Makan : Rp. 1.500.000,
                            Biaya Material : Rp. 1.300.000,
                            Sisa Kas Pak Dwi : Rp. 200.000,
                        </div>
                    </div>
                `,
                showCloseButton: true,
                showConfirmButton: false,
            })
        }
        </script>
    </div>
@endsection
