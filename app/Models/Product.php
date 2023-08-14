<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function brand() {
        return $this->belongsToMany(Brand::class, 'product_brand_categories');
    }
    public function category() {
        return $this->belongsToMany(Category::class, 'product_brand_categories');
    }
    
    public function images() {
        return $this->belongsToMany(Category::class, 'product_brand_categories');
    }
}
