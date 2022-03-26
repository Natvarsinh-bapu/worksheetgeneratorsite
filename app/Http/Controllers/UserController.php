<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    //profile
    public function profile(){
        $user = Auth::user();

        return view('user.profile', compact('user'));
    }
}
