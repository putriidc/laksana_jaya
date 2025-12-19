@extends('owner.layout')
@section('content')
<div>
    <div class="mb-5 flex items-center justify-between pb-5 border-b-2 border-[#CCCCCC]">
        <h1 class="text-2xl font-bold">Data Neraca</h1>
        <select name="" id="" class="py-2 w-[200px] px-4 appearance-none border-2 border-[#9A9A9A] rounded-xl cursor-pointer outline-none">
            <option disabled selected>-Pilih Data Neraca-</option>
            <option value="neraca-lajur">Neraca Lajur</option>
            <option value="neraca-saldo">Neraca Saldo</option>
        </select>
    </div>
    <div>
        <div class="flex justify-between items-center mb-5">
            <h1 class="text-2xl font-bold">Neraca Lajur</h1>
            <a href="" class="flex items-center gap-x-2 border-2 border-[#9A9A9A] rounded-lg px-4 py-2">
                <span class="text-[#72686B]">Cetak Laporan</span>
                <img src="{{ asset('assets/printer.png') }}" alt="">
            </a>
        </div>
        <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6">
        <table class="table-fixed text-center text-sm w-full">
            <thead class="border-b-2 border-[#CCCCCC]">
                <th class="w-[10%] py-2">Kode Akun</th>
                <th class="w-[10%] py-2">Nama Akun</th>
                <th class="w-[25%] py-2">POST Saldo</th>
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
</div>
@endsection