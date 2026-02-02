@extends('admin.layout')
@section('content')
    <div>
        @if (session('success'))
            <div id="flash-message" data-type="success" data-message="{{ session('success') }}"></div>
        @endif
        <h1 class="font-bold text-2xl mb-6">Master Data</h1>
        <section class="flex flex-col">
            <div class="flex justify-between items-center pb-4">
                <div class="flex items-center gap-x-2">
                    <select name="" id="selectMasterData"
                        class="py-2 w-[200px] px-4 appearance-none border-2 border-[#9A9A9A] rounded-xl cursor-pointer outline-none">
                        <option disabled selected>-Pilih Data-</option>
                        <option value="data-asset">COA Akun</option>
                        {{-- <option value="data-piutang">Data Piutang</option> --}}
                        <option value="data-karyawan">Data Karyawan</option>
                        <option value="data-proyek">Data Proyek</option>
                        <option value="data-supplier">Data Supplier</option>
                    </select>
                    {{-- <label for="dropdown-toggle"
                        class="border-2 border-[#9A9A9A] rounded-xl select-none cursor-pointer w-[200px] z-[999] relative">
                        <div class="flex justify-between py-2 px-4 items-center">
                            <span>Tambah Data</span>
                            <img src="https://ar4n-group.com/public/assets/arrow-down.png" alt="arrow down icon"
                                id="icon-dropdown" class="w-[20px]">
                            <input type="checkbox" id="dropdown-toggle" class="hidden" />
                        </div>
                        <div class="absolute w-[200px] bg-white border-2 border-[#9A9A9A] shadow-lg top-12 rounded-lg hidden"
                            id="dropdown-menu"> --}}
                            {{-- <a href="{{ route('akun.create') }}" class="py-2 px-4 block hover:bg-[#E9E9E9]">
                                <p class="truncate">
                                    COA Akun
                                </p>
                            </a> --}}
                            {{-- <a href="{{ route('piutangHutang.create') }}" class="py-2 px-4 block hover:bg-[#E9E9E9]">
                                <p class="truncate">
                                    Piutang & Hutang Usaha
                                </p>
                            </a> --}}
                            {{-- <a href="{{ route('karyawan.create') }}" class="py-2 px-4 block hover:bg-[#E9E9E9]">
                                <p class="truncate">
                                    Karyawan
                                </p>
                            </a>
                            <a href="{{ route('proyek.create') }}" class="py-2 px-4 block hover:bg-[#E9E9E9]">
                                <p class="truncate">
                                    Proyek
                                </p>
                            </a>
                            <a href="{{ route('supplier.create') }}" class="py-2 px-4 block hover:bg-[#E9E9E9]">
                                <p class="truncate">
                                    Supplier
                                </p>
                            </a>
                        </div>
                    </label> --}}
                </div>
                <form id="searchForm" class="flex items-center gap-x-2">
                    <input type="text" id="searchInput" placeholder="Cari Data..."
                        class="border-[#9A9A9A] border-2 rounded-lg py-2 px-4 outline-none">
                    <button type="submit"
                        class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer"> <img
                            src="https://ar4n-group.com/public/assets/search-normal.png" alt="search icon" class="w-[20px]">
                    </button>
                </form>
            </div>
            <div class="h-[300px]" id="data-kosong"></div>
            <div class="flex-col pb-10 tabelMasterData hidden" id="data-asset">
                <h1 class="text-[#C0C0C0] font-bold text-xl">COA Akun</h1>
                <div
                    class="w-full flex flex-col justify-center py-8 gap-y-8 shadow-[1px_1px_5px_rgba(0,0,0,0.25)] rounded-lg mt-2 items-center">
                    <div class="flex flex-col w-[80%] gap-y-3">
                        <h1 class="text-[#C0C0C0] font-bold text-xl">Data Kas / Bank</h1>
                        <table class="table-fixed text-center w-full">
                            <thead class="border-b-2 border-[#CCCCCC]">
                                <th class="py-2 w-[10%]">No</th>
                                <th class="py-2 w-[15%]">Kode Akun</th>
                                <th class="py-2 w-[25%]">Nama Akun</th>
                                <th class="py-2 w-[20%]">Post Saldo</th>
                                <th class="py-2 w-[20%]">Post Laporan</th>
                                {{-- <th class="py-2 w-[20%]">Saldo</th> --}}
                                {{-- <th class="py-2 w-[20%]">Action</th> --}}
                            </thead>
                            <tbody>
                                @php
                                    $nobank = 1;
                                @endphp
                                @foreach ($banks as $lancar)
                                    <tr class="bg-white">
                                        <td class="py-2">{{ $nobank++ }}</td>
                                        <td class="py-2">{{ $lancar->kode_akun }}</td>
                                        <td class="py-2">{{ $lancar->nama_akun }}</td>
                                        <td class="py-2">{{ $lancar->post_saldo }}</td>
                                        <td class="py-2">{{ $lancar->post_laporan }}</td>
                                        {{-- <td class="py-2">{{ 'RP. ' . number_format($lancar->saldo, 0, ',', '.') }}</td> --}}
                                        {{-- <td class="flex justify-center items-center gap-x-2 py-2"> --}}
                                            {{-- Tombol Edit --}}
                                            {{-- <a href="{{ route('akun.edit', $lancar->id) }}" class="btn btn-sm btn-primary">
                                                <img src="https://ar4n-group.com/public/assets/more-circle.png"
                                                    alt="edit icon" class="w-[22px] cursor-pointer">
                                            </a>
                                            <span class="border-black border-l-[1px] h-[22px]"></span> --}}

                                            {{-- Tombol Delete --}}
                                            {{-- <form action="{{ route('akun.destroy', $lancar->id) }}" method="POST"
                                                class="h-[22px]">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                    <img src="https://ar4n-group.com/public/assets/close-circle.png"
                                                        alt="delete icon" class="w-[22px] cursor-pointer">
                                                </button>
                                            </form>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex flex-col w-[80%] gap-y-3">
                        <h1 class="text-[#C0C0C0] font-bold text-xl">Data Asset Lancar</h1>
                        <table class="table-fixed w-[80%] text-center w-full">
                            <thead class="border-b-2 border-[#CCCCCC]">
                                <th class="py-2 w-[10%]">No</th>
                                <th class="py-2 w-[15%]">Kode Akun</th>
                                <th class="py-2 w-[25%]">Nama Akun</th>
                                <th class="py-2 w-[20%]">Post Saldo</th>
                                <th class="py-2 w-[20%]">Post Laporan</th>
                                {{-- <th class="py-2 w-[20%]">Action</th> --}}
                            </thead>
                            <tbody>
                                @php
                                    $nolancar = 1;
                                @endphp
                                @foreach ($lancars as $lancar)
                                    <tr class="bg-white">
                                        <td class="py-2">{{ $nolancar++ }}</td>
                                        <td class="py-2">{{ $lancar->kode_akun }}</td>
                                        <td class="py-2">{{ $lancar->nama_akun }}</td>
                                        <td class="py-2">{{ $lancar->post_saldo }}</td>
                                        <td class="py-2">{{ $lancar->post_laporan }}</td>
                                        {{-- <td class="flex justify-center items-center gap-x-2 py-2"> --}}
                                            {{-- Tombol Edit --}}
                                            {{-- <a href="{{ route('akun.edit', $lancar->id) }}"
                                                class="btn btn-sm btn-primary">
                                                <img src="https://ar4n-group.com/public/assets/more-circle.png"
                                                    alt="edit icon" class="w-[22px] cursor-pointer">
                                            </a>
                                            <span class="border-black border-l-[1px] h-[22px]"></span> --}}

                                            {{-- Tombol Delete --}}
                                            {{-- <form action="{{ route('akun.destroy', $lancar->id) }}" method="POST"
                                                class="h-[22px]">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                    <img src="https://ar4n-group.com/public/assets/close-circle.png"
                                                        alt="delete icon" class="w-[22px] cursor-pointer">
                                                </button>
                                            </form>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex flex-col w-[80%] gap-y-3">
                        <h1 class="text-[#C0C0C0] font-bold text-xl">Data Asset Tetap</h1>
                        <table class="table-fixed w-[80%] text-center w-full">
                            <thead class="border-b-2 border-[#CCCCCC]">
                                <th class="py-2 w-[10%]">No</th>
                                <th class="py-2 w-[15%]">Kode Akun</th>
                                <th class="py-2 w-[25%]">Nama Akun</th>
                                <th class="py-2 w-[20%]">Post Saldo</th>
                                <th class="py-2 w-[20%]">Post Laporan</th>
                                {{-- <th class="py-2 w-[20%]">Action</th> --}}
                            </thead>
                            <tbody>
                                @php
                                    $notetap = 1;
                                @endphp
                                @foreach ($tetaps as $tetap)
                                    <tr class="bg-white">
                                        <td class="py-2">{{ $notetap++ }}</td>
                                        <td class="py-2">{{ $tetap->kode_akun }}</td>
                                        <td class="py-2">{{ $tetap->nama_akun }}</td>
                                        <td class="py-2">{{ $tetap->post_saldo }}</td>
                                        <td class="py-2">{{ $tetap->post_laporan }}</td>
                                        {{-- <td class="flex justify-center items-center gap-x-2 py-2"> --}}
                                            {{-- Tombol Edit --}}
                                            {{-- <a href="{{ route('akun.edit', $tetap->id) }}"
                                                class="btn btn-sm btn-primary">
                                                <img src="https://ar4n-group.com/public/assets/more-circle.png"
                                                    alt="edit icon" class="w-[22px] cursor-pointer">
                                            </a>
                                            <span class="border-black border-l-[1px] h-[22px]"></span> --}}

                                            {{-- Tombol Delete --}}
                                            {{-- <form action="{{ route('akun.destroy', $tetap->id) }}" method="POST"
                                                class="h-[22px]">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                    <img src="https://ar4n-group.com/public/assets/close-circle.png"
                                                        alt="delete icon" class="w-[22px] cursor-pointer">
                                                </button>
                                            </form>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex flex-col w-[80%] gap-y-3">
                        <h1 class="text-[#C0C0C0] font-bold text-xl">Data Kewajiban</h1>
                        <table class="table-fixed w-[80%] text-center w-full">
                            <thead class="border-b-2 border-[#CCCCCC]">
                                <th class="py-2 w-[10%]">No</th>
                                <th class="py-2 w-[15%]">Kode Akun</th>
                                <th class="py-2 w-[25%]">Nama Akun</th>
                                <th class="py-2 w-[20%]">Post Saldo</th>
                                <th class="py-2 w-[20%]">Post Laporan</th>
                                {{-- <th class="py-2 w-[20%]">Action</th> --}}
                            </thead>
                            <tbody>
                                @php
                                    $nokewajiban = 1;
                                @endphp
                                @foreach ($kewajibans as $kewajiban)
                                    <tr class="bg-white">
                                        <td class="py-2">{{ $nokewajiban++ }}</td>
                                        <td class="py-2">{{ $kewajiban->kode_akun }}</td>
                                        <td class="py-2">{{ $kewajiban->nama_akun }}</td>
                                        <td class="py-2">{{ $kewajiban->post_saldo }}</td>
                                        <td class="py-2">{{ $kewajiban->post_laporan }}</td>
                                        {{-- <td class="flex justify-center items-center gap-x-2 py-2"> --}}
                                            {{-- Tombol Edit --}}
                                            {{-- <a href="{{ route('akun.edit', $kewajiban->id) }}"
                                                class="btn btn-sm btn-primary">
                                                <img src="https://ar4n-group.com/public/assets/more-circle.png"
                                                    alt="edit icon" class="w-[22px] cursor-pointer">
                                            </a>
                                            <span class="border-black border-l-[1px] h-[22px]"></span> --}}

                                            {{-- Tombol Delete --}}
                                            {{-- <form action="{{ route('akun.destroy', $kewajiban->id) }}" method="POST"
                                                class="h-[22px]">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                    <img src="https://ar4n-group.com/public/assets/close-circle.png"
                                                        alt="delete icon" class="w-[22px] cursor-pointer">
                                                </button>
                                            </form>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex flex-col w-[80%] gap-y-3">
                        <h1 class="text-[#C0C0C0] font-bold text-xl">Data Ekuitas</h1>
                        <table class="table-fixed w-[80%] text-center w-full">
                            <thead class="border-b-2 border-[#CCCCCC]">
                                <th class="py-2 w-[10%]">No</th>
                                <th class="py-2 w-[15%]">Kode Akun</th>
                                <th class="py-2 w-[25%]">Nama Akun</th>
                                <th class="py-2 w-[20%]">Post Saldo</th>
                                <th class="py-2 w-[20%]">Post Laporan</th>
                                {{-- <th class="py-2 w-[20%]">Action</th> --}}
                            </thead>
                            <tbody>
                                @php
                                    $noekuitas = 1;
                                @endphp
                                @foreach ($ekuitass as $ekuitas)
                                    <tr class="bg-white">
                                        <td class="py-2">{{ $noekuitas++ }}</td>
                                        <td class="py-2">{{ $ekuitas->kode_akun }}</td>
                                        <td class="py-2">{{ $ekuitas->nama_akun }}</td>
                                        <td class="py-2">{{ $ekuitas->post_saldo }}</td>
                                        <td class="py-2">{{ $ekuitas->post_laporan }}</td>
                                        {{-- <td class="flex justify-center items-center gap-x-2 py-2"> --}}
                                            {{-- Tombol Edit --}}
                                            {{-- <a href="{{ route('akun.edit', $ekuitas->id) }}"
                                                class="btn btn-sm btn-primary">
                                                <img src="https://ar4n-group.com/public/assets/more-circle.png"
                                                    alt="edit icon" class="w-[22px] cursor-pointer">
                                            </a>
                                            <span class="border-black border-l-[1px] h-[22px]"></span> --}}

                                            {{-- Tombol Delete --}}
                                            {{-- <form action="{{ route('akun.destroy', $ekuitas->id) }}" method="POST"
                                                class="h-[22px]">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                    <img src="https://ar4n-group.com/public/assets/close-circle.png"
                                                        alt="delete icon" class="w-[22px] cursor-pointer">
                                                </button>
                                            </form>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex flex-col w-[80%] gap-y-3">
                        <h1 class="text-[#C0C0C0] font-bold text-xl">Data Pendapatan</h1>
                        <table class="table-fixed w-[80%] text-center w-full">
                            <thead class="border-b-2 border-[#CCCCCC]">
                                <th class="py-2 w-[10%]">No</th>
                                <th class="py-2 w-[15%]">Kode Akun</th>
                                <th class="py-2 w-[25%]">Nama Akun</th>
                                <th class="py-2 w-[20%]">Post Saldo</th>
                                <th class="py-2 w-[20%]">Post Laporan</th>
                                {{-- <th class="py-2 w-[20%]">Action</th> --}}
                            </thead>
                            <tbody>
                                @php
                                    $nopendapatan = 1;
                                @endphp
                                @foreach ($pendapatans as $pendapatan)
                                    <tr class="bg-white">
                                        <td class="py-2">{{ $nopendapatan++ }}</td>
                                        <td class="py-2">{{ $pendapatan->kode_akun }}</td>
                                        <td class="py-2">{{ $pendapatan->nama_akun }}</td>
                                        <td class="py-2">{{ $pendapatan->post_saldo }}</td>
                                        <td class="py-2">{{ $pendapatan->post_laporan }}</td>
                                        {{-- <td class="flex justify-center items-center gap-x-2 py-2"> --}}
                                            {{-- Tombol Edit --}}
                                            {{-- <a href="{{ route('akun.edit', $pendapatan->id) }}"
                                                class="btn btn-sm btn-primary">
                                                <img src="https://ar4n-group.com/public/assets/more-circle.png"
                                                    alt="edit icon" class="w-[22px] cursor-pointer">
                                            </a>
                                            <span class="border-black border-l-[1px] h-[22px]"></span> --}}

                                            {{-- Tombol Delete --}}
                                            {{-- <form action="{{ route('akun.destroy', $pendapatan->id) }}" method="POST"
                                                class="h-[22px]">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                    <img src="https://ar4n-group.com/public/assets/close-circle.png"
                                                        alt="delete icon" class="w-[22px] cursor-pointer">
                                                </button>
                                            </form>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex flex-col w-[80%] gap-y-3">
                        <h1 class="text-[#C0C0C0] font-bold text-xl">Data HPP Proyek</h1>
                        <table class="table-fixed w-[80%] text-center w-full">
                            <thead class="border-b-2 border-[#CCCCCC]">
                                <th class="py-2 w-[10%]">No</th>
                                <th class="py-2 w-[15%]">Kode Akun</th>
                                <th class="py-2 w-[25%]">Nama Akun</th>
                                <th class="py-2 w-[20%]">Post Saldo</th>
                                <th class="py-2 w-[20%]">Post Laporan</th>
                                {{-- <th class="py-2 w-[20%]">Action</th> --}}
                            </thead>
                            <tbody>
                                @php
                                    $nohpp = 1;
                                @endphp
                                @foreach ($hpps as $hpp)
                                    <tr class="bg-white">
                                        <td class="py-2">{{ $nohpp++ }}</td>
                                        <td class="py-2">{{ $hpp->kode_akun }}</td>
                                        <td class="py-2">{{ $hpp->nama_akun }}</td>
                                        <td class="py-2">{{ $hpp->post_saldo }}</td>
                                        <td class="py-2">{{ $hpp->post_laporan }}</td>
                                        {{-- <td class="flex justify-center items-center gap-x-2 py-2"> --}}
                                            {{-- Tombol Edit --}}
                                            {{-- <a href="{{ route('akun.edit', $hpp->id) }}" class="btn btn-sm btn-primary">
                                                <img src="https://ar4n-group.com/public/assets/more-circle.png"
                                                    alt="edit icon" class="w-[22px] cursor-pointer">
                                            </a>
                                            <span class="border-black border-l-[1px] h-[22px]"></span> --}}

                                            {{-- Tombol Delete --}}
                                            {{-- <form action="{{ route('akun.destroy', $hpp->id) }}" method="POST"
                                                class="h-[22px]">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                    <img src="https://ar4n-group.com/public/assets/close-circle.png"
                                                        alt="delete icon" class="w-[22px] cursor-pointer">
                                                </button>
                                            </form>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="flex-col pb-10 tabelMasterData hidden" id="data-karyawan">
                <div class="flex items-center justify-between">
                    <h1 class="text-[#C0C0C0] font-bold text-xl">Data Karyawan</h1>
                    <a href="{{ route('karyawan.create') }}" class="py-2 px-4 border border-gray-500 rounded-lg hover:bg-gray-500 hover:text-white">Tambah Data +</a>
                </div>
                <div class="w-full flex justify-center pt-2 pb-4 shadow-[1px_1px_5px_rgba(0,0,0,0.25)] rounded-lg mt-2">
                    <table class="table-fixed w-full text-center">
                        <thead class="border-b-2 border-[#CCCCCC]">
                            <th class="py-2 w-[10%]">No</th>
                            <th class="py-2 w-[8%]">Kode Akun</th>
                            <th class="py-2 w-[15%]">nama</th>
                            <th class="py-2 w-[20%]">alamat</th>
                            <th class="py-2 w-[15%]">No. HP</th>
                            <th class="py-2 w-[20%]">Email</th>
                            <th class="py-2 w-[20%]">Pekerja</th>
                            <th class="py-2 w-[20%]">Jabatan</th>
                            <th class="py-2 w-[20%]">Action</th>
                        </thead>
                        <tbody>
                            @php
                                $noKaryawan = 1;
                            @endphp
                            @foreach ($karyawans as $karyawan)
                                <tr class="bg-white">
                                    <td class="py-2">{{ $noKaryawan++ }}</td>
                                    <td class="py-2">{{ $karyawan->kode_akun }}</td>
                                    <td class="py-2">{{ $karyawan->nama }}</td>
                                    <td class="py-2">{{ $karyawan->alamat }}</td>
                                    <td class="py-2">{{ $karyawan->no_hp }}</td>
                                    <td class="py-2">{{ $karyawan->email }}</td>
                                    <td class="py-2">{{ $karyawan->pekerja ?? '-' }}</td>
                                    <td class="py-2">{{ $karyawan->jabatan ?? '-' }}</td>
                                    <td class="py-2">
                                        <div class="flex items-center justify-center gap-x-2">
                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('karyawan.edit', $karyawan->id) }}"
                                                class="btn btn-sm btn-primary">
                                                <img src="https://ar4n-group.com/public/assets/more-circle.png"
                                                    alt="edit icon" class="w-[22px] cursor-pointer">
                                            </a>
                                            <span class="border-black border-l-[1px] h-[22px]"></span>
                                            {{-- Tombol Delete --}}
                                            <form action="{{ route('karyawan.destroy', $karyawan->id) }}" method="POST"
                                                class="h-[22px]">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                    <img src="https://ar4n-group.com/public/assets/close-circle.png"
                                                        alt="delete icon" class="w-[22px] cursor-pointer">
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="flex-col pb-10 tabelMasterData hidden" id="data-proyek">
                <div class="flex items-center justify-between">
                    <h1 class="text-[#C0C0C0] font-bold text-xl">Proyek</h1>
                    <a href="{{ route('proyek.create') }}" class="py-2 px-4 border border-gray-500 rounded-lg hover:bg-gray-500 hover:text-white">Tambah Data +</a>
                </div>
                <div class="w-full flex justify-center pt-2 pb-4 shadow-[1px_1px_5px_rgba(0,0,0,0.25)] rounded-lg mt-2">
                    <table class="table-fixed w-[80%] text-center">
                        <thead class="border-b-2 border-[#CCCCCC]">
                            <th class="py-2 w-[10%]">No</th>
                            <th class="py-2 w-[15%]">Kode Akun</th>
                            <th class="py-2 w-[20%]">Nama Proyek</th>
                            <th class="py-2 w-[25%]">Perusahaan</th>
                            <th class="py-2 w-[25%]">Jenis Pekerjaan</th>
                            <th class="py-2 w-[25%]">Nilai Kontrak</th>
                            <th class="py-2 w-[20%]">Action</th>
                        </thead>
                        <tbody>
                            @php
                                $noProyek = 1;
                            @endphp
                            @foreach ($proyeks as $proyek)
                                <tr class="bg-white">
                                    <td class="py-2">{{ $noProyek++ }}</td>
                                    <td class="py-2">{{ $proyek->kode_akun }}</td>
                                    <td class="py-2">{{ $proyek->nama_proyek }}</td>
                                    <td class="py-2">{{ $proyek->nama_perusahaan }}</td>
                                    <td class="py-2">{{ $proyek->jenis }}</td>
                                    <td class="py-2">{{ 'RP. ' . number_format($proyek->nilai_kontrak, 0, ',', '.') }}</td>
                                    <td class="py-2">
                                        <div class="flex items-center justify-center gap-x-2">
                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('proyek.edit', $proyek->id) }}"
                                                class="btn btn-sm btn-primary">
                                                <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                                    class="w-[22px] cursor-pointer">
                                            </a>
                                            <span class="border-black border-l-[1px] h-[22px]"></span>
                                            {{-- Tombol Delete --}}
                                            <form action="{{ route('proyek.destroy', $proyek->id) }}" method="POST"
                                                class="h-[22px]">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                    <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                        class="w-[22px] cursor-pointer">
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="flex-col pb-10 tabelMasterData hidden" id="data-supplier">
                <div class="flex items-center justify-between">
                    <h1 class="text-[#C0C0C0] font-bold text-xl">Supplier</h1>
                    <a href="{{ route('supplier.create') }}" class="py-2 px-4 border border-gray-500 rounded-lg hover:bg-gray-500 hover:text-white">Tambah Data +</a>
                </div>
                <div class="w-full flex justify-center pt-2 pb-4 shadow-[1px_1px_5px_rgba(0,0,0,0.25)] rounded-lg mt-2">
                    <table class="table-fixed w-[80%] text-center">
                        <thead class="border-b-2 border-[#CCCCCC]">
                            <th class="py-2 w-[10%]">No</th>
                            <th class="py-2 w-[15%]">Kode Akun</th>
                            <th class="py-2 w-[20%]">Nama</th>
                            <th class="py-2 w-[25%]">Alamat</th>
                            <th class="py-2 w-[25%]">Marketing</th>
                            <th class="py-2 w-[25%]">No Hp</th>
                            <th class="py-2 w-[20%]">Action</th>
                        </thead>
                        <tbody>
                            @php
                                $nosup = 1;
                            @endphp
                            @foreach ($suppliers as $item)
                                <tr class="bg-white">
                                    <td class="py-2">{{ $nosup++ }}</td>
                                    <td class="py-2">{{ $item->kode_akun }}</td>
                                    <td class="py-2">{{ $item->nama }}</td>
                                    <td class="py-2">{{ $item->alamat }}</td>
                                    <td class="py-2">{{ $item->marketing }}</td>
                                    <td class="py-2">{{ $item->no_hp }}</td>
                                    <td class="py-2">
                                        <div class="flex items-center justify-center gap-x-2">
                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('supplier.edit', $item->id) }}"
                                                class="btn btn-sm btn-primary">
                                                <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                                    class="w-[22px] cursor-pointer">
                                            </a>
                                            <span class="border-black border-l-[1px] h-[22px]"></span>
                                            {{-- Tombol Delete --}}
                                            <form action="{{ route('supplier.destroy', $item->id) }}" method="POST"
                                                class="h-[22px]">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                    <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                        class="w-[22px] cursor-pointer">
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <script>
            const tabelMasterData = document.querySelectorAll('.tabelMasterData');
            const selectMasterData = document.getElementById('selectMasterData');
            const dataKosong = document.getElementById('data-kosong');
            const searchForm = document.getElementById('searchForm');
            const searchInput = document.getElementById('searchInput');

            // 🔹 Dropdown handler
            selectMasterData.addEventListener('change', () => {
                dataKosong.classList.add('hidden');
                tabelMasterData.forEach(tabel => {
                    if (selectMasterData.value === tabel.id) {
                        tabel.classList.remove('hidden');
                        tabel.classList.add('flex');
                        // reset semua baris kalau sebelumnya di-filter
                        tabel.querySelectorAll('tbody tr').forEach(row => row.classList.remove('hidden'));
                    } else {
                        tabel.classList.add('hidden');
                        tabel.classList.remove('flex');
                    }
                });
            });

            // 🔹 Search handler
            searchForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const keyword = searchInput.value.toLowerCase().trim();
                let found = false;

                tabelMasterData.forEach(tabel => {
                    const rows = tabel.querySelectorAll('tbody tr');
                    let matchCount = 0;

                    rows.forEach(row => {
                        const text = row.innerText.toLowerCase();
                        if (text.includes(keyword) && keyword !== "") {
                            row.classList.remove('hidden');
                            matchCount++;
                        } else {
                            row.classList.add('hidden');
                        }
                    });

                    if (matchCount > 0) {
                        tabel.classList.remove('hidden');
                        tabel.classList.add('flex');
                        selectMasterData.value = tabel.id;
                        found = true;
                    } else {
                        tabel.classList.add('hidden');
                        tabel.classList.remove('flex');
                    }
                });

                if (!found) {
                    dataKosong.classList.remove('hidden');
                } else {
                    dataKosong.classList.add('hidden');
                }
            });
        </script>

        <script src="https://ar4n-group.com/public/js/dropdown.js"></script>
    </div>
@endsection
