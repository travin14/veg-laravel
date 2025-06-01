@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
<main class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-6 rounded shadow max-w-sm w-full">
        <h2 class="text-xl font-bold mb-4 text-center">Admin Login</h2>

        @if(session('error'))
            <div class="text-red-600 text-sm mb-4">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm text-gray-700">Email</label>
                <input type="email" name="email" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm text-gray-700">Password</label>
                <input type="password" name="password" class="w-full px-4 py-2 border rounded" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                Login
            </button>
        </form>
    </div>
</main>
@endsection
