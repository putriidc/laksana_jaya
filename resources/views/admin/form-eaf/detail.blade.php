@extends('admin.layout')
@section('content')
<div>
    <h1 class="text-2xl font-bold mb-5">EAF</h1>
    <div class="flex flex-col gap-y-4 pb-8 border-b border-gray-300 mb-5">
        <div class="flex items-center">
            <span class="w-[180px]">Nama Proyek</span>
            <div class="w-full bg-[#D9D9D9]/40 px-5 py-2 rounded-lg font-bold">
                Proyek Pa Dwi
            </div>
        </div>
        <div class="flex items-center">
            <span class="w-[180px]">Saldo Kas</span>
            <div class="w-full bg-[#D9D9D9]/40 px-5 py-2 rounded-lg font-bold">
                Rp. 3.000.000
            </div>
        </div>
    </div>
    <div class="pb-8 border-b border-gray-300 mb-5">
        <h1 class="text-2xl font-bold mb-5">Rincian</h1>
        <form action="" method="post" class="flex flex-col gap-y-5">
            <div class="flex items-center">
                <label for="" class="w-[180px]">Tanggal Relasi</label>
                <div class="w-full flex items-center justify-between">
                    <input type="text" name="" id="" class="w-[40%] bg-[#D9D9D9]/40 px-5 py-2 rounded-lg font-bold " readonly>
                    <div class="w-[55%] flex items-center">
                        <label for="" class="w-[160px]">Keterangan</label>
                        <input type="text" name="" id="" class="w-full bg-[#D9D9D9]/40 px-5 py-2 rounded-lg font-bold">
                    </div>
                </div>
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px]">Kode Akun</label>
                <div class="w-full flex items-center justify-between">
                    <input type="text" name="" id="" class="w-[40%] bg-[#D9D9D9]/40 px-5 py-2 rounded-lg font-bold " readonly>
                    <div class="w-[55%] flex items-center">
                        <label for="" class="w-[160px]">Debet</label>
                        <input type="text" name="" id="" class="w-full bg-[#D9D9D9]/40 px-5 py-2 rounded-lg font-bold">
                    </div>
                </div>
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px]">Nama Akun</label>
                <div class="w-full flex items-center justify-between">
                    <input type="text" name="" id="" class="w-[40%] bg-[#D9D9D9]/40 px-5 py-2 rounded-lg font-bold " readonly>
                    <div class="w-[55%] flex items-center">
                        <label for="" class="w-[160px]">Kredit</label>
                        <input type="text" name="" id="" class="w-full bg-[#D9D9D9]/40 px-5 py-2 rounded-lg font-bold">
                    </div>
                </div>
            </div>
            <div class="flex mt-4">
                    <div class="w-[180px]"></div>
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
    </div>
    <div>
        <div class="flex justify-between items-center mb-5">
            <h1 class="text-2xl font-bold">Tabel Rincian</h1>
            <button id="modal-generate" class="flex items-center gap-x-2 border border-[#45D03E] px-4 py-2 rounded-lg cursor-pointer">
                <span class="text-[#45D03E]">Generate</span>
                <img src="{{ asset('assets/card-send-greeen.png') }}" alt="card send icon" class="w-[20px] h-[20px]">
            </button>
        </div>
        <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6">
                <table class="table-auto text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[5%]">No</th>
                        <th class="py-2 w-[10%]">Tgl Relasi</th>
                        <th class="py-2 w-[15%]">Kode Akun</th>
                        <th class="py-2 w-[10%]">Nama Akun</th>
                        <th class="py-2 w-[10%]">Keterangan</th>
                        <th class="py-2 w-[15%]">Debet</th>
                        <th class="py-2 w-[15%]">Kredit</th>
                        <th class="py-2 w-[10%]">Action</th>
                    </thead>
                    <tbody>
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">1</td>
                                <td class="py-2">11/02/2025</td>
                                <td class="py-2">115</td>
                                <td class="py-2">Piutang Proyek</td>
                                <td class="py-2">Kas Pak Dwi</td>
                                <td class="py-2">Rp. 5.000.000</td>
                                <td class="py-2">Rp. 5.000.000</td>
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
                <div class="w-full flex justify-end">
                    <div class="flex gap-x-8 items-center pr-10 pt-5 font-bold">
                        <span>SISA SALDO KAS</span>
                        <span>Rp.0</span>
                    </div>
                </div>
            </div>
    </div>
    <script>
            const modalGenerate = document.getElementById('modal-generate');
            modalGenerate.addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    html: `
                        <div>
                            <h1 class="font-bold text-2xl text-center mb-5">Lanjutkan Generate Laporan?</h1>
                            <div class="w-full flex justify-center items-center">
                                <a href="/form-eaf" class="bg-[#8CE987] w-[100px] py-2 font-semibold rounded-lg cursor-pointer mx-2">YA</a>
                                <a href="" class="bg-[#DD4049] w-[100px] py-2 font-semibold rounded-lg cursor-pointer mx-2">BATAL</a>
                            </div>
                        </div>
                    `,
                    showCancelButton: false,
                    showCloseButton: false,
                    showConfirmButton: false,
                    
                })
            });
        </script>
</div>
@endsection