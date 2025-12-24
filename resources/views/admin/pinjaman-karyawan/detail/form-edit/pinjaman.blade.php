@extends('admin.layout')
@section('content')
<div class="flex flex-col items-center">
    <h1 class="text-2xl font-bold mb-4 w-full">Edit Pinjaman</h1>
    <div class="shadow-[0px_0px_15px_rgba(0,0,0,0.25)] w-full p-10 rounded-lg bg-white">
        <form method="POST" action="{{ route('pinjamanContents.update', $content->id) }}" class="flex flex-col gap-y-4" id="myForm">
            @csrf
            @method('PUT')

            <input type="hidden" name="kode_karyawan" value="{{ $content->kode_karyawan }}">

            <div class="flex items-center">
                <label for="tanggal" class="w-[180px] font-medium">Tgl Pinjaman</label>
                <input type="date" name="tanggal" id="tanggal"
                       value="{{ $content->tanggal }}"
                       class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>

            <div class="flex items-center">
                <label for="kontrak" class="w-[180px] font-medium">Kontrak</label>
                <input type="text" name="kontrak" id="kontrak"
                       value="{{ $content->kontrak }}"
                       class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>

            <div class="flex items-center">
                <label for="bayar" class="w-[180px] font-medium">Jumlah Pinjaman</label>
                <input type="text" name="bayar" id="bayar"
                       value="{{ $content->bayar }}"
                       class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 rupiah-format">
            </div>

            <div class="flex mt-4">
                <div class="w-[180px]"></div>
                <div class="w-full flex gap-x-2">
                    <button type="submit" class="bg-[#FFF494] px-6 py-2 rounded-lg cursor-pointer">Update Data</button>
                    <a href="{{ route('pinjamanKaryawans.show', $content->karyawanPinjaman->id) }}"
                       class="bg-[#FFB7B7] px-6 py-2 rounded-lg cursor-pointer text-center">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/form.js') }}"></script>
</div>
@endsection
