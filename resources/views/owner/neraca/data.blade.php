@extends('owner.layout')
@section('content')
<div>
    <div class="mb-5 flex items-center justify-between pb-5 border-b-2 border-[#CCCCCC]">
        <h1 class="text-2xl font-bold">Data Neraca</h1>
        <select name="" id="pilih-neraca" class="py-2 w-[200px] px-4 appearance-none border-2 border-[#9A9A9A] rounded-xl cursor-pointer outline-none">
            <option disabled selected>-Pilih Data Neraca-</option>
            <option value="neraca-lajur">Neraca Lajur</option>
            <option value="neraca-saldo">Neraca Saldo</option>
        </select>
    </div>
    <div class="hidden" id="neraca-lajur">
        <div class="flex justify-between items-center mb-5">
            <h1 class="text-2xl font-bold">Neraca Lajur</h1>
            <a href="" class="flex items-center gap-x-2 border-2 border-[#9A9A9A] rounded-lg px-4 py-2">
                <span class="text-[#72686B]">Cetak Laporan</span>
                <img src="{{ asset('assets/printer.png') }}" alt="">
            </a>
        </div>
        <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6">
        <table class="table-fixed text-center text-sm w-full">
            <thead class="border-b-2 border-[#CCCCCC]">
                <tr>
                    <th rowspan="2">Kode Akun</th>
                    <th rowspan="2">Nama Akun</th>
                    <th rowspan="2">POST Saldo</th>
                    <th colspan="2">Neraca Saldo</th>
                    <th rowspan="2">POST Laporan</th>
                    <th colspan="2">Laba Rugi</th>
                    <th colspan="2">Neraca</th>
                </tr>
                <tr>
                    <th>Debet</th>
                    <th>Kredit</th>
                    <th>Debet</th>
                    <th>Kredit</th>
                    <th>Debet</th>
                    <th>Kredit</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                    <td class="py-2">111</td>
                    <td class="py-2">Kas Bank BCA</td>
                    <td class="py-2">DEBET</td>
                    <td class="py-2">Rp. 5.000.000</td>
                    <td class="py-2">Rp. 5.000.000</td>
                    <td class="py-2">Neraca</td>
                    <td class="py-2">Rp. 5.000.000</td>
                    <td class="py-2">Rp. 5.000.000</td>
                    <td class="py-2">Rp. 5.000.000</td>
                    <td class="py-2">Rp. 5.000.000</td>
                </tr>
                <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                    <td class="py-2">111</td>
                    <td class="py-2">Kas Bank BCA</td>
                    <td class="py-2">DEBET</td>
                    <td class="py-2">Rp. 5.000.000</td>
                    <td class="py-2">Rp. 5.000.000</td>
                    <td class="py-2">Neraca</td>
                    <td class="py-2">Rp. 5.000.000</td>
                    <td class="py-2">Rp. 5.000.000</td>
                    <td class="py-2">Rp. 5.000.000</td>
                    <td class="py-2">Rp. 5.000.000</td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
    <div class="hidden" id="neraca-saldo">
            <h1 class="font-bold text-2xl mb-5">Neraca Saldo</h1>
            <form action="" class="flex gap-x-2 mb-5">
                <select name="" id="" class="border-2 border-[#9A9A9A] rounded-lg py-2 px-4 appearance-none w-[200px] outline-none cursor-pointer">
                    <option selected disabled>-Pilih Bulan-</option>
                    <option value="Januari">Januari</option>
                    <option value="Februari">Februari</option>
                    <option value="Maret">Maret</option>
                    <option value="April">April</option>
                    <option value="Mei">Mei</option>
                    <option value="Juni">Juni</option>
                    <option value="Juli">Juli</option>
                    <option value="Agustus">Agustus</option>
                    <option value="September">September</option>
                    <option value="Oktober">Oktober</option>
                    <option value="November">November</option>
                    <option value="Desember">Desember</option>
                </select>
                <button type="submit" class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2 cursor-pointer">
                    <img src="{{ asset('assets/search-normal.png') }}" alt="" class="w-[20px]">
                </button>
                <a href="" class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2">
                    <img src="{{ asset('assets/printer.png') }}" alt="" class="">
                </a>
            </form>
            <div class="py-10 w-full rounded-xl shadow-[0px_0px_20px_rgba(0,0,0,0.1)]">
                <div class="w-full flex bg-[#E9E9E9] py-2 px-6 mb-3">
                    <span class="font-bold w-[50%]">ASSET LANCAR</span>
                    <span class="font-bold w-[50%]">KEWAJIBAN/EKUITAS</span>
                </div>
                <div class="px-6 flex mb-3">
                    <div class="w-[50%] flex flex-col gap-y-2">
                        <span class="w-full flex items-center justify-between">
                            <p>Aktiva Lancar</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>

                        <span class="w-full flex items-center justify-between">
                            <p>Kas Besar</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>

                        <span class="w-full flex items-center justify-between">
                            <p>Kas Kecil</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>

                        <span class="w-full flex items-center justify-between">
                            <p>Kas Bank BCA</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>

                        <span class="w-full flex items-center justify-between">
                            <p>Piutang Usaha</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>

                        <span class="w-full flex items-center justify-between">
                            <p>Piutang Proyek</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>

                        <span class="w-full flex items-center justify-between">
                            <p>Piutang Karyawan</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>

                        <span class="w-full flex items-center justify-between">
                            <p>Persediaan Material</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>

                        <span class="w-full flex items-center justify-between">
                            <p>Uang Muka PPh</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>

                        <span class="w-full flex items-center justify-between">
                            <p>Kas Flip</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>

                        <span class="w-full flex items-center justify-between">
                            <p>Piutang Pihak Lain</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>

                        <span class="w-full flex items-center justify-between">
                            <p>Piutang Mando/Tukang</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>
                    </div>
                    <div class="w-[50%] flex flex-col gap-y-2">
                        <span class="w-full flex items-center justify-between">
                            <p>Kewajiban Lancar</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>

                        <span class="w-full flex items-center justify-between">
                            <p>Hutang Usaha</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>

                        <span class="w-full flex items-center justify-between">
                            <p>Hutang Pihak ke-3</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>

                        <span class="w-full flex items-center justify-between">
                            <p>Hutang PPN</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>

                        <span class="w-full flex items-center justify-between">
                            <p>Uang Muka Proyek</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>

                        <span class="w-full flex items-center justify-between">
                            <p>Hutang Bank</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>
                    </div>
                </div>
                <div class="w-full flex bg-[#E9E9E9] py-2 px-6 mb-6">
                    <span class="font-bold w-[50%] flex items-center justify-between">
                        <p>JUMLAH AKTIVA LANCAR</p>
                        <p class="w-[180px]">Rp.</p>
                    </span>
                    <span class="font-bold w-[50%] flex items-center justify-between">
                        <p>JUMLAH KEWAJIBAN</p>
                        <p class="w-[180px]">Rp.</p>
                    </span>
                </div>
                <div class="w-full flex bg-[#E9E9E9] py-2 px-6 mb-3">
                    <span class="font-bold w-[50%]">AKTIVA TETAP</span>
                    <span class="font-bold w-[50%]">MODAL</span>
                </div>
                <div class="px-6 flex mb-3">
                    <div class="w-[50%] flex flex-col gap-y-2">
                        <span class="w-full flex items-center justify-between">
                            <p>Tanah</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>

                        <span class="w-full flex items-center justify-between">
                            <p>Bangunan</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>

                        <span class="w-full flex items-center justify-between">
                            <p>Peralatan Kantor</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>

                        <span class="w-full flex items-center justify-between">
                            <p>Peralatan Workshop Interior</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>

                        <span class="w-full flex items-center justify-between">
                            <p>Kendaraan Operasional</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>

                        <span class="w-full flex items-center justify-between">
                            <p>Akum. Peny. Bangunan</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>

                        <span class="w-full flex items-center justify-between">
                            <p>Akum. Peny. Peralatan Kantor</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>

                        <span class="w-full flex items-center justify-between">
                            <p>Akum. Peny. Mesin & Peralatan Pompa</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>

                        <span class="w-full flex items-center justify-between">
                            <p>Akum. Peny. Kendaraan Operasional</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>
                    </div>
                    <div class="w-[50%] flex flex-col gap-y-2">
                        <span class="w-full flex items-center justify-between">
                            <p>Modal</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>

                        <span class="w-full flex items-center justify-between">
                            <p>Laba Ditahan</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>

                        <span class="w-full flex items-center justify-between">
                            <p>Laba Tahun Berjalan</p>
                            <p class="w-[180px] text-[#9A9A9A]">Rp.</p>
                        </span>
                    </div>
                </div>
                <div class="w-full flex bg-[#E9E9E9] py-2 px-6 mb-3">
                    <span class="font-bold w-[50%] flex items-center justify-between">
                        <p>JUMLAH AKTIVA TETAP</p>
                        <p class="w-[180px]">Rp.</p>
                    </span>
                    <span class="font-bold w-[50%] flex items-center justify-between">
                        <p>JUMLAH MODAL</p>
                        <p class="w-[180px]">Rp.</p>
                    </span>
                </div>
                <div class="w-full flex bg-[#E9E9E9] py-2 px-6">
                    <span class="font-bold w-[50%] flex items-center justify-between">
                        <p>TOTAL AKTIVA</p>
                        <p class="w-[180px]">Rp.</p>
                    </span>
                    <span class="font-bold w-[50%] flex items-center justify-between">
                        <p>TOTAL PASIVA</p>
                        <p class="w-[180px]">Rp.</p>
                    </span>
                </div>
            </div>
    </div>
    <script>
        const selectNeraca = document.getElementById('pilih-neraca')
        const neracaLajur  = document.getElementById('neraca-lajur')
        const neracaSaldo = document.getElementById('neraca-saldo')
        selectNeraca.addEventListener('change', () => {
            if (selectNeraca.value === 'neraca-lajur') {
                neracaLajur.classList.remove('hidden')
                neracaSaldo.classList.add('hidden')
            } else if (selectNeraca.value === 'neraca-saldo') {
                neracaLajur.classList.add('hidden')
                neracaSaldo.classList.remove('hidden')
            }
            
        })
    </script>
</div>
@endsection