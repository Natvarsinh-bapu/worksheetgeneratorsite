<?php

namespace App\Http\Controllers\Superadmin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use Hash;

class ChangePasswordController extends Controller
{
    /**
     * function for change password view
     */
    public function change_password_form(){
        $message = ''; 

        return view('superadmin.auth.passwords.change', compact('message'));
    }

    /**
     * function for update password
     */
    public function change_password(Request $request){
        $post = $request->all();

        $messages = [
            'curr_password.required' => 'Please enter current password',
            'password.required' => 'Please enter password',
            'password.min' => 'The password must be at least 8 characters'
        ];
        $validator = Validator::make($post, [
            'curr_password' => 'required',
            'password' => 'required|min:8|confirmed'
        ], $messages);

        if ($validator->fails()) {
            return redirect('superadmin/change-password')
                        ->withErrors($validator)
                        ->withInput();
        }

        $superadmin = Auth::guard('superadmin')->user();

        if (Hash::check($post['curr_password'], $superadmin->password)) {
            $superadmin->update([
                'password' => \bcrypt($post['password'])
            ]);

            return redirect('superadmin/dashboard')->with('success', 'Password has been changed successfully.');
        } else {
            $message = "Please enter valid current password!";

            return view('superadmin.auth.passwords.change', compact('message'));
        }
    }
}
