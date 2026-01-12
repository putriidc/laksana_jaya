@extends('kepala-gudang.layout') @section('content')
    <div class="flex flex-col items-center">
        <h1 class="text-2xl font-bold mb-6 w-full">Input Data Alat</h1>
        <div class="shadow-[0px_0px_15px_rgba(0,0,0,0.25)] w-full p-10 rounded-lg bg-white">
            <form enctype="multipart/form-data" method="POST" action="{{ route('alats.store') }}"
                class="flex flex-col gap-y-4">
                @csrf
                <div class="flex items-center max-[650px]:flex-col max-[650px]:gap-y-2 max-[650px]:items-start">
                    <label for="" class="w-[180px] font-medium">Nama Alat</label>
                    <input type="text" name="nama_alat" id=""
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2" />
                </div>
                <div class="flex items-center max-[650px]:flex-col max-[650px]:gap-y-2 max-[650px]:items-start">
                    <label for="" class="w-[180px] font-medium">Kategori Alat</label>
                    <select name="kategori" id=""
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 appearance-none cursor-pointer">
                        <option value="" disabled selected>
                            -- Pilih Kategori --
                        </option>
                        <option value="Material Konstruksi">Material Konstruksi</option>
                        <option value="Peralatan Konstruksi">Peralatan Konstruksi</option>
                        <option value="Alat Berat">Alat Berat</option>
                        <option value="Alat Keselamatan (K3)">Alat Keselamatan (K3)</option>
                        <option value="Peralatan Kerja Lapangan">Peralatan Kerja Lapangan</option>
                        <option value="Perangkat IT">Perangkat IT</option>
                        <option value="Elektronik Kantor">Elektronik Kantor</option>
                        <option value="Software / Aplikasi">Software / Aplikasi</option>
                        <option value="Alat Survey & Pengukuran">Alat Survey & Pengukuran</option>
                        <option value="Peralatan Kantor">Peralatan Kantor</option>
                        <option value="Perlengkapan Gambar & Dokumen">Perlengkapan Gambar & Dokumen</option>
                        <option value="Peralatan Pendukung Lapangan">Peralatan Pendukung Lapangan</option>
                        <option value="Kendaraan Operasional">Kendaraan Operasional</option>
                        <option value="Peralatan Kebersihan">Peralatan Kebersihan</option>
                        <option value="Peralatan Keamanan / CCTV">Peralatan Keamanan / CCTV</option>
                        <option value="Perlengkapan Meeting">Perlengkapan Meeting</option>
                        <option value="Consumable / Barang Habis Pakai">Consumable / Barang Habis Pakai</option>
                    </select>

                </div>
                <div class="flex items-center max-[650px]:flex-col max-[650px]:gap-y-2 max-[650px]:items-start">
                    <label for="" class="w-[180px] font-medium">Spesifikasi</label>
                    <input type="text" name="spesifikasi" id=""
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2" />
                </div>
                <div class="flex items-center max-[650px]:flex-col max-[650px]:gap-y-2 max-[650px]:items-start">
                    <label for="" class="w-[180px] font-medium">Satuan</label>
                    <select name="satuan" id=""
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 appearance-none cursor-pointer">
                        <option value="" disabled selected>
                            -- Pilih Satuan --
                        </option>

                        <optgroup label="Satuan Umum">
                            <option value="Unit">Unit</option>
                            <option value="Pcs">Pcs</option>
                            <option value="Set">Set</option>
                            <option value="Box">Box</option>
                            <option value="Pack / Pak">Pack / Pak</option>
                            <option value="Lusin">Lusin</option>
                        </optgroup>

                        <optgroup label="Dimensi & Berat">
                            <option value="Meter (m)">Meter (m)</option>
                            <option value="Meter persegi (m²)">Meter persegi (m²)</option>
                            <option value="Meter kubik (m³)">Meter kubik (m³)</option>
                            <option value="Gram (g)">Gram (g)</option>
                            <option value="Kilogram (kg)">Kilogram (kg)</option>
                            <option value="Ton">Ton</option>
                        </optgroup>

                        <optgroup label="Satuan Cairan">
                            <option value="Liter (L)">Liter (L)</option>
                            <option value="Mililiter (ml)">Mililiter (ml)</option>
                        </optgroup>

                        <optgroup label="Satuan Kemasan Khusus">
                            <option value="Sak">Sak</option>
                            <option value="Zak">Zak</option>
                            <option value="Batang">Batang</option>
                            <option value="Lembar">Lembar</option>
                            <option value="Roll">Roll</option>
                            <option value="Rim">Rim</option>
                            <option value="Pair / Pasang">Pair / Pasang</option>
                            <option value="Can">Can</option>
                            <option value="Drum">Drum</option>
                            <option value="Bottle">Bottle</option>
                            <option value="Tube">Tube</option>
                            <option value="Bundle">Bundle</option>
                        </optgroup>

                        <optgroup label="Satuan Waktu">
                            <option value="Jam">Jam</option>
                            <option value="Shift">Shift</option>
                            <option value="Hari">Hari</option>
                            <option value="Minggu">Minggu</option>
                            <option value="Bulan">Bulan</option>
                            <option value="Tahun">Tahun</option>
                        </optgroup>
                    </select>

                </div>
                <div class="flex items-center max-[650px]:flex-col max-[650px]:gap-y-2 max-[650px]:items-start">
                    <label for="" class="w-[180px] font-medium">Stok</label>
                    <input type="number" name="stok" id=""
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2" />
                </div>
                <div class="flex items-center max-[650px]:flex-col max-[650px]:gap-y-2 max-[650px]:items-start">
                    <label for="" class="w-[180px] font-medium">Foto</label>
                    <input type="file" name="foto" id=""
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2" />
                </div>
                <div class="flex mt-4">
                    <div class="w-[180px] max-[650px]:hidden"></div>
                    <div class="w-full flex gap-x-2">
                        <button type="submit" class="bg-[#FFF494] px-6 py-2 rounded-lg cursor-pointer">
                            Simpan Data
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
