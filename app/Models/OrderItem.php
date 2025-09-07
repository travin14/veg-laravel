<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Product;

class OrderItem extends Model
{
    use HasFactory;

    // ✅ Fillable attributes for mass assignment
    protected $fillable = [
        'order_id',
        'product_id',
        'name',       // Snapshot of product name at time of ordering
        'quantity',
        'price',
        'unit',       // Optional: units like 'kg', 'g', 'pcs'
    ];

    /**
     * 🔗 The order this item belongs to.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * 🥬 The product associated with this order item.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
