<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = floatval($request->input('quantity', 1));
        $unit = $request->input('unit', 'kg'); // Default to kg

        $product = Product::find($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Invalid product.');
        }

        // 🧮 Calculate base price and adjusted quantity
        $basePrice = $product->on_sale ? $product->sale_price : $product->price;
        $unitMultiplier = $unit === 'g' ? 0.001 : 1; // grams to kg
        $totalQuantity = $quantity * $unitMultiplier;
        $totalPrice = round($basePrice * $totalQuantity, 2);

        // 🛒 Retrieve or initialize cart
        $cart = session()->get('cart', []);

        // 🆔 Generate unique key per item/unit
        $cartKey = $productId . '_' . $unit;

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $quantity;
            $cart[$cartKey]['total_price'] = round($cart[$cartKey]['price_per_unit'] * ($cart[$cartKey]['quantity'] * $unitMultiplier), 2);
        } else {
            $cart[$cartKey] = [
                'id' => $product->id,
                'name' => $product->name,
                'unit' => $unit,
                'quantity' => $quantity,
                'price_per_unit' => $basePrice,
                'total_price' => $totalPrice,
                'image' => $product->image,
            ];
        }

        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'Item added to cart!');
    }

    public function removeFromCart($key)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$key])) {
            unset($cart[$key]);
            session(['cart' => $cart]); // ✅ commit updated cart to session
        }

        return redirect()->back()->with('success', 'Item removed from cart!');
    }
}
