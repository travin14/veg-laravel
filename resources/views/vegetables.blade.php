@extends('layouts.app')

@section('title', 'Vegetables')

@section('content')
<main class="max-w-7xl mx-auto px-4 py-10 font-sans">
    <h1 class="text-3xl font-extrabold text-green-700 mb-8 text-center">Fresh Vegetables</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @forelse($products as $product)
            <div class="bg-white shadow-md rounded-2xl overflow-hidden transform hover:scale-105 hover:shadow-xl transition duration-300 relative">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                         alt="{{ $product->name }}"
                         class="w-full h-48 object-cover">
                @endif

                <div class="p-4">
                    <h2 class="text-lg font-bold text-gray-800">{{ $product->name }}</h2>

                    @if($product->on_sale)
                        <div class="mt-2">
                            <p class="text-red-600 font-bold text-sm">
                                Sale: LKR {{ number_format($product->sale_price, 2) }}
                            </p>
                            <p class="text-gray-400 line-through text-sm">
                                LKR {{ number_format($product->price, 2) }}
                            </p>
                        </div>
                    @else
                        <p class="text-gray-700 text-sm mt-2">
                            LKR {{ number_format($product->price, 2) }}
                        </p>
                    @endif

                    <p class="text-xs mt-2 {{ $product->in_stock ? 'text-green-600' : 'text-red-500' }}">
                        {{ $product->in_stock ? 'In Stock' : 'Out of Stock' }}
                    </p>

                    @auth
                        <button onclick="openPopup({{ $product->id }})"
                                class="mt-4 w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition-all duration-200">
                            Add to Cart
                        </button>
                    @else
                        <button onclick="alert('Please log in to continue shopping.')"
                                class="mt-4 w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition-all duration-200">
                            Add to Cart
                        </button>
                    @endauth
                </div>
            </div>
        @empty
            <p class="text-gray-500 text-center col-span-3">No products found in this category.</p>
        @endforelse
    </div>
</main>

@auth
{{-- Add to Cart Modal --}}
<div id="add-to-cart-modal" class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl p-6 w-80 animate-fade-in">
        <form method="POST" action="{{ route('cart.add') }}">
            @csrf
            <input type="hidden" name="product_id" id="modal-product-id">

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Quantity</label>
                <input type="number" step="0.01" min="0.1" name="quantity" value="1"
                       class="w-full border border-gray-300 px-3 py-2 rounded mt-1 focus:ring-2 focus:ring-green-500 focus:outline-none" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Unit</label>
                <select name="unit" class="w-full border border-gray-300 px-3 py-2 rounded mt-1 focus:ring-2 focus:ring-green-500 focus:outline-none">
                    <option value="kg">Kilograms (kg)</option>
                    <option value="g">Grams (g)</option>
                </select>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="closePopup()"
                        class="px-4 py-2 text-gray-600 border border-gray-300 rounded hover:bg-gray-100 transition">
                    Cancel
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                    Add
                </button>
            </div>
        </form>
    </div>
</div>
@endauth

{{-- JS --}}
<script>
    function openPopup(productId) {
        document.getElementById('modal-product-id').value = productId;
        const modal = document.getElementById('add-to-cart-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closePopup() {
        const modal = document.getElementById('add-to-cart-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>

{{-- Optional fade-in animation --}}
<style>
    .animate-fade-in {
        animation: fadeIn 0.3s ease-out forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
</style>
@endsection
