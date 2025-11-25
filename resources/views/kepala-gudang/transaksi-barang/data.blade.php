@extends('kepala-gudang.layout') @section('content')
<div>
    <div class="flex flex-col mb-6">
        <h1 class="font-bold text-2xl mb-4">Data keluar/Masuk Barang</h1>
        <div class="flex items-center justify-between">
            <form action="" class="flex gap-x-2">
                <input
                    type="text"
                    name=""
                    id=""
                    placeholder="Tanggal Mulai"
                    data-flatpickr
                    class="border-2 border-[#9A9A9A] px-3 py-2 rounded-lg outline-none w-[180px]"
                />
                <input
                    type="text"
                    name=""
                    id=""
                    placeholder="Tanggal Selesai"
                    data-flatpickr
                    class="border-2 border-[#9A9A9A] px-3 py-2 rounded-lg outline-none w-[180px]"
                />
                <button
                    type="submit"
                    class="border-2 border-[#9A9A9A] px-3 py-2 rounded-lg bg-white cursor-pointer cursor-pointer"
                >
                    <img
                        src="{{ asset('assets/search-normal.png') }}"
                        alt="search icon"
                        class="w-[20px]"
                    />
                </button>
            </form>
            <form action="" class="flex gap-x-2">
                <input
                    type="text"
                    name=""
                    id=""
                    placeholder="Cari Kategori/Nama"
                    class="border-2 border-[#9A9A9A] px-3 py-2 rounded-lg outline-none"
                />
                <button
                    type="submit"
                    class="border-2 border-[#9A9A9A] px-3 py-2 rounded-lg bg-white cursor-pointer cursor-pointer"
                >
                    <img
                        src="{{ asset('assets/search-normal.png') }}"
                        alt="search icon"
                        class="w-[20px]"
                    />
                </button>
                <a
                    href=""
                    class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer"
                >
                    <img
                        src="{{ asset('assets/printer.png') }}"
                        alt="printer icon"
                        class="w-[20px]"
                    />
                </a>
            </form>
        </div>
    </div>
    <section class="mb-5 pb-6 border-b-2 border-[#B6B6B6]">
        <h1 class="font-bold text-2xl mb-4">Data Masuk Barang</h1>
        <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6">
            <table class="table-auto text-center text-sm w-full">
                <thead class="border-b-2 border-[#CCCCCC]">
                    <th class="py-2 w-[5%]">No</th>
                    <th class="py-2 w-[10%]">Tgl Masuk</th>
                    <th class="py-2 w-[15%]">Nama Barang</th>
                    <th class="py-2 w-[15%]">Kategori</th>
                    <th class="py-2 w-[20%]">Spesifikasi</th>
                    <th class="py-2 w-[10%]">Satuan</th>
                    <th class="py-2 w-[10%]">Stok</th>
                    <th class="py-2 w-[10%]">Action</th>
                </thead>
                <tbody>
                    <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                        <td class="py-2">1</td>
                        <td class="py-2">15/06/2025</td>
                        <td class="py-2">Kursi scandinavian</td>
                        <td class="py-2">Peralatan Kantor</td>
                        <td class="py-2">Panjang 30 cm x Lebar 25 cm</td>
                        <td class="py-2">Unit</td>
                        <td class="py-2">245</td>
                        <td
                            class="flex justify-center items-center gap-x-2 py-2"
                        >
                            <a href="/admin/pinjawan-karyawan/detail" class="">
                                <img
                                    src="{{ asset('assets/more-circle.png') }}"
                                    alt="more circle icon"
                                    class="w-[20px] cursor-pointer"
                                />
                            </a>
                            <span
                                class="border-black border-l-[1px] h-[22px]"
                            ></span>
                            <form action="" class="h-[22px]">
                                <button type="submit">
                                    <img
                                        src="{{
                                            asset('assets/close-circle.png')
                                        }}"
                                        alt="trash icon"
                                        class="w-[20px] cursor-pointer"
                                    />
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                        <td class="py-2">1</td>
                        <td class="py-2">15/06/2025</td>
                        <td class="py-2">Kursi scandinavian</td>
                        <td class="py-2">Peralatan Kantor</td>
                        <td class="py-2">Panjang 30 cm x Lebar 25 cm</td>
                        <td class="py-2">Unit</td>
                        <td class="py-2">245</td>
                        <td
                            class="flex justify-center items-center gap-x-2 py-2"
                        >
                            <a href="/admin/pinjawan-karyawan/detail" class="">
                                <img
                                    src="{{ asset('assets/more-circle.png') }}"
                                    alt="more circle icon"
                                    class="w-[20px] cursor-pointer"
                                />
                            </a>
                            <span
                                class="border-black border-l-[1px] h-[22px]"
                            ></span>
                            <form action="" class="h-[22px]">
                                <button type="submit">
                                    <img
                                        src="{{
                                            asset('assets/close-circle.png')
                                        }}"
                                        alt="trash icon"
                                        class="w-[20px] cursor-pointer"
                                    />
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                        <td class="py-2">1</td>
                        <td class="py-2">15/06/2025</td>
                        <td class="py-2">Kursi scandinavian</td>
                        <td class="py-2">Peralatan Kantor</td>
                        <td class="py-2">Panjang 30 cm x Lebar 25 cm</td>
                        <td class="py-2">Unit</td>
                        <td class="py-2">245</td>
                        <td
                            class="flex justify-center items-center gap-x-2 py-2"
                        >
                            <a href="/admin/pinjawan-karyawan/detail" class="">
                                <img
                                    src="{{ asset('assets/more-circle.png') }}"
                                    alt="more circle icon"
                                    class="w-[20px] cursor-pointer"
                                />
                            </a>
                            <span
                                class="border-black border-l-[1px] h-[22px]"
                            ></span>
                            <form action="" class="h-[22px]">
                                <button type="submit">
                                    <img
                                        src="{{
                                            asset('assets/close-circle.png')
                                        }}"
                                        alt="trash icon"
                                        class="w-[20px] cursor-pointer"
                                    />
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    <section class="mb-5">
        <h1 class="font-bold text-2xl mb-4">Data Keluar Barang</h1>
        <div class="flex justify-between items-center mb-5">
            <form action="" class="flex gap-x-2">
                <input
                    type="text"
                    name=""
                    id=""
                    placeholder="Tanggal Mulai"
                    data-flatpickr
                    class="border-2 border-[#9A9A9A] px-3 py-2 rounded-lg outline-none w-[180px]"
                />
                <input
                    type="text"
                    name=""
                    id=""
                    placeholder="Tanggal Selesai"
                    data-flatpickr
                    class="border-2 border-[#9A9A9A] px-3 py-2 rounded-lg outline-none w-[180px]"
                />
                <button
                    type="submit"
                    class="border-2 border-[#9A9A9A] px-3 py-2 rounded-lg bg-white cursor-pointer cursor-pointer"
                >
                    <img
                        src="{{ asset('assets/search-normal.png') }}"
                        alt="search icon"
                        class="w-[20px]"
                    />
                </button>
            </form>
            <form action="" class="flex gap-x-2">
                <input
                    type="text"
                    name=""
                    id=""
                    placeholder="Cari Kategori/Nama"
                    class="border-2 border-[#9A9A9A] px-3 py-2 rounded-lg outline-none"
                />
                <button
                    type="submit"
                    class="border-2 border-[#9A9A9A] px-3 py-2 rounded-lg bg-white cursor-pointer cursor-pointer"
                >
                    <img
                        src="{{ asset('assets/search-normal.png') }}"
                        alt="search icon"
                        class="w-[20px]"
                    />
                </button>
                <a
                    href=""
                    class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer"
                >
                    <img
                        src="{{ asset('assets/printer.png') }}"
                        alt="printer icon"
                        class="w-[20px]"
                    />
                </a>
            </form>
        </div>
        <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6">
            <table class="table-auto text-center text-sm w-full">
                <thead class="border-b-2 border-[#CCCCCC]">
                    <th class="py-2 w-[5%]">No</th>
                    <th class="py-2 w-[10%]">Tgl Masuk</th>
                    <th class="py-2 w-[15%]">Nama Barang</th>
                    <th class="py-2 w-[15%]">Kategori</th>
                    <th class="py-2 w-[20%]">Spesifikasi</th>
                    <th class="py-2 w-[10%]">Satuan</th>
                    <th class="py-2 w-[10%]">Stok</th>
                    <th class="py-2 w-[10%]">Action</th>
                </thead>
                <tbody>
                    <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                        <td class="py-2">1</td>
                        <td class="py-2">15/06/2025</td>
                        <td class="py-2">Kursi scandinavian</td>
                        <td class="py-2">Peralatan Kantor</td>
                        <td class="py-2">Panjang 30 cm x Lebar 25 cm</td>
                        <td class="py-2">Unit</td>
                        <td class="py-2">245</td>
                        <td
                            class="flex justify-center items-center gap-x-2 py-2"
                        >
                            <a href="/admin/pinjawan-karyawan/detail" class="">
                                <img
                                    src="{{ asset('assets/more-circle.png') }}"
                                    alt="more circle icon"
                                    class="w-[20px] cursor-pointer"
                                />
                            </a>
                            <span
                                class="border-black border-l-[1px] h-[22px]"
                            ></span>
                            <form action="" class="h-[22px]">
                                <button type="submit">
                                    <img
                                        src="{{
                                            asset('assets/close-circle.png')
                                        }}"
                                        alt="trash icon"
                                        class="w-[20px] cursor-pointer"
                                    />
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                        <td class="py-2">1</td>
                        <td class="py-2">15/06/2025</td>
                        <td class="py-2">Kursi scandinavian</td>
                        <td class="py-2">Peralatan Kantor</td>
                        <td class="py-2">Panjang 30 cm x Lebar 25 cm</td>
                        <td class="py-2">Unit</td>
                        <td class="py-2">245</td>
                        <td
                            class="flex justify-center items-center gap-x-2 py-2"
                        >
                            <a href="/admin/pinjawan-karyawan/detail" class="">
                                <img
                                    src="{{ asset('assets/more-circle.png') }}"
                                    alt="more circle icon"
                                    class="w-[20px] cursor-pointer"
                                />
                            </a>
                            <span
                                class="border-black border-l-[1px] h-[22px]"
                            ></span>
                            <form action="" class="h-[22px]">
                                <button type="submit">
                                    <img
                                        src="{{
                                            asset('assets/close-circle.png')
                                        }}"
                                        alt="trash icon"
                                        class="w-[20px] cursor-pointer"
                                    />
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                        <td class="py-2">1</td>
                        <td class="py-2">15/06/2025</td>
                        <td class="py-2">Kursi scandinavian</td>
                        <td class="py-2">Peralatan Kantor</td>
                        <td class="py-2">Panjang 30 cm x Lebar 25 cm</td>
                        <td class="py-2">Unit</td>
                        <td class="py-2">245</td>
                        <td
                            class="flex justify-center items-center gap-x-2 py-2"
                        >
                            <a href="/admin/pinjawan-karyawan/detail" class="">
                                <img
                                    src="{{ asset('assets/more-circle.png') }}"
                                    alt="more circle icon"
                                    class="w-[20px] cursor-pointer"
                                />
                            </a>
                            <span
                                class="border-black border-l-[1px] h-[22px]"
                            ></span>
                            <form action="" class="h-[22px]">
                                <button type="submit">
                                    <img
                                        src="{{
                                            asset('assets/close-circle.png')
                                        }}"
                                        alt="trash icon"
                                        class="w-[20px] cursor-pointer"
                                    />
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
