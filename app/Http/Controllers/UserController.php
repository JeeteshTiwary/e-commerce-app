<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home()
    {
        $categories = Category::select('id', 'name', 'thumbnail','description')->where('parent_id', '0')->where('status','1')->get();
        $subCategories = Category::select('name', 'parent_id', 'thumbnail')->where('parent_id', '!=', '0')->withCount('product')->get();
        $products = Product::select('id','name',)->with('productDetails');
        return view('user.layouts.home', compact('categories', 'subCategories', 'products'));
    }
}