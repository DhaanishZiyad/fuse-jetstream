@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="flex items-center justify-center h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center text-fuse-green-500 mb-6">Login to Your Account</h2>

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
                <label for="email" class="block text-gray-700 font-semibold">Email Address</label>
                <input 
                    id="email" 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus 
                    autocomplete="username"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-fuse-green-500 focus:border-transparent"
                >
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold">Password</label>
                <input 
                    id="password" 
                    type="password" 
                    name="password" 
                    required 
                    autocomplete="current-password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-fuse-green-500 focus:border-transparent"
                >
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between mb-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input 
                        id="remember_me" 
                        type="checkbox" 
                        name="remember" 
                        class="form-checkbox text-fuse-green-500 focus:ring-fuse-green-500"
                    >
                    <span class="ml-2 text-gray-700">Remember Me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-fuse-green-500 hover:underline">Forgot Password?</a>
                @endif
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
        <p class="mt-6 text-center text-sm text-gray-600">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-fuse-green-500 hover:underline">Sign up</a>
        </p>
    </div>
</div>

@endsection
