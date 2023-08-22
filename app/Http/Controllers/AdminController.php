<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // call to admin home page
    public function home(){
        return view('admin.layouts.home');
    }
    
    public function dashboard(Request $request){
        return view('admin.layouts.home');
    }
    public function editProfile(Request $request){
        $user = auth()->user();
        return view('profile.edit',[
            'user' => $request->user(),
        ]);
    }
    
}
