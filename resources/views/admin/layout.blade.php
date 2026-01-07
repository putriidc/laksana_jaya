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


    </head>
    <body class="font-poppins">
        <section class="flex h-screen">
            <nav
                class="flex flex-col bg-white h-screen w-[350px] py-5 px-5 shadow-[1px_0px_5px_rgba(0,0,0,0.25)] items-center relative z-[99] overflow-y-auto overflow-x-hidden"
            >
                {{-- Logo --}}
                <div class="flex justify-between items-center gap-x-1 mb-8">
                    <img
                        src="https://ar4n-group.com/public/assets/ar4anSmallLogo.png"
                        alt="LOGO AR4N GROUP"
                        class="w-[100px]"
                    />
                    <h1 class="leading-6 font-bold text-2xl text-[#353132]">
                        AR4N <br />
                        GROUP
                    </h1>
                </div>
                {{-- logo --}}
                <div class="flex flex-col gap-y-3 h-full">
                    <a href="/admin/dashboard" class="cursor-pointer">
                        <button
                            class="bg-linear-to-r from-[#DD4049] to-[#F9E52D] text-white flex items-center gap-x-5 w-[250px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                        >
                            <img
                                src="https://ar4n-group.com/public/assets/navbar/home-2.png"
                                alt="home icon"
                            />
                            <span>Dashboard</span>
                        </button>
                    </a>
                    <a href="/admin/master-data" class="cursor-pointer">
                        <button
                            class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                        >
                            <img
                                src="https://ar4n-group.com/public/assets/navbar/devices.png"
                                alt="devices icon"
                            />
                            <span>Master Data</span>
                        </button>
                    </a>
                    <a
                        href="{{ route('jurnalUmums.index') }}"
                        class="cursor-pointer"
                    >
                        <button
                            class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                        >
                            <img
                                src="https://ar4n-group.com/public/assets/navbar/receipt-item.png"
                                alt="receipt icon"
                            />
                            <span>Jurnal Umum</span>
                        </button>
                    </a>
                    {{--
                    <a href="" class="cursor-pointer">
                        <button
                            class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                        >
                            <img
                                src="https://ar4n-group.com/public/assets/navbar/folder-open.png"
                                alt="folder icon"
                            />
                            <span>Buku Besar</span>
                        </button>
                    </a>
                    --}}
                    @if ( Auth::user()->name != "Novi" )
                    <a
                        href="{{ route('sampingans.index') }}"
                        class="cursor-pointer"
                    >
                        <button
                            class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                        >
                            <img
                                src="https://ar4n-group.com/public/assets/navbar/home-hashtag.png"
                                alt="home hashtag icon"
                            />
                            <span>Freelance</span>
                        </button>
                    </a>
                    <a
                    href="{{ route('pinjamanKaryawans.index') }}"
                    class="cursor-pointer"
                    >
                    <button
                    class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                    >
                    <img
                    src="https://ar4n-group.com/public/assets/navbar/receipt-item.png"
                                alt="receipt2 icon"
                                />
                                <span>Pinjaman Karyawan</span>
                            </button>
                        </a>
                    @endif
                    @if (Auth::user()->name != "Siska")
                    <a
                        href="{{ route('pinjamanTukangs.index') }}"
                        class="cursor-pointer"
                    >
                        <button
                            class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                        >
                            <img
                                src="https://ar4n-group.com/public/assets/navbar/receipt-item.png"
                                alt="receipt2 icon"
                            />
                            <span>Pinjaman Tukang</span>
                        </button>
                    </a>
                    @endif
                    <a
                        href="{{ route('eaf.index') }}"
                        class="cursor-pointer"
                    >
                        <button
                            class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                        >
                            <img
                                src="https://ar4n-group.com/public/assets/navbar/receipt.png"
                                alt="receipt2 icon"
                            />
                            <span>Form EAF</span>
                        </button>
                    </a>
                    <a
                        href="{{ route('laporanHarian.index') }}"
                        class="cursor-pointer"
                    >
                        <button
                            class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                        >
                            <img
                                src="https://ar4n-group.com/public/assets/navbar/status-up.png"
                                alt="receipt2 icon"
                            />
                            <span>Laporan Harian</span>
                        </button>
                    </a>
                    <a
                        href="/bukubesar/111"
                        class="cursor-pointer"
                    >
                        <button
                            class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                        >
                            <img
                                src="https://ar4n-group.com/public/assets/navbar/book.png"
                                alt="receipt2 icon"
                            />
                            <span>Buku Besar</span>
                        </button>
                    </a>

                    {{--
                    <a href="" class="cursor-pointer">
                        <button
                            class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                        >
                            <img
                                src="https://ar4n-group.com/public/assets/navbar/chart.png"
                                alt="chart icon"
                            />
                            <span>Laporan Laba Rugi</span>
                        </button>
                    </a>
                    <a href="" class="cursor-pointer">
                        <button
                            class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                        >
                            <img
                                src="https://ar4n-group.com/public/assets/navbar/chart.png"
                                alt="chart icon"
                            />
                            <span>Neraca</span>
                        </button>
                    </a>
                    --}}
                    <div class="grow flex items-end pb-3">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button
                                class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                            >
                                <img
                                    src="https://ar4n-group.com/public/assets/navbar/logout.png"
                                    alt="logout icon"
                                />
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </nav>
            <div class="w-full flex flex-col relative">
                {{-- header --}}
                <header
                    class="flex justify-between items-center px-10 py-4 shadow-[0px_1px_5px_rgba(0,0,0,0.25)]"
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
                <div class="px-6 pt-5 pb-16 overflow-y-auto">
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

        <script>
            // menyimpan focus pada sidebar ketika di klik
            const link = document.querySelectorAll("nav a button");
            const icon = document.querySelectorAll("nav a button img");
            const sidebar = localStorage.getItem("sidebar");
            const user = @json(Auth::user()->name);
            console.log(user);
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
                    // ganti icon navbar sesuai indexnya
                    if (user == "Novi") {
                        if (index == 0) {
                            item.children[0].src = "https://ar4n-group.com/public/assets/navbar/home-click.png";
                        } else if (index == 1) {
                            item.children[0].src = "https://ar4n-group.com/public/assets/navbar/devices-click.png";
                        } else if (index == 2) {
                            item.children[0].src = "https://ar4n-group.com/public/assets/navbar/receipt-item-click.png";
                        } else if (index == 3) {
                            item.children[0].src = "https://ar4n-group.com/public/assets/navbar/receipt-item-click.png";
                        } else if (index == 4) {
                            item.children[0].src = "https://ar4n-group.com/public/assets/navbar/receipt-click.png";
                        } else if (index == 5) {
                            item.children[0].src = "https://ar4n-group.com/public/assets/navbar/status-up-click.png";
                        } else if (index == 6) {
                            item.children[0].src = "https://ar4n-group.com/public/assets/navbar/book-click.png";
                        }
                    } else if (user == "Siska") {
                        if (index == 0) {
                            item.children[0].src = "https://ar4n-group.com/public/assets/navbar/home-click.png";
                        } else if (index == 1) {
                            item.children[0].src = "https://ar4n-group.com/public/assets/navbar/devices-click.png";
                        } else if (index == 2) {
                            item.children[0].src = "https://ar4n-group.com/public/assets/navbar/receipt-item-click.png";
                        } else if (index == 3) {
                            item.children[0].src = "https://ar4n-group.com/public/assets/navbar/home-hashtag-click.png";
                        } else if (index == 4) {
                            item.children[0].src = "https://ar4n-group.com/public/assets/navbar/receipt-item-click.png";
                        } else if (index == 5) {
                            item.children[0].src = "https://ar4n-group.com/public/assets/navbar/receipt-click.png";
                        } else if (index == 6) {
                            item.children[0].src = "https://ar4n-group.com/public/assets/navbar/status-up-click.png";
                        } else if (index == 7) {
                            item.children[0].src = "https://ar4n-group.com/public/assets/navbar/book-click.png";
                        }
                    } else {
                        if (index == 0) {
                            item.children[0].src = "https://ar4n-group.com/public/assets/navbar/home-click.png";
                        } else if (index == 1) {
                            item.children[0].src = "https://ar4n-group.com/public/assets/navbar/devices-click.png";
                        } else if (index == 2) {
                            item.children[0].src = "https://ar4n-group.com/public/assets/navbar/receipt-item-click.png";
                        } else if (index == 3) {
                            item.children[0].src = "https://ar4n-group.com/public/assets/navbar/home-hashtag-click.png";
                        } else if (index == 4) {
                            item.children[0].src = "https://ar4n-group.com/public/assets/navbar/receipt-item-click.png";
                        } else if (index == 5) {
                            item.children[0].src = "https://ar4n-group.com/public/assets/navbar/receipt-item-click.png";
                        } else if (index == 6) {
                            item.children[0].src = "https://ar4n-group.com/public/assets/navbar/receipt-click.png";
                        } else if (index == 7) {
                            item.children[0].src = "https://ar4n-group.com/public/assets/navbar/status-up-click.png";
                        } else if (index == 8) {
                            item.children[0].src = "https://ar4n-group.com/public/assets/navbar/book-click.png";
                        }
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
        </script>
        <script src="https://ar4n-group.com/public/js/notification.js"></script>
    </body>
</html>
