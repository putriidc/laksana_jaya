@extends('admin.layout')
@section('content')
<div class="flex flex-col items-center">
    <h1 class="text-2xl font-bold mb-4 w-full">Edit Piutang & Hutang Usaha</h1>
    <div class="shadow-[0px_0px_15px_rgba(0,0,0,0.25)] w-full p-10 rounded-lg bg-white">
        <form method="POST" action="{{ route('piutangHutang.update', $piutangHutang->id) }}" class="flex flex-col gap-y-4">
            @csrf
            @method('PUT')

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Kode Akun</label>
                <input type="text" name="kode_akun" value="{{ old('kode_akun', $piutangHutang->kode_akun) }}" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Nama Akun</label>
                <input type="text" name="nama_akun" value="{{ old('nama_akun', $piutangHutang->nama_akun) }}" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Akun Header</label>
                <select name="akun_header" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 appearance-none cursor-pointer">
                    <option disabled>-Pilih Akun Header-</option>
                    <option value="Piutang" {{ $piutangHutang->akun_header == 'Piutang' ? 'selected' : '' }}>Piutang</option>
                    <option value="Hutang" {{ $piutangHutang->akun_header == 'Hutang' ? 'selected' : '' }}>Hutang</option>
                    <option value="PIC" {{ $piutangHutang->akun_header == 'PIC' ? 'selected' : '' }}>PIC</option>
                </select>
            </div>

            <div class="flex mt-4">
                <div class="w-[180px]"></div>
                <div class="w-full flex gap-x-2">
                    <button type="submit" class="bg-[#FFF494] px-6 py-2 rounded-lg cursor-pointer">Update Data</button>
                    <a href="{{ route('master-data.index') }}" class="bg-[#FFB7B7] px-6 py-2 rounded-lg cursor-pointer">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
