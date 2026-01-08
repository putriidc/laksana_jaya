@extends('owner.layout') @section('content')
<div class="flex flex-col items-center">
    <h1 class="text-2xl font-bold mb-4 w-full">
        Saldo Awal
    </h1>
    <div
        class="shadow-[0px_0px_15px_rgba(0,0,0,0.25)] w-full p-10 rounded-lg bg-white"
    >
        <form
            action=""
            class="flex flex-col gap-y-4"
            method="POST"
        >
            @csrf
            <div class="flex items-center max-[700px]:flex-col max-[700px]:items-start max-[700px]:gap-2">
                <label for="" class="w-[180px] font-medium">Kode Akun</label>
                <input
                    type="text"
                    name="kode_akun"
                    id=""
                    class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2"
                />
            </div>
            <div class="flex items-center max-[700px]:flex-col max-[700px]:items-start max-[700px]:gap-2">
                <label for="" class="w-[180px] font-medium">Nama Kas/Bank</label>
                <input
                    type="text"
                    name="nama_kas"
                    id=""
                    class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2"
                />
            </div>
            <div class="flex items-center max-[700px]:flex-col max-[700px]:items-start max-[700px]:gap-2">
                <label for="" class="w-[180px] font-medium">Nominal</label>
                <input
                    type="text"
                    name="nominal"
                    id=""
                    class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2"
                />
            </div>
            <div class="flex mt-4">
                <div class="w-[180px] max-[700px]:hidden"></div>
                <div class="w-full flex gap-x-2">
                    <button
                        type="submit"
                        class="bg-[#FFF494] px-6 py-2 rounded-lg cursor-pointer"
                    >
                        Simpan Data
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
