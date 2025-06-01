@extends('layouts.admin')

@section('title', 'Add Category')

@section('content')
<main class="max-w-xl mx-auto px-4 py-12">
    <div class="bg-white/70 backdrop-blur-md border border-gray-200 shadow-xl rounded-2xl p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center"> Add New Category</h1>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg flex items-center gap-2 mb-6">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded-lg mb-6">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li><i class="fas fa-exclamation-circle mr-1"></i>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.addCategory') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                <input type="text" name="name" required
                       class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none"
                       placeholder="e.g. Vegetables">
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit"
                        class="px-6 py-2 bg-green-600 text-white rounded-xl hover:bg-green-700 transition duration-200">
                    Add Category
                </button>
            </div>
        </form>
    </div>
</main>
@endsection
