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
            <div class="flex items-center pb-4 w-full justify-between border-b max-[720px]:flex-col max-[720px]:items-start max-[720px]:gap-y-2"> {{-- Bagian yang di responsive --}}
                <form action="" class="flex items-center gap-x-2 max-[720px]:order-2"> {{-- Bagian yang di responsive --}}
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
                <div class="flex items-center gap-x-2 max-[720px]:order-1 max-[720px]:flex-col max-[720px]:items-start max-[720px]:gap-y-2">
                    <a target="_blank" href="{{ route('perusahaan.print', $perusahaan->id) }}"><button class="cursor-pointer px-4 py-2 border-[#9A9A9A] border-2 rounded-lg flex items-center gap-x-2 bg-white">
                        <span class="text-[#72686B]">Cetak Semua Data</span>
                        <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                    </button></a>
                    {{-- <button class="border-[#9A9A9A] border-2 rounded-lg py-2 px-4 bg-white cursor-pointer" id="modal-add">
                       Tambah Perusahaan +
                    </button> --}}
                    <a href="/perusahaan/{{ $perusahaan->kode_perusahaan }}/data-perusahaan/create" class="border-[#9A9A9A] border-2 rounded-lg py-2 px-4 bg-white cursor-pointer">
                       Tambah Data +
                    </a>
                </div>
            </div>
             <h1 class="font-bold text-2xl my-4">{{ $perusahaan->nama_perusahaan }}</h1>
            <div class="rounded-lg shadow-[1px_1px_10px_rgba(0,0,0,0.1)] pt-4 pb-6 max-[1200px]:overflow-x-auto"> {{-- Bagian yang di responsive --}}
                <table class="table-auto max-[1200px]:table-fixed text-center text-sm w-full max-[1200px]:w-[1200px]"> {{-- Bagian yang di responsive --}}
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
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($data as $item)
                        <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">{{ $no++ }}</td>
                                <td class="py-2">{{ $item->nama_paket ?? '-' }}</td>
                                <td class="py-2">{{ $item->pic ?? '-' }}</td>
                                <td class="py-2">{{ $item->no_hp ?? '-' }}</td>
                                <td class="py-2">{{ $item->mc0 ?? '-' }}</td>
                                <td class="py-2">{{ $item->korlap ?? '-' }}</td>
                                <td class="py-2">{{ $item->kontraktor ?? '-' }}</td>
                                <td class="py-2">{{ $progressTotals[$item->id] ?? 0 }}%</td>
                                <td class="py-2 max-[1200px]:hidden"> {{-- Bagian yang di responsive --}}
                                    <div class="flex items-center justify-between w-[90px] m-auto">
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('data-perusahaan.edit', $item->id) }}"
                                        class="btn btn-sm btn-primary">
                                        <img src="{{ asset('assets/edit-icon.png') }}" alt="edit icon"
                                            class="w-[20px] cursor-pointer">
                                    </a>

                                    <span class="border-black border-l-[1px] h-[22px]"></span>
                                    {{-- Tombol Detail --}}
                                    <a href="{{ route('data-perusahaan.show', $item->id) }}"
                                        class="btn btn-sm btn-primary">
                                        <img src="{{ asset('assets/more-circle.png') }}" alt="detail icon"
                                            class="w-[20px] cursor-pointer">
                                    </a>
                                    <span class="border-black border-l-[1px] h-[22px]"></span>
                                    {{-- Tombol Delete --}}
                                    {{-- <form action="{{ route('data-perusahaan.destroy', $item->id) }}" method="POST"
                                        class="h-[22px]">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                            <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                class="w-[20px] cursor-pointer">
                                        </button>
                                    </form> --}}
                                        <button type="button" onclick="confirmDelete('{{ $item->id }}')">
                                            <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                class="w-[20px] cursor-pointer">
                                        </button>
                                    </div>
                                </td>
                                <td class="py-2 min-[1200px]:hidden"> {{-- Bagian yang di tambah karena responsive --}}
                                    <div class="flex items-center justify-center m-auto">
                                    {{-- Tombol Detail --}}
                                    <button class="cursor-pointer" onclick="modalAction('{{ $item->id }}')">
                                        <img src="{{ asset('assets/more-circle.png') }}" alt="detail icon" class="w-[30px]">
                                    </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
        <script>
            function modalAction(id) { // bagian yang di responsive (menggunakan fungsi modalAction)
                const baseUrl = "{{ url('data-perusahaan') }}";
                const deleteUrl = `${baseUrl}/${id}`;
                const editUrl = `${baseUrl}/${id}/edit`;
                const detailUrl = `${baseUrl}/${id}`;
                Swal.fire({
                    html:`
                    <div>
                    <h1 class="text-2xl font-bold mb-5 text-start">Action</h1>
                    <div class="flex items-center justify-center text-white gap-x-1 max-[600px]:w-[70%] max-[600px]:m-auto max-[600px]:flex-col max-[600px]:gap-y-2">
                        <a href="${editUrl}" class="bg-[#F98C2D] grow max-[600px]:w-full py-2 font-semibold rounded-md cursor-pointer">Edit</a>
                        <a href="${detailUrl}" class="bg-[#45D03E] grow max-[600px]:w-full py-2 font-semibold rounded-md cursor-pointer">Detail</a>
                        <button type="button" 
                        onclick="confirmDelete('${id}')" 
                        class="bg-[#DD4049] grow py-2 font-semibold rounded-md cursor-pointer max-[600px]:w-full">
                            Hapus
                        </button>
                    </div>
                    `,
                    showConfirmButton: false,
                    showCloseButton: true,
                })
            }

           function confirmDelete(id) {
                Swal.fire({
                    title: 'Yakin hapus data?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#DD4049',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Buat form dinamis
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = `{{ url('data-perusahaan') }}/${id}`;

                        // Tambahkan CSRF Token (Sangat Penting di Laravel)
                        const csrfToken = document.createElement('input');
                        csrfToken.type = 'hidden';
                        csrfToken.name = '_token';
                        csrfToken.value = '{{ csrf_token() }}';

                        // Tambahkan Method DELETE
                        const methodField = document.createElement('input');
                        methodField.type = 'hidden';
                        methodField.name = '_method';
                        methodField.value = 'DELETE';

                        // Gabungkan elemen
                        form.appendChild(csrfToken);
                        form.appendChild(methodField);
                        document.body.appendChild(form);

                        // Kirim form
                        form.submit();
                    }
                });
            }

            // // Modal Add menggunakan sweertalert2 untuk form tambah data
            // const modalAdd = document.getElementById('modal-add');
            // modalAdd.addEventListener('click', function() {
            //     Swal.fire({
            //         html: `
            //             <form action="{{ route('perusahaan.store') }}" method="POST" id="form-tambah">
            //                 @csrf
            //                 <div class="flex items-center">
            //                     <div class="w-[280px]"></div>
            //                     <h1 class="font-bold text-2xl mb-4 w-full text-left">Tambah Perusahaan</h1>
            //                 </div>
            //                 <div class="flex items-center">
            //                     <label for="nama-perusahaan" class="w-[300px]">Nama Perusahaan</label>
            //                     <input type="text" id="nama-perusahaan" name="nama_perusahaan" class="w-full outline-none bg-[#E9E9E9] rounded-lg px-4 py-2" required>
            //                 </div>
            //             </form>
            //         `,
            //         showCancelButton: true,
            //         confirmButtonText: 'Simpan',
            //         cancelButtonText: 'Batal',
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             // Kirim data ke server
            //             const form = document.getElementById('form-tambah');
            //             // Periksa apakah form ditemukan
            //             if (form) {
            //                 // PENTING: Submit form secara paksa
            //                 form.submit();
            //             } else {
            //                 // Handle jika form tidak ditemukan (jarang terjadi)
            //                 Swal.fire('Error!', 'Form tidak ditemukan.', 'error');
            //             }
            //         }
            //     })
            // });

        </script>
    </div>
@endsection
