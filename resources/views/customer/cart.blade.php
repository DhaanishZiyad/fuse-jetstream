@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')

@if(session('success'))
    <div class="bg-green-500 text-white p-3 rounded-md mb-6">
        {{ session('success') }}
    </div>
@endif

@livewire('shopping-cart')

@endsection
 