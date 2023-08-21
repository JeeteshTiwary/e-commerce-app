<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product_Detail extends Model
{
    use HasFactory;
    protected $table = 'product_details';

    protected $fillable = [
        'description',
        'thumbnail',
        'status',
        'base_price',
        'sale_price',
        'quantity_on_shelf',
        'quantity_in_warehouse',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}