@extends('layouts.app')

@section('title', 'Order Confirmation')

@section('content')
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @if(is_null($order))
        <div class="text-center text-red-600 text-lg">No recent order found.</div>
    @else
    <!-- ✅ Success Message -->
    <div class="text-center mb-8">
        <div class="mb-4">
            <i class="fas fa-check-circle text-green-500 text-5xl"></i>
        </div>
        <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Thank You for Your Order!</h1>
        <p class="mt-3 text-gray-500">Order #{{ strtoupper(substr($order->id, 0, 8)) }}</p>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <!-- ✅ Order Details -->
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-semibold mb-4">Order Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Shipping Address</h3>
                    <div class="mt-2 text-sm text-gray-900 space-y-1">
                        <p>{{ $order->full_name }}</p>
                        <p>{{ $order->address }}</p>
                        <p>{{ $order->city }}, {{ $order->postal_code }}</p>
                        <p>{{ $order->phone }}</p>
                        <p>{{ $order->email }}</p>
                    </div>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Order Summary</h3>
                    <div class="mt-2 text-sm text-gray-900 space-y-1">
                        <p>Total Amount: LKR {{ number_format($order->total, 2) }}</p>
                        <p>Order Date: {{ $order->created_at->format('F j, Y') }}</p>
                        <p>Status: {{ $order->status }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ✅ Order Items -->
        <div class="p-6">
            <h2 class="text-xl font-semibold mb-4">Ordered Items</h2>
            <div class="space-y-4">
                @if($order->items && count($order->items) > 0)
                    @foreach($order->items as $item)
                        <div class="flex items-center justify-between py-4 border-b last:border-0">
                            <div>
                                <h3 class="text-sm font-medium">
                                    {{ $item->product->name ?? 'Deleted Product' }}
                                </h3>
                                <p class="text-sm text-gray-500">
                                    Quantity: {{ $item->quantity }} {{ $item->unit }}
                                </p>
                            </div>
                            <p class="text-sm font-medium">
                                LKR {{ number_format($item->price * $item->quantity, 2) }}
                            </p>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-500">No items found for this order.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- ✅ Continue Shopping Button -->
    <div class="mt-8 text-center">
        <a href="{{ url('/') }}" class="inline-block bg-green-600 text-white py-2 px-6 rounded-md hover:bg-green-700">
            Continue Shopping
        </a>
    </div>
    @endif
</main>
@endsection
