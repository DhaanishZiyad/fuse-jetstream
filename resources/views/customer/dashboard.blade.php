@extends('layouts.app')

@section('title', 'Customer Dashboard')

@section('content')


<div class="relative flex justify-center items-center h-full w-full bg-black">
    <img class="home_image opacity-40 w-full h-auto" src="{{ asset('images/locker.jpg') }}" alt="" />

    <div class="absolute flex flex-col justify-center items-center w-full h-full text-center text-white">
        <!-- First Text Overlay -->
        <div class="mb-5">
            <h1 class="font-raleway font-bold uppercase text-3xl text-[white] ">about us</h1>
        </div>
        
        <!-- Second Text Overlay -->
        <div class="mb-6">
            <p class="font-raleway text-base text-white max-w-[800px]">At Fuse Jersey, we celebrate the passion, pride, and unity of football fans around the world. Whether you're cheering for your favorite team from the stands or playing on the pitch, we've got the perfect jersey to showcase your love for the game.</p>
        </div>
        
        <!-- Third Text Overlay -->
        <div>
            <button class="font-raleway font-bold text-white outline outline-2 outline-white rounded-md  px-5 py-2 ">READ MORE</button>
        </div>
    </div>
</div>

<!-- Product Cards Section -->
<div class="container mx-auto p-10 flex justify-center bg-[#DCDCDC] font-ruda flex-col items-center">
    <div class="flex w-[80%] pb-8">
        <h1 class="font-raleway font-bold text-3xl text-[black]">Latest Additions</h1>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-8 w-[80%] pb-12">
        <!-- Loop through products from the database, limiting to 4 products -->
        @if ($products->count() > 0)
            @foreach ($products->take(4) as $product)
                <a href="{{ route('customer.product-detail', ['id' => $product->id]) }}" class="bg-white shadow-md rounded-3xl overflow-hidden block">
                    <div class="relative px-3 pt-3">
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="rounded-[14px] w-full h-auto">
                    </div>
                    <div class="p-3">
                        <h2 class="font-extrabold w-fit">{{ $product->name }}</h2>
                        <div class="flex justify-end items-center">
                            @if (!empty($product->old_price))
                                <span class="text-gray-500 line-through font-bold">LKR {{ number_format($product->old_price, 2) }}</span>
                            @endif
                        </div>
                        <div class="flex justify-end items-center">
                            <span class="text-red-500 text-lg font-extrabold">LKR {{ number_format($product->current_price, 2) }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        @else
            <p>No products available</p>
        @endif
    </div>

    <div class="flex w-[80%] justify-center">
        <button class="font-raleway font-bold text-[#21A179] outline outline-2 outline-[#21A179] rounded-md bg-white px-5 py-2">
            VIEW ALL PRODUCTS
        </button>
    </div>
</div>


@endsection