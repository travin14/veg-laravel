@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<main class="max-w-3xl mx-auto px-4 py-12">
    <div class="bg-white/70 backdrop-blur-md border border-gray-200 shadow-xl rounded-2xl p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center"> Edit Product</h1>

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

        <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                       class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="category_id" required
                        class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Price (LKR)</label>
                    <input type="number" name="price" step="0.01" value="{{ old('price', $product->price) }}" required
                           class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
                    <select name="in_stock"
                            class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
                        <option value="1" {{ $product->in_stock ? 'selected' : '' }}>In Stock</option>
                        <option value="0" {{ !$product->in_stock ? 'selected' : '' }}>Out of Stock</option>
                    </select>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="on_sale" id="on_sale_checkbox" value="1"
                       class="h-5 w-5 text-green-600 border-gray-300 rounded"
                       {{ $product->on_sale ? 'checked' : '' }}>
                <label for="on_sale_checkbox" class="text-sm text-gray-700">On Sale?</label>
            </div>

            <div id="sale_price_field" class="{{ $product->on_sale ? '' : 'hidden' }}">
                <label class="block text-sm font-medium text-gray-700 mb-1">Sale Price (LKR)</label>
                <input type="number" name="sale_price" step="0.01" value="{{ old('sale_price', $product->sale_price) }}"
                       class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="3"
                          class="w-full rounded-xl border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none">{{ old('description', $product->description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Product Image</label>
                <input type="file" name="image" accept="image/*"
                       class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4
                              file:rounded-full file:border-0 file:text-sm file:font-semibold
                              file:bg-green-50 file:text-green-700 hover:file:bg-green-100">

                @if ($product->image)
                    <div class="mt-3">
                        <p class="text-sm text-gray-500">Current Image:</p>
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image"
                             class="w-24 h-24 object-cover mt-2 rounded-lg border border-gray-300">
                    @endif
                </div>
            </div>

            <div class="flex justify-end pt-4 gap-3">
                <a href="{{ route('admin.dashboard') }}"
                   class="px-5 py-2 bg-gray-300 text-gray-800 rounded-xl hover:bg-gray-400 transition duration-200">
                    Cancel
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-green-600 text-white rounded-xl hover:bg-green-700 transition duration-200">
                    Update Product
                </button>
            </div>
        </form>
    </div>
</main>

<script>
    document.getElementById('on_sale_checkbox').addEventListener('change', function () {
        document.getElementById('sale_price_field').classList.toggle('hidden', !this.checked);
    });
</script>
@endsection
