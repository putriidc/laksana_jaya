@extends('admin.layout')
@section('content')
    <div>
        <h1 class="font-bold text-2xl mb-4">Master Data</h1>
        <section class="flex gap-x-3">
            <div class="border-[#DD4049] border shadow-2xl flex items-center gap-x-5 py-4 px-5 rounded-lg">
                <div class="text-sm">
                    <p>Data Karyawan</p>
                    <h1 class="font-bold">150 Orang</h1>
                </div>
                <div class="bg-linear-to-b from-[#DD4049] to-[#F9E52D] p-4 rounded-lg">
                    <img src="{{ asset('assets/card-send.png') }}" alt="card icon" class="w-[20px]">
                </div>
            </div>
            <div class="border-[#DD4049] border shadow-2xl flex items-center gap-x-5 py-4 px-5 rounded-lg">
                <div class="text-sm">
                    <p>Data Pelanggan</p>
                    <h1 class="font-bold text-base">300 Orang</h1>
                </div>
                <div class="bg-linear-to-b from-[#DD4049] to-[#F9E52D] p-4 rounded-lg">
                    <img src="{{ asset('assets/card-send.png') }}" alt="card icon" class="w-[20px]">
                </div>
            </div>
        </section>
    </div>
@endsection