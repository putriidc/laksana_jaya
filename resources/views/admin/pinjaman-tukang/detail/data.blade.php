@extends('admin.layout')
@section('content')
<div>
    <h1 class="font-bold text-2xl mb-6">Pinjaman Tukang</h1>
    <div class="flex items-center gap-x-2 mb-6 pb-6 border-b-2 border-[#B6B6B6]">
        <div class="flex items-center gap-x-2">
            <span class="text-[#72686B]">Nama Karyawan</span>
            <div class="border-[#9A9A9A] border-2 px-6 py-2 rounded-lg font-bold">
                Mang Sarkin
            </div>
        </div>
        <a href="" class="px-2 py-2 border-2 border-[#9A9A9A] rounded-lg flex items-center gap-x-2">
            <img src="{{ asset('assets/printer.png') }}" alt="printer icon">
        </a>
    </div>
    <div class="flex flex-col mb-8">
        <div class="flex justify-between items-center">
            <h1 class="font-bold text-2xl">Pengajuan Pinjaman</h1>
            <a href="/pengembalian-tukang" class="border-2 border-[#9A9A9A] px-4 py-2 flex items-center gap-x-4 rounded-lg">
                <span>Bayar Pinjaman</span>
                <img src="{{ asset('assets/card-receive.png') }}" alt="card receive icon" class="w-[20px] h-[20px]">
            </a>
        </div>
        <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6 mt-4">
            <table class="table-auto text-center text-sm w-full">
                <thead class="border-b-2 border-[#CCCCCC]">
                    <th class="py-2 w-[5%]">No</th>
                    <th class="py-2 w-[15%]">Kontrak</th>
                    <th class="py-2 w-[10%]">Tgl Pinjaman</th>
                    <th class="py-2 w-[10%]">Tgl Cicilan</th>
                    <th class="py-2 w-[15%]">Jumlah Pinjaman</th>
                    <th class="py-2 w-[15%]">Cicilan Pinjaman</th>
                    <th class="py-2 w-[15%]">Sisa Pinjaman</th>
                    <th class="py-2 w-[10%]">Action</th>
                </thead>
                <tbody>
                        <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                            <td class="py-2">1</td>
                            <td class="py-2">Kontrak Pinjaman I</td>
                            <td class="py-2">11/02/2025</td>
                            <td class="py-2">11/02/2025</td>
                            <td class="py-2">Rp. 500.000</td>
                            <td class="py-2">Rp. 500.000</td>
                            <td class="py-2">Rp. 500.000</td>
                            <td class="py-2 flex justify-center items-center">
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