<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN AR4N GROUP</title>
    @vite('resources/css/app.css')
</head>
<body class="flex justify-center items-center h-screen font-poppins">
  <section class="flex items-center w-[90vw]">
    <div class="w-[55%] overflow-hidden">
        <img src="{{ asset('assets/ar4anBigLogo.png') }}" alt="LOGO AR4N GROUP" class="scale-[130%] translate-x-[30px]">
    </div>
    <div class="flex flex-col w-[35%]">
        <h1 class="text-5xl leading-10 text-[#353132] mb-8">Welcome to, <br> <span class="font-extrabold text-6xl">AR4N Group</span></h1>
        <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-y-5 mb-4">
            @csrf
            <div class="border-[#72686B]/40 border-[2px] rounded-lg w-full flex items-center pb-2 pt-3 relative">
                <label for="username" class="text-[#C0C0C0] text-lg absolute left-3 top-[7px] transition-all duration-300">username</label>
                <input type="text" name="username" id="username" class="w-full outline-none px-3 focus-input" required>
                <img src="{{ asset('assets/username.png') }}" alt="username icon" class="w-[25px] absolute right-3">
            </div>
            <div class="border-[#72686B]/40 border-[2px] rounded-lg w-full flex items-center pb-2 pt-3 relative">
                <label for="password" class="text-[#C0C0C0] text-lg absolute left-3 top-[7px] transition-all duration-300">password</label>
                <input type="password" name="password" id="password" class="w-full outline-none px-3 focus-input" required>
                <img src="{{ asset('assets/eye.png') }}" alt="password icon" class="w-[25px] absolute right-3 cursor-pointer" id="toggle">
            </div>
            <button type="submit" class="bg-[#353132] font-bold text-white py-3 rounded-lg cursor-pointer">Login</button>
        </form>
        <div class="flex gap-x-2 items-center">
            <input type="checkbox" name="" id="">
            <p>remember me</p>
        </div>
    </div>
  </section>
  <script src="{{ asset('js/login.js') }}"></script>
</body>
</html>
