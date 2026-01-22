@extends('admin.layout')
@section('content')
<div class="flex flex-col items-center">
    <h1 class="text-2xl font-bold mb-4 w-full">Form Pinjaman</h1>
    <div class="shadow-[0px_0px_15px_rgba(0,0,0,0.25)] w-full p-10 rounded-lg bg-white">
        <form method="POST" action="{{ route('pinjamanContents.store') }}" class="flex flex-col gap-y-4" id="myForm">
            @csrf
            <input type="hidden" name="kode_karyawan" value="{{ $pinjaman->id }}">
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Tgl Pinjaman</label>
                <input value="{{ $today }}" type="date" name="tanggal" id="" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2" readonly>
            </div>
            <div class="flex items-center">
                    <label for="" class="w-[180px] font-medium">Kas / Bank</label>
                    <select name="kode_kas" id=""
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 appearance-none cursor-pointer">
                        <option selected disabled>Pilih Kas / Bank</option>
                        @foreach ($bank as $item)
                            <option value="{{ $item->kode_akun }}">{{ $item->nama_akun }}</option>
                        @endforeach
                    </select>
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Kontrak</label>
                <input type="text" name="kontrak" id="" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2" >
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Jumlah Pinjaman</label>
                <input type="text" name="bayar" id="" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 rupiah-format">
            </div>
            <div class="flex mt-4">
                <div class="w-[180px]"></div>
                <div class="w-full flex gap-x-2">
                    <button type="submit" class="bg-[#FFF494] px-6 py-2 rounded-lg cursor-pointer">Simpan Data</button>
                    <button type="button" onclick="history.back()" class="bg-[#FFB7B7] px-6 py-2 rounded-lg cursor-pointer">Batal</button>
                </div>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/form.js') }}"></script>
</div>
@endsection
