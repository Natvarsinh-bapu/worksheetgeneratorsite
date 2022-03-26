<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\ClassTeacher;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        if($user->role == 'student'){
            $teachers = ClassTeacher::where('class_id', $user->class)->get();

            return view('user.student.dashboard', compact('user', 'teachers'));
        } else {
            return view('user.teacher.dashboard', compact('user'));
        }

        // return view('home');
    }
}
