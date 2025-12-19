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
            <input type="text" name="" id="" value="P - Proyek 0025" class="w-full bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
        </div>
        <div class="flex items-center gap-x-2 select-none">
            <label for="" class="w-[200px]">Tgl Mulai</label>
            <input type="text" name="" id="" value="12/05/2023" class="w-full bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
        </div>
        <div class="flex items-center gap-x-2 select-none">
            <label for="" class="w-[200px]">Tgl Selesai</label>
            <input type="text" name="" id="" value="12/06/2023" class="w-full bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
        </div>
        <div class="flex items-center gap-x-2 select-none">
            <label for="" class="w-[200px]">No Kontrak</label>
            <input type="text" name="" id="" value="11/PP/BPA-ST/VI/2025" class="w-full bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
        </div>
        <div class="flex items-center gap-x-2 select-none">
            <label for="" class="w-[200px]">Hari Kalender</label>
            <input type="text" name="" id="" value="30 Hari Kalender" class="w-full bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
        </div>
        <div class="flex items-center gap-x-2 select-none">
            <label for="" class="w-[200px]">Nama Proyek</label>
            <input type="text" name="" id="" value="Mushola DKUKMPP" class="w-full bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
        </div>
        <div class="flex items-center gap-x-2 select-none">
            <label for="" class="w-[200px]">PIC</label>
            <input type="text" name="" id="" value="Endang" class="w-full bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
        </div>
        <div class="flex items-center gap-x-2 select-none">
            <label for="" class="w-[200px]">Perusahaan</label>
            <input type="text" name="" id="" value="CV BAKTI PERDANA" class="w-full bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
        </div>
        <div class="flex items-center gap-x-2 select-none">
            <label for="" class="w-[200px]">Kategori</label>
            <input type="text" name="" id="" value="KONTRUKSI" class="w-full bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
        </div>
        <div class="flex items-center gap-x-2 select-none">
            <label for="" class="w-[200px]">Jenis</label>
            <input type="text" name="" id="" value="PEMERINTAH DAERAH (PEMDA)" class="w-full bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
        </div>
        <div class="flex items-center gap-x-2 select-none">
            <label for="" class="w-[200px]">Nilai Kontrak</label>
            <input type="text" name="" id="" value="Rp. 321.345.000" class="w-full bg-[#D9D9D9]/40 px-4 py-2 rounded-lg" disabled>
        </div>
        {{-- button manage kontrak(sebelum isi manage kontrak) --}}
        <div class="flex items-center gap-x-2 select-none mt-2">
            <label for="" class="w-[165px]"></label>
            <button class="border-2 border-[#3E98D0] flex items-center gap-x-2 py-1 px-4 rounded-lg cursor-pointer" onclick="manageKontrak()">
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
                <span>Nama Proyek : Mushola DKUKMPP</span>
                <span>Total Pengeluaran : <b>Rp. 321.345.000</b> </span>
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
                    <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                        <td class="py-2">1</td>
                        <td class="py-2">2025/12/09</td>
                        <td class="py-2">Uang Makan</td>
                        <td class="py-2">Biaya Gaji Tukang & pengawas lapangan</td>
                        <td class="py-2">Rp. 20.000</td>
                        <td class="py-2">Rp. 1.400.000</td>
                        <td class="py-2">Rp. 200.000</td>
                        <td class="py-2">Rp. 1.400.000</td>
                    </tr>
                    <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                        <td class="py-2">2</td>
                        <td class="py-2">2025/12/09</td>
                        <td class="py-2">Uang Makan</td>
                        <td class="py-2">Biaya Gaji Tukang & pengawas lapangan</td>
                        <td class="py-2">Rp. 20.000</td>
                        <td class="py-2">Rp. 1.400.000</td>
                        <td class="py-2">Rp. 200.000</td>
                        <td class="py-2">Rp. 1.400.000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function manageKontrak() {
            // buat form modal dengan sweetalert2
                Swal.fire({
                    html: `
                    <div class="flex flex-col">
                    <form action="" method="POST" class="flex flex-col text-left" id="myForm">
                        @csrf
                        <h1 class="font-bold text-2xl mb-4">Manage Kontrak</h1>
                        <div class="flex items-center mt-4">
                            <label for="proyek" class="font-medium w-[150px]">Nama Proyek</label>
                            <div class="flex items-center w-full justify-between">
                                <input value="" type="text" name="proyek" id="proyek" required class="bg-[#D9D9D9]/40 rounded-lg h-[40px] px-4 w-[240px] outline-none">
                                <div class="flex items-center w-[430px]">
                                    <label for="debit" class="font-medium w-[45%]">Sisa Potong Pajak</label>
                                    <input type="text" name="debit" id="debit" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[70%] outline-none mt-2 rupiah-format">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <label for="nilai_kontrak" class="font-medium w-[150px]">Nilai Kontrak</label>
                            <div class="flex items-center w-full justify-between">
                                <input value="" type="text" name="nilai_kontrak" id="nilai_kontrak" required class="bg-[#D9D9D9]/40 rounded-lg h-[40px] px-4 w-[240px] outline-none">
                                <div class="flex items-center w-[430px]">
                                    <label for="debit" class="font-medium w-[45%]">Fee Dinas</label>
                                    <input type="text" name="debit" id="debit" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[45%] outline-none mt-2 rupiah-format">
                                    <select name="persen" id="persen" class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[21%] outline-none ml-2 mt-2 appearance-none cursor-pointer">
                                        <option selected disabled>%</option>
                                        <option value="0%">0%</option>
                                        <option value="1%">1%</option>
                                        <option value="1,5%">1,5%</option>
                                        <option value="1,75%">1,75%</option>
                                        <option value="2%">2%</option>
                                        <option value="2,65%">2,65%</option>
                                        <option value="2,65%">2,65%</option>
                                        <option value="4%">4%</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <label for="nilai_kontrak" class="font-medium w-[150px]">DPP</label>
                            <div class="flex items-center w-full justify-between">
                                <input value="" type="text" name="nilai_kontrak" id="nilai_kontrak" required class="bg-[#D9D9D9]/40 rounded-lg h-[40px] px-4 w-[240px] outline-none">
                                <div class="flex items-center w-[430px]">
                                    <label for="debit" class="font-medium w-[45%]">Target Dana/NETT</label>
                                    <input type="text" name="debit" id="debit" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[45%] outline-none mt-2 rupiah-format">
                                    <select name="persen" id="persen" class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[21%] outline-none ml-2 mt-2 appearance-none cursor-pointer">
                                        <option selected disabled>%</option>
                                        <option value="50%">50%</option>
                                        <option value="55%">55%</option>
                                        <option value="60%">60%</option>
                                        <option value="65%">65%</option>
                                        <option value="70%">70%</option>
                                        <option value="75%">75%</option>
                                        <option value="80%">80%</option>
                                        <option value="85%">85%</option>
                                        <option value="90%">90%</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <label for="nilai_kontrak" class="font-medium w-[150px]">PPN</label>
                            <div class="flex items-center w-full justify-between">
                                <div class="w-[240px]">
                                    <input value="" type="text" name="nilai_kontrak" id="nilai_kontrak" required class="bg-[#D9D9D9]/40 rounded-lg h-[40px] w-[68%] px-4 outline-none">
                                    <select name="persen" id="persen" class="bg-[#D9D9D9]/40 rounded-lg py-2 px-3 w-[27%] outline-none ml-1 mt-2 appearance-none cursor-pointer">
                                        <option selected disabled>%</option>
                                        <option value="50%">50%</option>
                                        <option value="55%">55%</option>
                                        <option value="60%">60%</option>
                                        <option value="65%">65%</option>
                                        <option value="70%">70%</option>
                                        <option value="75%">75%</option>
                                        <option value="80%">80%</option>
                                        <option value="85%">85%</option>
                                        <option value="90%">90%</option>
                                    </select>
                                </div>
                                <div class="flex items-center w-[430px]">
                                    <label for="debit" class="font-medium w-[45%]">Keuntungan</label>
                                    <input type="text" name="debit" id="debit" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[70%] outline-none mt-2 rupiah-format">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center mt-6">
                            <label for="tanggal" class="font-medium w-[125px]">Real Untung</label>
                            <input type="text" name="debit" id="debit" required class="bg-[#D9D9D9]/40 rounded-lg h-[40px] px-4 w-[240px] outline-none">
                        </div>
                        <div class="flex items-center mt-6 gap-x-4">
                            <div class="w-[110px]"></div>
                            <button type="submit" class="border-[#3E98D0] border text-[#3E98D0] py-1 px-4 rounded-lg cursor-pointer flex items-center gap-x-2">
                                <span class="">Simpan Data</span>
                                <img src="{{ asset('assets/plus-circle-blue.png') }}" alt="arrow right blue icon" class="w-[30px]">
                            </button>
                            <button type="button" onclick="Swal.close()" class="border-[#DD4049] border text-[#DD4049] py-2 px-4 rounded-lg cursor-pointer flex items-center gap-x-2">
                                <span class="">Batal</span>
                                <img src="{{ asset('assets/close-circle-red.png') }}" alt="arrow right blue icon" class="w-[22px]">
                            </button>
                        </div>
                    </form>
                    </div>
                    `,
                    width: '900px',
                    showCancelButton: false,
                    showCloseButton: false,
                    showConfirmButton: false,
                    didOpen: () => {

                    }
                });
        }
    </script>
</div>
@endsection