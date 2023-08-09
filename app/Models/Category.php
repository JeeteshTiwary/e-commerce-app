<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'thumbnail', 
        'parent_id', 
        'status', 
        'created_by', 
        'updated_by', 
        'description', 
    ];

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }
}
