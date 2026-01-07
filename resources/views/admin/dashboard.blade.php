@extends('admin.layout') @section('content')
<div class="h-[2000px]">
    @if(session('success'))
    <div
        id="flash-message"
        data-type="success"
        data-message="{{ session('success') }}"
    ></div>
    @endif
    <h1 class="font-bold text-2xl mb-4">Dashboard</h1>
    <section class="flex justify-between">
        <div
            class="border-[#DD4049] border shadow-2xl flex items-center gap-x-5 py-4 px-5 rounded-lg"
        >
            <div class="text-sm">
                <p>Pengeluaran Hari Ini</p>
                <h1 class="font-bold">Rp. 14.254.500,00</h1>
            </div>
            <div
                class="bg-linear-to-b from-[#DD4049] to-[#F9E52D] p-4 rounded-lg"
            >
                <img
                    src="https://ar4n-group.com/public/assets/card-send.png"
                    alt="card icon"
                    class="w-[20px]"
                />
            </div>
        </div>
        <div
            class="border-[#DD4049] border shadow-2xl flex items-center gap-x-5 py-4 px-5 rounded-lg"
        >
            <div class="text-sm">
                <p>Pengeluaran Hari Ini</p>
                <h1 class="font-bold text-base">Rp. 14.254.500,00</h1>
            </div>
            <div
                class="bg-linear-to-b from-[#DD4049] to-[#F9E52D] p-4 rounded-lg"
            >
                <img
                    src="https://ar4n-group.com/public/assets/card-send.png"
                    alt="card icon"
                    class="w-[20px]"
                />
            </div>
        </div>
        <div
            class="border-[#DD4049] border shadow-2xl flex items-center gap-x-5 py-4 px-5 rounded-lg"
        >
            <div class="text-sm">
                <p>Pengeluaran Hari Ini</p>
                <h1 class="font-bold text-base">Rp. 14.254.500,00</h1>
            </div>
            <div
                class="bg-linear-to-b from-[#DD4049] to-[#F9E52D] p-4 rounded-lg"
            >
                <img
                    src="https://ar4n-group.com/public/assets/card-send.png"
                    alt="card icon"
                    class="w-[20px]"
                />
            </div>
        </div>
        <div
            class="border-[#DD4049] border shadow-2xl flex items-center gap-x-5 py-4 px-5 rounded-lg"
        >
            <div class="text-sm">
                <p>Pengeluaran Hari Ini</p>
                <h1 class="font-bold text-base">Rp. 14.254.500,00</h1>
            </div>
            <div
                class="bg-linear-to-b from-[#DD4049] to-[#F9E52D] p-4 rounded-lg"
            >
                <img
                    src="https://ar4n-group.com/public/assets/card-send.png"
                    alt="card icon"
                    class="w-[20px]"
                />
            </div>
        </div>
    </section>
</div>
@endsection
