@extends('admin.layout')
@section('content')
<div class="flex flex-col items-center">
    <h1 class="text-2xl font-bold mb-4 w-full">Form Pengembalian Kasbon</h1>
    <div class="shadow-[0px_0px_15px_rgba(0,0,0,0.25)] w-full p-10 rounded-lg bg-white">
        <form method="POST" action="{{ route('kasbonContents.storeBayar') }}" class="flex flex-col gap-y-4">
            @csrf
            <input type="hidden" name="kode_karyawan" value="{{ $pinjaman->id }}">
            <div class="flex items-center">
                <label for="" class="w-[240px] font-medium">Tgl Pengembalian</label>
                <input value="{{ $today }}" type="date" name="tanggal" id="" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2" readonly>
            </div>
            <div class="flex items-center">
                <label for="" class="w-[240px] font-medium">Kontrak</label>
                <input type="text" name="kontrak" id="" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>
            <div class="flex items-center">
                <label for="" class="w-[240px] font-medium">Jumlah Pengembalian</label>
                <input type="number" name="bayar" id="" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>
            <div class="flex mt-4">
                <div class="w-[240px]"></div>
                <div class="w-full flex gap-x-2">
                    <button type="submit" class="bg-[#FFF494] px-6 py-2 rounded-lg cursor-pointer">Simpan Data</button>
                    <button class="bg-[#FFB7B7] px-6 py-2 rounded-lg cursor-pointer">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
