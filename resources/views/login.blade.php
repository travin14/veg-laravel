@extends('layouts.app')

@section('title', 'Login')

@section('content')
<main class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-sm w-full">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Welcome Back</h2>
            <p class="text-gray-600">Sign in to continue</p>
        </div>

        {{-- ✅ Connects to Jetstream --}}
        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="w-full mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="you@example.com"
                    required
                >
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="w-full mt-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="••••••••"
                    required
                >
            </div>

            <div class="flex justify-between items-center text-sm text-gray-600">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                    <span class="ml-2">Remember me</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-blue-600 hover:text-blue-800">Forgot password?</a>
            </div>

            <button
                type="submit"
                class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300"
            >
                Sign In
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-gray-600">
            Don’t have an account?
            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Sign Up</a>
        </div>
    </div>
</main>
@endsection

