<?php

namespace App\Http\Controllers\Institute;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ProfileController extends Controller
{
    public function index(){
        $institute = Auth::guard('institute')->user();

        return view('institute.profile.index', compact('institute'));
    }

    public function changeProfilePic(Request $request){
        $post = $request->all();

        if($request->profile != ''){
            $path = 'institute_profile';
            $filename = file_upload($request->profile, $path); //call helper function

            $institute = Auth::guard('institute')->user();

            if($institute->image != null && $institute->image != 'default.png'){
                $file = $path.$institute->image;
                unlink($file);
            }

            $institute->update(['image' => $filename]);
        }

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function updateInstituteDetails(Request $request){
        $post = $request->all();

        $institute = Auth::guard('institute')->user();

        $institute->update([
            'name' => $post['name'],
            'phone' => $post['phone']
        ]);

        return redirect('institute/profile')->with('success', 'Profile updated successfully');
    }
}
