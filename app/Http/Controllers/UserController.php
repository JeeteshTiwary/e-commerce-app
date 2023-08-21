<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home()
    {
        $categories = Category::select('name')->with('product')->get();
        return view('user.home', compact('categories'));
    }
}