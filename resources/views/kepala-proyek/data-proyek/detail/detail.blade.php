@extends('kepala-proyek.layout')
@section('content')
    <div>
        <h1 class="font-bold text-2xl mb-4 max-[600px]:text-xl">Detail Data Proyek</h1>

        <div class="flex gap-x-4 mb-8 max-[600px]:flex-col max-[600px]:gap-y-2">
            <a target="_blank" href="{{ route('data-perusahaan.print', $dataPerusahaan->id) }}"
                class="flex items-center border border-gray-600 text-gray-600 w-fit px-4 py-2 rounded-lg">
                <span>Cetak Data</span>
                <img src="{{ asset('assets/printer.png') }}" alt="icon printer" class="inline-block ml-3" />
            </a>
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
                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label class="w-[200px]">Nama Paket</label>
                    <input type="text" value="{{ $dataPerusahaan->nama_paket }}"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label class="w-[200px]">Perusahaan</label>
                    <input type="text" value="{{ $dataPerusahaan->perusahaan->nama_perusahaan }}"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label class="w-[200px]">Pengawas</label>
                    <input type="text" value="{{ $dataPerusahaan->pic }}"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label class="w-[200px]">No Hp</label>
                    <input type="text" value="{{ $dataPerusahaan->no_hp }}"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label class="w-[200px]">MC 0</label>
                    <input type="date" value="{{ $dataPerusahaan->mc0 }}"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label class="w-[200px]">Korlap</label>
                    <input type="text" value="{{ $dataPerusahaan->korlap }}"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label class="w-[200px]">Kontraktor</label>
                    <input type="text" value="{{ $dataPerusahaan->kontraktor }}"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label class="w-[200px]">Tgl PHO</label>
                    <input type="date" value="{{ $dataPerusahaan->tgl_pho }}"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label class="w-[200px]">Tgl Kontraktor Ambil</label>
                    <input type="date" value="{{ $dataPerusahaan->tgl_ambil }}"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>
                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label class="w-[200px]">Kendala</label>
                    <input type="text" value="{{ $dataPerusahaan->kendala }}"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                </div>

                <div class="flex items-center gap-x-5">
                    <div class="w-[200px] max-[600px]:hidden"></div>
                    <span class="font-bold text-left text-lg w-full">Progress</span>
                </div>

                @foreach ($progres as $p)
                    <div class="flex items-center gap-x-5 add-input-section">
                        <label class="w-[200px]"></label>
                        <div class="w-full flex items-center justify-between gap-x-4">
                            <div class="flex flex-col gap-y-1">
                                <label class="">Minggu</label>
                                <input type="text" value="{{ $p->minggu }}"
                                class="bg-[#D9D9D9]/40 w-[100px] py-2 px-5 rounded-lg outline-none" readonly />
                            </div>
                            <div class="flex flex-col gap-y-1">
                                <label class="">Persentase</label>
                                <div class="w-[120px] flex items-center">
                                    <input type="number" value="{{ $p->persen }}"
                                    class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                                    <div class="px-2">%</div>
                                </div>
                            </div>
                            <div class="flex flex-col gap-y-1 grow">
                                <label for="keterangan_{{ $p->id }}" class="">Keterangan</label>
                                <textarea name="keterangan[{{ $p->id }}]" id="keterangan_{{ $p->id }}"
                                    class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" rows="1"
                                    placeholder="Isi keterangan di sini" readonly>{{ $p->keterangan }}</textarea>
                            </div>
                        </div>
                    </div>
                    {{-- <div
                        class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1 min-[600px]:hidden">
                        <label class="w-[200px]">Minggu</label>
                        <input type="text" value="{{ $p->minggu }}"
                            class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                    </div>
                    <div
                        class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1 min-[600px]:hidden">
                        <label class="w-[200px]">Persentase</label>
                        <input type="text" value="{{ $p->persen }}%"
                            class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                    </div>
                    <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start">
                        <label for="keterangan_{{ $p->id }}" class="w-[200px]">Keterangan</label>
                        <textarea name="keterangan[{{ $p->id }}]" id="keterangan_{{ $p->id }}"
                            class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" rows="3"
                            placeholder="Isi keterangan di sini" readonly>{{ $p->keterangan }}</textarea>
                    </div> --}}
                @endforeach

                <div class="flex items-center gap-x-5">
                    <div class="w-[200px] max-[600px]:hidden"></div>
                    <div class="w-full border-b border-[#BEBEBE]"></div>
                </div>
                <div class="flex items-center gap-x-5">
                    <div class="w-[200px] max-[600px]:hidden"></div>
                    <div class="w-full flex justify-between">
                        <div></div>
                        <div class="text-lg">Total Progress <span class="font-bold">{{ $totalProgress }}%</span></div>
                    </div>
                </div>

                <div class="flex items-center gap-x-5">
                    <div class="w-[200px] max-[600px]:hidden"></div>
                    <div class="w-full border-b border-[#BEBEBE]"></div>
                </div>

                <div class="flex items-center gap-x-5">
                    <div class="w-[200px] max-[600px]:hidden"></div>
                    <div class="w-full flex flex-wrap gap-8">
                        <div class="flex items-center gap-x-3">
                            <label for="" class="flex flex-col text-sm">
                                <span>Progress Kontraktor</span>
                                <span>(Sudah di serahkan ke admin)</span>
                            </label>
                            <input type="checkbox" name="is_kontraktor_admin" id="" disabled
                                class="w-[35px] h-[35px] bg-[#D9D9D9]/40 rounded-lg outline-none cursor-pointer"
                                {{ $dataPerusahaan->is_kontraktor_admin ? 'checked' : '' }} />
                        </div>
                        <div class="flex items-center gap-x-3">
                            <label for="" class="flex flex-col text-sm">
                                <span>Progress Kontraktor</span>
                                <span>(Sudah di ambil kontraktor)</span>
                            </label>
                            <input type="checkbox" name="is_kontraktor_kontraktor" id="" disabled
                                class="w-[35px] h-[35px] bg-[#D9D9D9]/40 rounded-lg outline-none cursor-pointer"
                                {{ $dataPerusahaan->is_kontraktor_kontraktor ? 'checked' : '' }} />

                        </div>
                        <div class="flex items-center gap-x-3">
                            <label for="" class="flex flex-col text-sm">
                                <span>RAR Dokumen </span>
                                <span>Konsultan</span>
                            </label>
                            <input type="checkbox" name="is_konsultan_kontraktor" id="" disabled
                                class="w-[35px] h-[35px] bg-[#D9D9D9]/40 rounded-lg outline-none cursor-pointe"
                                {{ $dataPerusahaan->is_konsultan_kontraktor ? 'checked' : '' }} />
                        </div>
                        <div class="flex items-center gap-x-3">
                            <label for="" class="flex flex-col text-sm">
                                <span>Progress Pengawas </span>
                                <span>(Sudah di serahkan ke admin)</span>
                            </label>
                            <input type="checkbox" name="is_pengawas_admin" id="" disabled
                                class="w-[35px] h-[35px] bg-[#D9D9D9]/40 rounded-lg outline-none cursor-pointer"
                                {{ $dataPerusahaan->is_pengawas_admin ? 'checked' : '' }} />
                        </div>
                        <div class="flex items-center gap-x-3">
                            <label for="" class="text-sm">Dokumentasi</label>
                            <input type="checkbox" name="is_pho" id="" disabled
                                class="w-[35px] h-[35px] bg-[#D9D9D9]/40 rounded-lg outline-none cursor-pointer"
                                {{ $dataPerusahaan->is_pho ? 'checked' : '' }} />
                        </div>
                        <div class="flex items-center gap-x-3">
                            <label for="" class="flex flex-col text-sm">
                                <span>Gambar</span>
                            </label>
                            <input type="checkbox" name="is_gambar" id="" disabled
                                class="w-[35px] h-[35px] bg-[#D9D9D9]/40 rounded-lg outline-none cursor-pointer"
                                {{ $dataPerusahaan->is_gambar ? 'checked' : '' }} />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
