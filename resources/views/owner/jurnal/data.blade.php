@extends('owner.layout')
@section('content')
    <div>
        <h1 class="font-bold text-2xl mb-6">Jurnal Transaksi</h1>
        <section>
            <div class="flex items-center justify-between mb-5 pb-5 border-b-[1px] border-[#CCCCCC]">
                <div class="flex items-center gap-x-4">
                    <span class="font-medium">Saldo Debet</span>
                    <span
                        class="bg-[#E9E9E9] py-[6px] px-4 w-[200px] rounded-lg font-semibold text-gray-500">Rp.</span>
                </div>
                <div class="flex items-center gap-x-4">
                    <span class="font-medium">Saldo Kredit</span>
                    <span
                        class="bg-[#E9E9E9] py-[6px] px-4 w-[200px] rounded-lg font-semibold text-gray-500">Rp.</span>
                </div>
                <div class="flex items-center gap-x-1">
                    <span class="font-medium mr-4">Status</span>
                    <span
                        class="bg-[#E9E9E9] py-[6px] px-8 rounded-lg font-semibold text-gray-500">Balance</span>
                    <div
                        {{-- class="{{ $status === 'Balance' ? 'bg-[#45D03E] w-[80px] h-[35px] rounded-lg' : 'bg-[#f80707] w-[80px] h-[35px] rounded-lg' }}"> --}}
                        class="bg-[#45D03E] w-[80px] h-[35px] rounded-lg">
                    </div>
                </div>
            </div>
            <div class="flex justify-between items-center pb-4">
                {{-- <a href="{{ route('jurnalUmums.create') }}"
                    class="border-[#9A9A9A] border-2 rounded-lg px-4 py-2 shadow-[0px_0px_10px_rgba(0,0,0,0.1)]">
                    <button class="cursor-pointer">Tambah Data +</button>
                </a> --}}
                <div class="flex items-center gap-x-2">
                    <button onclick="transaksiMasuk()"
                        class="flex items-center gap-x-3 border-2 border-[#9A9A9A] px-4 py-2 rounded-lg cursor-pointer">
                        <span class="text-gray-700">Debit</span>
                        <img src="{{ asset('assets/card-receive.png') }}" alt="card receive icon" class="w-[20px]">
                    </button>
                    <button onclick="transaksiKeluar()"
                        class="flex items-center gap-x-3 border-2 border-[#9A9A9A] px-4 py-2 rounded-lg cursor-pointer">
                        <span class="text-gray-700">Kredit</span>
                        <img src="{{ asset('assets/card-receive.png') }}" alt="card receive icon" class="w-[20px]">
                    </button>
                    <button onclick="transferBank()"
                        class="flex items-center gap-x-3 border-2 border-[#9A9A9A] px-4 py-2 rounded-lg cursor-pointer">
                        <span class="text-gray-700">Transfer Bank</span>
                        <img src="{{ asset('assets/money-send.png') }}" alt="card receive icon" class="w-[20px]">
                    </button>
                </div>
                <form action="{{ route('jurnalUmums.index') }}" method="GET" class="flex items-center gap-x-2">
                    <input type="text" name="start" data-flatpickr placeholder="Tgl Mulai"
                        value="{{ request('start') }}"
                        class="border-[#9A9A9A] border-2 rounded-lg py-2 px-4 w-[170px] outline-none">
                    <input type="text" name="end" data-flatpickr placeholder="Tgl Selesai"
                        value="{{ request('end') }}"
                        class="border-[#9A9A9A] border-2 rounded-lg py-2 px-4 w-[170px] outline-none">
                    <button type="submit"
                        class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                        <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" class="w-[20px]">
                    </button>
                    <a href="{{ route('jurnalUmums.print', ['start' => request('start'), 'end' => request('end')]) }}"
                        class="flex items-center gap-x-3 border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer "
                        target="_blank"><img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                    </a>
                </form>
            </div>
            <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6">
                <table class="table-fixed text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="w-[12%] py-2">
                            Tanggal
                        </th>
                        <th class="w-[22%] py-2">Keterangan</th>
                        <th class="w-[15%] py-2">
                            <div class="flex items-center justify-center">
                                <span>Nama Perkiraan</span>
                                <div x-data="{ open: false, search: '' }" class="relative inline-block">
                                    <button @click="open = !open" class="text-xs px-2 py-1 rounded bg-white">
                                        <img src="{{ asset('assets/filter-search.png') }}" alt="filter icon"
                                            class="w-[20px] cursor-pointer">
                                    </button>

                                    <div x-show="open" x-transition style="display: none;" @click.away="open = false"
                                        class="absolute top-full left-0 mt-1 bg-white border rounded shadow-lg z-10 w-[220px] p-2">

                                        <form method="GET" action="{{ route('jurnalUmums.index') }}"
                                            x-data="{ search: '' }">
                                            <input type="text" x-model="search" placeholder="Cari akun..."
                                                class="w-full mb-2 px-2 py-1 border rounded text-sm">

                                            <!-- Scroll aktif di sini -->
                                            <div class="overflow-y-auto max-h-[200px] pr-1 space-y-1">
                                                    <label class="flex items-center gap-x-2"
                                                        x-show="">
                                                        <input type="checkbox" name="filter_akun[]"
                                                            value="">
                                                        <span></span>
                                                    </label>
                                            </div>

                                            <button type="submit"
                                                class="mt-2 w-full bg-blue-500 text-white py-1 rounded">Terapkan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </th>
                        <th class="w-[10%] py-2">Kd Akun</th>
                        <th class="w-[15%] py-2 relative">
                            <div class="flex items-center justify-center">
                                <span>Nama Proyek</span>
                                <div x-data="{ open: false, search: '' }" class="inline-block relative">
                                    <button @click="open = !open" class="text-xs px-2 py-1 rounded bg-white">
                                        <img src="{{ asset('assets/filter-search.png') }}" alt="card receive icon"
                                            class="w-[20px] cursor-pointer">
                                    </button>

                                    <div x-show="open" x-transition style="display: none;" @click.away="open = false"
                                        class="absolute top-full left-0 mt-1 bg-white border rounded shadow-lg p-2 z-10 w-[220px]">

                                        <form method="GET" action="{{ route('jurnalUmums.index') }}">
                                            <!-- Search input -->
                                            <input type="text" x-model="search" placeholder="Cari proyek..."
                                                class="w-full mb-2 px-2 py-1 border rounded text-sm">

                                            <!-- Scrollable list -->
                                            <div class="max-h-[200px] overflow-y-auto pr-1 space-y-1">
                                                    <label class="flex items-center gap-x-2"
                                                        x-show="">
                                                        <input type="checkbox" name="filter_proyek[]"
                                                            value="">
                                                        <span></span>
                                                    </label>
                                            </div>

                                            <button type="submit"
                                                class="mt-2 w-full bg-blue-500 text-white py-1 rounded">Terapkan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </th>
                        <th class="w-[10%] py-2">Kd Proyek</th>
                        <th class="w-[10%] py-2">Debet</th>
                        <th class="w-[10%] py-2">Kredit</th>
                        {{-- <th class="w-[10%] py-2">Action</th> --}}
                    </thead>
                    <tbody>
                            <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2"></td>
                                <td class="py-2"></td>
                                <td class="py-2"></td>
                                <td class="py-2"></td>
                                <td class="py-2"></td>
                                <td class="py-2"></td>
                                <td class="py-2"></td>
                                <td class="py-2"></td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <script>
            function transaksiMasuk() {
                // buat form modal dengan sweetalert2
                Swal.fire({
                    html: `
                    <div class="flex flex-col">
                    <form action="" method="POST" class="flex flex-col text-left pb-8 border-b border-gray-400" id="myForm">
                        @csrf
                        <h1 class="font-bold text-2xl mb-4">Transaksi Jurnal - Debet</h1>
                        <div class="flex items-center mt-4">
                            <label for="tanggal" class="font-medium w-[150px]">Tgl Transaksi</label>
                            <div class="flex items-center w-full justify-between">
                                <input value="" type="date" name="tanggal" id="tanggal" required class="bg-[#D9D9D9]/40 rounded-lg h-[45px] px-4 w-[220px] outline-none" readonly>
                                <div class="flex items-center w-[370px]">
                                    <label for="kode_akun" class="font-medium w-[40%]">Akun Perkiraan</label>
                                    <select name="nama_perkiraan" id="nama_perkiraan" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[65%] outline-none appearance-none">
                                        <option value="" disabled selected>-Pilih Akun-</option>
                                            <option value="" data-kode="">
                                                
                                            </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <label for="keterangan" class="font-medium w-[150px]">Kas/Bank</label>
                            <div class="flex items-center w-full justify-between">
                                <select name="nama_perkiraan" id="nama_perkiraan" required class="bg-[#D9D9D9]/40 rounded-lg h-[45px] px-4 w-[220px] outline-none appearance-none">
                                    <option disabled selected>-Pilih Kas-</option>
                                    <option value="Kas Utama">Kas Utama</option>
                                    <option value="Kas BCA">Kas BCA</option>
                                    <option value="Kas BJB">Kas BJB</option>
                                    <option value="Kas Besar">Kas Besar</option>
                                    <option value="Kas Kecil">Kas Kecil</option>
                                    <option value="OVO">OVO</option>

                                </select>
                                <div class="flex items-center w-[370px]">
                                    <label for="debit" class="font-medium w-[40%]">Nominal</label>
                                    <input type="text" name="debit" id="debit" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[65%] outline-none mt-2 rupiah-format">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <label for="tanggal" class="font-medium w-[125px]">Keterangan</label>
                            <input type="text" name="debit" id="debit" required class="bg-[#D9D9D9]/40 rounded-lg h-[45px] px-4 w-[220px] outline-none">
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
                    <div class="mt-5">
                        <div class="flex items-center justify-between mb-4">
                            <h1 class="text-2xl font-bold text-start">Data Transaksi</h1>
                            <button class="border-[#45D03E] border text-[#45D03E] py-2 px-4 rounded-lg cursor-pointer flex items-center gap-x-2">
                                <span>Generate</span>
                                <img src="{{ asset('assets/card-send-greeen.png') }}" alt="arrow right blue icon" class="w-[20px]">
                            </button>
                        </div>
                        <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6">
                            <table class="table-fixed text-center text-sm w-full">
                                <thead class="border-b-2 border-[#CCCCCC]">
                                    <th class="w-[10%] py-2">No</th>
                                    <th class="w-[15%] py-2">Akun Perkiraan</th>
                                    <th class="w-[20%] py-2">Keterangan</th>
                                    <th class="w-[15%] py-2">Nominal</th>
                                </thead>
                                <tbody>
                                    <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                        <td class="py-2">1</td>
                                        <td class="py-2">Biaya Material, Alat dan Barang</td>
                                        <td class="py-2">bebas caption</td>
                                        <td class="py-2">Rp. 1.476.500</td>
                                    </tr>
                                    <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                                        <td class="py-2">2</td>
                                        <td class="py-2">Biaya Admin Bank</td>
                                        <td class="py-2">Admin BCA</td>
                                        <td class="py-2">Rp. 2.500</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                    `,
                    width: '850px',
                    showCancelButton: false,
                    showCloseButton: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        // pasang listener setelah modal muncul
                        const select = document.getElementById('nama_perkiraan');
                        const kodeInput = document.getElementById('kode_akun');

                        select.addEventListener('change', function() {
                            let selectedOption = this.options[this.selectedIndex];
                            let kode = selectedOption.getAttribute('data-kode');
                            kodeInput.value = kode;
                        });

                        const rupiahFormat = document.querySelectorAll('.rupiah-format');
                        rupiahFormat.forEach(input => {
                            input.addEventListener('input', function() {
                                let value = this.value.replace(/[^,\d]/g, "").toString();
                                let split = value.split(",");
                                let sisa = split[0].length % 3;
                                let rupiah = split[0].substr(0, sisa);
                                let ribuan = split[0].substr(sisa).match(/\d{3}/gi);
                                let separator = sisa ? "." : "";
                                rupiah += separator + ribuan.join(".");
                                rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                                this.value = rupiah ? "Rp. " + rupiah : "";
                            });
                        });

                        const form = document.getElementById('myForm')
                        if (form) {
                            form.addEventListener('submit', function(e) {
                                const rupiahInputs = document.querySelectorAll('.rupiah-format');
                                rupiahInputs.forEach(input => {
                                    let value = input.value;
                                    let cleanValue = parseInt(value.replace(/[^,\d]/g, ""));
                                    input.value = cleanValue;
                                    console.log(
                                        `Input name: ${input.name}, Clean value: ${input.value}`
                                    );
                                })
                            })
                        }

                    }
                });
            }
            function transaksiKeluar() {
                // buat form modal dengan sweetalert2
                Swal.fire({
                    html: `
                    <div class="flex flex-col">
                    <form action="" method="POST" class="flex flex-col text-left pb-8 border-b border-gray-400" id="myForm">
                        @csrf
                        <h1 class="font-bold text-2xl mb-4">Transaksi Jurnal - Kredit</h1>
                        <div class="flex items-center mt-4">
                            <label for="tanggal" class="font-medium w-[150px]">Tgl Transaksi</label>
                            <div class="flex items-center w-full justify-between">
                                <input value="" type="date" name="tanggal" id="tanggal" required class="bg-[#D9D9D9]/40 rounded-lg h-[45px] px-4 w-[220px] outline-none" readonly>
                                <div class="flex items-center w-[370px]">
                                    <label for="kode_akun" class="font-medium w-[40%]">Akun Perkiraan</label>
                                    <select name="nama_perkiraan" id="nama_perkiraan" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[65%] outline-none appearance-none">
                                        <option value="" disabled selected>-Pilih Akun-</option>
                                      
                                            <option value="" data-kode="">
                                               
                                            </option>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <label for="keterangan" class="font-medium w-[150px]">Kas/Bank</label>
                            <div class="flex items-center w-full justify-between">
                                <select name="nama_perkiraan" id="nama_perkiraan" required class="bg-[#D9D9D9]/40 rounded-lg h-[45px] px-4 w-[220px] outline-none appearance-none">
                                    <option disabled selected>-Pilih Kas-</option>
                                    <option value="Kas Utama">Kas Utama</option>
                                    <option value="Kas BCA">Kas BCA</option>
                                    <option value="Kas BJB">Kas BJB</option>
                                    <option value="Kas Besar">Kas Besar</option>
                                    <option value="Kas Kecil">Kas Kecil</option>
                                    <option value="OVO">OVO</option>

                                </select>
                                <div class="flex items-center w-[370px]">
                                    <label for="debit" class="font-medium w-[40%]">Nominal</label>
                                    <input type="text" name="debit" id="debit" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[65%] outline-none mt-2 rupiah-format">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <label for="tanggal" class="font-medium w-[125px]">Keterangan</label>
                            <input type="text" name="debit" id="debit" required class="bg-[#D9D9D9]/40 rounded-lg h-[45px] px-4 w-[220px] outline-none">
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
                    <div class="mt-5">
                        <div class="flex items-center justify-between mb-4">
                            <h1 class="text-2xl font-bold text-start">Data Transaksi</h1>
                            <button class="border-[#45D03E] border text-[#45D03E] py-2 px-4 rounded-lg cursor-pointer flex items-center gap-x-2">
                                <span>Generate</span>
                                <img src="{{ asset('assets/card-send-greeen.png') }}" alt="arrow right blue icon" class="w-[20px]">
                            </button>
                        </div>
                        <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6">
                            <table class="table-fixed text-center text-sm w-full">
                                <thead class="border-b-2 border-[#CCCCCC]">
                                    <th class="w-[10%] py-2">No</th>
                                    <th class="w-[15%] py-2">Akun Perkiraan</th>
                                    <th class="w-[20%] py-2">Keterangan</th>
                                    <th class="w-[15%] py-2">Nominal</th>
                                </thead>
                                <tbody>
                                    <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                        <td class="py-2">1</td>
                                        <td class="py-2">Biaya Material, Alat dan Barang</td>
                                        <td class="py-2">bebas caption</td>
                                        <td class="py-2">Rp. 1.476.500</td>
                                    </tr>
                                    <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                                        <td class="py-2">2</td>
                                        <td class="py-2">Biaya Admin Bank</td>
                                        <td class="py-2">Admin BCA</td>
                                        <td class="py-2">Rp. 2.500</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                    `,
                    width: '850px',
                    showCancelButton: false,
                    showCloseButton: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        // pasang listener setelah modal muncul
                        const select = document.getElementById('nama_perkiraan');
                        const kodeInput = document.getElementById('kode_akun');

                        select.addEventListener('change', function() {
                            let selectedOption = this.options[this.selectedIndex];
                            let kode = selectedOption.getAttribute('data-kode');
                            kodeInput.value = kode;
                        });

                        const rupiahFormat = document.querySelectorAll('.rupiah-format');
                        rupiahFormat.forEach(input => {
                            input.addEventListener('input', function() {
                                let value = this.value.replace(/[^,\d]/g, "").toString();
                                let split = value.split(",");
                                let sisa = split[0].length % 3;
                                let rupiah = split[0].substr(0, sisa);
                                let ribuan = split[0].substr(sisa).match(/\d{3}/gi);
                                let separator = sisa ? "." : "";
                                rupiah += separator + ribuan.join(".");
                                rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                                this.value = rupiah ? "Rp. " + rupiah : "";
                            });
                        });

                        const form = document.getElementById('myForm')
                        if (form) {
                            form.addEventListener('submit', function(e) {
                                const rupiahInputs = document.querySelectorAll('.rupiah-format');
                                rupiahInputs.forEach(input => {
                                    let value = input.value;
                                    let cleanValue = parseInt(value.replace(/[^,\d]/g, ""));
                                    input.value = cleanValue;
                                    console.log(
                                        `Input name: ${input.name}, Clean value: ${input.value}`
                                    );
                                })
                            })
                        }

                    }
                });
            }

            function transferBank() {
                // buat form modal dengan sweetalert2
                Swal.fire({
                    html: `
                    <form action="{{ route('jurnalUmums.storeBank') }}" method="POST" class="flex flex-col text-left" id="myForm">
                        @csrf
                        <h1 class="font-bold text-2xl mb-4">Transaksi Kas Bank</h1>
                        <div class="flex items-center mt-4">
                            <label for="tanggal" class="font-medium w-[150px]">Tgl Transaksi</label>
                            <div class="flex items-center w-full justify-between">
                                <input value="" type="date" name="tanggal" id="tanggal" required class="bg-[#D9D9D9]/40 rounded-lg h-[45px] px-4 w-[220px] outline-none" readonly>
                                <div class="flex items-center w-[350px]">
                                    <label for="kode_akun" class="font-medium w-[35%]">Ke Kas/Bank</label>
                                    <input type="text" name="kode_perkiraan" id="kode_akun" readonly
                                    class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[65%] outline-none">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <label for="keterangan" class="font-medium w-[150px]">Keterangan</label>
                            <div class="flex items-center w-full justify-between">
                                <input type="text" name="keterangan" id="keterangan" required class="bg-[#D9D9D9]/40 rounded-lg h-[45px] px-4 w-[220px] outline-none">
                                <div class="flex items-center w-[350px]">
                                    <label for="nominal" class="font-medium w-[35%]">Nominal</label>
                                    <input type="text" name="nominal" id="nominal" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[65%] outline-none mt-2 rupiah-format">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <label for="kas/bank" class="font-medium w-[125px]">Dari Kas</label>
                            <select name="" id="" class="bg-[#D9D9D9]/40 rounded-lg h-[45px] px-4 w-[220px] outline-none appearance-none" required>
                                <option selected disabled>-Pilih kas/bank-</option>
                            </select>
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
                    `,
                    width: '800px',
                    showCancelButton: false,
                    showCloseButton: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        // pasang listener setelah modal muncul
                        const select = document.getElementById('nama_perkiraan');
                        const kodeInput = document.getElementById('kode_akun');

                        select.addEventListener('change', function() {
                            let selectedOption = this.options[this.selectedIndex];
                            let kode = selectedOption.getAttribute('data-kode');
                            kodeInput.value = kode;
                        });

                        const rupiahFormat = document.querySelectorAll('.rupiah-format');
                        rupiahFormat.forEach(input => {
                            input.addEventListener('input', function() {
                                let value = this.value.replace(/[^,\d]/g, "").toString();
                                let split = value.split(",");
                                let sisa = split[0].length % 3;
                                let rupiah = split[0].substr(0, sisa);
                                let ribuan = split[0].substr(sisa).match(/\d{3}/gi);
                                let separator = sisa ? "." : "";
                                rupiah += separator + ribuan.join(".");
                                rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                                this.value = rupiah ? "Rp. " + rupiah : "";
                            });
                        });

                        const form = document.getElementById('myForm')
                        if (form) {
                            form.addEventListener('submit', function(e) {
                                const rupiahInputs = document.querySelectorAll('.rupiah-format');
                                rupiahInputs.forEach(input => {
                                    let value = input.value;
                                    let cleanValue = parseInt(value.replace(/[^,\d]/g, ""));
                                    input.value = cleanValue;
                                    console.log(
                                        `Input name: ${input.name}, Clean value: ${input.value}`
                                    );
                                })
                            })
                        }
                    }
                });
            }
            
        </script>

    </div>
@endsection
