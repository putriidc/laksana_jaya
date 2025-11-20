@extends('admin.layout')
@section('content')
    <div>
        <div class="flex flex-col mb-6 border-b border-black pb-5">
            <h1 class="font-bold text-2xl mb-4">Pinjaman Karyawan</h1>
            <div class="flex items-center gap-x-2">
                <p>Nama Karyawan</p>
                <div class="border-[#9A9A9A] border-2 rounded-lg py-[8px] px-[25px] font-bold">
                    Kasmin Bin Amin
                </div>
                <a href="" class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                    <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                </a>
            </div>
        </div>
        <section class="mb-10">
            <div class="flex items-center pb-4 w-full justify-between">
                    <h1 class="font-bold text-2xl">Pinjaman Karyawan</h1>
                    <div class="flex items-center gap-x-4">
                        <a href="/admin/pinjawan-karyawan/detail/form-pengembalian-pinjaman" class="flex items-center gap-x-3 border-[#9A9A9A] border-2 rounded-xl py-[10px] px-[15px] bg-white cursor-pointer">
                            <span>Bayar Pinjaman</span>
                            <img src="{{ asset('assets/card-receive.png') }}" alt="bayar pinjaman icon" class="w-[20px]">
                        </a>
                        <a href="/admin/pinjawan-karyawan/detail/form-pinjaman" class="flex items-center gap-x-3 border-[#9A9A9A] border-2 rounded-xl py-[10px] px-[15px] bg-white cursor-pointer">
                            <span>Pinjam Uang</span>
                            <img src="{{ asset('assets/card-receive.png') }}" alt="bayar pinjaman icon" class="w-[20px]">
                        </a>
                        <div class="flex items-center gap-x-2">
                            <h1 class="font-bold">STATUS</h1>
                            <div class="bg-[#8CE987] w-[100px] h-[20px]"></div>
                        </div>
                    </div>
                </div>
                <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6">
                    <table class="table-auto text-center text-sm w-full">
                        <thead class="border-b-2 border-[#CCCCCC]">
                            <th class="py-2 w-[10%]">No</th>
                            <th class="py-2 w-[15%]">Kontrak</th>
                            <th class="py-2 w-[10%]">Tgl Pinjaman</th>
                            <th class="py-2 w-[10%]">Tgl Cicilan</th>
                            <th class="py-2 w-[15%]">Jumlah Pinjaman</th>
                            <th class="py-2 w-[15%]">Cicilan Pinjaman</th>
                            <th class="py-2 w-[15%]">Sisa Pinjaman</th>
                            <th class="py-2 w-[10%]">Action</th>
                        </thead>
                        <tbody>
                            <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">1</td>
                                <td class="py-2">Kontrak Pinjaman I</td>
                                <td class="py-2">15/06/2025</td>
                                <td class="py-2">15/06/2025</td>
                                <td class="py-2">Rp. 5.000.000</td>
                                <td class="py-2">Rp. 1.650.000</td>
                                <td class="py-2">Rp. 1.650.000</td>
                                <td class="flex justify-center items-center gap-x-2 py-2">
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
                                <td class="py-2">1</td>
                                <td class="py-2">Kontrak Pinjaman I</td>
                                <td class="py-2">15/06/2025</td>
                                <td class="py-2">15/06/2025</td>
                                <td class="py-2">Rp. 5.000.000</td>
                                <td class="py-2">Rp. 1.650.000</td>
                                <td class="py-2">Rp. 1.650.000</td>
                                <td class="flex justify-center items-center gap-x-2 py-2">
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
                            <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">1</td>
                                <td class="py-2">Kontrak Pinjaman I</td>
                                <td class="py-2">15/06/2025</td>
                                <td class="py-2">15/06/2025</td>
                                <td class="py-2">Rp. 5.000.000</td>
                                <td class="py-2">Rp. 1.650.000</td>
                                <td class="py-2">Rp. 1.650.000</td>
                                <td class="flex justify-center items-center gap-x-2 py-2">
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
                        </tbody>
                    </table>
                </div>
        </section>
        <section>
            <div class="flex items-center pb-4 w-full justify-between">
                    <h1 class="font-bold text-2xl">Kasbon Karyawan</h1>
                    <div class="flex items-center gap-x-4">
                        <a href="/admin/pinjawan-karyawan/detail/form-pengembalian-kasbon" class="flex items-center gap-x-3 border-[#9A9A9A] border-2 rounded-xl py-[10px] px-[15px] bg-white cursor-pointer">
                            <span>Bayar Kasbon</span>
                            <img src="{{ asset('assets/card-receive.png') }}" alt="bayar pinjaman icon" class="w-[20px]">
                        </a>
                        <a href="/admin/pinjawan-karyawan/detail/form-kasbon" class="flex items-center gap-x-3 border-[#9A9A9A] border-2 rounded-xl py-[10px] px-[15px] bg-white cursor-pointer">
                            <span>Kasbon</span>
                            <img src="{{ asset('assets/card-receive.png') }}" alt="bayar pinjaman icon" class="w-[20px]">
                        </a>
                        <div class="flex items-center gap-x-2">
                            <h1 class="font-bold">STATUS</h1>
                            <div class="bg-[#DD4049] w-[100px] h-[20px]"></div>
                        </div>
                    </div>
                </div>
                <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6">
                    <table class="table-auto text-center text-sm w-full">
                        <thead class="border-b-2 border-[#CCCCCC]">
                            <th class="py-2 w-[10%]">No</th>
                            <th class="py-2 w-[15%]">Kontrak</th>
                            <th class="py-2 w-[10%]">Tgl Pinjaman</th>
                            <th class="py-2 w-[10%]">Tgl Cicilan</th>
                            <th class="py-2 w-[15%]">Jumlah Pinjaman</th>
                            <th class="py-2 w-[15%]">Cicilan Pinjaman</th>
                            <th class="py-2 w-[15%]">Sisa Pinjaman</th>
                            <th class="py-2 w-[10%]">Action</th>
                        </thead>
                        <tbody>
                            <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">1</td>
                                <td class="py-2">Kontrak Pinjaman I</td>
                                <td class="py-2">15/06/2025</td>
                                <td class="py-2">15/06/2025</td>
                                <td class="py-2">Rp. 5.000.000</td>
                                <td class="py-2">Rp. 1.650.000</td>
                                <td class="py-2">Rp. 1.650.000</td>
                                <td class="flex justify-center items-center gap-x-2 py-2">
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
                                <td class="py-2">1</td>
                                <td class="py-2">Kontrak Pinjaman I</td>
                                <td class="py-2">15/06/2025</td>
                                <td class="py-2">15/06/2025</td>
                                <td class="py-2">Rp. 5.000.000</td>
                                <td class="py-2">Rp. 1.650.000</td>
                                <td class="py-2">Rp. 1.650.000</td>
                                <td class="flex justify-center items-center gap-x-2 py-2">
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
                            <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">1</td>
                                <td class="py-2">Kontrak Pinjaman I</td>
                                <td class="py-2">15/06/2025</td>
                                <td class="py-2">15/06/2025</td>
                                <td class="py-2">Rp. 5.000.000</td>
                                <td class="py-2">Rp. 1.650.000</td>
                                <td class="py-2">Rp. 1.650.000</td>
                                <td class="flex justify-center items-center gap-x-2 py-2">
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
                        </tbody>
                    </table>
                </div>
        </section>
    </div>
@endsection