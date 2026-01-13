@extends('owner.layout') @section('content')
    <div class="flex flex-col items-center">
        <h1 class="text-2xl font-bold mb-4 w-full">
            Saldo Awal
        </h1>
        <div class="shadow-[0px_0px_15px_rgba(0,0,0,0.25)] w-full p-10 rounded-lg bg-white">
            <form action="{{ route('saldo.store') }}" method="POST" class="flex flex-col gap-y-4">
                @csrf

                <div class="flex items-center gap-2">
                    <label class="w-[180px] font-medium">Nama Kas/Bank</label>
                    <select name="nama_kas" id="nama_kas" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2"
                        onchange="document.getElementById('kode_akun').value=this.value">
                        <option value="">-- Pilih Kas/Bank --</option>
                        @foreach ($bank as $b)
                            <option value="{{ $b->kode_akun }}">{{ $b->nama_akun }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center gap-2">
                    <label class="w-[180px] font-medium">Kode Akun</label>
                    <input type="text" name="kode_akun" id="kode_akun" readonly
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2" />
                </div>

                <div class="flex items-center gap-2">
                    <label class="w-[180px] font-medium">Nominal</label>
                    <input type="text" id="nominal_display"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2" oninput="formatRupiah(this)" />

                    <input type="hidden" name="nominal" id="nominal" />
                </div>

                <div class="flex mt-4">
                    <div class="w-[180px]"></div>
                    <div class="w-full flex gap-x-2">
                        <button type="submit" class="bg-[#FFF494] px-6 py-2 rounded-lg cursor-pointer">
                            Simpan Data
                        </button>
                        <button type="button" onclick="history.back()"
                            class="bg-[#FFB7B7] px-6 py-2 rounded-lg cursor-pointer">
                            Batal
                        </button>
                    </div>
                </div>
            </form>

            <script>
                function formatRupiah(el) {
                    let numberString = el.value.replace(/\D/g, ''); // ambil angka saja
                    let formatted = new Intl.NumberFormat('id-ID').format(numberString);
                    el.value = 'Rp. ' + formatted;

                    // isi hidden input dengan angka asli
                    document.getElementById('nominal').value = numberString;
                }
            </script>

        </div>
    </div>
@endsection
