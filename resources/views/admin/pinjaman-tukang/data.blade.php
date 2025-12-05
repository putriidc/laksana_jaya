@extends('admin.layout')
@section('content')
<div>
    <h1 class="font-bold text-2xl mb-6">Pinjaman Tukang</h1>
    <div class="flex items-center gap-x-4 mb-6 pb-6 border-b-2 border-[#B6B6B6]">
        <a href="/create-tukang" class="px-4 py-2 border-2 border-[#9A9A9A] rounded-lg">Tambah Data +</a>
        <a href="" class="px-4 py-2 border-2 border-[#9A9A9A] rounded-lg flex items-center gap-x-2">
            <span class="text-[#72686B]">Cetak Semua Data</span>
            <img src="{{ asset('assets/printer.png') }}" alt="printer icon">
        </a>
    </div>
    <div class="flex flex-col mb-8">
        <h1 class="font-bold text-2xl">Pengajuan Pinjaman</h1>
        <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6 mt-4">
            <table class="table-auto text-center text-sm w-full">
                <thead class="border-b-2 border-[#CCCCCC]">
                    <th class="py-2 w-[5%]">No</th>
                    <th class="py-2 w-[10%]">Tgl Pengajuan</th>
                    <th class="py-2 w-[15%]">Nama Tukang</th>
                    <th class="py-2 w-[15%]">Status</th>
                    <th class="py-2 w-[20%]">Jumlah Pinjaman</th>
                    <th class="py-2 w-[10%]">Action</th>
                </thead>
                <tbody>
                        <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                            <td class="py-2">1</td>
                            <td class="py-2">11/02/2025</td>
                            <td class="py-2">Aby</td>
                            <td class="py-2">Pengajuan Kasbon</td>
                            <td class="py-2">Rp. 500.000</td>
                            <td class="py-2 flex justify-center items-center">
                                <form action="" class="flex items-center gap-x-2">
                                    <span class="bg-[#999999] px-4 py-2 rounded-lg cursor-pointer text-white/60">Pending</span>
                                    <button class="bg-[#DD4049] px-4 py-2 rounded-lg cursor-pointer text-white" id="modal-decline">Decline</button>
                                </form>
                            </td>
                        </tr>
                        <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                            <td class="py-2">1</td>
                            <td class="py-2">11/02/2025</td>
                            <td class="py-2">Aby</td>
                            <td class="py-2">Pengajuan Kasbon</td>
                            <td class="py-2">Rp. 500.000</td>
                            <td class="py-2 flex justify-center items-center">
                                <form action="" class="flex items-center gap-x-2">
                                    <button class="bg-[#8CE987] px-4 py-2 rounded-lg cursor-pointer">Accept</button>
                                    <button class="bg-[#DD4049] px-4 py-2 rounded-lg cursor-pointer text-white" id="modal-decline">Decline</button>
                                </form>
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="flex flex-col">
        <h1 class="font-bold text-2xl">Data Pinjaman</h1>
        <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6 mt-4">
            <table class="table-auto text-center text-sm w-full">
                <thead class="border-b-2 border-[#CCCCCC]">
                    <th class="py-2 w-[5%] pl-[100px]">No</th>
                    <th class="py-2 w-[15%]">Nama Tukang</th>
                    <th class="py-2 w-[15%]">Proyek</th>
                    <th class="py-2 w-[20%]">Jumlah Kasbon</th>
                    <th class="py-2 w-[10%] pr-[100px]">Action</th>
                </thead>
                <tbody>
                        <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                            <td class="py-2 pl-[100px]">1</td>
                            <td class="py-2">Aby</td>
                            <td class="py-2">Proyek Pak Dwi</td>
                            <td class="py-2">Rp. 5.000.000</td>
                            <td class="flex justify-center items-center gap-x-2 py-2 pr-[100px]">
                                <div class="flex items-center gap-x-2">
                                        {{-- Tombol Edit --}}
                                        <a href="/detail-pinjaman-tukang" class="btn btn-sm btn-primary">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                                class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>

                                        {{-- Tombol Delete --}}
                                        <form action="" method="POST"
                                            class="h-[22px]">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                    class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                </div>
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection