@extends('kepala-gudang.layout')
@section('content')
    <div class="flex flex-col items-center">
        <h1 class="text-2xl font-bold mb-6 w-full">Edit Data Barang Keluar</h1>
        <div class="shadow-[0px_0px_15px_rgba(0,0,0,0.25)] w-full p-10 rounded-lg bg-white">
            <form method="POST" action="{{ route('barang-keluar.update', $barangMasuk->id) }}" class="flex flex-col gap-y-4">
                @csrf
                @method('PUT')

                <div class="flex items-center max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-2">
                    <label class="w-[180px] font-medium">Tgl Keluar</label>
                    <input type="date" name="tanggal" value="{{ $barangMasuk->tanggal }}"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                </div>

                <div class="flex items-center max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-2">
                    <label class="w-[180px] font-medium">Nama Barang</label>
                    <input type="text" value="{{ $barangMasuk->barang->nama_barang }}"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2" readonly>
                    <input type="hidden" name="kode_barang" value="{{ $barangMasuk->kode_barang }}">
                </div>


                <div class="flex items-center max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-2">
                    <label class="w-[180px] font-medium">Keterangan</label>
                    <input type="text" name="keterangan" value="{{ $barangMasuk->keterangan }}"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                </div>

                <div class="flex items-center max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-2">
                    <label class="w-[180px] font-medium">Jumlah keluar</label>
                    <input type="number" name="qty" value="{{ $barangMasuk->qty }}"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                </div>

                <div class="flex mt-4">
                    <div class="w-[180px] max-[600px]:hidden"></div>
                    <div class="w-full flex gap-x-2">
                        <button type="submit" class="bg-[#FFF494] px-6 py-2 rounded-lg cursor-pointer">Update Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
