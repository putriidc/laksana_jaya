@extends('kepala-gudang.layout') @section('content')
    <div>
        <h1 class="font-bold text-2xl mb-4">Data Barang</h1>
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('barangs.create') }}" class="block px-4 py-2 border-2 border-[#9A9A9A] rounded-lg">Input Barang
                +</a>
            <form action="" class="flex items-center gap-x-2" id="myForm">
                <input type="text" name="" id=""
                    class="w-[200px] appearance-none border-[#9A9A9A] border-2 outline-none rounded-lg py-[8px] px-[10px] bg-white cursor-pointer"
                    placeholder="Cari Nama/Kategori">
                <button type="submit"
                    class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                    <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" class="w-[20px]">
                </button>
                <a href="" class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                    <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                </a>
            </form>

        </div>
        <section class="flex flex-wrap gap-2">
            @foreach ($barangs as $item)
            <div
                class="flex items-center justify-between w-[320px] h-[120px] border-[#DADADA] border-[3px] rounded-2xl py-4 pr-3 pl-1">
                <img src="{{ asset('storage/' . $item->foto) }}" alt="gambar barang"
                    class="w-[100px]">
                <div class="flex flex-col gap-y-1">
                    <h1 class="font-bold">{{ $item->nama_barang }}</h1>
                    <p class="text-xs">{{ $item->spesifikasi }}</p>
                </div>
                <a href="{{ route('barangs.show', $item->id) }}"
                    class="bg-white shadow-[0px_0px_5px_rgba(0,0,0,0.25)] px-[5px] h-full flex items-center rounded-lg">
                    <img src="{{ asset('assets/dashboard-kepala-gudang/arrow-right.png') }}" alt="arrow icon"
                        class="w-[40px]">
                </a>
            </div>
            @endforeach
        </section>
    </div>
@endsection
