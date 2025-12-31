@extends('owner.layout')
@section('content')
    <div>
        <h1 class="font-bold text-2xl mb-4">Data Management Proyek</h1>
        <section>
            <a href="{{ route('pinjamanKaryawans.create') }}"><button
                    class="cursor-pointer px-5 py-2 border-[#9A9A9A] border-2 rounded-lg flex items-center gap-x-2 bg-white mb-5">
                    <span class="text-[#72686B]">Cetak Data</span>
                    <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                </button></a>
            <div class="rounded-lg shadow-[1px_1px_10px_rgba(0,0,0,0.1)] pt-4 pb-6 max-[1200px]:overflow-x-auto">
                <table class="table-auto text-center text-sm w-full max-[1200px]:w-[1200px]">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[10%]">No</th>
                        <th class="py-2 w-[20%]">Nama Proyek</th>
                        <th class="py-2 w-[18%]">Nilai Kontrak</th>
                        <th class="py-2 w-[18%]">Keuntungan</th>
                        <th class="py-2 w-[18%]">Real Untung</th>
                        <th class="py-2 2-[15%]">Detail</th>
                        <th class="py-2 2-[15%]">Action</th>
                    </thead>
                    <tbody>
                        @foreach ($kontrak as $i => $item)
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">{{ $i + 1 }}</td>
                                <td class="py-2">{{ $item->nama_proyek }}</td>
                                <td class="py-2">Rp {{ number_format($item->nilai_kontrak, 0, ',', '.') }}</td>
                                <td class="py-2">Rp {{ number_format($item->keuntungan, 0, ',', '.') }}</td>
                                <td class="py-2">Rp {{ number_format($item->real_untung, 0, ',', '.') }}</td>
                                <td class="py-2">
                                    <button class="text-blue-400 hover:underline cursor-pointer font-medium"
                                        onclick="detailManagement(
                    '{{ $item->nama_proyek }}',
                    '{{ number_format($item->nilai_kontrak, 0, ',', '.') }}',
                    '{{ number_format($item->dpp, 0, ',', '.') }}',
                    '{{ number_format($item->ppn, 0, ',', '.') }}',
                    '{{ number_format($item->pph, 0, ',', '.') }}',
                    '{{ number_format($item->sisa_potong_pajak, 0, ',', '.') }}',
                    '{{ number_format($item->fee_dinas, 0, ',', '.') }}',
                    '{{ number_format($item->net, 0, ',', '.') }}',
                    '{{ number_format($item->keuntungan, 0, ',', '.') }}',
                    '{{ number_format($item->real_untung, 0, ',', '.') }}'
                )">
                                        Lihat Detail
                                    </button>
                                </td>

                                <td>
                                    <button
                                    onclick="manageKontrak(
    '{{ $item->id }}',
     '{{ $item->kode_proyek }}',
     '{{ $item->nama_proyek }}',
     '{{ $item->nilai_kontrak }}',
     '{{ $item->ppn_persen }}',
     '{{ $item->pph_persen }}',
     '{{ $item->fee_dinas_persen }}',
     '{{ $item->net_persen }}',
)">
                                    <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                        class="w-[22px] cursor-pointer">
                                </button>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </section>
        <script>
            function detailManagement(nama, nilaiKontrak, dpp, ppn, pph, sisaPotong, feeDinas, net, keuntungan, realUntung) {
                Swal.fire({
                    html: `
            <section class="py-3">
                <h1 class="font-bold text-2xl mb-8 uppercase text-start max-[570px]:text-xl">Detail Data Management Proyek</h1>
                <div class="flex flex-col gap-y-5">
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:items-start max-[570px]:gap-y-2">
                        <span class="font-semibold w-[240px] text-start">Nama Proyek</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">${nama}</span>
                    </div>
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:items-start max-[570px]:gap-y-2">
                        <span class="font-semibold w-[240px] text-start">Nilai Kontrak</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp ${nilaiKontrak}</span>
                    </div>
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:items-start max-[570px]:gap-y-2">
                        <span class="font-semibold w-[240px] text-start">DPP</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp ${dpp}</span>
                    </div>
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:items-start max-[570px]:gap-y-2">
                        <span class="font-semibold w-[240px] text-start">PPN</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp ${ppn}</span>
                    </div>
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:items-start max-[570px]:gap-y-2">
                        <span class="font-semibold w-[240px] text-start">PPh</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp ${pph}</span>
                    </div>
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:items-start max-[570px]:gap-y-2">
                        <span class="font-semibold w-[240px] text-start">Sisa Potong Pajak</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp ${sisaPotong}</span>
                    </div>
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:items-start max-[570px]:gap-y-2">
                        <span class="font-semibold w-[240px] text-start">Fee Dinas</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp ${feeDinas}</span>
                    </div>
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:items-start max-[570px]:gap-y-2">
                        <span class="font-semibold w-[240px] text-start">Dana Target</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp ${net}</span>
                    </div>
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:items-start max-[570px]:gap-y-2">
                        <span class="font-semibold w-[240px] text-start">Keuntungan</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp ${keuntungan}</span>
                    </div>
                    <div class="flex justify-between items-center max-[570px]:flex-col max-[570px]:items-start max-[570px]:gap-y-2">
                        <span class="font-semibold w-[240px] text-start">Real Untung</span>
                        <span class="font-medium w-full bg-[#D9D9D9]/40 text-start px-6 py-2 rounded-lg">Rp ${realUntung}</span>
                    </div>
                </div>
            </section>
        `,
                    width: 600,
                    showCancelButton: false,
                    showConfirmButton: false,
                    showCloseButton: true,
                });
            }
        </script>
        <script>
            function manageKontrak(id, kode_proyek, nama_proyek, nilai_kontrak, ppn_persen, pph_persen, fee_dinas_persen, net_persen) {
                Swal.fire({
                    html: `
                            <div class="flex flex-col">
                                <form action="/kontrak/updateKontrak/${id}" method="POST" id="myForm">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="PUT">
                              <h1 class="font-bold text-2xl mb-4">Manage Kontrak</h1>
                                            <input value="${kode_proyek}" type="hidden" name="kode_proyek">
                                 <div class="flex items-center mt-4">
                             <label class="font-medium w-[150px]">Nama Proyek</label>
                                        <div class="flex items-center w-full justify-between">
                                     <input value="${nama_proyek}" type="text" name="nama_proyek" required class="bg-[#D9D9D9]/40 rounded-lg h-[40px] px-4 w-[240px] outline-none">

                                     <div class="flex items-center w-[430px]">
                                     <label class="font-medium w-[45%]">Sisa Potong Pajak</label>
                                      <input type="text" name="sisa_potong_pajak" id="sisa_potong_pajak" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[70%] outline-none mt-2 rupiah-format" readonly>
                                 </div>
                                 </div>
                                 </div>
                                <div class="flex items-center mt-4">
                                <label class="font-medium w-[150px]">Nilai Kontrak</label>
                             <div class="flex items-center w-full justify-between">
                                <input value="${nilai_kontrak}" type="text" name="nilai_kontrak" id="nilai_kontrak" required class="bg-[#D9D9D9]/40 rounded-lg h-[40px] px-4 w-[240px] outline-none rupiah-format">
                                <div class="flex items-center w-[430px]">
                                    <label class="font-medium w-[45%]">Fee Dinas</label>
                                    <input type="text" name="fee_dinas" id="fee_dinas" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[45%] outline-none mt-2 rupiah-format" readonly>
                                <input type="number" name="fee_dinas_persen" id="fee_dinas_persen" value="${fee_dinas_persen}" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[21%] outline-none ml-2 mt-2" placeholder="%">
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
                                     <input type="number" name="net_persen" id="net_persen" value="${net_persen}" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[21%] outline-none ml-2 mt-2" placeholder="%">
                                 </div>
                             </div>
                                </div>
                                  <div class="flex items-center mt-4">
                             <label class="font-medium w-[150px]">PPN</label>
                                <div class="flex items-center w-full justify-between">
                                     <div class="w-[240px]">
                                        <input type="text" name="ppn" id="ppn" required class="bg-[#D9D9D9]/40 rounded-lg h-[40px] w-[60%] px-4 outline-none rupiah-format" readonly>
                                    <input type="number" name="ppn_persen" id="ppn_persen" value="${ppn_persen}" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[30%] outline-none ml-2 mt-2" placeholder="%">
                                  </div>
                                 <div class="flex items-center w-[430px]">
<label class="font-medium w-[45%]">Keuntungan</label>
<input type="text" name="keuntungan" id="keuntungan" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[70%] outline-none mt-2 rupiah-format" readonly>
</div>
</div>
</div>
<div class="flex items-center mt-4">
    <label class="font-medium w-[150px]">PPH</label>
    <div class="flex items-center w-full justify-between">
        <div class="w-[240px]">
            <input type="text" name="pph" id="pph" required class="bg-[#D9D9D9]/40 rounded-lg h-[40px] w-[60%] px-4 outline-none rupiah-format" readonly>
            <input type="number" name="pph_persen" id="pph_persen" value="${pph_persen}" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[30%] outline-none ml-2 mt-2" placeholder="%">
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
<span>Update Data</span>
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
                        const pph = document.getElementById('pph');
                        const pph_persen = document.getElementById('pph_persen');
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
                            const pphPersen = parseFloat(pph_persen.value) || 0;
                            const fdp = parseFloat(fee_dinas_persen.value) || 0;
                            const np = parseFloat(net_persen.value) || 0;

                            const dppVal = nk * 100 / 111;
                            const ppnVal = dppVal * (ppp / 100);
                            const pphVal = dppVal * (pphPersen / 100);
                            const sisaPotongVal = nk - ppnVal - pphVal;
                            const feeDinasVal = sisaPotongVal * (fdp / 100);
                            const netVal = sisaPotongVal * (np / 100);
                            const keuntunganVal = sisaPotongVal - feeDinasVal;
                            const realUntungVal = keuntunganVal - netVal;

                            dpp.value = fmt(dppVal);
                            ppn.value = fmt(ppnVal);
                            pph.value = fmt(pphVal);
                            sisa_potong_pajak.value = fmt(sisaPotongVal);
                            fee_dinas.value = fmt(feeDinasVal);
                            net.value = fmt(netVal);
                            keuntungan.value = fmt(keuntunganVal);
                            real_untung.value = fmt(realUntungVal);
                        }


                        [nilai_kontrak, ppn_persen, pph_persen, fee_dinas_persen, net_persen].forEach(el => {
                            el.addEventListener('input', recalc);
                            el.addEventListener('change', recalc);
                        });


                        // initial calc setelah modal dibuka
                        recalc();

                        // sebelum submit, ubah semua field rupiah jadi angka bersih
                        const form = document.getElementById('myForm');
                        form.addEventListener('submit', () => {
                            [nilai_kontrak, dpp, ppn, pph, sisa_potong_pajak, fee_dinas, net, keuntungan,
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
