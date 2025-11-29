@extends('admin.layout')
@section('content')
    <div>
        @if (session('success'))
            <div
                id="flash-message"
                data-type="success"
                data-message="{{ session('success') }}"
            ></div>
        @endif
        <h1 class="font-bold text-2xl mb-6">Master Data</h1>
        <section class="flex flex-col">
            <div class="flex justify-between items-center pb-4">
                <label for="dropdown-toggle"
                    class="bg-[#FFF494] select-none shadow-[0px_0px_15px_rgba(0,0,0,0.25)] rounded-lg cursor-pointer w-[180px] relative">
                    <div class="flex justify-between py-2 px-4 items-center">
                        <span>Tambah Data</span>
                        <img src="{{ asset('assets/arrow-down.png') }}" alt="arrow down icon" id="icon-dropdown"
                            class="w-[20px]">
                        <input type="checkbox" id="dropdown-toggle" class="hidden" />
                    </div>
                    <div class="absolute w-[180px] bg-[#FFF494] shadow-2xl rounded-b-lg top-9 hidden" id="dropdown-menu">
                        <a href="{{ route('akun.create') }}" class="py-2 px-4 block hover:bg-[#E9E9E9]">
                            <p class="truncate">
                                Asset Lancar, Asset Tetap, Kewajiban, Ekuitas, Pendatan & HPP Proyek
                            </p>
                        </a>
                        <a href="{{ route('piutangHutang.create') }}" class="py-2 px-4 block hover:bg-[#E9E9E9]">
                            <p class="truncate">
                                Piutang & Hutang Usaha
                            </p>
                        </a>
                        <a href="{{ route('karyawan.create') }}" class="py-2 px-4 block hover:bg-[#E9E9E9]">
                            <p class="truncate">
                                Karyawan
                            </p>
                        </a>
                        <a href="{{ route('proyek.create') }}" class="py-2 px-4 block hover:bg-[#E9E9E9]">
                            <p class="truncate">
                                Proyek
                            </p>
                        </a>
                    </div>
                </label>
                <form action="" class="flex items-center gap-x-2">
                    <input type="text" name="" id="" placeholder="Cari Data..."
                        class="border-[#9A9A9A] border-2 rounded-lg py-2 px-4 outline-none">
                    <button type="submit"
                        class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                        <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" class="w-[20px]">
                    </button>
                </form>
            </div>
            <div class="flex flex-col pb-4">
                <h1 class="text-[#C0C0C0] font-bold text-xl">Data Asset Lancar, Asset Tetap, Kewajiban, Ekuitas, Pendatan &
                    HPP Proyek</h1>
                <div class="w-full flex flex-col justify-center py-8 gap-y-8 shadow-[1px_1px_5px_rgba(0,0,0,0.25)] rounded-lg mt-2 items-center">
                    <div class="flex flex-col w-[80%] gap-y-3">
                    <h1 class="text-[#C0C0C0] font-bold text-xl">Data Asset Lancar</h1>
                    <table class="table-fixed w-[80%] text-center w-full">
                        <thead class="border-b-2 border-[#CCCCCC]">
                            <th class="py-2 w-[10%]">No</th>
                            <th class="py-2 w-[15%]">Kode Akun</th>
                            <th class="py-2 w-[25%]">Nama Akun</th>
                            <th class="py-2 w-[20%]">Post Saldo</th>
                            <th class="py-2 w-[20%]">Post Laporan</th>
                            <th class="py-2 w-[20%]">Action</th>
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
                                    <td class="flex justify-center items-center gap-x-2 py-2">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('akun.edit', $lancar->id) }}" class="btn btn-sm btn-primary">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                                class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>

                                        {{-- Tombol Delete --}}
                                        <form action="{{ route('akun.destroy', $lancar->id) }}" method="POST"
                                            class="h-[22px]">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                    class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                    </td>
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
                            <th class="py-2 w-[20%]">Action</th>
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
                                    <td class="flex justify-center items-center gap-x-2 py-2">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('akun.edit', $tetap->id) }}" class="btn btn-sm btn-primary">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                                class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>

                                        {{-- Tombol Delete --}}
                                        <form action="{{ route('akun.destroy', $tetap->id) }}" method="POST"
                                            class="h-[22px]">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                    class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                    </td>
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
                            <th class="py-2 w-[20%]">Action</th>
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
                                    <td class="flex justify-center items-center gap-x-2 py-2">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('akun.edit', $kewajiban->id) }}" class="btn btn-sm btn-primary">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                                class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>

                                        {{-- Tombol Delete --}}
                                        <form action="{{ route('akun.destroy', $kewajiban->id) }}" method="POST"
                                            class="h-[22px]">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                    class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                    </td>
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
                            <th class="py-2 w-[20%]">Action</th>
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
                                    <td class="flex justify-center items-center gap-x-2 py-2">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('akun.edit', $ekuitas->id) }}" class="btn btn-sm btn-primary">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                                class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>

                                        {{-- Tombol Delete --}}
                                        <form action="{{ route('akun.destroy', $ekuitas->id) }}" method="POST"
                                            class="h-[22px]">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                    class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                    </td>
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
                            <th class="py-2 w-[20%]">Action</th>
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
                                    <td class="flex justify-center items-center gap-x-2 py-2">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('akun.edit', $pendapatan->id) }}" class="btn btn-sm btn-primary">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                                class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>

                                        {{-- Tombol Delete --}}
                                        <form action="{{ route('akun.destroy', $pendapatan->id) }}" method="POST"
                                            class="h-[22px]">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                    class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                    </td>
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
                            <th class="py-2 w-[20%]">Action</th>
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
                                    <td class="flex justify-center items-center gap-x-2 py-2">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('akun.edit', $hpp->id) }}" class="btn btn-sm btn-primary">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                                class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>

                                        {{-- Tombol Delete --}}
                                        <form action="{{ route('akun.destroy', $hpp->id) }}" method="POST"
                                            class="h-[22px]">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                    class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <div class="flex flex-col pb-4">
                <h1 class="text-[#C0C0C0] font-bold text-xl">Piutang & Hutang Usaha</h1>
                <div class="w-full flex justify-center pt-2 pb-4 shadow-[1px_1px_5px_rgba(0,0,0,0.25)] rounded-lg mt-2">
                    <table class="table-fixed w-[80%] text-center">
                        <thead class="border-b-2 border-[#CCCCCC]">
                            <th class="py-2 w-[10%]">No</th>
                            <th class="py-2 w-[15%]">Kode Akun</th>
                            <th class="py-2 w-[25%]">Nama Akun</th>
                            <th class="py-2 w-[20%]">Akun Header</th>
                            <th class="py-2 w-[20%]">Action</th>
                        </thead>
                        <tbody>
                            @php
                                $noPiutang = 1;
                            @endphp
                            @foreach ($piutangHutangs as $piutangHutang)
                                <tr class="bg-white">
                                    <td class="py-2">{{ $noPiutang++ }}</td>
                                    <td class="py-2">{{ $piutangHutang->kode_akun }}</td>
                                    <td class="py-2">{{ $piutangHutang->nama_akun }}</td>
                                    <td class="py-2">{{ $piutangHutang->akun_header }}</td>
                                    <td class="flex justify-center items-center gap-x-2 py-2">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('piutangHutang.edit', $piutangHutang->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                                class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        {{-- Tombol Delete --}}
                                        <form action="{{ route('piutangHutang.destroy', $piutangHutang->id) }}"
                                            method="POST" class="h-[22px]">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                    class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="flex flex-col pb-4">
                <h1 class="text-[#C0C0C0] font-bold text-xl">Data Karyawan</h1>
                <div class="w-full flex justify-center pt-2 pb-4 shadow-[1px_1px_5px_rgba(0,0,0,0.25)] rounded-lg mt-2">
                    <table class="table-fixed w-[80%] text-center">
                        <thead class="border-b-2 border-[#CCCCCC]">
                            <th class="py-2 w-[10%]">No</th>
                            <th class="py-2 w-[15%]">Kode Akun</th>
                            <th class="py-2 w-[10%]">nama</th>
                            <th class="py-2 w-[20%]">alamat</th>
                            <th class="py-2 w-[15%]">No. HP</th>
                            <th class="py-2 w-[15%]">Email</th>
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
                                    <td class="flex justify-center items-center gap-x-2 py-2">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('karyawan.edit', $karyawan->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                                class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        {{-- Tombol Delete --}}
                                        <form action="{{ route('karyawan.destroy', $karyawan->id) }}" method="POST"
                                            class="h-[22px]">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                    class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="flex flex-col pb-4">
                <h1 class="text-[#C0C0C0] font-bold text-xl">Proyek</h1>
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
                                    <td class="flex justify-center items-center gap-x-2 py-2">
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
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <script src="{{ asset('js/dropdown.js') }}"></script>
    </div>
@endsection
