@extends('kepala-proyek.layout')
@section('content')
    <div>
        <h1 class="font-bold text-2xl mb-4">Dashboard</h1>
        <section class="flex flex-col gap-y-8">
            <div class="flex gap-x-8">
                <div class="flex flex-col shadow-[1px_1px_5px_rgba(0,0,0,0.25)] rounded-xl bg-white px-4 py-4 w-[380px] h-[300px] gap-y-3 justify-center items-center">
                    {{-- <button class="border-[#9A9A9A] border-2 rounded-lg py-2 px-4 bg-white cursor-pointer" id="modal-add">
                       Tambah Perusahaan +
                    </button> --}}
                </div>
                <div class="flex flex-col h-[300px] w-full shadow-[1px_1px_5px_rgba(0,0,0,0.25)] rounded-xl bg-white px-4 py-4">
                    <span class="font-bold">Grafik barang masuk</span>
                    <div></div>
                </div>
            </div>

        </section>
    </div>

@endsection
