@extends('owner.layout')
@section('content')
    <div>
        <h1 class="font-bold text-2xl mb-4">Detail Data Proyek</h1>
        <div class="w-full p-8 shadow-[1px_1px_10px_rgba(0,0,0,0.1)] rounded-lg">
            <div class="flex flex-col w-full gap-y-5">
                <div class="flex items-center gap-x-5">
                    <label class="w-[200px]">Nama Paket</label>
                    <input type="text" value=""
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                <div class="flex items-center gap-x-5">
                    <label class="w-[200px]">Perusahaan</label>
                    <input type="text" value=""
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                <div class="flex items-center gap-x-5">
                    <label class="w-[200px]">Pengawas</label>
                    <input type="text" value=""
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                <div class="flex items-center gap-x-5">
                    <label class="w-[200px]">No Hp</label>
                    <input type="text" value=""
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                <div class="flex items-center gap-x-5">
                    <label class="w-[200px]">MC 0</label>
                    <input type="date" value=""
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                <div class="flex items-center gap-x-5">
                    <label class="w-[200px]">Korlap</label>
                    <input type="text" value=""
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                <div class="flex items-center gap-x-5">
                    <label class="w-[200px]">Kontraktor</label>
                    <input type="text" value=""
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                <div class="flex items-center gap-x-5">
                    <label class="w-[200px]">Tgl PHO</label>
                    <input type="date" value=""
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                <div class="flex items-center gap-x-5">
                    <label class="w-[200px]">Tgl Kontraktor Ambil</label>
                    <input type="date" value=""
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                <div class="flex items-center gap-x-5">
                    <label class="w-[200px]">Kendala</label>
                    <input type="text" value=""
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>

                <div class="flex items-center gap-x-5">
                    <div class="w-[200px]"></div>
                    <span class="font-bold text-left text-lg w-full">Progress</span>
                </div>

                    <div class="flex items-center gap-x-5 add-input-section">
                        <label class="w-[200px]">Minggu</label>
                        <div class="w-full flex items-center justify-between">
                            <input type="text" value=""
                                class="bg-[#D9D9D9]/40 w-[40%] py-2 px-5 rounded-lg outline-none" readonly />
                            <div class="flex items-center w-[50%]">
                                <label class="w-[150px]">Persentase</label>
                                <input type="number" value=""
                                    class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
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
                        <div class="text-lg">Total Progress <span class="font-bold">%</span></div>
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
                            <label class="text-sm">PHO</label>
                            <input type="checkbox" class="w-[35px] h-[35px]" disabled />
                        </div>
                        <div class="flex items-center gap-x-3">
                            <label class="flex flex-col text-sm">
                                <span>Progress Kontraktor</span>
                                <span>(Sudah diserahkan ke admin)</span>
                            </label>
                            <input type="checkbox" class="w-[35px] h-[35px]" disabled />
                        </div>
                        <div class="flex items-center gap-x-3">
                            <label class="flex flex-col text-sm">
                                <span>Progress Kontraktor</span>
                                <span>(Sudah diambil kontraktor)</span>
                            </label>
                            <input type="checkbox" class="w-[35px] h-[35px]" disabled />
                        </div>
                        <div class="flex items-center gap-x-3">
                            <label class="flex flex-col text-sm">
                                <span>RAR Dokumen Konsultan</span>
                                <span>(Sudah diambil kontraktor)</span>
                            </label>
                            <input type="checkbox" class="w-[35px] h-[35px]" disabled/>
                        </div>
                        <div class="flex items-center gap-x-3">
                            <label class="flex flex-col text-sm">
                                <span>Progress Pengawas</span>
                                <span>(Sudah diserahkan ke admin)</span>
                            </label>
                            <input type="checkbox" class="w-[35px] h-[35px]" disabled/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
