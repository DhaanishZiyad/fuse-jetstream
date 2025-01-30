@extends('layouts.app')

@section('title', 'All Products')

@section('content')

<div class="flex justify-center items-center bg-[#1E1E1E]">
    <div class="flex w-9/12 align-center items-center mt-14 py-7">
        <p class="font-extrabold font-raleway text-7xl text-white">OUR PRODUCTS</p>
    </div>
</div>

<div class="py-10 flex justify-center font-ruda flex-col items-center">
    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-8 w-9/12">
        <!-- Loop through all products from the database -->
        @if ($products->count() > 0)
            @foreach ($products as $product)
                <a href="{{ route('customer.product-detail', $product->id) }}">
                    <div class="bg-white shadow-md rounded-3xl overflow-hidden">
                        <div class="relative px-3 pt-3">
                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="rounded-[14px]">
                            <!-- Livewire Wishlist Toggle Component -->
                            <div class="absolute bottom-2 right-5">
                                @livewire('wishlist-toggle', ['product' => $product], key($product->id))
                            </div>
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

<script>
    function toggleHeart(event) {
        event.preventDefault();
        const button = event.currentTarget;
        const productId = button.getAttribute('data-product-id');
        const icon = button.querySelector('.heart-icon');

        fetch('/wishlist/toggle', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ product_id: productId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'added') {
                icon.src = icon.getAttribute('data-red-heart');
            } else {
                icon.src = icon.getAttribute('data-heart');
            }
        })
        .catch(error => console.error('Error:', error));
    }

    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".wishlist-button").forEach(button => {
            button.addEventListener("click", function(event) {
                event.preventDefault();
                event.stopPropagation();
            });
        });
    });
</script>
@endsection