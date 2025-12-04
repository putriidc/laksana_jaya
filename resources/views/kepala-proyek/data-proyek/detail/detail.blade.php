@extends('kepala-proyek.layout')
@section('content')
    <div>
        <h1 class="font-bold text-2xl mb-4">Detail Data Proyek</h1>

        <div class="flex gap-x-4 mb-8">
            <a href="{{ route('data-perusahaan.edit', $dataPerusahaan->id) }}"
                class="flex items-center border border-[#45D03E] text-[#45D03E] w-fit px-4 py-2 rounded-lg">
                <span>Edit Data</span>
                <img src="{{ asset('assets/edit-green.png') }}" alt="icon edit" class="inline-block ml-3" />
            </a>
            <form action="{{ route('data-perusahaan.destroy', $dataPerusahaan->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Yakin hapus data ini?')"
                    class="flex items-center border border-[#DD4049] text-[#DD4049] w-fit px-4 py-2 rounded-lg cursor-pointer">
                    <span>Hapus Data</span>
                    <img src="{{ asset('assets/close-circle-red.png') }}" alt="icon close" class="inline-block ml-3" />
                </button>
            </form>
        </div>

        <div class="w-full p-8 shadow-[1px_1px_10px_rgba(0,0,0,0.1)] rounded-lg">
            <div class="flex flex-col w-full gap-y-5">
                <div class="flex items-center gap-x-5">
                    <label class="w-[200px]">Nama Paket</label>
                    <input type="text" value="{{ $dataPerusahaan->nama_paket }}"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                <div class="flex items-center gap-x-5">
                    <label class="w-[200px]">Perusahaan</label>
                    <input type="text" value="{{ $dataPerusahaan->perusahaan->nama_perusahaan }}"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                <div class="flex items-center gap-x-5">
                    <label class="w-[200px]">Pengawas</label>
                    <input type="text" value="{{ $dataPerusahaan->pic }}"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                <div class="flex items-center gap-x-5">
                    <label class="w-[200px]">No Hp</label>
                    <input type="text" value="{{ $dataPerusahaan->no_hp }}"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                <div class="flex items-center gap-x-5">
                    <label class="w-[200px]">MC 0</label>
                    <input type="date" value="{{ $dataPerusahaan->mc0 }}"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                <div class="flex items-center gap-x-5">
                    <label class="w-[200px]">Korlap</label>
                    <input type="text" value="{{ $dataPerusahaan->korlap }}"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                <div class="flex items-center gap-x-5">
                    <label class="w-[200px]">Kontraktor</label>
                    <input type="text" value="{{ $dataPerusahaan->kontraktor }}"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                <div class="flex items-center gap-x-5">
                    <label class="w-[200px]">Tgl PHO</label>
                    <input type="date" value="{{ $dataPerusahaan->tgl_pho }}"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                <div class="flex items-center gap-x-5">
                    <label class="w-[200px]">Tgl Kontraktor Ambil</label>
                    <input type="date" value="{{ $dataPerusahaan->tgl_ambil }}"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                <div class="flex items-center gap-x-5">
                    <label class="w-[200px]">Kendala</label>
                    <input type="text" value="{{ $dataPerusahaan->kendala }}"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>

                <div class="flex items-center gap-x-5">
                    <div class="w-[200px]"></div>
                    <span class="font-bold text-left text-lg w-full">Progress</span>
                </div>

                @foreach ($progres as $p)
                    <div class="flex items-center gap-x-5 add-input-section">
                        <label class="w-[200px]">Minggu</label>
                        <div class="w-full flex items-center justify-between">
                            <input type="text" value="{{ $p->minggu }}"
                                class="bg-[#D9D9D9]/40 w-[40%] py-2 px-5 rounded-lg outline-none" readonly />
                            <div class="flex items-center w-[50%]">
                                <label class="w-[150px]">Persentase</label>
                                <input type="number" value="{{ $p->persen }}"
                                    class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                                <div class="px-2">%</div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="flex items-center gap-x-5">
                    <div class="w-[200px]"></div>
                    <div class="w-full border-b border-[#BEBEBE]"></div>
                </div>
                <div class="flex items-center gap-x-5">
                    <div class="w-[200px]"></div>
                    <div class="w-full flex justify-between">
                        <div></div>
                        <div class="text-lg">Total Progress <span class="font-bold">{{ $totalProgress }}%</span></div>
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
                            <input type="checkbox" class="w-[35px] h-[35px]" disabled
                                {{ $dataPerusahaan->is_pho ? 'checked' : '' }} />
                        </div>
                        <div class="flex items-center gap-x-3">
                            <label class="flex flex-col text-sm">
                                <span>Progress Kontraktor</span>
                                <span>(Sudah diserahkan ke admin)</span>
                            </label>
                            <input type="checkbox" class="w-[35px] h-[35px]" disabled
                                {{ $dataPerusahaan->is_kontraktor_admin ? 'checked' : '' }} />
                        </div>
                        <div class="flex items-center gap-x-3">
                            <label class="flex flex-col text-sm">
                                <span>Progress Kontraktor</span>
                                <span>(Sudah diambil kontraktor)</span>
                            </label>
                            <input type="checkbox" class="w-[35px] h-[35px]" disabled
                                {{ $dataPerusahaan->is_kontraktor_kontraktor ? 'checked' : '' }} />
                        </div>
                        <div class="flex items-center gap-x-3">
                            <label class="flex flex-col text-sm">
                                <span>RAR Dokumen Konsultan</span>
                                <span>(Sudah diambil kontraktor)</span>
                            </label>
                            <input type="checkbox" class="w-[35px] h-[35px]" disabled
                                {{ $dataPerusahaan->is_konsultan_kontraktor ? 'checked' : '' }} />
                        </div>
                        <div class="flex items-center gap-x-3">
                            <label class="flex flex-col text-sm">
                                <span>Progress Pengawas</span>
                                <span>(Sudah diserahkan ke admin)</span>
                            </label>
                            <input type="checkbox" class="w-[35px] h-[35px]" disabled
                                {{ $dataPerusahaan->is_pengawas_admin ? 'checked' : '' }} />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
