@extends('admin.layout')
@section('content')
    <div class="flex flex-col items-center">
        <h1 class="text-2xl font-bold mb-6 w-full">Data Peminjaman</h1>
        <div class="shadow-[0px_0px_15px_rgba(0,0,0,0.25)] w-full p-10 rounded-lg bg-white">
            <form method="POST" action="{{ route('alat-pinjam-admin.store') }}" class="flex flex-col gap-y-4">
                @csrf
                <div class="flex items-center max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-2">
                    <label for="" class="w-[180px] font-medium">Tanggal</label>
                    <input type="date" name="tanggal" id="" value="{{ $today }}" readonly
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                </div>
                <div class="flex items-center max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-2">
                    <label class="w-[180px] font-medium">Nama Alat</label>
                    <input type="text" value="{{ $alats->nama_alat }}"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2" readonly />

                    <!-- Hidden input untuk kirim kode_alat -->
                    <input type="hidden" name="kode_alat" value="{{ $alats->kode_alat }}">
                </div>

                <div class="flex items-center max-[600px]:flex-col max-[600px]:gap-y-2 max-[600px]:items-start">
                    <label for="" class="w-[180px] font-medium">Pilih Proyek</label>
                    <select name="kode_akun" id="kode_akun"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 appearance-none cursor-pointer">
                        <option value="" disabled selected>
                            -- Pilih Proyek --
                        </option>
                        @foreach($proyeks as $item)
                        <option value="{{ $item->kode_akun }}">{{ $item->nama_proyek }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-2">
                    <label for="" class="w-[180px] font-medium">PIC</label>
                    <input type="text" id="pic" value=""
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 " readonly>
                </div>
                <div class="flex items-center max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-2">
                    <label for="" class="w-[180px] font-medium">Keterangan</label>
                    <input type="text" name="keterangan" id=""
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                </div>
                <div class="flex items-center max-[600px]:flex-col max-[600px]:items-start max-[600px]:gap-y-2">
                    <label for="" class="w-[180px] font-medium">Jumlah Pinjam</label>
                    <input type="number" name="qty" id=""
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                </div>
                <div class="flex mt-4">
                    <div class="w-[180px] max-[600px]:hidden"></div>
                    <div class="w-full flex gap-x-2">
                        <button type="submit" class="bg-[#FFF494] px-6 py-2 rounded-lg cursor-pointer">Simpan Data</button>
                    </div>
                </div>
            </form>
        </div>
        <script>
            const kodeAkun = document.getElementById('kode_akun');
            const pic = document.getElementById('pic');
            const proyek = @json($proyeks);
            kodeAkun.addEventListener("change", function() {
                proyek.forEach(items => {
                    if(kodeAkun.value == items.kode_akun) {
                        pic.value = items.pic;
                    }
                });
            })
        </script>
    </div>
@endsection
