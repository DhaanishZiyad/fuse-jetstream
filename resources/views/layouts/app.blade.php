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
<body class="flex flex-col min-h-screen bg-[#e9e9e9]">
    <header class="bg-fuse-green-500 font-raleway font-extrabold text-[#1E1E1E]">
        <nav class="flex justify-between items-center w-9/12 mx-auto h-20">
            <div>
                <a href="{{ route('customer.dashboard') }}">
                    <img class="h-10" src="{{ asset('images/fuse_logo.png') }}" alt="" />
                </a>
            </div>
            <div class="nav-links md:static absolute bg-fuse-green-500 md:min-h-fit min-h-[60hv] left-0 top-[-100%] md:w-auto w-full flex items-center">
                <ul class="flex md:flex-row flex-col md:items-center md:gap-10 w-full justify-center items-center">
                    <li class="py-5">
                        <a href="{{ route('customer.all-products') }}" class="hover:text-fuse-green-800">OUR PRODUCTS</a>
                    </li>
                    <li class="py-5">
                        <a href="#" class="hover:text-fuse-green-800">ABOUT US</a>
                    </li>
                </ul>
            </div>  
            <div class="w-1/3">
                @livewire('search-dropdown')
            </div>

            <div class="flex items-center">
                <a href="{{ route('customer.wishlist') }}">
                    <img class="h-7" src="{{ asset('images/Heart.svg') }}" alt="Profie" />
                </a>
                <a href="{{ route('customer.show-cart') }}">
                    <img class="h-7 ml-7" src="{{ asset('images/Shopping Card.svg') }}" alt="Profie" />
                </a>
                <a href="{{ route('customer.profile') }}">
                    <img class="h-7 ml-7" src="{{ asset('images/Profile.svg') }}" alt="Profie" />
                </a>
                @auth
                <!-- Only show logout button if user is logged in -->
                <form method="POST" action="{{ route('logout') }}" class="h-7">
                    @csrf
                    <button type="submit" class="btn btn-logout ml-7">
                        <img class="h-7" src="{{ asset('images/Exit.svg') }}" alt="Logout" />
                    </button>
                </form>
                @endauth
            </div>

            </div>
        </nav>
    </header>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer>
        <div class="bg-[#1E1E1E] h-72 flex flex-row justify-center">
            <div class="flex-col w-[25%] pt-12">
                <img class="h-10" src="{{ asset('images/fuse_logo green.png') }}" alt="">
                <p class="font-raleway font-bold uppercase text-fuse-green-500 pt-3 text-xl">Fuse Jerseys</p>
                <p class="font-ruda text-white">No 8, Sri Sunandarama Road, Kalubowila</p>
                <p class="font-ruda text-white">+960 779 8513</p>
                <p class="font-ruda text-white">fuse.jerseys@gmail.com</p>
            </div>
            <div class="flex-col w-[25%] pt-12">
                <div class="relative flex">
                    <div class="">
                        <p class="font-raleway font-bold uppercase pt-2 text-fuse-green-500">navigation</p>
                        <a href="{{ route('customer.all-products') }}"><p class="font-raleway font-bold uppercase pt-2 hover:text-gray-400 text-white">OUR PRODUCTS</p></a>
                        <a href="#"><p class="font-raleway font-bold uppercase pt-2 hover:text-gray-400 text-white">about us</p></a>
                    </div>
                    <div class="absolute flex-row left-[50%]">
                        <a href="#"><p class="font-raleway font-bold uppercase pt-2 text-fuse-green-500">contact us</p></a>
                        <a href="#"><p class="font-raleway font-bold uppercase pt-2 hover:text-gray-400 text-white">email</p></a>
                    </div>
                </div>
                <div class=" flex flex-col">
                </div>
            </div>
            <div class="flex flex-col w-[25%] justify-end ">
                <div class="flex justify-end">
                    <a href="#"><img class="pl-5" src="{{ asset('images/X.svg') }}" alt=""></a>
                    <a href="#"><img class="pl-5" src="{{ asset('images/Facebook.svg') }}" alt=""></a>
                    <a href="#"><img class="pl-5" src="{{ asset('images/Social Icons.svg') }}" alt=""></a>
                </div>
            </div>
        </div>
        <div class="flex justify-center items-center w-full bg-[#1E1E1E] h-14 pt-4 pb-10">
            <hr class="w-9/12 h-[2px] bg-fuse-green-500 border-0">
        </div>
    </footer>
    @livewireScripts
</body>
</html>
