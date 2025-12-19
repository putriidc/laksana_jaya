@extends("owner.layout")
@section("content")
<div>
    <h1 class="font-bold text-2xl mb-5">Laporan Laba Rugi</h1>
    <div class="flex items-center gap-x-2 mb-5">
            <form action="{{ route('labarugi.index') }}" method="GET" class="flex items-center gap-x-2">
            @csrf
            <select name="bulan" class="border-2 border-[#9A9A9A] px-4 py-2 rounded-lg w-[200px] appearance-none">
                <option selected disabled class="border-2 border-[#9A9A9A] px-4 py-2 rounded-lg w-[200px]">-- Pilih Bulan --
                </option>
                @for ($i = 1; $i <= 12; $i++)
                    @php
                        $val = date('Y') . '-' . str_pad($i, 2, '0', STR_PAD_LEFT); // contoh: 2025-01
                        $namaBulan = \Carbon\Carbon::create()->month($i)->translatedFormat('F');
                    @endphp
                    <option value="{{ $val }}" {{ request('bulan') == $val ? 'selected' : '' }}>
                        {{ $namaBulan }}
                    </option>
                @endfor
            </select>
            <button type="submit" class="py-[10px] px-[10px] border-[#9A9A9A] border-2 rounded-lg cursor-pointer">
                <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" class="w-[20px]">
            </button>
            </form>
        <a href="{{ route('labarugi.print', ['bulan' => request('bulan')]) }}" target="_blank"
            class="py-[10px] px-[10px] border-[#9A9A9A] border-2 rounded-lg cursor-pointer flex items-center gap-x-2 w-fit">
            <span class="text-gray-500">Cetak Laporan</span>
            <img src="{{ asset('assets/printer.png') }}" alt="search icon" class="w-[22px]">
        </a>
        </div>
    <section class="w-full py-4 px-14 rounded-2xl shadow-[0px_0px_5px_rgba(0,0,0,0.25)] gap-y-4 flex flex-col">
        <div class="flex flex-col gap-y-1">
            <div class="text-[#9A9A9A] flex items-center justify-between">
                <span class="font-bold">PENDAPATAN</span>
                <span class="font-bold">Rp. 5.000.000</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between">
                <span class="">Pendapatan Proyek Fisik</span>
                <span class=" mr-20 w-[200px]">Rp. 3.000.000</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between">
                <span class="">Pendapatan Konsultan</span>
                <span class=" mr-20 w-[200px]">Rp. 1.500.000</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between">
                <span class="">Pendapatan Mining</span>
                <span class=" mr-20 w-[200px]">Rp. 500.000</span>
            </div>
        </div>
        <div class="flex flex-col gap-y-1">
            <div class="text-[#9A9A9A] flex items-center justify-between">
                <span class="font-bold">HARGA POKOK PROYEK</span>
                <span class="font-bold">Rp.</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between">
                <span class="">Biaya Material</span>
                <span class=" mr-20 w-[200px]">Rp.</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between">
                <span class="">Biaya Gaji Tukang & Pengawas Lap</span>
                <span class=" mr-20 w-[200px]">Rp.</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between">
                <span class="">Biaya Sewa Alat Berat</span>
                <span class=" mr-20 w-[200px]">Rp.</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between">
                <span class="">Biaya  Asuransi</span>
                <span class=" mr-20 w-[200px]">Rp.</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between">
                <span class="">Biaya Transportasi dan Perjalanan Dinas</span>
                <span class=" mr-20 w-[200px]">Rp.</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between">
                <span class="">Biaya Infaq dan Sumbangan</span>
                <span class=" mr-20 w-[200px]">Rp.</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between">
                <span class="">Biaya Operasional Lainnya</span>
                <span class=" mr-20 w-[200px]">Rp.</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between">
                <span class="">Biaya Alat Tulis Kantor</span>
                <span class=" mr-20 w-[200px]">Rp.</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between">
                <span class="">Biaya Sewa Gedung Kantor</span>
                <span class=" mr-20 w-[200px]">Rp.</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between">
                <span class="">Biaya Gaji Staff Kantor</span>
                <span class=" mr-20 w-[200px]">Rp.</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between">
                <span class="">Biaya Konsumsi</span>
                <span class=" mr-20 w-[200px]">Rp.</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between">
                <span class="">Biaya Adm dan Umum Lainnya</span>
                <span class=" mr-20 w-[200px]">Rp.</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between">
                <span class="">Fee Perusahaan</span>
                <span class=" mr-20 w-[200px]">Rp.</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between">
                <span class="">Beban PPh</span>
                <span class=" mr-20 w-[200px]">Rp.</span>
            </div>
        </div>
        <div class="flex flex-col gap-y-1">
            <div class="text-[#9A9A9A] flex items-center justify-between">
                <span class="font-bold">TOTAL LABA RUGI</span>
                <span class="font-bold">Rp.</span>
            </div>
        </div>
    </section>
</div>
@endsection