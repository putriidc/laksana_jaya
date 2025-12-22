@extends('owner.layout')
@section('content')
    <div>
        <div class="flex items-center justify-between mb-5">
            <button class="flex items-center gap-x-5">
                <span class="text-2xl font-bold">Data Proyek</span>
                <img src="{{ asset('assets/arrow-down.png') }}" alt="">
            </button>
            <a href="" class="flex items-center gap-x-2 border-2 border-[#9A9A9A] py-2 px-3 rounded-lg">
                <span class="text-[#72686B]">Cetak Data</span>
                <img src="{{ asset('assets/printer.png') }}" alt="printer icon">
            </a>
        </div>
        {{-- <div class="py-6 px-10 rounded-lg shadow-[0px_0px_10px_rgba(0,0,0,0.1)] flex flex-col gap-y-5 mb-8">
        <div class="flex items-center gap-x-2 select-none">
            <label for="" class="w-[200px]">Nama Proyek</label>
            <input type="text" name="" id="" value="Mushola DKUKMPP" class="w-full bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
        </div>
    </div> --}}
        <div class="py-10 px-10 rounded-lg shadow-[0px_0px_10px_rgba(0,0,0,0.1)] flex flex-col gap-y-5 mb-8">
            <div class="flex items-center gap-x-2 select-none">
                <label for="" class="w-[200px]">Kode Akun</label>
                <input type="text" name="" id="" value="{{ $proyek->kode_akun }}"
                    class="w-full bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
            </div>
            <div class="flex items-center gap-x-2 select-none">
                <label for="" class="w-[200px]">Tgl Mulai</label>
                <input type="text" name="" id="" value="{{ $proyek->tgl_mulai }}"
                    class="w-full bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
            </div>
            <div class="flex items-center gap-x-2 select-none">
                <label for="" class="w-[200px]">Tgl Selesai</label>
                <input type="text" name="" id="" value="{{ $proyek->tgl_selesai }}"
                    class="w-full bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
            </div>
            <div class="flex items-center gap-x-2 select-none">
                <label for="" class="w-[200px]">No Kontrak</label>
                <input type="text" name="" id="" value="{{ $proyek->no_kontrak }}"
                    class="w-full bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
            </div>
            <div class="flex items-center gap-x-2 select-none">
                <label for="" class="w-[200px]">Hari Kalender</label>
                <input type="text" name="" id="" value="{{ $proyek->hari_kalender }}"
                    class="w-full bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
            </div>
            <div class="flex items-center gap-x-2 select-none">
                <label for="" class="w-[200px]">Nama Proyek</label>
                <input type="text" name="" id="" value="{{ $proyek->nama_proyek }}"
                    class="w-full bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
            </div>
            <div class="flex items-center gap-x-2 select-none">
                <label for="" class="w-[200px]">PIC</label>
                <input type="text" name="" id="" value="{{ $proyek->pic }}"
                    class="w-full bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
            </div>
            <div class="flex items-center gap-x-2 select-none">
                <label for="" class="w-[200px]">Perusahaan</label>
                <input type="text" name="" id="" value="{{ $proyek->nama_perusahaan }}"
                    class="w-full bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
            </div>
            <div class="flex items-center gap-x-2 select-none">
                <label for="" class="w-[200px]">Kategori</label>
                <input type="text" name="" id="" value="{{ $proyek->kategori }}"
                    class="w-full bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
            </div>
            <div class="flex items-center gap-x-2 select-none">
                <label for="" class="w-[200px]">Jenis</label>
                <input type="text" name="" id="" value="{{ $proyek->jenis }}"
                    class="w-full bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
            </div>
            <div class="flex items-center gap-x-2 select-none">
                <label for="" class="w-[200px]">Nilai Kontrak</label>
                <input type="text" name="" id="" value="{{ $proyek->nilai_kontrak }}"
                    class="w-full bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
            </div>
            {{-- button manage kontrak(sebelum isi manage kontrak) --}}
            <div class="flex items-center gap-x-2 select-none mt-2">
                <label for="" class="w-[165px]"></label>
                <button class="border-2 border-[#3E98D0] flex items-center gap-x-2 py-1 px-4 rounded-lg cursor-pointer"
                    onclick="manageKontrak()">
                    <span class="text-[#3E98D0] font-medium">Manage Kontrak</span>
                    <img src="{{ asset('assets/plus-circle-blue.png') }}" alt="plus icon">
                </button>
            </div>
            {{-- button manage kontrak --}}

            {{-- setelah isi manage kontrak --}}
            {{-- <div class="mt-2">
            <h1 class="text-2xl font-bold mb-5">Manage Kontrak</h1>
            <div class="flex flex-col gap-y-5">
                <div class="flex items-center">
                    <label for="" class="w-[210px]">Nama Proyek</label>
                    <div class="w-full flex items-center justify-between">
                        <input type="text" name="" id="" value="Mushola DKUKMPP" class="w-[35%] bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
                        <div class="w-[55%] flex items-center justify-between">
                            <label for="" class="w-[30%]">Sisa Potong Pajak</label>
                            <input type="text" name="" id="" value="Nilai kontrak - PPN - PPH" class="w-[60%] bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
                        </div>
                    </div>
                </div>
                <div class="flex items-center">
                    <label for="" class="w-[210px]">Nilai Kontrak</label>
                    <div class="w-full flex items-center justify-between">
                        <input type="text" name="" id="" value="Rp." class="w-[35%] bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
                        <div class="w-[55%] flex items-center justify-between">
                            <label for="" class="w-[30%]">Fee Dinas</label>
                            <div class="w-[60%] flex items-center justify-between">
                                <input type="text" name="" id="" value="Sisa potong pajak*persentage" class="w-[75%] bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
                                <input type="text" name="" id="" value="%" class="w-[23%] bg-[#D9D9D9]/40 px-2 py-2 rounded-lg text-end" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center">
                    <label for="" class="w-[210px]">DPP</label>
                    <div class="w-full flex items-center justify-between">
                        <input type="text" name="" id="" value="Nilai kontrak*100/111" class="w-[35%] bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
                        <div class="w-[55%] flex items-center justify-between">
                            <label for="" class="w-[30%]">Target Dana</label>
                            <div class="w-[60%] flex items-center justify-between">
                                <input type="text" name="" id="" value="Sisa potong pajak*persentage" class="w-[75%] bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
                                <input type="text" name="" id="" value="%" class="w-[23%] bg-[#D9D9D9]/40 px-2 py-2 rounded-lg text-end" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center">
                    <label for="" class="w-[210px]">PPN</label>
                    <div class="w-full flex items-center justify-between">
                        <div class="w-[35%] flex items-center justify-between">
                            <input type="text" name="" id="" value="DPP*Persentage" class="w-[75%] bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
                            <input type="text" name="" id="" value="%" class="w-[23%] bg-[#D9D9D9]/40 px-2 py-2 rounded-lg text-end" disabled>
                        </div>
                        <div class="w-[55%] flex items-center justify-between">
                            <label for="" class="w-[30%]">Keuntungan</label>
                            <input type="text" name="" id="" value="sisa potong pajak - fee dinas" class="w-[60%] bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
                        </div>
                    </div>
                </div>
                <div class="flex items-center">
                    <label for="" class="w-[210px]">PPN</label>
                    <div class="w-full flex items-center justify-between">
                        <input type="text" name="" id="" value="DPP*Persentage" class="w-[35%] bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
                    </div>
                </div>
            </div>
        </div> --}}
            {{-- setelah isi manage kontrak --}}
        </div>
        <div>
            <h1 class="text-2xl font-bold mb-5">Tabel Pengeluaran</h1>
            <div class="flex items-center justify-between mb-5">
                <span>Nama Proyek : {{ $proyek->nama_proyek }}</span>
                <span>Total Pengeluaran : <b>{{ 'RP. ' . number_format($totalDebit, 0, ',', '.') }}</b> </span>
            </div>
            <div class="rounded-lg shadow-[0px_0px_10px_rgba(0,0,0,0.1)] pt-4 pb-6">
                <table class="table-fixed text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="w-[5%] py-2">No</th>
                        <th class="w-[10%] py-2">Tanggal</th>
                        <th class="w-[15%] py-2">Uraian</th>
                        <th class="w-[25%] py-2">Keterangan</th>
                        <th class="w-[15%] py-2">Biaya Material</th>
                        <th class="w-[18%] py-2">Biaya Material Bank</th>
                        <th class="w-[18%] py-2">Upah & Uang Makan</th>
                        <th class="w-[10%] py-2">Jumlah</th>
                    </thead>
                    <tbody>
                        @foreach ($jurnal as $i => $item)
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">{{ $i + 1 }}</td>
                                <td class="py-2">{{ $item->tanggal }}</td>
                                <td class="py-2">{{ $item->keterangan }}</td>
                                <td class="py-2">{{ $item->nama_perkiraan }}</td>

                                {{-- mapping kategori --}}
                                <td class="py-2">
                                    @if ($item->kategori === 'Nota')
                                        Rp {{ number_format($item->debit, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td class="py-2">
                                    @if ($item->kategori === 'TF toko')
                                        Rp {{ number_format($item->debit, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td class="py-2">
                                    @if (in_array($item->kategori, ['Kasbon', 'Uang makan', 'Fee', 'Upah']))
                                        Rp {{ number_format($item->debit, 0, ',', '.') }}
                                    @endif
                                </td>

                                {{-- jumlah total (misalnya debit) --}}
                                <td class="py-2">
                                    Rp {{ number_format($item->debit, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            function manageKontrak() {
                Swal.fire({
                    html: `
                            <div class="flex flex-col">
                                <form action="/kontrak/storeKontrak" method="POST" id="myForm">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <h1 class="font-bold text-2xl mb-4">Manage Kontrak</h1>
                                            <input value="{{ $proyek->kode_akun }}" type="hidden" name="kode_proyek">
                                 <div class="flex items-center mt-4">
                             <label class="font-medium w-[150px]">Nama Proyek</label>
                                        <div class="flex items-center w-full justify-between">
                                     <input value="{{ $proyek->nama_proyek }}" type="text" name="nama_proyek" required class="bg-[#D9D9D9]/40 rounded-lg h-[40px] px-4 w-[240px] outline-none">

                                     <div class="flex items-center w-[430px]">
                                     <label class="font-medium w-[45%]">Sisa Potong Pajak</label>
                                      <input type="text" name="sisa_potong_pajak" id="sisa_potong_pajak" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[70%] outline-none mt-2 rupiah-format" readonly>
                                 </div>
                                 </div>
                                 </div>
                                <div class="flex items-center mt-4">
                                <label class="font-medium w-[150px]">Nilai Kontrak</label>
                             <div class="flex items-center w-full justify-between">
                                <input value="{{ $proyek->nilai_kontrak }}" type="text" name="nilai_kontrak" id="nilai_kontrak" required class="bg-[#D9D9D9]/40 rounded-lg h-[40px] px-4 w-[240px] outline-none rupiah-format">
                                <div class="flex items-center w-[430px]">
                                    <label class="font-medium w-[45%]">Fee Dinas</label>
                                    <input type="text" name="fee_dinas" id="fee_dinas" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[45%] outline-none mt-2 rupiah-format" readonly>
                                <input type="number" name="fee_dinas_persen" id="fee_dinas_persen" value="0" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[21%] outline-none ml-2 mt-2" placeholder="%">
                                     </div>
                             </div>
                                 </div>
                             <div class="flex items-center mt-4">
                                 <label class="font-medium w-[150px]">DPP</label>
                              <div class="flex items-center w-full justify-between">
                                    <input type="text" name="dpp" id="dpp" required class="bg-[#D9D9D9]/40 rounded-lg h-[40px] px-4 w-[240px] outline-none rupiah-format" readonly>
                                 <div class="flex items-center w-[430px]">
                                     <label class="font-medium w-[45%]">Target Dana/NETT</label>
                                 <input type="text" name="net" id="net" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[45%] outline-none mt-2 rupiah-format" readonly>
                                     <input type="number" name="net_persen" id="net_persen" value="0" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[21%] outline-none ml-2 mt-2" placeholder="%">
                                 </div>
                             </div>
                                </div>
                                  <div class="flex items-center mt-4">
                             <label class="font-medium w-[150px]">PPN</label>
                                <div class="flex items-center w-full justify-between">
                                     <div class="w-[240px]">
                                        <input type="text" name="ppn" id="ppn" required class="bg-[#D9D9D9]/40 rounded-lg h-[40px] w-[60%] px-4 outline-none rupiah-format" readonly>
                                    <input type="number" name="ppn_persen" id="ppn_persen" value="11" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[30%] outline-none ml-2 mt-2" placeholder="%">
                                  </div>
                                 <div class="flex items-center w-[430px]">
<label class="font-medium w-[45%]">Keuntungan</label>
<input type="text" name="keuntungan" id="keuntungan" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[70%] outline-none mt-2 rupiah-format" readonly>
</div>
</div>
</div>
<div class="flex items-center mt-6">
<label class="font-medium w-[125px]">Real Untung</label>
<input type="text" name="real_untung" id="real_untung" required class="bg-[#D9D9D9]/40 rounded-lg h-[40px] px-4 w-[240px] outline-none rupiah-format" readonly>
</div>
<div class="flex items-center mt-6 gap-x-4">
<div class="w-[110px]"></div>
<button type="submit" class="border-[#3E98D0] border text-[#3E98D0] py-1 px-4 rounded-lg cursor-pointer flex items-center gap-x-2">
<span>Simpan Data</span>
</button>
<button type="button" onclick="Swal.close()" class="border-[#DD4049] border text-[#DD4049] py-2 px-4 rounded-lg cursor-pointer flex items-center gap-x-2">
<span>Batal</span>
</button>
</div>
</form>
</div>
`,
                    width: '900px',
                    showConfirmButton: false,
                    didOpen: () => {
                        const parseRupiah = (val) => {
                            if (!val) return 0;
                            return parseInt(val.toString().replace(/[^0-9]/g, ''), 10) || 0;
                        };
                        const fmt = (n) => new Intl.NumberFormat('id-ID').format(Math.max(0, Math.round(n || 0)));

                        const nilai_kontrak = document.getElementById('nilai_kontrak');
                        const dpp = document.getElementById('dpp');
                        const ppn = document.getElementById('ppn');
                        const ppn_persen = document.getElementById('ppn_persen');
                        const sisa_potong_pajak = document.getElementById('sisa_potong_pajak');
                        const fee_dinas = document.getElementById('fee_dinas');
                        const fee_dinas_persen = document.getElementById('fee_dinas_persen');
                        const net = document.getElementById('net');
                        const net_persen = document.getElementById('net_persen');
                        const keuntungan = document.getElementById('keuntungan');
                        const real_untung = document.getElementById('real_untung');

                        function recalc() {
                            const nk = parseRupiah(nilai_kontrak.value);
                            const ppp = parseFloat(ppn_persen.value) || 0;
                            const fdp = parseFloat(fee_dinas_persen.value) || 0;
                            const np = parseFloat(net_persen.value) || 0;

                            const dppVal = nk * 100 / 111;
                            const ppnVal = dppVal * (ppp / 100);
                            const pphVal = 0;
                            const sisaPotongVal = nk - ppnVal - pphVal;
                            const feeDinasVal = sisaPotongVal * (fdp / 100);
                            const netVal = sisaPotongVal * (np / 100);
                            const keuntunganVal = sisaPotongVal - feeDinasVal;
                            const realUntungVal = keuntunganVal - netVal;

                            dpp.value = fmt(dppVal);
                            ppn.value = fmt(ppnVal);
                            sisa_potong_pajak.value = fmt(sisaPotongVal);
                            fee_dinas.value = fmt(feeDinasVal);
                            net.value = fmt(netVal);
                            keuntungan.value = fmt(keuntunganVal);
                            real_untung.value = fmt(realUntungVal);
                        }

                        [nilai_kontrak, ppn_persen, fee_dinas_persen, net_persen].forEach(el => {
                            el.addEventListener('input', recalc);
                            el.addEventListener('change', recalc);
                        });

                        // initial calc setelah modal dibuka
                        recalc();

                        // sebelum submit, ubah semua field rupiah jadi angka bersih
                        const form = document.getElementById('myForm');
                        form.addEventListener('submit', () => {
                            [nilai_kontrak, dpp, ppn, sisa_potong_pajak, fee_dinas, net, keuntungan,
                                real_untung
                            ]
                            .forEach(el => {
                                el.value = parseRupiah(el.value);
                            });
                        });
                    }
                });
            }
        </script>
    </div>
@endsection
