@extends('admin.layout')
@section('content')
    <div>
        <h1 class="font-bold text-2xl mb-6">Pinjaman Karyawan</h1>
        <section>
            <div class="flex items-center pb-4 w-full justify-between">
                    <form action="" class="flex items-center gap-x-2">
                        <select id="select-beast" placeholder="Pilih Nama" autocomplete="off" class="w-[200px] appearance-none border-[#9A9A9A] border-2 outline-none rounded-lg py-[8px] px-[10px] bg-white cursor-pointer">
                            <option selected>Pilih Nama</option>
                            <option value="1">Aby</option>
                            <option value="2">Budi</option>
                            <option value="3">Citra</option>
                            <option value="4">Deni</option>
                            <option value="5">Eka</option>
                        </select>
                        <button type="submit" class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                            <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" class="w-[20px]">
                        </button>
                    </form>
                    <div class="flex items-center gap-x-2">
                        <a href="/admin/pinjawan-karyawan/create"><button class="cursor-pointer px-4 py-2 border-[#9A9A9A] border-2 rounded-lg">Tambah Data +</button></a>
                        <a href="" class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                            <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                        </a>
                    </div>
                </div>
                <div class="rounded-lg shadow-[1px_1px_10px_rgba(0,0,0,0.1)] pt-4 pb-6">
                    <table class="table-auto text-center text-sm w-full">
                        <thead class="border-b-2 border-[#CCCCCC]">
                            <th class="py-2 pl-[150px]">No</th>
                            <th class="py-2">Nama Karyawan</th>
                            <th class="py-2">Sisa Pinjaman</th>
                            <th class="py-2">Sisa Kasbon</th>
                            <th class="py-2 pr-[150px]">Action</th>
                        </thead>
                        <tbody>
                            <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2 pl-[150px]">1</td>
                                <td class="py-2">Aby</td>
                                <td class="py-2">Rp. 5.000.000</td>
                                <td class="py-2">Rp. 1.650.000</td>
                                <td class="flex justify-center items-center gap-x-2 py-2 pr-[150px]">
                                        <a href="/admin/pinjawan-karyawan/detail" class="">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="more circle icon" class="w-[20px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        <form action="" class=" h-[22px]">
                                            <button type="submit">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="trash icon" class="w-[20px] cursor-pointer">
                                            </button>
                                        </form>
                                    </td>
                            </tr>
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2 pl-[150px]">2</td>
                                <td class="py-2">Aby naya putra</td>
                                <td class="py-2">Rp. 5.000.000</td>
                                <td class="py-2">Rp. 1.650.000</td>
                                <td class="flex justify-center items-center gap-x-2 py-2 pr-[150px]">
                                        <a href="" class="">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="more circle icon" class="w-[20px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        <form action="" class=" h-[22px]">
                                            <button type="submit">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="trash icon" class="w-[20px] cursor-pointer">
                                            </button>
                                        </form>
                                    </td>
                            </tr>
                            <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2 pl-[150px]">3</td>
                                <td class="py-2">Aby naya putra</td>
                                <td class="py-2">Rp. 5.000.000</td>
                                <td class="py-2">Rp. 1.650.000</td>
                                <td class="flex justify-center items-center gap-x-2 py-2 pr-[150px]">
                                        <a href="" class="">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="more circle icon" class="w-[20px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        <form action="" class=" h-[22px]">
                                            <button type="submit">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="trash icon" class="w-[20px] cursor-pointer">
                                            </button>
                                        </form>
                                    </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        </section>
    </div>
@endsection