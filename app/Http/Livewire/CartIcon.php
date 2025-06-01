<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartIcon extends Component
{
    public $cartCount = 0;

    public function mount()
    {
        $this->cartCount = session()->has('cart') ? count(session('cart')) : 0;
    }

    public function render()
    {
        return view('livewire.cart-icon');
    }
}
