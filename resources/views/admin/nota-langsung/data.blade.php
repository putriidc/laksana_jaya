@extends('admin.layout')
@section('content')
    <div>
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold mb-5">Nota Langsung</h1>
            <div class="flex items-center gap-x-1">
                <button class="border border-[#9A9A9A] rounded-lg px-4 py-2 cursor-pointer" onclick="formNotaLangsung()">Tambah Data +</button>
                <a href="" class="border border-[#9A9A9A] rounded-lg px-4 py-2 cursor-pointer flex items-center gap-x-1">
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
                        <th class="py-2 w-[10%]">Tgl Pengajuan</th>
                        <th class="py-2 w-[15%]">Nama Proyek</th>
                        <th class="py-2 w-[10%]">PIC</th>
                        <th class="py-2 w-[10%]">Nominal</th>
                        <th class="py-2 w-[15%]">Detail Biaya</th>
                        <th class="py-2 w-[10%]">Action</th>
                    </thead>
                    <tbody>
                                <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                    <td class="py-2"></td>
                                    <td class="py-2"></td>
                                    <td class="py-2"></td>
                                    <td class="py-2"></td>
                                    <td class="py-2"></td>
                                    <td class="py-2">
                                        <span data-detail="" onclick="detailBiaya(this)"
                                            class="hover:underline text-blue-400 cursor-pointer">
                                            Lihat Detail
                                        </span>
                                    </td>
                                </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            function formNotaLangsung() {
                Swal.fire({
                    html: `
                            <form action="" method="POST" class="flex flex-col gap-y-4">
                                @csrf
                                <h1 class="font-bold text-2xl text-start mb-5">Form Nota Langsung</h1>
                                <div class="flex items-center">
                                    <label for="tanggal" class="font-medium w-[160px] text-start">Tanggal</label>
                                    <input type="date" name="tanggal" id="tanggal" class="bg-[#D9D9D9]/40 px-6 py-2 rounded-lg w-full">
                                </div>
                                <div class="flex items-center">
                                    <label for="proyek" class="font-medium w-[160px] text-start">Nama Proyek</label>
                                    <select name="proyek" id="proyek" class="bg-[#D9D9D9]/40 px-6 py-2 rounded-lg w-full appearance-none">
                                        <option selected disabled>~Pilih Nama Proyek~</option>
                                    </select>
                                </div>
                                <div class="flex items-center">
                                    <label for="pic" class="font-medium w-[160px] text-start">PIC</label>
                                    <input type="text" name="pic" id="pic" class="bg-[#D9D9D9]/40 px-6 py-2 rounded-lg w-full" readonly>
                                </div>
                                <div class="flex items-center">
                                    <label for="keterangan" class="font-medium w-[160px] text-start">Keterangan</label>
                                    <input type="text" name="keterangan" id="keterangan" class="bg-[#D9D9D9]/40 px-6 py-2 rounded-lg w-full">
                                </div>
                                <div class="flex items-center">
                                    <label for="nominal" class="font-medium w-[160px] text-start">Nominal</label>
                                    <input type="text" name="nominal" id="nominal" class="bg-[#D9D9D9]/40 px-6 py-2 rounded-lg w-full rupiah-format">
                                </div>
                                <div class="flex items-center">
                                    <label for="detail_biaya" class="font-medium w-[160px] text-start">Detail Biaya</label>
                                    <textarea name="detail_biaya" id="detail_biaya" cols="20" rows="8" class="bg-[#D9D9D9]/40 px-6 py-2 rounded-lg w-full"></textarea>
                                </div>
                                <div class="flex items-center">
                                    <label for="kas" class="font-medium w-[160px] text-start">Kas / Bank</label>
                                    <select name="kas" id="kas" class="bg-[#D9D9D9]/40 px-4 appearance-none py-2 rounded-lg w-full cursor-pointer">
                                        <option selected disabled>~Pilih kas / bank~</option>
                                    </select>
                                </div>
                                <div class="flex items-center">
                                    <label for="" class="font-medium w-[130px]"></label>
                                    <button class="flex items-center gap-x-1">
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
