@extends('kepala-gudang.layout') @section('content')
<div>
    <h1 class="font-bold text-2xl mb-6">Freelance</h1>
    <section>
        <div class="flex items-center pb-4 justify-between">
            <div class="flex gap-x-2">
                <a
                    href="/kepala-gudang/input-data-barang"
                    class="block border-[#9A9A9A] border-2 rounded-lg px-4 py-2 shadow-[0px_0px_10px_rgba(0,0,0,0.1)]"
                    >Input Barang +</a
                >
                <a
                    href="/kepala-gudang/output-data-barang"
                    class="block border-[#9A9A9A] border-2 rounded-lg px-4 py-2 shadow-[0px_0px_10px_rgba(0,0,0,0.1)]"
                    >Barang Keluar -</a
                >
            </div>
            <form action="" class="flex items-center gap-x-2" id="myForm">
                <input
                    type="text"
                    name=""
                    id=""
                    placeholder="Cari Nama/Kategori"
                    class="border-[#9A9A9A] border-2 outline-none bg-white rounded-lg py-[8px] px-4"
                />
                <button
                    type="submit"
                    class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer"
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
        <div class="rounded-lg shadow-[1px_1px_10px_rgba(0,0,0,0.1)] pt-4 pb-6">
            <table class="table-fixed text-center text-sm w-full">
                <thead class="border-b-2 border-[#CCCCCC]">
                    <th class="py-2 w-[5%]">No</th>
                    <th class="py-2 w-[10%]">Tgl Masuk</th>
                    <th class="py-2 w-[15%]">Nama Barang</th>
                    <th class="py-2 w-[15%]">Kategori</th>
                    <th class="py-2 w-[20%]">Spesifikasi</th>
                    <th class="py-2 w-[8%]">Satuan</th>
                    <th class="py-2 w-[8%]">Stok</th>
                    <th class="py-2 w-[20%]">Image</th>
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
                        <td class="py-2"><img src="" alt="" /></td>
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
                        <td class="py-2"><img src="" alt="" /></td>
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
                        <td class="py-2"><img src="" alt="" /></td>
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
