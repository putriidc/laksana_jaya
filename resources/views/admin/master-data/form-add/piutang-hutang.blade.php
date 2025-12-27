@extends('admin.layout')
@section('content')
    <div class="flex flex-col items-center">
        <h1 class="text-2xl font-bold mb-4 w-full">Piutang & Hutang Usaha</h1>
        <div class="shadow-[0px_0px_15px_rgba(0,0,0,0.25)] w-full p-10 rounded-lg bg-white">
            <form method="POST" action="{{ route('piutangHutang.store') }}" class="flex flex-col gap-y-4">
                @csrf
                <div class="flex items-center">
                    <label for="" class="w-[180px] font-medium">Nama Akun</label>
                    <input type="text" name="nama_akun" id=""
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2">
                </div>
                <div class="flex items-center">
                    <label for="" class="w-[180px] font-medium">Akun Header</label>
                    <select name="akun_header" id=""
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2 appearance-none cursor-pointer">
                        <option selected>-Pilih Akun Header-</option>
                        <option value="Piutang">Piutang</option>
                        <option value="Hutang">Hutang</option>
                    </select>
                </div>

                <div class="flex mt-4">
                    <div class="w-[180px]"></div>
                    <div class="w-full flex gap-x-2">
                        <button type="submit" class="bg-[#FFF494] px-6 py-2 rounded-lg cursor-pointer">Simpan Data</button>
                        <button type="button" onclick="history.back()" class="bg-[#FFB7B7] px-6 py-2 rounded-lg cursor-pointer">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const akunHeaderSelect = document.querySelector('select[name="akun_header"]');
        const namaPicWrapper = document.getElementById('nama-pic-wrapper');

        akunHeaderSelect.addEventListener('change', function () {
            if (this.value === 'PIC') {
                namaPicWrapper.style.display = 'flex';
            } else {
                namaPicWrapper.style.display = 'none';
            }
        });
    });
</script>

@endsection
