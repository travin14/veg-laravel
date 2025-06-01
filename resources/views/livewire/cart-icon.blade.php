<a href="{{ url('/cart') }}" class="text-blue-600 border border-blue-600 px-3 py-1 rounded-md text-sm hover:bg-blue-50 transition flex items-center gap-1">
    <i class="fas fa-shopping-cart"></i> Cart
    @if($count > 0)
        <span class="ml-1 text-xs bg-red-500 text-white font-bold px-1.5 py-0.5 rounded-full">
            {{ $count }}
        </span>
    @endif
</a>
