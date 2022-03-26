<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use App\Admin;
use App\AdminDetails;
use App\Category;
use App\AdminCategoriesAccess;
use Validator;
use DB;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be resent if the user did not receive the original email message.
    |
    */

    // use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('admin.auth');
    //     $this->middleware('signed')->only('admin.verify');
    //     $this->middleware('throttle:6,1')->only('admin.verify', 'resend');
    // }

    /**
     * Show the email verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return $request->user('admin')->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('admin.auth.verify');
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request)
    {
        if ($request->route('id') == $request->user('admin')->getKey()) {
            $request->user('admin')->markEmailAsVerified();
        }

        return redirect($this->redirectPath());
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        $request->user('admin')->sendEmailVerificationNotification();

        return back()->with('resent', true);
    }

    /**
     * function for verify the admin
     */
    public function verifyAdmin($token){
        
        $admin = Admin::where('verification_token', $token)->first();

        if($admin){
            if($admin->is_verified == 0){

                $categories = Category::where('created_by', 'superadmin')->where('status', 1)->get();

                return view('admin.auth.verify_request_categories', compact('admin', 'categories'));
            } else {
                return redirect('admin/login')->with('error_message', 'Already verified!');
            }
        } else {
            return redirect('admin/login')->with('error_message', 'Invalid link');
        }
    }

    /**
     * function for request categories
     */
    public function requestCategories(Request $request){
        $post = $request->all();

        $messages = [
            'categories.required' => 'Please select categories',
            'no_of_institutes.required' => 'Please enter No. of Institutes'
        ];
        $validator = Validator::make($post, [
            'categories' => 'required',
            'no_of_institutes' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $admin = Admin::find($post['admin_id']);

        try{    
            DB::beginTransaction();

            if($admin && !empty($post['categories'])){
                foreach($post['categories'] as $category){
                    AdminCategoriesAccess::create([
                        'admin_id' => $admin->id,
                        'category_id' => $category
                    ]);
                }

                AdminDetails::where('admin_id', $admin->id)->update(['no_of_institutes' => $post['no_of_institutes']]);

                $admin->update([
                    'verification_token' => null,
                    'is_verified' => 1
                ]);

                DB::commit();
                return redirect('admin/login')->with('message', 'Request has been successfully send, Your account activated within 3 days');
            }
        } catch(\Exception $e){
            DB::rollBack();
            return redirect('admin/login')->with('error_message', 'Something went wrong!');
        }
    }
}
