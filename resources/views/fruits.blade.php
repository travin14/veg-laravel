@extends('layouts.app')

@section('title', 'Fruits')

@section('content')
<main class="max-w-7xl mx-auto px-4 py-10">
    <h1 class="text-2xl font-bold mb-6">Fruits</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($products as $product)
            <div class="bg-white shadow rounded-lg p-4 hover:shadow-lg transition-shadow duration-300 relative">

                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                         alt="{{ $product->name }}"
                         class="w-full h-48 object-cover rounded mb-3">
                @endif

                <h2 class="text-lg font-semibold mb-1">{{ $product->name }}</h2>

                @if($product->on_sale)
                    <p class="text-red-600 font-bold">
                        Sale: LKR {{ number_format($product->sale_price, 2) }}
                    </p>
                    <p class="text-gray-500 line-through">
                        LKR {{ number_format($product->price, 2) }}
                    </p>
                @else
                    <p class="text-gray-800">
                        LKR {{ number_format($product->price, 2) }}
                    </p>
                @endif

                <p class="text-sm text-gray-500 mt-1">
                    {{ $product->in_stock ? 'In Stock' : 'Out of Stock' }}
                </p>

                {{-- ✅ Show popup if logged in, alert if not --}}
                @auth
                    <button onclick="openPopup({{ $product->id }})"
                            class="w-full bg-green-600 text-white py-2 mt-4 rounded hover:bg-green-700 transition">
                        Add to Cart
                    </button>
                @else
                    <button onclick="alert('Please log in to continue shopping.')"
                            class="w-full bg-green-600 text-white py-2 mt-4 rounded hover:bg-green-700 transition">
                        Add to Cart
                    </button>
                @endauth
            </div>
        @empty
            <p>No products found in this category.</p>
        @endforelse
    </div>
</main>

{{-- Global Popup --}}
@auth
<div id="add-to-cart-modal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-80">
        <form method="POST" action="{{ route('cart.add') }}">
            @csrf
            <input type="hidden" name="product_id" id="modal-product-id">

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Quantity</label>
                <input type="number" step="0.01" min="0.1" name="quantity" value="1"
                       class="w-full border border-gray-300 px-3 py-2 rounded mt-1" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Unit</label>
                <select name="unit" class="w-full border border-gray-300 px-3 py-2 rounded mt-1">
                    <option value="kg">Kilograms (kg)</option>
                    <option value="g">Grams (g)</option>
                </select>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closePopup()"
                        class="px-4 py-2 text-gray-700 border border-gray-300 rounded hover:bg-gray-100">
                    Cancel
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    Add
                </button>
            </div>
        </form>
    </div>
</div>
@endauth

<script>
    function openPopup(productId) {
        document.getElementById('modal-product-id').value = productId;
        document.getElementById('add-to-cart-modal').classList.remove('hidden');
        document.getElementById('add-to-cart-modal').classList.add('flex');
    }

    function closePopup() {
        document.getElementById('add-to-cart-modal').classList.add('hidden');
        document.getElementById('add-to-cart-modal').classList.remove('flex');
    }
</script>
@endsection

