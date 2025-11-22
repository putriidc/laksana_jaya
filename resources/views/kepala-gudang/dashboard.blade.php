@extends('kepala-gudang.layout')
@section('content')
    <div>
        <h1 class="font-bold text-2xl mb-4">Dashboard</h1>
        <section class="flex flex-col gap-y-8">
            <div class="flex gap-x-8">
                <div class="flex flex-col shadow-[1px_1px_5px_rgba(0,0,0,0.25)] rounded-xl bg-white px-4 py-4 w-[380px] h-[300px] gap-y-3 justify-center items-center">
                    <img src="{{ asset('assets/dashboard-kepala-gudang/Frame 14.png') }}" alt="Stok Barang Image" class="w-[200px]">
                    <span class="font-bold">Update stok barang mu!</span>
                </div>
                <div class="flex flex-col h-[300px] w-full shadow-[1px_1px_5px_rgba(0,0,0,0.25)] rounded-xl bg-white px-4 py-4">
                    <span class="font-bold">Grafik barang masuk</span>
                    <div></div>
                </div>
            </div>
            <div class="w-full">
                <h1 class="font-bold text-2xl mb-4">Display Barang</h1>
                <section class="flex flex-wrap gap-2">
                    <div class="flex items-center justify-between w-[330px] h-[120px] border-[#DADADA] border-[3px] rounded-2xl py-4 pr-3 pl-1">
                        <img src="{{ asset('assets/dashboard-kepala-gudang/Rectangle 107.png') }}" alt="gambar barang" class="w-[100px]">
                        <div class="flex flex-col gap-y-1">
                            <h1 class="font-bold">Meja Display Inacraft</h1>
                            <p class="text-xs">Ukuran 150 cm x 220 cm, bahan kayu kaki kaki bahan kayu.</p>
                        </div>
                        <a href="" class="bg-white shadow-[0px_0px_5px_rgba(0,0,0,0.25)] px-[5px] h-full flex items-center rounded-lg">
                            <img src="{{ asset('assets/dashboard-kepala-gudang/arrow-right.png') }}" alt="arrow icon" class="w-[40px]">
                        </a>
                    </div>
                    <div class="flex items-center justify-between w-[330px] h-[120px] border-[#DADADA] border-[3px] rounded-2xl py-4 pr-3 pl-1">
                        <img src="{{ asset('assets/dashboard-kepala-gudang/Rectangle 107-1.png') }}" alt="gambar barang" class="w-[100px]">
                        <div class="flex flex-col gap-y-1">
                            <h1 class="font-bold">Meja Display Inacraft</h1>
                            <p class="text-xs">Ukuran 150 cm x 220 cm, bahan kayu kaki kaki bahan kayu.</p>
                        </div>
                        <a href="" class="bg-white shadow-[0px_0px_5px_rgba(0,0,0,0.25)] px-[5px] h-full flex items-center rounded-lg">
                            <img src="{{ asset('assets/dashboard-kepala-gudang/arrow-right.png') }}" alt="arrow icon" class="w-[40px]">
                        </a>
                    </div>
                    <div class="flex items-center justify-between w-[330px] h-[120px] border-[#DADADA] border-[3px] rounded-2xl py-4 pr-3 pl-1">
                        <img src="{{ asset('assets/dashboard-kepala-gudang/Rectangle 107-2.png') }}" alt="gambar barang" class="w-[100px]">
                        <div class="flex flex-col gap-y-1">
                            <h1 class="font-bold">Meja Display Inacraft</h1>
                            <p class="text-xs">Ukuran 150 cm x 220 cm, bahan kayu kaki kaki bahan kayu.</p>
                        </div>
                        <a href="" class="bg-white shadow-[0px_0px_5px_rgba(0,0,0,0.25)] px-[5px] h-full flex items-center rounded-lg">
                            <img src="{{ asset('assets/dashboard-kepala-gudang/arrow-right.png') }}" alt="arrow icon" class="w-[40px]">
                        </a>
                    </div>
                    <div class="flex items-center justify-between w-[330px] h-[120px] border-[#DADADA] border-[3px] rounded-2xl py-4 pr-3 pl-1">
                        <img src="{{ asset('assets/dashboard-kepala-gudang/Rectangle 107-3.png') }}" alt="gambar barang" class="w-[100px]">
                        <div class="flex flex-col gap-y-1">
                            <h1 class="font-bold">Meja Display Inacraft</h1>
                            <p class="text-xs">Ukuran 150 cm x 220 cm, bahan kayu kaki kaki bahan kayu.</p>
                        </div>
                        <a href="" class="bg-white shadow-[0px_0px_5px_rgba(0,0,0,0.25)] px-[5px] h-full flex items-center rounded-lg">
                            <img src="{{ asset('assets/dashboard-kepala-gudang/arrow-right.png') }}" alt="arrow icon" class="w-[40px]">
                        </a>
                    </div>
                    <div class="flex items-center justify-between w-[330px] h-[120px] border-[#DADADA] border-[3px] rounded-2xl py-4 pr-3 pl-1">
                        <img src="{{ asset('assets/dashboard-kepala-gudang/Rectangle 107-4.png') }}" alt="gambar barang" class="w-[100px]">
                        <div class="flex flex-col gap-y-1">
                            <h1 class="font-bold">Meja Display Inacraft</h1>
                            <p class="text-xs">Ukuran 150 cm x 220 cm, bahan kayu kaki kaki bahan kayu.</p>
                        </div>
                        <a href="" class="bg-white shadow-[0px_0px_5px_rgba(0,0,0,0.25)] px-[5px] h-full flex items-center rounded-lg">
                            <img src="{{ asset('assets/dashboard-kepala-gudang/arrow-right.png') }}" alt="arrow icon" class="w-[40px]">
                        </a>
                    </div>
                    <div class="flex items-center justify-between w-[330px] h-[120px] border-[#DADADA] border-[3px] rounded-2xl py-4 pr-3 pl-1">
                        <img src="{{ asset('assets/dashboard-kepala-gudang/Rectangle 107-5.png') }}" alt="gambar barang" class="w-[100px]">
                        <div class="flex flex-col gap-y-1">
                            <h1 class="font-bold">Meja Display Inacraft</h1>
                            <p class="text-xs">Ukuran 150 cm x 220 cm, bahan kayu kaki kaki bahan kayu.</p>
                        </div>
                        <a href="" class="bg-white shadow-[0px_0px_5px_rgba(0,0,0,0.25)] px-[5px] h-full flex items-center rounded-lg">
                            <img src="{{ asset('assets/dashboard-kepala-gudang/arrow-right.png') }}" alt="arrow icon" class="w-[40px]">
                        </a>
                    </div>
                    <div class="flex items-center justify-between w-[330px] h-[120px] border-[#DADADA] border-[3px] rounded-2xl py-4 pr-3 pl-1">
                        <img src="{{ asset('assets/dashboard-kepala-gudang/Rectangle 107-6.png') }}" alt="gambar barang" class="w-[100px]">
                        <div class="flex flex-col gap-y-1">
                            <h1 class="font-bold">Meja Display Inacraft</h1>
                            <p class="text-xs">Ukuran 150 cm x 220 cm, bahan kayu kaki kaki bahan kayu.</p>
                        </div>
                        <a href="" class="bg-white shadow-[0px_0px_5px_rgba(0,0,0,0.25)] px-[5px] h-full flex items-center rounded-lg">
                            <img src="{{ asset('assets/dashboard-kepala-gudang/arrow-right.png') }}" alt="arrow icon" class="w-[40px]">
                        </a>
                    </div>
                    <div class="flex items-center justify-between w-[330px] h-[120px] border-[#DADADA] border-[3px] rounded-2xl py-4 pr-3 pl-1">
                        <img src="{{ asset('assets/dashboard-kepala-gudang/Rectangle 107-7.png') }}" alt="gambar barang" class="w-[100px]">
                        <div class="flex flex-col gap-y-1">
                            <h1 class="font-bold">Meja Display Inacraft</h1>
                            <p class="text-xs">Ukuran 150 cm x 220 cm, bahan kayu kaki kaki bahan kayu.</p>
                        </div>
                        <a href="" class="bg-white shadow-[0px_0px_5px_rgba(0,0,0,0.25)] px-[5px] h-full flex items-center rounded-lg">
                            <img src="{{ asset('assets/dashboard-kepala-gudang/arrow-right.png') }}" alt="arrow icon" class="w-[40px]">
                        </a>
                    </div>
                    <div class="flex items-center justify-between w-[330px] h-[120px] border-[#DADADA] border-[3px] rounded-2xl py-4 pr-3 pl-1">
                        <img src="{{ asset('assets/dashboard-kepala-gudang/Rectangle 107-8.png') }}" alt="gambar barang" class="w-[100px]">
                        <div class="flex flex-col gap-y-1">
                            <h1 class="font-bold">Meja Display Inacraft</h1>
                            <p class="text-xs">Ukuran 150 cm x 220 cm, bahan kayu kaki kaki bahan kayu.</p>
                        </div>
                        <a href="" class="bg-white shadow-[0px_0px_5px_rgba(0,0,0,0.25)] px-[5px] h-full flex items-center rounded-lg">
                            <img src="{{ asset('assets/dashboard-kepala-gudang/arrow-right.png') }}" alt="arrow icon" class="w-[40px]">
                        </a>
                    </div>
                </section>
            </div>
        </section>
    </div>
@endsection