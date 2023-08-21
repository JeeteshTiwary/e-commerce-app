<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo', 
        'url', 
        'status', 
        'created_by', 
        'updated_by', 
        'description', 
    ];

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function categories() {
        return $this->belongsToMany(Category::class, 'brand_categories');
    }

    public function product() {
        return $this->belongsToMany(Product::class, 'product_brand_category');
    }
}
