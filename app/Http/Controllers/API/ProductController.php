<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Return all products as JSON with full image URLs.
     */
    public function index()
    {
        $products = Product::select('id', 'name', 'price', 'sale_price', 'description', 'category_id', 'on_sale', 'image')->get();

        foreach ($products as $product) {
            $product->image = $product->image
                ? asset('storage/products/' . $product->image)
                : null;
        }

        return response()->json($products, 200);
    }

    /**
     * Store a new product with image upload.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'on_sale' => 'nullable|boolean',
            'image' => 'nullable|file|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/products', $filename);
            $validated['image'] = $filename;
        }

        $product = Product::create($validated);
        $product->image = $product->image
            ? asset('storage/products/' . $product->image)
            : null;

        return response()->json($product, 201);
    }

    /**
     * Update an existing product and its image.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric',
            'sale_price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'category_id' => 'sometimes|required|exists:categories,id',
            'on_sale' => 'nullable|boolean',
            'image' => 'nullable|file|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/products', $filename);
            $validated['image'] = $filename;
        }

        $product->update($validated);
        $product->image = $product->image
            ? asset('storage/products/' . $product->image)
            : null;

        return response()->json($product, 200);
    }

    /**
     * Delete a product.
     */
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return response()->json(['message' => 'Product deleted'], 200);
    }

    /**
     * Show one product by ID with full image URL.
     */
    public function show($id)
    {
        $product = Product::select('id', 'name', 'price', 'sale_price', 'description', 'category_id', 'on_sale', 'image')
                           ->findOrFail($id);
        $product->image = $product->image
            ? asset('storage/products/' . $product->image)
            : null;

        return response()->json($product, 200);
    }

    /**
     * Get products by category (vegetables, fruits, offers).
     */
    public function getByCategory($categoryName)
    {
        if (Str::lower($categoryName) === 'offers') {
            $products = Product::where('on_sale', 1)
                ->select('id', 'name', 'price', 'sale_price', 'description', 'category_id', 'on_sale', 'image')
                ->get();
        } else {
            $category = Category::where('name', Str::ucfirst($categoryName))->first();

            if (!$category) {
                return response()->json(['error' => 'Category not found'], 404);
            }

            $products = Product::where('category_id', $category->id)
                ->select('id', 'name', 'price', 'sale_price', 'description', 'category_id', 'on_sale', 'image')
                ->get();
        }

        foreach ($products as $product) {
            $product->image = $product->image
                ? asset('storage/products/' . $product->image)
                : null;
        }

        return response()->json($products, 200);
    }
}