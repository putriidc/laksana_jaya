@extends('admin.layout')
@section('content')
    <div class="flex flex-col items-center">
        <h1 class="text-2xl font-bold mb-4 w-full">Edit Data COA Akun</h1>
        <div class="shadow-[0px_0px_15px_rgba(0,0,0,0.25)] w-full p-10 rounded-lg bg-white">
            <form action="{{ route('akun.update', $akun->id) }}" class="flex flex-col gap-y-4" method="POST">
                @csrf
                @method('PUT')

                <div class="flex items-center">
                    <label class="w-[180px] font-medium">Kode Akun</label>
                    <input type="text" name="kode_akun" value="{{ old('kode_akun', $akun->kode_akun) }}"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                </div>

                <div class="flex items-center">
                    <label class="w-[180px] font-medium">Nama Akun</label>
                    <input type="text" name="nama_akun" value="{{ old('nama_akun', $akun->nama_akun) }}"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                </div>

                <div class="flex items-center">
                    <label for="" class="w-[180px] font-medium">Akun Header</label>
                    <select name="akun_header" id=""
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 appearance-none cursor-pointer">
                        <option disabled>-Pilih Akun Header-</option>
                        <option value="asset_lancar_bank" {{ $akun->akun_header == 'asset_lancar_bank' ? 'selected' : '' }}>Kas / Bank</option>
                        <option value="asset_lancar" {{ $akun->akun_header == 'asset_lancar' ? 'selected' : '' }}>Asset
                            Lancar</option>
                        <option value="asset_tetap" {{ $akun->akun_header == 'asset_tetap' ? 'selected' : '' }}>Asset Tetap
                        </option>
                        <option value="kewajiban" {{ $akun->akun_header == 'kewajiban' ? 'selected' : '' }}>Kewajiban
                        </option>
                        <option value="ekuitas" {{ $akun->akun_header == 'ekuitas' ? 'selected' : '' }}>Ekuitas</option>
                        <option value="pendapatan" {{ $akun->akun_header == 'pendapatan' ? 'selected' : '' }}>Pendapatan
                        </option>
                        <option value="hpp_proyek" {{ $akun->akun_header == 'hpp_proyek' ? 'selected' : '' }}>HPP Proyek
                        </option>
                    </select>
                </div>

                <div class="flex items-center">
                    <label class="w-[180px] font-medium">Post Saldo</label>
                    <input type="text" name="post_saldo" value="{{ old('post_saldo', $akun->post_saldo) }}"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                </div>

                <div class="flex items-center">
                    <label class="w-[180px] font-medium">Post Laporan</label>
                    <input type="text" name="post_laporan" value="{{ old('post_laporan', $akun->post_laporan) }}"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                </div>

                <div class="flex mt-4">
                    <div class="w-[180px]"></div>
                    <div class="w-full flex gap-x-2">
                        <button type="submit" class="bg-[#FFF494] px-6 py-2 rounded-lg cursor-pointer">Update Data</button>
                        <a href="{{ route('master-data.index') }}"
                            class="bg-[#FFB7B7] px-6 py-2 rounded-lg cursor-pointer">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
