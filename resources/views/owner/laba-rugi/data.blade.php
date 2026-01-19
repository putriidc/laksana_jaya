@extends("owner.layout")
@section("content")
<div>
    <h1 class="font-bold text-2xl mb-5">Laporan Laba Rugi</h1>
    <div class="flex items-center gap-2 mb-5 max-[500px]:flex-wrap">
            <form action="{{ route('labarugi.index') }}" method="GET" class="flex items-center gap-x-2">
    <input type="date" name="start" data-flatpickr placeholder="Tgl Mulai" value="{{ request('start') }}"
           class="border-2 border-[#9A9A9A] px-4 py-2 rounded-lg w-[200px] outline-none">
    <input type="date" name="end" data-flatpickr placeholder="Tgl Selesai" value="{{ request('end') }}"
           class="border-2 border-[#9A9A9A] px-4 py-2 rounded-lg w-[200px] outline-none">

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
    <section class="w-full py-4 px-14 max-[550px]:px-4 rounded-2xl shadow-[0px_0px_5px_rgba(0,0,0,0.25)] gap-y-4 flex flex-col">
        <div class="flex flex-col gap-y-1 max-[415px]:gap-y-2">
            <div class="text-[#9A9A9A] flex items-center justify-between max-[550px]:gap-x-4">
                <span class="font-bold max-[660px]:text-sm max-[415px]:w-[150px]">PENDAPATAN</span>
                <span class="font-bold max-[660px]:text-xs">Rp. {{ number_format($totalPendapatan, 0, ',', '.') }}</span>
            </div>
            @foreach ($pendapatanFinal as $item)
            <div class="text-[#9A9A9A] flex items-center justify-between max-[550px]:gap-x-4">
                <span class="max-[660px]:text-sm max-[415px]:w-[150px]">{{ $item['nama_perkiraan'] }}</span>
                <span class=" mr-20 w-[200px] max-[850px]:mr-0 max-[850px]:w-auto max-[660px]:text-xs">Rp. {{ number_format($item['total'], 0, ',', '.') }}</span>
            </div>
            @endforeach
            {{-- <div class="text-[#9A9A9A] flex items-center justify-between max-[550px]:gap-x-4">
                <span class="max-[660px]:text-sm max-[415px]:w-[150px]">Pendapatan Konsultan</span>
                <span class=" mr-20 w-[200px] max-[850px]:mr-0 max-[850px]:w-auto max-[660px]:text-xs">Rp. 1.500.000</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between max-[550px]:gap-x-4">
                <span class="max-[660px]:text-sm max-[415px]:w-[150px]">Pendapatan Mining</span>
                <span class=" mr-20 w-[200px] max-[850px]:mr-0 max-[850px]:w-auto max-[660px]:text-xs">Rp. 500.000</span>
            </div> --}}
        </div>
        <div class="flex flex-col gap-y-1 max-[415px]:gap-y-2">
            <div class="text-[#9A9A9A] flex items-center justify-between max-[550px]:gap-x-4">
                <span class="font-bold max-[660px]:text-sm max-[415px]:w-[150px]">HARGA POKOK PROYEK</span>
                <span class="font-bold max-[660px]:text-xs">Rp. {{ number_format($totalBiaya, 0, ',', '.') }}</span>
            </div>
            @foreach ($biayaFinal as $item)
            <div class="text-[#9A9A9A] flex items-center justify-between max-[550px]:gap-x-4">
                <span class="max-[660px]:text-sm max-[415px]:w-[150px]">{{ $item['nama_perkiraan'] }}</span>
                <span class=" mr-20 w-[200px] max-[850px]:mr-0 max-[850px]:w-auto max-[660px]:text-xs">Rp. {{ number_format($item['total'], 0, ',', '.') }}</span>
            </div>
            @endforeach
            {{-- <div class="text-[#9A9A9A] flex items-center justify-between max-[550px]:gap-x-4">
                <span class="max-[660px]:text-sm max-[415px]:w-[150px]">Biaya Gaji Tukang & Pengawas Lap</span>
                <span class=" mr-20 w-[200px] max-[850px]:mr-0 max-[850px]:w-auto max-[660px]:text-xs">Rp.</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between max-[550px]:gap-x-4">
                <span class="max-[660px]:text-sm max-[415px]:w-[150px]">Biaya Sewa Alat Berat</span>
                <span class=" mr-20 w-[200px] max-[850px]:mr-0 max-[850px]:w-auto max-[660px]:text-xs">Rp.</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between max-[550px]:gap-x-4">
                <span class="max-[660px]:text-sm max-[415px]:w-[150px]">Biaya  Asuransi</span>
                <span class=" mr-20 w-[200px] max-[850px]:mr-0 max-[850px]:w-auto max-[660px]:text-xs">Rp.</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between max-[550px]:gap-x-4">
                <span class="max-[660px]:text-sm max-[415px]:w-[150px]">Biaya Transportasi dan Perjalanan Dinas</span>
                <span class=" mr-20 w-[200px] max-[850px]:mr-0 max-[850px]:w-auto max-[660px]:text-xs">Rp. 5.000.000</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between max-[550px]:gap-x-4">
                <span class="max-[660px]:text-sm max-[415px]:w-[150px]">Biaya Infaq dan Sumbangan</span>
                <span class=" mr-20 w-[200px] max-[850px]:mr-0 max-[850px]:w-auto max-[660px]:text-xs">Rp.</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between max-[550px]:gap-x-4">
                <span class="max-[660px]:text-sm max-[415px]:w-[150px]">Biaya Operasional Lainnya</span>
                <span class=" mr-20 w-[200px] max-[850px]:mr-0 max-[850px]:w-auto max-[660px]:text-xs">Rp.</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between max-[550px]:gap-x-4">
                <span class="max-[660px]:text-sm max-[415px]:w-[150px]">Biaya Alat Tulis Kantor</span>
                <span class=" mr-20 w-[200px] max-[850px]:mr-0 max-[850px]:w-auto max-[660px]:text-xs">Rp.</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between max-[550px]:gap-x-4">
                <span class="max-[660px]:text-sm max-[415px]:w-[150px]">Biaya Sewa Gedung Kantor</span>
                <span class=" mr-20 w-[200px] max-[850px]:mr-0 max-[850px]:w-auto max-[660px]:text-xs">Rp.</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between max-[550px]:gap-x-4">
                <span class="max-[660px]:text-sm max-[415px]:w-[150px]">Biaya Gaji Staff Kantor</span>
                <span class=" mr-20 w-[200px] max-[850px]:mr-0 max-[850px]:w-auto max-[660px]:text-xs">Rp.</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between max-[550px]:gap-x-4">
                <span class="max-[660px]:text-sm max-[415px]:w-[150px]">Biaya Konsumsi</span>
                <span class=" mr-20 w-[200px] max-[850px]:mr-0 max-[850px]:w-auto max-[660px]:text-xs">Rp.</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between max-[550px]:gap-x-4">
                <span class="max-[660px]:text-sm max-[415px]:w-[150px]">Biaya Adm dan Umum Lainnya</span>
                <span class=" mr-20 w-[200px] max-[850px]:mr-0 max-[850px]:w-auto max-[660px]:text-xs">Rp.</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between max-[550px]:gap-x-4">
                <span class="max-[660px]:text-sm max-[415px]:w-[150px]">Fee Perusahaan</span>
                <span class=" mr-20 w-[200px] max-[850px]:mr-0 max-[850px]:w-auto max-[660px]:text-xs">Rp.</span>
            </div>
            <div class="text-[#9A9A9A] flex items-center justify-between max-[550px]:gap-x-4">
                <span class="max-[660px]:text-sm max-[415px]:w-[150px]">Beban PPh</span>
                <span class=" mr-20 w-[200px] max-[850px]:mr-0 max-[850px]:w-auto max-[660px]:text-xs">Rp.</span>
            </div> --}}
        </div>
        <div class="flex flex-col gap-y-1">
            <div class="text-[#9A9A9A] flex items-center justify-between max-[550px]:gap-x-4">
                <span class="font-bold max-[660px]:text-sm max-[415px]:w-[150px]">TOTAL LABA RUGI</span>
                <span class="font-bold max-[660px]:text-xs">Rp. {{ number_format($totalLabaRugi, 0, ',', '.') }}</span>
            </div>
        </div>
    </section>
</div>
@endsection
