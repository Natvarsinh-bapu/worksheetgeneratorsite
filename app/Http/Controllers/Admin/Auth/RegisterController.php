<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Admin;
use App\AdminDetails;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mail;
use URL;
use DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new admins as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    //use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('admin.guest:admin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Admin
     */
    protected function create(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('admin.auth.register');
    }

    /**
     * function for register admin
     */
    public function register(Request $request){
        $post = $request->all();

        $messages = [
            'name.required' => 'Please enter name',
            'name.string' => 'Please enter characters only',
            'name.max' => 'Maximum 255 characters allowed',
            'email.required' => 'Please enter email',
            'email.email' => 'Please enter valid email',
            'email.max' => 'Maximum 255 characters allowed',
            'email.unique' => 'User already exist with this email',
            'password.required' => 'Please enter password',
            'password.min' => 'Password must be at least 8 characters long',
            'password.confirmed' => 'Confirm password does not match with password',
        ];
        $validator = Validator::make($post, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed'
        ], $messages);

        if ($validator->fails()) {
            return redirect('admin/register')
                        ->withErrors($validator)
                        ->withInput();
        }

        DB::beginTransaction();
        try{
            $token = md5(rand(1, 10) . microtime());

            $admin = Admin::create([
                'name' => ucfirst($post['name']),
                'email' => $post['email'],
                'password' => Hash::make($post['password']),
                'verification_token' => $token   
            ]);

            if($admin){
                AdminDetails::create([
                    'admin_id' => $admin->id
                ]);

                $icon = URL::to('/') . '/images/mail_logo.png';
                $link = URL::to('/') . '/admin/verification/' . $token;
                $to_email = $admin->email;
                $from_email = env('MAIL_FROM_ADDRESS');
                $from_name = env('MAIL_FROM_NAME');
                $data = [
                    'icon' => $icon,
                    'user_name' => $admin->name,
                    'link' => $link
                ];

                Mail::send('admin.mails.verification_mail', $data, function ($message) use ($to_email, $from_email, $from_name) {
                    $message->from($from_email, $from_name);
                    $message->to($to_email)->subject('Worksheet Generator Verification');
                });

                DB::commit();

                return redirect('/admin/login')->with('message', 'Verification link has been send to your email');
            }
        } catch(\Exception $e){
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

}
