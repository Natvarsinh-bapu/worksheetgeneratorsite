<?php

namespace App\Http\Controllers\Institute\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\Institute;
use Validator;
use Mail;
use Carbon\Carbon;
use URL;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    // use SendsPasswordResetEmails;

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
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return view('institute.auth.passwords.email');
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
     * function for send forgot password email
     */
    public function sendResetLinkEmail(Request $request){
        $post = $request->all();

        $messages = [
            'email.required' => 'Please enter email',
            'email.email' => 'Please enter valid email'
        ];
        $validator = Validator::make($post, [
            'email' => 'required|email'
        ], $messages);

        if ($validator->fails()) {
            return redirect('superadmin/password/reset')
                        ->withErrors($validator)
                        ->withInput();
        }

        $institute = Institute::where('email', $post['email'])->first();

        if($institute){
            $token = md5(rand(1, 10) . microtime());
            $token_expiry = Carbon::now()->addHour();

            $icon = URL::to('/') . '/images/reset_password.png';
            $link = URL::to('/institute/password/reset') . '/' . $token;

            $institute->update([
                'password_reset_token' => $token,
                'password_reset_token_expiry' => $token_expiry
            ]);

            $to_email = $institute->email;
            $from_email = env('MAIL_FROM_ADDRESS');
            $from_name = env('MAIL_FROM_NAME');
            $data = [
                'icon' => $icon,
                'user_name' => $institute->name,
                'link' => $link
            ];

            Mail::send('institute.mails.forgot_password_mail', $data, function ($message) use ($to_email, $from_email, $from_name) {
                $message->from($from_email, $from_name);
                $message->to($to_email)->subject('Reset Password');
            });

            return redirect('institute/login')->with('message', "Reset password link has been sent");
        } else {
            return redirect('institute/password/reset')->with('error_message', "User doesn't exist with this email");
        }
    }

}
