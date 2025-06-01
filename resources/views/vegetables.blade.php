@extends('layouts.app')

@section('title', 'Vegetables')

@section('content')
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h1 class="text-2xl font-bold text-gray-800 mb-6"> Fresh Vegetables</h1>

    @if ($products->isEmpty())
        <p class="text-gray-600">No vegetables available at the moment.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <div class="bg-white shadow rounded-lg overflow-hidden relative">
                    <a href="{{ route('products.show', $product->id) }}">
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                 class="w-full h-48 object-cover">
                        @endif
                    </a>

                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h2>

                        @if ($product->on_sale)
                            <p class="text-green-600 font-bold mt-2">
                                LKR {{ number_format($product->sale_price, 2) }}
                                <span class="line-through text-gray-400 text-sm ml-2">
                                    LKR {{ number_format($product->price, 2) }}
                                </span>
                            </p>
                        @else
                            <p class="text-gray-700 font-medium mt-2">
                                LKR {{ number_format($product->price, 2) }}
                            </p>
                        @endif

                        <p class="text-xs mt-2 {{ $product->in_stock ? 'text-green-600' : 'text-red-500' }}">
                            {{ $product->in_stock ? 'In Stock' : 'Out of Stock' }}
                        </p>

                        @auth
                            <button onclick="openPopup({{ $product->id }})"
                                    class="w-full bg-green-600 text-white px-4 py-2 text-sm rounded hover:bg-green-700 transition mt-4">
                                Add to Cart
                            </button>
                        @else
                            <button onclick="alert('Please log in to continue shopping.')"
                                    class="w-full bg-green-600 text-white px-4 py-2 text-sm rounded hover:bg-green-700 transition mt-4">
                                Add to Cart
                            </button>
                        @endauth

                        <a href="{{ route('products.show', $product->id) }}"
                           class="inline-block mt-2 text-sm text-blue-600 hover:underline">View</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</main>

{{-- 🔄 Shared Modal --}}
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
