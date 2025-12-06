<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Admin</title>
        @vite('resources/css/app.css') @vite('resources/js/app.js')
    </head>
    <body class="font-poppins">
        <section class="flex h-screen">
            <nav
                class="flex flex-col bg-white h-screen w-[350px] py-5 px-5 shadow-[1px_0px_5px_rgba(0,0,0,0.25)] items-center relative z-[99] overflow-y-auto overflow-x-hidden"
            >
                {{-- Logo --}}
                <div class="flex justify-between items-center gap-x-1 mb-8">
                    <img
                        src="{{ asset('assets/ar4anSmallLogo.png') }}"
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
                                src="{{ asset('assets/navbar/home-2.png') }}"
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
                                src="{{ asset('assets/navbar/devices.png') }}"
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
                                src="{{
                                    asset('assets/navbar/receipt-item.png')
                                }}"
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
                                src="{{
                                    asset('assets/navbar/folder-open.png')
                                }}"
                                alt="folder icon"
                            />
                            <span>Buku Besar</span>
                        </button>
                    </a>
                    --}}
                    <a
                        href="{{ route('sampingans.index') }}"
                        class="cursor-pointer"
                    >
                        <button
                            class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                        >
                            <img
                                src="{{
                                    asset('assets/navbar/home-hashtag.png')
                                }}"
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
                                src="{{
                                    asset('assets/navbar/receipt-item.png')
                                }}"
                                alt="receipt2 icon"
                            />
                            <span>Pinjaman Karyawan</span>
                        </button>
                    </a>
                    <a
                        href="/pinjaman-tukang"
                        class="cursor-pointer"
                    >
                        <button
                            class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                        >
                            <img
                                src="{{
                                    asset('assets/navbar/receipt-item.png')
                                }}"
                                alt="receipt2 icon"
                            />
                            <span>Pinjaman Tukang</span>
                        </button>
                    </a>
                    <a
                        href="/pinjaman-tukang"
                        class="cursor-pointer"
                    >
                        <button
                            class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                        >
                            <img
                                src="{{
                                    asset('assets/navbar/receipt-item.png')
                                }}"
                                alt="receipt2 icon"
                            />
                            <span>Pinjaman Tukang</span>
                        </button>
                    </a>
                    <a
                        href="/pinjaman-tukang"
                        class="cursor-pointer"
                    >
                        <button
                            class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                        >
                            <img
                                src="{{
                                    asset('assets/navbar/receipt-item.png')
                                }}"
                                alt="receipt2 icon"
                            />
                            <span>Pinjaman Tukang</span>
                        </button>
                    </a>
                    
                    {{--
                    <a href="" class="cursor-pointer">
                        <button
                            class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                        >
                            <img
                                src="{{ asset('assets/navbar/chart.png') }}"
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
                                src="{{ asset('assets/navbar/chart.png') }}"
                                alt="chart icon"
                            />
                            <span>Neraca</span>
                        </button>
                    </a>
                    --}}
                    <div class="grow flex items-end">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button
                                class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"
                            >
                                <img
                                    src="{{
                                        asset('assets/navbar/logout.png')
                                    }}"
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
                            src="{{ asset('assets/notification.png') }}"
                            alt="notification icon"
                            class="w-[30px] cursor-pointer"
                        />
                        <div class="flex items-center gap-x-2">
                            <img
                                src="{{ asset('assets/Ellipse 1.png') }}"
                                alt="profile picture"
                                class="w-[40px] h-[40px]"
                            />
                            <div class="flex flex-col text-sm">
                                <span class="font-bold">Hi, Siska</span>
                                <span>Admin Keuangan</span>
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
        <script>
            // menyimpan focus pada sidebar ketika di klik
            const link = document.querySelectorAll("nav a button");
            const icon = document.querySelectorAll("nav a button img");
            const sidebar = localStorage.getItem("sidebar");
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
        <script src="{{ asset('js/notification.js') }}"></script>
    </body>
</html>
