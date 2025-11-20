@extends('admin.layout')
@section('content')
    <div>
        <h1 class="font-bold text-2xl mb-6">Jurnal Umum</h1>
        <section>
            <div class="flex justify-between items-center pb-4">
                    <a href="/admin/jurnal-umum/create" class="border-[#9A9A9A] border-2 rounded-lg px-4 py-2 shadow-[0px_0px_10px_rgba(0,0,0,0.1)]">
                        <button class="cursor-pointer">Tambah Data +</button>
                    </a>
                    <form action="" class="flex items-center gap-x-2">
                        <input type="text" name="" data-flatpickr placeholder="Tgl Mulai" class="border-[#9A9A9A] border-2 rounded-lg py-2 px-4 outline-none">
                        <input type="text" name="" data-flatpickr placeholder="Tgl Selesai" class="border-[#9A9A9A] border-2 rounded-lg py-2 px-4 outline-none">
                        <button type="submit" class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                            <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" class="w-[20px]">
                        </button>
                        <a href="" class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                            <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                        </a>
                    </form>
                </div>
                <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6">
                    <table class="table-fixed text-center text-sm w-full">
                        <thead class="border-b-2 border-[#CCCCCC]">
                            <th class="w-[10%] py-2">Tanggal</th>
                            <th class="w-[22%] py-2">Keterangan</th>
                            <th class="w-[13%] py-2">Nama Perkiraan</th>
                            <th class="w-[6%] py-2">Kd Akun</th>
                            <th class="w-[15%] py-2">Nama Proyek</th>
                            <th class="w-[7%] py-2">Kd Proyek</th>
                            <th class="w-[10%] py-2">Debet</th>
                            <th class="w-[10%] py-2">Kredit</th>
                            <th class="w-[10%] py-2">Action</th>
                        </thead>
                        <tbody>
                            <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">1/1/2025</td>
                                <td class="py-2">Mutasi dari bank BCA ke kas besar</td>
                                <td class="py-2">Kas Bank BCA</td>
                                <td class="py-2">111</td>
                                <td class="py-2">Pak Dwi Santoso</td>
                                <td class="py-2">P-0024</td>
                                <td class="py-2">Rp. 5.000.000</td>
                                <td class="py-2">Rp. 5.000.000</td>
                                <td class="flex justify-center items-center gap-x-2 py-2">
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
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">1/1/2025</td>
                                <td class="py-2">Mutasi dari bank BCA ke kas besar</td>
                                <td class="py-2">Kas Bank BCA</td>
                                <td class="py-2">111</td>
                                <td class="py-2">Pak Dwi Santoso</td>
                                <td class="py-2">P-0024</td>
                                <td class="py-2">Rp. 5.000.000</td>
                                <td class="py-2">Rp. 5.000.000</td>
                                <td class="flex justify-center items-center gap-x-2 py-2">
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
                                <td class="py-2">1/1/2025</td>
                                <td class="py-2">Mutasi dari bank BCA ke kas besar</td>
                                <td class="py-2">Kas Bank BCA</td>
                                <td class="py-2">111</td>
                                <td class="py-2">Pak Dwi Santoso</td>
                                <td class="py-2">P-0024</td>
                                <td class="py-2">Rp. 5.000.000</td>
                                <td class="py-2">Rp. 5.000.000</td>
                                <td class="flex justify-center items-center gap-x-2 py-2">
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
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">1/1/2025</td>
                                <td class="py-2">Mutasi dari bank BCA ke kas besar</td>
                                <td class="py-2">Kas Bank BCA</td>
                                <td class="py-2">111</td>
                                <td class="py-2">Pak Dwi Santoso</td>
                                <td class="py-2">P-0024</td>
                                <td class="py-2">Rp. 5.000.000</td>
                                <td class="py-2">Rp. 5.000.000</td>
                                <td class="flex justify-center items-center gap-x-2 py-2">
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
                                <td class="py-2">1/1/2025</td>
                                <td class="py-2">Mutasi dari bank BCA ke kas besar</td>
                                <td class="py-2">Kas Bank BCA</td>
                                <td class="py-2">111</td>
                                <td class="py-2">Pak Dwi Santoso</td>
                                <td class="py-2">P-0024</td>
                                <td class="py-2">Rp. 5.000.000</td>
                                <td class="py-2">Rp. 5.000.000</td>
                                <td class="flex justify-center items-center gap-x-2 py-2">
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
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">1/1/2025</td>
                                <td class="py-2">Mutasi dari bank BCA ke kas besar</td>
                                <td class="py-2">Kas Bank BCA</td>
                                <td class="py-2">111</td>
                                <td class="py-2">Pak Dwi Santoso</td>
                                <td class="py-2">P-0024</td>
                                <td class="py-2">Rp. 5.000.000</td>
                                <td class="py-2">Rp. 5.000.000</td>
                                <td class="flex justify-center items-center gap-x-2 py-2">
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
                                <td class="py-2">1/1/2025</td>
                                <td class="py-2">Mutasi dari bank BCA ke kas besar</td>
                                <td class="py-2">Kas Bank BCA</td>
                                <td class="py-2">111</td>
                                <td class="py-2">Pak Dwi Santoso</td>
                                <td class="py-2">P-0024</td>
                                <td class="py-2">Rp. 5.000.000</td>
                                <td class="py-2">Rp. 5.000.000</td>
                                <td class="flex justify-center items-center gap-x-2 py-2">
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