<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderController extends Controller
{
    /**
     * ✅ List all orders for the logged-in user with item details
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $orders = Order::with('items')
            ->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                      ->orWhere('email', $user->email);
            })
            ->latest()
            ->get()
            ->map(function ($order) {
                return [
                    'id'         => $order->id,
                    'full_name'  => $order->full_name,
                    'email'      => $order->email,
                    'phone'      => $order->phone,
                    'address'    => $order->address,
                    'city'       => $order->city,
                    'postal_code'=> $order->postal_code,
                    'total'      => $order->total,
                    'status'     => $order->status,
                    'created_at' => $order->created_at->toIso8601String(),
                    'items'      => $order->items->map(function ($item) {
                        return [
                            'name'     => $item->name ?? 'Unnamed',
                            'quantity' => $item->quantity,
                            'price'    => $item->price,
                        ];
                    })->toArray(),
                ];
            });

        return response()->json($orders->values()->all());
    }

    /**
     * ✅ Store a new order with items
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name'          => 'required|string|max:255',
            'phone'              => 'required|string|max:20',
            'address'            => 'required|string|max:255',
            'city'               => 'required|string|max:100',
            'postal_code'        => 'required|string|max:10',
            'total'              => 'required|numeric',
            'items'              => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity'   => 'required|integer|min:1',
            'items.*.price'      => 'required|numeric|min:0',
        ]);

        $user = $request->user();

        $order = Order::create([
            'user_id'     => $user->id,
            'email'       => $user->email,
            'full_name'   => $request->full_name,
            'phone'       => $request->phone,
            'address'     => $request->address,
            'city'        => $request->city,
            'postal_code' => $request->postal_code,
            'total'       => $request->total,
            'status'      => 'Pending',
        ]);

        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);

            $order->items()->create([
                'product_id' => $item['product_id'],
                'name'       => $product?->name ?? 'Unnamed',
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
            ]);
        }

        return response()->json([
            'message'    => 'Order placed successfully',
            'id'         => $order->id,
            'full_name'  => $order->full_name,
            'email'      => $order->email,
            'phone'      => $order->phone,
            'address'    => $order->address,
            'city'       => $order->city,
            'postal_code'=> $order->postal_code,
            'total'      => $order->total,
            'status'     => $order->status,
            'created_at' => $order->created_at->toIso8601String(),
            'items'      => $order->items->map(function ($item) {
                return [
                    'name'     => $item->name,
                    'quantity' => $item->quantity,
                    'price'    => $item->price,
                ];
            })->toArray(),
        ], 201);
    }
}
