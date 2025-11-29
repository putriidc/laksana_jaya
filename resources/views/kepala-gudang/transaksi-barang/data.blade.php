@extends('kepala-gudang.layout') @section('content')
    <div>
        <div class="flex flex-col mb-6">
            <h1 class="font-bold text-2xl mb-4">Data keluar/Masuk Barang</h1>
            <div class="flex items-center justify-between">
                <form action="" class="flex gap-x-2">
                    <input type="text" name="" id="" placeholder="Tanggal Mulai" data-flatpickr
                        class="border-2 border-[#9A9A9A] px-3 py-2 rounded-lg outline-none w-[180px]" />
                    <input type="text" name="" id="" placeholder="Tanggal Selesai" data-flatpickr
                        class="border-2 border-[#9A9A9A] px-3 py-2 rounded-lg outline-none w-[180px]" />
                    <button type="submit"
                        class="border-2 border-[#9A9A9A] px-3 py-2 rounded-lg bg-white cursor-pointer cursor-pointer">
                        <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" class="w-[20px]" />
                    </button>
                </form>
                <form action="" class="flex gap-x-2">
                    <input type="text" name="" id="" placeholder="Cari Kategori/Nama"
                        class="border-2 border-[#9A9A9A] px-3 py-2 rounded-lg outline-none" />
                    <button type="submit"
                        class="border-2 border-[#9A9A9A] px-3 py-2 rounded-lg bg-white cursor-pointer cursor-pointer">
                        <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" class="w-[20px]" />
                    </button>
                    <a href=""
                        class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                        <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]" />
                    </a>
                </form>
            </div>
        </div>
        <section class="mb-5 pb-6 border-b-2 border-[#B6B6B6]">
            <h1 class="font-bold text-2xl mb-4">Data Masuk Barang</h1>
            <div class="flex gap-x-2">
                <a href="{{ route('barang-masuk.create') }}"
                    class="block border-[#9A9A9A] border-2 rounded-lg px-4 py-2 shadow-[0px_0px_10px_rgba(0,0,0,0.1)]">
                    Barang Masuk +</a>
            </div>
            <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6">
                <table class="table-auto text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[5%]">No</th>
                        <th class="py-2 w-[10%]">Tgl Masuk</th>
                        <th class="py-2 w-[15%]">Nama Barang</th>
                        <th class="py-2 w-[15%]">Kategori</th>
                        <th class="py-2 w-[20%]">keterangan</th>
                        <th class="py-2 w-[10%]">Qty</th>
                        <th class="py-2 w-[10%]">Action</th>
                    </thead>
                    <tbody>
                        @php
                            $noMasuk = 1;
                            $noKeluar = 1;
                        @endphp
                        @foreach ($barangMasuks as $item)
                            <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">{{ $noMasuk++ }}</td>
                                <td class="py-2">{{ $item->tanggal }}</td>
                                <td class="py-2">{{ $item->barang->nama_barang }}</td>
                                <td class="py-2">{{ $item->barang->kategori }}</td>
                                <td class="py-2">{{ $item->keterangan }}</td>
                                <td class="py-2">{{ $item->qty }}</td>
                                <td class="flex justify-center items-center gap-x-2 py-2">
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('barang-masuk.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                        <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                            class="w-[22px] cursor-pointer">
                                    </a>
                                    <span class="border-black border-l-[1px] h-[22px]"></span>
                                    {{-- Tombol Delete --}}
                                    <form action="{{ route('barang-masuk.destroy', $item->id) }}" method="POST"
                                        class="h-[22px]">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                            <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                class="w-[22px] cursor-pointer">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
        <section class="mb-5">
            <h1 class="font-bold text-2xl mb-4">Data Keluar Barang</h1>
            <div class="flex justify-between items-center mb-5">
                <form action="" class="flex gap-x-2">
                    <input type="text" name="" id="" placeholder="Tanggal Mulai" data-flatpickr
                        class="border-2 border-[#9A9A9A] px-3 py-2 rounded-lg outline-none w-[180px]" />
                    <input type="text" name="" id="" placeholder="Tanggal Selesai" data-flatpickr
                        class="border-2 border-[#9A9A9A] px-3 py-2 rounded-lg outline-none w-[180px]" />
                    <button type="submit"
                        class="border-2 border-[#9A9A9A] px-3 py-2 rounded-lg bg-white cursor-pointer cursor-pointer">
                        <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" class="w-[20px]" />
                    </button>
                </form>
                <form action="" class="flex gap-x-2">
                    <input type="text" name="" id="" placeholder="Cari Kategori/Nama"
                        class="border-2 border-[#9A9A9A] px-3 py-2 rounded-lg outline-none" />
                    <button type="submit"
                        class="border-2 border-[#9A9A9A] px-3 py-2 rounded-lg bg-white cursor-pointer cursor-pointer">
                        <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" class="w-[20px]" />
                    </button>
                    <a href=""
                        class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                        <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]" />
                    </a>
                </form>
            </div>
            <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6">
                <div class="flex gap-x-2">
                    <a href="{{ route('barang-keluar.create') }}"
                        class="block border-[#9A9A9A] border-2 rounded-lg px-4 py-2 shadow-[0px_0px_10px_rgba(0,0,0,0.1)]">
                        Barang Keluar -</a>
                </div>
                <table class="table-auto text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[5%]">No</th>
                        <th class="py-2 w-[10%]">Tgl Masuk</th>
                        <th class="py-2 w-[15%]">Nama Barang</th>
                        <th class="py-2 w-[15%]">Kategori</th>
                        <th class="py-2 w-[20%]">keterangan</th>
                        <th class="py-2 w-[10%]">Qty</th>
                        <th class="py-2 w-[10%]">Action</th>
                    </thead>
                    <tbody>
                        @foreach ($barangKeluars as $item)
                            <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">{{ $noKeluar++ }}</td>
                                <td class="py-2">{{ $item->tanggal }}</td>
                                <td class="py-2">{{ $item->barang->nama_barang }}</td>
                                <td class="py-2">{{ $item->barang->kategori }}</td>
                                <td class="py-2">{{ $item->keterangan }}</td>
                                <td class="py-2">{{ $item->qty }}</td>
                                <td class="flex justify-center items-center gap-x-2 py-2">
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('barang-keluar.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                        <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                            class="w-[22px] cursor-pointer">
                                    </a>
                                    <span class="border-black border-l-[1px] h-[22px]"></span>
                                    {{-- Tombol Delete --}}
                                    <form action="{{ route('barang-keluar.destroy', $item->id) }}" method="POST"
                                        class="h-[22px]">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                            <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                class="w-[22px] cursor-pointer">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
