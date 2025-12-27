@extends('owner.layout')
@section('content')
    <div>
        <h1 class="font-bold text-2xl mb-6">Jurnal Umum</h1>
        <section>
            <div class="flex items-center justify-between mb-5 pb-5 border-b-[1px] border-[#CCCCCC]">
                <div class="flex items-center gap-x-4">
                    <span class="font-medium">Saldo Debet</span>
                    <span
                        class="bg-[#E9E9E9] py-[6px] px-4 w-[200px] rounded-lg font-semibold text-gray-500">{{ 'RP. ' . number_format($totalDebit, 0, ',', '.') }}</span>
                </div>
                <div class="flex items-center gap-x-4">
                    <span class="font-medium">Saldo Kredit</span>
                    <span
                        class="bg-[#E9E9E9] py-[6px] px-4 w-[200px] rounded-lg font-semibold text-gray-500">{{ 'RP. ' . number_format($totalKredit, 0, ',', '.') }}</span>
                </div>
                <div class="flex items-center gap-x-1">
                    <span class="font-medium mr-4">Status</span>
                    <span
                        class="bg-[#E9E9E9] py-[6px] px-8 rounded-lg font-semibold text-gray-500">{{ $status }}</span>
                    <div
                        class="{{ $status === 'Balance' ? 'bg-[#45D03E] w-[80px] h-[35px] rounded-lg' : 'bg-[#f80707] w-[80px] h-[35px] rounded-lg' }}">
                    </div>
                </div>
            </div>
            <div class="flex justify-between items-center pb-4">
                {{-- <a href="{{ route('jurnalUmums.create') }}"
                    class="border-[#9A9A9A] border-2 rounded-lg px-4 py-2 shadow-[0px_0px_10px_rgba(0,0,0,0.1)]">
                    <button class="cursor-pointer">Tambah Data +</button>
                </a> --}}
                <div class="flex items-center gap-x-2">
                    <button onclick="transaksiMasuk()" data-url="{{ route('jurnalOwner.storeDebit') }}"
                        data-token="{{ csrf_token() }}"
                        class="flex items-center gap-x-3 border-2 border-[#9A9A9A] px-4 py-2 rounded-lg cursor-pointer">
                        <span class="text-gray-700">Debit</span>
                        <img src="{{ asset('assets/card-receive.png') }}" alt="card receive icon" class="w-[20px]">
                    </button>
                    <button onclick="transaksiKeluar()" data-url="{{ route('jurnalOwner.storeKredit') }}"
                        data-token="{{ csrf_token() }}"
                        class="flex items-center gap-x-3 border-2 border-[#9A9A9A] px-4 py-2 rounded-lg cursor-pointer">
                        <span class="text-gray-700">Kredit</span>
                        <img src="{{ asset('assets/card-receive.png') }}" alt="card receive icon" class="w-[20px]">
                    </button>
                    {{-- <button onclick="transferBank()"
                        class="flex items-center gap-x-3 border-2 border-[#9A9A9A] px-4 py-2 rounded-lg cursor-pointer">
                        <span class="text-gray-700">Transfer Bank</span>
                        <img src="{{ asset('assets/money-send.png') }}" alt="card receive icon" class="w-[20px]">
                    </button> --}}
                </div>
                <form action="{{ route('jurnalOwner.index') }}" method="GET" class="flex items-center gap-x-2">
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
        </section>
        <script>
            function editLaporanKeuangan(id, tanggal, keterangan, kode_perkiraan, nama_perkiraan, debit, kredit, updateUrl) {
                // buat form modal dengan sweetalert2
                Swal.fire({
                    html: `
                    <form action="${updateUrl}" method="POST" class="flex flex-col text-left">
                        @csrf
                        @method('PUT')
                        <h1 class="font-bold text-2xl mb-4">Edit Laporan Keuangan</h1>
                        <div class="flex items-center mt-4">
                            <label for="tanggal" class="font-medium w-[150px]">Tgl Relasi</label>
                            <div class="flex items-center w-full justify-between">
                                <input value="${tanggal}" type="date" name="tanggal" id="tanggal" required class="bg-[#D9D9D9]/40 rounded-lg h-[45px] px-4 w-[220px] outline-none">
                                <div class="flex items-center w-[350px]">
                                    <label for="keterangan" class="font-medium w-[35%]">Keterangan</label>
                                    <input value="${keterangan}" type="text" name="keterangan" id="keterangan" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[65%] outline-none mt-2">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <label for="tanggal" class="font-medium w-[150px]">Kode Akun</label>
                            <div class="flex items-center w-full justify-between">
                                <input value="${kode_perkiraan}" type="text" name="kode_perkiraan" id="kode_perkiraan" readonly required class="bg-[#D9D9D9]/40 rounded-lg h-[45px] px-4 w-[220px] outline-none">
                                <div class="flex items-center w-[350px]">
                                    <label for="keterangan" class="font-medium w-[35%]">Debet</label>
                                    <input value="${debit}" type="number" name="debit" id="debet" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[65%] outline-none mt-2">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <label for="tanggal" class="font-medium w-[150px]">Nama Akun</label>
                            <div class="flex items-center w-full justify-between">
                                <select class="bg-[#D9D9D9]/40 rounded-lg h-[45px] px-4 w-[220px] outline-none appearance-none" name="nama_perkiraan" id="nama_perkiraan" onchange="syncKodePerkiraan(this)" >
                                        <option value="${nama_perkiraan}" selected>${nama_perkiraan}</option>
                                    @foreach ($akun as $item)
                                        <option value="{{ $item->nama_akun }}" data-kode="{{ $item->kode_akun }}">{{ $item->nama_akun }}</option>
                                    @endforeach
                                </select>
                                <div class="flex items-center w-[350px]">
                                    <label for="keterangan" class="font-medium w-[35%]">Kredit</label>
                                    <input value="${kredit}" type="number" name="kredit" id="kredit" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[65%] outline-none mt-2">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center mt-6 gap-x-4">
                            <div class="w-[110px]"></div>
                            <button type="submit" class="border-[#3E98D0] border text-[#3E98D0] py-1 px-4 rounded-lg cursor-pointer flex items-center gap-x-2">
                                <span class="">Simpan Data</span>
                                <img src="{{ asset('assets/plus-circle-blue.png') }}" alt="arrow right blue icon" class="w-[30px]">
                            </button>
                            <button type="button" onclick="Swal.close()" class="border-[#DD4049] border text-[#DD4049] py-1 px-4 rounded-lg cursor-pointer flex items-center gap-x-2">
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
                });
            }
            // fungsi sinkronisasi kode akun
            function syncKodePerkiraan(select) {
                let kode = select.options[select.selectedIndex].getAttribute('data-kode');
                document.getElementById('kode_perkiraan').value = kode;
            }
        </script>
        <script>
            function transaksiMasuk() {
                // buat form modal dengan sweetalert2
                Swal.fire({
                    html: `
                    <form action="{{ route('jurnalOwner.storeCashIn') }}" method="POST" class="flex flex-col text-left">
                        @csrf
                        <h1 class="font-bold text-2xl mb-4">Transaksi Jurnal - Debet</h1>
                        <div class="flex items-center mt-4">
                            <label for="tanggal" class="font-medium w-[150px]">Tgl Transaksi</label>
                            <div class="flex items-center w-full justify-between">
                                <input value="{{ $today }}" type="date" name="tanggal" id="tanggal" required class="bg-[#D9D9D9]/40 rounded-lg h-[45px] px-4 w-[220px] outline-none" readonly>
                                <div class="flex items-center w-[350px]">
                                    <label for="kode_akun" class="font-medium w-[35%]">Kode Akun</label>
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
                                    <label for="debit" class="font-medium w-[35%]">Nominal</label>
                                    <input type="number" name="debit" id="debit" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[65%] outline-none mt-2">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <label for="tanggal" class="font-medium w-[125px]">Nama Akun</label>
                            <select name="nama_perkiraan" id="nama_perkiraan" required class="bg-[#D9D9D9]/40 rounded-lg h-[45px] px-4 w-[220px] outline-none appearance-none">
                                <option value="" disabled selected>-Pilih Nama Akun-</option>
                                 @foreach ($akun as $item)
                                    <option value="{{ $item->nama_akun }}" data-kode="{{ $item->kode_akun }}">
                                        {{ $item->nama_akun }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center mt-6 gap-x-4">
                            <div class="w-[110px]"></div>
                            <button type="submit" class="border-[#3E98D0] border text-[#3E98D0] py-1 px-4 rounded-lg cursor-pointer flex items-center gap-x-2">
                                <span class="">Simpan Data</span>
                                <img src="{{ asset('assets/plus-circle-blue.png') }}" alt="arrow right blue icon" class="w-[30px]">
                            </button>
                            <button type="button" onclick="Swal.close()" class="border-[#DD4049] border text-[#DD4049] py-1 px-4 rounded-lg cursor-pointer flex items-center gap-x-2">
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
                    }
                });
            }

            function transaksiKeluar() {
                // buat form modal dengan sweetalert2
                Swal.fire({
                    html: `
                    <form action="{{ route('jurnalOwner.storeCashOut') }}" method="POST" class="flex flex-col text-left">
                        @csrf
                        <h1 class="font-bold text-2xl mb-4">Transaksi Jurnal - Kredit</h1>
                        <div class="flex items-center mt-4">
                            <label for="tanggal" class="font-medium w-[150px]">Tgl Transaksi</label>
                            <div class="flex items-center w-full justify-between">
                                <input value="{{ $today }}" type="date" name="tanggal" id="tanggal" required class="bg-[#D9D9D9]/40 rounded-lg h-[45px] px-4 w-[220px] outline-none" readonly>
                                <div class="flex items-center w-[350px]">
                                    <label for="kode_akun" class="font-medium w-[35%]">Kode Akun</label>
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
                                    <label for="kredit" class="font-medium w-[35%]">Nominal</label>
                                    <input type="number" name="kredit" id="kredit" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[65%] outline-none mt-2">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <label for="tanggal" class="font-medium w-[125px]">Nama Akun</label>
                            <select name="nama_perkiraan" id="nama_perkiraan" required class="bg-[#D9D9D9]/40 rounded-lg h-[45px] px-4 w-[220px] outline-none appearance-none">
                                <option value="" disabled selected>-Pilih Nama Akun-</option>
                                 @foreach ($akun as $item)
                                    <option value="{{ $item->nama_akun }}" data-kode="{{ $item->kode_akun }}">
                                        {{ $item->nama_akun }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center mt-6 gap-x-4">
                            <div class="w-[110px]"></div>
                            <button type="submit" class="border-[#3E98D0] border text-[#3E98D0] py-1 px-4 rounded-lg cursor-pointer flex items-center gap-x-2">
                                <span class="">Simpan Data</span>
                                <img src="{{ asset('assets/plus-circle-blue.png') }}" alt="arrow right blue icon" class="w-[30px]">
                            </button>
                            <button type="button" onclick="Swal.close()" class="border-[#DD4049] border text-[#DD4049] py-1 px-4 rounded-lg cursor-pointer flex items-center gap-x-2">
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
                    }
                });
            }
        </script>
        <script>
    //         let transaksiDebet = [];

    //         function transaksiMasuk() {
    //             Swal.fire({
    //                 html: `
    //                 <form id="formKasBank" class="flex flex-col gap-y-4">
    //                 <h1 class="font-bold text-2xl mb-4">Transaksi Jurnal Debet</h1>

    //                 <label>Kas/Bank</label>
    //                 <select id="kasBank" class="bg-gray-200 rounded-lg px-4 py-2">
    //                     <option disabled selected>-Pilih Kas-</option>
    //                     @foreach ($bank as $item)
    //                     <option value="{{ $item->kode_akun }}">{{ $item->nama_akun }}</option>
    //                      @endforeach
    //                 </select>

    //                 <label>Keterangan</label>
    //                 <input type="text" id="ketKasBank" class="bg-gray-200 rounded-lg px-4 py-2">

    //                 <hr class="my-4">

    //                 <h2 class="font-bold">Tambah Rincian Debet</h2>
    //                 <div class="flex gap-x-2">
    //                 <select id="namaPerkiraan" class="bg-gray-200 rounded-lg px-4 py-2 w-1/2">
    //                 <option></option>
    //                 @foreach ($akun as $item)
    //                     <option value="{{ $item->kode_akun }}">{{ $item->nama_akun }}</option>
    //                 @endforeach
    //                 </select>
    //                 <input type="text" id="ketPerkiraan" placeholder="Keterangan" class="bg-gray-200 rounded-lg px-4 py-2 w-1/4">
    //                 <input type="number" id="nominal" placeholder="Nominal" class="bg-gray-200 rounded-lg px-4 py-2 w-1/4">
    //                 <button type="button" onclick="addDebet()" class="bg-blue-500 text-white px-3 rounded">+</button>
    //                 </div>

    //                 <table id="tableDebet" class="mt-4 w-full text-sm border">
    //                     <thead>
    //                     <tr class="bg-gray-300">
    //                     <th>No</th><th>Akun</th><th>Keterangan</th><th>Nominal</th>
    //                     </tr>
    //                 </thead>
    //                 <tbody></tbody>
    //                 </table>

    //                 <div class="flex gap-x-4 mt-4">
    //                 <button type="button" onclick="generateJurnal()" class="bg-green-500 text-white px-4 py-2 rounded">Generate</button>
    //                 <button type="button" onclick="Swal.close()" class="bg-red-500 text-white px-4 py-2 rounded">Batal</button>
    //                 </div>
    //                 </form>
    //                 `,
    //                 width: '900px',
    //                 showConfirmButton: false,
    //                 didOpen: () => {
    //                     new TomSelect('#namaPerkiraan', {
    //                         placeholder: 'Cari akun...',
    //                         create: false,
    //                         maxItems: 1,
    //                         hideSelected: true,
    //                         shouldLoadImmediately: false,
    //                         sortField: {
    //                             field: "text",
    //                             direction: "asc"
    //                         }
    //                     });

    //                 }
    //             });
    //         }

    //         function addDebet() {
    //             let akun = document.getElementById('namaPerkiraan');
    //             let kode = akun.value;
    //             let nama = akun.options[akun.selectedIndex].text;
    //             let ket = document.getElementById('ketPerkiraan').value;
    //             let nominal = parseInt(document.getElementById('nominal').value);

    //             transaksiDebet.push({
    //                 kode_akun: kode,
    //                 nama_akun: nama,
    //                 keterangan: ket,
    //                 nominal: nominal
    //             });

    //             let tbody = document.querySelector('#tableDebet tbody');
    //             tbody.innerHTML = transaksiDebet.map((d, i) => `
    //             <tr>
    //                 <td>${i+1}</td>
    //                 <td>${d.nama_akun}</td>
    //                 <td>${d.keterangan}</td>
    //                 <td>Rp ${d.nominal.toLocaleString()}</td>
    //             </tr>
    //             `).join('');
    //         }

    //         function generateJurnal() {
    //             let kasBank = document.getElementById('kasBank');
    //             let kodeKas = kasBank.value;
    //             let namaKas = kasBank.options[kasBank.selectedIndex]?.text || "";
    //             let ketKas = document.getElementById('ketKasBank').value;

    //             // 🔎 Validasi input dulu
    //             if (!kodeKas || !ketKas.trim()) {
    //                 Swal.fire("Oops", "Kas/Bank dan Keterangan wajib diisi", "warning");
    //                 return;
    //             }

    //             if (transaksiDebet.length === 0) {
    //                 Swal.fire("Oops", "Minimal 1 rincian debet harus ditambahkan", "warning");
    //                 return;
    //             }

    //             let totalNominal = transaksiDebet.reduce((sum, d) => sum + d.nominal, 0);

    //             let data = [];
    //             // baris pertama: Kas/Bank (kredit)
    //             data.push({
    //                 kode_akun: kodeKas,
    //                 nama_akun: namaKas,
    //                 keterangan: ketKas,
    //                 debit: 0,
    //                 kredit: totalNominal
    //             });

    //             // baris debet
    //             transaksiDebet.forEach(d => {
    //                 data.push({
    //                     kode_akun: d.kode_akun,
    //                     nama_akun: d.nama_akun,
    //                     keterangan: d.keterangan,
    //                     debit: d.nominal,
    //                     kredit: 0
    //                 });
    //             });

    //             let btn = document.querySelector('[onclick="transaksiMasuk()"]');
    //             let url = btn.dataset.url;
    //             let token = btn.dataset.token;

    //             fetch(url, {
    //                     method: "POST",
    //                     headers: {
    //                         "Content-Type": "application/json",
    //                         "X-CSRF-TOKEN": token
    //                     },
    //                     body: JSON.stringify({
    //                         transaksi: data
    //                     })
    //                 })
    //                 .then(res => res.json())
    //                 .then(res => {
    //                     if (res.error) {
    //                         Swal.fire("Error", "Gagal generate: " + res.error, "error");
    //                     } else {
    //                         Swal.fire("Sukses", "Data berhasil digenerate ke jurnal umum", "success");
    //                         transaksiDebet = []; // reset array setelah sukses
    //                         location.reload();
    //                     }
    //                 })
    //                 .catch(err => {
    //                     Swal.fire("Error", "Gagal generate: " + err.message, "error");
    //                 });
    //         }
    //     </script>

         <script>
    //         let transaksiKredit = [];

    //         function transaksiKeluar() {
    //             // buat form modal dengan sweetalert2
    //             Swal.fire({
    //                 html: `
    //                 <form id="formKasBank" class="flex flex-col gap-y-4">
    //                 <h1 class="font-bold text-2xl mb-4">Transaksi Jurnal Kredit</h1>

    //                 <label>Kas/Bank</label>
    //                 <select id="kasBank" class="bg-gray-200 rounded-lg px-4 py-2">
    //                     <option disabled selected>-Pilih Kas-</option>
    //                     @foreach ($bank as $item)
    //                     <option value="{{ $item->kode_akun }}">{{ $item->nama_akun }}</option>
    //                      @endforeach
    //                 </select>

    //                 <label>Keterangan</label>
    //                 <input type="text" id="ketKasBank" class="bg-gray-200 rounded-lg px-4 py-2">

    //                 <hr class="my-4">

    //                 <h2 class="font-bold">Tambah Rincian Debet</h2>
    //                 <div class="flex gap-x-2">
    //                 <select id="namaPerkiraan" class="bg-gray-200 rounded-lg px-4 py-2 w-1/2">
    //                 <option></option>
    //                 @foreach ($akun as $item)
    //                     <option value="{{ $item->kode_akun }}">{{ $item->nama_akun }}</option>
    //                 @endforeach
    //                 </select>
    //                 <input type="text" id="ketPerkiraan" placeholder="Keterangan" class="bg-gray-200 rounded-lg px-4 py-2 w-1/4">
    //                 <input type="number" id="nominal" placeholder="Nominal" class="bg-gray-200 rounded-lg px-4 py-2 w-1/4">
    //                 <button type="button" onclick="addKredit()" class="bg-blue-500 text-white px-3 rounded">+</button>
    //                 </div>

    //                 <table id="tableKredit" class="mt-4 w-full text-sm border">
    //                     <thead>
    //                     <tr class="bg-gray-300">
    //                     <th>No</th><th>Akun</th><th>Keterangan</th><th>Nominal</th>
    //                     </tr>
    //                 </thead>
    //                 <tbody></tbody>
    //                 </table>

    //                 <div class="flex gap-x-4 mt-4">
    //                 <button type="button" onclick="generateJurnalKredit()" class="bg-green-500 text-white px-4 py-2 rounded">Generate</button>
    //                 <button type="button" onclick="Swal.close()" class="bg-red-500 text-white px-4 py-2 rounded">Batal</button>
    //                 </div>
    //                 </form>
    //                 `,
    //                 width: '900px',
    //                 showConfirmButton: false,
    //                 didOpen: () => {
    //                     new TomSelect('#namaPerkiraan', {
    //                         placeholder: 'Cari akun...',
    //                         create: false,
    //                         maxItems: 1,
    //                         hideSelected: true,
    //                         shouldLoadImmediately: false,
    //                         sortField: {
    //                             field: "text",
    //                             direction: "asc"
    //                         }
    //                     });

    //                 }
    //             });
    //         }


    //         function addKredit() {
    //             let akun = document.getElementById('namaPerkiraan');
    //             let kode = akun.value;
    //             let nama = akun.options[akun.selectedIndex].text;
    //             let ket = document.getElementById('ketPerkiraan').value;
    //             let nominal = parseInt(document.getElementById('nominal').value);

    //             transaksiKredit.push({
    //                 kode_akun: kode,
    //                 nama_akun: nama,
    //                 keterangan: ket,
    //                 nominal: nominal
    //             });

    //             let tbody = document.querySelector('#tableKredit tbody');
    //             tbody.innerHTML = transaksiKredit.map((d, i) => `
    //     <tr>
    //         <td>${i+1}</td>
    //         <td>${d.nama_akun}</td>
    //         <td>${d.keterangan}</td>
    //         <td>Rp ${d.nominal.toLocaleString()}</td>
    //     </tr>
    // `).join('');
    //         }

    //         function generateJurnalKredit() {
    //             let kasBank = document.getElementById('kasBank');
    //             let kodeKas = kasBank.value;
    //             let namaKas = kasBank.options[kasBank.selectedIndex]?.text || "";
    //             let ketKas = document.getElementById('ketKasBank').value;

    //             if (!kodeKas || !ketKas.trim()) {
    //                 Swal.fire("Oops", "Kas/Bank dan Keterangan wajib diisi", "warning");
    //                 return;
    //             }

    //             if (transaksiKredit.length === 0) {
    //                 Swal.fire("Oops", "Minimal 1 rincian debet harus ditambahkan", "warning");
    //                 return;
    //             }

    //             let totalNominal = transaksiKredit.reduce((sum, d) => sum + d.nominal, 0);

    //             let data = [];
    //             // baris pertama: Kas/Bank (debit)
    //             data.push({
    //                 kode_akun: kodeKas,
    //                 nama_akun: namaKas,
    //                 keterangan: ketKas,
    //                 debit: totalNominal,
    //                 kredit: 0
    //             });

    //             // baris kredit
    //             transaksiKredit.forEach(d => {
    //                 data.push({
    //                     kode_akun: d.kode_akun,
    //                     nama_akun: d.nama_akun,
    //                     keterangan: d.keterangan,
    //                     debit: 0,
    //                     kredit: d.nominal
    //                 });
    //             });

    //             let btn = document.querySelector('[onclick="transaksiKeluar()"]');
    //             let url = btn.dataset.url;
    //             let token = btn.dataset.token;

    //             fetch(url, {
    //                     method: "POST",
    //                     headers: {
    //                         "Content-Type": "application/json",
    //                         "X-CSRF-TOKEN": token
    //                     },
    //                     body: JSON.stringify({
    //                         transaksi: data
    //                     })
    //                 })
    //                 .then(res => res.json())
    //                 .then(res => {
    //                     if (res.error) {
    //                         Swal.fire("Error", "Gagal generate: " + res.error, "error");
    //                     } else {
    //                         Swal.fire("Sukses", "Data berhasil digenerate ke jurnal umum", "success");
    //                         transaksiKredit = []; // reset array setelah sukses
    //                         location.reload();
    //                     }
    //                 })
    //                 .catch(err => {
    //                     Swal.fire("Error", "Gagal generate: " + err.message, "error");
    //                 });
    //         }

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
                                    <input type="text" name="nominal" id="nominal" required class="bg-[#D9D9D9]/40 rounded-lg py-2 px-4 w-[65%] outline-none mt-2 rupiah-format">
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
