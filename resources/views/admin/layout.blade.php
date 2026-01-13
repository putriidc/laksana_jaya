<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Admin</title>
        <link rel="preload" as="style" href="https://ar4n-group.com/public/build/assets/app-B0Qmn0OF.css" />
       <link rel="stylesheet" href="https://ar4n-group.com/public/build/assets/app-B0Qmn0OF.css" />
        <link rel="preload" as="style" href="https://ar4n-group.com/public/build/assets/app-CksuuEqD.css" />
        <link rel="modulepreload" as="script" href="https://ar4n-group.com/public/build/assets/app-Dp50F7vr.js" />
        <link rel="stylesheet" href="https://ar4n-group.com/public/build/assets/app-CksuuEqD.css" />
        <script type="module" src="https://ar4n-group.com/public/build/assets/app-Dp50F7vr.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

         <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body class="font-poppins">
        @if (session('success'))
            <div
                id="flash-message"
                data-type="success"
                data-message="{{ session('success') }}"
            ></div>
        @elseif (session('error'))
            <div
                id="flash-message"
                data-type="error"
                data-message="{{ session('error') }}"
            ></div>
        @endif
        <section class="flex h-screen">
            <nav
                class="flex flex-col bg-white h-screen w-[350px] py-5 px-5 shadow-[1px_0px_5px_rgba(0,0,0,0.25)] items-center relative z-[99] overflow-y-auto overflow-x-hidden max-[1300px]:absolute max-[1300px]:items-center max-[1300px]:w-[60px] max-[1300px]:overflow-x-hidden max-[1300px]:transition-all max-[1300px]:ease-in-out max-[1300px]:duration-200"
                id="sideNavbar"
            >
                {{-- button view --}}
                <button class="min-[1300px]:hidden cursor-pointer max-[550px]:hidden bg-white shadow-[0px_1px_8px_rgba(0,0,0,0.25)] rounded-full p-2 fixed top-[50%] left-12 rotate-[-90deg] z-[99] transition-all duration-200 ease-in-out" id="buttonView">
                    <img src="{{ asset('assets/arrow-down.png') }}" alt="arrow view" class="w-[15px]">
                </button>
                {{-- button view --}}
                {{-- Logo --}}
                <div
                    class="flex justify-between items-center gap-x-1 mb-8 max-[1300px]:hidden max-[550px]:w-full max-[550px]:px-2"
                    id="logoFull"
                >
                    {{-- bagian yang di responsive --}}
                    <img
                        src="https://ar4n-group.com/public/assets/ar4anSmallLogo.png"
                        alt="LOGO AR4N GROUP"
                        class="max-[550px]:w-[70px]"
                    />
                    <h1
                        class="leading-6 font-bold text-2xl text-[#353132] max-[550px]:text-xl"
                    >
                        AR4N <br class="max-[550px]:hidden" />
                        GROUP
                    </h1>
                    <button
                        class="min-[550px]:hidden w-[30px] flex flex-col gap-y-[7px]"
                        id="buttonClose"
                    >
                        <span
                            class="border-t-[3px] border-gray-400 w-full rotate-45 translate-y-[5px]"
                        ></span>
                        <span
                            class="border-b-[3px] border-gray-400 w-full -rotate-45 -translate-y-[5px]"
                        ></span>
                    </button>
                </div>
                <div class="w-[60px] min-[1300px]:hidden mb-8 scale-200"
                    id="justLogo">
                    <img
                    src="{{ asset('assets/ar4anSmallLogo.png') }}"
                    alt="LOGO AR4N GROUP"
                />
                </div>

                {{-- logo --}}
                <div class="flex flex-col gap-y-3 h-full max-[1300px]:items-center" id="sideNavbarContent">
                    <a href="/admin/dashboard" class="cursor-pointer">
                        <button
                            class="bg-linear-to-r from-[#DD4049] to-[#F9E52D] text-white flex items-center gap-x-5 w-[250px] max-[1300px]:w-[50px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                        >
                            <img
                                src="https://ar4n-group.com/public/assets/navbar/home-2.png"
                                alt="home icon"
                                class="max-[1300px]:scale-200"
                            />
                            <span class="max-[1300px]:hidden">Dashboard</span>
                        </button>
                    </a>
                    <a href="/admin/master-data" class="cursor-pointer">
                        <button
                            class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] max-[1300px]:w-[50px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                        >
                            <img
                                src="https://ar4n-group.com/public/assets/navbar/devices.png"
                                alt="devices icon"
                                class="max-[1300px]:scale-200"
                            />
                            <span class="max-[1300px]:hidden">Master Data</span>
                        </button>
                    </a>
                    <a
                        href="{{ route('jurnalUmums.index') }}"
                        class="cursor-pointer"
                    >
                        <button
                            class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] max-[1300px]:w-[50px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                        >
                            <img
                                src="https://ar4n-group.com/public/assets/navbar/receipt-item.png"
                                alt="receipt icon"
                                class="max-[1300px]:scale-200"
                            />
                            <span class="max-[1300px]:hidden">Jurnal Umum</span>
                        </button>
                    </a>
                    {{--
                    <a href="" class="cursor-pointer">
                        <button
                            class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] max-[1300px]:w-[50px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                        >
                            <img
                                src="https://ar4n-group.com/public/assets/navbar/folder-open.png"
                                alt="folder icon"
                                class="max-[1300px]:scale-200"
                            />
                            <span class="max-[1300px]:hidden">Buku Besar</span>
                        </button>
                    </a>
                    --}}
                    @if ( Auth::user()->role != "Admin 1" )
                    <a
                        href="{{ route('sampingans.index') }}"
                        class="cursor-pointer"
                    >
                        <button
                            class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] max-[1300px]:w-[50px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                        >
                            <img
                                src="https://ar4n-group.com/public/assets/navbar/home-hashtag.png"
                                alt="home hashtag icon"
                                class="max-[1300px]:scale-200"
                            />
                            <span class="max-[1300px]:hidden">Freelance</span>
                        </button>
                    </a>
                    <a
                    href="{{ route('pinjamanKaryawans.index') }}"
                    class="cursor-pointer"
                    >
                    <button
                    class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] max-[1300px]:w-[50px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                    >
                    <img
                    src="https://ar4n-group.com/public/assets/navbar/receipt-item.png"
                                alt="receipt2 icon"
                                class="max-[1300px]:scale-200"
                                />
                                <span class="max-[1300px]:hidden">Pinjaman Karyawan</span>
                            </button>
                        </a>
                    @endif
                    @if (Auth::user()->role != "Admin 2")
                    <a
                        href="{{ route('pinjamanTukangs.index') }}"
                        class="cursor-pointer"
                    >
                        <button
                            class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] max-[1300px]:w-[50px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                        >
                            <img
                                src="https://ar4n-group.com/public/assets/navbar/receipt-item.png"
                                alt="receipt2 icon"
                                class="max-[1300px]:scale-200"
                            />
                            <span class="max-[1300px]:hidden">Pinjaman Tukang</span>
                        </button>
                    </a>
                    @endif
                    <a
                        href="{{ route('eaf.index') }}"
                        class="cursor-pointer"
                    >
                        <button
                            class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] max-[1300px]:w-[50px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                        >
                            <img
                                src="https://ar4n-group.com/public/assets/navbar/receipt.png"
                                alt="receipt2 icon"
                                class="max-[1300px]:scale-200"
                            />
                            <span class="max-[1300px]:hidden">Form EAF</span>
                        </button>
                    </a>
                    <a
                        href="{{ route('laporanHarian.index') }}"
                        class="cursor-pointer"
                    >
                        <button
                            class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] max-[1300px]:w-[50px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                        >
                            <img
                                src="https://ar4n-group.com/public/assets/navbar/status-up.png"
                                alt="receipt2 icon"
                                class="max-[1300px]:scale-200"
                            />
                            <span class="max-[1300px]:hidden">Laporan Harian</span>
                        </button>
                    </a>
                    <a
                        href="/bukubesar/111"
                        class="cursor-pointer"
                    >
                        <button
                            class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] max-[1300px]:w-[50px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                        >
                            <img
                                src="https://ar4n-group.com/public/assets/navbar/book.png"
                                alt="receipt2 icon"
                                class="max-[1300px]:scale-200"
                            />
                            <span class="max-[1300px]:hidden">Buku Besar</span>
                        </button>
                    </a>
                    <a
                        href="{{ route('hutang_vendor.index') }}"
                        class="cursor-pointer"
                    >
                        <button
                            class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] max-[1300px]:w-[50px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                        >
                            <img
                                src="{{
                                    asset('assets/navbar/receipt-discount.png')
                                }}"
                                alt="receipt2 icon"
                                class="max-[1300px]:scale-200"
                            />
                            <span class="max-[1300px]:hidden">Hutang Vendor</span>
                        </button>
                    </a>

                    {{--
                    <a href="" class="cursor-pointer">
                        <button
                            class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] max-[1300px]:w-[50px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                        >
                            <img
                                src="https://ar4n-group.com/public/assets/navbar/chart.png"
                                alt="chart icon"
                                class="max-[1300px]:scale-200"
                            />
                            <span class="max-[1300px]:hidden">Laporan Laba Rugi</span>
                        </button>
                    </a>
                    <a href="" class="cursor-pointer">
                        <button
                            class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] max-[1300px]:w-[50px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                        >
                            <img
                                src="https://ar4n-group.com/public/assets/navbar/chart.png"
                                alt="chart icon"
                                class="max-[1300px]:scale-200"
                            />
                            <span class="max-[1300px]:hidden">Neraca</span>
                        </button>
                    </a>
                    --}}
                    <div class="grow flex items-end pb-3">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button
                                class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] max-[1300px]:w-[50px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                            >
                                <img
                                    src="https://ar4n-group.com/public/assets/navbar/logout.png"
                                    alt="logout icon"
                                    class="max-[1300px]:scale-200"
                                />
                                <span class="max-[1300px]:hidden">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </nav>
            <div class="w-full flex flex-col relative">
                {{-- header --}}
                <header
                    class="flex justify-between items-center px-10 py-4 shadow-[0px_1px_5px_rgba(0,0,0,0.25)] max-[1300px]:w-[calc(100%-60px)] max-[1300px]:ml-[60px]"
                >
                    <span class="text-base">pages / dashboard</span>
                    <div class="flex items-center gap-x-4">
                        <img
                            src="https://ar4n-group.com/public/assets/notification.png"
                            alt="notification icon"
                            class="w-[30px] cursor-pointer"
                        />
                        <div class="flex items-center gap-x-2">
                            <img
                                src="https://ar4n-group.com/public/assets/Ellipse 1.png"
                                alt="profile picture"
                                class="w-[40px] h-[40px]"
                            />
                            <div class="flex flex-col text-sm">
                                <span class="font-bold">Hi, {{ Auth::user()->name }}</span>
                                <span>{{ Auth::user()->role }}</span>
                            </div>
                        </div>
                    </div>
                </header>
                {{-- header --}}
                <div class="px-6 pt-5 pb-16 overflow-y-auto max-[1300px]:w-[calc(100vw-60px)] max-[1300px]:ml-[60px]">
                    @yield('content')
                </div>
                <footer
                    class="absolute bottom-0 z-50 flex justify-center w-full py-3 shadow-[0px_-1px_5px_rgba(0,0,0,0.25)] bg-white"
                >
                    <div class="text-center text-xs text-[#A8A8A8]">
                        Copyright@AR4N GROUP
                    </div>
                </footer>
            </div>
        </section>
       <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        <script src="https://ar4n-group.com/public/js/notification.js"></script>
        <script>
    console.log({
    buttonView: document.getElementById("buttonView"),
    nav: document.getElementById("sideNavbar"),
    logoFull: document.getElementById("logoFull"),
    justLogo: document.getElementById("justLogo"),
    sideNavbarContent: document.getElementById("sideNavbarContent")
});

document.addEventListener("DOMContentLoaded", () => {
    const buttonView = document.getElementById("buttonView");
    const arrowButton = buttonView ? buttonView.querySelector("img") : null;
    const nav = document.getElementById("sideNavbar");
    const logoFull = document.getElementById("logoFull");
    const justLogo = document.getElementById("justLogo");
    const sideNavbarContent = document.getElementById("sideNavbarContent");
    const children = sideNavbarContent ? sideNavbarContent.querySelectorAll("a, button") : [];
    const imgChild = sideNavbarContent ? sideNavbarContent.querySelectorAll("img") : [];
    const spanChild = sideNavbarContent ? sideNavbarContent.querySelectorAll("span") : [];

    // 🔹 Toggle sidebar
    if (buttonView) {
        buttonView.addEventListener("click", () => {
            buttonView.classList.toggle("left-10");
            buttonView.classList.toggle("left-[267px]");
            if (arrowButton) {
                arrowButton.classList.toggle("rotate-[-90deg]");
                arrowButton.classList.toggle("rotate-[180deg]");
            }
            if (nav) {
                nav.classList.toggle("max-[1300px]:w-[60px]");
                nav.classList.toggle("max-[1300px]:w-[280px]");
            }
            if (logoFull) logoFull.classList.toggle("max-[1300px]:hidden");
            if (justLogo) justLogo.classList.toggle("max-[1300px]:hidden");
            if (sideNavbarContent) sideNavbarContent.classList.toggle("max-[1300px]:items-center");

            children.forEach(item => {
                item.classList.toggle("max-[1300px]:w-[50px]");
            });
            imgChild.forEach(item => {
                item.classList.toggle("max-[1300px]:scale-200");
            });
            spanChild.forEach(item => {
                item.classList.toggle("max-[1300px]:hidden");
            });
        });
    }

    // 🔹 Simpan focus sidebar
    const link = document.querySelectorAll("nav a button");
    const sidebar = localStorage.getItem("sidebar");
    const user = @json(Auth::user()->name);

    link.forEach((item, index) => {
        item.addEventListener("click", () => {
            localStorage.setItem("sidebar", index);
        });

        if (sidebar == index) {
            item.classList.add(
                "bg-linear-to-r",
                "from-[#DD4049]",
                "to-[#F9E52D]",
                "text-white"
            );

            // ganti icon sesuai user & index
            if (user === "Admin 1") {
                if (index === 0) item.children[0].src = "https://ar4n-group.com/public/assets/navbar/home-click.png";
                else if (index === 1) item.children[0].src = "https://ar4n-group.com/public/assets/navbar/devices-click.png";
                else if (index === 2) item.children[0].src = "https://ar4n-group.com/public/assets/navbar/receipt-item-click.png";
                else if (index === 3) item.children[0].src = "https://ar4n-group.com/public/assets/navbar/receipt-item-click.png";
                else if (index === 4) item.children[0].src = "https://ar4n-group.com/public/assets/navbar/receipt-click.png";
                else if (index === 5) item.children[0].src = "https://ar4n-group.com/public/assets/navbar/status-up-click.png";
                else if (index === 6) item.children[0].src = "{{ asset('assets/navbar/book-click.png') }}";
                else if (index === 7) item.children[0].src = "{{ asset('assets/navbar/receipt-discount-click.png') }}";
            } else if (user === "Admin 2") {
                if (index === 0) item.children[0].src = "https://ar4n-group.com/public/assets/navbar/home-click.png";
                else if (index === 1) item.children[0].src = "https://ar4n-group.com/public/assets/navbar/devices-click.png";
                else if (index === 2) item.children[0].src = "https://ar4n-group.com/public/assets/navbar/receipt-item-click.png";
                else if (index === 3) item.children[0].src = "https://ar4n-group.com/public/assets/navbar/home-hashtag-click.png";
                else if (index === 4) item.children[0].src = "https://ar4n-group.com/public/assets/navbar/receipt-item-click.png";
                else if (index === 5) item.children[0].src = "https://ar4n-group.com/public/assets/navbar/receipt-click.png";
                else if (index === 6) item.children[0].src = "https://ar4n-group.com/public/assets/navbar/status-up-click.png";
                else if (index === 7) item.children[0].src = "{{ asset('assets/navbar/book-click.png') }}";
                else if (index === 8) item.children[0].src = "{{ asset('assets/navbar/receipt-discount-click.png') }}";
            } else {
                if (index === 0) item.children[0].src = "https://ar4n-group.com/public/assets/navbar/home-click.png";
                else if (index === 1) item.children[0].src = "https://ar4n-group.com/public/assets/navbar/devices-click.png";
                else if (index === 2) item.children[0].src = "https://ar4n-group.com/public/assets/navbar/receipt-item-click.png";
                else if (index === 3) item.children[0].src = "https://ar4n-group.com/public/assets/navbar/home-hashtag-click.png";
                else if (index === 4) item.children[0].src = "https://ar4n-group.com/public/assets/navbar/receipt-item-click.png";
                else if (index === 5) item.children[0].src = "https://ar4n-group.com/public/assets/navbar/receipt-item-click.png";
                else if (index === 6) item.children[0].src = "https://ar4n-group.com/public/assets/navbar/receipt-click.png";
                else if (index === 7) item.children[0].src = "https://ar4n-group.com/public/assets/navbar/status-up-click.png";
                else if (index === 8) item.children[0].src = "{{ asset('assets/navbar/book-click.png') }}";
                else if (index === 9) item.children[0].src = "{{ asset('assets/navbar/receipt-discount-click.png') }}";
            }
        } else {
            item.classList.remove(
                "bg-linear-to-r",
                "from-[#DD4049]",
                "to-[#F9E52D]",
                "text-white"
            );
        }
    });
});
</script>
    </body>


</html>
