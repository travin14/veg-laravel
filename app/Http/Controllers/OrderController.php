<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderController extends Controller
{
    /**
     * Handle placing a new order
     */
    public function placeOrder(Request $request)
    {
        // ✅ Step 1: Validate input
        $request->validate([
            'full_name'    => 'required|string|max:255',
            'email'        => 'required|email|max:255', // ✅ email required
            'phone'        => 'required|string|max:20',
            'address'      => 'required|string|max:255',
            'city'         => 'required|string|max:100',
            'postal_code'  => 'required|string|max:20',
            'card_holder'  => 'required|string|max:255',
            'card_number'  => 'required|string',
            'expiry_date'  => 'required|string',
            'cvv'          => 'required|string',
        ]);

        // ✅ Step 2: Get cart from session
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        // ✅ Step 3: Calculate total
        $total = collect($cart)->sum(function ($item) {
            return $item['total_price'];
        });

        // ✅ Step 4: Create Order
        $order = Order::create([
            'user_id'     => Auth::check() ? Auth::id() : null,
            'email'       => $request->email,
            'full_name'   => $request->full_name,
            'phone'       => $request->phone,
            'address'     => $request->address,
            'city'        => $request->city,
            'postal_code' => $request->postal_code,
            'total'       => $total,
            'status'      => 'Processing',
        ]);

        // ✅ Step 5: Create Order Items with Product Name
        foreach ($cart as $item) {
            $product = Product::find($item['id']);
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item['id'],
                'name'       => $product?->name ?? 'Unnamed',
                'price'      => $item['price_per_unit'],
                'quantity'   => $item['quantity'],
            ]);
        }

        // ✅ Step 6: Clear cart
        session()->forget('cart');

        // ✅ Step 7: Redirect to confirmation
        return redirect()->route('order.confirmation')->with('order_id', $order->id);
    }

    /**
     * Show order confirmation page
     */
    public function orderConfirmation()
    {
        $orderId = session('order_id');

        $order = Order::with('items.product')->find($orderId);

        if (!$order) {
            return view('order-confirmation', [
                'order' => null,
                'message' => 'No recent order found.'
            ]);
        }

        return view('order-confirmation', compact('order'));
    }

    /**
     * Show user's account + order history
     */
    public function accountPage()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('items.product')
            ->latest()
            ->get();

        return view('account', compact('orders'));
    }
}
