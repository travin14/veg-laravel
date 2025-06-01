@extends('layouts.app')

@section('title', $product->name)

@section('content')
<main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start bg-white shadow-lg rounded-lg p-6">

        {{-- 🖼️ Product Image --}}
        <div class="w-full h-80 md:h-96 overflow-hidden rounded-lg border">
            <img src="{{ asset('storage/' . $product->image) }}"
                 alt="{{ $product->name }}"
                 class="w-full h-full object-contain hover:scale-105 transition duration-500" />
        </div>

        {{-- 📝 Product Info --}}
        <div class="space-y-5">
            <h1 class="text-3xl font-bold text-gray-800">{{ $product->name }}</h1>
            <p class="text-sm text-gray-500 font-medium">{{ $product->category->name ?? 'Category' }}</p>

            {{-- 📖 Description --}}
            @if($product->description)
                <p class="text-gray-700 text-base leading-relaxed">
                    {{ $product->description }}
                </p>
            @endif

            {{-- 💰 Pricing --}}
            <div class="text-xl font-semibold space-x-2">
                @if($product->on_sale)
                    <span class="text-green-600">LKR {{ number_format($product->sale_price, 2) }}</span>
                    <span class="line-through text-gray-400 text-base">LKR {{ number_format($product->price, 2) }}</span>
                @else
                    <span class="text-gray-900">LKR {{ number_format($product->price, 2) }}</span>
                @endif
                <span class="text-sm text-gray-500">/ {{ $product->unit ?? '1kg' }}</span>
            </div>

            {{-- 📦 Stock --}}
            <div class="text-sm font-medium {{ $product->in_stock ? 'text-green-600' : 'text-red-600' }}">
                {{ $product->in_stock ? 'Available In Stock' : 'Currently Out of Stock' }}
            </div>

            {{-- 🛒 Add to Cart Form --}}
            @if($product->in_stock)
            <form action="{{ route('cart.add') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="flex gap-4">
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                        <input type="number" name="quantity" id="quantity" min="0.1" step="0.1" value="1"
                               class="mt-1 w-24 px-3 py-2 border rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" required>
                    </div>

                    <div>
                        <label for="unit" class="block text-sm font-medium text-gray-700">Unit</label>
                        <select name="unit" id="unit"
                                class="mt-1 w-28 px-3 py-2 border rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                            <option value="kg">kg</option>
                            <option value="g">g</option>
                        </select>
                    </div>
                </div>

                <button type="submit"
                        class="mt-4 inline-block bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition font-semibold shadow">
                    Add to Cart
                </button>
            </form>
            @endif

            {{-- 🔙 Back --}}
            <a href="{{ url()->previous() }}"
               class="inline-block mt-4 text-blue-600 hover:underline text-sm font-medium">
                ← Back to Products
            </a>
        </div>
    </div>
</main>
@endsection
