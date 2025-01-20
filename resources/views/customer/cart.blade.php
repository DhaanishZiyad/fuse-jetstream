@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')

@if(session('success'))
    <div class="bg-green-500 text-white p-3 rounded-md mb-6">
        {{ session('success') }}
    </div>
@endif

<div class="container mx-auto p-10 bg-[#DCDCDC] font-ruda flex justify-center items-center">
    <div class="flex flex-col md:flex-row justify-between gap-8 w-[80%]">

        @livewire('shopping-cart')
        
    </div>
</div>

@endsection
 