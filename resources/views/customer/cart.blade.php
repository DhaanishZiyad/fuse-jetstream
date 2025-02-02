@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')

<div class="flex justify-center items-center bg-[#1E1E1E]">
    <div class="flex w-9/12 align-center items-center mt-14 py-7">
        <p class="font-extrabold font-raleway text-7xl text-white">YOUR CART</p>
    </div>
</div>

@if(session('success'))
    <div id="success-message" 
         class="fixed bottom-5 right-5 bg-green-100 text-green-800 font-bold px-4 py-3 rounded-lg shadow-lg">
        {{ session('success') }}
    </div>
@endif

@livewire('shopping-cart')

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
 