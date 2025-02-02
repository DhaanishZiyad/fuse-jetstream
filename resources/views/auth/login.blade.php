@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="flex items-center justify-center py-24 font-raleway">
    <div class="w-full max-w-md bg-[#1E1E1E] p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold font-raleway text-fuse-green-500 mb-6">LOG IN</h2>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="mb-4">
                <ul class="text-red-500 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-green-600 font-medium text-sm">
                {{ session('status') }}
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <input 
                    id="email" 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    placeholder="Email"
                    required 
                    autofocus 
                    autocomplete="username"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none font-sans focus:ring-2 focus:ring-fuse-green-500 focus:border-transparent"
                >
            </div>

            <!-- Password -->
            <div class="mb-4">
                <input 
                    id="password" 
                    type="password" 
                    name="password" 
                    placeholder="Password"
                    required 
                    autocomplete="current-password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none font-sans focus:ring-2 focus:ring-fuse-green-500 focus:border-transparent"
                >
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" 
                    class="w-full bg-fuse-green-500 text-white font-bold py-2 px-4 rounded-md hover:bg-fuse-green-600 focus:outline-none focus:ring-2 focus:ring-fuse-green-500">
                    Log in
                </button>
            </div>
        </form>

        <!-- Additional Links -->
        <p class="mt-6 text-center text-sm text-white">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-fuse-green-500 hover:underline">Sign up</a>
        </p>
    </div>
</div>

@endsection
