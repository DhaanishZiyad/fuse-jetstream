@extends('layouts.app')

@section('title', 'All Products')

@section('content')

<div class="container mx-auto p-10 flex justify-center bg-[#DCDCDC] font-ruda flex-col items-center">
    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-8 w-[80%]">
        <!-- Loop through all products from the database -->
        @if ($products->count() > 0)
            @foreach ($products as $product)
                <a href="{{ route('customer.product-detail', $product->id) }}">
                    <div class="bg-white shadow-md rounded-3xl overflow-hidden">
                        <div class="relative px-3 pt-3">
                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="rounded-[14px]">
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
                    </div>
                </a>
            @endforeach
        @else
            <p>No products available</p>
        @endif
    </div>
</div>


@endsection