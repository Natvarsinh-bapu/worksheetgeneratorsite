<?php

namespace App\Http\Controllers\Institute\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Carbon\Carbon;
use App\Institute;
use Validator;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    // use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
        $this->middleware('institute.guest:institute');
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        if($token != null){
            $institute = Institute::where('password_reset_token', $token)->first();
            
            if($institute){
                $now = Carbon::now();
                $token_expiry = Carbon::parse($institute->password_reset_token_expiry);

                $is_greater = $now->gt($token_expiry);

                if($is_greater){
                    return redirect('institute/login')->with('error_message', 'Link has been expired');    
                } else {
                    return view('institute.auth.passwords.reset')->with(
                        ['token' => $token]
                    );
                }

            } else {
                return redirect('institute/login')->with('error_message', 'Link has been expired');
            }
            
        } else {
            return redirect('institute/login');
        }
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker('institutes');
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('institute');
    }

    /**
     * function for reset password
     */
    public function reset(Request $request){
        $post = $request->all();

        $messages = [
            'password.required' => 'Please enter password',
            'password.min' => 'Password must be at least 8 characters long'
        ];
        $validator = Validator::make($post, [
            'password' => 'required|min:8|confirmed'
        ], $messages);

        if ($validator->fails()) {
            return redirect('institute/password/reset/'. $post['token'])
                        ->withErrors($validator)
                        ->withInput();
        }

        $institute = Institute::where('password_reset_token', $post['token'])->first();

        if($institute){
            $institute->update([
                'password' => \bcrypt($post['password']),
                'password_reset_token' => null,                
                'password_reset_token_expiry' => null,                
            ]);

            return redirect('/institute/login')->with('message', 'Password has been successfully reset');
        }
    }
}
