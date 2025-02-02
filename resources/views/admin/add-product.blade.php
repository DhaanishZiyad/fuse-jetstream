@extends('layouts.admin-app')

@section('title', 'Add Products')

@section('content')

<div class="flex justify-center items-center bg-fuse-green-500">
    <div class="flex w-9/12 align-center items-center mt-14 py-7">
        <p class="font-extrabold font-raleway text-7xl text-white">ADD A PRODUCT</p>
    </div>
</div>

<div class="container mx-auto py-8 w-9/12">
    @if(session('success'))
        <div id="success-message" 
             class="fixed bottom-5 right-5 bg-green-100 text-green-800 font-bold px-4 py-3 rounded-lg shadow-lg">
            {{ session('success') }}
        </div>
    @endif
    <form method="POST" action="{{ route('admin.add-products.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Product Name -->
        <div class="mb-4">
            <input 
                type="text" 
                id="name" 
                name="name" 
                placeholder="Product Name"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-fuse-green-500 focus:border-transparent"
                value="{{ old('name') }}"
                required>
            @error('name')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <!-- Old Price -->
        <div class="mb-4">
            <input 
                type="number" 
                id="old_price" 
                name="old_price" 
                placeholder="Old Price"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-fuse-green-500 focus:border-transparent"
                value="{{ old('old_price') }}">
            @error('old_price')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <!-- Current Price -->
        <div class="mb-4">
            <input 
                type="number" 
                id="current_price" 
                name="current_price" 
                placeholder="Current Price"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-fuse-green-500 focus:border-transparent"
                value="{{ old('current_price') }}"
                required>
            @error('current_price')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <!-- Description -->
        <div class="mb-4">
            <textarea 
                id="description" 
                name="description" 
                rows="4" 
                placeholder="Product Description"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-fuse-green-500 focus:border-transparent">{{ old('description') }}</textarea>
            @error('description')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <!-- Image -->
        <div class="mb-4">
            <input 
                type="file" 
                id="image" 
                name="image" 
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-fuse-green-500 focus:border-transparent"
                accept="image/*"
                required>
            @error('image')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button 
                type="submit" 
                class="bg-fuse-green-500 text-white font-raleway font-bold py-2 px-4 rounded-md hover:bg-fuse-green-600 focus:outline-none focus:ring-2 focus:ring-fuse-green-500">
                Add Product
            </button>
        </div>
    </form>
</div>

<script>
    // Automatically hide the success message after 5 seconds
    document.addEventListener('DOMContentLoaded', () => {
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.transition = "opacity 0.5s ease-in-out";
                successMessage.style.opacity = "0";
                setTimeout(() => successMessage.remove(), 500); // Remove element after fade-out
            }, 3000); // 5 seconds
        }
    });
</script>
@endsection
