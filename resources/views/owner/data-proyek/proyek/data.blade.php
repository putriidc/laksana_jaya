@extends('owner.layout')
@section('content')
<div>
    <div>
        <h1 class="text-2xl font-bold mb-5 pb-5 border-b border-gray-400">Data Proyek {{ $kategori }}</h1>
    </div>
    @foreach ($proyeks as $nama_perusahaan => $listProyek)
    <div class="pb-5 border-b border-gray-400 mb-8">
        <h1 class="text-2xl font-bold mb-5 uppercase">{{ $nama_perusahaan }}</h1>
        <form action="" method="post" class="flex justify-between items-center gap-x-1 mb-5">
            <div class="flex items-center gap-x-2">
                <div class="w-[180px] px-1 border-[#9A9A9A] border-2 rounded-lg">
                    <select name="" id="" class="w-full cursor-pointer outline-none py-2">
                        <option selected disabled>Cari Nama Paket</option>
                        <option value="">Cari Nama</option>
                        <option value="">Cari Nama</option>
                    </select>
                </div>
                <button type="submit" class="border-2 border-[#9A9A9A] py-[10px] px-[10px] rounded-lg cursor-pointer">
                    <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" class="w-[20px]">
                </button>
            </div>
            <a href="" class="border-2 border-[#9A9A9A] py-2 px-2 rounded-lg cursor-pointer flex items-center gap-x-2 text-[#726868]">
                <span>Cetak Data</span>
                <img src="{{ asset('assets/printer.png') }}" alt="printer icon">
            </a>
        </form>
        <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6">
            <table class="table-fixed text-center text-sm w-full">
                <thead class="border-b-2 border-[#CCCCCC]">
                    <th class="w-[5%] py-2">No</th>
                    <th class="w-[10%] py-2">Tgl Mulai</th>
                    <th class="w-[10%] py-2">Tgl Selesai</th>
                    <th class="w-[15%] py-2">Nama Proyek</th>
                    <th class="w-[20%] py-2">No Kontrak</th>
                    <th class="w-[15%] py-2">Jenis Pekerjaan</th>
                    <th class="w-[15%] py-2">Nilai Kontrak</th>
                    <th class="w-[10%] py-2">Action</th>
                </thead>
                <tbody>
                    @foreach ($listProyek as $i => $proyek)
                    <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                        <td class="py-2">{{ $i + 1 }}</td>
                        <td class="py-2">{{ $proyek->tgl_mulai }}</td>
                        <td class="py-2">{{ $proyek->tgl_selesai }}</td>
                        <td class="py-2">{{ $proyek->nama_proyek }}</td>
                        <td class="py-2">{{ $proyek->no_kontrak }}</td>
                        <td class="py-2">{{ $proyek->jenis }}</td>
                        <td class="py-2">Rp {{ number_format($proyek->nilai_kontrak, 0, ',', '.') }}</td>
                        <td class="py-2">
                            <div class="flex items-center gap-x-2 justify-center">
                                {{-- Tombol Edit --}}
                                <a href="{{ route('proyekOwner.show', $proyek->id) }}" class="btn btn-sm btn-primary">
                                    <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                        class="w-[22px] cursor-pointer">
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    @endforeach
</div>
@endsection
