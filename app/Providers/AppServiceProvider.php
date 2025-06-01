<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use App\Http\Livewire\ProductSearch;
use App\Http\Livewire\CartIcon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Manually register Livewire components
        Livewire::component('product-search', ProductSearch::class);
        Livewire::component('cart-icon', CartIcon::class);
    }
}
