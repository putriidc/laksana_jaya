@extends('kepala-gudang.layout') @section('content')
    <div>
        <div class="flex flex-col mb-6">
            <section class="mb-5 pb-10 border-b-2 border-[#B6B6B6]">
                <h1 class="font-bold text-2xl mb-4 text-[#C0C0C0]">Form Pengajuan Pinjaman Tukang</h1>
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
                            @php
                                $noacca = 1;
                            @endphp
                            @foreach ($contents as $item)
                                <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                    <td class="py-2">{{ $noacca++ }}</td>
                                    <td class="py-2">{{ $item->tanggal }}</td>
                                    <td class="py-2">{{ $item->kasbon->nama_tukang }}</td>
                                    <td class="py-2">{{ $item->kontrak }}</td>
                                    <td class="py-2">{{ 'RP. ' . number_format($item->bayar, 0, ',', '.') }}</td>
                                    <td class="py-2 flex justify-center items-center">
                                        <form action="{{ route('accspv.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id_tukang_content" value="{{ $item->id }}">
                                            <button class="bg-[#8CE987] px-4 py-2 rounded-lg cursor-pointer">Accept</button>
                                        </form>

                                        <span>&nbsp; &nbsp;</span>

                                        <button class="bg-[#DD4049] px-4 py-2 rounded-lg cursor-pointer text-white"
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
                <a href=""
                    class="px-4 py-2 border-2 border-[#9A9A9A] rounded-lg w-fit flex items-center gap-x-2 mb-4">
                    <span class="text-[#72686B]">Cetak Laporan</span>
                    <img src="{{ asset('assets/printer.png') }}" alt="printer icon">
                </a>
                <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6">
                    <table class="table-auto text-center text-sm w-full">
                        <thead class="border-b-2 border-[#CCCCCC]">
                            <th class="py-2 w-[5%]">No</th>
                            <th class="py-2 w-[10%]">Tgl Pengajuan</th>
                            <th class="py-2 w-[15%]">Nama Tukang</th>
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
                                    <td class="py-2">{{ $noacc++ }}</td>
                                    <td class="py-2">{{ $item->tanggal }}</td>
                                    <td class="py-2">{{ $item->kasbon->nama_tukang }}</td>
                                    <td class="py-2">{{ $item->kontrak }}</td>
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
                const modalDecline = document.getElementById('modal-decline');
                modalDecline.addEventListener('click', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        html: `
                        <form action="" method="POST" id="form-tambah" class="flex gap-x-4 w-full justify-center items-center h-[100px]">
                            @csrf
                            <a href="/create-pinjaman" class="bg-[#8CE987] px-4 py-2 rounded-lg cursor-pointer">Ajukan Nominal Baru</a>
                            <button type="submit" class="bg-[#DD4049] px-4 py-2 rounded-lg cursor-pointer">Tolak Pengajuan</button>
                        </form>
                    `,
                        showCancelButton: false,
                        showCloseButton: false,
                        showConfirmButton: false,

                    })
                });
            </script>
        </div>
    @endsection
