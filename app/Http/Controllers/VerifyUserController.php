<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use app\Models\User;

class VerifyUserController extends Controller
{
    public function verifyuser()
    {
        $is_admin = (Auth::user()->role_id == 1) ? true : false;
        if ($is_admin) {
            return redirect()->route('admin.home');
        }
        return redirect()->route('user.home');
    }
}