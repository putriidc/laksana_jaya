@extends('admin.layout')
@section('content')
    <div>
        <h1 class="font-bold text-2xl mb-6">Master Data</h1>
        <section class="flex flex-col">
                <div class="flex justify-between items-center pb-4">
                    <label for="dropdown-toggle" class="bg-[#FFF494] select-none shadow-[0px_0px_15px_rgba(0,0,0,0.25)] rounded-lg cursor-pointer w-[180px] relative">
                        <div class="flex justify-between py-2 px-4 items-center">
                            <span>Tambah Data</span>
                            <img src="{{ asset('assets/arrow-down.png') }}" alt="arrow down icon" id="icon-dropdown" class="w-[20px]">
                            <input type="checkbox" id="dropdown-toggle" class="hidden" />
                        </div>
                        <div class="absolute w-[180px] bg-[#FFF494] shadow-2xl rounded-b-lg top-9 hidden" id="dropdown-menu">
                            <a href="/admin/master-data/create-asset" class="py-2 px-4 block hover:bg-[#E9E9E9]">
                                <p class="truncate">
                                    Asset Lancar, Asset Tetap, Kewajiban, Ekuitas, Pendatan & HPP Proyek
                                </p>
                            </a>
                            <a href="/admin/master-data/create-piutang-hutang" class="py-2 px-4 block hover:bg-[#E9E9E9]">
                                <p class="truncate">
                                    Piutang & Hutang Usaha
                                </p>
                            </a>
                            <a href="/admin/master-data/create-karyawan" class="py-2 px-4 block hover:bg-[#E9E9E9]">
                                <p class="truncate">
                                    Karyawan
                                </p>
                            </a>
                            <a href="/admin/master-data/create-proyek" class="py-2 px-4 block hover:bg-[#E9E9E9]">
                                <p class="truncate">
                                    Proyek
                                </p>
                            </a>
                        </div>
                    </label>
                    <form action="" class="flex items-center gap-x-2">
                        <input type="text" name="" id="" placeholder="Cari Data..." class="border-[#9A9A9A] border-2 rounded-lg py-2 px-4 outline-none">
                        <button type="submit" class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                            <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" class="w-[20px]">
                        </button>
                    </form>
                </div>
                <div class="flex flex-col pb-4">
                    <h1 class="text-[#C0C0C0] font-bold text-xl">Data Asset Lancar, Asset Tetap, Kewajiban, Ekuitas, Pendatan & HPP Proyek</h1>
                    <div class="w-full flex justify-center pt-2 pb-4 shadow-[0px_0px_15px_rgba(0,0,0,0.25)] rounded-lg mt-2">
                        <table class="table-fixed w-[80%] text-center">
                            <thead class="border-b-2 border-[#CCCCCC]">
                                <th class="py-2 w-[10%]">No</th>
                                <th class="py-2 w-[15%]">Kode Akun</th>
                                <th class="py-2 w-[25%]">Nama Akun</th>
                                <th class="py-2 w-[20%]">Post Saldo</th>
                                <th class="py-2 w-[20%]">Post Laporan</th>
                                <th class="py-2 w-[20%]">Action</th>
                            </thead>
                            <tbody>
                                <tr class="bg-white">
                                    <td class="py-2">1</td>
                                    <td class="py-2">111</td>
                                    <td class="py-2">Kas Back BCA</td>
                                    <td class="py-2">Debet</td>
                                    <td class="py-2">Kredit</td>
                                    <td class="flex justify-center items-center gap-x-2 py-2">
                                        <a href="" class="">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="more circle icon" class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        <form action="" class=" h-[22px]">
                                            <button type="submit">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="trash icon" class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <tr class="bg-[#E9E9E9]">
                                    <td class="py-2">1</td>
                                    <td class="py-2">111</td>
                                    <td class="py-2">Kas Back BCA</td>
                                    <td class="py-2">Debet</td>
                                    <td class="py-2">Kredit</td>
                                    <td class="flex justify-center items-center gap-x-2 py-2">
                                        <a href="" class="">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="more circle icon" class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        <form action="" class=" h-[22px]">
                                            <button type="submit">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="trash icon" class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <tr class="bg-white">
                                    <td class="py-2">1</td>
                                    <td class="py-2">111</td>
                                    <td class="py-2">Kas Back BCA</td>
                                    <td class="py-2">Debet</td>
                                    <td class="py-2">Kredit</td>
                                    <td class="flex justify-center items-center gap-x-2 py-2">
                                        <a href="" class="">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="more circle icon" class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        <form action="" class=" h-[22px]">
                                            <button type="submit">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="trash icon" class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <tr class="bg-[#E9E9E9]">
                                    <td class="py-2">1</td>
                                    <td class="py-2">111</td>
                                    <td class="py-2">Kas Back BCA</td>
                                    <td class="py-2">Debet</td>
                                    <td class="py-2">Kredit</td>
                                    <td class="flex justify-center items-center gap-x-2 py-2">
                                        <a href="" class="">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="more circle icon" class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        <form action="" class=" h-[22px]">
                                            <button type="submit">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="trash icon" class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex flex-col pb-4">
                    <h1 class="text-[#C0C0C0] font-bold text-xl">Piutang & Hutang Usaha</h1>
                    <div class="w-full flex justify-center pt-2 pb-4 shadow-[0px_0px_15px_rgba(0,0,0,0.25)] rounded-lg mt-2">
                        <table class="table-fixed w-[80%] text-center">
                            <thead class="border-b-2 border-[#CCCCCC]">
                                <th class="py-2 w-[10%]">No</th>
                                <th class="py-2 w-[15%]">Kode Akun</th>
                                <th class="py-2 w-[25%]">Nama Akun</th>
                                <th class="py-2 w-[20%]">Akun Header</th>
                                <th class="py-2 w-[20%]">Action</th>
                            </thead>
                            <tbody>
                                <tr class="bg-white">
                                    <td class="py-2">1</td>
                                    <td class="py-2">PU-001</td>
                                    <td class="py-2">Kas Back BCA</td>
                                    <td class="py-2">Piutang Usaha</td>
                                    <td class="flex justify-center items-center gap-x-2 py-2">
                                        <a href="" class="">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="more circle icon" class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        <form action="" class=" h-[22px]">
                                            <button type="submit">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="trash icon" class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <tr class="bg-[#E9E9E9]">
                                    <td class="py-2">1</td>
                                    <td class="py-2">PU-002</td>
                                    <td class="py-2">Kas Back BCA</td>
                                    <td class="py-2">Hutang Usaha</td>
                                    <td class="flex justify-center items-center gap-x-2 py-2">
                                        <a href="" class="">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="more circle icon" class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        <form action="" class=" h-[22px]">
                                            <button type="submit">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="trash icon" class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex flex-col pb-4">
                    <h1 class="text-[#C0C0C0] font-bold text-xl">Data Karyawan</h1>
                    <div class="w-full flex justify-center pt-2 pb-4 shadow-[0px_0px_15px_rgba(0,0,0,0.25)] rounded-lg mt-2">
                        <table class="table-fixed w-[80%] text-center">
                            <thead class="border-b-2 border-[#CCCCCC]">
                                <th class="py-2 w-[10%]">No</th>
                                <th class="py-2 w-[15%]">Kode Akun</th>
                                <th class="py-2 w-[25%]">Nama Akun</th>
                                <th class="py-2 w-[20%]">Akun Header</th>
                                <th class="py-2 w-[20%]">Action</th>
                            </thead>
                            <tbody>
                                <tr class="bg-white">
                                    <td class="py-2">1</td>
                                    <td class="py-2">DK-001</td>
                                    <td class="py-2">Kas Back BCA</td>
                                    <td class="py-2">Piutang Usaha</td>
                                    <td class="flex justify-center items-center gap-x-2 py-2">
                                        <a href="" class="">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="more circle icon" class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        <form action="" class=" h-[22px]">
                                            <button type="submit">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="trash icon" class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <tr class="bg-[#E9E9E9]">
                                    <td class="py-2">1</td>
                                    <td class="py-2">DK-002</td>
                                    <td class="py-2">Kas Back BCA</td>
                                    <td class="py-2">Piutang Usaha</td>
                                    <td class="flex justify-center items-center gap-x-2 py-2">
                                        <a href="" class="">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="more circle icon" class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        <form action="" class=" h-[22px]">
                                            <button type="submit">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="trash icon" class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex flex-col pb-4">
                    <h1 class="text-[#C0C0C0] font-bold text-xl">Proyek</h1>
                    <div class="w-full flex justify-center pt-2 pb-4 shadow-[0px_0px_15px_rgba(0,0,0,0.25)] rounded-lg mt-2">
                        <table class="table-fixed w-[80%] text-center">
                            <thead class="border-b-2 border-[#CCCCCC]">
                                <th class="py-2 w-[10%]">No</th>
                                <th class="py-2 w-[15%]">Kode Akun</th>
                                <th class="py-2 w-[20%]">Nama Akun</th>
                                <th class="py-2 w-[25%]">Perusahaan</th>
                                <th class="py-2 w-[25%]">Jenis Pekerjaan</th>
                                <th class="py-2 w-[25%]">Nilai Kontrak</th>
                                <th class="py-2 w-[20%]">Action</th>
                            </thead>
                            <tbody>
                                <tr class="bg-white">
                                    <td class="py-2">1</td>
                                    <td class="py-2">PU-002</td>
                                    <td class="py-2">Kas Back BCA</td>
                                    <td class="py-2">CV ARN GROUP</td>
                                    <td class="py-2">Swasta</td>
                                    <td class="py-2">Rp.123.456.789</td>
                                    <td class="flex justify-center items-center gap-x-2 py-2">
                                        <a href="" class="">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="more circle icon" class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        <form action="" class=" h-[22px]">
                                            <button type="submit">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="trash icon" class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <tr class="bg-[#E9E9E9]">
                                    <td class="py-2">1</td>
                                    <td class="py-2">PU-002</td>
                                    <td class="py-2">Kas Back BCA</td>
                                    <td class="py-2">CV BAKTI PERDANA</td>
                                    <td class="py-2">Swasta</td>
                                    <td class="py-2">Rp.123.456.789</td>
                                    <td class="flex justify-center items-center gap-x-2 py-2">
                                        <a href="" class="">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="more circle icon" class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        <form action="" class=" h-[22px]">
                                            <button type="submit">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="trash icon" class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <tr class="bg-white">
                                    <td class="py-2">1</td>
                                    <td class="py-2">PU-002</td>
                                    <td class="py-2">Kas Back BCA</td>
                                    <td class="py-2">CV BAKTI PERDANA</td>
                                    <td class="py-2">Swasta</td>
                                    <td class="py-2">Rp.123.456.789</td>
                                    <td class="flex justify-center items-center gap-x-2 py-2">
                                        <a href="" class="">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="more circle icon" class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        <form action="" class=" h-[22px]">
                                            <button type="submit">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="trash icon" class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <tr class="bg-[#E9E9E9]">
                                    <td class="py-2">1</td>
                                    <td class="py-2">PU-002</td>
                                    <td class="py-2">Kas Back BCA</td>
                                    <td class="py-2">CV BAKTI PERDANA</td>
                                    <td class="py-2">Swasta</td>
                                    <td class="py-2">Rp.123.456.789</td>
                                    <td class="flex justify-center items-center gap-x-2 py-2">
                                        <a href="" class="">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="more circle icon" class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        <form action="" class=" h-[22px]">
                                            <button type="submit">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="trash icon" class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        </section>
        <script src="{{ asset('js/dropdown.js') }}"></script>
    </div>
@endsection