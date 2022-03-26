<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Admin;
use App\AdminDetails;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(){
        $admin = Auth::guard('admin')->user();

        return view('admin.profile.index', compact('admin'));
    }

    public function changeProfilePic(Request $request){
        $post = $request->all();

        if($request->profile != ''){
            $path = 'admin_profile';
            $filename = file_upload($request->profile, $path); //call helper function

            $admin = Auth::guard('admin')->user();

            $admin_details = AdminDetails::where('admin_id', $admin->id)->first();
            
            $file = 'admin_profile/'.$admin_details->image;
            $is_exist = Storage::disk('public')->has($file);
            if($is_exist){
                Storage::disk('public')->delete($file);
            }

            $admin_details->update(['image' => $filename]);
        }

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function updateAdminDetails(Request $request){
        $post = $request->all();

        $admin = Auth::guard('admin')->user();

        $admin->update(['name' => $post['name']]);

        AdminDetails::where('admin_id', $admin->id)->update(['phone' => $post['phone']]);

        return redirect('admin/profile')->with('success', 'Profile updated successfully');
    }
}
