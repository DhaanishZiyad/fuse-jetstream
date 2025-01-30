@extends('layouts.app')

@section('title', 'My Wishlist')

@section('content')

<div class="flex justify-center items-center bg-[#1E1E1E]">
    <div class="flex w-9/12 align-center items-center mt-14 py-7">
        <p class="font-extrabold font-raleway text-7xl text-white">FAVOURITES</p>
    </div>
</div>

@livewire('wishlist')

@endsection
