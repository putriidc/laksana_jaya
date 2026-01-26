@extends('admin.layout')
@section('content')
    <div>
        <h1 class="text-2xl font-bold mb-5">EAF</h1>
        <div class="flex flex-col gap-y-4 pb-8 border-b border-gray-300 mb-5">
            <div class="flex items-center">
                <span class="w-[180px]">Nama Proyek</span>
                <div class="w-full bg-[#D9D9D9]/40 px-5 py-2 rounded-lg font-bold">
                    {{ $eaf->nama_proyek }}
                </div>
            </div>
            <div class="flex items-center">
                <span class="w-[180px]">Saldo Kas</span>
                <div class="w-full bg-[#D9D9D9]/40 px-5 py-2 rounded-lg font-bold">
                    {{ 'RP. ' . number_format($eaf->nominal, 0, ',', '.') }}
                </div>
            </div>
        </div>
        <div>
            <div class="flex justify-between items-center mb-5">
                <h1 class="text-2xl font-bold">Tabel Rincian</h1>
                <div class="flex items-center gap-x-2">
                    @php
                        $detailTanggal = $eaf->details->first()?->tanggal;
                    @endphp
                    @if ($detailTanggal == $today)
                        <button data-id="{{ $eaf->id }}" data-kode="{{ $eaf->kode_eaf }}"
                            onclick="modalAddRincian(this)"
                            class="flex items-center gap-x-2 border border-[#3E98D0] px-4 py-2 rounded-lg cursor-pointer">
                            <span class="text-[#3E98D0]">Tambah Rincian +</span>
                        </button>
                        <button id="modal-generate" data-id="{{ $eaf->id }}"
                            class="flex items-center gap-x-2 border border-[#45D03E] px-4 py-2 rounded-lg cursor-pointer">
                            <span class="text-[#45D03E]">Generate</span>
                            <img src="{{ asset('assets/card-send-greeen.png') }}" alt="card send icon"
                                class="w-[20px] h-[20px]">
                        </button>
                        <a target="_blank" href="{{ route('eaf-detail.print', $eaf->id) }}"
                            class="flex items-center gap-x-2 border border-orange-400 px-4 py-2 rounded-lg cursor-pointer">
                            <span class="text-orange-400">Cetak</span>
                            <img src="{{ asset('assets/printer-oren.png') }}" alt="card send icon"
                                class="w-[20px] h-[20px]">
                        </a>
                    @endif
                </div>
            </div>
            <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6">
                <table class="table-auto text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[5%]">No</th>
                        <th class="py-2 w-[10%]">Tgl Relasi</th>
                        <th class="py-2 w-[15%]">Kode Akun</th>
                        <th class="py-2 w-[10%]">Nama Akun</th>
                        <th class="py-2 w-[10%]">Keterangan</th>
                        <th class="py-2 w-[15%]">Debet</th>
                        <th class="py-2 w-[15%]">Kredit</th>
                        <th class="py-2 w-[10%]">Action</th>
                    </thead>
                    <tbody>
                        @php
                            $nod = 1;
                        @endphp
                        @foreach ($eaf->details as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->kode_akun }}</td>
                                <td>{{ $item->nama_akun }}</td>
                                <td>{{ $item->keterangan }}</td>
                                <td>{{ 'RP. ' . number_format($item->debit, 0, ',', '.') }}</td>
                                <td>{{ 'RP. ' . number_format($item->kredit, 0, ',', '.') }}</td>
                                <td>
                                    @if ($loop->iteration > 2 && $detailTanggal == $today)
                                        <div class="flex items-center gap-x-2 justify-center">
                                            {{-- Tombol Delete --}}
                                            <form action="{{ route('eaf.destroy', $item->id) }}" method="POST"
                                                class="h-[22px]">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                    <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                        class="w-[22px] cursor-pointer">
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            const modalGenerate = document.getElementById('modal-generate');
            modalGenerate.addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    html: `
            <div>
                <h1 class="font-bold text-2xl text-center mb-5">Lanjutkan Generate Laporan?</h1>
                <div class="w-full flex justify-center items-center">
                    <form action="/eaf/${modalGenerate.dataset.id}/generate" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="bg-[#8CE987] w-[100px] py-2 font-semibold rounded-lg cursor-pointer mx-2">YA</button>
                    </form>
                    <button onclick="Swal.close()" class="bg-[#DD4049] w-[100px] py-2 font-semibold rounded-lg cursor-pointer mx-2">BATAL</button>
                </div>
            </div>
        `,
                    showCancelButton: false,
                    showCloseButton: false,
                    showConfirmButton: false,
                })
            });


            function modalAddRincian(el) {
                const id = el.dataset.id; // ini id EAF
                const kodeEaf = el.dataset.kode; // tambahkan data-kode="{{ $eaf->kode_eaf }}" di tombol

                Swal.fire({
                    html: `
            <div>
                <h1 class="font-bold text-2xl text-center mb-5">Tambah Rincian</h1>
                <form action="/eaf/${id}/detail" method="POST" class="flex flex-col gap-y-4" id="myForm">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="kode_eaf" value="${kodeEaf}">

                    <div class="flex items-center">
                        <label class="w-[240px] text-start">Tanggal Relasi</label>
                        <input type="date" name="tanggal" value="{{ $today }}" readonly
                            class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                    </div>
                    <div class="flex items-center">
                        <label class="w-[240px] text-start">Nama Akun</label>
                        <select name="nama_akun" id="nama_akun" required
                            class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                            <option value="" disabled selected>-Pilih Nama Akun-</option>
                            @foreach ($akun as $item)
                            <option value="{{ $item->nama_akun }}" data-kode="{{ $item->kode_akun }}" data-type="akun">
                                {{ $item->nama_akun }}
                            </option>
                            @endforeach
                            @foreach ($bank as $item)
                            <option value="{{ $item->nama_akun }}" data-kode="{{ $item->kode_akun }}" data-type="bank">
                                {{ $item->nama_akun }}
                            </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="flex items-center">
                        <label class="w-[240px] text-start">Kode Akun</label>
                        <input type="text" name="kode_akun" id="kode_akun" readonly
                            class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                    </div>
                    <div class="flex items-center">
                        <label class="w-[240px] text-start">Keterangan</label>
                        <input type="text" name="keterangan" required
                            class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                    </div>
                    <div class="flex items-center" id="debit-wrapper">
                        <label class="w-[240px] text-start">Debet</label>
                        <input type="text" name="debit" value="0" id="debit"
                            class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 rupiah-format">
                    </div>
                    <div class="flex items-center" id="kredit-wrapper">
                        <label class="w-[240px] text-start">Kredit</label>
                        <input type="text" name="kredit" value="0" id="kredit"
                            class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 rupiah-format">
                    </div>
                    <div class="flex items-center">
                        <label class="w-[240px] text-start">Kategori</label>
                        <select name="kategori" id="kategori"
                            class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                            <option value="" disabled selected>-Pilih Ketegori-</option>
                            <option value="Uang makan" >Uang makan</option>
                            <option value="Nota">Nota</option>
                            <option value="TF toko">TF toko</option>
                            <option value="Fee">Fee</option>
                            <option value="Upah">Upah</option>
                        </select>
                    </div>
                    <div class="flex mt-4 justify-center gap-x-4 text-white">
                        <button type="submit" class="bg-[#8CE987] w-[100px] py-2 font-semibold rounded-lg cursor-pointer">Simpan</button>
                        <button type="button" onclick="Swal.close()" class="bg-[#DD4049] w-[100px] py-2 font-semibold rounded-lg cursor-pointer">Batal</button>
                    </div>
                </form>
            </div>
        `,
                    showConfirmButton: false,
                    didOpen: () => {
                        const select = document.getElementById('nama_akun');
                        const kodeInput = document.getElementById('kode_akun');
                        const debitWrapper = document.getElementById('debit-wrapper');
                        const kreditWrapper = document.getElementById('kredit-wrapper');
                        const debitInput = document.getElementById('debit');
                        const kreditInput = document.getElementById('kredit');

                        // helper untuk set tampilan
                        const showDebitHideKredit = () => {
                            debitWrapper.style.display = 'flex';
                            kreditWrapper.style.display = 'none';
                            // pastikan nilai yang disembunyikan tetap 0 agar aman saat submit
                            kreditInput.value = 0;
                        };
                        const showKreditHideDebit = () => {
                            kreditWrapper.style.display = 'flex';
                            debitWrapper.style.display = 'none';
                            debitInput.value = 0;
                        };

                        // set state awal (sembunyikan keduanya dulu)
                        debitWrapper.style.display = 'none';
                        kreditWrapper.style.display = 'none';

                        select.addEventListener('change', function() {
                            const opt = this.options[this.selectedIndex];
                            const kode = opt.getAttribute('data-kode');
                            const type = opt.getAttribute('data-type');
                            kodeInput.value = kode;

                            if (type === 'bank') {
                                showDebitHideKredit();
                            } else if (type === 'akun') {
                                showDebitHideKredit();
                            } else {
                                // fallback kalau tidak ada type
                                debitWrapper.style.display = 'flex';
                                kreditWrapper.style.display = 'flex';
                            }
                        });

                        // kalau ada default selected (misal dari server), trigger sekali biar state sesuai
                        if (select.value) {
                            const event = new Event('change');
                            select.dispatchEvent(event);
                        }

                        function formatRupiah(angka, prefix) {
                            let number_string = angka.replace(/[^,\d]/g, "").toString(),
                                split = number_string.split(","),
                                sisa = split[0].length % 3,
                                rupiah = split[0].substr(0, sisa),
                                ribuan = split[0].substr(sisa).match(/\d{3}/gi);
                            if (ribuan) {
                                let separator = sisa ? "." : "";
                                rupiah += separator + ribuan.join(".");
                            }
                            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                            return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
                        }
                        // 2. Jalankan fungsi saat input diketik (Event Input)
                        const rupiahInputs = document.querySelectorAll('.rupiah-format');
                        rupiahInputs.forEach(input => {
                            input.addEventListener('input', function(e) {
                                this.value = formatRupiah(this.value, "Rp. ");
                            });
                        });
                        // // 3. FUNGSI KUNCI: Jalankan format saat data pertama kali muncul (untuk EDIT)
                        // Panggil ini tepat setelah modal edit terbuka atau data di-set
                        function inisialisasiRupiah() {
                            const rupiahInputs = document.querySelectorAll('.rupiah-format');
                            rupiahInputs.forEach(input => {
                                if (input.value) {
                                    input.value = formatRupiah(input.value, "Rp. ");
                                }
                            });
                        }
                        // Panggil fungsi ini!
                        inisialisasiRupiah();
                        // 4. Logika Submit (Tetap sama, membersihkan format)
                        const form = document.getElementById('myForm');
                        if (form) {
                            form.addEventListener('submit', function(e) {
                                document.querySelectorAll('.rupiah-format').forEach(input => {
                                    let cleanValue = input.value.replace(/[^0-9]/g, ""); // Lebih aman hapus semua selain angka
                                    input.value = cleanValue;
                                });
                            });
                        }
                    }


                })
            }
        </script>
    </div>
@endsection
