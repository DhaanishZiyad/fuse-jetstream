@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="flex justify-center items-center bg-[#1E1E1E]">
    <div class="flex w-9/12 align-center items-center mt-14 py-7">
        <p class="font-extrabold font-raleway text-7xl text-white">PROFILE</p>
    </div>
</div>

@if(session('success'))
    <div id="success-message" 
         class="fixed bottom-5 right-5 bg-green-100 text-green-800 font-bold px-4 py-3 rounded-lg shadow-lg">
        {{ session('success') }}
    </div>
@endif

<div class="flex justify-center items-center py-10">
    <div class="w-9/12 bg-white shadow-lg rounded-xl p-8 flex space-x-8">
        <!-- Left Side: Profile Form -->
        <div class="w-1/2">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-4">
                    <!-- Name -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-1 font-raleway" for="name">Name</label>
                        <input type="text" name="name" value="{{ auth()->user()->name }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-fuse-green-500 focus:border-transparent">
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-1 font-raleway" for="email">Email</label>
                        <input type="email" name="email" value="{{ auth()->user()->email }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-fuse-green-500 focus:border-transparent">
                    </div>

                    <!-- Address -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-1 font-raleway" for="address">Address</label>
                        <input type="text" name="address" value="{{ auth()->user()->address ?? '' }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-fuse-green-500 focus:border-transparent">
                    </div>

                    <!-- City -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-1 font-raleway" for="city">City</label>
                        <input type="text" name="city" value="{{ auth()->user()->city ?? '' }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-fuse-green-500 focus:border-transparent">
                    </div>

                    <!-- Phone -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-1 font-raleway" for="phone">Phone</label>
                        <input type="text" name="phone" value="{{ auth()->user()->phone ?? '' }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-fuse-green-500 focus:border-transparent">
                    </div>

                    <!-- Joined Date (Disabled) -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-1 font-raleway" for="created_at">Joined</label>
                        <input type="text" value="{{ auth()->user()->created_at->format('d M, Y') }}" disabled 
                            class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-100 cursor-not-allowed">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end mt-4">
                    <button type="submit" class="bg-[#21A179] text-white px-6 py-2 rounded-lg font-raleway font-bold hover:bg-fuse-green-500">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>

        <!-- Right Side: Orders List -->
        <div class="w-1/2 bg-gray-100 p-6 rounded-lg font-ruda">
            <!-- Header -->
            <div class="bg-gray-100 pb-2 ">
                <h2 class="text-xl font-bold text-gray-800 font-raleway">Your Orders</h2>
            </div>

            <!-- Scrollable Order List -->
            <div class="mt-2 max-h-[400px] overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
                @if($orders->isEmpty())
                    <p class="text-gray-600">You have no orders yet.</p>
                @else
                    <div class="space-y-3">
                @foreach($orders as $order)
                    <div class="bg-white p-4 rounded-lg shadow flex justify-between items-center">
                        <div class="w-full">
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-gray-800 font-semibold text-sm">Order #{{ $order->id }} </p>
                                    <p class="text-gray-500 font-semibold text-sm"> {{ $order->created_at->format('d M, Y') }}</p>

                                </div>
                                <div>
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                        @if($order->status == 'delivered') bg-green-100 text-green-600 
                                        @elseif($order->status == 'pending') bg-yellow-100 text-yellow-600 
                                        @else bg-gray-200 text-gray-600 @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                            </div>
                            <!-- Order Items -->
                            <div class="mt-2">
                                <ul class="text-sm text-gray-600 space-y-1">
                                    @foreach($order->items as $item)
                                        <li class="flex justify-between">
                                            <span>{{ $item->product->name }} ({{ $item->size }})</span>
                                            <span class="text-gray-800 font-medium">{{ $item->quantity }} x LKR {{ number_format($item->price, 2) }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="flex justify-between mt-2">
                                    <p class="text-sm font-semibold">Total: </p>
                                    <span class="text-sm font-semibold">LKR {{ number_format($order->total, 2) }}</span>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    // Automatically hide the success message after 3 seconds
    document.addEventListener('DOMContentLoaded', () => {
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.transition = "opacity 0.5s ease-in-out";
                successMessage.style.opacity = "0";
                setTimeout(() => successMessage.remove(), 500); // Remove element after fade-out
            }, 3000); // 3 seconds
        }
    });
</script>
@endsection