@extends('kepala-proyek.layout')
@section('content')
    <div>
        <h1 class="font-bold text-2xl mb-4 max-[418px]:text-xl">Update Data Proyek</h1>
        <div class="w-full p-8 shadow-[1px_1px_10px_rgba(0,0,0,0.1)] rounded-lg">
            <form action="{{ route('data-perusahaan.update', $dataPerusahaan->id) }}" method="POST"
                class="flex flex-col w-full gap-y-5">
                @csrf
                @method('PUT')

                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label class="w-[200px]">Nama Paket</label>
                    <input type="text" name="nama_paket" value="{{ $dataPerusahaan->nama_paket }}"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                </div>
                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label class="w-[200px]">Perusahaan</label>
                    <input type="text" value="{{ $dataPerusahaan->perusahaan->nama_perusahaan }}"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                    <input type="hidden" name="kode_perusahaan" value="{{ $dataPerusahaan->kode_perusahaan }}">
                </div>
                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label for="" class="w-[200px]">Pengawas</label>
                    <select name="pic"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none appearance-none cursor-pointer">
                        <option disabled>-Pilih Pengawas-</option>
                        @foreach ($pics as $p)
                            <option value="{{ $p->akun_header }}"
                                {{ $p->akun_header == $dataPerusahaan->pic ? 'selected' : '' }}>
                                {{ $p->akun_header }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label for="" class="w-[200px]">No Hp</label>
                    <input type="text" name="no_hp" id="" value="{{ $dataPerusahaan->no_hp }}"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                </div>
                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label for="" class="w-[200px]">MC 0</label>
                    <input type="date" name="mc0" id="" value="{{ $dataPerusahaan->mc0 }}"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                </div>
                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label for="" class="w-[200px]">Korlap</label>
                    <input type="text" name="korlap" id="" value="{{ $dataPerusahaan->korlap }}"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                </div>
                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label for="" class="w-[200px]">Kontraktor</label>
                    <input type="text" name="kontraktor" id="" value="{{ $dataPerusahaan->kontraktor }}"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                </div>
                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label for="" class="w-[200px]">Tgl PHO</label>
                    <input type="date" name="tgl_pho" id="" value="{{ $dataPerusahaan->tgl_pho }}"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                </div>
                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label for="" class="w-[200px]">Tgl kontraktor ambil</label>
                    <input type="date" name="tgl_ambil" id="" value="{{ $dataPerusahaan->tgl_ambil }}"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                </div>
                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label for="" class="w-[200px]">Kendala</label>
                    <input type="text" name="kendala" id="" value="{{ $dataPerusahaan->kendala }}"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                </div>
                <div class="flex items-center gap-x-5">
                    <div class="w-[200px] max-[810px]:hidden"></div>
                    <span class="font-bold text-left text-lg w-full">Progress</span>
                </div>

                 <div class="flex items-center gap-x-5 min-[810px]:hidden">
                    <div class="w-[200px] max-[810px]:hidden"></div>
                    <div class="w-full border-b border-[#BEBEBE]"></div>
                </div>

                @foreach ($progres as $p)
                    <div class="flex items-center gap-x-5 add-input-section max-[810px]:hidden">
                        <label class="w-[200px]">Minggu</label>
                        <div class="w-full flex items-center justify-between">
                            <input type="text" value="{{ $p->minggu }}"
                                class="bg-[#D9D9D9]/40 w-[40%] py-2 px-5 rounded-lg outline-none" readonly />
                            <div class="flex items-center w-[50%]">
                                <label class="w-[150px]">Persentase</label>
                                <input type="number" value="{{ $p->persen }}"
                                    class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" readonly />
                                <div class="px-2">%</div>
                                <button type="button" class="ml-4 bg-[#3E98D0] text-amber-300 px-3 py-1 rounded-lg"
                                    onclick="editProgres({{ $p->id }}, {{ $p->minggu }}, {{ $p->persen }})">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-start flex-col w-full gap-y-5 add-input-section min-[810px]:hidden">
                        <div class="flex items-center gap-x-5 w-full max-[810px]:flex-col max-[810px]:items-start max-[810px]:gap-y-1">
                            <label for="" class="w-[200px]">Minggu</label>
                            <input type="text" name="kendala" id="" value="{{ $p->minggu }}"
                                class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                        </div>
                        <div class="flex items-center gap-x-5 w-full max-[810px]:flex-col max-[810px]:items-start max-[810px]:gap-y-1">
                            <label for="" class="w-[200px]">Persentase</label>
                            <input type="text" name="kendala" id="" value="{{ $p->persen }}%"
                                class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                        </div>
                        <button type="button" class="border-[#3E98D0] border text-[#3E98D0] px-8 py-2 rounded-lg"
                            onclick="editProgres({{ $p->id }}, {{ $p->minggu }}, {{ $p->persen }})">
                            Edit
                        </button>
                    </div>
                @endforeach

                <div class="flex items-center gap-x-5 min-[810px]:hidden">
                    <div class="w-[200px] max-[810px]:hidden"></div>
                    <div class="w-full border-b border-[#BEBEBE]"></div>
                </div>
                <div class="flex items-center gap-x-5">
                    <div class="w-[200px] max-[810px]:hidden"></div>
                    <div class="w-full flex justify-between max-[810px]:items-center max-[540px]:flex-col max-[540px]:items-start max-[540px]:gap-y-4">
                        <button type="button"
                            class="border-[#45D03E] border py-1 px-2 rounded-lg flex items-center justify-center cursor-pointer"
                            id="modal-progres">
                            <span class="text-[#45D03E]">Tambah Data</span>
                            <img src="{{ asset('assets/plus-circle-green.png') }}" alt="plus circle green icon"
                                class="inline-block ml-2" />
                        </button>
                        <div class="text-lg">Total Progress <span class="font-bold">{{ $totalProgress }}%</span></div>
                    </div>
                </div>
                <div class="flex items-center gap-x-5">
                    <div class="w-[200px] max-[810px]:hidden"></div>
                    <div class="w-full border-b border-[#BEBEBE]"></div>
                </div>
                <div class="flex items-center gap-x-5">
                    <div class="w-[200px] max-[810px]:hidden"></div>
                    <div class="w-full flex flex-wrap gap-8">
                        <div class="flex items-center gap-x-3">
                            <label class="text-sm">PHO</label>
                            <input type="checkbox" name="is_pho"
                                class="w-[35px] h-[35px] bg-[#D9D9D9]/40 rounded-lg outline-none cursor-pointer"
                                {{ $dataPerusahaan->is_pho ? 'checked' : '' }} />
                        </div>
                        <div class="flex items-center gap-x-3">
                            <label class="flex flex-col text-sm">
                                <span>Progress Kontraktor</span>
                                <span>(Sudah diserahkan ke admin)</span>
                            </label>
                            <input type="checkbox" name="is_kontraktor_admin"
                                class="w-[35px] h-[35px] bg-[#D9D9D9]/40 rounded-lg outline-none cursor-pointer"
                                {{ $dataPerusahaan->is_kontraktor_admin ? 'checked' : '' }} />
                        </div>
                        <div class="flex items-center gap-x-3">
                            <label class="flex flex-col text-sm">
                                <span>Progress Kontraktor</span>
                                <span>(Sudah diambil kontraktor)</span>
                            </label>
                            <input type="checkbox" name="is_kontraktor_kontraktor"
                                class="w-[35px] h-[35px] bg-[#D9D9D9]/40 rounded-lg outline-none cursor-pointer"
                                {{ $dataPerusahaan->is_kontraktor_kontraktor ? 'checked' : '' }} />
                        </div>
                        <div class="flex items-center gap-x-3">
                            <label class="flex flex-col text-sm">
                                <span>RAR Dokumen Konsultan</span>
                                <span>(Sudah diambil kontraktor)</span>
                            </label>
                            <input type="checkbox" name="is_konsultan_kontraktor"
                                class="w-[35px] h-[35px] bg-[#D9D9D9]/40 rounded-lg outline-none cursor-pointer"
                                {{ $dataPerusahaan->is_konsultan_kontraktor ? 'checked' : '' }} />
                        </div>
                        <div class="flex items-center gap-x-3">
                            <label class="flex flex-col text-sm">
                                <span>Progress Pengawas</span>
                                <span>(Sudah diserahkan ke admin)</span>
                            </label>
                            <input type="checkbox" name="is_pengawas_admin"
                                class="w-[35px] h-[35px] bg-[#D9D9D9]/40 rounded-lg outline-none cursor-pointer"
                                {{ $dataPerusahaan->is_pengawas_admin ? 'checked' : '' }} />
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-x-5 mt-8">
                    <div class="w-[200px] max-[810px]:hidden"></div>
                    <div class="w-full">
                        <div class="flex items-center gap-x-4">
                            <button type="submit"
                                class="bg-white border border-[#3E98D0] py-1 px-3 rounded-lg flex items-center justify-center cursor-pointer text-[#3E98D0]">
                                <span>Simpan Data</span>
                                <img src="{{ asset('assets/plus-circle-blue.png') }}" alt="plus circle blue icon"
                                    class="inline-block ml-2" />
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <script>
        const modalProgress = document.getElementById('modal-progres');
        modalProgress.addEventListener('click', function() {
            Swal.fire({
                html: `
                <form action="{{ route('data-perusahaan.progres.store', $dataPerusahaan->id) }}" method="POST" id="form-tambah">
                    @csrf
                    <div class="flex items-center">
                        <div class="w-[280px]"></div>
                        <h1 class="font-bold text-2xl mb-4 w-full text-left">Tambah Progres</h1>
                    </div>
                    <div class="flex items-center mb-4">
                        <label for="minggu" class="w-[300px]">Minggu:</label>
                        <input type="number" id="minggu" name="minggu" class="w-full outline-none bg-[#E9E9E9] rounded-lg px-4 py-2" required>
                    </div>
                    <div class="flex items-center mb-4">
                        <label for="persen" class="w-[300px]">Persentase %:</label>
                        <input type="number" id="persen" name="persen" class="w-full outline-none bg-[#E9E9E9] rounded-lg px-4 py-2" required>
                    </div>
                </form>
            `,
                showCancelButton: true,
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Batal',
                focusConfirm: false,
                preConfirm: () => {
                    const form = document.getElementById('form-tambah');
                    if (form) {
                        form.submit();
                    } else {
                        Swal.showValidationMessage('Form tidak ditemukan');
                    }
                }
            });
        });
        function editProgres(id, minggu, persen) {
            Swal.fire({
                html: `
            <form action="/progres/${id}" method="POST" id="form-edit">
                @csrf
                @method('PUT')
                <div class="flex items-start flex-col gap-y-2 mb-4">
                    <label class="">Minggu:</label>
                    <input type="number" name="minggu" value="${minggu}"
                           class="w-full outline-none bg-[#E9E9E9] rounded-lg px-4 py-2" required>
                </div>
                <div class="flex items-start flex-col gap-y-2 mb-4">
                    <label class="">Persentase %:</label>
                    <input type="number" name="persen" value="${persen}"
                           class="w-full outline-none bg-[#E9E9E9] rounded-lg px-4 py-2" required>
                </div>
            </form>
        `,
                showCancelButton: true,
                confirmButtonText: 'Update',
                cancelButtonText: 'Batal',
                preConfirm: () => {
                    document.getElementById('form-edit').submit();
                }
            });
        }
    </script>
@endsection
