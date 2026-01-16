@extends('owner.layout')
@section('content')
    <div>
        <h1 class="font-bold text-2xl mb-6">Jurnal Umum</h1>
        <section>
            <div
                class="flex items-center justify-between mb-5 pb-5 border-b-[1px] border-[#CCCCCC] max-[790px]:flex-wrap max-[820px]:gap-4 max-[820px]:justify-start">
                <div class="flex items-center gap-x-4 max-[1080px]:flex-col max-[1080px]:items-start max-[1080px]:gap-y-1">
                    <span class="font-medium">Saldo Debet</span>
                    <span
                        class="bg-[#E9E9E9] py-[6px] px-4 w-[200px] rounded-lg font-semibold text-gray-500">{{ 'RP. ' . number_format($totalDebit, 0, ',', '.') }}</span>
                </div>
                <div class="flex items-center gap-x-4 max-[1080px]:flex-col max-[1080px]:items-start max-[1080px]:gap-y-1">
                    <span class="font-medium">Saldo Kredit</span>
                    <span
                        class="bg-[#E9E9E9] py-[6px] px-4 w-[200px] rounded-lg font-semibold text-gray-500">{{ 'RP. ' . number_format($totalKredit, 0, ',', '.') }}</span>
                </div>
                <div class="flex items-center gap-x-1 max-[1080px]:flex-col max-[1080px]:items-start max-[1080px]:gap-y-1">
                    <span class="font-medium mr-4">Status</span>
                    <div class="flex gap-x-1">
                        <span
                            class="bg-[#E9E9E9] py-[6px] px-8 rounded-lg font-semibold text-gray-500">{{ $status }}</span>
                        <div
                            class="{{ $status === 'Balance' ? 'bg-[#45D03E] w-[80px] h-[35px] rounded-lg' : 'bg-[#f80707] w-[80px] h-[35px] rounded-lg' }}">
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="flex justify-between items-center pb-4 max-[820px]:gap-x-8 max-[360px]:gap-x-2 max-[820px]:items-start">
                <div class="flex items-center gap-2 max-[500px]:flex-col max-[820px]:items-start">
                    {{-- <button onclick="transaksiMasuk()" data-url="{{ route('jurnalOwner.storeDebit') }}"
                        data-token="{{ csrf_token() }}"
                        class="flex items-center gap-x-3 border-2 border-[#9A9A9A] px-4 py-2 rounded-lg cursor-pointer">
                        <span class="text-gray-700">Pendapatan</span>
                        <img src="https://ar4n-group.com/public/assets/card-receive.png" alt="card receive icon"
                            class="w-[20px]">
                    </button>
                    <button onclick="transaksiKeluar()" data-url="{{ route('jurnalOwner.storeKredit') }}"
                        data-token="{{ csrf_token() }}"
                        class="flex items-center gap-x-3 border-2 border-[#9A9A9A] px-4 py-2 rounded-lg cursor-pointer">
                        <span class="text-gray-700">Pengeluaran</span>
                        <img src="https://ar4n-group.com/public/assets/card-receive.png" alt="card receive icon"
                            class="w-[20px]">
                    </button>
                    <button onclick="transferBank()"
                        class="flex items-center gap-x-3 border-2 border-[#9A9A9A] px-4 py-2 rounded-lg cursor-pointer">
                        <span class="text-gray-700">Transfer Bank</span>
                        <img src="https://ar4n-group.com/public/assets/money-send.png" alt="card receive icon"
                            class="w-[20px]">
                    </button> --}}

                    <button onclick="transaksiJurnal()"
                        class="flex items-center gap-x-3 border-2 border-[#9A9A9A] px-4 py-2 rounded-lg cursor-pointer">
                        <span class="text-gray-700">Jurnal Transaksi</span>
                        <img src="https://ar4n-group.com/public/assets/money-send.png" alt="card receive icon"
                            class="w-[20px]">
                    </button>
                </div>
                <form action="{{ route('jurnalOwner.index') }}" method="GET"
                    class="flex items-center gap-2 max-[820px]:flex-col max-[820px]:justify-end max-[820px]:items-end">
                    <input type="text" name="start" data-flatpickr placeholder="Tgl Mulai"
                        value="{{ request('start') }}"
                        class="border-[#9A9A9A] border-2 rounded-lg py-2 px-4 w-[170px] outline-none">
                    <input type="text" name="end" data-flatpickr placeholder="Tgl Selesai"
                        value="{{ request('end') }}"
                        class="border-[#9A9A9A] border-2 rounded-lg py-2 px-4 w-[170px] outline-none">
                    <div class="flex gap-x-2">
                        <button type="submit"
                            class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                            <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" class="w-[20px]">
                        </button>
                        <a href="{{ route('jurnalOwner.print', ['start' => request('start'), 'end' => request('end')]) }}"
                            class="flex items-center gap-x-3 border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer "
                            target="_blank"><img src="{{ asset('assets/printer.png') }}" alt="printer icon"
                                class="w-[20px]">
                        </a>
                    </div>
                </form>
            </div>
            <div class="mb-2">
                <button ype="button" onclick="bulkDelete()" id="btn-bulk-delete" class="border border-[#FF4B45] rounded-lg p-2 text-[#FF4B45] cursor-pointer">Hapus <span id="count-selected">0</span> Data</button>
            </div>
            <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6 max-[1200px]:overflow-x-auto">
                <table class="table-fixed text-center text-sm w-full max-[1200px]:w-[1200px]">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="w-[5%]"><input type="checkbox" id="check-all"></th>
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

                                        <form method="GET" action="{{ route('jurnalOwner.index') }}"
                                            x-data="{ search: '' }">
                                            <input type="text" x-model="search" placeholder="Cari akun..."
                                                class="w-full mb-2 px-2 py-1 border rounded text-sm">

                                            <!-- Scroll aktif di sini -->
                                            <div class="overflow-y-auto max-h-[200px] pr-1 space-y-1">
                                                @foreach ($daftarAkun as $item)
                                                    <label class="flex items-center gap-x-2"
                                                        x-show="{{ json_encode($item) }}.toLowerCase().includes(search.toLowerCase())">
                                                        <input type="checkbox" name="filter_akun[]"
                                                            value="{{ $item }}"
                                                            {{ in_array($item, request('filter_akun', [])) ? 'checked' : '' }}>
                                                        <span>{{ $item }}</span>
                                                    </label>
                                                @endforeach
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

                                        <form method="GET" action="{{ route('jurnalOwner.index') }}">
                                            <!-- Search input -->
                                            <input type="text" x-model="search" placeholder="Cari proyek..."
                                                class="w-full mb-2 px-2 py-1 border rounded text-sm">

                                            <!-- Scrollable list -->
                                            <div class="max-h-[200px] overflow-y-auto pr-1 space-y-1">
                                                @foreach ($daftarProyek as $proyek)
                                                    <label class="flex items-center gap-x-2"
                                                        x-show="{{ json_encode($proyek) }}.toLowerCase().includes(search.toLowerCase())">
                                                        <input type="checkbox" name="filter_proyek[]"
                                                            value="{{ $proyek }}"
                                                            {{ in_array($proyek, request('filter_proyek', [])) ? 'checked' : '' }}>
                                                        <span>{{ $proyek }}</span>
                                                    </label>
                                                @endforeach
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
                        <th class="w-[10%] py-2">Action</th>
                    </thead>
                    <tbody>
                        @foreach ($jurnals as $jurnal)
                            <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">
                                    <input type="checkbox" class="data-checkbox" value="{{ $jurnal->id }}"
                                        onchange="updateBulkButton()">
                                </td>
                                <td class="py-2">{{ $jurnal->tanggal }}</td>
                                <td class="py-2">{{ $jurnal->keterangan }}</td>
                                <td class="py-2">{{ $jurnal->nama_perkiraan }}</td>
                                <td class="py-2">{{ $jurnal->kode_perkiraan }}</td>
                                <td class="py-2">{{ $jurnal->nama_proyek }}</td>
                                <td class="py-2">{{ $jurnal->kode_proyek }}</td>
                                <td class="py-2">{{ 'RP. ' . number_format($jurnal->debit, 0, ',', '.') }}</td>
                                <td class="py-2">{{ 'RP. ' . number_format($jurnal->kredit, 0, ',', '.') }}</td>
                                <td class="flex justify-center items-center gap-x-2 py-2">
                                    @if ($jurnal->tanggal == $today)
                                        <button
                                            onclick="editLaporanKeuangan({{ $jurnal->id }},
                                        '{{ $jurnal->tanggal }}',
                                        '{{ $jurnal->keterangan }}',
                                        '{{ $jurnal->kode_perkiraan }}',
                                        '{{ $jurnal->nama_perkiraan }}',
                                        '{{ $jurnal->debit }}',
                                        '{{ $jurnal->kredit }}',
                                        '{{ route('jurnalOwner.update', $jurnal->id) }}'
                                        )"
                                            class="">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                                class="w-[22px] cursor-pointer">
                                        </button>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        <form action="{{ route('jurnalOwner.destroy', $jurnal->id) }}" method="POST"
                                            class="h-[22px]">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                    class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-600 font-bold">Lewat <br> Tanggal</span>
                                    @endif
                                </td>
                                {{-- <td class="flex justify-center items-center gap-x-2 py-2">{{ $jurnal->tanggal }} | {{ $today }}</td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-2">
                <button ype="button" onclick="bulkDelete()" id="btn-bulk-delete"
                    class="border border-[#FF4B45] rounded-lg p-2 text-[#FF4B45] cursor-pointer">Hapus <span
                        id="count-selected">0</span> Data</button>
            </div>
        </section>
        <script>
            function editLaporanKeuangan(id, tanggal, keterangan, kode_perkiraan, nama_perkiraan, debit, kredit, updateUrl) {
                // buat form modal dengan sweetalert2
                Swal.fire({
                    html: `
                    <form action="${updateUrl}" method="POST" class="flex flex-col text-left" id="myForm">
                        @csrf
                        @method('PUT')
                        <h1 class="font-bold text-2xl max-[420px]:text-xl mb-4">Edit Laporan Keuangan</h1>

                        <div class="flex items-center mt-4 max-[850px]:flex-col max-[850px]:items-start max-[850px]:gap-y-2 max-[850px]:order-3">
                            <label for="tanggal" class="font-medium w-[150px] max-[850px]:w-full">Tgl Relasi</label>
                            <div class="flex items-center w-full justify-between max-[850px]:flex-col max-[850px]:items-start max-[850px]:gap-y-4">
                                <input value="${tanggal}" type="date" name="tanggal" id="tanggal" required class="bg-[#D9D9D9]/40 rounded-lg h-[45px] px-4 w-[220px] max-[850px]:w-full outline-none">

                                <div class="flex items-center w-[350px] max-[850px]:w-full max-[850px]:flex-col max-[850px]:items-start max-[850px]:gap-y-2">
                                    <label for="keterangan" class="font-medium w-[35%] max-[850px]:w-full">Keterangan</label>
                                    <input value="${keterangan}" type="text" name="keterangan" id="keterangan" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[65%] max-[850px]:w-full outline-none mt-2 max-[850px]:mt-0">
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center mt-4 max-[850px]:flex-col max-[850px]:items-start max-[850px]:gap-y-2 max-[850px]:order-2">
                            <label for="kode_perkiraan" class="font-medium w-[150px] max-[850px]:w-full">Kode Akun</label>
                            <div class="flex items-center w-full justify-between max-[850px]:flex-col max-[850px]:items-start max-[850px]:gap-y-4">
                                <input value="${kode_perkiraan}" type="text" name="kode_perkiraan" id="kode_perkiraan" readonly required class="bg-[#D9D9D9]/40 rounded-lg h-[45px] px-4 w-[220px] max-[850px]:w-full outline-none">

                                <div class="flex items-center w-[350px] max-[850px]:w-full max-[850px]:flex-col max-[850px]:items-start max-[850px]:gap-y-2">
                                    <label for="debet" class="font-medium w-[35%] max-[850px]:w-full">Debet</label>
                                    <input value="${debit}" type="text" name="debit" id="debet" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[65%] max-[850px]:w-full outline-none mt-2 max-[850px]:mt-0 rupiah-format">
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center mt-4 max-[850px]:flex-col max-[850px]:items-start max-[850px]:gap-y-2 max-[850px]:order-1">
                            <label for="nama_perkiraan" class="font-medium w-[150px] max-[850px]:w-full">Nama Akun</label>
                            <div class="flex items-center w-full justify-between max-[850px]:flex-col max-[850px]:items-start max-[850px]:gap-y-4">
                                <select class="bg-[#D9D9D9]/40 rounded-lg h-[45px] px-4 w-[220px] outline-none appearance-none max-[850px]:w-full" name="nama_perkiraan" id="nama_perkiraan" onchange="syncKodePerkiraan(this)">
                                    <option value="${nama_perkiraan}" selected>${nama_perkiraan}</option>
                                    @foreach ($akun as $item)
                                        <option value="{{ $item->nama_akun }}" data-kode="{{ $item->kode_akun }}">{{ $item->nama_akun }}</option>
                                    @endforeach
                                </select>

                                <div class="flex items-center w-[350px] max-[850px]:w-full max-[850px]:flex-col max-[850px]:items-start max-[850px]:gap-y-2">
                                    <label for="kredit" class="font-medium w-[35%] max-[850px]:w-full">Kredit</label>
                                    <input value="${kredit}" type="text" name="kredit" id="kredit" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[65%] max-[850px]:w-full outline-none mt-2 max-[850px]:mt-0 rupiah-format">
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center mt-6 gap-x-4 max-[420px]:flex-col max-[420px]:items-start max-[420px]:gap-y-2 max-[850px]:order-4">
                            <div class="w-[110px] max-[850px]:hidden"></div>
                            <button type="submit" class="border-[#3E98D0] border text-[#3E98D0] py-1 px-4 rounded-lg cursor-pointer flex items-center gap-x-2">
                                <span>Simpan Data</span>
                                <img src="{{ asset('assets/plus-circle-blue.png') }}" alt="plus icon" class="w-[30px]">
                            </button>
                            <button type="button" onclick="Swal.close()" class="border-[#DD4049] border text-[#DD4049] py-2 px-4 rounded-lg cursor-pointer flex items-center gap-x-2">
                                <span>Batal</span>
                                <img src="{{ asset('assets/close-circle-red.png') }}" alt="close icon" class="w-[22px]">
                            </button>
                        </div>
                    </form>
                    `,
                    width: '800px',
                    showCancelButton: false,
                    showCloseButton: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        const rupiahFormatElements = document.querySelectorAll(".rupiah-format");
                        rupiahFormatElements.forEach((element) => {
                            element.addEventListener("input", function(e) {
                                let value = this.value.replace(/[^,\d]/g, "").toString();
                                let split = value.split(",");
                                let sisa = split[0].length % 3;
                                let rupiah = split[0].substr(0, sisa);
                                let ribuan = split[0].substr(sisa).match(/\d{3}/gi);
                                if (ribuan) {
                                    let separator = sisa ? "." : "";
                                    rupiah += separator + ribuan.join(".");
                                }
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

                        function parseRupiahToNumber(rupiahString) {
                            if (!rupiahString) return 0;
                            return parseInt(rupiahString.replace(/[^0-9]/g, "")) || 0;
                        }
                        // End string to number

                        // number to rupiah format
                        function formatNumberToRupiah(number) {
                            if (!number) return "";
                            return "Rp. " + number.toLocaleString("id-ID");
                        }

                        rupiahFormatElements.forEach((element) => {
                            // Ubah string value ke number dulu untuk dicek
                            const numericValue = parseRupiahToNumber(element.value);

                            // Hanya jalankan format jika ada isinya DAN nilainya bukan 0
                            if (element.value && numericValue !== 0) {
                                element.value = formatNumberToRupiah(numericValue);
                            } else if (numericValue === 0) {
                                // Jika nilainya 0, pastikan tampilannya bersih (hanya angka 0 saja)
                                element.value = "Rp. " + 0;
                            }
                        });
                    }
                });
            }
            // fungsi sinkronisasi kode akun
            function syncKodePerkiraan(select) {
                let kode = select.options[select.selectedIndex].getAttribute('data-kode');
                document.getElementById('kode_perkiraan').value = kode;
            }

            let transaksiDebet = [];

            function transaksiMasuk() {
                Swal.fire({
                    html: `
                    <form id="formKasBank" class="flex flex-col items-start gap-y-4">
                    <h1 class="font-bold text-2xl mb-4">Transaksi Jurnal Pendapatan</h1>

                    <div class="flex flex-col w-full items-start gap-y-2">
                        <label>Kas/Bank</label>
                        <select id="kasBank" class="bg-gray-200 rounded-lg px-4 py-2 w-full appearance-none cursor-pointer">
                            <option disabled selected>-Pilih Kas-</option>
                            @foreach ($bank as $item)
                            <option value="{{ $item->kode_akun }}">{{ $item->nama_akun }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col w-full items-start gap-y-2 pb-5 border-b border-gray">
                        <label>Keterangan</label>
                        <input type="text" id="ketKasBank" class="bg-gray-200 rounded-lg px-4 py-2 w-full">
                    </div>

                    <h2 class="font-bold text-xl">Tambah Rincian Debet</h2>
                    <div class="flex flex-col w-full gap-y-3">
                        <div class="flex flex-col items-start w-full gap-y-1">
                            <label>Nama Akun</label>
                            <select id="namaPerkiraan" class="bg-gray-200 rounded-lg px-4 py-2 w-full text-start">
                                <option></option>
                                @foreach ($akun as $item)
                                    <option value="{{ $item->kode_akun }}">{{ $item->nama_akun }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-col items-start w-full gap-y-1">
                             <label>Keterangan</label>
                            <input type="text" id="ketPerkiraan" placeholder="Keterangan" class="bg-gray-200 rounded-lg px-4 py-2 w-full">
                        </div>
                        <div class="flex flex-col items-start w-full gap-y-1">
                            <label>Nominal</label>
                            <input type="text" id="nominal" placeholder="Nominal" class="bg-gray-200 rounded-lg px-4 py-2 w-full rupiah-format">
                        </div>
                        <button type="button" onclick="addDebet()" class="bg-blue-500 text-white px-3 py-2 rounded w-fit cursor-pointer">Tambah Data +</button>
                    </div>

                    <table id="tableDebet" class="mt-4 w-full text-sm">
                        <thead>
                        <tr class="bg-gray-300">
                        <th>No</th><th>Akun</th><th>Keterangan</th><th>Nominal</th><th>action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    </table>

                    <div class="flex gap-x-4 mt-4">
                    <button type="button" onclick="generateJurnal()" class="bg-green-500 text-white px-4 py-2 rounded cursor-pointer">Generate</button>
                    <button type="button" onclick="Swal.close()" class="bg-red-500 text-white px-4 py-2 rounded cursor-pointer">Batal</button>
                    </div>
                    </form>
                    `,
                    width: '700px',
                    showConfirmButton: false,
                    didOpen: () => {
                        new TomSelect('#namaPerkiraan', {
                            placeholder: 'Cari akun...',
                            create: false,
                            maxItems: 1,
                            hideSelected: true,
                            shouldLoadImmediately: false,
                            sortField: {
                                field: "text",
                                direction: "asc"
                            }
                        });

                        // membuat format rupiah
                        const rupiahFormat = document.querySelectorAll('.rupiah-format');
                        rupiahFormat.forEach(item => {
                            item.addEventListener('input', function(e) {
                                // hapus karakter yang bukan angka atau koma
                                let value = this.value.replace(/[^,\d]/g, "").toString();
                                // pisahkan antara angka dan koma
                                let split = value.split(",");
                                // format angka menjadi rupiah
                                let sisa = split[0].length % 3;
                                // ambil angka yang tidak termasuk dalam kelipatan 3
                                let rupiah = split[0].substr(0, sisa);
                                // ambil angka yang termasuk dalam kelipatan 3
                                let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                                // tambahkan titik sebagai pemisah ribuan
                                if (ribuan) {
                                    let separator = sisa ? "." : "";
                                    rupiah += separator + ribuan.join(".");
                                }

                                // tambahkan kembali koma dan angka di belakangnya jika ada
                                rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                                // tampilkan hasil format rupiah pada input
                                this.value = rupiah ? "Rp. " + rupiah : "";
                            });
                        });

                    }
                });
            }

            function addDebet() {
                let akun = document.getElementById('namaPerkiraan');
                let kode = akun.value;
                let nama = akun.options[akun.selectedIndex]?.text || "";
                let ket = document.getElementById('ketPerkiraan').value;
                let nominalRaw = document.getElementById('nominal').value;

                // ambil angka dari input rupiah
                let cleanNominal = nominalRaw.replace(/[^0-9]/g, '');
                let nominalInt = parseInt(cleanNominal) || 0;

                if (!kode || nominalInt <= 0) {
                    Swal.fire("Oops", "Nama akun dan nominal wajib diisi", "warning");
                    return;
                }

                transaksiDebet.push({
                    kode_akun: kode,
                    nama_akun: nama,
                    keterangan: ket,
                    nominal: nominalInt,
                });

                // reset input setelah tambah
                document.getElementById('namaPerkiraan').value = "";
                document.getElementById('ketPerkiraan').value = "";
                document.getElementById('nominal').value = "";

                renderDebetTable();
            }

            function renderDebetTable() {
                let tbody = document.querySelector('#tableDebet tbody');
                if (transaksiDebet.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="5" class="text-center text-gray-500">Belum ada data debet</td></tr>`;
                    return;
                }

                tbody.innerHTML = transaksiDebet.map((d, i) => `
        <tr>
            <td>${i + 1}</td>
            <td>${d.nama_akun}</td>
            <td>${d.keterangan}</td>
            <td>Rp ${d.nominal.toLocaleString()}</td>
            <td>
                <button type="button" onclick="removeDebet(${i})"
                    class="bg-red-500 text-white px-2 py-1 rounded">
                    Hapus
                </button>
            </td>
        </tr>
    `).join('');
            }

            function removeDebet(index) {
                transaksiDebet.splice(index, 1); // hapus item dari array
                renderDebetTable(); // render ulang tabel
            }

            function generateJurnal() {
                let kasBank = document.getElementById('kasBank');
                let kodeKas = kasBank.value;
                let namaKas = kasBank.options[kasBank.selectedIndex]?.text || "";
                let ketKas = document.getElementById('ketKasBank').value;

                // 🔎 Validasi input dulu
                if (!kodeKas || !ketKas.trim()) {
                    Swal.fire("Oops", "Kas/Bank dan Keterangan wajib diisi", "warning");
                    return;
                }

                if (transaksiDebet.length === 0) {
                    Swal.fire("Oops", "Minimal 1 rincian debet harus ditambahkan", "warning");
                    return;
                }

                let totalNominal = transaksiDebet.reduce((sum, d) => sum + d.nominal, 0);

                let data = [];
                // baris pertama: Kas/Bank (kredit)
                data.push({
                    kode_akun: kodeKas,
                    nama_akun: namaKas,
                    keterangan: ketKas,
                    debit: totalNominal,
                    kredit: 0
                });

                // baris debet
                transaksiDebet.forEach(d => {
                    data.push({
                        kode_akun: d.kode_akun,
                        nama_akun: d.nama_akun,
                        keterangan: d.keterangan,
                        debit: 0,
                        kredit: d.nominal
                    });
                });

                let btn = document.querySelector('[onclick="transaksiMasuk()"]');
                let url = btn.dataset.url;
                let token = btn.dataset.token;

                fetch(url, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": token
                        },
                        body: JSON.stringify({
                            transaksi: data
                        })
                    })
                    .then(res => res.json())
                    .then(res => {
                        if (res.error) {
                            Swal.fire("Error", "Gagal generate: " + res.error, "error");
                        } else {
                            Swal.fire("Sukses", "Data berhasil digenerate ke jurnal umum", "success");
                            transaksiDebet = []; // reset array setelah sukses
                            location.reload();
                        }
                    })
                    .catch(err => {
                        Swal.fire("Error", "Gagal generate: " + err.message, "error");
                    });
            }


            let transaksiKredit = [];

            function transaksiKeluar() {
                // buat form modal dengan sweetalert2
                Swal.fire({
                    html: `
                    <form id="formKasBank" class="flex flex-col items-start gap-y-4">
                    <h1 class="font-bold text-2xl mb-4">Transaksi Jurnal Pengeluaran</h1>

                    <div class="flex flex-col w-full items-start gap-y-2">
                        <label>Kas/Bank</label>
                        <select id="kasBank" class="bg-gray-200 rounded-lg px-4 py-2 w-full appearance-none cursor-pointer">
                            <option disabled selected>-Pilih Kas-</option>
                            @foreach ($bank as $item)
                            <option value="{{ $item->kode_akun }}">{{ $item->nama_akun }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col w-full items-start gap-y-2 pb-5 border-b border-gray">
                        <label>Keterangan</label>
                        <input type="text" id="ketKasBank" class="bg-gray-200 rounded-lg px-4 py-2 w-full">
                    </div>


                    <h2 class="font-bold text-xl">Tambah Rincian Kredit</h2>
                    <div class="flex flex-col w-full gap-y-3">
                        <div class="flex flex-col items-start w-full gap-y-1">
                            <label>Nama Akun</label>
                            <select id="namaPerkiraan" class="bg-gray-200 rounded-lg px-4 py-2 w-full text-start">
                                <option></option>
                                @foreach ($akun as $item)
                                    <option value="{{ $item->kode_akun }}">{{ $item->nama_akun }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-col items-start w-full gap-y-1">
                             <label>Keterangan</label>
                            <input type="text" id="ketPerkiraan" placeholder="Keterangan" class="bg-gray-200 rounded-lg px-4 py-2 w-full">
                        </div>
                        <div class="flex flex-col items-start w-full gap-y-1">
                            <label>Nominal</label>
                            <input type="text" id="nominal" placeholder="Nominal" class="bg-gray-200 rounded-lg px-4 py-2 w-full rupiah-format">
                        </div>
                        <button type="button" onclick="addKredit()" class="bg-blue-500 text-white px-3 py-2 rounded w-fit cursor-pointer">Tambah Data +</button>
                    </div>

                    <table id="tableKredit" class="mt-4 w-full text-sm">
                        <thead>
                        <tr class="bg-gray-300">
                        <th>No</th><th>Akun</th><th>Keterangan</th><th>Nominal</th><th>action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    </table>

                    <div class="flex gap-x-4 mt-4">
                    <button type="button" onclick="generateJurnalKredit()" class="bg-green-500 text-white px-4 py-2 rounded">Generate</button>
                    <button type="button" onclick="Swal.close()" class="bg-red-500 text-white px-4 py-2 rounded">Batal</button>
                    </div>
                    </form>
                    `,
                    width: '700px',
                    showConfirmButton: false,
                    didOpen: () => {
                        new TomSelect('#namaPerkiraan', {
                            placeholder: 'Cari akun...',
                            create: false,
                            maxItems: 1,
                            hideSelected: true,
                            shouldLoadImmediately: false,
                            sortField: {
                                field: "text",
                                direction: "asc"
                            }
                        });

                        // membuat format rupiah
                        const rupiahFormat = document.querySelectorAll('.rupiah-format');
                        rupiahFormat.forEach(item => {
                            item.addEventListener('input', function(e) {
                                // hapus karakter yang bukan angka atau koma
                                let value = this.value.replace(/[^,\d]/g, "").toString();
                                // pisahkan antara angka dan koma
                                let split = value.split(",");
                                // format angka menjadi rupiah
                                let sisa = split[0].length % 3;
                                // ambil angka yang tidak termasuk dalam kelipatan 3
                                let rupiah = split[0].substr(0, sisa);
                                // ambil angka yang termasuk dalam kelipatan 3
                                let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                                // tambahkan titik sebagai pemisah ribuan
                                if (ribuan) {
                                    let separator = sisa ? "." : "";
                                    rupiah += separator + ribuan.join(".");
                                }

                                // tambahkan kembali koma dan angka di belakangnya jika ada
                                rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                                // tampilkan hasil format rupiah pada input
                                this.value = rupiah ? "Rp. " + rupiah : "";
                            });
                        });


                    }
                });
            }


            function addKredit() {
                let akun = document.getElementById('namaPerkiraan');
                let kode = akun.value;
                let nama = akun.options[akun.selectedIndex]?.text || "";
                let ket = document.getElementById('ketPerkiraan').value;
                let nominalRaw = document.getElementById('nominal').value;

                // ambil angka dari input rupiah
                let cleanNominal = nominalRaw.replace(/[^0-9]/g, '');
                let nominalInt = parseInt(cleanNominal) || 0;

                if (!kode || nominalInt <= 0) {
                    Swal.fire("Oops", "Nama akun dan nominal wajib diisi", "warning");
                    return;
                }

                transaksiKredit.push({
                    kode_akun: kode,
                    nama_akun: nama,
                    keterangan: ket,
                    nominal: nominalInt
                });

                // reset input setelah tambah
                document.getElementById('namaPerkiraan').value = "";
                document.getElementById('ketPerkiraan').value = "";
                document.getElementById('nominal').value = "";

                renderKreditTable();
            }

            function renderKreditTable() {
                let tbody = document.querySelector('#tableKredit tbody');
                if (transaksiKredit.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="5" class="text-center text-gray-500">Belum ada data kredit</td></tr>`;
                    return;
                }

                tbody.innerHTML = transaksiKredit.map((d, i) => `
        <tr>
            <td>${i + 1}</td>
            <td>${d.nama_akun}</td>
            <td>${d.keterangan}</td>
            <td>Rp ${d.nominal.toLocaleString()}</td>
            <td>
                <button type="button" onclick="removeKredit(${i})"
                    class="bg-red-500 text-white px-2 py-1 rounded">
                    Hapus
                </button>
            </td>
        </tr>
    `).join('');
            }

            function removeKredit(index) {
                transaksiKredit.splice(index, 1); // hapus item dari array
                renderKreditTable(); // render ulang tabel
            }

            function generateJurnalKredit() {
                let kasBank = document.getElementById('kasBank');
                let kodeKas = kasBank.value;
                let namaKas = kasBank.options[kasBank.selectedIndex]?.text || "";
                let ketKas = document.getElementById('ketKasBank').value;

                if (!kodeKas || !ketKas.trim()) {
                    Swal.fire("Oops", "Kas/Bank dan Keterangan wajib diisi", "warning");
                    return;
                }

                if (transaksiKredit.length === 0) {
                    Swal.fire("Oops", "Minimal 1 rincian debet harus ditambahkan", "warning");
                    return;
                }

                let totalNominal = transaksiKredit.reduce((sum, d) => sum + d.nominal, 0);

                let data = [];

                // baris kredit dulu
                transaksiKredit.forEach(d => {
                    data.push({
                        kode_akun: d.kode_akun,
                        nama_akun: d.nama_akun,
                        keterangan: d.keterangan,
                        debit: d.nominal,
                        kredit: 0
                    });
                });

                // baris terakhir: Kas/Bank (kredit)
                data.push({
                    kode_akun: kodeKas,
                    nama_akun: namaKas,
                    keterangan: ketKas,
                    debit: 0,
                    kredit: totalNominal
                });

                let btn = document.querySelector('[onclick="transaksiKeluar()"]');
                let url = btn.dataset.url;
                let token = btn.dataset.token;

                fetch(url, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": token
                        },
                        body: JSON.stringify({
                            transaksi: data
                        })
                    })
                    .then(res => res.json())
                    .then(res => {
                        if (res.error) {
                            Swal.fire("Error", "Gagal generate: " + res.error, "error");
                        } else {
                            Swal.fire("Sukses", "Data berhasil digenerate ke jurnal umum", "success");
                            transaksiKredit = [];
                            location.reload();
                        }
                    })
                    .catch(err => {
                        Swal.fire("Error", "Gagal generate: " + err.message, "error");
                    });
            }

            function transferBank() {
                // buat form modal dengan sweetalert2
                Swal.fire({
                    html: `
                    <form action="{{ route('jurnalOwner.storeBank') }}" method="POST" class="flex flex-col text-left" id="myForm">
                        @csrf
                        <h1 class="font-bold text-2xl mb-4">Transaksi Kas Bank</h1>
                        <div class="flex items-center mt-4">
                            <label for="tanggal" class="font-medium w-[150px]">Tgl Transaksi</label>
                            <div class="flex items-center w-full justify-between">
                                <input value="{{ $today }}" type="date" name="tanggal" id="tanggal" required class="bg-[#D9D9D9]/40 rounded-lg h-[45px] px-4 w-[220px] outline-none" readonly>
                                <div class="flex items-center w-[350px]">
                                    <label for="kode_akun" class="font-medium w-[35%]">Ke Kas/Bank</label>
                                    <select name="to" id="" class="bg-[#D9D9D9]/40 rounded-lg h-[45px] px-4 w-[220px] outline-none appearance-none" required>
                                <option selected disabled>-Pilih kas/bank-</option>
                                @foreach ($bank as $item)
                                    <option value="{{ $item->kode_akun }}">{{ $item->nama_akun }}</option>
                                @endforeach
                            </select>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <label for="keterangan" class="font-medium w-[150px]">Keterangan</label>
                            <div class="flex items-center w-full justify-between">
                                <input type="text" name="keterangan" id="keterangan" required class="bg-[#D9D9D9]/40 rounded-lg h-[45px] px-4 w-[220px] outline-none">
                                <div class="flex items-center w-[350px]">
                                    <label for="nominal" class="font-medium w-[35%]">Nominal</label>
                                    <input type="text" name="nominal" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[65%] outline-none mt-2 rupiah-format">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <label for="kas/bank" class="font-medium w-[125px]">Dari Kas</label>
                            <select name="from" id="" class="bg-[#D9D9D9]/40 rounded-lg h-[45px] px-4 w-[220px] outline-none appearance-none" required>
                                <option selected disabled>-Pilih kas/bank-</option>
                                @foreach ($bank as $item)
                                    <option value="{{ $item->kode_akun }}">{{ $item->nama_akun }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center mt-6 gap-x-4">
                            <div class="w-[110px]"></div>
                            <button type="submit" class="border-[#3E98D0] border text-[#3E98D0] py-1 px-4 rounded-lg cursor-pointer flex items-center gap-x-2">
                                <span class="">Simpan Data</span>
                                <img src="https://ar4n-group.com/public/assets/plus-circle-blue.png" alt="arrow right blue icon" class="w-[30px]">
                            </button>
                            <button type="button" onclick="Swal.close()" class="border-[#DD4049] border text-[#DD4049] py-2 px-4 rounded-lg cursor-pointer flex items-center gap-x-2">
                                <span class="">Batal</span>
                                <img src="https://ar4n-group.com/public/assets/close-circle-red.png" alt="arrow right blue icon" class="w-[22px]">
                            </button>
                        </div>
                    </form>
                    `,
                    width: '800px',
                    showCancelButton: false,
                    showCloseButton: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        const rupiahFormat = document.querySelectorAll('.rupiah-format');
                        rupiahFormat.forEach(input => {
                            input.addEventListener('input', function() {
                                console.log('test')
                                // hapus karakter yang bukan angka atau koma
                                let value = this.value.replace(/[^,\d]/g, "").toString();
                                // pisahkan antara angka dan koma
                                let split = value.split(",");
                                // format angka menjadi rupiah
                                let sisa = split[0].length % 3;
                                // ambil angka yang tidak termasuk dalam kelipatan 3
                                let rupiah = split[0].substr(0, sisa);
                                // ambil angka yang termasuk dalam kelipatan 3
                                let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                                // tambahkan titik sebagai pemisah ribuan
                                if (ribuan) {
                                    let separator = sisa ? "." : "";
                                    rupiah += separator + ribuan.join(".");
                                }

                                // tambahkan kembali koma dan angka di belakangnya jika ada
                                rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                                // tampilkan hasil format rupiah pada input
                                this.value = rupiah ? "Rp. " + rupiah : "";
                            });
                        });
                        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        const form = document.getElementById('myForm');
                        if (form) {
                            form.addEventListener('submit', function(e) {
                                e.preventDefault(); // cegah submit default

                                // bersihkan input rupiah
                                const rupiahInputs = document.querySelectorAll('.rupiah-format');
                                rupiahInputs.forEach(input => {
                                    let value = input.value;
                                    let cleanValue = parseInt(value.replace(/[^,\d]/g, ""));
                                    input.value = cleanValue;
                                });

                                // kirim pakai fetch
                                const formData = new FormData(form);

                                fetch(form.action, {
                                        method: "POST",
                                        headers: {
                                            "X-CSRF-TOKEN": token,
                                            "X-Requested-With": "XMLHttpRequest"
                                        },
                                        body: formData
                                    })
                                    .then(res => res.json())
                                    .then(res => {
                                        if (res.error) {
                                            Swal.fire("Error", res.error, "error");
                                        } else {
                                            Swal.fire("Sukses", "Transfer kas/bank berhasil dicatat",
                                                "success").then(() => {
                                                location.reload();
                                            });
                                        }
                                    })
                                    .catch(err => {
                                        Swal.fire("Error", "Terjadi kesalahan: " + err.message,
                                            "error");
                                    });
                            });
                        }

                    }
                });
            }

            // Fitur Check All
            document.getElementById('check-all').addEventListener('change', function() {
                const checkboxes = document.querySelectorAll('.data-checkbox');
                checkboxes.forEach(cb => cb.checked = this.checked);
                updateBulkButton();
            });

            // Update tampilan tombol hapus
            function updateBulkButton() {
                const selectedCount = document.querySelectorAll('.data-checkbox:checked').length;
                const btn = document.getElementById('btn-bulk-delete');
                const span = document.getElementById('count-selected');

                if (selectedCount > 0) {
                    btn.classList.remove('hidden');
                    span.innerText = selectedCount;
                } else {
                    btn.classList.add('hidden');
                }
            }

            // Fungsi Eksekusi Hapus Masal
            function bulkDelete() {
                const selectedIds = Array.from(document.querySelectorAll('.data-checkbox:checked'))
                    .map(cb => cb.value);

                Swal.fire({
                    title: 'Hapus data terpilih?',
                    text: `Anda akan menghapus ${selectedIds.length} data sekaligus!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus Semua!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Gunakan Fetch API untuk mengirim data ke Backend
                        fetch("{{ route('jurnalOwner.bulk-delete') }}", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    ids: selectedIds
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire('Berhasil!', data.message, 'success')
                                        .then(() => location.reload()); // Refresh halaman
                                }
                            });
                    }
                });
            }
        </script>
        <script>
            function transaksiJurnal() {
                // buat form modal dengan sweetalert2
                Swal.fire({
                    html: `
                    <form action="{{ route('jurnalOwner.storeTrans') }}" method="POST" class="flex flex-col text-left" id="myForm">
                        @csrf
                        <h1 class="font-bold text-2xl mb-4">Jurnal Transaksi</h1>
                        <div class="flex items-center mt-4">
                            <label for="tanggal" class="font-medium w-[150px]">Dari Akun / Debet</label>
                            <div class="flex items-center w-full justify-between">
                                <select name="from" id="namaPerkiraan" class="bg-[#D9D9D9]/40 rounded-lg h-[45px] px-4 w-[220px] outline-none appearance-none" required>
                                        <option selected disabled>-Pilih Akun-</option>
                                        @foreach ($akun as $item)
                                        <option value="{{ $item->kode_akun }}">{{ $item->nama_akun }}</option>
                                        @endforeach
                                </select>
                                <div class="flex items-center w-[350px]">
                                    <label for="kode_akun" class="font-medium w-[35%]">Ke Akun / Kredit</label>
                                    <select name="to" id="namaPerkiraanTo" class="bg-[#D9D9D9]/40 rounded-lg h-[45px] px-4 w-[220px] outline-none appearance-none" required>
                                        <option selected disabled>-Pilih Akun-</option>
                                        @foreach ($akun as $item)
                                        <option value="{{ $item->kode_akun }}">{{ $item->nama_akun }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <label for="keterangan" class="font-medium w-[150px]">Tgl Transaksi</label>
                            <div class="flex items-center w-full justify-between">
                                <input value="{{ $today }}" type="date" name="tanggal" id="tanggal" required class="bg-[#D9D9D9]/40 rounded-lg h-[45px] px-4 w-[220px] outline-none" readonly>
                                <div class="flex items-center w-[350px]">
                                    <label for="nominal" class="font-medium w-[35%]">Nominal</label>
                                    <input type="text" name="nominal" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[65%] outline-none mt-2 rupiah-format">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <label for="kas/bank" class="font-medium w-[125px]">keretangan</label>
                            <textarea name="keterangan" id="keterangan" required class="bg-[#D9D9D9]/40 rounded-lg h-[100px] px-4 py-2 w-full outline-none resize-none"></textarea>
                        </div>
                        <div class="flex items-center mt-6 gap-x-4">
                            <div class="w-[110px]"></div>
                            <button type="submit" class="border-[#3E98D0] border text-[#3E98D0] py-1 px-4 rounded-lg cursor-pointer flex items-center gap-x-2">
                                <span class="">Simpan Data</span>
                                <img src="https://ar4n-group.com/public/assets/plus-circle-blue.png" alt="arrow right blue icon" class="w-[30px]">
                            </button>
                            <button type="button" onclick="Swal.close()" class="border-[#DD4049] border text-[#DD4049] py-2 px-4 rounded-lg cursor-pointer flex items-center gap-x-2">
                                <span class="">Batal</span>
                                <img src="https://ar4n-group.com/public/assets/close-circle-red.png" alt="arrow right blue icon" class="w-[22px]">
                            </button>
                        </div>
                    </form>
                    `,
                    width: '800px',
                    showCancelButton: false,
                    showCloseButton: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        new TomSelect('#namaPerkiraan', {
                            placeholder: 'Cari akun...',
                            create: false,
                            maxItems: 1,
                            hideSelected: true,
                            shouldLoadImmediately: false,
                            sortField: {
                                field: "text",
                                direction: "asc"
                            }
                        });new TomSelect('#namaPerkiraanTo', {
                            placeholder: 'Cari akun...',
                            create: false,
                            maxItems: 1,
                            hideSelected: true,
                            shouldLoadImmediately: false,
                            sortField: {
                                field: "text",
                                direction: "asc"
                            }
                        });
                        const rupiahFormat = document.querySelectorAll('.rupiah-format');
                        rupiahFormat.forEach(input => {
                            input.addEventListener('input', function() {
                                console.log('test')
                                // hapus karakter yang bukan angka atau koma
                                let value = this.value.replace(/[^,\d]/g, "").toString();
                                // pisahkan antara angka dan koma
                                let split = value.split(",");
                                // format angka menjadi rupiah
                                let sisa = split[0].length % 3;
                                // ambil angka yang tidak termasuk dalam kelipatan 3
                                let rupiah = split[0].substr(0, sisa);
                                // ambil angka yang termasuk dalam kelipatan 3
                                let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                                // tambahkan titik sebagai pemisah ribuan
                                if (ribuan) {
                                    let separator = sisa ? "." : "";
                                    rupiah += separator + ribuan.join(".");
                                }

                                // tambahkan kembali koma dan angka di belakangnya jika ada
                                rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
                                // tampilkan hasil format rupiah pada input
                                this.value = rupiah ? "Rp. " + rupiah : "";
                            });
                        });
                        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        const form = document.getElementById('myForm');
                        if (form) {
                            form.addEventListener('submit', function(e) {
                                e.preventDefault(); // cegah submit default

                                // bersihkan input rupiah
                                const rupiahInputs = document.querySelectorAll('.rupiah-format');
                                rupiahInputs.forEach(input => {
                                    let value = input.value;
                                    let cleanValue = parseInt(value.replace(/[^,\d]/g, ""));
                                    input.value = cleanValue;
                                });

                                // kirim pakai fetch
                                const formData = new FormData(form);

                                fetch(form.action, {
                                        method: "POST",
                                        headers: {
                                            "X-CSRF-TOKEN": token,
                                            "X-Requested-With": "XMLHttpRequest"
                                        },
                                        body: formData
                                    })
                                    .then(res => res.json())
                                    .then(res => {
                                        if (res.error) {
                                            Swal.fire("Error", res.error, "error");
                                        } else {
                                            Swal.fire("Sukses", "Transfer kas/bank berhasil dicatat",
                                                "success").then(() => {
                                                location.reload();
                                            });
                                        }
                                    })
                                    .catch(err => {
                                        Swal.fire("Error", "Terjadi kesalahan: " + err.message,
                                            "error");
                                    });
                            });
                        }

                    }
                });
            }
        </script>
    </div>
@endsection
