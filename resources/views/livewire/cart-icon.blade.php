<a href="{{ url('/cart') }}" class="relative flex items-center justify-center px-4 h-10 text-sm text-blue-600 border border-blue-600 rounded-md hover:bg-blue-50 transition gap-1">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 7M7 13l-1.5 7h11L17 13M9 21h.01M15 21h.01" />
    </svg>
    Cart
    @if ($cartCount > 0)
        <span class="absolute -top-2 -right-2 bg-black text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
            {{ $cartCount }}
        </span>
    @endif
</a>
