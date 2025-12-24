@extends('admin.layout')
@section('content')
    <div>
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
        <h1 class="font-bold text-2xl mb-6">Pinjaman Tukang</h1>
        <div class="flex items-center gap-x-2 mb-6 pb-6 border-b-2 border-[#B6B6B6]">
            <div class="flex items-center gap-x-2">
                <span class="text-[#72686B]">Nama Tukang</span>
                <div class="border-[#9A9A9A] border-2 px-6 py-2 rounded-lg font-bold">
                    {{ $pinjaman->nama_tukang }}
                </div>
            </div>
            <a target="_blank" href="{{ route("tukangContents.print", $pinjaman->id) }}" class="px-2 py-2 border-2 border-[#9A9A9A] rounded-lg flex items-center gap-x-2">
                <img src="{{ asset('assets/printer.png') }}" alt="printer icon">
            </a>
        </div>
        <div class="flex flex-col mb-8">
            <div class="flex justify-between items-center">
                <h1 class="font-bold text-2xl">Pengajuan Pinjaman</h1>
                <div class="flex items-center gap-x-2">
                    <a href="{{ route('tukangContents.pinjam', $pinjaman->id) }}"
                        class="border-2 border-[#9A9A9A] px-4 py-2 flex items-center gap-x-4 rounded-lg">
                        <span>Tambah Pinjaman</span>
                        <img src="{{ asset('assets/card-receive.png') }}" alt="card receive icon" class="w-[20px] h-[20px]">
                    </a>
                    <a href="{{ route('tukangContents.bayar', $pinjaman->id) }}"
                        class="border-2 border-[#9A9A9A] px-4 py-2 flex items-center gap-x-4 rounded-lg">
                        <span>Bayar Pinjaman</span>
                        <img src="{{ asset('assets/card-receive.png') }}" alt="card receive icon" class="w-[20px] h-[20px]">
                    </a>
                </div>
            </div>
            <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6 mt-4">
                <table class="table-auto text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[5%]">No</th>
                        <th class="py-2 w-[15%]">Kontrak</th>
                        <th class="py-2 w-[10%]">Tgl Pinjaman</th>
                        <th class="py-2 w-[10%]">Tgl Cicilan</th>
                        <th class="py-2 w-[15%]">Jumlah Pinjaman</th>
                        <th class="py-2 w-[15%]">Cicilan Pinjaman</th>
                        <th class="py-2 w-[15%]">Sisa Pinjaman</th>
                        <th class="py-2 w-[10%]">Action</th>
                    </thead>
                    <tbody>
                        @foreach ($pinjamanContents as $item)
                            <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">
                                    {{-- @if ($item->menunggu)
                                        <span class="text-blue-600 font-semibold">Menunggu</span>
                                    @elseif($item->setuju)
                                        <span class="text-green-600 font-semibold">Disetujui</span>
                                    @elseif($item->tolak)
                                        <span class="text-red-600 font-semibold">Ditolak</span>
                                    @else
                                        <span class="text-gray-600">-</span>
                                    @endif --}}
                                    @php
                                        $no = 1;
                                    @endphp
                                    {{ $no++ }}
                                </td>
                                <td class="py-2">{{ $item->kontrak }}</td>
                                <td class="py-2">
                                    @if ($item->jenis === 'pinjam')
                                        {{ $item->tanggal }}
                                    @else
                                        {{ '-' }}
                                    @endif
                                </td>
                                <td class="py-2">
                                    @if ($item->jenis === 'cicil')
                                        {{ $item->tanggal }}
                                    @else
                                        {{ '-' }}
                                    @endif
                                </td>
                                <td class="py-2">
                                    @if ($item->jenis === 'pinjam')
                                        {{ 'RP. ' . number_format($item->bayar, 0, ',', '.') }}
                                    @else
                                        {{ 'RP. 0' }}
                                    @endif
                                </td>
                                <td class="py-2">
                                    @if ($item->jenis === 'cicil')
                                        {{ 'RP. ' . number_format($item->bayar, 0, ',', '.') }}
                                    @else
                                        {{ 'RP. 0' }}
                                    @endif
                                </td>
                                <td class="py-2">{{ 'RP. ' . number_format($item->sisa, 0, ',', '.') }}</td>

                                <td class="flex justify-center items-center gap-x-2 py-2">
                                    @if ($item->tanggal == $today)
                                        @if ($item->jenis === 'pinjam')
                                            {{ '-' }}
                                        @else
                                            <a href="{{ route('tukangContents.editBayar', $item->id) }}" class="">
                                                <img src="{{ asset('assets/more-circle.png') }}" alt="more circle icon"
                                                    class="w-[20px] cursor-pointer">
                                            </a>
                                        @endif

                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        @if ($item->jenis === 'pinjam')
                                            {{ '-' }}
                                        @else
                                            <form action="{{ route('tukangContents.destroyBayar', $item->id) }}"
                                                method="POST" class="h-[22px]">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                    <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                        class="w-[22px] cursor-pointer">
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        <span class="text-gray-600 font-bold">Lewat <br> Tanggal</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
