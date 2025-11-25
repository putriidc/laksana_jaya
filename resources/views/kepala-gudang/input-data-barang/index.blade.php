@extends('kepala-gudang.layout') @section('content')
<div class="flex flex-col items-center">
    <h1 class="text-2xl font-bold mb-6 w-full">Input Data Barang</h1>
    <div
        class="shadow-[0px_0px_15px_rgba(0,0,0,0.25)] w-full p-10 rounded-lg bg-white"
    >
        <form action="" class="flex flex-col gap-y-4">
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Tgl Masuk</label>
                <input
                    type="date"
                    name=""
                    id=""
                    class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2"
                />
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Nama Barang</label>
                <input
                    type="text"
                    name=""
                    id=""
                    class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2"
                />
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium"
                    >Kategori Barang</label
                >
                <select
                    name=""
                    id=""
                    class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 appearance-none cursor-pointer"
                >
                    <option value="" disabled selected>
                        -- Pilih Kategori --
                    </option>
                    <option value="material_konstruksi">
                        Material Konstruksi
                    </option>
                    <option value="peralatan_konstruksi">
                        Peralatan Konstruksi
                    </option>
                    <option value="alat_berat">Alat Berat</option>
                    <option value="alat_keselamatan_k3">
                        Alat Keselamatan (K3)
                    </option>
                    <option value="peralatan_kerja_lapangan">
                        Peralatan Kerja Lapangan
                    </option>
                    <option value="perangkat_it">Perangkat IT</option>
                    <option value="elektronik_kantor">Elektronik Kantor</option>
                    <option value="software_aplikasi">
                        Software / Aplikasi
                    </option>
                    <option value="alat_survey_pengukuran">
                        Alat Survey & Pengukuran
                    </option>
                    <option value="peralatan_kantor">Peralatan Kantor</option>
                    <option value="perlengkapan_gambar_dokumen">
                        Perlengkapan Gambar & Dokumen
                    </option>
                    <option value="peralatan_pendukung_lapangan">
                        Peralatan Pendukung Lapangan
                    </option>
                    <option value="kendaraan_operasional">
                        Kendaraan Operasional
                    </option>
                    <option value="peralatan_kebersihan">
                        Peralatan Kebersihan
                    </option>
                    <option value="peralatan_keamanan_cctv">
                        Peralatan Keamanan / CCTV
                    </option>
                    <option value="perlengkapan_meeting">
                        Perlengkapan Meeting
                    </option>
                    <option value="consumable">
                        Consumable / Barang Habis Pakai
                    </option>
                </select>
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Spesifikasi</label>
                <input
                    type="text"
                    name=""
                    id=""
                    class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2"
                />
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Satuan</label>
                <select
                    name=""
                    id=""
                    class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 appearance-none cursor-pointer"
                >
                    <option value="" disabled selected>
                        -- Pilih Satuan --
                    </option>
                    <optgroup label="Satuan Umum">
                        <option value="unit">Unit</option>
                        <option value="pcs">Pcs</option>
                        <option value="set">Set</option>
                        <option value="box">Box</option>
                        <option value="pack">Pack / Pak</option>
                        <option value="lusin">Lusin</option>
                    </optgroup>

                    {{-- SATUAN DIMENSI & BERAT --}}
                    <optgroup label="Dimensi & Berat">
                        <option value="meter">Meter (m)</option>
                        <option value="meter_persegi">
                            Meter persegi (m²)
                        </option>
                        <option value="meter_kubik">Meter kubik (m³)</option>
                        <option value="gram">Gram (g)</option>
                        <option value="kilogram">Kilogram (kg)</option>
                        <option value="ton">Ton</option>
                    </optgroup>

                    {{-- SATUAN CAIRAN --}}
                    <optgroup label="Satuan Cairan">
                        <option value="liter">Liter (L)</option>
                        <option value="mililiter">Mililiter (ml)</option>
                    </optgroup>

                    {{-- SATUAN KEMASAN KHUSUS --}}
                    <optgroup label="Satuan Kemasan Khusus">
                        <option value="sak">Sak</option>
                        <option value="zak">Zak</option>
                        <option value="batang">Batang</option>
                        <option value="lembar">Lembar</option>
                        <option value="roll">Roll</option>
                        <option value="rim">Rim</option>
                        <option value="pair">Pair / Pasang</option>
                        <option value="can">Can</option>
                        <option value="drum">Drum</option>
                        <option value="bottle">Bottle</option>
                        <option value="tube">Tube</option>
                        <option value="bundle">Bundle</option>
                    </optgroup>

                    {{-- SATUAN WAKTU (untuk service/sewa) --}}
                    <optgroup label="Satuan Waktu">
                        <option value="jam">Jam</option>
                        <option value="shift">Shift</option>
                        <option value="hari">Hari</option>
                        <option value="minggu">Minggu</option>
                        <option value="bulan">Bulan</option>
                        <option value="tahun">Tahun</option>
                    </optgroup>
                </select>
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Stok</label>
                <input
                    type="text"
                    name=""
                    id=""
                    class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2"
                />
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Image</label>
                <input
                    type="file"
                    name=""
                    id=""
                    class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2"
                />
            </div>
            <div class="flex mt-4">
                <div class="w-[180px]"></div>
                <div class="w-full flex gap-x-2">
                    <button
                        type="submit"
                        class="bg-[#FFF494] px-6 py-2 rounded-lg cursor-pointer"
                    >
                        Simpan Data
                    </button>
                    <button
                        class="bg-[#FFB7B7] px-6 py-2 rounded-lg cursor-pointer"
                    >
                        Batal
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
