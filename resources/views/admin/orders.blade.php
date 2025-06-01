@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-6">Customer Orders</h1>

<table class="min-w-full bg-white shadow rounded-lg">
    <thead>
        <tr class="bg-gray-200 text-left text-sm font-semibold text-gray-700">
            <th class="px-4 py-3">Order ID</th>
            <th class="px-4 py-3">Customer</th>
            <th class="px-4 py-3">Status</th>
            <th class="px-4 py-3">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr class="border-t">
                <td class="px-4 py-3">{{ $order->id }}</td>
                <td class="px-4 py-3">{{ $order->user->name }}</td>
                <td class="px-4 py-3">{{ $order->status }}</td>
                <td class="px-4 py-3">
                    <form action="{{ route('admin.orders.update') }}" method="POST" class="flex items-center gap-2">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <select name="status" class="border rounded px-2 py-1 text-sm">
                            <option value="Processing" {{ $order->status === 'Processing' ? 'selected' : '' }}>Processing</option>
                            <option value="Shipped" {{ $order->status === 'Shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="Delivered" {{ $order->status === 'Delivered' ? 'selected' : '' }}>Delivered</option>
                        </select>
                        <button type="submit" class="bg-blue-600 text-white px-2 py-1 text-sm rounded">Update</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
