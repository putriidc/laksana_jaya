@extends('admin.layout')
@section('content')
    <div>
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold mb-5">Nota Langsung</h1>
            <div class="flex items-center gap-x-2">
                <button class="border border-[#9A9A9A] rounded-lg px-4 py-2 cursor-pointer"
                    onclick="formNotaLangsung()">Tambah Data +</button>
               <a target="_blank" href="{{ route('nota-langsung.print') }}"
                    class="border border-[#9A9A9A] rounded-lg px-4 py-2 cursor-pointer flex items-center gap-x-1">
                    <span class="text-[#726868]">Cetak Data</span>
                    <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                </a>
            </div>
        </div>
        <div class="mt-5">
            <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6">
                <table class="table-auto text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[5%]">No</th>
                        <th class="py-2 w-[10%]">Tanggal</th>
                        <th class="py-2 w-[15%]">Nama Proyek</th>
                        <th class="py-2 w-[10%]">PIC</th>
                        <th class="py-2 w-[10%]">Nominal</th>
                        <th class="py-2 w-[15%]">Detail Biaya</th>
                        <th class="py-2 w-[10%]">Action</th>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($nota as $item)
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">{{ $no++ }}</td>
                                <td class="py-2">{{ $item->tanggal }}</td>
                                <td class="py-2">{{ $item->nama_proyek }}</td>
                                <td class="py-2">{{ $item->pic }}</td>
                                <td class="py-2">{{ 'RP. ' . number_format($item->nominal, 0, ',', '.') }}</td>
                                <td class="py-2">
                                    <span data-detail="{{ $item->detail_biaya }}" onclick="detailBiaya(this)"
                                        class="hover:underline text-blue-400 cursor-pointer">
                                        Lihat Detail
                                    </span>
                                </td>
                                <td class="py-2">
                                    @if ($today === $item->tanggal)
                                    <div class="flex items-center justify-center gap-x-2">
                                        {{-- Tombol Delete --}}
                                        <form action="{{ route('notaLangsung.destroy', $item->id) }}" method="POST" class="h-[22px]">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                <img src="https://ar4n-group.com/public/assets/close-circle.png"
                                                    alt="delete icon" class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            function formNotaLangsung() {
                Swal.fire({
                    html: `
                            <form action="{{ route('notaLangsung.store') }}" method="POST" class="flex flex-col gap-y-4">
                                @csrf
                                <h1 class="font-bold text-2xl text-start mb-5">Form Nota Langsung</h1>
                                <div class="flex items-center max-[550px]:flex-col max-[550px]:items-start">
                                    <label for="tanggal" class="font-medium w-[160px] text-start">Tanggal</label>
                                    <input type="date" name="tanggal" id="tanggal" value="{{ $today }}" readonly class="bg-[#D9D9D9]/40 px-6 py-2 rounded-lg w-full">
                                </div>
                                <div class="flex items-center max-[550px]:flex-col max-[550px]:items-start">
                                    <label for="proyek" class="font-medium w-[160px] text-start">Nama Proyek</label>
                                    <select name="nama_proyek" id="nama_proyek"
                    class="bg-[#D9D9D9]/40 px-4 appearance-none py-2 rounded-lg w-full cursor-pointer">
                    <option selected disabled>~Pilih Nama Proyek~</option>
                    @foreach ($proyek as $item)
                        <option value="{{ $item->nama_proyek }}" data-pic="{{ $item->pic }}">
                            {{ $item->nama_proyek }}
                        </option>
                    @endforeach
                </select>
                                </div>
                                <div class="flex items-center max-[550px]:flex-col max-[550px]:items-start">
                                    <label for="pic" class="font-medium w-[160px] text-start">PIC</label>
                                    <input type="text" name="pic" id="pic" class="bg-[#D9D9D9]/40 px-6 py-2 rounded-lg w-full" readonly>
                                </div>
                                <div class="flex items-center max-[550px]:flex-col max-[550px]:items-start">
                                    <label for="" class="font-medium w-[160px] text-start">Dari Kas/Bank</label>
                                    <select name="kode_kas" id=""
                    class="bg-[#D9D9D9]/40 px-4 appearance-none py-2 rounded-lg w-full cursor-pointer">
                    <option selected disabled>~Pilih Nama Proyek~</option>
                    @foreach ($bank as $item)
                        <option value="{{ $item->kode_akun }}">
                            {{ $item->nama_akun }}
                        </option>
                    @endforeach
                </select>
                                </div>
                                <div class="flex items-center max-[550px]:flex-col max-[550px]:items-start">
                                    <label for="akun" class="font-medium w-[160px] text-start">Ke Nama Akun</label>
                                    <select name="kode_akun" id=""
                    class="bg-[#D9D9D9]/40 px-4 appearance-none py-2 rounded-lg w-full cursor-pointer">
                    <option selected disabled>~Pilih Nama Akun~</option>
                    @foreach ($hpp as $item)
                        <option value="{{ $item->kode_akun }}">
                            {{ $item->nama_akun }}
                        </option>
                    @endforeach
                </select>
                                </div>
                                <div class="flex items-center max-[550px]:flex-col max-[550px]:items-start">
                                    <label for="keterangan" class="font-medium w-[160px] text-start">Keterangan</label>
                                    <input type="text" name="keterangan" id="keterangan" class="bg-[#D9D9D9]/40 px-6 py-2 rounded-lg w-full">
                                </div>
                                <div class="flex items-center max-[550px]:flex-col max-[550px]:items-start">
                                    <label for="nominal" class="font-medium w-[160px] text-start">Nominal</label>
                                    <input type="text" name="nominal" id="nominal" class="bg-[#D9D9D9]/40 px-6 py-2 rounded-lg w-full rupiah-format">
                                </div>
                                <div class="flex items-start">
                                    <label for="detail_biaya" class="font-medium w-[160px] text-start">Detail Biaya</label>
                                    <textarea name="detail_biaya" id="detail_biaya" cols="20" rows="5" class="bg-[#D9D9D9]/40 px-6 py-2 rounded-lg w-full"></textarea>
                                </div>
                                <div class="flex items-center max-[550px]:flex-col max-[550px]:items-start">
                                    <label for="" class="font-medium w-[130px]"></label>
                                    <button class="flex items-center gap-x-1 border border-[#3E98D0] text-[#3E98D0] px-4 py-[6px] rounded-lg cursor-pointer">
                                        <span class="text-[#3E98D0]">Simpan Data</span>
                                        <img src="{{ asset('assets/plus-circle-blue.png') }}" class="w-[25px] h-[25px]" alt="plus icon" />
                                    </button>
                                </div>
                            </form>
                        `,
                    width: 800,
                    showCloseButton: true,
                    showConfirmButton: false,
                })
            }
            document.addEventListener('DOMContentLoaded', function() {
                // ambil select proyek
                const proyekSelect = document.getElementById('nama_proyek');
                const picInput = document.getElementById('pic');

                proyekSelect.addEventListener('change', function() {
                    // ambil data-pic dari option yang dipilih
                    const selectedOption = proyekSelect.options[proyekSelect.selectedIndex];
                    const picValue = selectedOption.getAttribute('data-pic');

                    // set ke input PIC
                    picInput.value = picValue ?? '';
                });
            });


            const modalGenerate = document.getElementById('modal-generate');
            modalGenerate.addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    html: `
                            <div>
                                <h1 class="font-bold text-2xl text-center mb-5">Lanjutkan Generate Laporan?</h1>
                                <div class="w-full flex justify-center items-center">
                                    <form action="" method="POST">
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

            function detailBiaya(el) {
                const detail = el.getAttribute('data-detail');
                Swal.fire({
                    html: `
                            <div class="flex flex-col gap-y-4 items-center">
                                <h1 class="font-bold text-2xl text-center mb-5">Detail Biaya</h1>
                                    <textarea readonly
                                        class="w-full px-4 py-2 border rounded-lg bg-[#D9D9D9]/40"
                                    rows="6">${detail}</textarea>
                            </div>
                        `,
                    showCloseButton: true,
                    showConfirmButton: false,
                })
            }
        </script>
        <script src="{{ asset('js/form.js') }}"></script>
    </div>
@endsection
