@extends('layouts.app')

@section('title', 'Your Cart')

@section('content')
<main class="py-12">
  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Shopping Cart</h1>

    @if(session('success'))
      <div class="mb-4 p-3 rounded bg-green-100 text-green-800">
        {{ session('success') }}
      </div>
    @endif

    @php
      $cart = session('cart', []);
      $grandTotal = 0;
    @endphp

    @if(count($cart) > 0)
      <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full table-auto text-sm text-gray-700">
          <thead class="bg-gray-100 text-xs font-semibold uppercase text-gray-600">
            <tr>
              <th class="px-6 py-3 text-left">Product</th>
              <th class="px-6 py-3 text-left">Price</th>
              <th class="px-6 py-3 text-left">Quantity</th>
              <th class="px-6 py-3 text-left">Total</th>
              <th class="px-6 py-3"></th>
            </tr>
          </thead>
          <tbody>
            @foreach($cart as $key => $item)
              @php $grandTotal += $item['total_price']; @endphp
              <tr class="border-t">
                <td class="px-6 py-4 flex items-center gap-3">
                  @if (!empty($item['image']))
                    <img src="{{ asset('storage/' . $item['image']) }}" class="w-14 h-14 object-cover rounded shadow" alt="{{ $item['name'] }}">
                  @endif
                  <div>
                    <div class="font-semibold">{{ $item['name'] }}</div>
                    <div class="text-xs text-gray-500">({{ $item['unit'] }})</div>
                  </div>
                </td>
                <td class="px-6 py-4">LKR {{ number_format($item['price_per_unit'], 2) }} / {{ $item['unit'] }}</td>
                <td class="px-6 py-4">{{ $item['quantity'] }} {{ $item['unit'] }}</td>
                <td class="px-6 py-4 font-semibold text-green-600">LKR {{ number_format($item['total_price'], 2) }}</td>
                <td class="px-6 py-4 text-right">
                  <a href="{{ route('cart.remove', $key) }}" class="text-red-500 hover:text-red-700 text-sm">Remove</a>
                </td>
              </tr>
            @endforeach

            <!-- Total Row -->
            <tr class="border-t bg-gray-100">
              <td colspan="3" class="px-6 py-4 text-right font-bold">Grand Total:</td>
              <td class="px-6 py-4 font-bold text-green-700">LKR {{ number_format($grandTotal, 2) }}</td>
              <td></td>
            </tr>

            <!-- Checkout Button -->
            <tr>
              <td colspan="5" class="px-6 py-4 text-right">
                <a href="{{ route('checkout') }}" class="inline-block bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition font-semibold">
                  Proceed to Checkout
                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    @else
      <p class="text-gray-600">Your cart is empty.
        <a href="{{ url('/vegetables') }}" class="text-green-600 hover:underline">Shop now</a>
      </p>
    @endif
  </div>
</main>
@endsection
