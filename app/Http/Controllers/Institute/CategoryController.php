<?php

namespace App\Http\Controllers\Institute;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Category;
use Auth;
use DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('institute.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('institute.categories.add');
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
            return redirect('institute/categories/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $institute = Auth::guard('institute')->user();

        $post['created_by_id'] = $institute->id;
        $post['created_by'] = 'institute';

        $category = Category::create($post)->id;

        if($category){
            return redirect('institute/categories')->with('success', 'Category created successfully.');
        } else {
            return redirect('institute/categories')->with('error', 'Category not created, Something went wrong.');
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
        return view('institute.categories.show', compact('category'));
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
        return view('institute.categories.edit', compact('category'));
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
            return redirect('institute/categories/'. $id .'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $category = Category::findOrFail($id);

        $category->update($post);

        return redirect('institute/categories')->with('success', 'Category updated successfully.');
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

        return redirect('institute/categories')->with('success', 'Category deleted successfully.');
    }

    /**
     * function for datatable 
     */
    public function datatable(){
        $institute = Auth::guard('institute')->user();

        $categories = Category::where('status', 1)->where('created_by', 'institute')->where('created_by_id', $institute->id);

        return Datatables::of($categories)
        ->addColumn('action', function($categories) {
            return '<a class="btn btn-default" href="/institute/categories/'.$categories->id.'" style="margin-left:5px;"><i class="fa fa-eye"></i></a>'
            .'<a class="btn btn-primary" href="/institute/categories/'.$categories->id.'/edit" style="margin-left:5px;"><i class="fa fa-edit"></i></a>'
            .'<a data-id="'. $categories->id .'" class="btn btn-danger _remove_category" href="javascript:void(0);" style="margin-left:5px;"><i class="fa fa-trash"></i></a>';
        })
        ->rawColumns(['action'])
        ->make();
    }
}
