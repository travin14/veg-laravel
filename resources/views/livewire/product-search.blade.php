@php
    $isInNavbar = request()->is('vegetables') || request()->is('fruits') || request()->is('/');
@endphp

<div class="relative z-50 w-64">
    <input
        type="text"
        wire:model.debounce.300ms="search"
        placeholder="Search products..."
        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
    >

    @if ($search && $this->results->count())
        <ul class="absolute left-0 right-0 bg-white mt-1 border border-gray-200 rounded-md shadow-lg max-h-60 overflow-y-auto z-50">
            @foreach ($this->results as $product)
                <li
                    wire:click="goToProduct({{ $product->id }})"
                    class="px-4 py-2 text-sm text-gray-800 hover:bg-green-50 cursor-pointer transition"
                >
                    {{ $product->name }}
                </li>
            @endforeach
        </ul>
    @elseif($search && $this->results->isEmpty())
        <div class="absolute left-0 right-0 bg-white mt-1 border border-gray-200 rounded-md shadow-lg px-4 py-2 text-sm text-gray-500 z-50">
            No results found.
        </div>
    @endif
</div>
