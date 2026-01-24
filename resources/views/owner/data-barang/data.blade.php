@extends('owner.layout') @section('content')
    <div>
        <h1 class="font-bold text-2xl mb-4">Data Barang</h1>
        <div class="flex justify-between items-center mb-6 max-[600px]:flex-col max-[600px]:gap-y-2 max-[600px]:items-start">
            <a href="{{ route('barangsOwner.create') }}" class="block px-4 py-2 border-2 border-[#9A9A9A] rounded-lg">Input Barang
                +</a>
            <form method="GET" action="{{ route('barangsOwner.index') }}" class="flex items-center gap-x-2" id="myForm">
                <input type="text" name="q"
                    class="w-[200px] appearance-none border-[#9A9A9A] border-2 outline-none rounded-lg py-[8px] px-[10px] bg-white cursor-pointer"
                    placeholder="Cari Nama/Kategori" value="{{ request('q') }}">
                <button type="submit"
                    class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                    <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" class="w-[20px]">
                </button>
                <a target="_blank" href="{{ route('barang-owner.print') }}" class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                    <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                </a>
            </form>

        </div>
        <section class="flex flex-wrap gap-2">
            @foreach ($barangs as $item)
                <div
                    class="flex items-center justify-between w-[320px] h-[120px] border-[#DADADA] border-[3px] rounded-2xl py-4 px-3">
                    <div class="rounded-lg w-auto overflow-hidden">
                        <img src="{{ asset('storage/' . $item->foto) }}" alt="gambar barang" class=" h-[65px] w-[65px]">
                    </div>
                    <div class="flex flex-col gap-y-1 w-[60%]">
                        <h1 class="font-bold">{{ $item->nama_barang }}</h1>
                        <p class="text-xs w-full truncate">{{ $item->spesifikasi }}</p>
                    </div>
                    <a href="{{ route('barangsOwner.show', $item->id) }}"
                        class="bg-white shadow-[0px_0px_5px_rgba(0,0,0,0.25)] px-[5px] h-full flex items-center rounded-lg">
                        <img src="{{ asset('assets/dashboard-kepala-gudang/arrow-right.png') }}" alt="arrow icon"
                            class="w-[30px]">
                    </a>
                </div>
            @endforeach
        </section>
    </div>
@endsection
