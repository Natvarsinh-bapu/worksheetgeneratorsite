<?php

namespace App\Http\Controllers\Institute\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Institute;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/institute';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('institute.guest:institute', ['except' => 'logout']);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('institute');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('institute.auth.login');
    }

    /**
     * function for login 
     */
    public function login(Request $request){
        $post = $request->all();

        $messages = [
            'email.required' => 'Please enter email',
            'password.required' => 'Please enter password'
        ];
        $validator = Validator::make($post, [
            'email' => 'required',
            'password' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return redirect('admin/login')
                        ->withErrors($validator)
                        ->withInput();
        }

        $institute = Institute::where('email', $post['email'])->first();

        if($institute && $institute->admin_status != 1){
            return redirect('institute/login')->with('error_message', 'Please contact your admin');
        }
                
        if(Auth::guard('institute')->attempt(['email' => $post['email'], 'password' => $post['password']])){
            return redirect('institute');
        } else {
            return redirect('institute/login')->with('error_message', 'Invalid email or password');
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {

        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->route('institute.login');
    }

}
