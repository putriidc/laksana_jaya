@extends('owner.layout') @section('content')
    <div>
        <div class="flex flex-col mb-6">
        <section class="mb-10">
            <h1 class="font-bold text-2xl mb-4 text-[#C0C0C0]">Form Pengajuan Pinjaman Karyawan</h1>
            <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6">
                <table class="table-auto text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[5%]">No</th>
                        <th class="py-2 w-[10%]">Tgl Pengajuan</th>
                        <th class="py-2 w-[15%]">Nama Karyawan</th>
                        <th class="py-2 w-[15%]">Status</th>
                        <th class="py-2 w-[20%]">Jumlah Pinjaman</th>
                        <th class="py-2 w-[10%]">Action</th>
                    </thead>
                    <tbody>
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">1</td>
                                <td class="py-2">11/02/2025</td>
                                <td class="py-2">Aby</td>
                                <td class="py-2">Pengajuan Kasbon</td>
                                <td class="py-2">Rp. 500.000</td>
                                <td class="py-2 flex justify-center items-center">
                                    <form action="" class="flex items-center gap-x-2">
                                        <button class="bg-[#8CE987] px-4 py-2 rounded-lg cursor-pointer">Accept</button>
                                        <button type="button" class="bg-[#DD4049] px-4 py-2 rounded-lg cursor-pointer text-white" onclick="modalDecline()">Decline</button>
                                    </form>
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <section class="mb-5 pb-10 border-b-2 border-[#B6B6B6]">
                <h1 class="font-bold text-2xl mb-4 text-[#C0C0C0]">Form Pengajuan Pinjaman Tukang</h1>
                <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6">
                    <table class="table-auto text-center text-sm w-full">
                        <thead class="border-b-2 border-[#CCCCCC]">
                            <th class="py-2 w-[10%]">Tgl Pengajuan</th>
                            <th class="py-2 w-[15%]">Nama Tukang</th>
                            <th class="py-2 w-[15%]">Proyek</th>
                            <th class="py-2 w-[15%]">Kontrak</th>
                            <th class="py-2 w-[20%]">Jumlah Pinjaman</th>
                            <th class="py-2 w-[10%]">Action</th>
                        </thead>
                        <tbody>
                            @php
                                $noacca = 1;
                            @endphp
                            @foreach ($contents as $item)
                                <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                    <td class="py-2">{{ $item->tanggal }}</td>
                                    <td class="py-2">{{ $item->kasbon->nama_tukang }}</td>
                                    <td class="py-2">{{ $item->kasbon->nama_proyek }}</td>
                                    <td class="py-2">{{ $item->kontrak }}</td>
                                    <td class="py-2">{{ 'RP. ' . number_format($item->bayar, 0, ',', '.') }}</td>
                                    <td class="py-2 flex justify-center items-center">
                                        <form action="{{ route('accowner.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id_tukang_content" value="{{ $item->id }}">
                                            <button class="bg-[#8CE987] px-4 py-2 rounded-lg cursor-pointer">Accept</button>
                                        </form>

                                        <span>&nbsp; &nbsp;</span>

                                        <button data-id="{{ $item->id }}"
                                            class="bg-[#DD4049] px-4 py-2 rounded-lg cursor-pointer text-white decline-btn"
                                            id="modal-decline">Decline</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        <section class="mb-5">
            <h1 class="font-bold text-2xl mb-4 text-[#C0C0C0]">Data Persetujuan Pinjaman Karyawan</h1>
            <a href="" class="px-4 py-2 border-2 border-[#9A9A9A] rounded-lg w-fit flex items-center gap-x-2 mb-4">
                <span class="text-[#72686B]">Cetak Laporan</span>
                <img src="{{ asset('assets/printer.png') }}" alt="printer icon">
            </a>
            <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6">
                <table class="table-auto text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[5%]">No</th>
                        <th class="py-2 w-[10%]">Tgl Pengajuan</th>
                        <th class="py-2 w-[15%]">Nama Karyawan</th>
                        <th class="py-2 w-[15%]">Status</th>
                        <th class="py-2 w-[20%]">Jumlah Pinjaman</th>
                        <th class="py-2 w-[10%]">Status</th>
                    </thead>
                    <tbody>
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">1</td>
                                <td class="py-2">11/02/2025</td>
                                <td class="py-2">Aby</td>
                                <td class="py-2">Pengajuan Kasbon</td>
                                <td class="py-2">Rp. 500.000</td>
                                <td class="py-2 flex justify-center items-center">
                                    <span class="bg-[#8CE987] px-4 py-2 rounded-lg cursor-pointer">Accept</span>
                                </td>
                            </tr>
                            <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">1</td>
                                <td class="py-2">11/02/2025</td>
                                <td class="py-2">Aby</td>
                                <td class="py-2">Pengajuan Kasbon</td>
                                <td class="py-2">Rp. 500.000</td>
                                <td class="py-2 flex justify-center items-center">
                                    <span class="bg-[#DD4049] px-4 py-2 rounded-lg cursor-pointer">Decline</span>
                                </td>
                            </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <script>
            function modalDecline() {
                Swal.fire({
                    html: `
                        <div class="flex gap-x-4 w-full justify-center items-center h-[100px]">
                            <form action="/owner-pinjaman-create"  id="form-tambah">
                                @csrf
                                <button type="submit" class="bg-[#8CE987] px-4 py-2 rounded-lg cursor-pointer">Ajukan Nominal Baru</button>
                            </form>
                            <form action=""  id="form-tambah" class="">
                                @csrf
                                <button type="submit" class="bg-[#DD4049] px-4 py-2 rounded-lg cursor-pointer">Tolak Pengajuan</button>
                            </form>
                        </div>
                    `,
                    showCancelButton: false,
                    showCloseButton: false,
                    showConfirmButton: false,

                })
            }
        </script>
        <script>
                document.querySelectorAll('.decline-btn').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const id = this.dataset.id; // ambil ID dari data-id

                        Swal.fire({
                            title: 'Tolak Pengajuan',
                            input: 'textarea',
                            inputPlaceholder: 'Tuliskan alasan penolakan...',
                            showCancelButton: true,
                            confirmButtonText: 'Tolak',
                            cancelButtonText: 'Batal',
                            confirmButtonColor: '#DD4049',
                            preConfirm: (ket_owner) => {
                                if (!ket_owner) {
                                    Swal.showValidationMessage('Alasan wajib diisi');
                                }
                                return ket_owner;
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                fetch(`/pinjamanO/${id}/decline`, {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/json",
                                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                        },
                                        body: JSON.stringify({
                                            status_owner: "decline",
                                            ket_owner: result.value
                                        })
                                    })
                                    .then(res => res.json())
                                    .then(data => {
                                        Swal.fire('Ditolak!', 'Pengajuan berhasil ditolak.', 'success');
                                        location.reload();
                                    })
                                    .catch(err => {
                                        Swal.fire('Error', 'Terjadi kesalahan.', 'error');
                                    });
                            }
                        });
                    });
                });
            </script>
    </div>
@endsection
