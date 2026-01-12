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
    <section class="flex h-screen max-[550px]:overflow-x-hidden">
        <nav
            class="max-[1200px]:absolute flex flex-col max-[1200px]:items-center bg-white h-screen w-[350px] max-[1200px]:w-[60px] max-[550px]:w-full max-[550px]:translate-x-[-100vw] py-5 px-5 shadow-[1px_0px_8px_rgba(0,0,0,0.25)] items-center relative z-[99] overflow-y-auto overflow-x-hidden max-[1200px]:overflow-x-hidden max-[1200px]:transition-all max-[1200px]:ease-in-out max-[1200px]:duration-200" id="sideNavbar"> {{-- Bagian yang di responsive --}}
            {{-- button view --}}
            <button class="min-[1200px]:hidden max-[550px]:hidden bg-white shadow-[0px_1px_8px_rgba(0,0,0,0.25)] rounded-full p-2 fixed top-[50%] left-11 rotate-[-90deg] z-[99] transition-all duration-200 ease-in-out" id="buttonView">
                <img src="{{ asset('assets/arrow-down.png') }}" alt="arrow view" class="w-[15px]">
            </button>
            {{-- button view --}}
            {{-- Logo --}}
            <div class="flex justify-between items-center gap-x-1 mb-8 max-[1200px]:hidden max-[550px]:w-full max-[550px]:px-2" id="logoFull"> {{-- bagian yang di responsive --}}
                <img src="{{ asset('assets/ar4anSmallLogo.png') }}" alt="LOGO AR4N GROUP" class="max-[550px]:w-[70px]" />
                <h1 class="leading-6 font-bold text-2xl text-[#353132] max-[550px]:text-xl">
                    AR4N <br class="max-[550px]:hidden"/>
                    GROUP
                </h1>
                <button class="min-[550px]:hidden w-[30px] flex flex-col gap-y-[7px]" id="buttonClose">
                    <span class="border-t-[3px] border-gray-400 w-full rotate-45 translate-y-[5px]"></span>
                    <span class="border-b-[3px] border-gray-400 w-full -rotate-45 -translate-y-[5px]"></span>
                </button>
            </div>
            <img src="{{ asset('assets/ar4anSmallLogo.png') }}" alt="LOGO AR4N GROUP" class="w-[60px] min-[1200px]:hidden mb-8 scale-200" id="justLogo"/> {{-- Bagian yang muncul karena responsive --}}
            {{-- logo --}}
            <div class="flex flex-col max-[1200px]:items-center gap-y-3 h-full" id="sideNavbarContent"> {{-- Bagian yang di responsive --}}
                <a href="/gudang" class="cursor-pointer">
                        <button
                            class="bg-linear-to-r from-[#DD4049] to-[#F9E52D] text-white flex items-center gap-x-5 w-[250px] max-[1200px]:w-[50px] py-3 px-5 rounded-lg cursor-pointer shadow-[0px_0px_15px_rgba(0,0,0,0.25)]" {{-- Bagian yang di responsive --}}
                        >
                            <img
                                src="{{
                                    asset(
                                        'assets/navbar-kepala-gudang/home-2.png'
                                    )
                                }}"
                                alt="home icon"
                                class="max-[1200px]:scale-200"
                            />
                            <span class="max-[1200px]:hidden">Dashboard</span>
                        </button>
                    </a>
                <a href="{{ route('barangs.index') }}" class="cursor-pointer">
                    <button
                        class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] max-[1200px]:w-[50px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"> {{-- Bagian yang di responsive --}}
                            <img
                                src="{{
                                    asset(
                                        'assets/navbar-kepala-gudang/3d-cube-scan.png'
                                    )
                                }}"
                                alt="cube scan icon"
                                class="max-[1200px]:scale-200"
                            />
                            <span class="max-[1200px]:hidden">Data Barang</span>
                    </button>
                </a>
                <a href="{{ route('alats.index') }}" class="cursor-pointer">
                    <button
                        class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] max-[1200px]:w-[50px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"> {{-- Bagian yang di responsive --}}
                            <img
                                src="{{
                                    asset(
                                        'assets/navbar-kepala-gudang/3d-cube-scan.png'
                                    )
                                }}"
                                alt="cube scan icon"
                                class="max-[1200px]:scale-200"
                            />
                            <span class="max-[1200px]:hidden">Data Alat</span>
                    </button>
                </a>
                <a href="{{ route('accspv.index') }}" class="cursor-pointer">
                    <button
                        class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] max-[1200px]:w-[50px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"> {{-- Bagian yang di responsive --}}
                            <img
                                src="{{
                                    asset(
                                        'assets/navbar-kepala-gudang/wallet-minus.png'
                                    )
                                }}"
                                alt="convert 3d cube icon"
                                class="max-[1200px]:scale-200"
                            />
                            <span class="max-[1200px]:hidden">Pinjaman Tukang</span>
                    </button>
                </a>
                <a href="{{ route('AccEafSpv.index') }}" class="cursor-pointer">
                    <button
                        class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] max-[1200px]:w-[50px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"> {{-- Bagian yang di responsive --}}
                            <img
                                src="{{
                                    asset(
                                        'assets/navbar-kepala-gudang/wallet-minus.png'
                                    )
                                }}"
                                alt="convert 3d cube icon"
                                class="max-[1200px]:scale-200"
                            />
                            <span class="max-[1200px]:hidden">Pengajuan EAF</span>
                    </button>
                </a>
                <div class="grow flex items-end pb-3 max-[550px]:w-full">
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
            <header class="flex justify-between items-center px-10 max-[550px]:px-4 py-4 shadow-[0px_1px_5px_rgba(0,0,0,0.25)] max-[1200px]:w-[calc(100%-60px)] max-[550px]:w-full max-[1200px]:ml-[60px] max-[550px]:ml-0 "> {{-- Bagian yang di responsive --}}
                <button class="min-[550px]:hidden w-[30px] flex flex-col gap-y-[7px]" id="buttonBurger">
                    <span class="w-full border border-gray-400"></span>
                    <span class="w-full border border-gray-400"></span>
                    <span class="w-full border border-gray-400"></span>
                </button>
                <span class="text-base">pages / dashboard</span>
                <div class="flex items-center gap-x-4 max-[420px]:gap-x-2">
                    <img src="{{ asset('assets/notification.png') }}" alt="notification icon"
                        class="w-[30px] cursor-pointer" />
                    <div class="flex items-center gap-x-2">
                        <img src="{{ asset('assets/Ellipse 1.png') }}" alt="profile picture"
                            class="w-[40px] h-[40px] max-[640px]:hidden" />
                            <button class="min-[640px]:hidden" id="profilButton">
                                <img src="{{ asset('assets/Ellipse 1.png') }}" alt="profile picture"
                                    class="w-[40px] h-[40px]" />
                            </button>
                            <div class="flex flex-col text-sm max-[640px]:hidden">
                                <span class="font-bold">Hi, {{ Auth::user()->name }}</span>
                                <span>{{ Auth::user()->role }}</span>
                            </div>
                            <div class="min-[640px]:hidden hidden flex-col items-start gap-y-1 fixed bg-white shadow-[0px_0px_5px_rgba(0,0,0,0.25)] top-20 right-5 p-4" id="profil">
                                <span class="font-bold">Hi, {{ Auth::user()->name }}</span>
                                <span>{{ Auth::user()->role }}</span>
                            </div>
                    </div>
                </div>
            </header>
            {{-- header --}}
            <div class="px-6 pt-5 pb-16 overflow-y-auto max-[1200px]:w-[calc(100vw-60px)] max-[550px]:w-full max-[1200px]:ml-[60px] max-[550px]:ml-0"> {{-- Bagian yang di responsive --}}
                @yield('content')
            </div>
            <footer
                class="absolute bottom-0 z-50 left-0 flex justify-center w-full py-3 shadow-[0px_-1px_8px_rgba(0,0,0,0.25)] bg-white">
                <div class="text-center text-xs text-[#A8A8A8]">
                    Copyright@AR4N GROUP
                </div>
            </footer>
        </div>
    </section>
    <script>
        // membuat fungsi jika button navbar di klik maka dia akan menampilkan sidenavbar secara penuh
        const buttonView = document.getElementById("buttonView");
        const arrowButton = buttonView.querySelector("img");
        const nav = document.getElementById("sideNavbar");
        const logoFull = document.getElementById("logoFull")
        const justLogo = document.getElementById("justLogo")
        const sideNavbarContent = document.getElementById("sideNavbarContent")
        const children = sideNavbarContent.querySelectorAll('button');
        const imgChild = sideNavbarContent.querySelectorAll('img');
        const spanChild = sideNavbarContent.querySelectorAll('span');
        buttonView.addEventListener("click", () => {
            buttonView.classList.toggle("left-11");
            buttonView.classList.toggle("left-[267px]");
            arrowButton.classList.toggle("rotate-[-90deg]");
            arrowButton.classList.toggle("rotate-[180deg]");
            nav.classList.toggle("max-[1200px]:w-[60px]");
            nav.classList.toggle("max-[1200px]:w-[280px]");
            logoFull.classList.toggle("max-[1200px]:hidden");
            justLogo.classList.toggle("max-[1200px]:hidden");
            sideNavbarContent.classList.toggle("max-[1200px]:items-center");
            // sideNavbarContent.classList.toggle('max-[1200px]:')
            // di sideNavbarContent terdapat beberapa tombol link yang akan kita manipulasi secara bersamaan
            children.forEach((item, index) => {
                item.classList.toggle("max-[1200px]:w-[50px]");
            })
            imgChild.forEach((item, index) => {
                item.classList.toggle("max-[1200px]:scale-200");
            })
            spanChild.forEach((item, index) => {
                item.classList.toggle("max-[1200px]:hidden");
            })
        });

        const buttonBurger = document.getElementById("buttonBurger");
        buttonBurger.addEventListener("click", () => {
            nav.classList.toggle("max-[550px]:translate-x-[-100vw]");
            sideNavbarContent.classList.toggle("max-[550px]:w-full")
            logoFull.classList.toggle("max-[1200px]:hidden");
            justLogo.classList.toggle("max-[1200px]:hidden");
            sideNavbarContent.classList.toggle("max-[1200px]:items-center");
            // sideNavbarContent.classList.toggle('max-[1200px]:')
            // di sideNavbarContent terdapat beberapa tombol link yang akan kita manipulasi secara bersamaan
            children.forEach((item, index) => {
                item.classList.toggle("max-[1200px]:w-[50px]");
                item.classList.toggle("max-[550px]:w-full");
            })
            imgChild.forEach((item, index) => {
                item.classList.toggle("max-[1200px]:scale-200");
            })
            spanChild.forEach((item, index) => {
                item.classList.toggle("max-[1200px]:hidden");
            })
        })

        const buttonClose = document.getElementById("buttonClose");
        buttonClose.addEventListener("click", () => {
            nav.classList.toggle("max-[550px]:translate-x-[-100vw]");
            sideNavbarContent.classList.toggle("max-[550px]:w-full")
            logoFull.classList.toggle("max-[1200px]:hidden");
            justLogo.classList.toggle("max-[1200px]:hidden");
            sideNavbarContent.classList.toggle("max-[1200px]:items-center");
            // sideNavbarContent.classList.toggle('max-[1200px]:')
            // di sideNavbarContent terdapat beberapa tombol link yang akan kita manipulasi secara bersamaan
            children.forEach((item, index) => {
                item.classList.toggle("max-[1200px]:w-[50px]");
                item.classList.toggle("max-[550px]:w-full");
            })
            imgChild.forEach((item, index) => {
                item.classList.toggle("max-[1200px]:scale-200");
            })
            spanChild.forEach((item, index) => {
                item.classList.toggle("max-[1200px]:hidden");
            })
        })

        // profil button
        const profilButton = document.getElementById("profilButton");
        const profil = document.getElementById("profil");
        profilButton.addEventListener("click", () => {
            profil.classList.toggle("hidden");
            profil.classList.toggle("flex");
        })

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
                // ganti icon navbar sesuai indexnya
                   if (index == 0) {
                        item.children[0].src = "{{ asset('assets/navbar/home-click.png') }}";
                    } else if (index == 1) {
                        item.children[0].src = "{{ asset('assets/navbar-kepala-gudang/3d-cube-scan-click.png') }}";
                    } else if (index == 2) {
                        item.children[0].src = "{{ asset('assets/navbar-kepala-gudang/3d-cube-scan-click.png') }}";
                    } else if (index == 3) {
                        item.children[0].src = "{{ asset('assets/navbar-kepala-gudang/wallet-minus-click.png') }}";
                    } else if (index == 4) {
                        item.children[0].src = "{{ asset('assets/navbar-kepala-gudang/wallet-minus-click.png') }}";
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
</body>

</html>
