<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Show products by category name (e.g., 'vegetables', 'fruits').
     */
    public function showByCategory($categoryName)
    {
        // Normalize category name (e.g., capitalize first letter)
        $category = Category::where('name', Str::ucfirst($categoryName))->firstOrFail();

        // Fetch products for that category
        $products = Product::where('category_id', $category->id)->get();

        // Return the appropriate category view (e.g., vegetables.blade.php)
        return view(strtolower($categoryName), compact('products', 'category'));
    }

    /**
     * Show a single product's detail view.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product_detail', compact('product'));
    }
}
