@extends('admin.layout')
@section('content')
<div class="flex flex-col items-center">
    <h1 class="text-2xl font-bold mb-4 w-full">Edit Freelance</h1>
    <div class="shadow-[0px_0px_15px_rgba(0,0,0,0.25)] w-full p-10 rounded-lg bg-white">
        <form method="POST" action="{{ route('sampingans.update', $sampingan->id) }}" class="flex flex-col gap-y-4" id="myForm">
            @csrf
            @method('PUT')

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Nama</label>
                <input type="text" name="nama" value="{{ $sampingan->nama }}" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Tgl Mulai</label>
                <input type="text" name="tgl_mulai" data-flatpickr placeholder="Tanggal Mulai" value="{{ $sampingan->tgl_mulai }}" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Tgl Selesai</label>
                <input type="text" name="tgl_selesai" data-flatpickr placeholder="Tanggal Selesai" value="{{ $sampingan->tgl_selesai }}" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Salary</label>
                <input type="text" name="gaji" id="salary" value="{{ $sampingan->gaji }}" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 rupiah-format">
            </div>

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Day</label>
                <input type="number" name="hari" id="day" value="{{ $sampingan->hari }}" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Total Salary</label>
                <input type="text" name="total-salary" id="total-salary"  class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 rupiah-format" readonly>
            </div>

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Tambahan</label>
                <input type="text" name="tambahan" id="tambahan" value="{{ $sampingan->tambahan }}" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 rupiah-format">
            </div>

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Jumlah</label>
                <input type="text" name="jumlah" id="jumlah"  class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 rupiah-format" readonly>
            </div>

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Kasbon</label>
                <input type="text" name="kasbon" id="kasbon" value="{{ $sampingan->kasbon }}" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 rupiah-format">
            </div>

            <div class="flex items-center">
                <label class="w-[180px] font-medium">Total Seluruh</label>
                <input type="text" name="total-seluruh" id="total-seluruh" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 rupiah-format" readonly>
            </div>

            <div class="flex mt-4">
                <div class="w-[180px]"></div>
                <div class="w-full flex gap-x-2">
                    <button type="submit" class="bg-[#FFF494] px-6 py-2 rounded-lg cursor-pointer">Update Data</button>
                    <a href="{{ route('sampingans.index') }}" class="bg-[#FFB7B7] px-6 py-2 rounded-lg cursor-pointer text-center">Batal</a>
                </div>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/form.js') }}"></script>
</div>
@endsection
