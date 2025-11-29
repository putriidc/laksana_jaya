@extends('kepala-gudang.layout')
@section('content')
    <div class="flex flex-col items-center">
        <h1 class="text-2xl font-bold mb-6 w-full">Data Barang Masuk</h1>
        <div class="shadow-[0px_0px_15px_rgba(0,0,0,0.25)] w-full p-10 rounded-lg bg-white">
            <form method="POST" action="{{ route('barang-masuk.store') }}" class="flex flex-col gap-y-4">
                @csrf
                <div class="flex items-center">
                    <label for="" class="w-[180px] font-medium">Tgl Masuk</label>
                    <input type="date" name="tanggal" id=""
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                </div>
                <div class="flex items-center">
                    <label for="" class="w-[180px] font-medium">Nama Barang</label>
                    <select name="kode_barang" id=""
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 appearance-none cursor-pointer">
                        @if ($barangs->isEmpty())
                            <option value="" disabled selected>
                                Belum ada barang, harap masukkan atau buat barang terlebih dahulu.
                            </option>
                        @else
                        <option value="" disabled selected>
                                - Pilih Barang -
                            </option>
                            @foreach ($barangs as $barang)
                                <option value="{{ $barang->kode_barang }}">
                                    {{ $barang->nama_barang }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="flex items-center">
                    <label for="" class="w-[180px] font-medium">Keterangan</label>
                    <input type="text" name="keterangan" id=""
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                </div>
                <div class="flex items-center">
                    <label for="" class="w-[180px] font-medium">Jumlah Masuk</label>
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
