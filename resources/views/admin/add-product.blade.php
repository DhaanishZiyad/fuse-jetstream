@extends('layouts.admin-app')

@section('title', 'Add Products')

@section('content')

<div class="container mx-auto p-6 w-[80%]">
    <h2 class="text-2xl font-bold mb-4">Add Product</h2>
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    <form method="POST" action="{{ route('admin.add-products.store') }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf

        <!-- Product Name -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Product Name</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                placeholder="Enter product name"
                value="{{ old('name') }}"
                required>
            @error('name')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <!-- Old Price -->
        <div class="mb-4">
            <label for="old_price" class="block text-gray-700 text-sm font-bold mb-2">Old Price</label>
            <input 
                type="number" 
                id="old_price" 
                name="old_price" 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                placeholder="Enter old price"
                value="{{ old('old_price') }}">
            @error('old_price')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <!-- Current Price -->
        <div class="mb-4">
            <label for="current_price" class="block text-gray-700 text-sm font-bold mb-2">Current Price</label>
            <input 
                type="number" 
                id="current_price" 
                name="current_price" 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                placeholder="Enter current price"
                value="{{ old('current_price') }}"
                required>
            @error('current_price')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <!-- Image -->
        <div class="mb-4">
            <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Product Image</label>
            <input 
                type="file" 
                id="image" 
                name="image" 
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                accept="image/*"
                required>
            @error('image')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-between">
            <button 
                type="submit" 
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Add Product
            </button>
        </div>
    </form>
</div>
@endsection
