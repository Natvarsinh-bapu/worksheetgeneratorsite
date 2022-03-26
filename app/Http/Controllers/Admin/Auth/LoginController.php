<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Admin;

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
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.guest:admin', ['except' => 'logout']);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
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

        $admin = Admin::where('email', $post['email'])->first();

        if($admin && $admin->is_verified == 0){
            return redirect('admin/login')->with('error_message', 'Your email is not verified, Please check your mail inbox');
        }
        
        if($admin && $admin->status == 0){
            return redirect('admin/login')->with('error_message', 'Your account is requested, Once super admin activate then you can able to login');
        }
        
        if($admin && $admin->status == 2){
            return redirect('admin/login')->with('error_message', 'Your account is blocked');
        }

        if(Auth::guard('admin')->attempt(['email' => $post['email'], 'password' => $post['password']])){
            return redirect('admin');
        } else {
            return redirect('admin/login')->with('error_message', 'Invalid email or password');
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

        return redirect()->route('admin.login');
    }

}
