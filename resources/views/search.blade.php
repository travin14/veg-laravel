@extends('layouts.app')

@section('title', 'Live Product Search')

@section('content')
<main class="max-w-2xl mx-auto py-10">
    <h2 class="text-2xl font-bold mb-4">Search Products</h2>

    {{-- This loads your Livewire component --}}
    @livewire('product-search')
</main>
@endsection
