@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')

@if(session('success'))
    <div id="success-message" 
         class="bg-green-100 text-green-800 font-bold px-4 py-3 rounded-lg shadow-lg mb-4">
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
 