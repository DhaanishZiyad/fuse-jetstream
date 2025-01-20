@extends('layouts.app')

@section('title', 'Product')

@section('content')

<div class="container mx-auto font-ruda flex flex-col items-center py-10">
    <div class="flex flex-col md:flex-row w-[80%] rounded-3xl overflow-hidden">
        <!-- Image Section -->
        <div class="w-full md:w-1/2 p-6 flex justify-end">
            <img src="{{ asset('storage/' . $product->image_path) }}" 
                alt="{{ $product->name }}" 
                class="w-96 h-96 object-cover">
        </div>

        <!-- Details Section -->
        <div class="w-full md:w-1/2 p-6">
            <h1 class="text-3xl font-raleway font-bold">{{ $product->name }}</h1>
            @if (!empty($product->old_price))
                <p class="text-gray-500 line-through font-semibold">LKR {{ number_format($product->old_price, 2) }}</p>
            @endif
            <p class="text-red-500 text-2xl font-extrabold">LKR {{ number_format($product->current_price, 2) }}</p>

            <!-- Quantity Selector -->
            <div class="flex items-center mt-4">
                <div class="flex items-center border-2 border-fuse-green-500 rounded-md">
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
                        class="w-16 text-center border-none outline-none">
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
                    <button type="submit" class="bg-[#21A179] text-white px-6 py-2 rounded-md font-bold">
                        Add to Cart
                    </button>
                </form>
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
</style>

@endsection
