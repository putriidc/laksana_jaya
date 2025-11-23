@extends('admin.layout')
@section('content')
    <div class="flex flex-col items-center">
        <h1 class="text-2xl font-bold mb-4 w-full">Form Input Jurnal umum</h1>
        <div class="shadow-[0px_0px_15px_rgba(0,0,0,0.25)] w-full p-10 rounded-lg bg-white">
            <form method="POST" action="{{ route('jurnalUmums.store') }}" class="flex flex-col gap-y-4">
                @csrf
                <div class="flex items-center">
                    <label class="w-[180px] font-medium">Tanggal</label>
                    <input readonly type="date" id="tanggal" name="tanggal"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                </div>
                <div class="flex items-center">
                    <label for="" class="w-[180px] font-medium">Keterangan</label>
                    <input type="text" name="keterangan" id=""
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                </div>
                <div class="flex items-center">
                    <label for="" class="w-[180px] font-medium">Nama Perkiraan</label>
                    <select name="nama_perkiraan" id="nama-perkiraan"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 appearance-none cursor-pointer">
                        <option selected disabled>-Pilih Nama Perkiraan-</option>
                        @foreach ($assets as $asset)
                            <option value="{{ $asset->nama_akun }}" data-kode="{{ $asset->kode_akun }}">
                                {{ $asset->nama_akun }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center">
                    <label for="" class="w-[180px] font-medium">Kode Perkiraan</label>
                    <input readonly type="text" name="kode_perkiraan" id="kode-perkiraan"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                </div>
                <div class="flex items-center">
                    <label for="" class="w-[180px] font-medium">Nama Proyek</label>
                    <select name="nama_proyek" id="nama-proyek"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 appearance-none cursor-pointer">
                        <option selected disabled>-Pilih Nama Proyek-</option>
                        @foreach ($proyeks as $proyek)
                            <option value="{{ $proyek->nama_proyek }}" data-kode="{{ $proyek->kode_akun }}">
                                {{ $proyek->nama_proyek }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center">
                    <label for="" class="w-[180px] font-medium">Kode Proyek</label>
                    <input readonly type="text" name="kode_proyek" id="kode-proyek"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                </div>
                <div class="flex items-center">
                    <label for="" class="w-[180px] font-medium">Debit</label>
                    <input type="number" name="debit" id=""
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                </div>
                <div class="flex items-center">
                    <label for="" class="w-[180px] font-medium">Kredit</label>
                    <input type="number" name="kredit" id=""
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                </div>
                <div class="flex mt-4">
                    <div class="w-[180px]"></div>
                    <div class="w-full flex gap-x-2">
                        <button type="submit" class="bg-[#FFF494] px-6 py-2 rounded-lg cursor-pointer">Simpan Data</button>
                        <button class="bg-[#FFB7B7] px-6 py-2 rounded-lg cursor-pointer">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const now = new Date();
            const yyyy = now.getFullYear();
            const mm = String(now.getMonth() + 1).padStart(2, '0');
            const dd = String(now.getDate()).padStart(2, '0');
            const today = `${yyyy}-${mm}-${dd}`;
            document.getElementById('tanggal').value = today;
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const namaPerkiraan = document.getElementById('nama-perkiraan');
            const kodePerkiraan = document.getElementById('kode-perkiraan');

            namaPerkiraan.addEventListener('change', function() {
                const selectedOption = namaPerkiraan.options[namaPerkiraan.selectedIndex];
                const kode = selectedOption.getAttribute('data-kode');
                kodePerkiraan.value = kode || '';
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
