@extends('owner.layout')
@section('content')
    <div>
        <h1 class="font-bold text-2xl mb-6">Freelance</h1>
        <section>
            <div class="flex items-center pb-4 justify-between">
                <form action="" class="flex items-center gap-x-2" id="myForm">
                    {{-- <select id="select-beast" placeholder="Pilih Nama" autocomplete="off"
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
                    </button> --}}
                    <a target="_blank" href="{{ route('freelance-owner.print') }}"
                        class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer flex items-center gap-x-2">
                        <span class="text-gray-500 font-medium">Cetak Data</span>
                        <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[25px]">
                    </a>
                </form>
                <a href="{{ route('sampingansOwner.create') }}"
                    class="block border-[#9A9A9A] border-2 rounded-lg px-4 py-2 shadow-[0px_0px_10px_rgba(0,0,0,0.1)]">Tambah
                    Data +</a>
            </div>
            <div class="rounded-lg shadow-[1px_1px_10px_rgba(0,0,0,0.1)] pt-4 pb-6">
                <table class="table-fixed text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="w-[5%] py-2">No</th>
                        <th class="w-[10%] py-2">Nama</th>
                        <th class="w-[13%] py-2">Tgl Mulai</th>
                        <th class="w-[13%] py-2">Tgl Selesai</th>
                        <th class="w-[15%] py-2">Salary</th>
                        <th class="w-[5%] py-2">Day</th>
                        <th class="w-[15%] py-2">Total Salary</th>
                        <th class="w-[15%] py-2">Tambahan</th>
                        <th class="w-[15%] py-2">Jumlah</th>
                        <th class="w-[15%] py-2">Bon</th>
                        <th class="w-[15%] py-2">Total</th>
                        <th class="w-[10%] py-2">Action</th>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($sampingans as $item)
                            <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                                @php
                                    $gaji = $item->gaji;
                                    $hari = $item->hari;
                                    $tambahan = $item->tambahan;
                                    $kasbon = $item->kasbon;
                                    $sum = $gaji * $hari;
                                    $jumlah = $sum + $tambahan;
                                    $total = $jumlah - $kasbon;
                                @endphp
                                <td class="py-2">{{ $no++ }}</td>
                                <td class="py-2">{{ $item->nama }}</td>
                                <td class="py-2">{{ $item->tgl_mulai }}</td>
                                <td class="py-2">{{ $item->tgl_selesai }}</td>
                                <td class="py-2">{{ 'RP. ' . number_format($gaji, 0, ',', '.') }}</td>
                                <td class="py-2">{{ $hari }}</td>
                                <td class="py-2">{{ 'RP. ' . number_format($sum, 0, ',', '.') }}</td>
                                <td class="py-2">{{ 'RP. ' . number_format($tambahan, 0, ',', '.') }}</td>
                                <td class="py-2">{{ 'RP. ' . number_format($jumlah, 0, ',', '.') }}</td>
                                <td class="py-2">{{ 'RP. ' . number_format($kasbon, 0, ',', '.') }}</td>
                                <td class="py-2">{{ 'RP. ' . number_format($total, 0, ',', '.') }}</td>
                                <td class="flex justify-center items-center gap-x-2 py-2">
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('sampingansOwner.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                        <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                            class="w-[22px] cursor-pointer">
                                    </a>
                                    <span class="border-black border-l-[1px] h-[22px]"></span>
                                    {{-- Tombol Delete --}}
                                    <form action="{{ route('sampingansOwner.destroy', $item->id) }}" method="POST"
                                        class="h-[22px]">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                            <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                class="w-[22px] cursor-pointer">
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
