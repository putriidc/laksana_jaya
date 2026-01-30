@extends('owner.layout')
@section('content')
<div class="flex flex-col items-center">
    <h1 class="text-2xl font-bold mb-4 w-full">Edit Data Karyawan</h1>
    <div class="shadow-[0px_0px_15px_rgba(0,0,0,0.25)] w-full p-10 rounded-lg bg-white">
        <form method="POST" action="{{ route('karyawanOwner.update', $karyawan->id) }}" class="flex flex-col gap-y-4">
            @csrf
            @method('PUT')



            <div class="flex items-center">
                <label class="w-[180px] font-medium">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $karyawan->nama) }}"
                       class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>



            <div class="flex items-center">
                <label class="w-[180px] font-medium">Alamat</label>
                <input type="text" name="alamat" value="{{ old('alamat', $karyawan->alamat) }}"
                       class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>

            <div class="flex items-center">
                <label class="w-[180px] font-medium">No Hp</label>
                <input type="text" name="no_hp" value="{{ old('no_hp', $karyawan->no_hp) }}"
                       class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Email</label>
                <input type="text" name="email" value="{{ old('email', $karyawan->email) }}"
                       class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>
            <div class="flex items-center">
                    <label for="pekerja" class="w-[180px] font-medium">Pekerja</label>
                    <select name="pekerja" id="pekerja" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                        <option disabled value="">-Pilih Pekerja-</option>
                        <option value="Pekerja Tetap" {{ $karyawan->pekerja === 'Pekerja Tetap' ? 'selected' : '' }}>Pekerja
                            Tetap</option>
                        <option value="Pekerja Lepas" {{ $karyawan->pekerja === 'Pekerja Lepas' ? 'selected' : '' }}>Pekerja
                            Lepas</option>
                        <option value="Pekerja Kontrak" {{ $karyawan->pekerja === 'Pekerja Kontrak' ? 'selected' : '' }}>
                            Pekerja Kontrak</option>
                    </select>
                </div>
                <div class="flex items-center mt-2">
                    <label for="jabatan" class="w-[180px] font-medium">Jabatan</label>
                    <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan', $karyawan->jabatan) }}"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                </div>

            <div class="flex mt-4">
                <div class="w-[180px]"></div>
                <div class="w-full flex gap-x-2">
                    <button type="submit" class="bg-[#FFF494] px-6 py-2 rounded-lg cursor-pointer">Update Data</button>
                    <a href="{{ route('master-data-owner.index') }}" class="bg-[#FFB7B7] px-6 py-2 rounded-lg cursor-pointer">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
