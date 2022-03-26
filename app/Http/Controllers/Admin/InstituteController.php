<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use DataTables;
use App\Admin;
use App\Institute;

class InstituteController extends Controller
{
    public function index(){
        return view('admin.institute.index');
    }

    public function create(){
        return view('admin.institute.add');
    }

    public function store(Request $request){
        $admin = Auth::user();

        $post = $request->all();

        $messages = [
            'name.required' => 'Please enter name',
            'email.required' => 'Please enter email',
            'email.email' => 'Please enter valid email',
            'email.unique' => 'Email already used',
            'password.required' => 'Please enter password',            
            'password.confirmed' => 'Confirm password does not match with password'            
        ];
        $validator = Validator::make($post, [
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|confirmed'
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $post['password'] = \bcrypt($post['password']);
        $post['is_verified'] = 1;
        $post['status'] = 1;        
        $post['admin_id'] = $admin->id;

        Institute::create($post);

        return redirect('admin/institutes')->with('success', 'Institute created successfully.');
    }

    public function show($id){
        $institute = Institute::find($id);

        return view('admin.institute.show', compact('institute'));
    }

    public function edit($id){
        return view('admin.institute.edit');
    }

    public function update(Request $request, $id){
        
    }

    public function destroy(Request $request){
        $post = $request->all();
        $institute = Institute::findOrFail($post['id']);

        $institute->delete();

        return redirect('admin/institutes')->with('success', 'Institute deleted successfully.');
    }

    public function datatable(){
        $admin = Auth::guard('admin')->user();

        $institutes = Institute::where('admin_id', $admin->id);

        return Datatables::of($institutes)
            ->addColumn('action', function($institutes) {
                    return '<a class="btn btn-default" href="/admin/institutes/'.$institutes->id.'" style="margin-left:5px;"><i class="fa fa-eye"></i></a>'                    
                    .'<a data-id="'. $institutes->id .'" class="btn btn-danger _remove_institute" href="javascript:void(0);" style="margin-left:5px;"><i class="fa fa-trash"></i></a>';                
            })
            ->rawColumns(['action'])
            ->make();
    }
}
