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
            class="flex flex-col bg-white h-screen w-[350px] py-5 px-5 shadow-[1px_0px_8px_rgba(0,0,0,0.25)] items-center relative z-[99] overflow-y-auto overflow-x-hidden">
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
                <el-dropdown class="inline-block">
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
                </el-dropdown>

                <button id="modal-add"
                            class="bg-white text-[#353132] shadow-[0px_0px_15px_rgba(0,0,0,0.25)] flex items-center justify-center w-[250px] py-3 px-5 cursor-pointer rounded-lg transition-all duration-300 ease-in-out">
                            <span>TAMBAH PERUSAHAAN +</span>
                        </button>
    
                <a href="/kepala-proyek/data-proyek/create"
                    class="cursor-pointer outside-content transition-all duration-300 ease-in-out">
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
        const outsideContent = document.querySelectorAll(".outside-content");
        const dropdownContent = document.getElementById("dropdown-content");
        const arrowNavbar = document.getElementById("arrow-navbar");
        const modalAdd = document.getElementById('modal-add');

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
                                <div class="w-[280px]"></div>
                                <h1 class="font-bold text-2xl mb-4 w-full text-left">Tambah Perusahaan</h1>
                            </div>
                            <div class="flex items-center">
                                <label for="nama-perusahaan" class="w-[300px]">Nama Perusahaan</label>
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
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

</body>

</html>
