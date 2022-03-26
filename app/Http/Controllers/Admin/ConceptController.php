<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Concept;
use Validator;
use Auth;
use DataTables;
use App\SubConcept;
use App\Question;
use App\Category;
use App\AdminCategoriesAccess;

class ConceptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.concepts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin = Auth::guard('admin')->user();

        $accessable_categories_ids = AdminCategoriesAccess::where('admin_id', $admin->id)->where('status', 1)->pluck('category_id')->toArray();
        $categories = Category::where('status', 1)->where('created_by', 'admin')->where('created_by_id', $admin->id)->orWhereIn('id', $accessable_categories_ids)->pluck('category', 'id');

        return view('admin.concepts.add', compact('categories'));
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
            'concept.required' => 'Please enter concept',
            'concept.max' => 'Maximum 50 characters allowed'
        ];
        $validator = Validator::make($post, [
            'concept' => 'required|max:50'
        ], $messages);

        if ($validator->fails()) {
            return redirect('admin/concepts/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $admin = Auth::guard('admin')->user();

        $post['created_by_id'] = $admin->id;
        $post['created_by'] = 'admin';

        $category = Concept::create($post)->id;

        if($category){
            return redirect('admin/concepts')->with('success', 'Concept created successfully.');
        } else {
            return redirect('admin/concepts')->with('error', 'Concept not created, Something went wrong.');
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
        $concept = Concept::with('category')->findOrFail($id);
        return view('admin.concepts.show', compact('concept'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Auth::guard('admin')->user();

        $accessable_categories_ids = AdminCategoriesAccess::where('admin_id', $admin->id)->where('status', 1)->pluck('category_id')->toArray();
        $categories = Category::where('status', 1)->where('created_by', 'admin')->where('created_by_id', $admin->id)->orWhereIn('id', $accessable_categories_ids)->pluck('category', 'id');
        $concept = Concept::findOrFail($id);
        return view('admin.concepts.edit', compact('concept', 'categories'));
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
            'concept.required' => 'Please enter concept',
            'concept.max' => 'Maximum 50 characters allowed'
        ];
        $validator = Validator::make($post, [
            'concept' => 'required|max:50'
        ], $messages);

        if ($validator->fails()) {
            return redirect('admin/concepts/'. $id .'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $concept = Concept::findOrFail($id);

        $concept->update($post);

        return redirect('admin/concepts')->with('success', 'Concept updated successfully.');
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
        
        $concept = Concept::findOrFail($post['id']);

        $concept->delete();

        return redirect('admin/concepts')->with('success', 'Concept deleted successfully.');
    }

    /**
     * function for datatable 
     */
    public function datatable(){
        $admin = Auth::guard('admin')->user();

        $concepts = Concept::with('category')->where('status', 1)->where('created_by', 'admin')->where('created_by_id', $admin->id);

        return Datatables::of($concepts)
        ->editColumn('category_id', function($concepts){
            return $concepts->category->category;
        })
        ->addColumn('action', function($concepts) {
            return '<a class="btn btn-default" href="/admin/concepts/'.$concepts->id.'" style="margin-left:5px;"><i class="fa fa-eye"></i></a>'
            .'<a class="btn btn-primary" href="/admin/concepts/'.$concepts->id.'/edit" style="margin-left:5px;"><i class="fa fa-edit"></i></a>'
            .'<a data-id="'. $concepts->id .'" class="btn btn-danger _remove_concept" href="javascript:void(0);" style="margin-left:5px;"><i class="fa fa-trash"></i></a>';
        })
        ->rawColumns(['action'])
        ->make();
    }
}
