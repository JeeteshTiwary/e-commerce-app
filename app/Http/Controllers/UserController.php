<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home()
    {
        $categories = Category::select('name')->where('parent_id', '0')->with('product')->get();
        $subCategories = Category::select('name')->where('parent_id','!=', '0')->with('product')->get();
        // dd($categories);
        return view('user.layouts.home', compact('categories', 'subCategories'));
    }
}