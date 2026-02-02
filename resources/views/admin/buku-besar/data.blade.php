@extends('admin.layout')
@section('content')
    <div>
        <h1 class="text-2xl font-bold mb-5">Buku Besar</h1>
        <div class="flex items-center justify-between mb-5 gap-x-2 max-[780px]:items-start max-[420px]:flex-col max-[420px]:gap-y-3">
            <div class="px-4 py-2 w-auto border-[#9A9A9A] border-2 rounded-lg bg-amber-50">
                <select name="" id="selectTransaksi" class="cursor-pointer w-[150px] outline-none">
                    <option selected disabled>{{ $account->nama_akun }}</option>
                    @foreach ($asset as $assets)
                        <option value="{{ $assets->kode_akun }}">{{ $assets->nama_akun }}</option>
                    @endforeach
                </select>
            </div>
            <form action="{{ route('bukubesar.index', $account->kode_akun) }}" method="GET"
                class="flex items-center gap-x-1 max-[780px]:flex-wrap max-[780px]:justify-end max-[780px]:gap-y-2 max-[420px]:justify-start">
                <input type="text" data-flatpickr placeholder="Tanggal Mulai" name="tgl_mulai" id=""
                    class="w-[180px] px-4 py-2 border-[#9A9A9A] border-2 rounded-lg">
                <input type="text" data-flatpickr placeholder="Tanggal Selesai" name="tgl_selesai" id=""
                    class="w-[180px] px-4 py-2 border-[#9A9A9A] border-2 rounded-lg">
                <button type="submit" class="border-2 border-[#9A9A9A] py-2 px-2 rounded-lg cursor-pointer">
                    <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" class="">
                </button>
                <a target="_blank"
                    href="{{ route('buku-besar-admin.print', [$account->kode_akun, 'tgl_mulai' => request('tgl_mulai'), 'tgl_selesai' => request('tgl_selesai')]) }}"
                    class="border-2 border-[#9A9A9A] py-2 px-2 rounded-lg cursor-pointer">
                    <img src="{{ asset('assets/printer.png') }}" alt="printer icon">
                </a>
            </form>
        </div>
        <div class="flex justify-end items-center gap-x-5 mb-5 max-[1120px]:justify-between max-[870px]:flex-wrap max-[870px]:gap-y-3 max-[870px]:justify-start max-[368px]:flex-col max-[368px]:items-start">
            <div class="flex items-center gap-x-2 max-[1120px]:flex-col max-[1120px]:items-start max-[1120px]:gap-y-1">
                <span class="text-[#9A9A9A] font-medium">Total Saldo</span>
                <span class="bg-[#E6E6E6] px-10 py-1 rounded-lg font-medium">{{ number_format(($totalDebit - $totalKredit), 0, ',', '.') }}</span>
            </div>
            <div class="flex items-center gap-x-2 max-[1120px]:flex-col max-[1120px]:items-start max-[1120px]:gap-y-1">
                <span class="text-[#9A9A9A] font-medium">Total Debit</span>
                <span class="bg-[#E6E6E6] px-10 py-1 rounded-lg font-medium">{{ number_format($totalDebit, 0, ',', '.') }}</span>
            </div>
            <div class="flex items-center gap-x-2 max-[1120px]:flex-col max-[1120px]:items-start max-[1120px]:gap-y-1">
                <span class="text-[#9A9A9A] font-medium">Total Kredit</span>
                <span class="bg-[#E6E6E6] px-10 py-1 rounded-lg font-medium">{{ number_format($totalKredit, 0, ',', '.') }}</span>
            </div>
            <div class="flex items-center gap-x-2 max-[1120px]:flex-col max-[1120px]:items-start max-[1120px]:gap-y-1">
                <span class="text-[#9A9A9A] font-medium">Kode Akun</span>
                <span class="bg-[#E6E6E6] px-10 py-1 rounded-lg font-medium">{{ $account->kode_akun }}</span>
            </div>
            <div class="flex items-center gap-x-2 max-[1120px]:flex-col max-[1120px]:items-start max-[1120px]:gap-y-1">
                <span class="text-[#9A9A9A] font-medium">Post Saldo</span>
                <span class="bg-[#E6E6E6] px-10 py-1 rounded-lg font-medium">{{ $account->post_saldo }}</span>
            </div>
        </div>
        <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6 max-[1100px]:overflow-x-auto">
            <table class="table-fixed text-center text-sm w-full max-[1100px]:w-[1200px]">
                <thead class="border-b-2 border-[#CCCCCC]">
                    <th class="w-[10%] py-2">No</th>
                    <th class="w-[10%] py-2">Tanggal</th>
                    <th class="w-[25%] py-2">Keterangan</th>
                    <th class="w-[15%] py-2">Debet</th>
                    <th class="w-[15%] py-2">Kredit</th>
                    <th class="w-[15%] py-2">Saldo</th>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($transactions as $transaction)
                        <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                            <td class="py-2">{{ $no++ }}</td>
                            <td class="py-2">{{ $transaction->tanggal }}</td>
                            <td class="py-2">{{ $transaction->keterangan }}</td>
                            <td class="py-2">{{ 'RP. ' . number_format($transaction->debit, 0, ',', '.') }}</td>
                            <td class="py-2">{{ 'RP. ' . number_format($transaction->kredit, 0, ',', '.') }}</td>
                            <td class="py-2">{{ 'RP. ' . number_format($transaction->saldo_temp, 0, ',', '.') }}</td>
                        </tr>
                        {{-- <tr class="bg-[#E9E9E9] border-b-[1px] border-[#CCCCCC]">
                    <td class="py-2">1</td>
                    <td class="py-2">2025/12/09</td>
                    <td class="py-2">Mutasi dari bank BCA ke Kas Besar</td>
                    <td class="py-2">Rp. 5.000.000</td>
                    <td class="py-2">Rp. 5.000.000</td>
                    <td class="py-2">Rp. 5.000.000</td>
                </tr> --}}
                    @endforeach
                </tbody>
            </table>
        </div>
        <script>
            const searchSelect = document.getElementById('selectTransaksi');
            searchSelect.addEventListener('change', function() {
                const selectedValue = searchSelect.value;
                window.location.href = '/bukubesar/' + selectedValue;
            });

            // get by date range
            const form = document.getElementById('formDate');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const tgl_awal = document.getElementById('tgl_awal').value;
                const tgl_akhir = document.getElementById('tgl_akhir').value;

                // ambil data pada backend lalu di tampilkan
            });
        </script>
    </div>
@endsection
