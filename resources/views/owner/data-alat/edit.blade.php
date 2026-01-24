@extends('owner.layout')
@section('content')
    <div class="flex flex-col items-center">
        <h1 class="text-2xl font-bold mb-6 w-full">Edit Data Alat</h1>
        <div class="shadow-[0px_0px_15px_rgba(0,0,0,0.25)] w-full p-10 rounded-lg bg-white">
            <form enctype="multipart/form-data" method="POST" action="{{ route('alatsOwner.update', $alat->id) }}"
                class="flex flex-col gap-y-4">
                @csrf
                @method('PUT')

                <div class="flex items-center max-[650px]:flex-col max-[650px]:gap-y-2 max-[650px]:items-start">
                    <label class="w-[180px] font-medium">Nama Alat</label>
                    <input type="text" name="nama_alat" value="{{ $alat->nama_alat }}"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2" />
                </div>

                <div class="flex items-center max-[650px]:flex-col max-[650px]:gap-y-2 max-[650px]:items-start">
                    <label class="w-[180px] font-medium">Kategori Alat</label>
                    <select name="kategori"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 appearance-none cursor-pointer">
                        <option value="" disabled>-- Pilih Kategori --</option>
                        <option value="Material Konstruksi"
                            {{ $alat->kategori == 'Material Konstruksi' ? 'selected' : '' }}>Material Konstruksi</option>
                        <option value="Peralatan Konstruksi"
                            {{ $alat->kategori == 'Peralatan Konstruksi' ? 'selected' : '' }}>Peralatan Konstruksi
                        </option>
                        <option value="Alat Berat" {{ $alat->kategori == 'Alat Berat' ? 'selected' : '' }}>Alat Berat
                        </option>
                        <option value="Alat Keselamatan (K3)"
                            {{ $alat->kategori == 'Alat Keselamatan (K3)' ? 'selected' : '' }}>Alat Keselamatan (K3)
                        </option>
                        <option value="Peralatan Kerja Lapangan"
                            {{ $alat->kategori == 'Peralatan Kerja Lapangan' ? 'selected' : '' }}>Peralatan Kerja Lapangan
                        </option>
                        <option value="Perangkat IT" {{ $alat->kategori == 'Perangkat IT' ? 'selected' : '' }}>Perangkat
                            IT</option>
                        <option value="Elektronik Kantor" {{ $alat->kategori == 'Elektronik Kantor' ? 'selected' : '' }}>
                            Elektronik Kantor</option>
                        <option value="Software / Aplikasi"
                            {{ $alat->kategori == 'Software / Aplikasi' ? 'selected' : '' }}>Software / Aplikasi</option>
                        <option value="Alat Survey & Pengukuran"
                            {{ $alat->kategori == 'Alat Survey & Pengukuran' ? 'selected' : '' }}>Alat Survey &
                            Pengukuran</option>
                        <option value="Peralatan Kantor" {{ $alat->kategori == 'Peralatan Kantor' ? 'selected' : '' }}>
                            Peralatan Kantor</option>
                        <option value="Perlengkapan Gambar & Dokumen"
                            {{ $alat->kategori == 'Perlengkapan Gambar & Dokumen' ? 'selected' : '' }}>Perlengkapan
                            Gambar & Dokumen</option>
                        <option value="Peralatan Pendukung Lapangan"
                            {{ $alat->kategori == 'Peralatan Pendukung Lapangan' ? 'selected' : '' }}>Peralatan Pendukung
                            Lapangan</option>
                        <option value="Kendaraan Operasional"
                            {{ $alat->kategori == 'Kendaraan Operasional' ? 'selected' : '' }}>Kendaraan Operasional
                        </option>
                        <option value="Peralatan Kebersihan"
                            {{ $alat->kategori == 'Peralatan Kebersihan' ? 'selected' : '' }}>Peralatan Kebersihan
                        </option>
                        <option value="Peralatan Keamanan / CCTV"
                            {{ $alat->kategori == 'Peralatan Keamanan / CCTV' ? 'selected' : '' }}>Peralatan Keamanan /
                            CCTV</option>
                        <option value="Perlengkapan Meeting"
                            {{ $alat->kategori == 'Perlengkapan Meeting' ? 'selected' : '' }}>Perlengkapan Meeting
                        </option>
                        <option value="Consumable / alat Habis Pakai"
                            {{ $alat->kategori == 'Consumable / alat Habis Pakai' ? 'selected' : '' }}>Consumable /
                            alat Habis Pakai</option>
                    </select>
                </div>

                <div class="flex items-center max-[650px]:flex-col max-[650px]:gap-y-2 max-[650px]:items-start">
                    <label class="w-[180px] font-medium">Spesifikasi</label>
                    <input type="text" name="spesifikasi" value="{{ $alat->spesifikasi }}"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2" />
                </div>

                <div class="flex items-center max-[650px]:flex-col max-[650px]:gap-y-2 max-[650px]:items-start">
                    <label class="w-[180px] font-medium">Satuan</label>
                    <select name="satuan"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 appearance-none cursor-pointer">
                        <option value="" disabled>-- Pilih Satuan --</option>
                        <option value="Unit" {{ $alat->satuan == 'Unit' ? 'selected' : '' }}>Unit</option>
                        <option value="Pcs" {{ $alat->satuan == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                        <option value="Set" {{ $alat->satuan == 'Set' ? 'selected' : '' }}>Set</option>
                        <option value="Box" {{ $alat->satuan == 'Box' ? 'selected' : '' }}>Box</option>
                        <option value="Pack / Pak" {{ $alat->satuan == 'Pack / Pak' ? 'selected' : '' }}>Pack / Pak
                        </option>
                        <option value="Lusin" {{ $alat->satuan == 'Lusin' ? 'selected' : '' }}>Lusin</option>
                        <option value="Meter (m)" {{ $alat->satuan == 'Meter (m)' ? 'selected' : '' }}>Meter (m)</option>
                        <option value="Meter persegi (m²)" {{ $alat->satuan == 'Meter persegi (m²)' ? 'selected' : '' }}>
                            Meter persegi (m²)</option>
                        <option value="Meter kubik (m³)" {{ $alat->satuan == 'Meter kubik (m³)' ? 'selected' : '' }}>
                            Meter kubik (m³)</option>
                        <option value="Gram (g)" {{ $alat->satuan == 'Gram (g)' ? 'selected' : '' }}>Gram (g)</option>
                        <option value="Kilogram (kg)" {{ $alat->satuan == 'Kilogram (kg)' ? 'selected' : '' }}>Kilogram
                            (kg)</option>
                        <option value="Ton" {{ $alat->satuan == 'Ton' ? 'selected' : '' }}>Ton</option>
                        <option value="Liter (L)" {{ $alat->satuan == 'Liter (L)' ? 'selected' : '' }}>Liter (L)</option>
                        <option value="Mililiter (ml)" {{ $alat->satuan == 'Mililiter (ml)' ? 'selected' : '' }}>
                            Mililiter (ml)</option>
                        <option value="Sak" {{ $alat->satuan == 'Sak' ? 'selected' : '' }}>Sak</option>
                        <option value="Zak" {{ $alat->satuan == 'Zak' ? 'selected' : '' }}>Zak</option>
                        <option value="Batang" {{ $alat->satuan == 'Batang' ? 'selected' : '' }}>Batang</option>
                        <option value="Lembar" {{ $alat->satuan == 'Lembar' ? 'selected' : '' }}>Lembar</option>
                        <option value="Roll" {{ $alat->satuan == 'Roll' ? 'selected' : '' }}>Roll</option>
                        <option value="Rim" {{ $alat->satuan == 'Rim' ? 'selected' : '' }}>Rim</option>
                        <option value="Pair / Pasang" {{ $alat->satuan == 'Pair / Pasang' ? 'selected' : '' }}>Pair /
                            Pasang</option>
                        <option value="Can" {{ $alat->satuan == 'Can' ? 'selected' : '' }}>Can</option>
                        <option value="Drum" {{ $alat->satuan == 'Drum' ? 'selected' : '' }}>Drum</option>
                        <option value="Bottle" {{ $alat->satuan == 'Bottle' ? 'selected' : '' }}>Bottle</option>
                        <option value="Tube" {{ $alat->satuan == 'Tube' ? 'selected' : '' }}>Tube</option>
                        <option value="Bundle" {{ $alat->satuan == 'Bundle' ? 'selected' : '' }}>Bundle</option>
                        <option value="Jam" {{ $alat->satuan == 'Jam' ? 'selected' : '' }}>Jam</option>
                        <option value="Shift" {{ $alat->satuan == 'Shift' ? 'selected' : '' }}>Shift</option>
                        <option value="Hari" {{ $alat->satuan == 'Hari' ? 'selected' : '' }}>Hari</option>
                        <option value="Minggu" {{ $alat->satuan == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                        <option value="Bulan" {{ $alat->satuan == 'Bulan' ? 'selected' : '' }}>Bulan</option>
                        <option value="Tahun" {{ $alat->satuan == 'Tahun' ? 'selected' : '' }}>Tahun</option>
                    </select>
                </div>

                <div class="flex items-center max-[650px]:flex-col max-[650px]:gap-y-2 max-[650px]:items-start">
                    <label class="w-[180px] font-medium">Stok</label>
                    <input type="number" name="stok" value="{{ $alat->stok }}"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2" />
                </div>

                <div class="flex items-center max-[650px]:flex-col max-[650px]:gap-y-2 max-[650px]:items-start">
                    <label class="w-[180px] font-medium">Foto</label>
                    <div class="flex w-full">
                        <input type="file" name="foto" class="w-[80%] outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2" />
                        @if ($alat->foto)
                            <a href="{{ asset('storage/' . $alat->foto) }}" target="_blank"
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
