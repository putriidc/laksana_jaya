<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>LOGIN LAKSANA JAYA</title>
       @vite('resources/css/app.css') @vite('resources/js/app.js')
    </head>
    <body class="flex justify-center items-center h-screen font-poppins">
        @if(session('error'))
        <div
            id="flash-message"
            data-type="error"
            data-message="{{ session('error') }}"
        ></div>
        @endif
        <section class="flex items-center w-[90vw] max-[1040px]:justify-center">
            <div class="w-[55%] max-[1200px]:w-[45%] overflow-hidden max-[1040px]:hidden">
                <img
                    src="{{ asset('assets/logo_laksana.png') }}"
                    alt="LOGO LAKSANA JAYA"
                    class="scale-[100%] translate-x-[30px]"
                />
            </div>
            <div class="flex flex-col w-[35%] max-[1200px]:w-[40%] max-[1040px]:w-[60%] max-[600px]:w-[80%] max-[430px]:w-[90%]">
                <h1 class="text-5xl max-[800px]:text-3xl max-[600px]:text-2xl max-[430px]:text-xl leading-10 max-[430px]:leading-6 max-[600px]:leading-8 text-[#353132] mb-8 max-[800px]:mb-4 max-[600px]:mb-3">
                    Welcome to, <br />
                    <span class="font-extrabold text-6xl max-[800px]:text-5xl max-[600px]:text-4xl max-[430px]:text-3xl">Laksana Jaya</span>
                </h1>
                <form
                    method="POST"
                    action="{{ route('login') }}"
                    class="flex flex-col gap-y-5 mb-4 max-[600px]:gap-y-2"
                >
                    @csrf
                    <div
                        class="border-[#72686B]/40 border-[2px] rounded-lg w-full flex items-center pb-2 pt-3 relative"
                    >
                        <label
                            for="username"
                            class="text-[#C0C0C0] text-lg absolute left-3 top-[7px] transition-all duration-300"
                            >username</label
                        >
                        <input
                            type="text"
                            name="username"
                            id="username"
                            class="w-full outline-none px-3 focus-input"
                            required
                        />
                        <img
                            src="https://ar4n-group.com/public/assets/username.png"
                            alt="username icon"
                            class="w-[25px] absolute right-3"
                        />
                    </div>
                    <div
                        class="border-[#72686B]/40 border-[2px] rounded-lg w-full flex items-center pb-2 pt-3 relative"
                    >
                        <label
                            for="password"
                            class="text-[#C0C0C0] text-lg absolute left-3 top-[7px] transition-all duration-300"
                            >password</label
                        >
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="w-full outline-none px-3 focus-input"
                            required
                        />
                        <img
                            src="https://ar4n-group.com/public/assets/eye.png"
                            alt="password icon"
                            class="w-[25px] absolute right-3 cursor-pointer"
                            id="toggle"
                        />
                    </div>
                    <button
                        type="submit"
                        class="bg-[#E62129] font-bold text-white py-3 rounded-lg cursor-pointer"
                    >
                        Login
                    </button>
                </form>
                <div class="flex gap-x-2 items-center">
                    <input type="checkbox" name="" id="" />
                    <p>remember me</p>
                </div>
            </div>
        </section>
        <script src="https://ar4n-group.com/public/js/login.js"></script>
        <script src="https://ar4n-group.com/public/js/notification.js"></script>
    </body>
</html>
