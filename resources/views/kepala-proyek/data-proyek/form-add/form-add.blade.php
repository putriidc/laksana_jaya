@extends('kepala-proyek.layout')
@section('content')
    <div>
        @if (session('error'))
            <div id="flash-message" data-type="error" data-message="{{ session('error') }}"></div>
        @endif
        <h1 class="font-bold text-2xl mb-4 max-[600px]:text-xl">Form Input Data Proyek {{ $perusahaan->nama_perusahaan }}
        </h1>
        <div class="w-full p-8 shadow-[1px_1px_10px_rgba(0,0,0,0.1)] rounded-lg">
            <form action="{{ route('data-perusahaan.store') }}" method="POST" class="flex flex-col w-full gap-y-5">
                @csrf
                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label for="nama_paket" class="w-[200px]">Nama Paket</label>

                    <!-- Select default -->
                    <select id="selectPaket"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none appearance-none cursor-pointer">
                        <option selected disabled>-Pilih Paket-</option>
                        @foreach ($proyek as $p)
                            <option value="{{ $p->nama_proyek }}">{{ $p->nama_proyek }}</option>
                        @endforeach
                    </select>

                    <input id="inputPaket" type="text"
                        class="hidden bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none"
                        placeholder="Ketik nama paket manual">

                    <button type="button" id="togglePaket" class="ml-2 text-blue-500 underline cursor-pointer">
                        Input manual
                    </button>

                </div>


                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label for="" class="w-[200px]">Perusahaan</label>
                    <select name="kode_perusahaan"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none appearance-none cursor-pointer">
                        <option disabled>-Pilih Perusahaan-</option>
                        <option selected value="{{ $perusahaan->kode_perusahaan }}" data-pic="{{ $p->pic->nama ?? '' }}"
                            data-nohp="{{ $p->pic->no_hp ?? '' }}">
                            {{ $perusahaan->nama_perusahaan }}
                        </option>
                    </select>
                </div>
                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label for="" class="w-[200px]">Pengawas</label>
                    <select name="pic"
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none appearance-none cursor-pointer">
                        <option selected disabled>-Pilih Pengawas-</option>
                        @foreach ($pics as $p)
                            <option value="{{ $p->nama }}">{{ $p->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label for="" class="w-[200px]">No Hp</label>
                    <input type="text" name="no_hp" id=""
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                </div>
                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label for="" class="w-[200px]">MC 0</label>
                    <input type="text" data-flatpickr placeholder="Isi Tanggal" name="mc0" id=""
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                </div>
                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label for="" class="w-[200px]">Korlap</label>
                    <input type="text" name="korlap" id=""
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                </div>
                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label for="" class="w-[200px]">Kontraktor</label>
                    <input type="text" name="kontraktor" id=""
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                </div>
                <div class="flex items-center gap-x-5">
                    <div class="w-[200px] max-[600px]:hidden"></div>
                    <span class="font-bold text-left text-lg w-full">Progress</span>
                </div>
                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label for="" class="w-[200px]">Minggu</label>
                    <input type="number" name="minggu" id=""
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                </div>
                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label for="" class="w-[200px]">Persentase</label>
                    <div class="flex w-full items-center">
                        <input type="number" name="persen" id=""
                            class="bg-[#D9D9D9]/40 w-[95%] py-2 px-5 rounded-lg outline-none" />
                        <div class="px-2 text-xl">%</div>
                    </div>
                </div>
                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label for="" class="w-[200px]">Tgl PHO</label>
                    <input type="text" data-flatpickr placeholder="Tanggal PHO" name="tgl_pho" id=""
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                </div>
                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label for="" class="w-[200px]">Tgl Kontraktor Ambil</label>
                    <input type="text" data-flatpickr placeholder="Tanggal kontraktor Ambil" name="tgl_ambil"
                        id="" class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                </div>
                <div class="flex items-center gap-x-5 max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-1">
                    <label for="" class="w-[200px]">Kendala</label>
                    <input type="text" name="kendala" id=""
                        class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                </div>
                <div class="flex items-center gap-x-5">
                    <div class="w-[200px] max-[600px]:hidden"></div>
                    <div class="w-full flex flex-wrap gap-8">
                        <div class="flex items-center gap-x-3">
                            <label for="" class="text-sm">PHO</label>
                            <input type="checkbox" name="is_pho" id=""
                                class="w-[35px] h-[35px] bg-[#D9D9D9]/40 rounded-lg outline-none cursor-pointer focus:bg-[#D9D9D9]/40" />
                        </div>
                        <div class="flex items-center gap-x-3">
                            <label for="" class="flex flex-col text-sm">
                                <span>Progress Kontraktor</span>
                                <span>(Sudah di serahkan ke admin)</span>
                            </label>
                            <input type="checkbox" name="is_kontraktor_admin" id=""
                                class="w-[35px] h-[35px] bg-[#D9D9D9]/40 rounded-lg outline-none cursor-pointer focus:bg-[#D9D9D9]/40" />
                        </div>
                        <div class="flex items-center gap-x-3">
                            <label for="" class="flex flex-col text-sm">
                                <span>Progress Kontraktor</span>
                                <span>(Sudah di ambil kontraktor)</span>
                            </label>
                            <input type="checkbox" name="is_kontraktor_kontraktor" id=""
                                class="w-[35px] h-[35px] bg-[#D9D9D9]/40 rounded-lg outline-none cursor-pointer focus:bg-[#D9D9D9]/40" />
                        </div>
                        <div class="flex items-center gap-x-3">
                            <label for="" class="flex flex-col text-sm">
                                <span>RAR Dokumen Konsultan</span>
                                <span>(Sudah di ambil kontraktor)</span>
                            </label>
                            <input type="checkbox" name="is_konsultan_kontraktor" id=""
                                class="w-[35px] h-[35px] bg-[#D9D9D9]/40 rounded-lg outline-none cursor-pointer focus:bg-[#D9D9D9]/40" />
                        </div>
                        <div class="flex items-center gap-x-3">
                            <label for="" class="flex flex-col text-sm">
                                <span>Progress Pengawas </span>
                                <span>(Sudah di serahkan ke admin)</span>
                            </label>
                            <input type="checkbox" name="is_pengawas_admin" id=""
                                class="w-[35px] h-[35px] bg-[#D9D9D9]/40 rounded-lg outline-none cursor-pointer focus:bg-[#D9D9D9]/40" />
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-x-5 mt-8">
                    <div class="w-[200px] max-[600px]:hidden"></div>
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
        <script>
            const addInputBtn = document.getElementById('add-input');
            const addInputSection = document.querySelector('.add-input-section');

            addInputBtn.addEventListener('click', function(e) {
                e.preventDefault();

                const newInput = document.createElement('div');
                newInput.classList.add('flex', 'items-center', 'gap-x-5', 'add-input-section');
                // kalo mau setting di sini.
                newInput.innerHTML = `
                    <label for="" class="w-[200px]">Minggu</label>
                    <div class="w-full flex items-center justify-between">
                        <input type="text" name="" id="" class="bg-[#D9D9D9]/40 w-[40%] py-2 px-5 rounded-lg outline-none" />
                        <div class="flex items-center w-[50%]">
                            <label for="" class="w-[150px]">Persentase</label>
                            <input type="number" name="" id="" class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                            <div class="px-2">%</div>
                        </div>
                    </div>
                `;

                addInputSection.parentNode.insertBefore(newInput, addInputSection.nextSibling);
            });
        </script>
        <script>
            const toggleBtn = document.getElementById('togglePaket');
            const selectEl = document.getElementById('selectPaket');
            const inputEl = document.getElementById('inputPaket');

            toggleBtn.addEventListener('click', () => {
                if (selectEl.classList.contains('hidden')) {
                    // balik ke select
                    selectEl.classList.remove('hidden');
                    selectEl.setAttribute('name', 'nama_paket');
                    inputEl.classList.add('hidden');
                    inputEl.removeAttribute('name');
                    toggleBtn.textContent = 'Input manual';
                } else {
                    // ganti ke input manual
                    selectEl.classList.add('hidden');
                    selectEl.removeAttribute('name');
                    inputEl.classList.remove('hidden');
                    inputEl.setAttribute('name', 'nama_paket');
                    toggleBtn.textContent = 'Pilih dari daftar';
                }
            });
        </script>
        <script>
            document.getElementById('selectPaket').addEventListener('change', function() {
                let selected = this.options[this.selectedIndex];
                let pic = selected.getAttribute('data-pic');
                let nohp = selected.getAttribute('data-nohp');

                // isi select PIC
                let picSelect = document.querySelector('select[name="pic"]');
                if (pic) {
                    picSelect.value = pic;
                }

                // isi input No Hp
                let nohpInput = document.querySelector('input[name="no_hp"]');
                if (nohp) {
                    nohpInput.value = nohp;
                }
            });
        </script>
    </div>
@endsection
