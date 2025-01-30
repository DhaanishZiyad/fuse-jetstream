@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div class="flex items-center justify-center py-24 font-raleway">
    <div class="w-full max-w-md bg-[#1E1E1E] p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold font-raleway text-fuse-green-500 mb-6">SIGN UP</h2>

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

        <!-- Register Form -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <input 
                    id="name" 
                    type="text" 
                    name="name" 
                    value="{{ old('name') }}" 
                    placeholder="Name"
                    required 
                    autofocus 
                    autocomplete="name"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none font-sans focus:ring-2 focus:ring-fuse-green-500 focus:border-transparent"
                >
            </div>

            <!-- Email -->
            <div class="mb-4">
                <input 
                    id="email" 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    placeholder="Email"
                    required 
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
                    autocomplete="new-password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none font-sans focus:ring-2 focus:ring-fuse-green-500 focus:border-transparent"
                >
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <input 
                    id="password_confirmation" 
                    type="password" 
                    name="password_confirmation" 
                    placeholder="Confirm Password"
                    required 
                    autocomplete="new-password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none font-sans focus:ring-2 focus:ring-fuse-green-500 focus:border-transparent"
                >
            </div>

            <!-- Terms and Conditions -->
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mb-4">
                    <label for="terms" class="inline-flex items-center text-sm text-white">
                        <input 
                            id="terms" 
                            type="checkbox" 
                            name="terms" 
                            required 
                            class="form-checkbox text-fuse-green-500 focus:ring-fuse-green-500"
                        >
                        <span class="ml-2">
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                'terms_of_service' => '<a href="'.route('terms.show').'" class="underline text-fuse-green-500 hover:text-fuse-green-600" target="_blank">'.__('Terms of Service').'</a>',
                                'privacy_policy' => '<a href="'.route('policy.show').'" class="underline text-fuse-green-500 hover:text-fuse-green-600" target="_blank">'.__('Privacy Policy').'</a>',
                            ]) !!}
                        </span>
                    </label>
                </div>
            @endif

            <!-- Submit Button -->
            <div>
                <button type="submit" 
                    class="w-full bg-fuse-green-500 text-white font-bold py-2 px-4 rounded-md hover:bg-fuse-green-600 focus:outline-none focus:ring-2 focus:ring-fuse-green-500">
                    Sign Up
                </button>
            </div>
        </form>

        <!-- Additional Links -->
        <p class="mt-6 text-center text-sm text-white">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-fuse-green-500 hover:underline">Log in</a>
        </p>
    </div>
</div>

@endsection
