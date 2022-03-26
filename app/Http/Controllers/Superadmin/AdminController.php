<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use DataTables;
use App\Admin;
use App\AdminDetails;
use App\AdminCategoriesAccess;
use App\Category;

class AdminController extends Controller
{
    public function index(){
        return view('superadmin.admins.index');
    }

    public function create(){
        $categories = Category::with('concepts')->get();
                
        return view('superadmin.admins.add', compact('categories'));
    }

    public function store(Request $request){
        $post = $request->all();

        $messages = [
            'name.required' => 'Please enter name',
            'email.required' => 'Please enter email',
            'email.email' => 'Please enter valid email',
            'email.unique' => 'Email already used',
            'password.required' => 'Please enter password',            
            'password.confirmed' => 'Confirm password does not match with password',
            'categories.required' => 'Please select categories'
        ];
        $validator = Validator::make($post, [
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|confirmed',
            'categories' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $post['password'] = \bcrypt($post['password']);
        $post['is_verified'] = 1;
        $post['status'] = 1;
        $post['unique_token'] = generate_random_string();
        $admin = Admin::create($post);

        if($admin){
            AdminDetails::create([
                'admin_id' => $admin->id,
                'image' => 'default.png'
            ]);

            if(!empty($post['categories'])){
                foreach($post['categories'] as $category){
                    AdminCategoriesAccess::create([
                        'admin_id' => $admin->id,
                        'category_id' => $category,
                        'status' => 1
                    ]);
                }
            }
        }

        return redirect('superadmin/admins')->with('success', 'Admin created successfully.');
    }

    public function show($id){

        $admin = Admin::with('details')->find($id);

        return view('superadmin.admins.show', compact('admin'));
    }

    public function destroy(Request $request)
    {
        $post = $request->all();
        
        $admin = Admin::findOrFail($post['id']);

        $admin->delete();

        return redirect('superadmin/admins')->with('success', 'Admin deleted successfully.');
    }
    
    /**
     * function for datatable 
     */
    public function datatable(){
      
        $admins = Admin::latest();

        return Datatables::of($admins)
        ->editColumn('is_verified', function($admins){
            if($admins->is_verified == 1){
                return '<span class="custom-badge-success">YES</span>';
            } else {
                return '<span class="custom-badge-danger">NO</span>';
            }
        })
        ->editColumn('status', function($admins){
            if($admins->status == 0){
                return '<span class="custom-badge-warning">Requested</span>';
            } elseif ($admins->status == 1) {
                return '<span class="custom-badge-success">Active</span>';
            } else {
                return '<span class="custom-badge-danger">Blocked</span>';
            }
        })
        ->addColumn('category_access', function($admins) {
            if($admins->is_verified == 1){
                return '<a class="btn btn-info" href="/superadmin/category-access/'.$admins->id.'" style="margin-left:5px;"><i class="fa fa-shield"></i></a>';
            } else {
                return '<a class="btn btn-info _no_access_category" href="javascript:void(0);" style="margin-left:5px;"><i class="fa fa-shield"></i></a>';
            }            
        })
        ->addColumn('action', function($admins) {
            return '<a class="btn btn-default" href="/superadmin/admins/'.$admins->id.'" style="margin-left:5px;"><i class="fa fa-eye"></i></a>'
            .'<a data-id="'. $admins->id .'" class="btn btn-danger _remove_admin" href="javascript:void(0);" style="margin-left:5px;"><i class="fa fa-trash"></i></a>';
        })
        ->rawColumns(['action', 'status', 'is_verified', 'category_access'])
        ->make(); 
    }

    /**
     * function for change admin status
     */
    public function changeAdminStatus(Request $request){
        $post = $request->all();

        $admin = Admin::find($post['admin_id']);

        if($admin->is_verified == 0){
            return response()->json(['success' => false, 'message' => 'Email is not verified by user']);
        }

        $admin->update(['status' => $post['status']]);
        
        return response()->json(['success' => true, 'message' => 'Admin status has been successfully changed']);
    }

    /**---------------------------------------------------------------------------
     * CODE FOR CATEGORY ACCESS FUNCTIONALITY
     ---------------------------------------------------------------------------*/
    public function categoryAccess($id){

        $categories = Category::where('created_by', 'superadmin')->get();
        $accessable_categories = AdminCategoriesAccess::where('admin_id', $id)->where('status', 1)->pluck('category_id')->toArray();
        $requested_categories = AdminCategoriesAccess::where('admin_id', $id)->pluck('category_id')->toArray();

        return view('superadmin.admins.category_access', compact('categories', 'accessable_categories', 'id', 'requested_categories'));
    }

    //function for change access status
    public function accessCategoryStatus(Request $request){
        $post = $request->all();

        $categorie_access = AdminCategoriesAccess::where('admin_id', $post['admin_id'])->where('category_id', $post['category_id'])->first();

        if($categorie_access){
            
            $categorie_access->update(['status' => $post['status']]);

            return response()->json([
                'success' => true,
                'message' => 'Category access changed successfully'
            ]);
        } else {

            $categorie_access = AdminCategoriesAccess::create([
                'admin_id' => $post['admin_id'],
                'category_id' => $post['category_id'],
                'status' => $post['status']
            ]);

            if($categorie_access){
                return response()->json([
                    'success' => true,
                    'message' => 'Category access changed successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong!'
                ]);
            }
        }
    }
}
