@extends('owner.layout')
@section('content')
    <div>
        <h1 class="font-bold text-2xl mb-4">Data Management Proyek</h1>
        <section>
            <a href="{{ route('pinjamanKaryawans.create') }}"><button class="cursor-pointer px-5 py-2 border-[#9A9A9A] border-2 rounded-lg flex items-center gap-x-2 bg-white mb-5">
                <span class="text-[#72686B]">Cetak Data</span>
                <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
            </button></a>
            <div class="rounded-lg shadow-[1px_1px_10px_rgba(0,0,0,0.1)] pt-4 pb-6">
                <table class="table-auto text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[10%]">No</th>
                        <th class="py-2 w-[20%]">Nama Proyek</th>
                        <th class="py-2 w-[18%]">Nilai Kontrak</th>
                        <th class="py-2 w-[18%]">Keuntungan</th>
                        <th class="py-2 w-[18%]">Real Untung</th>
                        <th class="py-2 2-[15%]">Detail</th>
                    </thead>
                    <tbody>
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">1</td>
                                <td class="py-2">Bapenda</td>
                                <td class="py-2">Rp. 199.230.000</td>
                                <td class="py-2">Rp. 154.789.146</td>
                                <td class="py-2">Rp. 31.661.416</td>
                                <td class="py-2">
                                    <button class="text-blue-400 hover:underline cursor-pointer font-medium" onclick="detailManagement()">Lihat Detail</button>
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <script>
            function detailManagement() {
               Swal.fire({
                    html: `
                        <section class="py-3">
                            <h1 class="font-bold text-2xl mb-8 uppercase text-start">Detail Data Management Proyek</h1>
                            <div class="flex flex-col gap-y-5">
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold w-[240px] text-start">Nama Proyek</span>
                                    <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Bapenda</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold w-[240px] text-start">Nilai Kontrak</span>
                                    <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp. 199.230.000</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold w-[240px] text-start">DPP</span>
                                    <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp. 179.486.486</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold w-[240px] text-start">PPN</span>
                                    <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp. 19.743.514</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold w-[240px] text-start">PPh</span>
                                    <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp. 3.589.730</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold w-[240px] text-start">Sisa Potong Pajak</span>
                                    <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp. 175.896.757</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold w-[240px] text-start">Fee Dinas</span>
                                    <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp. 21.107.611</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold w-[240px] text-start">Dana Target</span>
                                    <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp. 123.127.730</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold w-[240px] text-start">Keuntungan</span>
                                    <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp. 154.789.146</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold w-[240px] text-start">Real Untung</span>
                                    <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp. 31.661.416</span>
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
