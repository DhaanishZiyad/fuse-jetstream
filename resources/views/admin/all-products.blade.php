@extends('layouts.admin-app')

@section('title', 'All Products')

@section('content')
<div class="container mx-auto p-4 w-[80%]">
    <h1 class="text-2xl font-bold mb-4">All Products</h1>
    @if(session('success'))
        <div id="success-message" 
             class="fixed bottom-5 right-5 bg-green-100 text-green-800 font-bold px-4 py-3 rounded-lg shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    @if($products->isEmpty())
        <p class="text-gray-600">No products found.</p>
    @else
        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">#</th>
                        <th class="border border-gray-300 px-4 py-2">Image</th>
                        <th class="border border-gray-300 px-4 py-2">Name</th>
                        <th class="border border-gray-300 px-4 py-2">Old Price</th>
                        <th class="border border-gray-300 px-4 py-2">Current Price</th>
                        <th class="border border-gray-300 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $index => $product)
                        <tr class="text-center">
                            <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover mx-auto">
                            </td>
                            <td class="border border-gray-300 px-4 py-2">{{ $product->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                @if($product->old_price)
                                    LKR {{ number_format($product->old_price, 2) }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-green-600">LKR {{ number_format($product->current_price, 2) }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <a href="{{ route('admin.edit-product', $product->id) }}" class="text-blue-500 hover:underline">Edit</a> | 
                                <form action="{{ route('admin.delete-product', $product->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
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
