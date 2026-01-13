@extends('owner.layout')
@section('content')
    <div>
        <section>
            <div class="flex items-center pb-4 justify-between">
                <h1 class="font-bold text-2xl">Data Hutang Vendor</h1>
                <div class="flex items-center gap-x-2">
                    <a target="_blank" href=""
                        class="flex items-center gap-x-2 border-[#9A9A9A] border-2 rounded-lg px-4 py-2"><span
                            class="text-gray-600">Cetak Semua Data</span> <img src="{{ asset('assets/printer.png') }}"
                            alt="" class="w-[25px]"></a>
                    <a href="{{ route('saldo.create') }}" class="block border-[#45D03E] text-[#45D03E] border-2 rounded-lg px-4 py-2 cursor-pointer">
                        Tambah Data +
                    </a>
                </div>
            </div>
            <div class="rounded-lg shadow-[1px_1px_10px_rgba(0,0,0,0.1)] pt-4 pb-6">
                <table class="table-fixed text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="w-[5%] py-2">No</th>
                        <th class="w-[15%] py-2">Kode Akun</th>
                        <th class="w-[15%] py-2">Nama Akun</th>
                        <th class="w-[15%] py-2">Post Saldo</th>
                        <th class="w-[15%] py-2">Post Laporan</th>
                        <th class="w-[20%] py-2">Saldo</th>
                        {{-- <th class="w-[10%] py-2">Action</th> --}}
                    </thead>

                    <tbody>
                        @foreach ($asset as $index => $item)
                            <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">{{ $index + 1 }}</td>
                                <td class="py-2">{{ $item->kode_akun ?? '-' }}</td>
                                <td class="py-2">{{ $item->nama_akun ?? '-' }}</td>
                                <td class="py-2">{{ $item->post_saldo ?? '-' }}</td>
                                <td class="py-2">{{ $item->post_laporan ?? '-' }}</td>
                                <td class="py-2">Rp {{ number_format($item->saldo, 0, ',', '.') }}</td>
                                {{-- <td class="flex justify-center items-center gap-x-2 py-2">

                                    <button type="button" onclick='editData(@json($item))'>
                                        <img src="{{ asset('assets/edit-icon.png') }}" alt="edit icon"
                                            class="w-[22px] cursor-pointer">
                                    </button>
                                    <span class="border-black border-l-[1px] h-[22px]"></span>
                                    @if (!$item->is_generate && $item->tgl_bayar === null)
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        <form action="{{ route('hutang_vendor.destroy', $item->id) }}" method="POST"
                                            class="h-[22px]">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                    class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                    @endif
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
