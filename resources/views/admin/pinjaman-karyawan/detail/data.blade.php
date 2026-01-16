@extends('admin.layout')
@section('content')
    <div>
        <div class="flex flex-col mb-6 border-b border-black pb-5">
            <h1 class="font-bold text-2xl mb-4">Pinjaman Karyawan</h1>
            <div class="flex items-center gap-x-2">
                <p>Nama Karyawan</p>
                <div class="border-[#9A9A9A] border-2 rounded-lg py-[8px] px-[25px] font-bold">
                    {{ $pinjaman->karyawan->nama }}
                </div>
                <a href="{{ route('pinjaman-karyawan.print', $pinjaman->id) }}"
                    class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer" target="_blank">
                    <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                </a>
            </div>
        </div>
        <section class="mb-10">
            <div class="flex items-center pb-4 w-full justify-between">
                <h1 class="font-bold text-2xl">Pinjaman Karyawan</h1>
                <div class="flex items-center gap-x-4">
                    <a href="{{ route('pinjamanContents.bayar', $pinjaman->id) }}"
                        class="flex items-center gap-x-3 border-[#9A9A9A] border-2 rounded-xl py-[10px] px-[15px] bg-white cursor-pointer">
                        <span>Bayar Pinjaman</span>
                        <img src="{{ asset('assets/card-receive.png') }}" alt="bayar pinjaman icon" class="w-[20px]">
                    </a>
                    <a href="{{ route('pinjamanContents.pinjam', $pinjaman->id) }}"
                        class="flex items-center gap-x-3 border-[#9A9A9A] border-2 rounded-xl py-[10px] px-[15px] bg-white cursor-pointer">
                        <span>Pinjam Uang</span>
                        <img src="{{ asset('assets/card-receive.png') }}" alt="bayar pinjaman icon" class="w-[20px]">
                    </a>
                    <div class="flex items-center gap-x-2">
                        <h1 class="font-bold">STATUS</h1>
                        @if ($pinjaman->total_pinjam > 4500000)
                            <div class="bg-[#8CE987] w-[100px] h-[20px]"></div>
                        @else
                            <div class="bg-[#DD4049] w-[100px] h-[20px]"></div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6">
                <table class="table-auto text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
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
                                            {{ 'No ' }}
                                        @else
                                            <a href="{{ route('pinjamanContents.editBayar', $item->id) }}" class="">
                                                <img src="{{ asset('assets/more-circle.png') }}" alt="more circle icon"
                                                    class="w-[20px] cursor-pointer">
                                            </a>
                                        @endif
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        @if ($item->jenis === 'pinjam')
                                            {{ 'Edit' }}
                                        @else
                                            <form action="{{ route('pinjamanContents.destroyBayar', $item->id) }}"
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
        </section>
        <section>
            <div class="flex items-center pb-4 w-full justify-between">
                <h1 class="font-bold text-2xl">Kasbon Karyawan</h1>
                <div class="flex items-center gap-x-4">
                    <a href="{{ route('kasbonContents.bayar', $pinjaman->id) }}"
                        class="flex items-center gap-x-3 border-[#9A9A9A] border-2 rounded-xl py-[10px] px-[15px] bg-white cursor-pointer">
                        <span>Bayar Kasbon</span>
                        <img src="{{ asset('assets/card-receive.png') }}" alt="bayar pinjaman icon" class="w-[20px]">
                    </a>
                    <a href="{{ route('kasbonContents.pinjam', $pinjaman->id) }}"
                        class="flex items-center gap-x-3 border-[#9A9A9A] border-2 rounded-xl py-[10px] px-[15px] bg-white cursor-pointer">
                        <span>Kasbon</span>
                        <img src="{{ asset('assets/card-receive.png') }}" alt="bayar pinjaman icon" class="w-[20px]">
                    </a>
                    <div class="flex items-center gap-x-2">
                        <h1 class="font-bold">STATUS</h1>
                        @if ($pinjaman->total_kasbon > 4500000)
                            <div class="bg-[#8CE987] w-[100px] h-[20px]"></div>
                        @else
                            <div class="bg-[#DD4049] w-[100px] h-[20px]"></div>
                        @endif
                    </div>
                </div>
            </div>
    </div>
    <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6">
        <table class="table-auto text-center text-sm w-full">
            <thead class="border-b-2 border-[#CCCCCC]">
                <th class="py-2 w-[15%]">Kontrak</th>
                <th class="py-2 w-[10%]">Tgl Pinjaman</th>
                <th class="py-2 w-[10%]">Tgl Cicilan</th>
                <th class="py-2 w-[15%]">Jumlah Pinjaman</th>
                <th class="py-2 w-[15%]">Cicilan Pinjaman</th>
                <th class="py-2 w-[15%]">Sisa Pinjaman</th>
                <th class="py-2 w-[10%]">Action</th>
            </thead>
            <tbody>
                @foreach ($kasbonContents as $item)
                    <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">

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
                                    <a href="{{ route('kasbonContents.editBayar', $item->id) }}" class="">
                                        <img src="{{ asset('assets/more-circle.png') }}" alt="more circle icon"
                                            class="w-[20px] cursor-pointer">
                                    </a>
                                @endif

                                <span class="border-black border-l-[1px] h-[22px]"></span>
                                @if ($item->jenis === 'pinjam')
                                    {{ '-' }}
                                @else
                                    <form action="{{ route('kasbonContents.destroyBayar', $item->id) }}" method="POST"
                                        class="h-[22px]">
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
    </section>
    </div>
@endsection
