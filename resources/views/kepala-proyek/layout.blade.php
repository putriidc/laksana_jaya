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
    @if(session('success'))
    <div
        id="flash-message"
        data-type="success"
        data-message="{{ session('success') }}"
    ></div>
    @endif
    <section class="flex h-screen">
        <nav
            class="max-[1200px]:absolute flex flex-col max-[1200px]:items-center bg-white h-screen w-[350px] max-[1200px]:w-[60px] py-5 px-5 shadow-[1px_0px_8px_rgba(0,0,0,0.25)] items-center relative z-[99] overflow-y-auto overflow-x-hidden max-[1200px]:overflow-x-hidden max-[1200px]:transition-all max-[1200px]:ease-in-out max-[1200px]:duration-300" id="sideNavbar"> {{-- Bagian yang di responsive --}}
            {{-- button view --}}
            <button class="min-[1200px]:hidden bg-white shadow-[0px_1px_8px_rgba(0,0,0,0.25)] rounded-full p-2 fixed top-[50%] left-10 rotate-[-90deg] z-[99] transition-all duration-300 ease-in-out" id="buttonView">
                <img src="{{ asset('assets/arrow-down.png') }}" alt="arrow view">
            </button>
            {{-- button view --}}
            {{-- Logo --}}
            <div class="flex justify-between items-center gap-x-1 mb-8 max-[1200px]:hidden" id="logoFull"> {{-- bagian yang di responsive --}}
                <img src="{{ asset('assets/ar4anSmallLogo.png') }}" alt="LOGO AR4N GROUP" />
                <h1 class="leading-6 font-bold text-2xl text-[#353132]">
                    AR4N <br />
                    GROUP
                </h1>
            </div>
            <img src="{{ asset('assets/ar4anSmallLogo.png') }}" alt="LOGO AR4N GROUP" class="w-[60px] min-[1200px]:hidden mb-8 scale-200" id="justLogo"/> {{-- Bagian yang muncul karena responsive --}}
            {{-- logo --}}
            <div class="flex flex-col max-[1200px]:items-center gap-y-3 h-full" id="sideNavbarContent"> {{-- Bagian yang di responsive --}}
                <a href="/kepala-proyek" class="cursor-pointer">
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
                {{-- <label
                    class="bg-linear-to-r from-[#DD4049] to-[#F9E52D] z-50 text-white flex justify-between items-center w-[250px] py-3 px-5 rounded-lg cursor-pointer shadow-[0px_0px_15px_rgba(0,0,0,0.25)] select-none">
                    <div class="flex gap-x-5 items-center">
                        <img src="{{ asset('assets/navbar-kepala-gudang/home-2.png') }}"
                            alt="home icon" />
                        <span>Data Proyek</span>
                    </div>
                    <img src="{{ asset('assets/arrow-down-white.png') }}" alt="arrow down icon" id="arrow-navbar"
                        class="transition-all duration-300 ease-in-out" />
                    <input type="checkbox" id="dropdown-toggle-navbar" class="hidden" />
                </label>
                <div class="flex flex-col gap-y-3" id="dropdown-content"> --}}
                    {{-- <a href="/kepala-proyek/data-proyek-gumilang" class="cursor-pointer">
                        <button
                            class="bg-white text-[#353132] flex items-center justify-center w-[250px] py-3 px-5 cursor-pointer">
                            <span>CV ARS GUMILANG</span>
                        </button>
                    </a>
                    <a href="/kepala-proyek/data-proyek-purnama"
                        class="cursor-pointer -translate-y-[60px] transition-all duration-300 ease-in-out"
                        id="inside-content">
                        <button
                            class="bg-white text-[#353132] flex items-center justify-center w-[250px] py-3 px-5 cursor-pointer">
                            <span>CV ARN PURNAMA</span>
                        </button>
                    </a> --}}
                    {{-- @forelse($sidebarPerusahaans as $perusahaan)
                        <a href="{{ route('perusahaan.show', $perusahaan->id) }}"
                            class="cursor-pointer transition-all duration-300 ease-in-out">
                            <button
                                class="bg-white text-[#353132] flex items-center justify-center w-[250px] py-3 px-5 cursor-pointer rounded-lg">
                                <span>{{ $perusahaan->nama_perusahaan }}</span>
                            </button>
                        </a>
                    @empty
                        <div class="text-sm text-red-600 px-4 py-2 transition-all duration-300 ease-in-out text-center italic">Belum ada perusahaan terdaftar</div>
                    @endforelse
                        <button id="modal-add"
                            class="bg-white text-[#353132] flex items-center justify-center w-[250px] py-3 px-5 cursor-pointer rounded-lg transition-all duration-300 ease-in-out">
                            <span>TAMBAH PERUSAHAAN +</span>
                        </button>
                </div> --}}
                {{-- dropdown baru --}}
                <!-- Include this script tag or install `@tailwindplus/elements` via npm: -->
                <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> -->
                {{-- <el-dropdown class="inline-block">
                <button class="bg-linear-to-r from-[#DD4049] to-[#F9E52D] text-white flex items-center gap-x-5 w-[250px] py-3 px-5 rounded-lg cursor-pointer shadow-[0px_0px_15px_rgba(0,0,0,0.25)]">
                    <img src="{{ asset('assets/navbar-kepala-gudang/home-2.png') }}"
                            alt="home icon" />
                    <span>Data Proyek</span>
                    <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class=" size-5 text-white ml-10">
                    <path d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                    </svg>
                </button>

                <el-menu anchor="bottom end" popover class="w-[250px] origin-top-right rounded-md bg-gray-800 outline-1 -outline-offset-1 outline-white/10 transition transition-discrete [--anchor-gap:--spacing(2)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in">
                    <div class="py-1">
                    @forelse($sidebarPerusahaans as $perusahaan)
                        <a href="{{ route('perusahaan.show', $perusahaan->id) }}" class="block px-4 py-3 text-sm text-gray-300 focus:bg-white/5 focus:text-white focus:outline-hidden">{{ $perusahaan->nama_perusahaan }}</a>
                    @empty
                        <div class="text-sm text-red-600 px-4 py-2 transition-all duration-300 ease-in-out text-center italic">Belum ada perusahaan terdaftar</div>
                    @endforelse
                    </div>
                </el-menu>
                </el-dropdown> --}}

                <a href="#" onclick="triggerCheckbox2(event)" class="cursor-pointer">
                    <button
                        class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] max-[1200px]:w-[50px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)]"> {{-- Bagian yang di responsive --}}
                        <img src="{{ asset('assets/navbar-kepala-gudang/home-2.png') }}" alt="devices icon" class="max-[1200px]:scale-200" />
                        <span class="max-[1200px]:hidden">Data Proyek</span>
                        <img src="{{ asset('assets/arrow-down.png') }}" alt=""
                            class="ml-8 transition-all duration-300 ease-in-out max-[1200px]:hidden" id="arrowDataProyek2">
                    </button>
                </a>
                <input type="checkbox" name="" id="triggerMe" class="hidden">
                <div class="hidden flex-col items-center gap-y-3" id="dropdownDataProyek2">
                    @forelse($sidebarPerusahaans as $perusahaan)
                        <a href="{{ route('perusahaan.show', $perusahaan->id) }}" class="cursor-pointer">
                            <button
                                class="bg-white text-[#353132] flex items-center justify-center gap-x-5 w-[250px] max-[1200px]:w-[50px] py-3 px-5 rounded-lg cursor-pointer shadow-[1px_1px_5px_rgba(0,0,0,0.25)] hover:bg-linear-to-r hover:from-[#DD4049] hover:to-[#F9E52D] hover:text-white">
                                <img src="{{ asset('assets/navbar-owner/document.png') }}" alt="devices icon" class="max-[1200px]:scale-200" />
                                <span class="text-center max-[1200px]:hidden">{{ $perusahaan->nama_perusahaan }}</span>
                                
                            </button>
                        </a>
                    @empty
                        <div
                            class="text-sm text-red-600 px-4 py-2 transition-all duration-300 ease-in-out text-center italic">
                            Belum ada perusahaan terdaftar</div>
                    @endforelse
                </div>

                <button id="modal-add"
                            class="bg-white text-[#353132] shadow-[0px_0px_15px_rgba(0,0,0,0.25)] flex items-center justify-center w-[250px] max-[1200px]:w-[50px] max-[1200px]:py-1 py-3 px-5 cursor-pointer rounded-lg transition-all duration-300 ease-in-out">
                            <span class="max-[1200px]:hidden">TAMBAH PERUSAHAAN +</span>
                            <span class="min-[1200px]:hidden"><span class="mr-1 hidden">TAMBAH PERUSAHAAN</span><span class="text-xl font-bold">+</span></span>
                        </button>
    
                <a href="/kepala-proyek/data-proyek/create"
                    class="cursor-pointer outside-content transition-all duration-300 ease-in-out hidden">
                    <button
                        class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] py-3 px-5 rounded-lg cursor-pointer shadow-[0px_0px_15px_rgba(0,0,0,0.25)]">
                        <img src="{{ asset('assets/navbar/chart.png') }}"
                            alt="cube scan icon" />
                        <span>Input Data Proyek</span>
                    </button>
                </a>
                <div class="grow flex items-end pb-3">
                    <a href="/logout" class="cursor-pointer">
                        <button
                            class="bg-white text-[#353132] flex items-center gap-x-5 w-[250px] max-[1200px]:w-[50px] py-3 px-5 rounded-lg cursor-pointer shadow-[0px_0px_15px_rgba(0,0,0,0.25)]">
                            <img src="{{ asset('assets/navbar/logout.png') }}" alt="logout icon" class="max-[1200px]:scale-200"/>
                            <span class="max-[1200px]:hidden">Logout</span>
                        </button>
                    </a>
                </div>
            </div>
        </nav>
        <div class="w-full flex flex-col relative">
            {{-- header --}}
            <header class="flex justify-between items-center px-10 max-[420px]:px-4 py-4 shadow-[0px_1px_5px_rgba(0,0,0,0.25)] max-[1200px]:w-[calc(100%-60px)] max-[1200px]:ml-[60px] "> {{-- Bagian yang di responsive --}}
                <img src="{{ asset('assets/notification.png') }}" alt="notification icon"
                        class="w-[30px] cursor-pointer min-[420px]:hidden" />
                <span class="text-base">pages / dashboard</span>
                <div class="flex items-center gap-x-4">
                    <img src="{{ asset('assets/notification.png') }}" alt="notification icon"
                        class="w-[30px] cursor-pointer max-[420px]:hidden" />
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
            <div class="px-6 pt-5 pb-16 overflow-y-auto max-[1200px]:w-[calc(100vw-60px)] max-[1200px]:ml-[60px]"> {{-- Bagian yang di responsive --}}
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
        const children = sideNavbarContent.querySelectorAll('a, button');
        const imgChild = sideNavbarContent.querySelectorAll('img');
        const spanChild = sideNavbarContent.querySelectorAll('span');
        const dropdownDataProyek2 = document.getElementById("dropdownDataProyek2");
        const childDropdown = dropdownDataProyek2.querySelectorAll('a, button');
        buttonView.addEventListener("click", () => {
            buttonView.classList.toggle("left-10");
            buttonView.classList.toggle("left-[260px]");
            arrowButton.classList.toggle("rotate-[-90deg]");
            arrowButton.classList.toggle("rotate-[180deg]");
            nav.classList.toggle("max-[1200px]:w-[60px]");
            nav.classList.toggle("max-[1200px]:w-[280px]");
            logoFull.classList.toggle("max-[1200px]:hidden");
            justLogo.classList.toggle("max-[1200px]:hidden");
            sideNavbarContent.classList.toggle("max-[1200px]:items-center");
            arrow2.classList.toggle("max-[1200px]:hidden");
            arrow2.classList.toggle("max-[1200px]:scale-200");
            modalAdd.classList.toggle("max-[1200px]:py-1");
            sideNavbarContent.classList.toggle('max-[1200px]:')
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
            childDropdown.forEach((item, index) => {
                item.classList.toggle("max-[1200px]:ml-[-67px]");
            })
        });

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
                        item.children[0].src = "{{ asset('assets/navbar/home-click.png') }}";
                    } else if (index => 2) {
                        item.children[0].src = "{{ asset('assets/navbar-owner/document-click.png') }}";
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

        // dropdown navbar
        const dropdownToggle = document.getElementById("dropdown-toggle-navbar");
        const outsideContent = document.querySelectorAll(".outside-content");
        const dropdownContent = document.getElementById("dropdown-content");
        const arrowNavbar = document.getElementById("arrow-navbar");
        const modalAdd = document.getElementById('modal-add');
        const arrow2 = document.getElementById("arrowDataProyek2");
        

        function triggerCheckbox2(event) {
            event.preventDefault(); // Mencegah scroll ke atas karena href="#"

            const checkbox = document.getElementById("triggerMe");
            console.log('test')

            // Cara 1: Meniru klik manusia (akan memicu event listener 'change' jika ada)
            checkbox.click();
            if (checkbox.checked) {
                dropdownDataProyek2.classList.remove('hidden');
                dropdownDataProyek2.classList.add('flex');
                arrow2.classList.add('-rotate-90');
            } else {
                dropdownDataProyek2.classList.add('hidden');
                dropdownDataProyek2.classList.remove('flex');
                arrow2.classList.remove('-rotate-90');
            }
        }
        // // pada awal load, sembunyikan semua children dari dropdowncontent
        // Array.from(dropdownContent.children).forEach((item, index) => {
        //     item.classList.add(`-translate-y-[${(index + 1) * 60}px]`);
        // });
        // // lakukan pengulangan untuk semua outsidecontent, dengan jarak sesuai dengan jumlah children dari dropdowncontent
        // outsideContent.forEach((item, index) => {
        //     item.classList.add(`-translate-y-[${dropdownContent.children.length * 60}px]`);
        // });

        // dropdownToggle.addEventListener("click", () => {
        //     arrowNavbar.classList.toggle("-rotate-90");
        //     // lakukan pengulangan untuk semua children dari dropdowncontent
        //     Array.from(dropdownContent.children).forEach((item, index) => {
        //         item.classList.toggle(`-translate-y-[${(index + 1) * 60}px]`);
        //         item.classList.toggle("shadow-[0px_0px_5px_rgba(0,0,0,0.25)]");
        //     });
        //     // lakukan pengulangan untuk semua outsidecontent, dengan jarak sesuai dengan jumlah children dari dropdowncontent
        //     outsideContent.forEach((item, index) => {
        //         item.classList.toggle(`-translate-y-[${dropdownContent.children.length * 60}px]`);
        //     });
        // })

        // modal tambah perusahaan
         // Modal Add menggunakan sweertalert2 untuk form tambah data
            modalAdd.addEventListener('click', function() {
                Swal.fire({
                    html: `
                        <form action="{{ route('perusahaan.store') }}" method="POST" id="form-tambah">
                            @csrf
                            <div class="flex items-center">
                                <div class="w-[280px] max-[540px]:hidden"></div>
                                <h1 class="font-bold text-2xl mb-4 w-full text-left max-[540px]:text-center">Tambah Perusahaan</h1>
                            </div>
                            <div class="flex items-center max-[540px]:flex-col max-[540px]:items-start max-[540px]:gap-y-2">
                                <label for="nama-perusahaan" class="w-[300px] max-[540px]:w-auto">Nama Perusahaan</label>
                                <input type="text" id="nama-perusahaan" name="nama_perusahaan" class="w-full outline-none bg-[#E9E9E9] rounded-lg px-4 py-2" required>
                            </div>
                        </form>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Simpan',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kirim data ke server
                        const form = document.getElementById('form-tambah');
                        // Periksa apakah form ditemukan
                        if (form) {
                            // PENTING: Submit form secara paksa
                            form.submit();
                        } else {
                            // Handle jika form tidak ditemukan (jarang terjadi)
                            Swal.fire('Error!', 'Form tidak ditemukan.', 'error');
                        }
                    }
                })
            });
    </script>
</body>

</html>
