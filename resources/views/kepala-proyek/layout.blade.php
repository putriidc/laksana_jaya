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
            class="flex flex-col bg-white h-screen w-[300px] py-5 px-5 shadow-[1px_0px_8px_rgba(0,0,0,0.25)] items-center relative z-[99]">
            {{-- Logo --}}
            <div class="flex justify-between items-center gap-x-1 mb-8">
                <img src="{{ asset('assets/ar4anSmallLogo.png') }}" alt="LOGO AR4N GROUP" class="w-[100px]" />
                <h1 class="leading-6 font-bold text-2xl text-[#353132]">
                    AR4N <br />
                    GROUP
                </h1>
            </div>
            {{-- logo --}}
            <div class="flex flex-col gap-y-3 h-full">
                <a href="/kepala-proyek" class="cursor-pointer">
                        <button
                            class="bg-linear-to-r from-[#DD4049] to-[#F9E52D] text-white flex items-center gap-x-5 w-[250px] py-3 px-5 rounded-lg cursor-pointer shadow-[0px_0px_15px_rgba(0,0,0,0.25)]"
                        >
                            <img
                                src="{{
                                    asset(
                                        'assets/navbar-kepala-gudang/home-2.png'
                                    )
                                }}"
                                alt="home icon"
                            />
                            <span>Dashboard</span>
                        </button>
                    </a>
                <label
                    class="bg-linear-to-r from-[#DD4049] to-[#F9E52D] z-50 text-white flex justify-between items-center w-[250px] py-3 px-5 rounded-lg cursor-pointer shadow-[0px_0px_15px_rgba(0,0,0,0.25)] link-clicked select-none">
                    <div class="flex gap-x-5 items-center">
                        <img src="{{ asset('assets/navbar-kepala-gudang/home-2.png') }}"
                            alt="home icon" />
                        <span>Data Proyek</span>
                    </div>
                    <img src="{{ asset('assets/arrow-down-white.png') }}" alt="arrow down icon" id="arrow-navbar"
                        class="transition-all duration-300 ease-in-out" />
                    <input type="checkbox" id="dropdown-toggle-navbar" class="hidden" />
                </label>
                <div class="flex flex-col gap-y-3 -translate-y-[60px] transition-all duration-300 ease-in-out"
                    id="dropdown-content">
                    {{-- <a href="/kepala-proyek/data-proyek-gumilang" class="cursor-pointer">
                        <button
                            class="bg-white text-[#353132] flex items-center justify-center w-[250px] py-3 px-5 cursor-pointer link-clicked">
                            <span>CV ARS GUMILANG</span>
                        </button>
                    </a>
                    <a href="/kepala-proyek/data-proyek-purnama"
                        class="cursor-pointer -translate-y-[60px] transition-all duration-300 ease-in-out"
                        id="inside-content">
                        <button
                            class="bg-white text-[#353132] flex items-center justify-center w-[250px] py-3 px-5 cursor-pointer link-clicked">
                            <span>CV ARN PURNAMA</span>
                        </button>
                    </a> --}}
                    @forelse($sidebarPerusahaans as $perusahaan)
                        <a href="{{ route('perusahaan.show', $perusahaan->id) }}"
                            class="cursor-pointer -translate-y-[60px] transition-all duration-300 ease-in-out"
                        id="inside-content">
                            <button
                                class="bg-white text-[#353132] flex items-center justify-center w-[250px] py-3 px-5 cursor-pointer link-clicked">
                                <span>{{ $perusahaan->nama_perusahaan }}</span>
                            </button>
                        </a>
                    @empty
                        <div id="inside-content" class="text-sm text-red-600 px-4 py-2">Belum ada perusahaan terdaftar</div>
                    @endforelse
                        <button id="modal-add"
                            class="bg-white text-[#353132] flex items-center justify-center w-[250px] py-3 px-5 cursor-pointer link-clicked">
                            <span>TAMBAH PERUSAHAAN +</span>
                        </button>
                </div>
                <a href="/kepala-proyek/data-proyek/create"
                    class="cursor-pointer -translate-y-[120px] transition-all duration-300 ease-in-out outside-content">
                    <button
                        class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] py-3 px-5 rounded-lg cursor-pointer shadow-[0px_0px_15px_rgba(0,0,0,0.25)] link-clicked">
                        <img src="{{ asset('assets/navbar/chart.png') }}"
                            alt="cube scan icon" />
                        <span>Input Data Proyek</span>
                    </button>
                </a>
                <div class="grow flex items-end">
                    <a href="/logout" class="cursor-pointer">
                        <button
                            class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] py-3 px-5 rounded-lg cursor-pointer shadow-[0px_0px_15px_rgba(0,0,0,0.25)]">
                            <img src="{{ asset('assets/navbar/logout.png') }}" alt="logout icon" />
                            <span>Logout</span>
                        </button>
                    </a>
                </div>
            </div>
        </nav>
        <div class="w-full flex flex-col relative">
            {{-- header --}}
            <header class="flex justify-between items-center px-10 py-4 shadow-[0px_1px_8px_rgba(0,0,0,0.25)]">
                <span class="text-base">pages / dashboard</span>
                <div class="flex items-center gap-x-4">
                    <img src="{{ asset('assets/notification.png') }}" alt="notification icon"
                        class="w-[30px] cursor-pointer" />
                    <div class="flex items-center gap-x-2">
                        <img src="{{ asset('assets/Ellipse 1.png') }}" alt="profile picture"
                            class="w-[40px] h-[40px]" />
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
                class="absolute bottom-0 z-50 flex justify-center w-full py-3 shadow-[0px_-1px_8px_rgba(0,0,0,0.25)] bg-white">
                <div class="text-center text-xs text-[#A8A8A8]">
                    Copyright@AR4N GROUP
                </div>
            </footer>
        </div>
    </section>
    <script>
        // menyimpan focus pada sidebar ketika di klik
        const link = document.querySelectorAll("#link-clicked");
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

        // dropdown navbar
        const dropdownToggle = document.getElementById("dropdown-toggle-navbar");
        const dropdownContent = document.getElementById("dropdown-content");
        const insideContent = document.getElementById("inside-content");
        const outsideContent = document.querySelectorAll(".outside-content");
        const arrowNavbar = document.getElementById("arrow-navbar");

        dropdownToggle.addEventListener("click", () => {
            dropdownContent.classList.toggle("-translate-y-[60px]");
            insideContent.classList.toggle("-translate-y-[60px]");
            arrowNavbar.classList.toggle("-rotate-90");
            // mengatur isi dari dropdowncontent
            dropdownContent.children[0].classList.toggle(
                "shadow-[0px_0px_15px_rgba(0,0,0,0.25)]"
            );
            dropdownContent.children[1].classList.toggle(
                "shadow-[0px_0px_15px_rgba(0,0,0,0.25)]"
            );
            outsideContent.forEach((item) => {
                item.classList.toggle("-translate-y-[120px]");
            });
        })
    </script>

</body>

</html>
