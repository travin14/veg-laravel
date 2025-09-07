@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Page Header -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Checkout</h1>
        <p class="mt-3 text-gray-500">Complete your order in two simple steps</p>
    </div>

    @php
        $cart = session('cart', []);
        $total_price = 0;
    @endphp

    <div class="flex flex-col lg:flex-row gap-8">
        <form method="POST" action="{{ route('place.order') }}" class="flex flex-col lg:flex-row gap-8 w-full">
            @csrf

            <!-- Step 1: Shipping Details -->
            <div class="flex-1">
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Step 1: Shipping Details</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" name="full_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email Address</label>
                            <input type="email" name="email" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                value="{{ old('email', Auth::user()->email ?? '') }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Address</label>
                            <input type="text" name="address" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">City</label>
                                <input type="text" name="city" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Postal Code</label>
                                <input type="text" name="postal_code" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                            <input type="tel" name="phone" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 2: Payment + Order Summary -->
            <div class="flex-1 space-y-6">
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Step 2: Payment Details</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Card Holder Name</label>
                            <input type="text" name="card_holder" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Card Number</label>
                            <input type="text" name="card_number" required placeholder="**** **** **** ****" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Expiry Date</label>
                                <input type="text" name="expiry_date" required placeholder="MM/YY" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">CVV</label>
                                <input type="text" name="cvv" required placeholder="***" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Step 2: Order Summary</h2>

                    @if(count($cart) > 0)
                        <div class="space-y-4">
                            @foreach($cart as $item)
                                @php
                                    $price = $item['price_per_unit'];
                                    $quantity = $item['quantity'];
                                    $unit = $item['unit'];
                                    $itemTotal = $item['total_price'];
                                    $total_price += $itemTotal;
                                @endphp
                                <div class="flex justify-between items-center pb-4 border-b">
                                    <div>
                                        <h3 class="text-sm font-medium">{{ $item['name'] }}</h3>
                                        <p class="text-sm text-gray-500">Quantity: {{ $quantity }} {{ $unit }}</p>
                                        <p class="text-sm text-gray-500">LKR {{ number_format($price, 2) }} / {{ $unit }}</p>
                                    </div>
                                    <p class="text-sm font-medium">LKR {{ number_format($itemTotal, 2) }}</p>
                                </div>
                            @endforeach

                            <div class="border-t pt-4 mt-4">
                                <div class="flex justify-between">
                                    <p class="text-base font-medium">Total</p>
                                    <p class="text-base font-medium">LKR {{ number_format($total_price, 2) }}</p>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700">
                                Place Order
                            </button>
                        </div>
                    @else
                        <p class="text-gray-500">Your cart is empty</p>
                        <a href="{{ url('/') }}" class="mt-4 inline-block text-green-600 hover:text-green-700">
                            Continue Shopping
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</main>
@endsection
