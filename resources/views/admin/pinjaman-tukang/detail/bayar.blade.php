@extends('admin.layout')
@section('content')
    <div class="flex flex-col items-center">
        <h1 class="text-2xl font-bold mb-6 w-full">Form Pengembalian Pinjaman Tukang</h1>
        <div class="shadow-[0px_0px_15px_rgba(0,0,0,0.25)] w-full p-10 rounded-lg bg-white">
            <form method="POST" action="{{ route('tukangContents.storeBayar') }}" class="flex flex-col gap-y-4" id="myForm">
                @csrf
                <input type="hidden" name="kode_karyawan" value="{{ $pinjaman->id }}">
                <div class="flex items-center">
                    <label for="" class="w-[200px] font-medium">Tanggal Cicilan</label>
                    <input value="{{ $today }}" readonly type="date" data-flatpickr
                        placeholder="Pilih Tanggal Cicilan" name="tanggal" id=""
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                </div>
                <div class="flex items-center">
                    <label for="" class="w-[200px] font-medium">Keterangan</label>
                    <input type="text" name="kontrak" id=""
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                </div>
                {{-- <div class="flex items-center">
                    <label for="" class="w-[200px] font-medium">Nama Akun</label>
                    <input type="text" name="keterangan" id=""
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                </div> --}}
                {{-- <div class="flex items-center">
                    <label for="" class="w-[200px] font-medium">Nama Proyek</label>
                    <input type="text" name="keterangan" id=""
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                </div> --}}
                <div class="flex items-center">
                    <label for="" class="w-[200px] font-medium">Nominal</label>
                    <input type="text" name="bayar" id=""
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 rupiah-format">
                </div>
                <div class="flex mt-4">
                    <div class="w-[200px]"></div>
                    <div class="w-full flex gap-x-2">
                        <button type="submit"
                            class="bg-white border border-[#3E98D0] text-[#3E98D0] px-4 py-[6px] rounded-lg cursor-pointer flex items-center justify-center gap-x-1">
                            <span>Simpan Data</span>
                            <img src="{{ asset('assets/plus-circle-blue.png') }}" class="w-[25px] h-[25px]" alt="plus icon">
                        </button>
                        <button type="button" onclick="history.back()"
                            class="bg-white border border-[#DD4049] text-[#DD4049] px-4 py-[6px] rounded-lg cursor-pointer flex items-center justify-center gap-x-2">
                            <span>Batal</span>
                            <img src="{{ asset('assets/close-circle-red.png') }}" class="w-[18px] h-[18px]"
                                alt="close icon">
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <script src="{{ asset('js/form.js') }}"></script>
    </div>
@endsection
