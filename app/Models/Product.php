<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    // ✅ Mass assignable attributes
    protected $fillable = [
        'name',
        'category_id',
        'price',
        'in_stock',
        'on_sale',
        'sale_price',
        'image',
        'description',
    ];

    // ✅ Disable timestamps if not needed
    public $timestamps = false;

    // 🔗 Category relationship
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // 🔗 Optional: Orders that include this product
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
