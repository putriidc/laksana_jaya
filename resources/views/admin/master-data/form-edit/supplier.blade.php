@extends('admin.layout') @section('content')
    <div class="flex flex-col items-center">
        <h1 class="text-2xl font-bold mb-4 w-full">
            Edit Data Supplier
        </h1>
        <div class="shadow-[0px_0px_15px_rgba(0,0,0,0.25)] w-full p-10 rounded-lg bg-white">
            <form action="{{ route('supplier.update', $supplier->id) }}" method="POST" class="flex flex-col gap-y-4">
                @csrf
                @method('PUT')

                <div class="flex items-center">
                    <label class="w-[180px] font-medium">Nama</label>
                    <input type="text" name="nama" value="{{ old('nama', $supplier->nama) }}"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2" />
                </div>

                <div class="flex items-center">
                    <label class="w-[180px] font-medium">Alamat</label>
                    <input type="text" name="alamat" value="{{ old('alamat', $supplier->alamat) }}"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2" />
                </div>

                <div class="flex items-center">
                    <label class="w-[180px] font-medium">Marketing</label>
                    <input type="text" name="marketing" value="{{ old('marketing', $supplier->marketing) }}"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2" />
                </div>

                <div class="flex items-center">
                    <label class="w-[180px] font-medium">No Hp</label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $supplier->no_hp) }}"
                        class="w-full outline-none bg-[#D9D9D9]/40 rounded-sm px-4 py-2" />
                </div>

                <div class="flex mt-4">
                    <div class="w-[180px]"></div>
                    <div class="w-full flex gap-x-2">
                        <button type="submit" class="bg-[#FFF494] px-6 py-2 rounded-lg cursor-pointer">
                            Update Data
                        </button>
                        <button type="button" onclick="history.back()"
                            class="bg-[#FFB7B7] px-6 py-2 rounded-lg cursor-pointer">
                            Batal
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
