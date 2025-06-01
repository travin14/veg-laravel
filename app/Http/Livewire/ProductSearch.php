<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductSearch extends Component
{
    public $search = '';

    public function render()
    {
        // Only fetch products if there's something being typed
        $products = $this->search
            ? Product::where('name', 'like', '%' . $this->search . '%')->get()
            : collect(); // empty collection if search is empty

        return view('livewire.product-search', [
            'products' => $products
        ]);
    }

    public function goToProduct($id)
    {
        return redirect()->route('product.show', ['id' => $id]);
    }
}
