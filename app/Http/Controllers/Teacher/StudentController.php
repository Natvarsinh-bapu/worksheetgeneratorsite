<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\ClassName;
use Auth;

class StudentController extends Controller
{
    //list
    public function index($id){
        $classdata = ClassName::findOrFail($id);
        $users = User::where('class', $id)->paginate();
        
        return view('user.teacher.students', compact('users', 'classdata'));
    }    
}
