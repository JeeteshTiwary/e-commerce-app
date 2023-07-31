<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // call to admin home page
    public function home(){
        return view('admin.home');
    }
    
    public function editProfile(Request $request){
        // dd(auth()->user()->role_id);
        $user = auth()->user();
        return view('profile.edit',[
            'user' => $request->user(),
        ]);
    }
    
}
