<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display products by category (e.g., 'vegetables', 'fruits').
     *
     * @param string $categoryName
     * @return \Illuminate\View\View
     */
    public function showByCategory($categoryName)
    {
        // Normalize the category name (capitalize first letter to match DB)
        $category = Category::where('name', Str::ucfirst($categoryName))->firstOrFail();

        // Get products under the selected category
        $products = Product::where('category_id', $category->id)->get();

        // Return the view named after the category (e.g., vegetables.blade.php)
        return view(strtolower($categoryName), compact('products', 'category'));
    }

    /**
     * Display the detail page for a single product.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product_detail', compact('product'));
    }
}
