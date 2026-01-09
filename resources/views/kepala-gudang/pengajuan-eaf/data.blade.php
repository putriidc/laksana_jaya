@extends('kepala-gudang.layout') @section('content')
    <div>
        <div class="flex flex-col mb-6">
            <section class="mb-5 pb-10 border-b-2 border-[#B6B6B6]">
                <h1 class="font-bold text-2xl mb-4 text-[#C0C0C0]">Form Pengajuan EAF</h1>
                <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6 max-[1100px]:overflow-x-scroll">
                    <table class="table-auto text-center text-sm w-full max-[1100px]:w-[1100px]">
                        <thead class="border-b-2 border-[#CCCCCC]">
                            <th class="py-2 w-[5%]">No</th>
                            <th class="py-2 w-[10%]">Tgl Pengajuan</th>
                            <th class="py-2 w-[15%]">Nama Proyek</th>
                            <th class="py-2 w-[15%]">PIC</th>
                            <th class="py-2 w-[15%]">Sumber Dana</th>
                            <th class="py-2 w-[20%]">Nominal</th>
                            <th class="py-2 w-[15%]">Detail Biaya</th>
                            <th class="py-2 w-[20%]">Action</th>
                        </thead>
                        <tbody>
                            @php
                                $noacc = 1;
                            @endphp
                            @foreach ($eaf_needAcc as $item)
                                <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                    <td class="py-2">{{ $noacc++ }}</td>
                                    <td class="py-2">{{ $item->tanggal }}</td>
                                    <td class="py-2">{{ $item->nama_proyek }}</td>
                                    <td class="py-2">{{ $item->pic }}</td>
                                    <td class="py-2">{{ $item->bank->nama_akun }}</td>
                                    <td class="py-2">{{ 'RP. ' . number_format($item->nominal, 0, ',', '.') }}</td>
                                    <td class="py-2">
                                        <span data-detail="{{ $item->detail_biaya }}" onclick="detailBiaya(this)"
                                            class="hover:underline text-blue-400 cursor-pointer">
                                            Lihat Detail
                                        </span>
                                    </td>
                                    <td class="py-2 flex justify-center items-center">
                                        <form action="{{ route('AccEafSpv.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id_eaf" value="{{ $item->id }}">
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
                <h1 class="font-bold text-2xl mb-4 text-[#C0C0C0]">Form ACC EAF</h1>
                {{-- <a href=""
                    class="px-4 py-2 border-2 border-[#9A9A9A] rounded-lg w-fit flex items-center gap-x-2 mb-4">
                    <span class="text-[#72686B]">Cetak Laporan</span>
                    <img src="{{ asset('assets/printer.png') }}" alt="printer icon">
                </a> --}}
                <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6 max-[1100px]:overflow-x-scroll">
                    <table class="table-auto text-center text-sm w-full max-[1100px]:w-[1100px]">
                        <thead class="border-b-2 border-[#CCCCCC]">
                            <th class="py-2 w-[5%]">No</th>
                            <th class="py-2 w-[10%]">Tgl Pengajuan</th>
                            <th class="py-2 w-[15%]">Nama Proyek</th>
                            <th class="py-2 w-[15%]">PIC</th>
                            <th class="py-2 w-[15%]">Sumber Dana</th>
                            <th class="py-2 w-[10%]">Nominal</th>
                            <th class="py-2 w-[10%]">Ket. Spv</th>
                            <th class="py-2 w-[10%]">Detail Biaya</th>
                            <th class="py-2 w-[15%]">Status</th>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($eaf as $item)
                                <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                    <td class="py-2">{{ $no++ }}</td>
                                    <td class="py-2">{{ $item->tanggal }}</td>
                                    <td class="py-2">{{ $item->nama_proyek }}</td>
                                    <td class="py-2">{{ $item->pic }}</td>
                                    <td class="py-2">{{ $item->bank->nama_akun }}</td>
                                    <td class="py-2">{{ 'RP. ' . number_format($item->nominal, 0, ',', '.') }}</td>
                                    <td class="py-2">{{ $item->ket_spv }}</td>
                                    <td class="py-2">
                                        <span data-detail="{{ $item->detail_biaya }}" onclick="detailBiaya(this)"
                                            class="hover:underline text-blue-400 cursor-pointer">
                                            Lihat Detail
                                        </span>
                                    </td>
                                    <td class="py-2">
                                        <div class="flex gap-x-1 items-center justify-center">
                                        {{-- Status spv --}}
                                        @if ($item->acc_spv === 'accept')
                                            <span class="bg-[#8CE987] px-4 py-2 rounded-lg cursor-pointer">Accept</span>
                                        @elseif ($item->acc_spv === 'decline')
                                            <span class="bg-[#e91111] px-4 py-2 rounded-lg cursor-pointer">Decline</span>
                                        @else
                                            <span class="px-4 py-1 bg-gray-400 text-xs rounded-sm text-white">Pending</span>
                                        @endif
                                    </div>
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
                            title: 'Tolak Pengajuan Eaf',
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
                                fetch(`/Acceaf/${id}/decline`, {
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
            <script>
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
        </div>
    @endsection
