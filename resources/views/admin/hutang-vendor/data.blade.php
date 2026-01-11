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
                        <th class="w-[10%] py-2">Status</th>
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
                                @php
                                    $today = \Carbon\Carbon::today();
                                    $jatuhTempo = \Carbon\Carbon::parse($item->tgl_jatuh_tempo);
                                    $selisihHari = $today->diffInDays($jatuhTempo, false);
                                @endphp

                                <td class="py-2">
                                    @if ($item->tgl_bayar)
                                        <span
                                            class="px-2 py-1 rounded-full bg-blue-200 text-blue-800 text-xs font-semibold">Sudah
                                            dibayar</span>
                                    @elseif ($selisihHari > 2)
                                        <span
                                            class="px-2 py-1 rounded-full bg-green-200 text-green-800 text-xs font-semibold">Masih
                                            jauh</span>
                                    @elseif ($selisihHari > 0)
                                        <span
                                            class="px-2 py-1 rounded-full bg-yellow-200 text-yellow-800 text-xs font-semibold">Mendekati</span>
                                    @else
                                        <span
                                            class="px-2 py-1 rounded-full bg-red-200 text-red-800 text-xs font-semibold">Hari
                                            H / Lewat</span>
                                    @endif
                                </td>

                                <td class="flex justify-center items-center gap-x-2 py-2">
                                    <button type="button"
                                        onclick='bayarHutang(@json($item), @json($bank))'>
                                        <img src="{{ asset('assets/pay.jpg') }}" alt="bayar icon"
                                            class="w-[22px] cursor-pointer">
                                    </button>
                                    <span class="border-black border-l-[1px] h-[22px]"></span>
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
                                    @if ($item->is_generate == true)
                                    <span class="border-black border-l-[1px] h-[22px]"></span>
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
                                    @endif
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
                <input  value="{{ \Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d') }}" readonly type="date" name="tgl_hutang" class="w-full bg-[#D9D9D9] rounded-lg px-4 py-2 cursor-pointer"/>
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




            function detailData(item) {
                Swal.fire({
                    html: `
        <form id="myForm" class="flex flex-col items-start gap-y-4">
            <h1 class="font-bold text-2xl mb-4">Detail Hutang Vendor</h1>
            <div class="flex items-center w-full">
                <label class="w-[200px] text-start">Tgl Hutang</label>
                <input type="date" value="${item.tgl_hutang}"
                       class="w-full bg-[#D9D9D9] rounded-lg px-4 py-2" readonly/>
            </div>

            <div class="flex items-center w-full">
                <label class="w-[200px] text-start">Nama Supplier</label>
                <input type="text" value="${item.supplier?.nama ?? '-'}"
                       class="w-full bg-[#D9D9D9] rounded-lg px-4 py-2" readonly/>
            </div>

            <div class="flex items-center w-full">
                <label class="w-[200px] text-start">Tgl Jatuh Tempo</label>
                <input type="date" value="${item.tgl_jatuh_tempo}"
                       class="w-full bg-[#D9D9D9] rounded-lg px-4 py-2" readonly/>
            </div>

            <div class="flex items-center w-full">
                <label class="w-[200px] text-start">Nominal</label>
                <input type="text" value="Rp. ${Number(item.nominal).toLocaleString('id-ID')}"
                       class="w-full bg-[#D9D9D9] rounded-lg px-4 py-2" readonly/>
            </div>

            <div class="flex items-center w-full">
                <label class="w-[200px] text-start">Nama Proyek</label>
                <input type="text" value="${item.proyek?.nama_proyek ?? '-'}"
                       class="w-full bg-[#D9D9D9] rounded-lg px-4 py-2" readonly/>
            </div>

            <div class="flex items-center w-full">
                <label class="w-[200px] text-start">Keterangan</label>
                <input type="text" value="${item.keterangan ?? '-'}"
                       class="w-full bg-[#D9D9D9] rounded-lg px-4 py-2" readonly/>
            </div>
            <div class="flex items-center w-full">
                <label class="w-[200px] text-start">Status</label>
                ${ item.tgl_bayar ? `<span class="px-2 py-1 rounded-full bg-blue-200 text-blue-800 text-xs font-semibold">Sudah dibayar</span>` : item.is_generate ? `<span class="px-2 py-1 rounded-full bg-green-200 text-green-800 text-xs font-semibold">Sudah digenerate</span>` : `<span class="px-2 py-1 rounded-full bg-red-200 text-red-800 text-xs font-semibold">Belum digenerate</span>` }
            </div>

            <div class="flex items-center w-full justify-end gap-x-2 mt-4">
                ${ item.is_generate ? ` <button type="button" onclick="Swal.close()" class="flex items-center gap-x-2 py-2 px-4 rounded-lg border border-[#DD4049]"> <span class="text-[#DD4049]">Batal</span> </button> ` : ` <button type="button" id="generateBtn" class="flex items-center gap-x-2 py-2 px-4 rounded-lg border border-[#45D03E]"> <span class="text-[#45D03E]">Generate</span> </button> <button type="button" onclick="Swal.close()" class="flex items-center gap-x-2 py-2 px-4 rounded-lg border border-[#DD4049]"> <span class="text-[#DD4049]">Batal</span> </button> ` }
            </div>
        </form>
        `,
                    width: '700px',
                    showConfirmButton: false,
                    didOpen: () => {
                        document.getElementById('generateBtn').addEventListener('click', function() {
                            Swal.fire({
                                title: 'Lanjutkan generate?',
                                icon: 'question',
                                showCancelButton: true,
                                confirmButtonText: 'Ya',
                                cancelButtonText: 'Batal',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Kirim request ke backend untuk update is_generate dan buat jurnal
                                    fetch(`/hutang_vendor/${item.id}/generate`, {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': document.querySelector(
                                                    'meta[name="csrf-token"]').content
                                            },
                                            body: JSON.stringify({})
                                        })
                                        .then(res => res.json())
                                        .then(data => {
                                            if (data.success) {
                                                Swal.fire('Berhasil!',
                                                    'Hutang vendor berhasil digenerate.',
                                                    'success'
                                                ).then(() => location.reload());
                                            } else if (data.error) {
                                                Swal.fire('Error', data.error, 'error');
                                            }
                                        })
                                        .catch(err => {
                                            Swal.fire('Error',
                                                'Terjadi kesalahan saat generate: ' + err
                                                .message,
                                                'error'
                                            );
                                        });

                                }
                            });
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
        <script>
            function bayarHutang(item, bankList) {
                Swal.fire({
                    html: `
        <form id="bayarForm" action="/hutang_vendor/${item.id}/bayar" method="POST" class="flex flex-col items-start gap-y-4">
            @csrf
            @method('PUT')
            <h1 class="font-bold text-2xl mb-4">Bayar Hutang Vendor</h1>

            <div class="flex items-center w-full">
                <label class="w-[200px] text-start">Tgl Bayar Hutang</label>
                <input  value="{{ \Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d') }}" readonly type="date" name="tgl_bayar" class="w-full bg-[#D9D9D9] rounded-lg px-4 py-2" required/>
            </div>

            <div class="flex items-center w-full">
                <label class="w-[200px] text-start">Nama Supplier</label>
                <input type="text" value="${item.supplier?.nama ?? '-'}" readonly class="w-full bg-[#D9D9D9] rounded-lg px-4 py-2"/>
            </div>

            <div class="flex items-center w-full">
                <label class="w-[200px] text-start">Nominal</label>
                <input type="text" value="Rp. ${Number(item.nominal).toLocaleString('id-ID')}" readonly class="w-full bg-[#D9D9D9] rounded-lg px-4 py-2"/>
            </div>

            <div class="flex items-center w-full">
                <label class="w-[200px] text-start">Kas / Bank</label>
                <select name="kode_akun" class="w-full bg-[#D9D9D9] rounded-lg px-4 py-2" required>
                    <option disabled selected>Pilih Kas / Bank</option>
                    ${bankList.map(b => `
                                                                                        <option value="${b.kode_akun}">${b.nama_akun}</option>
                                                                                    `).join('')}
                </select>
            </div>

            <div class="flex items-center w-full justify-end gap-x-2 mt-4">
                <button type="submit" class="bg-[#3E98D0] text-white px-4 py-2 rounded-lg">Simpan</button>
                <button type="button" onclick="Swal.close()" class="bg-[#DD4049] text-white px-4 py-2 rounded-lg">Batal</button>
            </div>
        </form>
        `,
                    width: '700px',
                    showConfirmButton: false
                });
            }
        </script>

    </div>
@endsection
