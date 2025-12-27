@extends('admin.layout')
@section('content')
    <div>
        @if (session('success'))
            <div id="flash-message" data-type="success" data-message="{{ session('success') }}"></div>
        @endif
        @if (session('error'))
            <div id="flash-message" data-type="error" data-message="{{ session('error') }}"
                class="bg-red-100 text-red-800 px-4 py-2 rounded mb-3">
                {{ session('error') }}
            </div>
        @endif
        <h1 class="text-2xl font-bold mb-5">Form Pengajuan EAF</h1>
        <form method="POST" action="{{ route('eaf.store') }}" class="flex flex-col gap-y-5 pb-10 border-b border-gray-300">
            @csrf
            <div class="flex items-center">
                <label for="" class="w-[200px]">Tanggal Pengajuan</label>
                <input type="date" name="tanggal" id="" value="{{ $today }}" readonly
                    class="bg-[#D9D9D9]/40 px-6 py-2 rounded-lg w-full">
            </div>
            <div class="flex items-center">
                <label class="w-[200px]">Nama Proyek</label>
                <select name="nama_proyek" id="nama_proyek"
                    class="bg-[#D9D9D9]/40 px-4 appearance-none py-2 rounded-lg w-full cursor-pointer">
                    <option selected disabled>~Pilih Nama Proyek~</option>
                    @foreach ($proyek as $item)
                        <option value="{{ $item->nama_proyek }}" data-pic="{{ $item->pic }}">
                            {{ $item->nama_proyek }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center">
                <label class="w-[200px]">PIC</label>
                <input type="text" name="pic" id="pic" class="bg-[#D9D9D9]/40 px-6 py-2 rounded-lg w-full"
                    readonly>
            </div>
            <div class="flex items-center">
                <label for="" class="w-[200px]">Keterangan</label>
                <input type="text" name="keterangan" id="" class="bg-[#D9D9D9]/40 px-6 py-2 rounded-lg w-full">
            </div>
            <div class="flex items-center">
                <label for="" class="w-[200px]">Nominal</label>
                <input type="number" placeholder="Rp." name="nominal" id=""
                    class="bg-[#D9D9D9]/40 px-6 py-2 rounded-lg w-full">
            </div>
            <div class="flex items-center">
                <label for="" class="w-[200px]">Kas / Bank</label>
                <select name="kas" id=""
                    class="bg-[#D9D9D9]/40 px-4 appearance-none py-2 rounded-lg w-full cursor-pointer">
                    <option selected disabled>~Pilih kas / bank~</option>
                    @foreach ($bank as $item)
                        <option value="{{ $item->kode_akun }}">{{ $item->nama_akun }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex">
                <label for="" class="w-[200px]">Detail Biaya</label>
                <textarea name="detail_biaya" id="" cols="20" rows="8"
                    class="bg-[#D9D9D9]/40 px-6 py-2 rounded-lg w-full"></textarea>
            </div>
            <div class="flex">
                <div class="w-[200px]"></div>
                <div class="w-full flex gap-x-2">
                    <button type="submit"
                        class="bg-white border border-[#3E98D0] text-[#3E98D0] px-4 py-[6px] rounded-lg cursor-pointer flex items-center justify-center gap-x-1">
                        <span>Simpan Data</span>
                        <img src="{{ asset('assets/plus-circle-blue.png') }}" class="w-[25px] h-[25px]" alt="plus icon">
                    </button>
                </div>
            </div>
        </form>
        <div class="mt-5">
            <h1 class="text-2xl font-bold mb-5">Status Pengajuan</h1>
            <div class="rounded-lg shadow-[0px_0px_20px_rgba(0,0,0,0.1)] pt-4 pb-6">
                <table class="table-auto text-center text-sm w-full">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <th class="py-2 w-[5%]">No</th>
                        <th class="py-2 w-[10%]">Tgl Pengajuan</th>
                        <th class="py-2 w-[15%]">Nama Proyek</th>
                        <th class="py-2 w-[10%]">PIC</th>
                        <th class="py-2 w-[10%]">Nominal</th>
                        <th class="py-2 w-[15%]">Detail Biaya</th>
                        <th class="py-2 w-[10%]">Status</th>
                        <th class="py-2 w-[10%]">Action</th>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($eaf as $item)
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">{{ $no++ }}</td>
                                <td class="py-2">{{ $item->tanggal }}</td>
                                <td class="py-2">{{ $item->nama_proyek }}</td>
                                <td class="py-2">{{ $item->pic }}</td>
                                <td class="py-2">{{ 'RP. ' . number_format($item->nominal, 0, ',', '.') }}</td>
                                <td class="py-2">
                                    <span data-detail="{{ $item->detail_biaya }}" onclick="detailBiaya(this)"
                                        class="hover:underline text-blue-400 cursor-pointer">
                                        Lihat Detail
                                    </span>
                                </td>
                                <td class="py-2">
                                    <div class="flex gap-x-1 items-center">
                                        {{-- Status Owner --}}
                                        <button type="button"
                                            class="px-4 py-1 text-xs rounded-sm text-white
               {{ $item->acc_owner === 'accept' ? 'bg-[#45D03E]' : ($item->acc_owner === 'decline' ? 'bg-red-500' : 'bg-gray-400') }}"
                                            data-ket="{{ $item->ket_owner }}" onclick="showKet(this, 'Owner')">
                                            Owner: {{ ucfirst($item->acc_owner ?? 'Pending') }}
                                        </button>

                                        {{-- Status SPV --}}
                                        <button type="button"
                                            class="px-4 py-1 text-xs rounded-sm text-white
               {{ $item->acc_spv === 'accept' ? 'bg-[#45D03E]' : ($item->acc_spv === 'decline' ? 'bg-red-500' : 'bg-gray-400') }}"
                                            data-ket="{{ $item->ket_spv }}" onclick="showKet(this, 'SPV')">
                                            SPV: {{ ucfirst($item->acc_spv ?? 'Pending') }}
                                        </button>
                                    </div>
                                </td>
                                <td class="py-2">
                                    <div class="flex items-center gap-x-2 justify-center">
                                        {{-- Tombol detail hanya muncul kalau owner & spv accept --}}
                                        @if ($item->acc_owner === 'accept' && $item->acc_spv === 'accept')
                                            <a href="{{ route('eaf.show', $item->id) }}" class="btn btn-sm btn-primary">
                                                <img src="{{ asset('assets/more-circle.png') }}" alt="detail icon"
                                                    class="w-[22px] cursor-pointer">
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            function showKet(el, role) {
                const ket = el.getAttribute('data-ket') || 'Belum ada keterangan';
                Swal.fire({
                    html: `
            <div class="flex flex-col gap-y-4 items-center">
                <h1 class="font-bold text-2xl text-center mb-5">Keterangan ${role}</h1>
                <textarea readonly
                    class="w-full px-4 py-2 border rounded-lg bg-[#D9D9D9]/40"
                    rows="6">${ket}</textarea>
            </div>
        `,
                    showCloseButton: true,
                    showConfirmButton: false,
                });
            }


            function detailBiaya(el) {
                const detail = el.getAttribute('data-detail');
                Swal.fire({
                    html: `
                            <div class="flex flex-col gap-y-4 items-center">
                                <h1 class="font-bold text-2xl text-center mb-5">Detail Biaya</h1>
                                    <textarea readonly
                                        class="w-full px-4 py-2 border rounded-lg bg-[#D9D9D9]/40"
                                    rows="6">${detail}</textarea>
                            </div>
                        `,
                    showCloseButton: true,
                    showConfirmButton: false,
                })
            }

            document.getElementById('nama_proyek').addEventListener('change', function() {
                let selectedOption = this.options[this.selectedIndex];
                let pic = selectedOption.getAttribute('data-pic');
                document.getElementById('pic').value = pic;
            });
        </script>
    </div>
@endsection
