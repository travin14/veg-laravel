<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Mass assignable attributes
    protected $fillable = [
        'name',
        'category_id',
        'price',
        'in_stock',
        'on_sale',
        'sale_price',
        'image',
        'description'
    ];

    // Disable timestamps if not needed
    public $timestamps = false;

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
