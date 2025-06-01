@php
    $isInNavbar = request()->is('vegetables') || request()->is('fruits');
@endphp

<div class="relative z-50 w-64">
    <input
        type="text"
        wire:model="search"
        placeholder="Search products..."
        class="w-full px-4 py-2 border rounded-lg focus:outline-none"
    >

    @if ($search && $products->count())
        <ul class="absolute bg-white w-full mt-1 border rounded shadow">
            @foreach ($products as $product)
                <li
                    class="px-4 py-2 hover:bg-gray-100 cursor-pointer"
                    wire:click="goToProduct({{ $product->id }})"
                >
                    {{ $product->name }}
                </li>
            @endforeach
        </ul>
    @endif
</div>


