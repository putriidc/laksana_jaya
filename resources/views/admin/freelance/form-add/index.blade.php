@extends('admin.layout')
@section('content')
<div class="flex flex-col items-center">
    <h1 class="text-2xl font-bold mb-4 w-full">Form Freelance</h1>
    <div class="shadow-[0px_0px_15px_rgba(0,0,0,0.25)] w-full p-10 rounded-lg bg-white">
        <form action="" class="flex flex-col gap-y-4" id="myForm">
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Nama</label>
                <input type="text" name="" id="" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Tgl Mulai</label>
                <input type="text" name="" id="" data-flatpickr placeholder="Pilih Tanggal Mulai" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Tgl Selesai</label>
                <input type="text" name="" id="" data-flatpickr placeholder="Pilih Tanggal Selesai" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Salary</label>
                <input type="text" name="salary" id="salary" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 rupiah-format">
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Day</label>
                <input type="number" name="" id="day" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Total Salary</label>
                <input type="text" name="total-salary" id="total-salary" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 rupiah-format" readonly>
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium" >Tambahan</label>
                <input type="text" name="tambahan" id="tambahan" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 rupiah-format">
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Jumlah</label>
                <input type="text" name="jumlah" id="jumlah" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 rupiah-format" readonly>
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Kasbon</label>
                <input type="text" name="kasbon" id="kasbon" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 rupiah-format">
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Total Seluruh</label>
                <input type="text" name="total-seluruh" id="total-seluruh" class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 rupiah-format" readonly>
            </div>
            <div class="flex mt-4">
                <div class="w-[180px]"></div>
                <div class="w-full flex gap-x-2">
                    <button type="submit" class="bg-[#FFF494] px-6 py-2 rounded-lg cursor-pointer">Simpan Data</button>
                    <button class="bg-[#FFB7B7] px-6 py-2 rounded-lg cursor-pointer">Batal</button>
                </div>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/form.js') }}"></script>
</div>
@endsection