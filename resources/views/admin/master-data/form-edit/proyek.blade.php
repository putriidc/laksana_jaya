@extends('admin.layout')
@section('content')
<div class="flex flex-col items-center">
    <h1 class="text-2xl font-bold mb-4 w-full">Edit Proyek</h1>
    <div class="shadow-[0px_0px_15px_rgba(0,0,0,0.25)] w-full p-10 rounded-lg bg-white">
        <form method="POST" action="{{ route('proyek.update', $proyek->id) }}" class="flex flex-col gap-y-4">
            @csrf
            @method('PUT')

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Tanggal Mulai</label>
                <input type="text" name="tgl_mulai" data-flatpickr value="{{ old('tgl_mulai', $proyek->tgl_mulai) }}"
                       class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Tanggal Selesai</label>
                <input type="text" name="tgl_selesai" data-flatpickr value="{{ old('tgl_selesai', $proyek->tgl_selesai) }}"
                       class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>

            <div class="flex items-center">
                <label class="w-[180px] font-medium">No Kontrak</label>
                <input type="text" name="no_kontrak" value="{{ old('no_kontrak', $proyek->no_kontrak) }}"
                       class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Hari Kalender</label>
                <input type="text" name="hari_kalender" value="{{ old('hari_kalender', $proyek->hari_kalender) }}"
                       class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Nama Proyek</label>
                <input type="text" name="nama_proyek" value="{{ old('nama_proyek', $proyek->nama_proyek) }}"
                       class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>

             <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">PIC</label>
                <select name="pic" id="" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 appearance-none cursor-pointer">
                    <option disabled>-Pilih PIC-</option>
                    @foreach ($pic as $item)
                        <option value="{{ $item->akun_header }}"
                            {{ $proyek->akun_header == $item->akun_header ? 'selected' : '' }}>
                            {{ $item->akun_header }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Perusahaan</label>
                <select name="nama_perusahaan" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 appearance-none cursor-pointer">
                    <option disabled>-Pilih Perusahaan-</option>
                    <option value="CV. Bakti Perdana" {{ $proyek->nama_perusahaan == 'CV. Bakti Perdana' ? 'selected' : '' }}>CV. Bakti Perdana</option>
                    <option value="CV. ARN PURNAMA CONSULTAN" {{ $proyek->nama_perusahaan == 'CV. ARN PURNAMA CONSULTAN' ? 'selected' : '' }}>CV. ARN PURNAMA CONSULTAN</option>
                    <option value="CV. ARN GUMILANG" {{ $proyek->nama_perusahaan == 'CV. ARN GUMILANG' ? 'selected' : '' }}>CV. ARN GUMILANG</option>
                    <option value="CV. MITRA UTAMA SEMESTA" {{ $proyek->nama_perusahaan == 'CV. MITRA UTAMA SEMESTA' ? 'selected' : '' }}>CV. MITRA UTAMA SEMESTA</option>
                    <option value="CV. FAJAR MAS JAYA" {{ $proyek->nama_perusahaan == 'CV. FAJAR MAS JAYA' ? 'selected' : '' }}>CV. FAJAR MAS JAYA</option>
                    <option value="CV. LAKSANA JAYA" {{ $proyek->nama_perusahaan == 'CV. LAKSANA JAYA' ? 'selected' : '' }}>CV. LAKSANA JAYA</option>
                </select>
            </div>

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Kategori</label>
                <select name="kategori" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 appearance-none cursor-pointer">
                    <option disabled>-Pilih Kategori-</option>
                    <option value="Kontruksi" {{ $proyek->kategori == 'Kontruksi' ? 'selected' : '' }}>Kontruksi</option>
                    <option value="Konsultan" {{ $proyek->kategori == 'Konsultan' ? 'selected' : '' }}>Konsultan</option>
                    <option value="Barang & Jasa" {{ $proyek->kategori == 'Barang & Jasa' ? 'selected' : '' }}>Barang & Jasa</option>
                </select>
            </div>

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Jenis</label>
                <select name="jenis" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 appearance-none cursor-pointer">
                    <option disabled>-Pilih Jenis-</option>
                    <option value="Pemerintah/Dinas" {{ $proyek->jenis == 'Pemerintah/Dinas' ? 'selected' : '' }}>Pemerintah/Dinas</option>
                    <option value="Swasta" {{ $proyek->jenis == 'Swasta' ? 'selected' : '' }}>Swasta</option>
                    <option value="Pribadi" {{ $proyek->jenis == 'Pribadi' ? 'selected' : '' }}>Pribadi</option>
                </select>
            </div>

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Nilai Kontrak</label>
                <input type="number" name="nilai_kontrak" value="{{ old('nilai_kontrak', $proyek->nilai_kontrak) }}"
                       class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
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
