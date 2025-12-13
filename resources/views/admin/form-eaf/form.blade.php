@extends('admin.layout')
@section('content')
<div>
    <h1 class="text-2xl font-bold mb-5">Form Pengajuan EAF</h1>
    <form action="" class="flex flex-col gap-y-5 pb-10 border-b border-gray-300">
        <div class="flex items-center">
            <label for="" class="w-[200px]">Tanggal Pengajuan</label>
            <input type="text" data-flatpickr name="" id="" readonly disabled value="2025-12-07" class="bg-[#D9D9D9]/40 px-6 py-2 rounded-lg w-full">
        </div>
        <div class="flex items-center">
            <label for="" class="w-[200px]">Tanggal Pengajuan</label>
            <select name="" id="" class="bg-[#D9D9D9]/40 px-4 appearance-none py-2 rounded-lg w-full cursor-pointer">
                <option selected disabled>~Pilih Nama Proyek~</option>
                <option value=""></option>
            </select>
        </div>
        <div class="flex items-center">
            <label for="" class="w-[200px]">PIC</label>
            <select name="" id="" class="bg-[#D9D9D9]/40 px-4 appearance-none py-2 rounded-lg w-full cursor-pointer">
                <option selected disabled>~Pilih PIC~</option>
                <option value=""></option>
            </select>
        </div>
         <div class="flex items-center">
            <label for="" class="w-[200px]">Nominal</label>
            <input type="text" placeholder="Rp." name="" id="" class="bg-[#D9D9D9]/40 px-6 py-2 rounded-lg w-full">
        </div>
         <div class="flex">
            <label for="" class="w-[200px]">Detail Biaya</label>
            <textarea name="" id="" cols="20" rows="8" class="bg-[#D9D9D9]/40 px-6 py-2 rounded-lg w-full"></textarea>
        </div>
        <div class="flex">
                    <div class="w-[200px]"></div>
                    <div class="w-full flex gap-x-2">
                        <button type="submit" class="bg-white border border-[#3E98D0] text-[#3E98D0] px-4 py-[6px] rounded-lg cursor-pointer flex items-center justify-center gap-x-1">
                            <span>Simpan Data</span>
                            <img src="{{ asset('assets/plus-circle-blue.png') }}" class="w-[25px] h-[25px]" alt="plus icon">
                        </button>
                        <button type="submit" class="bg-white border border-[#DD4049] text-[#DD4049] px-4 py-[6px] rounded-lg cursor-pointer flex items-center justify-center gap-x-2">
                            <span>Batal</span>
                            <img src="{{ asset('assets/close-circle-red.png') }}" class="w-[18px] h-[18px]" alt="close icon">
                        </button>
                    </div>
                </div>
    </form>
    <div class="mt-5">
        <h1 class="text-2xl font-bold mb-5">Status Pengajuan</h1>
        <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6">
                <table class="table-auto text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[5%]">No</th>
                        <th class="py-2 w-[10%]">Tgl Pengajuan</th>
                        <th class="py-2 w-[15%]">Nama Proyek</th>
                        <th class="py-2 w-[10%]">PIC</th>
                        <th class="py-2 w-[10%]">Nominal</th>
                        <th class="py-2 w-[15%]">Detail Biaya</th>
                        <th class="py-2 w-[10%]">Status</th>
                        <th class="py-2 w-[10%]">Action</th>
                    </thead>
                    <tbody>
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">1</td>
                                <td class="py-2">11/02/2025</td>
                                <td class="py-2">Proyek Pa Dwi</td>
                                <td class="py-2">Rhama</td>
                                <td class="py-2">Rp. 5.000.000</td>
                                <td class="py-2">
                                    <span onclick="detailBiaya()" class="hover:underline text-blue-400 cursor-pointer">Lihat Detail</span>
                                </td>
                                <td class="py-2">
                                    <div class="flex gap-x-1 items-center">
                                        <span class="px-4 py-1 bg-[#45D03E] text-xs rounded-sm text-white">ACC</span>
                                        <span class="px-4 py-1 bg-[#45D03E] text-xs rounded-sm text-white">ACC</span>
                                    </div>
                                </td>
                                <td class="py-2">
                                    <div class="flex items-center gap-x-2 justify-center">
                                        {{-- Tombol Edit --}}
                                        <a href="/detail-eaf" class="btn btn-sm btn-primary">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                                class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>

                                        {{-- Tombol Delete --}}
                                        <form action="" method="POST"
                                            class="h-[22px]">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                    class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                </div>
                                </td>
                            </tr>
                            <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">1</td>
                                <td class="py-2">11/02/2025</td>
                                <td class="py-2">Proyek Pa Dwi</td>
                                <td class="py-2">Rhama</td>
                                <td class="py-2">Rp. 5.000.000</td>
                                <td class="py-2">
                                    <span onclick="detailBiaya()" class="hover:underline text-blue-400 cursor-pointer">Lihat Detail</span>
                                </td>
                                <td class="py-2">
                                    <div class="flex gap-x-1 items-center">
                                        <span class="px-4 py-1 bg-[#DD4049] text-xs rounded-sm text-white">DEC</span>
                                        <span class="px-4 py-1 bg-[#45D03E] text-xs rounded-sm text-white">ACC</span>
                                    </div>
                                </td>
                                <td class="py-2">
                                    <div class="flex items-center gap-x-2 justify-center">
                                        {{-- Tombol Edit --}}
                                        <a href="/detail-eaf" class="btn btn-sm btn-primary">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                                class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>

                                        {{-- Tombol Delete --}}
                                        <form action="" method="POST"
                                            class="h-[22px]">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                    class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                </div>
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
    </div>
    <script>
        function detailBiaya() {
            Swal.fire({
                html: `
                    <div class="flex flex-col gap-y-4 items-center">
                        <h1 class="font-bold text-2xl text-center mb-5">Detail Biaya</h1>
                        <div class="px-4 py-4 bg-[#D9D9D9]/40 w-full">
                            Uang Makan : Rp. 1.500.000,
                            Biaya Material : Rp. 1.300.000,
                            Sisa Kas Pak Dwi : Rp. 200.000,
                        </div>
                    </div>
                `,
                showCloseButton: true,
                showConfirmButton: false,
            })
        }
    </script>
</div>
@endsection