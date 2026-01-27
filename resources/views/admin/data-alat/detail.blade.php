@extends('admin.layout')
@section('content')
    <div>
        <div class="flex items-center justify-between mb-10">
            <h1 class="font-bold text-2xl">Detail Data Alat</h1>
            <div class="flex items-center gap-x-2 justify-center">
                <a href="{{ route('alatsAdmin.edit', $alat->id) }}" class="border border-gray-600 rounded-lg py-2 px-4">Edit Alat</a>
                <form action="{{ route('alatsAdmin.destroy', $alat->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin hapus data ini?')" class="border border-gray-600 rounded-lg py-2 px-4 cursor-pointer">
                        Hapus Alat
                    </button>
                </form>
            </div>
        </div>
        <div class="flex flex-col gap-y-7 pb-14 mb-8 border-b-2 border-[#B6B6B6]">
            <div class="flex mb-5 max-[900px]:mb-0 max-[900px]:flex-col max-[900px]:items-center">
                <span class="w-[150px] max-[900px]:text-center max-[900px]:hidden">Image</span>
                <span class="w-[150px] max-[900px]:text-center min-[900px]:hidden text-xl mb-3">Gambar Alat</span>
                <div class="flex gap-x-14 w-full max-[900px]:flex-col max-[900px]:items-center">
                    <img src="{{ asset('storage/' . $alat->foto) }}" alt="gambar alat"
                        class="w-44 h-44 object-cover rounded-md scale-125 max-[900px]:scale-100 max-[900px]:w-52 max-[900px]:h-52 max-[900px]:mb-7" />
                    <div class="flex flex-col w-full justify-between max-[900px]:gap-y-7">
                        <div class="flex items-center max-[900px]:flex-col max-[900px]:items-start max-[900px]:gap-y-2">
                            <span class="w-[200px]">Tanggal Masuk</span>
                            <div class="bg-[#D9D9D9]/40 h-fit px-5 py-2 w-full rounded-lg">
                                {{ $alat->tanggal ?? '-' }}

                            </div>
                        </div>
                        <div class="flex items-center max-[900px]:flex-col max-[900px]:items-start max-[900px]:gap-y-2">
                            <span class="w-[200px]">Nama alat</span>
                            <div class="bg-[#D9D9D9]/40 h-fit px-5 py-2 w-full rounded-lg">
                                {{ $alat->nama_alat }}
                            </div>
                        </div>
                        <div class="flex items-center max-[900px]:flex-col max-[900px]:items-start max-[900px]:gap-y-2">
                            <span class="w-[200px]">Kategori alat</span>
                            <div class="bg-[#D9D9D9]/40 h-fit px-5 py-2 w-full rounded-lg">
                                {{ $alat->kategori }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center max-[900px]:flex-col max-[900px]:items-start max-[900px]:gap-y-2">
                <span class="w-[120px]">Spesifikasi</span>
                <div class="bg-[#D9D9D9]/40 h-fit px-5 py-2 w-full rounded-lg">
                    {{ $alat->spesifikasi }}
                </div>
            </div>
            <div class="flex items-center max-[900px]:flex-col max-[900px]:items-start max-[900px]:gap-y-2">
                <span class="w-[120px]">Satuan</span>
                <div class="bg-[#D9D9D9]/40 h-fit px-5 py-2 w-full rounded-lg">
                    {{ $alat->satuan }}
                </div>
            </div>
            <div class="flex items-center max-[900px]:flex-col max-[900px]:items-start max-[900px]:gap-y-2">
                <span class="w-[120px]">Stok</span>
                <div class="bg-[#D9D9D9]/40 h-fit px-5 py-2 w-full rounded-lg">
                    {{ $alat->stok }}
                </div>
            </div>
            <div class="flex items-center max-[900px]:flex-col max-[900px]:items-start max-[900px]:gap-y-2">
                <span class="w-[110px]"></span>
                <button class=" border border-blue-500 text-blue-500 px-5 py-2 rounded-lg cursor-pointer hover:bg-blue-500 hover:text-white" onclick="detailRiwayat({{ json_encode($catatStok) }})">Lihat Riwayat</button>
            </div>
        </div>
        <div class="flex justify-between items-center mb-10 max-[600px]:flex-wrap max-[600px]:gap-y-2 max-[600px]:gap-x-2">
            <div class="flex items-center gap-x-2">
                <a href="{{ route('alat-beli-admin.create.for-alat', $alat->kode_alat) }}"
                    class="block text-white bg-green-400 rounded-lg w-fit py-2 px-5">Alat Masuk</a>
                <a href="{{ route('alat-hapus-admin.create.for-alat', $alat->kode_alat) }}"
                    class="block text-white bg-green-400 rounded-lg w-fit py-2 px-5">Alat Keluar(hilang/rusak)</a>
            </div>
           <div class="flex items-center gap-x-2">
                <a href="{{ route('alat-pinjam-admin.create.for-alat', $alat->kode_alat) }}"
                    class="block text-white bg-blue-400 rounded-lg w-fit py-2 px-5">Diambil Alat</a>
                <a href="{{ route('alat-kembalikan-admin.create.for-alat', $alat->kode_alat) }}"
                    class="text-white bg-blue-400 rounded-lg w-fit py-2 px-5 flex items-center gap-x-2">Dikembalikan Alat</a>
           </div>
        </div>
        <div class="border-b-2 border-[#B6B6B6] pb-8 mb-10">
            <h1 class="font-bold text-2xl mb-6">Data Alat Masuk</h1>
            {{-- Barang Masuk --}}
            <form method="GET" action="{{ route('alatsAdmin.show', $alat->id) }}" class="flex gap-x-2 mb-4 max-[600px]:flex-wrap max-[600px]:gap-y-2">
                <input type="text" data-flatpickr placeholder="Pilih tanggal awal" name="start_dibeli" value="{{ request('start_dibeli') }}"
                    class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2">
                <input type="text" data-flatpickr placeholder="Pilih tanggal akhir" name="end_dibeli" value="{{ request('end_dibeli') }}"
                    class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2">
                <button type="submit" class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2 bg-white max-[600px]:hidden">
                    <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" />
                </button>
                {{-- Print Barang Masuk --}}
                <a href="{{ route('alatsAdmin.printDibeli', ['id' => $alat->id, 'start_dibeli' => request('start_dibeli'), 'end_dibeli' => request('end_dibeli')]) }}"
                    target="_blank"
                    class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer max-[600px]:hidden">
                    <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                </a>
                <div class="min-[600px]:hidden flex gap-x-2">
                    <button type="submit" class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2 bg-white">
                        <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" />
                    </button>
                    {{-- Print Barang Masuk --}}
                    <a href="{{ route('alatsAdmin.printDibeli', ['id' => $alat->id, 'start_dibeli' => request('start_dibeli'), 'end_dibeli' => request('end_dibeli')]) }}"
                        target="_blank"
                        class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                        <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                    </a>
                </div>
            </form>
            <div class="rounded-lg shadow-[1px_1px_10px_rgba(0,0,0,0.1)] pt-4 pb-6 max-[900px]:overflow-x-scroll">
                <table class="table-fixed text-center text-sm w-full max-[900px]:w-[900px]">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[20%]">No</th>
                        <th class="py-2 w-[20%]">Tanggal</th>
                        <th class="py-2 w-[20%]">Qty</th>
                        <th class="py-2 w-[20%]">Keterangan</th>
                        <th class="py-2 w-[25%]">Action</th>
                    </thead>
                    <tbody>
                        @php
                            $nomasuk = 1;
                        @endphp
                        @foreach ($alatDibelis as $item)
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">{{ $nomasuk++ }}</td>
                                <td class="py-2">{{ $item->tanggal }}</td>
                                <td class="py-2">{{ $item->qty }}</td>
                                <td class="py-2">{{ $item->keterangan }}</td>
                                <td class="py-2">
                                    <div class="flex justify-center items-center gap-x-2 ">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('alat-beli-admin.edit', $item->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                                class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        {{-- Tombol Delete --}}
                                        <form action="{{ route('alat-beli-admin.destroy', $item->id) }}" method="POST"
                                            class="h-[22px]">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                    class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        {{-- Tombol Print --}}
                                        <a target="_blank" href="{{ route('print-beli-detail-admin.print', ['tanggal' => $item->tanggal, 'qty' => $item->qty, 'keterangan' => $item->keterangan]) }}">
                                            <img src="{{ asset('assets/printer-oren.png') }}" alt="print icon">
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="border-b-2 border-[#B6B6B6] pb-8 mb-10">
            <h1 class="font-bold text-2xl mb-6">Data Alat Keluar</h1>
            {{-- Barang Masuk --}}
            <form method="GET" action="{{ route('alatsAdmin.show', $alat->id) }}" class="flex gap-x-2 mb-4 max-[600px]:flex-wrap max-[600px]:gap-y-2">
                <input type="text" data-flatpickr placeholder="Pilih tanggal awal" name="start_dihapus" value="{{ request('start_dihapus') }}"
                    class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2">
                <input type="text" data-flatpickr placeholder="Pilih tanggal akhir" name="end_dihapus" value="{{ request('end_dihapus') }}"
                    class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2">
                <button type="submit" class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2 bg-white max-[600px]:hidden">
                    <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" />
                </button>
                {{-- Print Barang Masuk --}}
                <a href="{{ route('alatsAdmin.printDihapus', ['id' => $alat->id, 'start_dihapus' => request('start_dihapus'), 'end_dihapus' => request('end_dihapus')]) }}"
                    target="_blank"
                    class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer max-[600px]:hidden">
                    <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                </a>
                <div class="min-[600px]:hidden flex gap-x-2">
                    <button type="submit" class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2 bg-white">
                        <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" />
                    </button>
                    {{-- Print Barang Masuk --}}
                    <a href="{{ route('alatsAdmin.printDihapus', ['id' => $alat->id, 'start_dihapus' => request('start_dihapus'), 'end_dihapus' => request('end_dihapus')]) }}"
                        target="_blank"
                        class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                        <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                    </a>
                </div>
            </form>
            <div class="rounded-lg shadow-[1px_1px_10px_rgba(0,0,0,0.1)] pt-4 pb-6 max-[900px]:overflow-x-scroll">
                <table class="table-fixed text-center text-sm w-full max-[900px]:w-[900px]">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[20%]">No</th>
                        <th class="py-2 w-[20%]">Tanggal</th>
                        <th class="py-2 w-[20%]">Qty</th>
                        <th class="py-2 w-[20%]">Keterangan</th>
                        <th class="py-2 w-[25%]">Action</th>
                    </thead>
                    <tbody>
                        @php
                            $nomasuk = 1;
                        @endphp
                        @foreach ($alatDihapus as $item)
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">{{ $nomasuk++ }}</td>
                                <td class="py-2">{{ $item->tanggal }}</td>
                                <td class="py-2">{{ $item->qty }}</td>
                                <td class="py-2">{{ $item->keterangan }}</td>
                                <td class="py-2">
                                    <div class="flex justify-center items-center gap-x-2 ">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('alat-hapus-admin.edit', $item->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                                class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        {{-- Tombol Delete --}}
                                        <form action="{{ route('alat-hapus-admin.destroy', $item->id) }}" method="POST"
                                            class="h-[22px]">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                    class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        {{-- Tombol Print --}}
                                        <a target="_blank" href="{{ route('print-hapus-detail-admin.print', ['tanggal' => $item->tanggal, 'qty' => $item->qty, 'keterangan' => $item->keterangan]) }}">
                                            <img src="{{ asset('assets/printer-oren.png') }}" alt="print icon">
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="border-b-2 border-[#B6B6B6] pb-8 mb-10">
            <h1 class="font-bold text-2xl mb-6">Data Diambil Alat</h1>
            {{-- Barang Keluar --}}
            <form method="GET" action="{{ route('alatsAdmin.show', $alat->id) }}" class="flex gap-x-2 mb-4 max-[600px]:flex-wrap max-[600px]:gap-y-2">
                <input type="text" data-flatpickr placeholder="Pilih tanggal awal" name="start_dipinjam" value="{{ request('start_dipinjam') }}"
                    class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2">
                <input type="text" data-flatpickr placeholder="Pilih tanggal akhir" name="end_dipinjam" value="{{ request('end_dipinjam') }}"
                    class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2">
                <button type="submit" class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2 bg-white max-[600px]:hidden">
                    <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" />
                </button>
                {{-- Print Barang Keluar --}}
                <a href="{{ route('alatsAdmin.printDipinjam', ['id' => $alat->id, 'start_dipinjam' => request('start_dipinjam'), 'end_dipinjam' => request('end_dipinjam')]) }}"
                    target="_blank"
                    class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer max-[600px]:hidden">
                    <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                </a>
                <div class="min-[600px]:hidden flex gap-x-2">
                    <button type="submit" class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2 bg-white">
                        <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" />
                    </button>
                    {{-- Print Barang Keluar --}}
                    <a href="{{ route('alatsAdmin.printDipinjam', ['id' => $alat->id, 'start_dipinjam' => request('start_dipinjam'), 'end_dipinjam' => request('end_dipinjam')]) }}"
                        target="_blank"
                        class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                        <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                    </a>
                </div>
            </form>
            <div class="rounded-lg shadow-[1px_1px_10px_rgba(0,0,0,0.1)] pt-4 pb-6 max-[900px]:overflow-x-scroll">
                <table class="table-fixed text-center text-sm w-full max-[900px]:w-[900px]">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[20%]">No</th>
                        <th class="py-2 w-[20%]">Tanggal</th>
                        <th class="py-2 w-[20%]">Proyek</th>
                        <th class="py-2 w-[20%]">PIC</th>
                        <th class="py-2 w-[20%]">Qty</th>
                        <th class="py-2 w-[20%]">Keterangan</th>
                        <th class="py-2 w-[25%]">Action</th>
                    </thead>
                    <tbody>
                        @php
                            $nokeluar = 1;
                        @endphp
                        @foreach ($alatDipinjams as $item)
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">{{ $nokeluar++ }}</td>
                                <td class="py-2">{{ $item->tanggal }}</td>
                                {{-- Cari proyek yang kode_akun-nya sama dengan item --}}
                                @php 
                                    $proyekCocok = $proyeks->where('kode_akun', $item->kode_akun)->first(); 
                                @endphp

                                @if ($proyekCocok)
                                    <td class="py-2">{{ $proyekCocok->nama_proyek }}</td>
                                    <td class="py-2">{{ $proyekCocok->pic }}</td>
                                @else
                                    <td class="py-2 text-red-500">Proyek Tidak Ditemukan</td>
                                    <td class="py-2">-</td>
                                @endif
                                <td class="py-2">{{ $item->qty }}</td>
                                <td class="py-2">{{ $item->keterangan }}</td>
                                <td class="py-2">
                                    <div class="flex justify-center items-center gap-x-2 ">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('alat-pinjam-admin.edit', $item->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                                class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        {{-- Tombol Delete --}}
                                        <form action="{{ route('alat-pinjam-admin.destroy', $item->id) }}" method="POST"
                                            class="h-[22px]">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                    class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        {{-- Tombol Print --}}
                                        <a target="_blank" href="{{ route('print-pinjam-detail-admin.print', ['tanggal' => $item->tanggal, 'proyek' => $proyekCocok->nama_proyek, 'pic' => $proyekCocok->pic, 'qty' => $item->qty, 'keterangan' => $item->keterangan]) }}">
                                            <img src="{{ asset('assets/printer-oren.png') }}" alt="print icon">
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="border-b-2 border-[#B6B6B6] pb-8 mb-10">
            <h1 class="font-bold text-2xl mb-6">Data Pengembalian</h1>
            {{-- Barang Retur --}}
            <form method="GET" action="{{ route('alatsAdmin.show', $alat->id) }}" class="flex gap-x-2 mb-4 max-[600px]:flex-wrap max-[600px]:gap-y-2">
                <input type="text" data-flatpickr placeholder="Pilih tanggal awal" name="start_dikembalikan" value="{{ request('start_dikembalikan') }}"
                    class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2">
                <input type="text" data-flatpickr placeholder="Pilih tanggal akhir" name="end_dikembalikan" value="{{ request('end_dikembalikan') }}"
                    class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2">
                <button type="submit" class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2 bg-white max-[600px]:hidden">
                    <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" />
                </button>
                {{-- Print Barang Retur --}}
                <a href="{{ route('alatsAdmin.printDikembalikan', ['id' => $alat->id, 'start_dikembalikan' => request('start_dikembalikan'), 'end_dikembalikan' => request('end_dikembalikan')]) }}"
                    target="_blank"
                    class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer max-[600px]:hidden">
                    <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                </a>
                <div class="min-[600px]:hidden flex gap-x-2">
                    <button type="submit" class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2 bg-white">
                        <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" />
                    </button>
                    {{-- Print Barang Retur --}}
                    <a href="{{ route('alatsAdmin.printDikembalikan', ['id' => $alat->id, 'start_dikembalikan' => request('start_dikembalikan'), 'end_dikembalikan' => request('end_dikembalikan')]) }}"
                        target="_blank"
                        class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                        <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                    </a>
                </div>
            </form>
            <div class="rounded-lg shadow-[1px_1px_10px_rgba(0,0,0,0.1)] pt-4 pb-6 max-[900px]:overflow-x-scroll">
                <table class="table-fixed text-center text-sm w-full max-[900px]:w-[900px]">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[20%]">No</th>
                        <th class="py-2 w-[20%]">Tanggal</th>
                        <th class="py-2 w-[20%]">Proyek</th>
                        <th class="py-2 w-[20%]">PIC</th>
                        <th class="py-2 w-[20%]">Qty</th>
                        <th class="py-2 w-[20%]">Keterangan</th>
                        <th class="py-2 w-[25%]">Action</th>
                    </thead>
                    <tbody>
                        @php
                            $noretur = 1;
                        @endphp
                        @foreach ($alatDikembalikans as $item)
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">{{ $noretur++ }}</td>
                                <td class="py-2">{{ $item->tanggal }}</td>
                                {{-- Cari proyek yang kode_akun-nya sama dengan item --}}
                                @php 
                                    $proyekCocok = $proyeks->where('kode_akun', $item->kode_akun)->first(); 
                                @endphp

                                @if ($proyekCocok)
                                    <td class="py-2">{{ $proyekCocok->nama_proyek }}</td>
                                    <td class="py-2">{{ $proyekCocok->pic }}</td>
                                @else
                                    <td class="py-2 text-red-500">Proyek Tidak Ditemukan</td>
                                    <td class="py-2">-</td>
                                @endif
                                <td class="py-2">{{ $item->qty }}</td>
                                <td class="py-2">{{ $item->keterangan }}</td>
                                <td class="py-2">
                                    <div class="flex justify-center items-center gap-x-2 ">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('alat-kembalikan-admin.edit', $item->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                                class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        {{-- Tombol Delete --}}
                                        <form action="{{ route('alat-kembalikan-admin.destroy', $item->id) }}" method="POST"
                                            class="h-[22px]">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                    class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        {{-- Tombol Print --}}
                                        <a target="_blank" href="{{ route('print-kembali-detail-admin.print', ['tanggal' => $item->tanggal, 'proyek' => $proyekCocok->nama_proyek, 'pic' => $proyekCocok->pic, 'qty' => $item->qty, 'keterangan' => $item->keterangan]) }}">
                                            <img src="{{ asset('assets/printer-oren.png') }}" alt="print icon">
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            function detailRiwayat(items) { // Kita namakan 'items' karena isinya array
                // Buat HTML untuk setiap baris riwayat
                const listHtml = items.map(item => `
                    <div class="mb-4 pb-4 border-b border-gray-100 last:border-0">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex flex-col">
                                <span class="text-gray-500 font-semibold uppercase text-[10px]">Tanggal</span>
                                <span class="text-gray-800 text-sm font-medium">${item.tanggal}</span>
                            </div>
                            <div class="flex flex-col text-right">
                                <span class="text-gray-500 font-semibold uppercase text-[10px]">Jumlah</span>
                                <span class="text-sm font-bold text-blue-500">
                                    ${item.qty}
                                </span>
                            </div>
                            ${item.proyek ? `
                             <div class="flex flex-col text-left">
                                <span class="text-gray-500 font-semibold uppercase text-[10px]">Proyek</span>
                                <span class="text-gray-800 text-sm font-medium">
                                    ${item.proyek}
                                </span>
                            </div>
                             <div class="flex flex-col text-right">
                                <span class="text-gray-500 font-semibold uppercase text-[10px]">PIC</span>
                                <span class="text-gray-800 text-sm font-medium">
                                    ${item.pic}
                                </span>
                            </div>
                            ` : ''}
                        </div>
                        <div class="mt-2 p-2 bg-gray-50 rounded text-xs italic">
                            "${item.keterangan}"
                        </div>
                    </div>
                `).join('');

                Swal.fire({
                    title: 'Riwayat Pergerakan Stok Alat',
                    html: `
                        <div class="max-h-[60vh] overflow-y-auto px-2 text-left">
                            ${listHtml}
                        </div>
                    `,
                    width: '500px',
                    confirmButtonText: 'Tutup',
                    confirmButtonColor: '#3B82F6',
                    customClass: { popup: 'rounded-2xl' }
                });
            }
        </script>
    </div>
@endsection
