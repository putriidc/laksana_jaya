@extends('admin.layout')
@section('content')
<div class="flex flex-col items-center">
    <h1 class="text-2xl font-bold mb-4 w-full">Edit Pengajuan Pinjaman</h1>
    <div class="shadow-[0px_0px_15px_rgba(0,0,0,0.25)] w-full p-10 rounded-lg bg-white">
        <form method="POST" action="{{ route('pinjamanKaryawans.update', $pinjaman->id) }}" class="flex flex-col gap-y-4">
            @csrf
            @method('PUT')

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Tanggal Pengajuan</label>
                <input type="date" name="tanggal"
                       value="{{ old('tanggal', $pinjaman->tanggal) }}"
                       class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2" readonly>
            </div>

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Nama Karyawan</label>
                <select name="kode_karyawan" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 appearance-none cursor-pointer">
                    <option disabled>Pilih Nama Karyawan</option>
                    @foreach ($karyawans as $karyawan)
                        <option value="{{ $karyawan->kode_karyawan }}"
                            {{ old('kode_karyawan', $pinjaman->kode_karyawan) == $karyawan->kode_karyawan ? 'selected' : '' }}>
                            {{ $karyawan->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex mt-4">
                <div class="w-[180px]"></div>
                <div class="w-full flex gap-x-2">
                    <button type="submit" class="bg-[#FFF494] px-6 py-2 rounded-lg cursor-pointer">Update Data</button>
                    <a href="{{ route('pinjamanKaryawans.index') }}" class="bg-[#FFB7B7] px-6 py-2 rounded-lg cursor-pointer">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
