@extends('layouts.app')

@section('title', 'Register')

@section('content')
<main class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-sm w-full">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Create Account</h2>
            <p class="text-gray-600">Please fill in your information</p>
        </div>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            {{-- ✅ Jetstream only needs "name", so we combine first + last --}}
            <div class="mb-6">
                <label for="name" class="block text-gray-700 text-sm font-semibold mb-2">
                    Full Name
                </label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="John Doe"
                    required
                >
            </div>

            <div class="mb-6">
                <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">
                    Email Address
                </label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="your@email.com"
                    required
                >
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">
                    Password
                </label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="••••••••"
                    required
                >
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-700 text-sm font-semibold mb-2">
                    Confirm Password
                </label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="••••••••"
                    required
                >
            </div>

            <div class="mb-6 flex items-center">
                <input
                    type="checkbox"
                    id="terms"
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                    required
                >
                <label for="terms" class="ml-2 text-sm text-gray-600">
                    I agree to the Terms and Conditions
                </label>
            </div>

            <button
                type="submit"
                class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-300"
            >
                Sign Up
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                    Sign in
                </a>
            </p>
        </div>
    </div>
</main>
@endsection
