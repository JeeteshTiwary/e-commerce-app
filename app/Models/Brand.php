<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo', 
        'url', 
        'created_by', 
        'updated_by', 
        'description', 
        'status', 
    ];
}
