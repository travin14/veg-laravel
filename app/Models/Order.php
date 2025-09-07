<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrderItem;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'phone',
        'address',
        'city',
        'postal_code',
        'total',
        'status',
        'email', // ✅ optional but useful for both backend & API
    ];

    /**
     * 🔗 The user who placed the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 📦 The items within this order.
     * This replaces `orderItems()` to simply `items()` for better API/Flutter integration.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
