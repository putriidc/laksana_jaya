@extends('kepala-gudang.layout')
@section('content')
    <div>
        <h1 class="font-bold text-2xl mb-10">Detail Data Barang</h1>
        <div class="flex flex-col gap-y-7 pb-14 mb-8 border-b-2 border-[#B6B6B6]">
            <div class="flex">
                <span class="w-[120px]">Image</span>
                <div class="flex gap-x-14 w-full">
                    <img src="{{ asset('storage/' . $barang->foto) }}" alt="gambar barang"
                        class="w-44 h-44 object-cover rounded-md scale-125" />
                    <div class="flex flex-col w-full justify-between">
                        <div class="flex items-center">
                            <span class="w-[200px]">Tanggal Masuk</span>
                            <div class="bg-[#D9D9D9]/40 h-fit px-5 py-2 w-full rounded-lg">
                                {{ $barang->tanggal ?? '-' }}

                            </div>
                        </div>
                        <div class="flex items-center">
                            <span class="w-[200px]">Nama Barang</span>
                            <div class="bg-[#D9D9D9]/40 h-fit px-5 py-2 w-full rounded-lg">
                                {{ $barang->nama_barang }}
                            </div>
                        </div>
                        <div class="flex items-center">
                            <span class="w-[200px]">Kategori Barang</span>
                            <div class="bg-[#D9D9D9]/40 h-fit px-5 py-2 w-full rounded-lg">
                                {{ $barang->kategori }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center">
                <span class="w-[120px]">Spesifikasi</span>
                <div class="bg-[#D9D9D9]/40 h-fit px-5 py-2 w-full rounded-lg">
                    {{ $barang->spesifikasi }}
                </div>
            </div>
            <div class="flex items-center">
                <span class="w-[120px]">Satuan</span>
                <div class="bg-[#D9D9D9]/40 h-fit px-5 py-2 w-full rounded-lg">
                    {{ $barang->satuan }}
                </div>
            </div>
            <div class="flex items-center">
                <span class="w-[120px]">Stok</span>
                <div class="bg-[#D9D9D9]/40 h-fit px-5 py-2 w-full rounded-lg">
                    {{ $barang->stok }}
                </div>
            </div>
        </div>
        <div class="flex gap-x-4 mb-10">
            <a href="{{ route('barang-masuk.create.for-barang', $barang->kode_barang) }}"
                class="block bg-white border-2 border-[#9A9A9A] rounded-lg w-fit py-2 px-5">Tambah Stok +</a>
            <a href="{{ route('barang-keluar.create.for-barang', $barang->kode_barang) }}"
                class="block bg-white border-2 border-[#9A9A9A] rounded-lg w-fit py-2 px-5">Stok Keluar -</a>
            <a href="{{ route('barang-retur.create.for-barang', $barang->kode_barang) }}"
                class="bg-white border-2 border-[#9A9A9A] rounded-lg w-fit py-2 px-5 flex items-center gap-x-2">Return Stok
                <img src="{{ asset('assets/rotate-left.png') }}" alt="rotate icon" class="w-[18px] h-[18px]"></a>
        </div>
        <div class="border-b-2 border-[#B6B6B6] pb-8 mb-10">
            <h1 class="font-bold text-2xl mb-6">Data Stok Masuk</h1>
            {{-- Barang Masuk --}}
            <form method="GET" action="{{ route('barangs.show', $barang->id) }}" class="flex gap-x-2 mb-4">
                <input type="date" name="start_masuk" value="{{ request('start_masuk') }}"
                    class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2">
                <input type="date" name="end_masuk" value="{{ request('end_masuk') }}"
                    class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2">
                <button type="submit" class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2 bg-white">
                    <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" />
                </button>
                {{-- Print Barang Masuk --}}
                <a href="{{ route('barangs.printMasuk', ['id' => $barang->id, 'start_masuk' => request('start_masuk'), 'end_masuk' => request('end_masuk')]) }}"
                    target="_blank"
                    class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                    <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                </a>
            </form>
            <div class="rounded-lg shadow-[1px_1px_10px_rgba(0,0,0,0.1)] pt-4 pb-6">
                <table class="table-fixed text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[20%] pl-36">No</th>
                        <th class="py-2 w-[20%]">Tgl Masuk</th>
                        <th class="py-2 w-[20%]">Qty</th>
                        <th class="py-2 w-[20%]">Keterangan</th>
                        <th class="py-2 w-[25%] pr-36">Action</th>
                    </thead>
                    <tbody>
                        @php
                            $nomasuk = 1;
                        @endphp
                        @foreach ($barangMasuks as $item)
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2 pl-36">{{ $nomasuk++ }}</td>
                                <td class="py-2">{{ $item->tanggal }}</td>
                                <td class="py-2">{{ $item->qty }}</td>
                                <td class="py-2">{{ $item->keterangan }}</td>
                                <td class="py-2 pr-36">
                                    <div class="flex justify-center items-center gap-x-2 ">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('barang-masuk.edit', $item->id) }}"
                                            class="btn btn-sm btn-primary">
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
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="border-b-2 border-[#B6B6B6] pb-8 mb-10">
            <h1 class="font-bold text-2xl mb-6">Data Stok Keluar</h1>
            {{-- Barang Keluar --}}
            <form method="GET" action="{{ route('barangs.show', $barang->id) }}" class="flex gap-x-2 mb-4">
                <input type="date" name="start_keluar" value="{{ request('start_keluar') }}"
                    class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2">
                <input type="date" name="end_keluar" value="{{ request('end_keluar') }}"
                    class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2">
                <button type="submit" class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2 bg-white">
                    <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" />
                </button>
                {{-- Print Barang Keluar --}}
                <a href="{{ route('barangs.printKeluar', ['id' => $barang->id, 'start_keluar' => request('start_keluar'), 'end_keluar' => request('end_keluar')]) }}"
                    target="_blank"
                    class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                    <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                </a>
            </form>
            <div class="rounded-lg shadow-[1px_1px_10px_rgba(0,0,0,0.1)] pt-4 pb-6">
                <table class="table-fixed text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[20%] pl-36">No</th>
                        <th class="py-2 w-[20%]">Tgl Keluar</th>
                        <th class="py-2 w-[20%]">Qty</th>
                        <th class="py-2 w-[20%]">Keterangan</th>
                        <th class="py-2 w-[25%] pr-36">Action</th>
                    </thead>
                    <tbody>
                        @php
                            $nokeluar = 1;
                        @endphp
                        @foreach ($barangKeluars as $item)
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2 pl-36">{{ $nokeluar++ }}</td>
                                <td class="py-2">{{ $item->tanggal }}</td>
                                <td class="py-2">{{ $item->qty }}</td>
                                <td class="py-2">{{ $item->keterangan }}</td>
                                <td class="py-2 pr-36">
                                    <div class="flex justify-center items-center gap-x-2 ">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('barang-keluar.edit', $item->id) }}"
                                            class="btn btn-sm btn-primary">
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
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="border-b-2 border-[#B6B6B6] pb-8 mb-10">
            <h1 class="font-bold text-2xl mb-6">Data Return Stok</h1>
            {{-- Barang Retur --}}
            <form method="GET" action="{{ route('barangs.show', $barang->id) }}" class="flex gap-x-2 mb-4">
                <input type="date" name="start_retur" value="{{ request('start_retur') }}"
                    class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2">
                <input type="date" name="end_retur" value="{{ request('end_retur') }}"
                    class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2">
                <button type="submit" class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2 bg-white">
                    <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" />
                </button>
                {{-- Print Barang Retur --}}
                <a href="{{ route('barangs.printRetur', ['id' => $barang->id, 'start_retur' => request('start_retur'), 'end_retur' => request('end_retur')]) }}"
                    target="_blank"
                    class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                    <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                </a>
            </form>
            <div class="rounded-lg shadow-[1px_1px_10px_rgba(0,0,0,0.1)] pt-4 pb-6">
                <table class="table-fixed text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[20%] pl-36">No</th>
                        <th class="py-2 w-[20%]">Tgl Retur</th>
                        <th class="py-2 w-[20%]">Qty</th>
                        <th class="py-2 w-[20%]">Keterangan</th>
                        <th class="py-2 w-[25%] pr-36">Action</th>
                    </thead>
                    <tbody>
                        @php
                            $noretur = 1;
                        @endphp
                        @foreach ($barangReturs as $item)
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2 pl-36">{{ $noretur++ }}</td>
                                <td class="py-2">{{ $item->tanggal }}</td>
                                <td class="py-2">{{ $item->qty }}</td>
                                <td class="py-2">{{ $item->keterangan }}</td>
                                <td class="py-2 pr-36">
                                    <div class="flex justify-center items-center gap-x-2 ">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('barang-retur.edit', $item->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                                class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        {{-- Tombol Delete --}}
                                        <form action="{{ route('barang-retur.destroy', $item->id) }}" method="POST"
                                            class="h-[22px]">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                    class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
