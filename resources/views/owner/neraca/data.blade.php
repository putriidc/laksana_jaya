@extends('owner.layout')
@section('content')
    <div>
        <div
            class="mb-5 flex items-center justify-between pb-5 border-b-2 border-[#CCCCCC] max-[420px]:flex-wrap max-[420px]:gap-2">
            <h1 class="text-2xl font-bold">Data Neraca</h1>
            <select name="tipe" id="pilih-neraca"
                class="py-2 w-[200px] px-4 appearance-none border-2 border-[#9A9A9A] rounded-xl cursor-pointer outline-none">
                <option disabled {{ request('tipe') ? '' : 'selected' }}>-Pilih Data Neraca-</option>
                <option value="neraca-lajur" {{ request('tipe') == 'neraca-lajur' ? 'selected' : '' }}>Neraca Lajur</option>
                <option value="neraca-saldo" {{ request('tipe') == 'neraca-saldo' ? 'selected' : '' }}>Neraca Saldo</option>
            </select>
        </div>
        <div class="{{ request('tipe') == 'neraca-lajur' ? '' : 'hidden' }}" id="neraca-lajur">
            <div class="flex justify-between items-center mb-2 max-[380px]:gap-2 max-[380px]:flex-wrap">
                <h1 class="text-2xl font-bold">Neraca Lajur</h1>
                <form action="{{ route('neracaOwner.index') }}" method="GET" class="flex items-center gap-x-2">
                    <input type="hidden" name="tipe" value="neraca-lajur">
                    <input type="text" name="start" data-flatpickr placeholder="Tgl Mulai"
                        value="{{ request('start') }}"
                        class="border-2 border-[#9A9A9A] px-4 py-2 rounded-lg w-[200px] outline-none">
                    <input type="text" name="end" data-flatpickr placeholder="Tgl Selesai"
                        value="{{ request('end') }}"
                        class="border-2 border-[#9A9A9A] px-4 py-2 rounded-lg w-[200px] outline-none">

                    <button type="submit" class="py-[10px] px-[10px] border-[#9A9A9A] border-2 rounded-lg cursor-pointer">
                        <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" class="w-[20px]">
                    </button>
                </form>

                {{-- <a target="_blank" href="{{ route('neracaLajur.print') }}" class="flex items-center gap-x-2 border-2 border-[#9A9A9A] rounded-lg px-4 py-2">
                    <span class="text-[#72686B]">Cetak Laporan</span>
                    <img src="{{ asset('assets/printer.png') }}" alt="">
                </a> --}}
            </div>
            <a href="{{ route('neracaLajur.print', ['start' => request('start'), 'end' => request('end')]) }}"
                target="_blank"
                class="py-[10px] px-[10px] border-[#9A9A9A] border-2 rounded-lg cursor-pointer flex items-center gap-x-2 w-fit ml-auto mb-5">
                <span class="text-gray-500">Cetak Laporan</span>
                <img src="{{ asset('assets/printer.png') }}" alt="search icon" class="w-[22px]">
            </a>
            <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6 max-[1200px]:overflow-x-scroll">
                <table class="table-fixed text-center text-sm w-full max-[1200px]:w-[1200px]">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <tr>
                            <th rowspan="2">Kode Akun</th>
                            <th rowspan="2">Nama Akun</th>
                            <th rowspan="2">POST Saldo</th>
                            <th colspan="2">Neraca Saldo</th>
                            <th rowspan="2">POST Laporan</th>
                            <th colspan="2">Laba Rugi</th>
                            <th colspan="2">Neraca</th>
                        </tr>
                        <tr>
                            <th>Debet</th>
                            <th>Kredit</th>
                            <th>Debet</th>
                            <th>Kredit</th>
                            <th>Debet</th>
                            <th>Kredit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assets as $item)
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">{{ $item->kode_akun }}</td>
                                <td class="py-2">{{ $item->nama_akun }}</td>
                                <td class="py-2">{{ $item->post_saldo }}</td>
                                <td class="py-2">Rp
                                    {{ number_format($item->post_laporan === 'NERACA' ? $item->debit_total : 0, 0, ',', '.') }}
                                </td>
                                <td class="py-2">Rp
                                    {{ number_format($item->post_laporan === 'NERACA' ? $item->kredit_total : 0, 0, ',', '.') }}
                                </td>
                                <td class="py-2">{{ $item->post_laporan }}</td>
                                <td class="py-2">Rp
                                    {{ number_format($item->post_laporan === 'LABA RUGI' ? $item->debit_total : 0, 0, ',', '.') }}
                                </td>
                                <td class="py-2">Rp
                                    {{ number_format($item->post_laporan === 'LABA RUGI' ? $item->kredit_total : 0, 0, ',', '.') }}
                                </td>
                                <td class="py-2">Rp
                                    {{ number_format($item->post_laporan === 'NERACA' ? $item->debit_total : 0, 0, ',', '.') }}
                                </td>
                                <td class="py-2">Rp
                                    {{ number_format($item->post_laporan === 'NERACA' ? $item->kredit_total : 0, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div id="neraca-saldo" class="{{ request('tipe') == 'neraca-saldo' ? '' : 'hidden' }}">
            <h1 class="font-bold text-2xl mb-5">Neraca Saldo</h1>
            <form action="{{ route('neracaOwner.index') }}" method="GET" class="flex items-center gap-x-2">
                <input type="hidden" name="tipe" value="neraca-saldo">
                <input type="text" name="start" data-flatpickr placeholder="Tgl Mulai" value="{{ request('start') }}"
                    class="border-2 border-[#9A9A9A] px-4 py-2 rounded-lg w-[200px] outline-none">
                <input type="text" name="end" data-flatpickr placeholder="Tgl Selesai" value="{{ request('end') }}"
                    class="border-2 border-[#9A9A9A] px-4 py-2 rounded-lg w-[200px] outline-none">

                <button type="submit" class="py-[10px] px-[10px] border-[#9A9A9A] border-2 rounded-lg cursor-pointer">
                    <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" class="w-[20px]">
                </button>
            </form>
            <a href="{{ route('neracaSaldo.print', ['start' => request('start'), 'end' => request('end')]) }}" target="_blank"
                class="py-[10px] px-[10px] border-[#9A9A9A] border-2 rounded-lg cursor-pointer flex items-center gap-x-2 w-fit mb-5 mt-2">
                <span class="text-gray-500">Cetak Laporan</span>
                <img src="{{ asset('assets/printer.png') }}" alt="" class="w-[22px]">
            </a>
            <div class="py-10 w-full rounded-xl shadow-[0px_0px_20px_rgba(0,0,0,0.1)] max-[630px]:overflow-x-scroll">
                <div class="max-[630px]:w-[630px]">
                    <div class="w-full flex bg-[#E9E9E9] py-2 px-6 mb-3">
                        <span class="font-bold w-[50%] max-[900px]:text-sm">ASSET LANCAR</span>
                        <span class="font-bold w-[50%] max-[900px]:text-sm">KEWAJIBAN/EKUITAS</span>
                    </div>
                    <div class="px-6 flex mb-3 max-[1250px]:gap-x-4">
                        <div class="w-[50%] flex flex-col gap-y-2">
                            @foreach ($kasFinal as $item)
                                <span
                                    class="w-full flex items-center justify-between max-[1320px]:gap-x-2 max-[830px]:flex-col max-[830px]:items-start">
                                    <p class="max-[1320px]:text-sm max-[830px]:text-base max-[630px]:text-sm">
                                        {{ $item['nama_perkiraan'] }}</p>
                                    <p
                                        class="w-[180px] text-[#9A9A9A] max-[1320px]:text-xs max-[1250px]:w-auto max-[830px]:text-base max-[630px]:text-sm">
                                        Rp. {{ number_format($item['total'], 0, ',', '.') }}</p>
                                </span>
                            @endforeach
                            @foreach ($lancarFinal as $item)
                                <span
                                    class="w-full flex items-center justify-between max-[1320px]:gap-x-2 max-[830px]:flex-col max-[830px]:items-start">
                                    <p class="max-[1320px]:text-sm max-[830px]:text-base max-[630px]:text-sm">
                                        {{ $item['nama_perkiraan'] }}</p>
                                    <p
                                        class="w-[180px] text-[#9A9A9A] max-[1320px]:text-xs max-[1250px]:w-auto max-[830px]:text-base max-[630px]:text-sm">
                                        Rp. {{ number_format($item['total'], 0, ',', '.') }}</p>
                                </span>
                            @endforeach
                        </div>
                        <div class="w-[50%] flex flex-col gap-y-2">
                            @foreach ($kewajibanFinal as $item)
                                <span
                                    class="w-full flex items-center justify-between max-[1320px]:gap-x-2 max-[830px]:flex-col max-[830px]:items-start">
                                    <p class="max-[1320px]:text-sm max-[830px]:text-base max-[630px]:text-sm">
                                        {{ $item['nama_perkiraan'] }}</p>
                                    <p
                                        class="w-[180px] text-[#9A9A9A] max-[1320px]:text-xs max-[1250px]:w-auto max-[830px]:text-base max-[630px]:text-sm">
                                        Rp. {{ number_format($item['total'], 0, ',', '.') }}</p>
                                </span>
                            @endforeach
                        </div>
                    </div>
                    <div class="w-full flex items-center bg-[#E9E9E9] py-2 px-6 mb-6 max-[900px]:gap-x-4">
                        <span
                            class="font-bold w-[50%] flex items-center justify-between max-[830px]:flex-col max-[830px]:items-start">
                            <p class="max-[1320px]:text-sm max-[830px]:text-base max-[630px]:text-sm">JUMLAH AKTIVA LANCAR
                            </p>
                            <p
                                class="w-[180px] max-[900px]:w-auto max-[900px]:text-xs max-[830px]:text-base max-[630px]:text-sm">
                                Rp. {{ number_format($totalLancar + $totalKas, 0, ',', '.') }}</p>
                        </span>
                        <span
                            class="font-bold w-[50%] flex items-center justify-between max-[830px]:flex-col max-[830px]:items-start">
                            <p class="max-[1320px]:text-sm max-[830px]:text-base max-[630px]:text-sm">JUMLAH KEWAJIBAN</p>
                            <p
                                class="w-[180px] max-[900px]:w-auto max-[900px]:text-xs max-[830px]:text-base max-[630px]:text-sm">
                                Rp. {{ number_format($totalKewajiban, 0, ',', '.') }}</p>
                        </span>
                    </div>
                    <div class="w-full flex bg-[#E9E9E9] py-2 px-6 mb-3">
                        <span class="font-bold w-[50%] max-[900px]:text-sm">AKTIVA TETAP</span>
                        <span class="font-bold w-[50%] max-[900px]:text-sm">MODAL</span>
                    </div>
                    <div class="px-6 flex mb-3 max-[1250px]:gap-x-4">
                        <div class="w-[50%] flex flex-col gap-y-2">
                            @foreach ($tetapFinal as $item)
                                <span
                                    class="w-full flex items-center justify-between max-[1320px]:gap-x-2 max-[830px]:flex-col max-[830px]:items-start">
                                    <p class="max-[1320px]:text-sm max-[830px]:text-base max-[630px]:text-sm">
                                        {{ $item['nama_perkiraan'] }}</p>
                                    <p
                                        class="w-[180px] text-[#9A9A9A] max-[1320px]:text-xs max-[1250px]:w-auto max-[830px]:text-base max-[630px]:text-sm">
                                        Rp. {{ number_format($item['total'], 0, ',', '.') }}</p>
                                </span>
                            @endforeach
                        </div>
                        <div class="w-[50%] flex flex-col gap-y-2">
                            <span
                                class="w-full flex items-center justify-between max-[1320px]:gap-x-2 max-[830px]:flex-col max-[830px]:items-start">
                                <p class="max-[1320px]:text-sm max-[830px]:text-base max-[630px]:text-sm">Modal</p>
                                <p
                                    class="w-[180px] text-[#9A9A9A] max-[1320px]:text-xs max-[1250px]:w-auto max-[830px]:text-base max-[630px]:text-sm">
                                    Rp. {{ number_format($saldoModal, 0, ',', '.') }}</p>
                            </span>

                            <span
                                class="w-full flex items-center justify-between max-[1320px]:gap-x-2 max-[830px]:flex-col max-[830px]:items-start">
                                <p class="max-[1320px]:text-sm max-[830px]:text-base max-[630px]:text-sm">Laba Ditahan</p>
                                <p
                                    class="w-[180px] text-[#9A9A9A] max-[1320px]:text-xs max-[1250px]:w-auto max-[830px]:text-base max-[630px]:text-sm">
                                    Rp. {{ number_format($labaDitahan, 0, ',', '.') }}</p>
                            </span>

                            <span
                                class="w-full flex items-center justify-between max-[1320px]:gap-x-2 max-[830px]:flex-col max-[830px]:items-start">
                                <p class="max-[1320px]:text-sm max-[830px]:text-base max-[630px]:text-sm">Laba Bulan
                                    Berjalan</p>
                                <p
                                    class="w-[180px] text-[#9A9A9A] max-[1320px]:text-xs max-[1250px]:w-auto max-[830px]:text-base max-[630px]:text-sm">
                                    Rp. {{ number_format($labaTahunBerjalan, 0, ',', '.') }}</p>
                            </span>
                        </div>
                    </div>
                    <div class="w-full flex bg-[#E9E9E9] max-[900px]:gap-x-4 py-2 px-6 mb-3">
                        <span
                            class="font-bold w-[50%] flex items-center justify-between max-[830px]:flex-col max-[830px]:items-start">
                            <p class="max-[1320px]:text-sm max-[830px]:text-base max-[630px]:text-sm">JUMLAH AKTIVA TETAP
                            </p>
                            <p
                                class="w-[180px] max-[900px]:w-auto max-[900px]:text-xs max-[830px]:text-base max-[630px]:text-sm">
                                Rp. {{ number_format($totalTetap, 0, ',', '.') }}</p>
                        </span>
                        <span
                            class="font-bold w-[50%] flex items-center justify-between max-[830px]:flex-col max-[830px]:items-start">
                            <p class="max-[1320px]:text-sm max-[830px]:text-base max-[630px]:text-sm">JUMLAH MODAL</p>
                            <p
                                class="w-[180px] max-[900px]:w-auto max-[900px]:text-xs max-[830px]:text-base max-[630px]:text-sm">
                                Rp. {{ number_format($saldoModal + $labaDitahan + $labaTahunBerjalan, 0, ',', '.') }}</p>
                        </span>
                    </div>
                    <div class="w-full flex bg-[#E9E9E9] max-[900px]:gap-x-4 py-2 px-6">
                        <span
                            class="font-bold w-[50%] flex items-center justify-between max-[830px]:flex-col max-[830px]:items-start">
                            <p class="max-[1320px]:text-sm max-[830px]:text-base max-[630px]:text-sm">TOTAL AKTIVA</p>
                            <p
                                class="w-[180px] max-[900px]:w-auto max-[900px]:text-xs max-[830px]:text-base max-[630px]:text-sm">
                                Rp. {{ number_format($totalTetap + $totalLancar + $totalKas, 0, ',', '.') }}</p>
                        </span>
                        <span
                            class="font-bold w-[50%] flex items-center justify-between max-[830px]:flex-col max-[830px]:items-start">
                            <p class="max-[1320px]:text-sm max-[830px]:text-base max-[630px]:text-sm">TOTAL PASIVA</p>
                            <p
                                class="w-[180px] max-[900px]:w-auto max-[900px]:text-xs max-[830px]:text-base max-[630px]:text-sm">
                                Rp. {{ number_format($saldoModal + $labaDitahan + $labaTahunBerjalan - $totalKewajiban, 0, ',', '.') }}
                            </p>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const selectNeraca = document.getElementById('pilih-neraca')
            const neracaLajur = document.getElementById('neraca-lajur')
            const neracaSaldo = document.getElementById('neraca-saldo')
            selectNeraca.addEventListener('change', () => {
                if (selectNeraca.value === 'neraca-lajur') {
                    neracaLajur.classList.remove('hidden')
                    neracaSaldo.classList.add('hidden')
                } else if (selectNeraca.value === 'neraca-saldo') {
                    neracaLajur.classList.add('hidden')
                    neracaSaldo.classList.remove('hidden')
                }

            })
        </script>
    </div>
@endsection
