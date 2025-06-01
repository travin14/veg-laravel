<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartIcon extends Component
{
    public $count;

    public function mount()
    {
        $cart = session()->get('cart', []);
        $this->count = count($cart);
    }

    public function render()
    {
        return view('livewire.cart-icon');
    }
}
