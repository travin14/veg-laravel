@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- ✅ Flash Messages --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1 class="text-3xl font-extrabold text-gray-900 mb-8">Admin Dashboard</h1>

    {{-- ✅ Product Management --}}
    <section class="mb-16">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800"> Product Management</h2>
            <a href="{{ url('admin/product/create') }}" class="bg-green-600 text-white px-5 py-2.5 rounded-lg hover:bg-green-700 shadow">
                + Add Product
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full table-auto text-sm text-gray-700">
                <thead class="bg-gray-100 text-xs font-semibold uppercase text-gray-600">
                    <tr>
                        <th class="px-6 py-3 text-left">Image</th>
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left">Category</th>
                        <th class="px-6 py-3 text-left">Price</th>
                        <th class="px-6 py-3 text-left">Stock</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($products as $product)
                        <tr>
                            <td class="px-6 py-4">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="w-16 h-16 object-cover rounded border shadow-sm" />
                                @else
                                    <span class="text-gray-400 italic">No Image</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-medium">{{ $product->name }}</td>
                            <td class="px-6 py-4">{{ $product->category->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4">
                                <span>LKR {{ number_format($product->on_sale ? $product->sale_price : $product->price, 2) }}</span>
                                @if ($product->on_sale)
                                    <span class="line-through text-sm text-gray-400 ml-2">LKR {{ number_format($product->price, 2) }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold {{ $product->in_stock ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $product->in_stock ? 'In Stock' : 'Out of Stock' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 space-x-2">
                                <a href="{{ route('admin.product.edit', $product->id) }}" class="text-indigo-600 hover:underline">Edit</a>
                                <form action="{{ route('admin.product.delete', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    {{-- ✅ Category Management --}}
    <section class="mb-16">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800"> Category Management</h2>
            <a href="{{ url('admin/category/create') }}" class="bg-green-600 text-white px-5 py-2.5 rounded-lg hover:bg-green-700 shadow">
                + Add Category
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full table-auto text-sm text-gray-700">
                <thead class="bg-gray-100 text-xs font-semibold uppercase text-gray-600">
                    <tr>
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($categories as $category)
                        <tr>
                            <td class="px-6 py-4 font-medium">{{ $category->name }}</td>
                            <td class="px-6 py-4 space-x-2">
                                <a href="{{ route('admin.category.edit', $category->id) }}" class="text-indigo-600 hover:underline">Edit</a>
                                <form action="{{ route('admin.category.delete', $category->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    {{-- ✅ Order Management --}}
    <section>
        <h2 class="text-2xl font-semibold text-gray-800 mb-6"> Order Management</h2>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full table-auto text-sm text-gray-700">
                <thead class="bg-gray-100 text-xs font-semibold uppercase text-gray-600">
                    <tr>
                        <th class="px-6 py-3 text-left">Order ID</th>
                        <th class="px-6 py-3 text-left">Customer</th>
                        <th class="px-6 py-3 text-left">Date</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($orders as $order)
                        <tr>
                            <td class="px-6 py-4 font-medium">#{{ $order->id }}</td>
                            <td class="px-6 py-4">{{ $order->user->name ?? 'Guest' }}</td>
                            <td class="px-6 py-4">{{ $order->created_at->format('Y-m-d') }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.orders.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <select name="status" onchange="this.form.submit()" class="border px-2 py-1 rounded text-sm">
                                        <option {{ $order->status === 'Processing' ? 'selected' : '' }}>Processing</option>
                                        <option {{ $order->status === 'Shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option {{ $order->status === 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</main>
@endsection
