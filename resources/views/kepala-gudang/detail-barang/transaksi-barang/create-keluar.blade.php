@extends('kepala-gudang.layout')
@section('content')
    <div class="flex flex-col items-center">
        <h1 class="text-2xl font-bold mb-6 w-full">Data Barang Keluar</h1>
        <div class="shadow-[0px_0px_15px_rgba(0,0,0,0.25)] w-full p-10 rounded-lg bg-white">
            <form method="POST" action="{{ route('barang-keluar.store') }}" class="flex flex-col gap-y-4">
                @csrf
                <div class="flex items-center">
                    <label for="" class="w-[180px] font-medium">Tgl Keluar</label>
                    <input type="date" name="tanggal" id="" value="{{ $today }}" readonly
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                </div>
                 <div class="flex items-center">
                    <label class="w-[180px] font-medium">Nama Barang</label>
                    <input type="text" value="{{ $barang->nama_barang }}"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2" readonly />

                    <!-- Hidden input untuk kirim kode_barang -->
                    <input type="hidden" name="kode_barang" value="{{ $barang->kode_barang }}">
                </div>
                <div class="flex items-center">
                    <label for="" class="w-[180px] font-medium">Keterangan</label>
                    <input type="text" name="keterangan" id=""
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                </div>
                <div class="flex items-center">
                    <label for="" class="w-[180px] font-medium">Jumlah Keluar</label>
                    <input type="number" name="qty" id=""
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                </div>
                <div class="flex mt-4">
                    <div class="w-[180px]"></div>
                    <div class="w-full flex gap-x-2">
                        <button type="submit" class="bg-[#FFF494] px-6 py-2 rounded-lg cursor-pointer">Simpan Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
