@extends('owner.layout')
@section('content')
<div>
    <div>
        <h1 class="text-2xl font-bold mb-5 pb-5 border-b border-gray-400">Data Proyek Barang & Jasa</h1>
    </div>
    <div class="pb-5 border-b border-gray-400 mb-8">
        <h1 class="text-2xl font-bold mb-5 uppercase">CV ARN PURNAMA CONS</h1>
        <form action="" method="post" class="flex justify-between items-center gap-x-1 mb-5">
            <div class="flex items-center gap-x-2">
                <div class="w-[180px] px-1 border-[#9A9A9A] border-2 rounded-lg">
                    <select name="" id="" class="w-full cursor-pointer outline-none py-2">
                        <option selected disabled>Cari Nama Paket</option>
                        <option value="">Cari Nama</option>
                        <option value="">Cari Nama</option>
                    </select>
                </div>
                <button type="submit" class="border-2 border-[#9A9A9A] py-[10px] px-[10px] rounded-lg cursor-pointer">
                    <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" class="w-[20px]">
                </button>
            </div>
            <a href="" class="border-2 border-[#9A9A9A] py-2 px-2 rounded-lg cursor-pointer flex items-center gap-x-2 text-[#726868]">
                <span>Cetak Data</span>
                <img src="{{ asset('assets/printer.png') }}" alt="printer icon">
            </a>
        </form>
        <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6">
            <table class="table-fixed text-center text-sm w-full">
                <thead class="border-b-2 border-[#CCCCCC]">
                    <th class="w-[5%] py-2">No</th>
                    <th class="w-[10%] py-2">Tgl Mulai</th>
                    <th class="w-[10%] py-2">Tgl Selesai</th>
                    <th class="w-[15%] py-2">Nama Proyek</th>
                    <th class="w-[20%] py-2">No Kontrak</th>
                    <th class="w-[15%] py-2">Jenis Pekerjaan</th>
                    <th class="w-[15%] py-2">Nilai Kontrak</th>
                    <th class="w-[10%] py-2">Action</th>
                </thead>
                <tbody>
                    <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                        <td class="py-2">1</td>
                        <td class="py-2">11/12/2025</td>
                        <td class="py-2">25/12/2025</td>
                        <td class="py-2">Mulshola Indag</td>
                        <td class="py-2">11/PP/BPA-ST/VI/2025</td>
                        <td class="py-2">Swasta</td>
                        <td class="py-2">Rp. 123,456,789</td>
                        <td class="py-2">
                            <div class="flex items-center gap-x-2 justify-center">
                                {{-- Tombol Edit --}}
                                <a href="/detail-barang-jasa" class="btn btn-sm btn-primary">
                                    <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                        class="w-[22px] cursor-pointer">
                                </a>
                                <span class="border-black border-l-[1px] h-[22px]"></span>
                                {{-- Tombol Delete --}}
                                <form action="" method="POST"
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
                    <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                        <td class="py-2">2</td>
                        <td class="py-2">11/12/2025</td>
                        <td class="py-2">25/12/2025</td>
                        <td class="py-2">EO Bu iin</td>
                        <td class="py-2">11/PP/BPA-ST/VI/2025</td>
                        <td class="py-2">Swasta</td>
                        <td class="py-2">Rp. 123,456,789</td>
                        <td class="py-2">
                            <div class="flex items-center gap-x-2 justify-center">
                                {{-- Tombol Edit --}}
                                <a href="/detail-barang-jasa" class="btn btn-sm btn-primary">
                                    <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                        class="w-[22px] cursor-pointer">
                                </a>
                                <span class="border-black border-l-[1px] h-[22px]"></span>
                                {{-- Tombol Delete --}}
                                <form action="" method="POST"
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
                </tbody>
            </table>
        </div>
    </div>
    <div class="pb-5 border-b border-gray-400 mb-8">
        <h1 class="text-2xl font-bold mb-5 uppercase">CV ARN GUMILANG</h1>
        <form action="" method="post" class="flex justify-between items-center gap-x-1 mb-5">
            <div class="flex items-center gap-x-2">
                <div class="w-[180px] px-1 border-[#9A9A9A] border-2 rounded-lg">
                    <select name="" id="" class="w-full cursor-pointer outline-none py-2">
                        <option selected disabled>Cari Nama Paket</option>
                        <option value="">Cari Nama</option>
                        <option value="">Cari Nama</option>
                    </select>
                </div>
                <button type="submit" class="border-2 border-[#9A9A9A] py-[10px] px-[10px] rounded-lg cursor-pointer">
                    <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" class="w-[20px]">
                </button>
            </div>
            <a href="" class="border-2 border-[#9A9A9A] py-2 px-2 rounded-lg cursor-pointer flex items-center gap-x-2 text-[#726868]">
                <span>Cetak Data</span>
                <img src="{{ asset('assets/printer.png') }}" alt="printer icon">
            </a>
        </form>
        <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6">
            <table class="table-fixed text-center text-sm w-full">
                <thead class="border-b-2 border-[#CCCCCC]">
                    <th class="w-[5%] py-2">No</th>
                    <th class="w-[10%] py-2">Tgl Mulai</th>
                    <th class="w-[10%] py-2">Tgl Selesai</th>
                    <th class="w-[15%] py-2">Nama Proyek</th>
                    <th class="w-[20%] py-2">No Kontrak</th>
                    <th class="w-[15%] py-2">Jenis Pekerjaan</th>
                    <th class="w-[15%] py-2">Nilai Kontrak</th>
                    <th class="w-[10%] py-2">Action</th>
                </thead>
                <tbody>
                    <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                        <td class="py-2">1</td>
                        <td class="py-2">11/12/2025</td>
                        <td class="py-2">25/12/2025</td>
                        <td class="py-2">Mulshola Indag</td>
                        <td class="py-2">11/PP/BPA-ST/VI/2025</td>
                        <td class="py-2">Swasta</td>
                        <td class="py-2">Rp. 123,456,789</td>
                        <td class="py-2">
                            <div class="flex items-center gap-x-2 justify-center">
                                {{-- Tombol Edit --}}
                                <a href="/detail-barang-jasa" class="btn btn-sm btn-primary">
                                    <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                        class="w-[22px] cursor-pointer">
                                </a>
                                <span class="border-black border-l-[1px] h-[22px]"></span>
                                {{-- Tombol Delete --}}
                                <form action="" method="POST"
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
                    <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                        <td class="py-2">2</td>
                        <td class="py-2">11/12/2025</td>
                        <td class="py-2">25/12/2025</td>
                        <td class="py-2">EO Bu iin</td>
                        <td class="py-2">11/PP/BPA-ST/VI/2025</td>
                        <td class="py-2">Swasta</td>
                        <td class="py-2">Rp. 123,456,789</td>
                        <td class="py-2">
                            <div class="flex items-center gap-x-2 justify-center">
                                {{-- Tombol Edit --}}
                                <a href="/detail-barang-jasa" class="btn btn-sm btn-primary">
                                    <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                        class="w-[22px] cursor-pointer">
                                </a>
                                <span class="border-black border-l-[1px] h-[22px]"></span>
                                {{-- Tombol Delete --}}
                                <form action="" method="POST"
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
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection