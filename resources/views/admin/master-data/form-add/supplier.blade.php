@extends('admin.layout') @section('content')
<div class="flex flex-col items-center">
    <h1 class="text-2xl font-bold mb-4 w-full">
        Form Data Supplier
    </h1>
    <div
        class="shadow-[0px_0px_15px_rgba(0,0,0,0.25)] w-full p-10 rounded-lg bg-white"
    >
        <form
            action="{{ route('supplier.store') }}"
            class="flex flex-col gap-y-4"
            method="POST"
        >
            @csrf
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Nama</label>
                <input
                    type="text"
                    name="nama"
                    id=""
                    class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2"
                />
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Alamat</label>
                <input
                    type="text"
                    name="alamat"
                    id=""
                    class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2"
                />
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">Marketing</label>
                <input
                    type="text"
                    name="marketing"
                    id=""
                    class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2"
                />
            </div>
            <div class="flex items-center">
                <label for="" class="w-[180px] font-medium">No Hp</label>
                <input
                    type="text"
                    name="no_hp"
                    id=""
                    class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2"
                />
            </div>
            <div class="flex mt-4">
                <div class="w-[180px]"></div>
                <div class="w-full flex gap-x-2">
                    <button
                        type="submit"
                        class="bg-[#FFF494] px-6 py-2 rounded-lg cursor-pointer"
                    >
                        Simpan Data
                    </button>
                    <button type="button" onclick="history.back()"
                        class="bg-[#FFB7B7] px-6 py-2 rounded-lg cursor-pointer"
                    >
                        Batal
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
