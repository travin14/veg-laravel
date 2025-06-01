@extends('layouts.app')

@section('title', 'Your Cart')

@section('content')
<main class="py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">🛒 Shopping Cart</h1>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-800 rounded shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        @php
            $cart = session('cart', []);
            $grandTotal = 0;
        @endphp

        @if(count($cart) > 0)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <table class="w-full table-auto text-sm text-gray-700">
                    <thead class="bg-gray-100 text-xs font-semibold text-gray-600">
                        <tr>
                            <th class="text-left px-6 py-3">Product</th>
                            <th class="text-left px-6 py-3">Price</th>
                            <th class="text-left px-6 py-3">Quantity</th>
                            <th class="text-left px-6 py-3">Total</th>
                            <th class="text-center px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $key => $item)
                            @php $grandTotal += $item['total_price']; @endphp
                            <tr class="border-t">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        @if (!empty($item['image']))
                                            <img src="{{ asset('storage/' . $item['image']) }}"
                                                 alt="{{ $item['name'] }}"
                                                 class="w-20 h-20 object-cover rounded border shadow-sm">
                                        @endif
                                        <div>
                                            <p class="font-semibold text-gray-800">{{ $item['name'] }}</p>
                                            <p class="text-xs text-gray-500">Unit: {{ $item['unit'] }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    LKR {{ number_format($item['price_per_unit'], 2) }} / {{ $item['unit'] }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item['quantity'] }} {{ $item['unit'] }}
                                </td>
                                <td class="px-6 py-4 font-medium text-green-700">
                                    LKR {{ number_format($item['total_price'], 2) }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('cart.remove', $key) }}"
                                       class="text-red-500 hover:text-red-700 text-sm font-medium">
                                        Remove
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                        <!-- Grand Total -->
                        <tr class="border-t bg-gray-50">
                            <td colspan="3" class="px-6 py-4 text-right font-bold">Grand Total:</td>
                            <td class="px-6 py-4 text-green-700 font-bold">LKR {{ number_format($grandTotal, 2) }}</td>
                            <td></td>
                        </tr>

                        <!-- Checkout Button -->
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-right">
                                <a href="{{ route('checkout') }}"
                                   class="inline-block bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition font-semibold">
                                    Proceed to Checkout
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center text-gray-600 mt-10">
                <p>Your cart is empty.</p>
                <a href="{{ url('/vegetables') }}" class="text-green-600 hover:underline font-semibold">Shop now</a>
            </div>
        @endif
    </div>
</main>
@endsection
