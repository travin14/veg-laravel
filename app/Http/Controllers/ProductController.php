<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * 🥬 Display products by category (e.g., 'vegetables', 'fruits').
     *
     * @param string $categoryName
     * @return \Illuminate\View\View
     */
    public function showByCategory($categoryName)
    {
        // Normalize the category name (capitalize first letter for consistency)
        $formattedCategory = Str::ucfirst(strtolower($categoryName));

        // Find category or fail with 404
        $category = Category::where('name', $formattedCategory)->firstOrFail();

        // Retrieve products under this category
        $products = Product::where('category_id', $category->id)->get();

        // Render the view that matches the category slug (e.g., vegetables.blade.php)
        return view(strtolower($categoryName), compact('products', 'category'));
    }

    /**
     * 📦 Show details for a single product.
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
