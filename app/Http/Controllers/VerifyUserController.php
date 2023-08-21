<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerifyUserController extends Controller
{
    public function verifyuser(){
        return view('admin.index');
    }
}
