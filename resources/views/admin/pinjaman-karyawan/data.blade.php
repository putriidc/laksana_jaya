@extends('admin.layout')
@section('content')
    <div>
        <div class="flex flex-col mb-8">
            <h1 class="font-bold text-2xl">Pengajuan Pinjaman / Kasbon</h1>
            <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6 mt-4">
                <table class="table-auto text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[10%]">Tgl Pengajuan</th>
                        <th class="py-2 w-[15%]">Karyawan</th>
                        <th class="py-2 w-[15%]">Kontrak</th>
                        <th class="py-2 w-[15%]">Ket Owner</th>
                        <th class="py-2 w-[20%]">Jumlah Pinjaman</th>
                        <th class="py-2 w-[10%]">Status</th>
                    </thead>
                    <tbody>
                        <tr class="bg-gray-200">
                                <td colspan="6" class="py-2 font-semibold text-left px-4">Pinjaman Karyawan</td>
                            </tr>
                        @foreach ($pinjams as $item)
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">{{ $item->tanggal }}</td>
                                <td class="py-2">{{ $item->karyawanPinjaman->karyawan->nama }}</td>
                                <td class="py-2">{{ $item->kontrak }}</td>
                                <td class="py-2">{{ $item->ket_owner }}</td>
                                <td class="py-2">{{ 'RP. ' . number_format($item->bayar, 0, ',', '.') }}</td>
                                <td class="py-2 flex justify-center items-center gap-x-2">
                                    {{-- Status SPV --}}
                                    @if ($item->menunggu == true)
                                        <span class="bg-[#999999] px-4 py-2 rounded-lg cursor-pointer text-white/60">Pending
                                        </span>
                                    @elseif ($item->tolak == true)
                                        <span class="bg-[#DD4049] px-4 py-2 rounded-lg cursor-pointer text-white">Decline
                                        </span>
                                    @elseif ($item->setuju == true)
                                        <span class="bg-[#8CE987] px-4 py-2 rounded-lg cursor-pointer">Accept</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        <tr class="bg-gray-200">
                                <td colspan="6" class="py-2 font-semibold text-left px-4">Kasbon Karyawan</td>
                            </tr>
                        @foreach ($kasbons as $item)
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">{{ $item->tanggal }}</td>
                                <td class="py-2">{{ $item->karyawanKasbon->karyawan->nama }}</td>
                                <td class="py-2">{{ $item->kontrak }}</td>
                                <td class="py-2">{{ $item->ket_owner }}</td>
                                <td class="py-2">{{ 'RP. ' . number_format($item->bayar, 0, ',', '.') }}</td>
                                <td class="py-2 flex justify-center items-center gap-x-2">
                                    {{-- Status --}}
                                    @if ($item->menunggu == true)
                                        <span class="bg-[#999999] px-4 py-2 rounded-lg cursor-pointer text-white/60">Pending
                                        </span>
                                    @elseif ($item->tolak == true)
                                        <span class="bg-[#DD4049] px-4 py-2 rounded-lg cursor-pointer text-white">Decline
                                        </span>
                                    @elseif ($item->setuju == true)
                                        <span class="bg-[#8CE987] px-4 py-2 rounded-lg cursor-pointer">Accept</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <h1 class="font-bold text-2xl mb-6">Pinjaman Karyawan</h1>
        <section>
            <div class="flex items-center pb-4 w-full justify-between">
                {{-- <form action="" class="flex items-center gap-x-2">
                    <select id="select-beast" placeholder="Pilih Nama" autocomplete="off"
                        class="w-[200px] appearance-none border-[#9A9A9A] border-2 outline-none rounded-lg py-[8px] px-[10px] bg-white cursor-pointer">
                        <option selected>Pilih Nama</option>
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
                </form> --}}
                <div class="flex items-center gap-x-2">
                    <a href="{{ route('pinjamanKaryawans.create') }}"><button
                            class="cursor-pointer px-4 py-2 border-[#9A9A9A] border-2 rounded-lg">Tambah Data +</button></a>
                    <a href=""
                        class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                        <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                    </a>
                </div>
            </div>
            <div class="rounded-lg shadow-[1px_1px_10px_rgba(0,0,0,0.1)] pt-4 pb-6">
                <table class="table-auto text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 pl-[150px]">No</th>
                        <th class="py-2">Nama Karyawan</th>
                        <th class="py-2">Sisa Pinjaman</th>
                        <th class="py-2">Sisa Kasbon</th>
                        <th class="py-2 pr-[150px]">Action</th>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($pinjamans as $pinjaman)
                            <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2 pl-[150px]">{{ $no++ }}</td>
                                <td class="py-2">{{ optional($pinjaman->karyawan)->nama ?? '-' }}</td>
                                <td class="py-2">{{ 'RP. ' . number_format($pinjaman->total_pinjam, 0, ',', '.') }}</td>
                                <td class="py-2">{{ 'RP. ' . number_format($pinjaman->total_kasbon, 0, ',', '.') }}</td>
                                <td class="flex justify-center items-center gap-x-2 py-2 pr-[150px]">
                                    {{-- Tombol Edit --}}
                                    {{-- <a href="{{ route('pinjamanKaryawans.edit', $pinjaman->id) }}"
                                        class="btn btn-sm btn-primary">
                                        <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                            class="w-[20px] cursor-pointer">
                                    </a> --}}

                                    {{-- Tombol Detail --}}
                                    <a href="{{ route('pinjamanKaryawans.show', $pinjaman->id) }}"
                                        class="bg-green-500 text-black px-3 py-1 rounded-md text-bold hover:bg-green-600">
                                        Detail
                                    </a>
                                    <span class="border-black border-l-[1px] h-[22px]"></span>

                                    {{-- Tombol Delete --}}
                                    <form action="{{ route('pinjamanKaryawans.destroy', $pinjaman->id) }}" method="POST"
                                        class="h-[22px]">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                            <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                class="w-[20px] cursor-pointer">
                                        </button>
                                    </form>


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
