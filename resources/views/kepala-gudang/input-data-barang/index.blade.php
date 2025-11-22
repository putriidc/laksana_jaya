@extends('kepala-gudang.layout')
@section('content')
<div class="flex flex-col items-center">
    <h1 class="text-2xl font-bold mb-6 w-full">Input Data Barang</h1>
    <div class="shadow-[0px_0px_15px_rgba(0,0,0,0.25)] w-full p-10 rounded-lg bg-white">
        <form action="" class="flex flex-col gap-y-4">
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Tgl Masuk</label>
                <input type="date" name="" id="" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Nama Barang</label>
                <input type="text" name="" id="" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Kategori Barang</label>
                <select name="" id="" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 appearance-none cursor-pointer">
                    <option selected>Pilih Nama Karyawan</option>
                    <option value="Piutang">Piutang</option>
                    <option value="Hutang">Hutang</option>
                    <option value="PIC">PIC</option> 
                    {{-- pada bagian pic masih di pertanyakan --}}
                </select>
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Spesifikasi</label>
                <input type="text" name="" id="" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Satuan</label>
                <input type="text" name="" id="" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Stok</label>
                <input type="text" name="" id="" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Image</label>
                <input type="file" name="" id="" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>
            <div class="flex mt-4">
                <div class="w-[180px]"></div>
                <div class="w-full flex gap-x-2">
                    <button type="submit" class="bg-[#FFF494] px-6 py-2 rounded-lg cursor-pointer">Simpan Data</button>
                    <button class="bg-[#FFB7B7] px-6 py-2 rounded-lg cursor-pointer">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection