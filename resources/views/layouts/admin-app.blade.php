<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&family=Ruda:wght@400..900&display=swap" rel="stylesheet">
    <title>@yield('title', 'My Application')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
    <header class="bg-[#1E1E1E] font-raleway font-extrabold text-fuse-green-500">
        <nav class="flex justify-between items-center w-[80%] mx-auto h-20">
            <div>
                <a href="#">
                    <img class="h-10" src="{{ asset('images/fuse_logo green.png') }}" alt="" />
                </a>
            </div>
            <div class="nav-links md:static absolute bg-[#1E1E1E] md:min-h-fit min-h-[60hv] left-0 top-[-100%] md:w-auto w-full flex items-center">
                <ul class="flex md:flex-row flex-col md:items-center md:gap-10 w-full justify-center items-center">
                    <li class="py-5">
                        <a href="{{ route('admin.dashboard') }}" class="hover:underline">ANALYTICS</a>
                    </li>
                    <li class="py-5">
                        <a href="{{ route('admin.add-products') }}" class="hover:underline">ADD PRODUCTS</a>
                    </li>
                    <li class="py-5">
                        <a href="{{ route('admin.all-products') }}" class="hover:underline">ALL PRODUCTS</a>
                    </li>

                </ul>
            </div>

            <div class="flex items-center">

                    <!-- <a href="#">
                        <img class="h-7" src="{{ asset('images/Profile-green.svg') }}" alt="Profie" />
                    </a> -->
                    <form method="POST" action="{{ route('logout') }}" class="h-7">
                        @csrf
                        <button type="submit" class="btn btn-logout">
                            <img class="h-7" src="{{ asset('images/Exit-green.svg') }}" alt="Logout" />
                        </button>
                    </form>

            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <!-- <footer>
        <div class="bg-[#1E1E1E] h-72 flex flex-row justify-center">
            <div class="flex-col w-[26%] pt-12">
                <img class="h-10" src="{{ asset('images/fuse_logo green.png') }}" alt="">
                <p class="font-raleway font-bold uppercase text-[#21A179] pt-3 text-xl">Fuse Jerseys</p>
                <p class="font-ruda text-white">No 69, Sigma Lane, Ohio</p>
                <p class="font-ruda text-white">+960 779 8513</p>
                <p class="font-ruda text-white">fuse.jerseys@gmail.com</p>
            </div>
            <div class="flex-col w-[26%] pt-12">
                <div class="relative flex">
                    <div class="">
                        <p class="font-raleway font-bold uppercase pt-2 text-[#21A179]">navigation</p>
                        <a href="#"><p class="font-raleway font-bold uppercase pt-2 hover:text-gray-400 text-white">out PRODUCTS</p></a>
                        <a href="#"><p class="font-raleway font-bold uppercase pt-2 hover:text-gray-400 text-white">about us</p></a>
                    </div>
                    <div class="absolute flex-row left-[50%]">
                        <a href="#"><p class="font-raleway font-bold uppercase pt-2 text-[#21A179]">contact us</p></a>
                        <a href="#"><p class="font-raleway font-bold uppercase pt-2 hover:text-gray-400 text-white">email</p></a>
                    </div>
                </div>
                <div class=" flex flex-col">
                </div>
            </div>
            <div class="flex flex-col w-[26%] justify-end ">
                <div class="flex justify-end">
                    <a href="#"><img class="pl-5" src="/fuse_website_final/src/media/X.svg" alt=""></a>
                    <a href="#"><img class="pl-5" src="/fuse_website_final/src/media/Facebook.svg" alt=""></a>
                    <a href="#"><img class="pl-5" src="/fuse_website_final/src/media/Social Icons.svg" alt=""></a>
                </div>
            </div>
        </div>
        <div class="flex justify-center items-center w-full bg-[#1E1E1E] h-14 pt-4 pb-10">
            <hr class="w-[80%] h-[2px] bg-[#21A179] border-0">
        </div>
    </footer> -->
    @livewireScripts
</body>
</html>