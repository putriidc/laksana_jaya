@extends('admin.layout')
@section('content')
    <div>
        <div class="flex items-center justify-between mb-10">
            <h1 class="font-bold text-2xl">Detail Data Barang</h1>
            <div class="flex items-center gap-x-2 justify-center">
                <a href="{{ route('barangsAdmin.edit', $barang->id) }}" class="border border-gray-600 rounded-lg py-2 px-4">Edit Barang</a>
                <form action="{{ route('barangsAdmin.destroy', $barang->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin hapus data ini?')" class="border border-gray-600 rounded-lg py-2 px-4 cursor-pointer">
                        Hapus Barang
                    </button>
                </form>
            </div>
        </div>
        <div class="flex flex-col gap-y-7 pb-14 mb-8 border-b-2 border-[#B6B6B6]">
            <div class="flex mb-5 max-[900px]:mb-0 max-[900px]:flex-col max-[900px]:items-center">
                <span class="w-[150px] max-[900px]:text-center max-[900px]:hidden">Image</span>
                <span class="w-[150px] max-[900px]:text-center min-[900px]:hidden text-xl mb-3">Gambar Barang</span>
                <div class="flex gap-x-14 w-full max-[900px]:flex-col max-[900px]:items-center">
                    <img src="{{ asset('storage/' . $barang->foto) }}" alt="gambar barang"
                        class="w-44 h-44 object-cover rounded-md scale-125 max-[900px]:scale-100 max-[900px]:w-52 max-[900px]:h-52 max-[900px]:mb-7" />
                    <div class="flex flex-col w-full justify-between max-[900px]:gap-y-7">
                        <div class="flex items-center max-[900px]:flex-col max-[900px]:items-start max-[900px]:gap-y-2">
                            <span class="w-[200px]">Tanggal Masuk</span>
                            <div class="bg-[#D9D9D9]/40 h-fit px-5 py-2 w-full rounded-lg">
                                {{ $barang->tanggal ?? '-' }}
                            </div>
                        </div>
                        <div class="flex items-center max-[900px]:flex-col max-[900px]:items-start max-[900px]:gap-y-2">
                            <span class="w-[200px]">Nama Barang</span>
                            <div class="bg-[#D9D9D9]/40 h-fit px-5 py-2 w-full rounded-lg">
                                {{ $barang->nama_barang }}
                            </div>
                        </div>
                        <div class="flex items-center max-[900px]:flex-col max-[900px]:items-start max-[900px]:gap-y-2">
                            <span class="w-[200px]">Kategori Barang</span>
                            <div class="bg-[#D9D9D9]/40 h-fit px-5 py-2 w-full rounded-lg">
                                {{ $barang->kategori }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center max-[900px]:flex-col max-[900px]:items-start max-[900px]:gap-y-2">
                <span class="w-[120px]">Spesifikasi</span>
                <div class="bg-[#D9D9D9]/40 h-fit px-5 py-2 w-full rounded-lg">
                    {{ $barang->spesifikasi }}
                </div>
            </div>
            <div class="flex items-center max-[900px]:flex-col max-[900px]:items-start max-[900px]:gap-y-2">
                <span class="w-[120px]">Satuan</span>
                <div class="bg-[#D9D9D9]/40 h-fit px-5 py-2 w-full rounded-lg">
                    {{ $barang->satuan }}
                </div>
            </div>
            <div class="flex items-center max-[900px]:flex-col max-[900px]:items-start max-[900px]:gap-y-2">
                <span class="w-[120px]">Stok</span>
                <div class="bg-[#D9D9D9]/40 h-fit px-5 py-2 w-full rounded-lg">
                    {{ $barang->stok }}
                </div>
            </div>
            <div class="flex items-center max-[900px]:flex-col max-[900px]:items-start max-[900px]:gap-y-2">
                <span class="w-[110px]"></span>
                <button class=" border border-blue-500 text-blue-500 px-5 py-2 rounded-lg cursor-pointer hover:bg-blue-500 hover:text-white" onclick="detailRiwayat({{ json_encode($catatStok) }})">Lihat Riwayat</button>
            </div>
        </div>
        <div class="flex gap-x-4 mb-10 max-[600px]:flex-wrap max-[600px]:gap-y-2 max-[600px]:gap-x-2">
            <a href="{{ route('barang-masuk-admin.create.for-barang', $barang->kode_barang) }}"
                class="block bg-green-400 text-white rounded-lg w-fit py-2 px-5">Barang Masuk +</a>
            <a href="{{ route('barang-keluar-admin.create.for-barang', $barang->kode_barang) }}"
                class="block bg-green-400 text-white rounded-lg w-fit py-2 px-5">Barang Keluar -</a>
            <a href="{{ route('barang-retur-admin.create.for-barang', $barang->kode_barang) }}"
                class="bg-green-400 text-white rounded-lg w-fit py-2 px-5 flex items-center gap-x-2">Barang Return
                <img src="{{ asset('assets/rotate-left.png') }}" alt="rotate icon" class="w-[18px] h-[18px]"></a>
        </div>
        <div class="border-b-2 border-[#B6B6B6] pb-8 mb-10">
            <h1 class="font-bold text-2xl mb-6">Data Barang Masuk</h1>
            {{-- Barang Masuk --}}
            <form method="GET" action="{{ route('barangsAdmin.show', $barang->id) }}" class="flex gap-x-2 mb-4 max-[600px]:flex-wrap max-[600px]:gap-y-2">
                <input type="text" data-flatpickr placeholder="Pilih tanggal awal" name="start_masuk" value="{{ request('start_masuk') }}"
                    class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2">
                <input type="text" data-flatpickr placeholder="Pilih tanggal akhir" name="end_masuk" value="{{ request('end_masuk') }}"
                    class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2">
                <button type="submit" class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2 bg-white max-[600px]:hidden">
                    <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" />
                </button>
                {{-- Print Barang Masuk --}}
                <a href="{{ route('barangsAdmin.printMasuk', ['id' => $barang->id, 'start_masuk' => request('start_masuk'), 'end_masuk' => request('end_masuk')]) }}"
                    target="_blank"
                    class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer max-[600px]:hidden">
                    <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                </a>
                <div class="min-[600px]:hidden flex gap-x-2">
                    <button type="submit" class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2 bg-white">
                        <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" />
                    </button>
                    {{-- Print Barang Masuk --}}
                    <a href="{{ route('barangsAdmin.printMasuk', ['id' => $barang->id, 'start_masuk' => request('start_masuk'), 'end_masuk' => request('end_masuk')]) }}"
                        target="_blank"
                        class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer">
                        <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                    </a>
                </div>
            </form>
            <div class="rounded-lg shadow-[1px_1px_10px_rgba(0,0,0,0.1)] pt-4 pb-6 max-[900px]:overflow-x-scroll">
                <table class="table-fixed text-center text-sm w-full max-[900px]:w-[900px]">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[20%] max-[1100px]:pl-0">No</th>
                        <th class="py-2 w-[20%]">Tgl Masuk</th>
                        <th class="py-2 w-[20%]">Qty</th>
                        <th class="py-2 w-[20%]">Keterangan</th>
                        <th class="py-2 w-[25%] max-[1100px]:pr-0">Action</th>
                    </thead>
                    <tbody>
                        @php
                            $nomasuk = 1;
                        @endphp
                        @foreach ($barangMasuks as $item)
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2 max-[1100px]:pl-0">{{ $nomasuk++ }}</td>
                                <td class="py-2">{{ $item->tanggal }}</td>
                                <td class="py-2">{{ $item->qty }}</td>
                                <td class="py-2">{{ $item->keterangan }}</td>
                                <td class="py-2 max-[1100px]:pr-0">
                                    <div class="flex justify-center items-center gap-x-2 ">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('barang-masuk-admin.edit', $item->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                                class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        {{-- Tombol Delete --}}
                                        <form action="{{ route('barang-masuk-admin.destroy', $item->id) }}" method="POST"
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
        <div class="border-b-2 border-[#B6B6B6] pb-8 mb-10">
            <h1 class="font-bold text-2xl mb-6">Data Barang Keluar</h1>
            {{-- Barang Keluar --}}
            <form method="GET" action="{{ route('barangsAdmin.show', $barang->id) }}" class="flex gap-x-2 mb-4 max-[600px]:flex-wrap max-[600px]:gap-y-2">
                <input type="text" data-flatpickr placeholder="Pilih tanggal awal" name="start_keluar" value="{{ request('start_keluar') }}"
                    class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2">
                <input type="text" data-flatpickr placeholder="Pilih tanggal akhir" name="end_keluar" value="{{ request('end_keluar') }}"
                    class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2">
                <button type="submit" class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2 bg-white max-[600px]:hidden">
                    <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" />
                </button>
                {{-- Print Barang Keluar --}}
                <a href="{{ route('barangsAdmin.printKeluar', ['id' => $barang->id, 'start_keluar' => request('start_keluar'), 'end_keluar' => request('end_keluar')]) }}"
                    target="_blank"
                    class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer max-[600px]:hidden">
                    <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                </a>
                <div class="min-[600px]:hidden flex gap-x-2">
                    <button type="submit" class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2 bg-white">
                        <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" />
                    </button>
                    {{-- Print Barang Keluar --}}
                    <a href="{{ route('barangsAdmin.printKeluar', ['id' => $barang->id, 'start_keluar' => request('start_keluar'), 'end_keluar' => request('end_keluar')]) }}"
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
                        <th class="py-2 w-[20%]">Tgl Keluar</th>
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
                        @foreach ($barangKeluars as $item)
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
                                        <a href="{{ route('barang-keluar-admin.edit', $item->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                                class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        {{-- Tombol Delete --}}
                                        <form action="{{ route('barang-keluar-admin.destroy', $item->id) }}" method="POST"
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
        <div class="border-b-2 border-[#B6B6B6] pb-8 mb-10">
            <h1 class="font-bold text-2xl mb-6">Data Barang Return</h1>
            {{-- Barang Retur --}}
            <form method="GET" action="{{ route('barangsAdmin.show', $barang->id) }}" class="flex gap-x-2 mb-4 max-[600px]:flex-wrap max-[600px]:gap-y-2">
                <input type="text" data-flatpickr placeholder="Pilih tanggal awal" name="start_retur" value="{{ request('start_retur') }}"
                    class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2">
                <input type="text" data-flatpickr placeholder="Pilih tanggal akhir" name="end_retur" value="{{ request('end_retur') }}"
                    class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2">
                <button type="submit" class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2 bg-white max-[600px]:hidden">
                    <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" />
                </button>
                {{-- Print Barang Retur --}}
                <a href="{{ route('barangsAdmin.printRetur', ['id' => $barang->id, 'start_retur' => request('start_retur'), 'end_retur' => request('end_retur')]) }}"
                    target="_blank"
                    class="border-[#9A9A9A] border-2 rounded-lg py-[10px] px-[10px] bg-white cursor-pointer max-[600px]:hidden">
                    <img src="{{ asset('assets/printer.png') }}" alt="printer icon" class="w-[20px]">
                </a>
                <div class="min-[600px]:hidden flex gap-x-2">
                    <button type="submit" class="border-2 border-[#9A9A9A] rounded-lg px-3 py-2 bg-white">
                        <img src="{{ asset('assets/search-normal.png') }}" alt="search icon" />
                    </button>
                    {{-- Print Barang Retur --}}
                    <a href="{{ route('barangsAdmin.printRetur', ['id' => $barang->id, 'start_retur' => request('start_retur'), 'end_retur' => request('end_retur')]) }}"
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
                        <th class="py-2 w-[20%]">Tgl Retur</th>
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
                        @foreach ($barangReturs as $item)
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
                                        <a href="{{ route('barang-retur-admin.edit', $item->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                                class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        {{-- Tombol Delete --}}
                                        <form action="{{ route('barang-retur-admin.destroy', $item->id) }}" method="POST"
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
                    title: 'Riwayat Pergerakan Stok Barang',
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
