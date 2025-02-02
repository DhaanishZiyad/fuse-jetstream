@extends('layouts.app')

@section('title', 'Product')

@section('content')

<div class="container mx-auto font-ruda flex flex-col items-center py-10">
    <div class="flex flex-col md:flex-row w-9/12 overflow-hidden">
        <!-- Image Section -->
        <div class="w-full md:w-1/2 p-6 flex justify-end">
        <img src="{{ asset('storage/' . $product->image_path) }}" 
    alt="{{ $product->name }}" 
    class="w-full max-w-md h-auto object-cover">
        </div>

        <!-- Details Section -->
        <div class="w-full md:w-1/2 p-6 flex flex-col justify-between">
            <div>
                <h1 class="text-3xl font-raleway font-bold">{{ $product->name }}</h1>

                <p class="text-gray-500 mt-4">{{ $product->description }}</p>
            </div>

            <div class="flex flex-col">
                <!-- Size Selector -->
                <div>
                    <div class="flex space-x-2">
                        @php
                            $sizes = ['S', 'M', 'L', 'XL', '2XL'];
                        @endphp
                        @foreach ($sizes as $size)
                            <button 
                                type="button" 
                                class="size-button px-4 py-2 border border-gray-300 bg-white rounded-md text-gray-700 font-semibold focus:outline-none w-16"
                                data-size="{{ $size }}"
                                onclick="selectSize('{{ $size }}')">
                                {{ $size }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Price Section -->
                <div class="mt-6">
                    @if (!empty($product->old_price))
                        <p class="text-gray-500 line-through font-semibold">LKR {{ number_format($product->old_price, 2) }}</p>
                    @endif
                    <p class="text-red-500 text-xl font-extrabold">LKR {{ number_format($product->current_price, 2) }}</p>
                </div>
                <!-- Quantity Selector -->
                <div class="flex items-center mt-4">
                    <div class="flex items-center border-2 border-fuse-green-500 rounded-md bg-white">
                        <button 
                            type="button" 
                            class="px-3 text-lg font-bold"
                            onclick="updateQuantity(-1)">−</button>
                        <input 
                            type="number" 
                            id="quantity" 
                            name="quantity" 
                            value="1" 
                            min="1" 
                            class="w-12 text-center border-none outline-none">
                        <button 
                            type="button" 
                            class="px-3 text-lg font-bold"
                            onclick="updateQuantity(1)">+</button>
                    </div>

                    <!-- Add to Cart Button inside Form -->
                    <form action="{{ route('customer.add-cart') }}" method="POST" class="ml-3">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" id="quantityInput" value="1"> <!-- Hidden field to pass the quantity -->
                        <input type="hidden" name="size" id="sizeInput" value=""> <!-- Hidden field to pass the selected size -->
                        <!-- Add to Cart Button -->
                        <button type="submit" class="bg-[#21A179] border-2 border-fuse-green-500 text-white px-6 py-2 rounded-md font-raleway font-bold">
                            Add to Cart
                        </button>
                        
                    </form>
                    <!-- Wishlist Toggle (Livewire) -->
                    <div class="ml-3 rounded-full border-2 border-fuse-green-500">
                            @livewire('wishlist-toggle', ['product' => $product], key($product->id))
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function updateQuantity(change) {
        const quantityInput = document.getElementById('quantity');
        const quantityField = document.getElementById('quantityInput');
        let currentValue = parseInt(quantityInput.value, 10);

        // Ensure the quantity doesn't go below 1
        currentValue = isNaN(currentValue) ? 1 : currentValue + change;
        quantityInput.value = Math.max(1, currentValue);
        quantityField.value = quantityInput.value; // Update the hidden field with the selected quantity
    }

    document.getElementById('addToCartForm').addEventListener('submit', function(e) {
        // Check if size is selected
        const selectedSize = document.getElementById('sizeInput').value;

        if (!selectedSize) {
            e.preventDefault();  // Prevent form submission if no size is selected
            alert("Please select a size before adding to the cart.");
        }
    });

    function selectSize(selectedSize) {
        // Update the hidden size field
        document.getElementById('sizeInput').value = selectedSize;

        // Highlight the selected size button
        document.querySelectorAll('.size-button').forEach(button => {
            if (button.dataset.size === selectedSize) {
                button.classList.add('bg-[#21A179]', 'text-white', 'border-[#21A179]');
                button.classList.remove('bg-white', 'text-gray-700', 'border-gray-300');
            } else {
                button.classList.remove('bg-[#21A179]', 'text-white', 'border-[#21A179]');
                button.classList.add('bg-white', 'text-gray-700', 'border-gray-300');
            }
        });
    }

    // Set default size on page load
    // document.addEventListener('DOMContentLoaded', () => {
    //     selectSize('S'); // Default to size S
    // });
</script>

<style>
    /* Remove spinner controls for number input */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield; /* For Firefox */
        appearance: textfield;
    }

    /* Smooth transition for size button highlighting */
    .size-button {
        transition: all 0.2s ease-in-out;
    }

    .size-button:hover {
        transform: scale(1.05);
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>

@endsection
