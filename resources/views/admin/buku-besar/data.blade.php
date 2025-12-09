@extends('admin.layout')
@section('content')
<div>
    <h1 class="text-2xl font-bold mb-5">Buku Besar</h1>
    <div class="flex items-center justify-between mb-5">
        <select name="" id="" class="px-4 py-2 w-[200px] border-[#9A9A9A] border-2 rounded-lg appearance-none cursor-pointer">
            <option selected disabled>-Pilih Data Transaksi-</option>
        </select>
        <form action="" method="post" class="flex items-center gap-x-1">
            <input type="text" data-flatpickr placeholder="Tanggal Mulai" name="" id="" class="w-[180px] px-4 py-2 border-[#9A9A9A] border-2 rounded-lg">
            <input type="text" data-flatpickr placeholder="Tanggal Selesai" name="" id="" class="w-[180px] px-4 py-2 border-[#9A9A9A] border-2 rounded-lg">
            <button type="submit" class="border-2 border-[#9A9A9A] py-2 px-2 rounded-lg cursor-pointer">
                <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" class="">
            </button>
            <a href="" class="border-2 border-[#9A9A9A] py-2 px-2 rounded-lg cursor-pointer">
                <img src="{{ asset('assets/printer.png') }}" alt="printer icon">
            </a>
        </form>
    </div>
    <div class="flex justify-end items-center gap-x-5 mb-5">
        <div class="flex items-center gap-x-2">
            <span class="text-[#9A9A9A] font-medium">Kode Akun</span>
            <span class="bg-[#E6E6E6] px-10 py-1 rounded-lg font-medium">111</span>
        </div>
        <div class="flex items-center gap-x-2">
            <span class="text-[#9A9A9A] font-medium">Post Saldo</span>
            <span class="bg-[#E6E6E6] px-10 py-1 rounded-lg font-medium">Debet</span>
        </div>
    </div>
    <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6">
        <table class="table-fixed text-center text-sm w-full">
            <thead class="border-b-2 border-[#CCCCCC]">
                <th class="w-[10%] py-2">No</th>
                <th class="w-[10%] py-2">Tanggal</th>
                <th class="w-[25%] py-2">Keterangan</th>
                <th class="w-[15%] py-2">Debet</th>
                <th class="w-[15%] py-2">Kredit</th>
                <th class="w-[15%] py-2">Saldo</th>
            </thead>
            <tbody>
                <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                    <td class="py-2">1</td>
                    <td class="py-2">2025/12/09</td>
                    <td class="py-2">Mutasi dari bank BCA ke Kas Besar</td>
                    <td class="py-2">Rp. 5.000.000</td>
                    <td class="py-2">Rp. 5.000.000</td>
                    <td class="py-2">Rp. 5.000.000</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection