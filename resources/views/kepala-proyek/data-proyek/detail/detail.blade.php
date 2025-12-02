@extends('kepala-proyek.layout')
@section('content')
    <div>
        <h1 class="font-bold text-2xl mb-4">Detail Data Proyek</h1>
        <div class="flex gap-x-4 mb-8">
            <a href="/kepala-proyek/data-proyek/update" class="flex items-center border border-[#45D03E] text-[#45D03E] w-fit px-4 py-2 rounded-lg">
                <span>Edit Data</span>
                <img src="{{ asset('assets/edit-green.png') }}" alt="icon edit" class="inline-block ml-3" />
            </a>
            <form action="">
                <button class="flex items-center border border-[#DD4049] text-[#DD4049] w-fit px-4 py-2 rounded-lg cursor-pointer">
                    <span>Hapus Data</span>
                    <img src="{{ asset('assets/close-circle-red.png') }}" alt="icon close" class="inline-block ml-3" />
                </button>
            </form>
        </div>
        <div class="w-full p-8 shadow-[1px_1px_10px_rgba(0,0,0,0.1)] rounded-lg">
            <form action="" method="post" class="flex flex-col w-full gap-y-5">
                <div class="flex items-center gap-x-5">
                    <label for="" class="w-[200px]">Nama Paket</label>
                    <input type="text" name="" id="" value="Peningkatan Jaringan Irigasi Saluran Tersier Simangu Kec. Talun" class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                <div class="flex items-center gap-x-5">
                    <label for="" class="w-[200px]">Perusahaan</label>
                    <input type="text" name="" id="" value="CV. ARS GUMILANG" class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                <div class="flex items-center gap-x-5">
                    <label for="" class="w-[200px]">Pengawas</label>
                    <input type="text" name="" id="" value="Sudirman" class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                 <div class="flex items-center gap-x-5">
                    <label for="" class="w-[200px]">No Hp</label>
                    <input type="text" name="" id="" value="0822-3226-6660" class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly/>
                </div>
                 <div class="flex items-center gap-x-5">
                    <label for="" class="w-[200px]">MC 0</label>
                    <input type="date" name="" id="" value="2025-11-12" class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly/>
                </div>
                <div class="flex items-center gap-x-5">
                    <label for="" class="w-[200px]">Korlap</label>
                    <input type="text" name="" id="" value="Bapak Fikri" class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly/>
                </div>
                <div class="flex items-center gap-x-5">
                    <label for="" class="w-[200px]">Kontraktor</label>
                    <input type="text" name="" id="" value="CV. JOMBANG KARYA" value="Bapak Fikri" class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly/>
                </div>
                <div class="flex items-center gap-x-5">
                    <label for="" class="w-[200px]">Tgl PHO</label>
                    <input type="date" name="" id="" class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly/>
                </div>
                <div class="flex items-center gap-x-5">
                    <label for="" class="w-[200px]">Tgl kontraktor ambil</label>
                    <input type="date" name="" id="" class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                </div>
                <div class="flex items-center gap-x-5">
                    <label for="" class="w-[200px]">Kendala</label>
                    <input type="text" name="" value="Material susah di cari" id="" class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly/>
                </div>
                <div class="flex items-center gap-x-5">
                    <div class="w-[200px]"></div>
                    <span class="font-bold text-left text-lg w-full">Progress</span>
                </div>
                <div class="flex items-center gap-x-5 add-input-section">
                    <label for="" class="w-[200px]">Minggu</label>
                    <div class="w-full flex items-center justify-between">
                        <input type="text" name="" value="1" id="" class="bg-[#D9D9D9]/40 w-[40%] py-2 px-5 rounded-lg outline-none" readonly />
                        <div class="flex items-center w-[50%]">
                            <label for="" class="w-[150px]">Persentase</label>
                            <input type="number" name="" id="" value="10" class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                            <div class="px-2">%</div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-x-5 add-input-section">
                    <label for="" class="w-[200px]">Minggu</label>
                    <div class="w-full flex items-center justify-between">
                        <input type="text" name="" id="" value="2" class="bg-[#D9D9D9]/40 w-[40%] py-2 px-5 rounded-lg outline-none" readonly />
                        <div class="flex items-center w-[50%]">
                            <label for="" class="w-[150px]">Persentase</label>
                            <input type="number" name="" id="" value="30" class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                            <div class="px-2">%</div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-x-5">
                    <div class="w-[200px]"></div>
                    <div class="w-full border-b border-[#BEBEBE]"></div>
                </div>
                <div class="flex items-center gap-x-5">
                    <div class="w-[200px]"></div>
                    <div class="w-full flex justify-between">
                        <div></div>
                        <div class="text-lg">Total Progress <span class="font-bold">40%</span></div>
                    </div>
                </div>
                 <div class="flex items-center gap-x-5">
                    <div class="w-[200px]"></div>
                    <div class="w-full border-b border-[#BEBEBE]"></div>
                </div>
                 <div class="flex items-center gap-x-5">
                    <div class="w-[200px]"></div>
                    <div class="w-full flex flex-wrap gap-8">
                        <div class="flex items-center gap-x-3">
                            <label for="" class="text-sm">PHO</label>
                            <input type="checkbox" name="" id="" class="w-[35px] h-[35px] bg-[#D9D9D9]/40 rounded-lg outline-none cursor-pointer focus:bg-[#D9D9D9]/40" disabled checked />
                        </div>
                        <div class="flex items-center gap-x-3">
                            <label for="" class="flex flex-col text-sm">
                                <span>Progress Kontraktor</span>
                                <span>(Sudah di serahkan ke admin)</span>
                            </label>
                            <input type="checkbox" name="" id="" class="w-[35px] h-[35px] bg-[#D9D9D9]/40 rounded-lg outline-none cursor-pointer focus:bg-[#D9D9D9]/40" disabled checked />
                        </div>
                        <div class="flex items-center gap-x-3">
                            <label for="" class="flex flex-col text-sm">
                                <span>Progress Kontraktor</span>
                                <span>(Sudah di ambil kontraktor)</span>
                            </label>
                            <input type="checkbox" name="" id="" class="w-[35px] h-[35px] bg-[#D9D9D9]/40 rounded-lg outline-none cursor-pointer focus:bg-[#D9D9D9]/40" disabled checked />
                        </div>
                        <div class="flex items-center gap-x-3">
                            <label for="" class="flex flex-col text-sm">
                                <span>RAR Dokumen Konsultan</span>
                                <span>(Sudah di ambil kontraktor)</span>
                            </label>
                            <input type="checkbox" name="" id="" class="w-[35px] h-[35px] bg-[#D9D9D9]/40 rounded-lg outline-none cursor-pointer focus:bg-[#D9D9D9]/40" disabled checked />
                        </div>
                        <div class="flex items-center gap-x-3">
                            <label for="" class="flex flex-col text-sm">
                                <span>Progress Pengawas </span>
                                <span>(Sudah di serahkan ke admin)</span>
                            </label>
                            <input type="checkbox" name="" id="" class="w-[35px] h-[35px] bg-[#D9D9D9]/40 rounded-lg outline-none cursor-pointer focus:bg-[#D9D9D9]/40" disabled checked />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection