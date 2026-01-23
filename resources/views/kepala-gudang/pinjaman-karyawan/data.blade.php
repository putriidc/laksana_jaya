@extends('kepala-gudang.layout') @section('content')
    <div>
        <div class="flex flex-col mb-6">
            <section class="mb-5 pb-10 border-b-2 border-[#B6B6B6]">
                <h1 class="font-bold text-2xl mb-4 text-[#C0C0C0]">Form Pengajuan Pinjaman Tukang</h1>
                <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6 max-[1100px]:overflow-x-scroll">
                    <table class="table-auto text-center text-sm w-full max-[1100px]:w-[1100px]">
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
                                        <form action="{{ route('accspv.store') }}" method="POST">
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
                <h1 class="font-bold text-2xl mb-4 text-[#C0C0C0]">Data Persetujuan Pinjaman Tukang</h1>
                <a target="_blank" href="{{ route('accspv.print') }}"
                    class="px-4 py-2 border-2 border-[#9A9A9A] rounded-lg w-fit flex items-center gap-x-2 mb-4">
                    <span class="text-[#72686B]">Cetak Laporan</span>
                    <img src="{{ asset('assets/printer.png') }}" alt="printer icon">
                </a>
                <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6 max-[1100px]:overflow-x-scroll">
                    <table class="table-auto text-center text-sm w-full max-[1100px]:w-[1100px]">
                        <thead class="border-b-2 border-[#CCCCCC]">
                            <th class="py-2 w-[10%]">Tgl Pengajuan</th>
                            <th class="py-2 w-[15%]">Nama Tukang</th>
                            <th class="py-2 w-[15%]">Proyek</th>
                            <th class="py-2 w-[15%]">Kontrak</th>
                            <th class="py-2 w-[15%]">Status</th>
                            <th class="py-2 w-[20%]">Jumlah Pinjaman</th>
                            <th class="py-2 w-[10%]">Action</th>
                        </thead>
                        <tbody>
                            @php
                                $noacc = 1;
                            @endphp
                            @foreach ($pinjamans as $item)
                                <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                    <td class="py-2">{{ $item->tanggal }}</td>
                                    <td class="py-2">{{ $item->kasbon->nama_tukang }}</td>
                                    <td class="py-2">{{ $item->kasbon->nama_proyek }}</td>
                                    <td class="py-2">{{ $item->kontrak }}</td>
                                    <td class="py-2">{{ $item->ket_spv }}</td>
                                    <td class="py-2">{{ 'RP. ' . number_format($item->bayar, 0, ',', '.') }}</td>
                                    <td class="py-2 flex justify-center items-center gap-x-2">
                                        {{-- Status SPV --}}
                                        @if ($item->status_spv === 'pending')
                                            <span
                                                class="bg-[#999999] px-4 py-2 rounded-lg cursor-pointer text-white/60">Pending
                                            </span>
                                        @elseif ($item->status_spv === 'decline')
                                            <span
                                                class="bg-[#DD4049] px-4 py-2 rounded-lg cursor-pointer text-white">Decline
                                            </span>
                                        @elseif ($item->status_spv === 'accept')
                                            <span class="bg-[#8CE987] px-4 py-2 rounded-lg cursor-pointer">Accept </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
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
                            preConfirm: (ket_spv) => {
                                if (!ket_spv) {
                                    Swal.showValidationMessage('Alasan wajib diisi');
                                }
                                return ket_spv;
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                fetch(`/pinjaman/${id}/decline`, {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/json",
                                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                        },
                                        body: JSON.stringify({
                                            status_spv: "decline",
                                            ket_spv: result.value
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
