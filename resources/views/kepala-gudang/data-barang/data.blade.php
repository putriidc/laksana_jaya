@extends('kepala-gudang.layout') @section('content')
    <div>
        <h1 class="font-bold text-2xl mb-6">Data Barang</h1>
        <section>
            <div class="flex items-center pb-4 justify-between">
                <div class="flex gap-x-2">
                    <a href="{{ route('barangs.create') }}"
                        class="block border-[#9A9A9A] border-2 rounded-lg px-4 py-2 shadow-[0px_0px_10px_rgba(0,0,0,0.1)]">Tambah
                        Barang +</a>
                    {{-- <a
                    href="/kepala-gudang/output-data-barang"
                    class="block border-[#9A9A9A] border-2 rounded-lg px-4 py-2 shadow-[0px_0px_10px_rgba(0,0,0,0.1)]"
                    >Barang Keluar -</a
                > --}}
                </div>
                <form action="" class="flex items-center gap-x-2" id="myForm">
                    <input type="text" name="" id="" placeholder="Cari Nama/Kategori"
                        class="border-[#9A9A9A] border-2 outline-none bg-white rounded-lg py-[8px] px-4" />
                    <button type="submit"
                        class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                        <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" class="w-[20px]" />
                    </button>
                    <a href=""
                        class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                        <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]" />
                    </a>
                </form>
            </div>
            <div class="rounded-lg shadow-[1px_1px_10px_rgba(0,0,0,0.1)] pt-4 pb-6">
                <table class="table-fixed text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[5%]">No</th>
                        <th class="py-2 w-[15%]">Nama Barang</th>
                        <th class="py-2 w-[15%]">Kategori</th>
                        <th class="py-2 w-[20%]">Spesifikasi</th>
                        <th class="py-2 w-[8%]">Satuan</th>
                        <th class="py-2 w-[8%]">Stok</th>
                        <th class="py-2 w-[20%]">Foto</th>
                        <th class="py-2 w-[10%]">Action</th>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($barangs as $item)
                            <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">{{ $no++ }}</td>
                                <td class="py-2">{{ $item->nama_barang }}</td>
                                <td class="py-2">{{ $item->kategori }}</td>
                                <td class="py-2">{{ $item->spesifikasi }}</td>
                                <td class="py-2">{{ $item->satuan }}</td>
                                <td class="py-2">{{ $item->stok }}</td>
                                <td class="py-2">
                                    @if ($item->foto)
                                        <a href="{{ asset('storage/' . $item->foto) }}" target="_blank"
                                            class="text-blue-600 underline">
                                            Lihat Foto
                                        </a>
                                    @else
                                        <span class="text-gray-500">Tidak ada foto</span>
                                    @endif
                                </td>
                                <td class="flex justify-center items-center gap-x-2 py-2">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('barangs.edit', $item->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                                class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        {{-- Tombol Delete --}}
                                        <form action="{{ route('barangs.destroy', $item->id) }}" method="POST"
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
