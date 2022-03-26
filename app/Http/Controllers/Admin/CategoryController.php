<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Category;
use Auth;
use DataTables;
use App\AdminCategoriesAccess;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = $request->all();
        
        $messages = [
            'category.required' => 'Please enter category',
            'category.max' => 'Maximum 50 characters allowed'
        ];
        $validator = Validator::make($post, [
            'category' => 'required|max:50'
        ], $messages);

        if ($validator->fails()) {
            return redirect('admin/categories/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $admin = Auth::guard('admin')->user();

        $post['created_by_id'] = $admin->id;
        $post['created_by'] = 'admin';

        $category = Category::create($post)->id;

        if($category){
            return redirect('admin/categories')->with('success', 'Category created successfully.');
        } else {
            return redirect('admin/categories')->with('error', 'Category not created, Something went wrong.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = $request->all();
        
        $messages = [
            'category.required' => 'Please enter category',
            'category.max' => 'Maximum 50 characters allowed'
        ];
        $validator = Validator::make($post, [
            'category' => 'required|max:50'
        ], $messages);

        if ($validator->fails()) {
            return redirect('admin/categories/'. $id .'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $category = Category::findOrFail($id);

        $category->update($post);

        return redirect('admin/categories')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $post = $request->all();
        
        $category = Category::findOrFail($post['id']);

        $category->delete();

        return redirect('admin/categories')->with('success', 'Category deleted successfully.');
    }

    /**
     * function for datatable 
     */
    public function datatable(){
        $admin = Auth::guard('admin')->user();

        $accessable_categories_ids = AdminCategoriesAccess::where('admin_id', $admin->id)->where('status', 1)->pluck('category_id')->toArray();
        $categories = Category::where('status', 1)->where('created_by', 'admin')->where('created_by_id', $admin->id);

        return Datatables::of($categories)
            ->addColumn('action', function($categories) {
                if($categories->created_by == 'superadmin'){
                    return '<a class="btn btn-default" href="/admin/categories/'.$categories->id.'" style="margin-left:5px;"><i class="fa fa-eye"></i></a>';
                    // .'<a class="btn btn-primary" href="javascript:void(0);" style="margin-left:5px; cursor: not-allowed;"><i class="fa fa-edit"></i></a>'
                    // .'<a class="btn btn-danger" href="javascript:void(0);" style="margin-left:5px; cursor: not-allowed;"><i class="fa fa-trash"></i></a>';
                } else {
                    return '<a class="btn btn-default" href="/admin/categories/'.$categories->id.'" style="margin-left:5px;"><i class="fa fa-eye"></i></a>'
                    .'<a class="btn btn-primary" href="/admin/categories/'.$categories->id.'/edit" style="margin-left:5px;"><i class="fa fa-edit"></i></a>'
                    .'<a data-id="'. $categories->id .'" class="btn btn-danger _remove_category" href="javascript:void(0);" style="margin-left:5px;"><i class="fa fa-trash"></i></a>';
                }
            })
            ->rawColumns(['action'])
            ->make();
    }
}
