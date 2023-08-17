<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
    ];

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function productDetails(){
        return $this->hasOne(Product_Detail::class);
    }

    public function brand()
    {
        return $this->hasOne(Brand::class, 'product_brand_category');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'product_brand_category');
    }

    public function images()
    {
        return $this->hasMany(Category::class, 'product_images');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }

    public function variations()
    {
        return $this->belongsToMany(Variation::class, 'product_variations');
    }
}