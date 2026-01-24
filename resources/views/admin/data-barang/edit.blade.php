@extends('admin.layout')
@section('content')
    <div class="flex flex-col items-center">
        <h1 class="text-2xl font-bold mb-6 w-full">Edit Data Barang</h1>
        <div class="shadow-[0px_0px_15px_rgba(0,0,0,0.25)] w-full p-10 rounded-lg bg-white">
            <form enctype="multipart/form-data" method="POST" action="{{ route('barangsAdmin.update', $barang->id) }}"
                class="flex flex-col gap-y-4">
                @csrf
                @method('PUT')

                <div class="flex items-center max-[650px]:flex-col max-[650px]:gap-y-2 max-[650px]:items-start">
                    <label class="w-[180px] font-medium">Nama Barang</label>
                    <input type="text" name="nama_barang" value="{{ $barang->nama_barang }}"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2" />
                </div>

                <div class="flex items-center max-[650px]:flex-col max-[650px]:gap-y-2 max-[650px]:items-start">
                    <label class="w-[180px] font-medium">Kategori Barang</label>
                    <select name="kategori"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 appearance-none cursor-pointer">
                        <option value="" disabled>-- Pilih Kategori --</option>
                        <option value="Material Konstruksi"
                            {{ $barang->kategori == 'Material Konstruksi' ? 'selected' : '' }}>Material Konstruksi</option>
                        <option value="Peralatan Konstruksi"
                            {{ $barang->kategori == 'Peralatan Konstruksi' ? 'selected' : '' }}>Peralatan Konstruksi
                        </option>
                        <option value="Alat Berat" {{ $barang->kategori == 'Alat Berat' ? 'selected' : '' }}>Alat Berat
                        </option>
                        <option value="Alat Keselamatan (K3)"
                            {{ $barang->kategori == 'Alat Keselamatan (K3)' ? 'selected' : '' }}>Alat Keselamatan (K3)
                        </option>
                        <option value="Peralatan Kerja Lapangan"
                            {{ $barang->kategori == 'Peralatan Kerja Lapangan' ? 'selected' : '' }}>Peralatan Kerja Lapangan
                        </option>
                        <option value="Perangkat IT" {{ $barang->kategori == 'Perangkat IT' ? 'selected' : '' }}>Perangkat
                            IT</option>
                        <option value="Elektronik Kantor" {{ $barang->kategori == 'Elektronik Kantor' ? 'selected' : '' }}>
                            Elektronik Kantor</option>
                        <option value="Software / Aplikasi"
                            {{ $barang->kategori == 'Software / Aplikasi' ? 'selected' : '' }}>Software / Aplikasi</option>
                        <option value="Alat Survey & Pengukuran"
                            {{ $barang->kategori == 'Alat Survey & Pengukuran' ? 'selected' : '' }}>Alat Survey &
                            Pengukuran</option>
                        <option value="Peralatan Kantor" {{ $barang->kategori == 'Peralatan Kantor' ? 'selected' : '' }}>
                            Peralatan Kantor</option>
                        <option value="Perlengkapan Gambar & Dokumen"
                            {{ $barang->kategori == 'Perlengkapan Gambar & Dokumen' ? 'selected' : '' }}>Perlengkapan
                            Gambar & Dokumen</option>
                        <option value="Peralatan Pendukung Lapangan"
                            {{ $barang->kategori == 'Peralatan Pendukung Lapangan' ? 'selected' : '' }}>Peralatan Pendukung
                            Lapangan</option>
                        <option value="Kendaraan Operasional"
                            {{ $barang->kategori == 'Kendaraan Operasional' ? 'selected' : '' }}>Kendaraan Operasional
                        </option>
                        <option value="Peralatan Kebersihan"
                            {{ $barang->kategori == 'Peralatan Kebersihan' ? 'selected' : '' }}>Peralatan Kebersihan
                        </option>
                        <option value="Peralatan Keamanan / CCTV"
                            {{ $barang->kategori == 'Peralatan Keamanan / CCTV' ? 'selected' : '' }}>Peralatan Keamanan /
                            CCTV</option>
                        <option value="Perlengkapan Meeting"
                            {{ $barang->kategori == 'Perlengkapan Meeting' ? 'selected' : '' }}>Perlengkapan Meeting
                        </option>
                        <option value="Consumable / Barang Habis Pakai"
                            {{ $barang->kategori == 'Consumable / Barang Habis Pakai' ? 'selected' : '' }}>Consumable /
                            Barang Habis Pakai</option>
                    </select>
                </div>

                <div class="flex items-center max-[650px]:flex-col max-[650px]:gap-y-2 max-[650px]:items-start">
                    <label class="w-[180px] font-medium">Spesifikasi</label>
                    <input type="text" name="spesifikasi" value="{{ $barang->spesifikasi }}"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2" />
                </div>

                <div class="flex items-center max-[650px]:flex-col max-[650px]:gap-y-2 max-[650px]:items-start">
                    <label class="w-[180px] font-medium">Satuan</label>
                    <select name="satuan"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 appearance-none cursor-pointer">
                        <option value="" disabled>-- Pilih Satuan --</option>
                        <option value="Unit" {{ $barang->satuan == 'Unit' ? 'selected' : '' }}>Unit</option>
                        <option value="Pcs" {{ $barang->satuan == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                        <option value="Set" {{ $barang->satuan == 'Set' ? 'selected' : '' }}>Set</option>
                        <option value="Box" {{ $barang->satuan == 'Box' ? 'selected' : '' }}>Box</option>
                        <option value="Pack / Pak" {{ $barang->satuan == 'Pack / Pak' ? 'selected' : '' }}>Pack / Pak
                        </option>
                        <option value="Lusin" {{ $barang->satuan == 'Lusin' ? 'selected' : '' }}>Lusin</option>
                        <option value="Meter (m)" {{ $barang->satuan == 'Meter (m)' ? 'selected' : '' }}>Meter (m)</option>
                        <option value="Meter persegi (m²)" {{ $barang->satuan == 'Meter persegi (m²)' ? 'selected' : '' }}>
                            Meter persegi (m²)</option>
                        <option value="Meter kubik (m³)" {{ $barang->satuan == 'Meter kubik (m³)' ? 'selected' : '' }}>
                            Meter kubik (m³)</option>
                        <option value="Gram (g)" {{ $barang->satuan == 'Gram (g)' ? 'selected' : '' }}>Gram (g)</option>
                        <option value="Kilogram (kg)" {{ $barang->satuan == 'Kilogram (kg)' ? 'selected' : '' }}>Kilogram
                            (kg)</option>
                        <option value="Ton" {{ $barang->satuan == 'Ton' ? 'selected' : '' }}>Ton</option>
                        <option value="Liter (L)" {{ $barang->satuan == 'Liter (L)' ? 'selected' : '' }}>Liter (L)</option>
                        <option value="Mililiter (ml)" {{ $barang->satuan == 'Mililiter (ml)' ? 'selected' : '' }}>
                            Mililiter (ml)</option>
                        <option value="Sak" {{ $barang->satuan == 'Sak' ? 'selected' : '' }}>Sak</option>
                        <option value="Zak" {{ $barang->satuan == 'Zak' ? 'selected' : '' }}>Zak</option>
                        <option value="Batang" {{ $barang->satuan == 'Batang' ? 'selected' : '' }}>Batang</option>
                        <option value="Lembar" {{ $barang->satuan == 'Lembar' ? 'selected' : '' }}>Lembar</option>
                        <option value="Roll" {{ $barang->satuan == 'Roll' ? 'selected' : '' }}>Roll</option>
                        <option value="Rim" {{ $barang->satuan == 'Rim' ? 'selected' : '' }}>Rim</option>
                        <option value="Pair / Pasang" {{ $barang->satuan == 'Pair / Pasang' ? 'selected' : '' }}>Pair /
                            Pasang</option>
                        <option value="Can" {{ $barang->satuan == 'Can' ? 'selected' : '' }}>Can</option>
                        <option value="Drum" {{ $barang->satuan == 'Drum' ? 'selected' : '' }}>Drum</option>
                        <option value="Bottle" {{ $barang->satuan == 'Bottle' ? 'selected' : '' }}>Bottle</option>
                        <option value="Tube" {{ $barang->satuan == 'Tube' ? 'selected' : '' }}>Tube</option>
                        <option value="Bundle" {{ $barang->satuan == 'Bundle' ? 'selected' : '' }}>Bundle</option>
                        <option value="Jam" {{ $barang->satuan == 'Jam' ? 'selected' : '' }}>Jam</option>
                        <option value="Shift" {{ $barang->satuan == 'Shift' ? 'selected' : '' }}>Shift</option>
                        <option value="Hari" {{ $barang->satuan == 'Hari' ? 'selected' : '' }}>Hari</option>
                        <option value="Minggu" {{ $barang->satuan == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                        <option value="Bulan" {{ $barang->satuan == 'Bulan' ? 'selected' : '' }}>Bulan</option>
                        <option value="Tahun" {{ $barang->satuan == 'Tahun' ? 'selected' : '' }}>Tahun</option>
                    </select>
                </div>

                <div class="flex items-center max-[650px]:flex-col max-[650px]:gap-y-2 max-[650px]:items-start">
                    <label class="w-[180px] font-medium">Stok</label>
                    <input type="number" name="stok" value="{{ $barang->stok }}"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2" />
                </div>

                <div class="flex items-center max-[650px]:flex-col max-[650px]:gap-y-2 max-[650px]:items-start">
                    <label class="w-[180px] font-medium">Foto</label>
                    <div class="flex w-full">
                        <input type="file" name="foto" class="w-[80%] outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2" />
                        @if ($barang->foto)
                            <a href="{{ asset('storage/' . $barang->foto) }}" target="_blank"
                                class="ml-4 w-[20%] flex items-center justify-center bg-[#FFF494] rounded-sm px-4 py-2">
                                Lihat Foto Lama
                            </a>
                        @endif
                    </div>
                </div>

                <div class="flex mt-4">
                    <div class="w-[180px]"></div>
                    <div class="w-full flex gap-x-2">
                        <button type="submit" class="bg-[#FFF494] px-6 py-2 rounded-lg cursor-pointer">
                            Update Data
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
