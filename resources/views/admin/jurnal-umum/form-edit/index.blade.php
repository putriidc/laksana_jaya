@extends('admin.layout')
@section('content')
<div class="flex flex-col items-center">
    <h1 class="text-2xl font-bold mb-4 w-full">Edit Jurnal Umum</h1>
    <div class="shadow-[0px_0px_15px_rgba(0,0,0,0.25)] w-full p-10 rounded-lg bg-white">
        <form method="POST" action="{{ route('jurnalUmums.update', $jurnalUmum->id) }}" class="flex flex-col gap-y-4">
            @csrf
            @method('PUT')

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal"
                       value="{{ old('tanggal', $jurnalUmum->tanggal) }}"
                       class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Keterangan</label>
                <input type="text" name="keterangan"
                       value="{{ old('keterangan', $jurnalUmum->keterangan) }}"
                       class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Nama Perkiraan</label>
                <select name="nama_perkiraan" id="nama-perkiraan"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 appearance-none cursor-pointer">
                    <option disabled>-Pilih Nama Perkiraan-</option>
                    @foreach ($assets as $asset)
                        <option value="{{ $asset->nama_akun }}"
                                data-kode="{{ $asset->kode_akun }}"
                                {{ $jurnalUmum->nama_perkiraan == $asset->nama_akun ? 'selected' : '' }}>
                            {{ $asset->nama_akun }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Kode Perkiraan</label>
                <input readonly type="text" name="kode_perkiraan" id="kode-perkiraan"
                       value="{{ old('kode_perkiraan', $jurnalUmum->kode_perkiraan) }}"
                       class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Nama Proyek</label>
                <select name="nama_proyek" id="nama-proyek"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 appearance-none cursor-pointer">
                    <option disabled>-Pilih Nama Proyek-</option>
                    @foreach ($proyeks as $proyek)
                        <option value="{{ $proyek->nama_proyek }}"
                                data-kode="{{ $proyek->kode_akun }}"
                                {{ $jurnalUmum->nama_proyek == $proyek->nama_proyek ? 'selected' : '' }}>
                            {{ $proyek->nama_proyek }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Kode Proyek</label>
                <input readonly type="text" name="kode_proyek" id="kode-proyek"
                       value="{{ old('kode_proyek', $jurnalUmum->kode_proyek) }}"
                       class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Debit</label>
                <input type="text" name="debit"
                       value="{{ old('debit', $jurnalUmum->debit) }}"
                       class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Kredit</label>
                <input type="text" name="kredit"
                       value="{{ old('kredit', $jurnalUmum->kredit) }}"
                       class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>

            <div class="flex mt-4">
                <div class="w-[180px]"></div>
                <div class="w-full flex gap-x-2">
                    <button type="submit" class="bg-[#FFF494] px-6 py-2 rounded-lg cursor-pointer">Update Data</button>
                    <a href="{{ route('jurnalUmums.index') }}" class="bg-[#FFB7B7] px-6 py-2 rounded-lg cursor-pointer">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const namaPerkiraan = document.getElementById('nama-perkiraan');
        const kodePerkiraan = document.getElementById('kode-perkiraan');
        namaPerkiraan.addEventListener('change', function() {
            const selectedOption = namaPerkiraan.options[namaPerkiraan.selectedIndex];
            const kode = selectedOption.getAttribute('data-kode');
            kodePerkiraan.value = kode || '';
        });

        const namaProyek = document.getElementById('nama-proyek');
        const kodeProyek = document.getElementById('kode-proyek');
        namaProyek.addEventListener('change', function() {
            const selectedOption = namaProyek.options[namaProyek.selectedIndex];
            const kode = selectedOption.getAttribute('data-kode');
            kodeProyek.value = kode || '';
        });
    });
</script>
@endsection
