<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductSearch extends Component
{
    public $search = '';
    public $results = [];

    public function updatedSearch()
    {
        $this->results = strlen($this->search) > 0
            ? Product::where('name', 'like', '%' . $this->search . '%')
                ->orderBy('name')
                ->limit(5)
                ->get()
            : collect();
    }

    public function goToProduct($id)
    {
        return redirect()->route('product.show', ['id' => $id]);
    }

    public function render()
    {
        return view('livewire.product-search');
    }
}
