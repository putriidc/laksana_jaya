@extends('admin.layout')
@section('content')
<div class="flex flex-col items-center">
    <h1 class="text-2xl font-bold mb-4 w-full">Proyek</h1>
    <div class="shadow-[0px_0px_15px_rgba(0,0,0,0.25)] w-full p-10 rounded-lg bg-white">
        <form method="POST" action="{{ route('proyek.store') }}" class="flex flex-col gap-y-4" id="myForm">
            @csrf
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Tanggal Mulai</label>
                <input type="text" name="tgl_mulai" id="" data-flatpickr placeholder="Pilih Tanggal Mulai" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Tanggal Selesai</label>
                <input type="text" name="tgl_selesai" id="" data-flatpickr placeholder="Pilih Tanggal Selesai" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">No Kontrak</label>
                <input type="text" name="no_kontrak" id="" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Hari Kalender</label>
                <input type="text" name="hari_kalender" id="" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Nama Proyek</label>
                <input type="text" name="nama_proyek" id="" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">PIC</label>
                <select name="pic" id=""
                    class="bg-[#D9D9D9]/40 px-4 appearance-none py-2 rounded-lg w-full cursor-pointer">
                    <option selected disabled>~Pilih PIC~</option>
                    @foreach ($pic as $item)
                        <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Perusahaan</label>
                <select name="nama_perusahaan" id="" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 appearance-none cursor-pointer">
                    <option selected>-Pilih Perusahaan-</option>
                    <option value="CV. Bakti Perdana">CV. Bakti Perdana</option>
                    <option value="CV. ARN PURNAMA CONSULTAN">CV. ARN PURNAMA CONSULTAN</option>
                    <option value="CV. ARN GUMILANG">CV. ARN GUMILANG</option>
                    <option value="CV. MITRA UTAMA SEMESTA">CV.MITRA UTAMA SEMESTA</option>
                    <option value="CV. FAJAR MAS JAYA">CV. FAJAR MAS JAYA</option>
                    <option value="CV. LAKSANA JAYA">CV. LAKSANA JAYA</option>
                </select>
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Kategori</label>
                <select name="kategori" id="" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 appearance-none cursor-pointer">
                    <option selected>-Pilih Kategori-</option>
                    <option value="Kontruksi">Kontruksi</option>
                    <option value="Konsultan">Konsultan</option>
                    <option value="Barang & Jasa">Barang & Jasa</option>
                </select>
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Jenis</label>
                <select name="jenis" id="" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 appearance-none cursor-pointer">
                    <option selected>-Pilih Jenis-</option>
                    <option value="Pemerintah/Dinas">Pemerintah/Dinas</option>
                    <option value="Swasta">Swasta</option>
                    <option value="Pribadi">Pribadi</option>
                </select>
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Nilai Kontrak</label>
                <input type="text" name="nilai_kontrak" id="" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 rupiah-format">
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
