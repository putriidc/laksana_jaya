@extends('kepala-gudang.layout') @section('content')
    <div>
        <h1 class="font-bold text-2xl mb-4">Data Barang</h1>
        <div class="flex justify-between items-center mb-6">
            <a href="" class="block px-4 py-2 border-2 border-[#9A9A9A] rounded-lg">Input Barang +</a>
            <form action="" class="flex items-center gap-x-2" id="myForm">
                    <input type="text" name="" id="" class="w-[200px] appearance-none border-[#9A9A9A] border-2 outline-none rounded-lg py-[8px] px-[10px] bg-white cursor-pointer" placeholder="Cari Nama/Kategori">
                    <button type="submit"
                        class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                        <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" class="w-[20px]">
                    </button>
                    <a href=""
                        class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                        <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                    </a>
                </form>

        </div>
                <section class="flex flex-wrap gap-2">
                    <div class="flex items-center justify-between w-[320px] h-[120px] border-[#DADADA] border-[3px] rounded-2xl py-4 pr-3 pl-1">
                        <img src="{{ asset('assets/dashboard-kepala-gudang/Rectangle 107.png') }}" alt="gambar barang" class="w-[100px]">
                        <div class="flex flex-col gap-y-1">
                            <h1 class="font-bold">Meja Display Inacraft</h1>
                            <p class="text-xs">Ukuran 150 cm x 220 cm, bahan kayu kaki kaki bahan kayu.</p>
                        </div>
                        <a href="/detail-barang" class="bg-white shadow-[0px_0px_5px_rgba(0,0,0,0.25)] px-[5px] h-full flex items-center rounded-lg">
                            <img src="{{ asset('assets/dashboard-kepala-gudang/arrow-right.png') }}" alt="arrow icon" class="w-[40px]">
                        </a>
                    </div>
                    <div class="flex items-center justify-between w-[320px] h-[120px] border-[#DADADA] border-[3px] rounded-2xl py-4 pr-3 pl-1">
                        <img src="{{ asset('assets/dashboard-kepala-gudang/Rectangle 107-1.png') }}" alt="gambar barang" class="w-[100px]">
                        <div class="flex flex-col gap-y-1">
                            <h1 class="font-bold">Meja Display Inacraft</h1>
                            <p class="text-xs">Ukuran 150 cm x 220 cm, bahan kayu kaki kaki bahan kayu.</p>
                        </div>
                        <a href="/detail-barang" class="bg-white shadow-[0px_0px_5px_rgba(0,0,0,0.25)] px-[5px] h-full flex items-center rounded-lg">
                            <img src="{{ asset('assets/dashboard-kepala-gudang/arrow-right.png') }}" alt="arrow icon" class="w-[40px]">
                        </a>
                    </div>
                    <div class="flex items-center justify-between w-[320px] h-[120px] border-[#DADADA] border-[3px] rounded-2xl py-4 pr-3 pl-1">
                        <img src="{{ asset('assets/dashboard-kepala-gudang/Rectangle 107-2.png') }}" alt="gambar barang" class="w-[100px]">
                        <div class="flex flex-col gap-y-1">
                            <h1 class="font-bold">Meja Display Inacraft</h1>
                            <p class="text-xs">Ukuran 150 cm x 220 cm, bahan kayu kaki kaki bahan kayu.</p>
                        </div>
                        <a href="/detail-barang" class="bg-white shadow-[0px_0px_5px_rgba(0,0,0,0.25)] px-[5px] h-full flex items-center rounded-lg">
                            <img src="{{ asset('assets/dashboard-kepala-gudang/arrow-right.png') }}" alt="arrow icon" class="w-[40px]">
                        </a>
                    </div>
                    <div class="flex items-center justify-between w-[320px] h-[120px] border-[#DADADA] border-[3px] rounded-2xl py-4 pr-3 pl-1">
                        <img src="{{ asset('assets/dashboard-kepala-gudang/Rectangle 107-3.png') }}" alt="gambar barang" class="w-[100px]">
                        <div class="flex flex-col gap-y-1">
                            <h1 class="font-bold">Meja Display Inacraft</h1>
                            <p class="text-xs">Ukuran 150 cm x 220 cm, bahan kayu kaki kaki bahan kayu.</p>
                        </div>
                        <a href="/detail-barang" class="bg-white shadow-[0px_0px_5px_rgba(0,0,0,0.25)] px-[5px] h-full flex items-center rounded-lg">
                            <img src="{{ asset('assets/dashboard-kepala-gudang/arrow-right.png') }}" alt="arrow icon" class="w-[40px]">
                        </a>
                    </div>
                    <div class="flex items-center justify-between w-[320px] h-[120px] border-[#DADADA] border-[3px] rounded-2xl py-4 pr-3 pl-1">
                        <img src="{{ asset('assets/dashboard-kepala-gudang/Rectangle 107-4.png') }}" alt="gambar barang" class="w-[100px]">
                        <div class="flex flex-col gap-y-1">
                            <h1 class="font-bold">Meja Display Inacraft</h1>
                            <p class="text-xs">Ukuran 150 cm x 220 cm, bahan kayu kaki kaki bahan kayu.</p>
                        </div>
                        <a href="/detail-barang" class="bg-white shadow-[0px_0px_5px_rgba(0,0,0,0.25)] px-[5px] h-full flex items-center rounded-lg">
                            <img src="{{ asset('assets/dashboard-kepala-gudang/arrow-right.png') }}" alt="arrow icon" class="w-[40px]">
                        </a>
                    </div>
                    <div class="flex items-center justify-between w-[320px] h-[120px] border-[#DADADA] border-[3px] rounded-2xl py-4 pr-3 pl-1">
                        <img src="{{ asset('assets/dashboard-kepala-gudang/Rectangle 107-5.png') }}" alt="gambar barang" class="w-[100px]">
                        <div class="flex flex-col gap-y-1">
                            <h1 class="font-bold">Meja Display Inacraft</h1>
                            <p class="text-xs">Ukuran 150 cm x 220 cm, bahan kayu kaki kaki bahan kayu.</p>
                        </div>
                        <a href="/detail-barang" class="bg-white shadow-[0px_0px_5px_rgba(0,0,0,0.25)] px-[5px] h-full flex items-center rounded-lg">
                            <img src="{{ asset('assets/dashboard-kepala-gudang/arrow-right.png') }}" alt="arrow icon" class="w-[40px]">
                        </a>
                    </div>
                    <div class="flex items-center justify-between w-[320px] h-[120px] border-[#DADADA] border-[3px] rounded-2xl py-4 pr-3 pl-1">
                        <img src="{{ asset('assets/dashboard-kepala-gudang/Rectangle 107-6.png') }}" alt="gambar barang" class="w-[100px]">
                        <div class="flex flex-col gap-y-1">
                            <h1 class="font-bold">Meja Display Inacraft</h1>
                            <p class="text-xs">Ukuran 150 cm x 220 cm, bahan kayu kaki kaki bahan kayu.</p>
                        </div>
                        <a href="/detail-barang" class="bg-white shadow-[0px_0px_5px_rgba(0,0,0,0.25)] px-[5px] h-full flex items-center rounded-lg">
                            <img src="{{ asset('assets/dashboard-kepala-gudang/arrow-right.png') }}" alt="arrow icon" class="w-[40px]">
                        </a>
                    </div>
                    <div class="flex items-center justify-between w-[320px] h-[120px] border-[#DADADA] border-[3px] rounded-2xl py-4 pr-3 pl-1">
                        <img src="{{ asset('assets/dashboard-kepala-gudang/Rectangle 107-7.png') }}" alt="gambar barang" class="w-[100px]">
                        <div class="flex flex-col gap-y-1">
                            <h1 class="font-bold">Meja Display Inacraft</h1>
                            <p class="text-xs">Ukuran 150 cm x 220 cm, bahan kayu kaki kaki bahan kayu.</p>
                        </div>
                        <a href="/detail-barang" class="bg-white shadow-[0px_0px_5px_rgba(0,0,0,0.25)] px-[5px] h-full flex items-center rounded-lg">
                            <img src="{{ asset('assets/dashboard-kepala-gudang/arrow-right.png') }}" alt="arrow icon" class="w-[40px]">
                        </a>
                    </div>
                    <div class="flex items-center justify-between w-[320px] h-[120px] border-[#DADADA] border-[3px] rounded-2xl py-4 pr-3 pl-1">
                        <img src="{{ asset('assets/dashboard-kepala-gudang/Rectangle 107-8.png') }}" alt="gambar barang" class="w-[100px]">
                        <div class="flex flex-col gap-y-1">
                            <h1 class="font-bold">Meja Display Inacraft</h1>
                            <p class="text-xs">Ukuran 150 cm x 220 cm, bahan kayu kaki kaki bahan kayu.</p>
                        </div>
                        <a href="/detail-barang" class="bg-white shadow-[0px_0px_5px_rgba(0,0,0,0.25)] px-[5px] h-full flex items-center rounded-lg">
                            <img src="{{ asset('assets/dashboard-kepala-gudang/arrow-right.png') }}" alt="arrow icon" class="w-[40px]">
                        </a>
                    </div>
                </section>
    </div>
@endsection
