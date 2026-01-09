@extends('admin.layout')
@section('content')
    <div>
        <section>
            <div class="flex items-center pb-4 justify-between">
                <h1 class="font-bold text-2xl">Data Hutang Vendor</h1>
                <div class="flex items-center gap-x-2">
                    <a target="_blank" href=""
                        class="flex items-center gap-x-2 border-[#9A9A9A] border-2 rounded-lg px-4 py-2"><span
                            class="text-gray-600">Cetak Semua Data</span> <img src="{{ asset('assets/printer.png') }}"
                            alt="" class="w-[25px]"></a>
                    <button class="block border-[#45D03E] text-[#45D03E] border-2 rounded-lg px-4 py-2 cursor-pointer"
                        onclick="tambahData()">Tambah Data +
                    </button>
                </div>
            </div>
            <div class="rounded-lg shadow-[1px_1px_10px_rgba(0,0,0,0.1)] pt-4 pb-6">
                <table class="table-fixed text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="w-[5%] py-2">No</th>
                        <th class="w-[15%] py-2">Nama Supplier</th>
                        <th class="w-[15%] py-2">Keterangan</th>
                        <th class="w-[15%] py-2">Nominal</th>
                        <th class="w-[15%] py-2">Nama Proyek</th>
                        <th class="w-[15%] py-2">Jatuh Tempo</th>
                        <th class="w-[10%] py-2">Action</th>
                    </thead>
                    <tbody>
                        @foreach ($hutangVendors as $index => $item)
                            <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">{{ $index + 1 }}</td>
                                <td class="py-2">{{ $item->supplier?->nama ?? '-' }}</td>
                                <td class="py-2">{{ $item->keterangan }}</td>
                                <td class="py-2">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                <td class="py-2">{{ $item->proyek?->nama_proyek ?? '-' }}</td>
                                <td class="py-2">{{ \Carbon\Carbon::parse($item->tgl_jatuh_tempo)->format('d/m/Y') }}</td>
                                <td class="flex justify-center items-center gap-x-2 py-2">
                                    {{-- Tombol Edit --}}
                                    <button type="button" onclick='editData(@json($item))'>
                                        <img src="{{ asset('assets/edit-icon.png') }}" alt="edit icon"
                                            class="w-[22px] cursor-pointer">
                                    </button>
                                    <span class="border-black border-l-[1px] h-[22px]"></span>
                                    {{-- Tombol Detail --}}
                                    <button type="button" onclick='detailData(@json($item))'>
                                        <img src="{{ asset('assets/more-circle.png') }}" alt="detail icon"
                                            class="w-[22px] cursor-pointer">
                                    </button>
                                    {{-- Tombol Delete --}}
                                    <form action="{{ route('hutang_vendor.destroy', $item->id) }}" method="POST"
                                        class="h-[22px]">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                            <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                class="w-[22px] cursor-pointer">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </section>
        <script>
            function tambahData() {
                Swal.fire({
                    html: `
        <form id="createForm" action="{{ route('hutang_vendor.store') }}" method="POST" class="flex flex-col items-start gap-y-4">
            @csrf
            <h1 class="font-bold text-2xl mb-4">Form Hutang Vendor</h1>

            <div class="flex items-center w-full">
                <label class="w-[200px] text-start">Tgl Hutang</label>
                <input type="date" name="tgl_hutang" class="w-full bg-[#D9D9D9] rounded-lg px-4 py-2 cursor-pointer"/>
            </div>

            <div class="flex items-center w-full">
                <label class="w-[200px] text-start">Nama Supplier</label>
                <select name="kode_supplier" class="w-full bg-[#D9D9D9] rounded-lg px-4 py-2 cursor-pointer appearance-none">
                    <option selected disabled>Pilih Supplier</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->kode_akun }}">{{ $supplier->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center w-full">
                <label class="w-[200px] text-start">Tgl Jatuh Tempo</label>
                <input type="date" name="tgl_jatuh_tempo" class="w-full bg-[#D9D9D9] rounded-lg px-4 py-2 cursor-pointer"/>
            </div>

            <div class="flex items-center w-full">
                <label class="w-[200px] text-start">Nominal</label>
                <input type="text" name="nominal" class="w-full bg-[#D9D9D9] rounded-lg px-4 py-2 cursor-pointer rupiah-format"/>
            </div>

            <div class="flex items-center w-full">
                <label class="w-[200px] text-start">Nama Proyek</label>
                <select name="kode_proyek" class="w-full bg-[#D9D9D9] rounded-lg px-4 py-2 cursor-pointer appearance-none">
                    <option selected disabled>Pilih Proyek</option>
                    @foreach ($proyeks as $proyek)
                        <option value="{{ $proyek->kode_akun }}">{{ $proyek->nama_proyek }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center w-full">
                <label class="w-[200px] text-start">Keterangan</label>
                <input type="text" name="keterangan" class="w-full bg-[#D9D9D9] rounded-lg px-4 py-2 cursor-pointer"/>
            </div>

            <div class="flex items-center w-full justify-end gap-x-2 mt-4">
                <button type="submit" class="flex items-center gap-x-2 py-1 px-4 rounded-lg border border-[#3E98D0] cursor-pointer mr-2">
                    <span class="text-[#3E98D0]">Simpan Data</span>
                    <img src="{{ asset('assets/plus-circle-blue.png') }}" class="w-[30px] mt-1"/>
                </button>
                <button type="button" onclick="Swal.close()" class="flex items-center gap-x-2 py-2 px-4 rounded-lg border border-[#DD4049] cursor-pointer">
                    <span class="text-[#DD4049]">Batal</span>
                    <img src="{{ asset('assets/close-circle-red.png') }}" class="w-[20px]"/>
                </button>
            </div>
        </form>
        `,
                    width: '700px',
                    showConfirmButton: false,
                    didOpen: () => {
                        // format rupiah
                        const rupiahInputs = document.querySelectorAll('.rupiah-format');
                        rupiahInputs.forEach(input => {
                            input.addEventListener('input', function() {
                                let value = this.value.replace(/[^,\d]/g, "");
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

                        // bersihkan rupiah sebelum submit
                        const form = document.getElementById('createForm');
                        form.addEventListener('submit', function() {
                            rupiahInputs.forEach(input => {
                                let cleanValue = parseInt(input.value.replace(/[^,\d]/g, ""));
                                input.value = cleanValue;
                            });
                        });
                    }
                });
            }




            function detailData() {
                // buat form modal dengan sweetalert2
                Swal.fire({
                    html: `
                    <form id="myForm" class="flex flex-col items-start gap-y-4">
                    <h1 class="font-bold text-2xl mb-4">Detail hutang Vendor</h1>
                    <div class="flex items-center w-full">
                        <label class="w-[200px] text-start">
                            Tgl hutang
                        </label>
                        <input type="date" class="w-full outline-none bg-[#D9D9D9] rounded-lg px-4 py-2 cursor-pointer" name="" id="" readonly/>
                    </div>
                    <div class="flex items-center w-full">
                        <label class="w-[200px] text-start">
                            Nama Supplier
                        </label>
                        <select type="date" class="w-full outline-none bg-[#D9D9D9] rounded-lg px-4 py-2 cursor-pointer appearance-none" name="" id="" disabled>
                            <option value="supplier" selected>supplier</option>
                        </select>
                    </div>
                    <div class="flex items-center w-full">
                        <label class="w-[200px] text-start">
                            Tgl Jatuh Tempo
                        </label>
                        <input type="date" class="w-full outline-none bg-[#D9D9D9] rounded-lg px-4 py-2 cursor-pointer" name="" id="" readonly/>
                    </div>
                    <div class="flex items-center w-full">
                        <label class="w-[200px] text-start">
                            Nominal
                        </label>
                        <input type="text" class="w-full outline-none bg-[#D9D9D9] rounded-lg px-4 py-2 cursor-pointer rupiah-format" value="{{ 'Rp. ' . number_format(100000, 0, ',', '.') }}" name="" id="nominal" readonly/>
                    </div>
                    <div class="flex items-center w-full">
                        <label class="w-[200px] text-start">
                            Nama Proyek
                        </label>
                         <select type="date" class="w-full outline-none bg-[#D9D9D9] rounded-lg px-4 py-2 cursor-pointer appearance-none" name="" id="" disabled>
                            <option selected value="Proyek">Proyek</option>
                        </select>
                    </div>
                    <div class="flex items-center w-full">
                        <label class="w-[200px] text-start">
                           Keterangan
                        </label>
                        <input type="text" class="w-full outline-none bg-[#D9D9D9] rounded-lg px-4 py-2 cursor-pointer" name="" id="" readonly/>
                    </div>
                    <div class="flex items-center w-full">
                        <label class="w-[150px] text-start">
                        </label>
                        <button class="flex items-center gap-x-2 py-2 px-4 rounded-lg border border-[#45D03E] cursor-pointer mr-2">
                            <span class="text-[#45D03E]">Generate</span>
                            <img src="{{ asset('assets/card-send-greeen.png') }}" alt="arrow right blue icon" class="w-[20px] mt-1"/>
                        </button>
                        <button class="flex items-center gap-x-2 py-2 px-4 rounded-lg border border-[#DD4049] cursor-pointer" onclick="Swal.close()">
                            <span class="text-[#DD4049]">Batal</span>
                            <img src="{{ asset('assets/close-circle-red.png') }}" alt="arrow right blue icon" class="w-[20px]"/>
                        </button>
                    </div>
                    </form>
                    `,
                    width: '700px',
                    showConfirmButton: false,
                    didOpen: () => {
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
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function editData(item) {
                Swal.fire({
                    html: `
        <form id="editForm" action="/hutang_vendor/${item.id}" method="POST" class="flex flex-col items-start gap-y-4">
            @csrf
            @method('PUT')
            <h1 class="font-bold text-2xl mb-4">Edit Hutang Vendor</h1>

            <div class="flex items-center w-full">
                <label class="w-[200px] text-start">Tgl Hutang</label>
                <input type="date" name="tgl_hutang" value="${item.tgl_hutang}" class="w-full bg-[#D9D9D9] rounded-lg px-4 py-2"/>
            </div>

            <div class="flex items-center w-full">
                <label class="w-[200px] text-start">Nama Supplier</label>
                <select name="kode_supplier" class="w-full bg-[#D9D9D9] rounded-lg px-4 py-2">
                    <option disabled>Pilih Supplier</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier->kode_akun }}" ${item.kode_supplier === '{{ $supplier->kode_akun }}' ? 'selected' : ''}>
                            {{ $supplier->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center w-full">
                <label class="w-[200px] text-start">Tgl Jatuh Tempo</label>
                <input type="date" name="tgl_jatuh_tempo" value="${item.tgl_jatuh_tempo}" class="w-full bg-[#D9D9D9] rounded-lg px-4 py-2"/>
            </div>

            <div class="flex items-center w-full">
                <label class="w-[200px] text-start">Nominal</label>
                <input type="text" name="nominal" value="Rp. ${Number(item.nominal).toLocaleString('id-ID')}" class="w-full bg-[#D9D9D9] rounded-lg px-4 py-2 rupiah-format"/>
            </div>

            <div class="flex items-center w-full">
                <label class="w-[200px] text-start">Nama Proyek</label>
                <select name="kode_proyek" class="w-full bg-[#D9D9D9] rounded-lg px-4 py-2">
                    <option disabled>Pilih Proyek</option>
                    @foreach ($proyeks as $proyek)
                        <option value="{{ $proyek->kode_akun }}" ${item.kode_proyek === '{{ $proyek->kode_akun }}' ? 'selected' : ''}>
                            {{ $proyek->nama_proyek }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center w-full">
                <label class="w-[200px] text-start">Keterangan</label>
                <input type="text" name="keterangan" value="${item.keterangan ?? ''}" class="w-full bg-[#D9D9D9] rounded-lg px-4 py-2"/>
            </div>

            <div class="flex items-center w-full justify-end gap-x-2 mt-4">
                <button type="submit" class="bg-[#3E98D0] text-white px-4 py-2 rounded-lg">Simpan</button>
                <button type="button" onclick="Swal.close()" class="bg-[#DD4049] text-white px-4 py-2 rounded-lg">Batal</button>
            </div>
        </form>
        `,
                    width: '700px',
                    showConfirmButton: false,
                    didOpen: () => {
                        const rupiahInputs = document.querySelectorAll('.rupiah-format');
                        rupiahInputs.forEach(input => {
                            input.addEventListener('input', function() {
                                let value = this.value.replace(/[^,\d]/g, "");
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

                        const form = document.getElementById('editForm');
                        form.addEventListener('submit', function() {
                            rupiahInputs.forEach(input => {
                                let cleanValue = parseInt(input.value.replace(/[^,\d]/g, ""));
                                input.value = cleanValue;
                            });
                        });
                    }
                });
            }
        </script>

    </div>
@endsection
