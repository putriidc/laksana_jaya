@extends('kepala-proyek.layout')
@section('content')
    <div>
        <h1 class="font-bold text-2xl mb-6">Data Proyek Pengawas</h1>
        @if (session('success'))
            <div
                id="flash-message"
                data-type="success"
                data-message="{{ session('success') }}"
            ></div>
        @elseif (session('error'))
            <div
                id="flash-message"
                data-type="error"
                data-message="{{ session('error') }}"
            ></div>
        @endif
        <section>
            <div class="flex items-center pb-4 w-full justify-between border-b">
                <form action="" class="flex items-center gap-x-2">
                    <select id="select-beast" placeholder="Pilih Nama" autocomplete="off"
                        class="w-[200px] appearance-none border-[#9A9A9A] border-2 outline-none rounded-lg py-[8px] px-[10px] bg-white cursor-pointer">
                        <option selected>Cari Nama Paket</option>
                        <option value="1">Aby</option>
                        <option value="2">Budi</option>
                        <option value="3">Citra</option>
                        <option value="4">Deni</option>
                        <option value="5">Eka</option>
                    </select>
                    <button type="submit"
                        class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                        <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" class="w-[20px]">
                    </button>
                </form>
                <div class="flex items-center gap-x-2">
                    <a href="{{ route('pinjamanKaryawans.create') }}"><button class="cursor-pointer px-4 py-2 border-[#9A9A9A] border-2 rounded-lg flex items-center gap-x-2 bg-white">
                        <span class="text-[#72686B]">Cetak Semua Data</span>
                        <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                    </button></a>
                    <button class="border-[#9A9A9A] border-2 rounded-lg py-2 px-4 bg-white cursor-pointer" id="modal-add">
                       Tambah Perusahaan +
                    </button>
                    <a href="/kepala-proyek/data-proyek/create" class="border-[#9A9A9A] border-2 rounded-lg py-2 px-4 bg-white cursor-pointer">
                       Tambah Data +
                    </a>
                </div>
            </div>
             <h1 class="font-bold text-2xl my-4">CV ARS GUMILANG</h1>
            <div class="rounded-lg shadow-[1px_1px_10px_rgba(0,0,0,0.1)] pt-4 pb-6">
                <table class="table-auto text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[5%]">No</th>
                        <th class="py-2 w-[20%]">Nama Paket</th>
                        <th class="py-2 w-[10%]">PIC</th>
                        <th class="py-2 w-[12%]">No Hp</th>
                        <th class="py-2 w-[10%]">MC 0</th>
                        <th class="py-2 w-[10%]">Korlap</th>
                        <th class="py-2 w-[15%]">Kontraktor</th>
                        <th class="py-2 w-[6%]">Total Progress</th>
                        <th class="py-2 2-[10%]">Action</th>
                    </thead>
                    <tbody>
                            <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">1</td>
                                <td class="py-2">Peningkatan Jaringan Irigasi Saluran Tersier Simangu Kec. Talun</td>
                                <td class="py-2">Sudirman</td>
                                <td class="py-2">0822-3226-6660</td>
                                <td class="py-2">12/11/2025</td>
                                <td class="py-2">Bapak Fikri</td>
                                <td class="py-2">CV. JOMBANG KARYA</td>
                                <td class="py-2">40%</td>
                                <td class="py-2">
                                    <div class="flex items-center justify-between w-[90px] m-auto">
                                    {{-- Tombol Edit --}}
                                    <a href="/kepala-proyek/data-proyek/update"
                                        class="btn btn-sm btn-primary">
                                        <img src="{{ asset('assets/edit-icon.png') }}" alt="edit icon"
                                            class="w-[20px] cursor-pointer">
                                    </a>

                                    <span class="border-black border-l-[1px] h-[22px]"></span>
                                    {{-- Tombol Detail --}}
                                    <a href="/kepala-proyek/data-proyek/detail"
                                        class="btn btn-sm btn-primary">
                                        <img src="{{ asset('assets/more-circle.png') }}" alt="detail icon"
                                            class="w-[20px] cursor-pointer">
                                    </a>
                                    <span class="border-black border-l-[1px] h-[22px]"></span>
                                    {{-- Tombol Delete --}}
                                    <form action="" method="POST"
                                        class="h-[22px]">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                            <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                class="w-[20px] cursor-pointer">
                                        </button>
                                    </form>
                                    </div>
                                </td>
                            </tr>
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">1</td>
                                <td class="py-2">Peningkatan Jaringan Irigasi Saluran Tersier Simangu Kec. Talun</td>
                                <td class="py-2">Sudirman</td>
                                <td class="py-2">0822-3226-6660</td>
                                <td class="py-2">12/11/2025</td>
                                <td class="py-2">Bapak Fikri</td>
                                <td class="py-2">CV. JOMBANG KARYA</td>
                                <td class="py-2">40%</td>
                                <td class="py-2">
                                    <div class="flex items-center justify-between w-[90px] m-auto">
                                    {{-- Tombol Edit --}}
                                    <a href="/kepala-proyek/data-proyek/update"
                                        class="btn btn-sm btn-primary">
                                        <img src="{{ asset('assets/edit-icon.png') }}" alt="edit icon"
                                            class="w-[20px] cursor-pointer">
                                    </a>

                                    <span class="border-black border-l-[1px] h-[22px]"></span>
                                    {{-- Tombol Detail --}}
                                    <a href="/kepala-proyek/data-proyek/detail"
                                        class="btn btn-sm btn-primary">
                                        <img src="{{ asset('assets/more-circle.png') }}" alt="detail icon"
                                            class="w-[20px] cursor-pointer">
                                    </a>
                                    <span class="border-black border-l-[1px] h-[22px]"></span>
                                    {{-- Tombol Delete --}}
                                    <form action="" method="POST"
                                        class="h-[22px]">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                            <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                class="w-[20px] cursor-pointer">
                                        </button>
                                    </form>
                                    </div>
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </section>
        {{-- <script>
            // Modal Add menggunakan sweertalert2 untuk form tambah data
            const modalAdd = document.getElementById('modal-add');
            modalAdd.addEventListener('click', function() {
                Swal.fire({
                    html: `
                        <form action="" method="POST" id="form-tambah">
                            @csrf
                            <div class="flex items-center">
                                <div class="w-[280px]"></div>
                                <h1 class="font-bold text-2xl mb-4 w-full text-left">Tambah Perusahaan</h1>
                            </div>
                            <div class="flex items-center">
                                <label for="nama-perusahaan" class="w-[300px]">Nama Perusahaan</label>
                                <input type="text" id="nama-perusahaan" name="nama_perusahaan" class="w-full outline-none bg-[#E9E9E9] rounded-lg px-4 py-2" required>
                            </div>
                        </form>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Simpan',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kirim data ke server
                        const form = document.getElementById('form-tambah');
                        // Periksa apakah form ditemukan
                        if (form) {
                            // PENTING: Submit form secara paksa
                            form.submit();
                        } else {
                            // Handle jika form tidak ditemukan (jarang terjadi)
                            Swal.fire('Error!', 'Form tidak ditemukan.', 'error');
                        }
                    }
                })
            });
           
        </script> --}}
    </div>
@endsection
