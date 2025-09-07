@extends('layouts.app')

@section('title', 'My Account')

@section('content')
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="text-center mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900">My Account</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Account Info -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Account Information</h2>
            <p class="text-sm text-gray-700"><strong>Email:</strong> {{ Auth::user()->email }}</p>
        </div>

        <!-- Shipping Info -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Shipping Information</h2>
            <ul class="text-sm text-gray-700 space-y-1">
                <li><strong>Name:</strong> {{ Auth::user()->name }}</li>
                <li><strong>Address:</strong> {{ Auth::user()->address ?? 'N/A' }}</li>
                <li><strong>City:</strong> {{ Auth::user()->city ?? 'N/A' }}</li>
                <li><strong>Postal Code:</strong> {{ Auth::user()->postal_code ?? 'N/A' }}</li>
                <li><strong>Phone:</strong> {{ Auth::user()->phone ?? 'N/A' }}</li>
            </ul>
        </div>
    </div>

    <!-- Order History -->
    <div class="mt-10 bg-white shadow rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Order History</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-gray-700">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left font-medium uppercase">Order ID</th>
                        <th class="px-6 py-3 text-left font-medium uppercase">Date</th>
                        <th class="px-6 py-3 text-left font-medium uppercase">Status</th>
                        <th class="px-6 py-3 text-left font-medium uppercase">Items</th>
                        <th class="px-6 py-3 text-left font-medium uppercase">Total</th>
                        <th class="px-6 py-3 text-left font-medium uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($orders as $order)
                        <tr>
                            <td class="px-6 py-4">#{{ $order->id }}</td>
                            <td class="px-6 py-4">{{ $order->created_at->format('F j, Y') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                    {{ $order->status == 'Delivered' ? 'bg-green-100 text-green-800' : 
                                       ($order->status == 'Pending' ? 'bg-yellow-100 text-yellow-800' : 
                                       'bg-gray-100 text-gray-700') }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $order->items->count() }} item(s)</td>
                            <td class="px-6 py-4">LKR {{ number_format($order->total, 2) }}</td>
                            <td class="px-6 py-4">
                                <button 
                                    onclick="document.getElementById('modal-{{ $order->id }}').classList.remove('hidden')"
                                    class="text-green-600 hover:text-green-800 text-sm">
                                    View Details
                                </button>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div id="modal-{{ $order->id }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
                            <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
                                <button onclick="document.getElementById('modal-{{ $order->id }}').classList.add('hidden')" 
                                        class="absolute top-2 right-3 text-gray-600 hover:text-black text-lg">&times;</button>
                                <h2 class="text-xl font-semibold mb-4">Order #{{ $order->id }}</h2>
                                
                                <div class="space-y-2 text-sm">
                                    <p><strong>Status:</strong> {{ $order->status }}</p>
                                    <p><strong>Total:</strong> LKR {{ number_format($order->total, 2) }}</p>
                                    <p><strong>Ordered on:</strong> {{ $order->created_at->format('F j, Y') }}</p>
                                </div>

                                <h3 class="text-md font-semibold mt-4 mb-2">Items</h3>
                                <ul class="text-sm text-gray-700 space-y-2 max-h-40 overflow-y-auto">
                                    @forelse ($order->items as $item)
                                        <li class="border-b pb-1">
                                            {{ $item->product->name ?? 'Deleted Product' }} - 
                                            {{ $item->quantity }} {{ $item->unit ?? '' }} 
                                            @ LKR {{ number_format($item->price, 2) }}
                                        </li>
                                    @empty
                                        <li>No item details found.</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-500">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection
