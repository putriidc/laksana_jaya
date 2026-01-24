@extends('owner.layout')
@section('content')
    <div class="flex flex-col items-center">
        <h1 class="text-2xl font-bold mb-6 w-full">Data Pengembalian</h1>
        <div class="shadow-[0px_0px_15px_rgba(0,0,0,0.25)] w-full p-10 rounded-lg bg-white">
            <form method="POST" action="{{ route('alat-kembalikan-owner.store') }}" class="flex flex-col gap-y-4">
                @csrf
                <div class="flex items-center max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-2">
                    <label for="" class="w-[200px] font-medium">Tanggal</label>
                    <input type="date" name="tanggal" id="" value="{{ $today }}" readonly
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                </div>
                <div class="flex items-center max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-2">
                    <label class="w-[200px] font-medium">Nama Alat</label>
                    <input type="text" value="{{ $alats->nama_alat }}"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2" readonly />

                    <!-- Hidden input untuk kirim kode_alat -->
                    <input type="hidden" name="kode_alat" value="{{ $alats->kode_alat }}">
                </div>

                <div class="flex items-center max-[600px]:flex-col max-[600px]:gap-y-2 max-[600px]:items-start">
                    <label for="" class="w-[200px] font-medium">Pilih Stok Dipinjam</label>
                    <select name="id_pinjaman" id="id_pinjaman"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 appearance-none cursor-pointer">
                        <option value="" disabled selected>
                            -- Pilih Stok yang di pinjam --
                        </option>
                        @foreach($alatdipinjams as $item)
                        <option value="{{ $item->id }}">
                            @php
                            $proyekCocok = $proyeks->where('kode_akun', $item->kode_akun)->first(); 
                            $alatDetail = $alats->where('kode_alat', $item->kode_alat)->first();
                            @endphp
                            {{ $proyekCocok->nama_proyek }} - {{ $proyekCocok->pic }} ({{ $item->qty }} {{ $alatDetail->satuan }})
                        </option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="kode_akun" id="kode_akun" value="">
                <input type="hidden" name="qty" id="qty" value="">
                <div class="flex items-center max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-2">
                    <label for="" class="w-[200px] font-medium">Keterangan</label>
                    <input type="text" name="keterangan" id=""
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                </div>
                <div class="flex mt-4">
                    <div class="w-[200px] max-[600px]:hidden"></div>
                    <div class="w-full flex gap-x-2">
                        <button type="submit" class="bg-[#FFF494] px-6 py-2 rounded-lg cursor-pointer">Simpan Data</button>
                    </div>
                </div>
            </form>
        </div>
        <script>
            const idPinjaman = document.getElementById('id_pinjaman');
            const kodeAkun = document.getElementById('kode_akun');
            const nama_proyek = document.getElementById('proyek')
            const jumlah = document.getElementById('qty')
            const proyek = @json($proyeks);
            const alatPinjam = @json($alatdipinjams);
            idPinjaman.addEventListener("change", function() {
                alatPinjam.forEach(items => {
                    if(idPinjaman.value == items.id) {
                        kodeAkun.value = items.kode_akun;
                        jumlah.value = items.qty;
                    }
                });
            })
        </script>
    </div>
@endsection
