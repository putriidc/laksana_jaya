@extends('admin.layout')
@section('content')
    <div>
        <h1 class="font-bold text-2xl mb-6">Pinjaman Tukang</h1>
        <div class="flex items-center gap-x-4 mb-6 pb-6 border-b-2 border-[#B6B6B6]">
            <a href="{{ route('pinjamanTukangs.create') }}" class="px-4 py-2 border-2 border-[#9A9A9A] rounded-lg">Tambah Data
                +</a>
            <a target="_blank" href="{{ route('pinjamanTukangs.print') }}" class="px-4 py-2 border-2 border-[#9A9A9A] rounded-lg flex items-center gap-x-2">
                <span class="text-[#72686B]">Cetak Semua Data</span>
                <img src="{{ asset('assets/printer.png') }}" alt="printer icon">
            </a>
        </div>
        <div class="flex flex-col mb-8">
            <h1 class="font-bold text-2xl">Pengajuan Pinjaman</h1>
            <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6 mt-4">
                <table class="table-auto text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[10%]">Tgl Pengajuan</th>
                        <th class="py-2 w-[15%]">Tukang</th>
                        <th class="py-2 w-[15%]">Proyek</th>
                        <th class="py-2 w-[15%]">Ket. SPV</th>
                        <th class="py-2 w-[15%]">Ket. Owner</th>
                        <th class="py-2 w-[20%]">Jumlah Pinjaman</th>
                        <th class="py-2 w-[10%]">Status</th>
                    </thead>
                    <tbody>
                        @foreach ($contents as $item)
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">{{ $item->tanggal }}</td>
                                <td class="py-2">{{ $item->kasbon->nama_tukang }}</td>
                                <td class="py-2">{{ $item->kasbon->nama_proyek }}</td>
                                <td class="py-2">{{ $item->ket_spv }}</td>
                                <td class="py-2">{{ $item->ket_owner }}</td>
                                <td class="py-2">{{ 'RP. ' . number_format($item->bayar, 0, ',', '.') }}</td>
                                <td class="py-2 flex justify-center items-center gap-x-2">
                                    {{-- Status SPV --}}
                                    @if ($item->status_spv === 'pending')
                                        <span class="bg-[#999999] px-4 py-2 rounded-lg cursor-pointer text-white/60">Pending
                                            SPV</span>
                                    @elseif ($item->status_spv === 'decline')
                                        <span class="bg-[#DD4049] px-4 py-2 rounded-lg cursor-pointer text-white">Decline
                                            SPV</span>
                                    @elseif ($item->status_spv === 'accept')
                                        <span class="bg-[#8CE987] px-4 py-2 rounded-lg cursor-pointer">Accept SPV</span>
                                    @endif

                                    {{-- Status Owner --}}
                                    @if ($item->status_owner === 'pending')
                                        <span class="bg-[#999999] px-4 py-2 rounded-lg cursor-pointer text-white/60">Pending
                                            Owner</span>
                                    @elseif ($item->status_owner === 'decline')
                                        <span class="bg-[#DD4049] px-4 py-2 rounded-lg cursor-pointer text-white">Decline
                                            Owner</span>
                                    @elseif ($item->status_owner === 'accept')
                                        <span class="bg-[#8CE987] px-4 py-2 rounded-lg cursor-pointer">Accept Owner</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex flex-col">
            <h1 class="font-bold text-2xl">Data Pinjaman</h1>
            <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6 mt-4">
                <table class="table-auto text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[5%] pl-[100px]">No</th>
                        <th class="py-2 w-[15%]">Nama Tukang</th>
                        <th class="py-2 w-[15%]">Proyek</th>
                        <th class="py-2 w-[20%]">Jumlah Kasbon</th>
                        <th class="py-2 w-[10%] pr-[100px]">Action</th>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($pinjamans as $pinjaman)
                            <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2 w-[5%] pl-[100px]">{{ $no++ }}</td>
                                <td class="py-2 w-[15%]">{{ $pinjaman->nama_tukang ?? '-' }}</td>
                                <td class="py-2 w-[15%]">{{ $pinjaman->nama_proyek }}</td>
                                <td class="py-2 w-[20%]">{{ 'RP. ' . number_format($pinjaman->total, 0, ',', '.') }}</td>
                                <td class="flex justify-center items-center gap-x-2 py-2 pr-[150px]">
                                    {{-- Tombol Edit
                                    <a href="{{ route('pinjamanKaryawans.edit', $pinjaman->id) }}"
                                        class="btn btn-sm btn-primary">
                                        <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                            class="w-[20px] cursor-pointer">
                                    </a> --}}

                                    {{-- Tombol Detail --}}
                                    <a href="{{ route('pinjamanTukangs.show', $pinjaman->id) }}"
                                        class="bg-green-500 text-black px-3 py-1 rounded-md text-bold hover:bg-green-600">
                                        Detail
                                    </a>
                                    <span class="border-black border-l-[1px] h-[22px]"></span>

                                    {{-- Tombol Delete --}}
                                    <form action="{{ route('pinjamanTukangs.destroy', $pinjaman->id) }}" method="POST"
                                        class="h-[22px]">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                            <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                class="w-[20px] cursor-pointer">
                                        </button>
                                    </form>
                                    {{-- <span class="border-black border-l-[1px] h-[22px]"></span> --}}

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
