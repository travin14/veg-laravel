@php
    $isExcludedPage = request()->is('login') || request()->is('register') || request()->is('forgot-password');
    $categories = \App\Models\Category::all();
@endphp

@if (! $isExcludedPage)
<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur border-b border-gray-200 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Branding -->
            <a href="/" class="text-2xl font-bold text-green-600 tracking-wide">
                FRESH<span class="text-gray-800">Mart</span>
            </a>

            <!-- Nav Links -->
            <div class="hidden md:flex space-x-8 text-gray-700 text-sm font-medium">
                <a href="/" class="relative group">
                    <span class="hover:text-green-600 transition">Home</span>
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-green-600 transition-all duration-300 group-hover:w-full"></span>
                </a>

                @foreach ($categories as $category)
                    <a href="{{ url(strtolower($category->name)) }}" class="relative group capitalize">
                        <span class="hover:text-green-600 transition">{{ $category->name }}</span>
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-green-600 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                @endforeach

                <a href="{{ route('offers') }}" class="relative group text-red-600">
                    <span class="hover:text-green-600 transition">Offers</span>
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-green-600 transition-all duration-300 group-hover:w-full"></span>
                </a>
            </div>

            <!-- Right Section -->
            <div class="hidden md:flex items-center gap-4 pl-4">
                @livewire('product-search')

                @auth
                    <a href="{{ route('account') }}"
                       class="flex items-center justify-center w-10 h-10 border border-green-600 text-green-600 rounded-md hover:bg-green-50 transition"
                       title="Account">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5.121 17.804A10.966 10.966 0 0112 15c2.5 0 4.847.815 6.879 2.196M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </a>

                    <a href="{{ url('/cart') }}"
                       class="relative flex items-center justify-center px-4 h-10 text-sm text-blue-600 border border-blue-600 rounded-md hover:bg-blue-50 transition gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 7M7 13l-1.5 7h11L17 13M9 21h.01M15 21h.01" />
                        </svg>
                        Cart
                        @if(session()->has('cart') && count(session('cart')) > 0)
                            <span class="absolute -top-2 -right-2 bg-black text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
                                {{ count(session('cart')) }}
                            </span>
                        @endif
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="px-4 h-10 text-sm text-red-600 border border-red-600 rounded-md hover:bg-red-50 transition">
                            Sign Out
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="px-4 h-10 text-sm text-green-600 border border-green-600 rounded-md hover:bg-green-50 transition">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}"
                       class="px-4 h-10 text-sm text-white bg-green-600 rounded-md hover:bg-green-700 transition">
                        Register
                    </a>
                @endauth
            </div>

            <!-- Mobile toggle -->
            <div class="md:hidden">
                <button @click="open = !open" class="text-gray-700 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" class="md:hidden px-4 pb-4 pt-2 space-y-2 text-sm text-gray-700">
        <a href="/" class="block hover:text-green-600">Home</a>

        @foreach ($categories as $category)
            <a href="{{ url(strtolower($category->name)) }}" class="block hover:text-green-600 capitalize">
                {{ $category->name }}
            </a>
        @endforeach

        <a href="{{ route('offers') }}" class="block text-red-600 font-semibold hover:text-green-600">Offers</a>

        @auth
            <a href="{{ route('account') }}" class="flex items-center space-x-2 text-green-600 font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A10.966 10.966 0 0112 15c2.5 0 4.847.815 6.879 2.196M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span>Account</span>
            </a>

            @livewire('cart-icon')

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left text-red-600">Sign Out</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="block text-green-600">Sign In</a>
            <a href="{{ route('register') }}" class="block bg-green-600 text-white px-3 py-1 rounded">Register</a>
        @endauth
    </div>
</nav>
@endif
