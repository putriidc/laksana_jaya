@extends('owner.layout')
@section('content')
    <div>
        <h1 class="font-bold text-2xl mb-6">Data Proyek Pengawas</h1>
        @if (session('success'))
            <div
                id="flash-message"
                data-type="success"
                data-message="{{ session('success') }}"
            ></div>
        @elseif (session('error'))
            <div
                id="flash-message"
                data-type="error"
                data-message="{{ session('error') }}"
            ></div>
        @endif
        <section>
            <div class="flex items-center pb-4 w-full justify-between border-b">
                <form action="" class="flex items-center gap-x-2">
                    <select id="select-beast" placeholder="Pilih Nama" autocomplete="off"
                        class="w-[200px] appearance-none border-[#9A9A9A] border-2 outline-none rounded-lg py-[8px] px-[10px] bg-white cursor-pointer">
                        <option selected>Cari Nama Paket</option>
                        <option value="1">Aby</option>
                        <option value="2">Budi</option>
                        <option value="3">Citra</option>
                        <option value="4">Deni</option>
                        <option value="5">Eka</option>
                    </select>
                    <button type="submit"
                        class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                        <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" class="w-[20px]">
                    </button>
                </form>
                <div class="flex items-center gap-x-2">
                    <a href="{{ route('pinjamanKaryawans.create') }}"><button class="cursor-pointer px-4 py-2 border-[#9A9A9A] border-2 rounded-lg flex items-center gap-x-2 bg-white">
                        <span class="text-[#72686B]">Cetak Semua Data</span>
                        <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                    </button></a>
                </div>
            </div>
             <h1 class="font-bold text-2xl my-4">CV ARS GUMILANG</h1>
            <div class="rounded-lg shadow-[1px_1px_10px_rgba(0,0,0,0.1)] pt-4 pb-6">
                <table class="table-auto text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[5%]">No</th>
                        <th class="py-2 w-[20%]">Nama Paket</th>
                        <th class="py-2 w-[10%]">PIC</th>
                        <th class="py-2 w-[12%]">No Hp</th>
                        <th class="py-2 w-[10%]">MC 0</th>
                        <th class="py-2 w-[10%]">Korlap</th>
                        <th class="py-2 w-[15%]">Kontraktor</th>
                        <th class="py-2 w-[10%]">Total Progress</th>
                        <th class="py-2 2-[5%]">Action</th>
                    </thead>
                    <tbody>
                            <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">1</td>
                                <td class="py-2">Peningkatan Jaringan Irigasi Saluran Tersier Simangu Kec. Talun</td>
                                <td class="py-2">Sudirman</td>
                                <td class="py-2">0822-3226-6660</td>
                                <td class="py-2">12/11/2025</td>
                                <td class="py-2">Bapak Fikri</td>
                                <td class="py-2">CV. JOMBANG KARYA</td>
                                <td class="py-2">40%</td>
                                <td class="py-2">
                                    <div class="flex items-center justify-center w-[90px] m-auto">
                                    {{-- Tombol Detail --}}
                                    <a href="/detail-progress"
                                        class="btn btn-sm btn-primary">
                                        <img src="{{ asset('assets/more-circle.png') }}" alt="detail icon"
                                            class="w-[25px] cursor-pointer">
                                    </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">1</td>
                                <td class="py-2">Peningkatan Jaringan Irigasi Saluran Tersier Simangu Kec. Talun</td>
                                <td class="py-2">Sudirman</td>
                                <td class="py-2">0822-3226-6660</td>
                                <td class="py-2">12/11/2025</td>
                                <td class="py-2">Bapak Fikri</td>
                                <td class="py-2">CV. JOMBANG KARYA</td>
                                <td class="py-2">40%</td>
                                <td class="py-2">
                                    <div class="flex items-center justify-center w-[90px] m-auto">
                                    {{-- Tombol Detail --}}
                                    <a href="/detail-progress"
                                        class="btn btn-sm btn-primary">
                                        <img src="{{ asset('assets/more-circle.png') }}" alt="detail icon"
                                            class="w-[25px] cursor-pointer">
                                    </a>
                                    </div>
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
