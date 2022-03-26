<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SubConcept;
use App\Concept;
use App\Category;
use App\AdminCategoriesAccess;
use Validator;
use Auth;
use DataTables;

class SubconceptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.subconcepts.index');
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

        return view('admin.subconcepts.add', compact('categories'));
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
            'sub_concept.required' => 'Please enter sub concept',
            'sub_concept.max' => 'Maximum 50 characters allowed',
            'concept_id.required' => 'Please select concept'
        ];
        $validator = Validator::make($post, [
            'sub_concept' => 'required|max:50',
            'concept_id' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return redirect('admin/sub-concepts/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $admin = Auth::guard('admin')->user();

        $post['created_by_id'] = $admin->id;
        $post['created_by'] = 'admin';

        $category = SubConcept::create($post)->id;

        if($category){
            return redirect('admin/sub-concepts')->with('success', 'Sub Concept created successfully.');
        } else {
            return redirect('admin/sub-concepts')->with('error', 'Sub Concept not created, Something went wrong.');
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
        $sub_concept = SubConcept::with('concept')->findOrFail($id);
        return view('admin.subconcepts.show', compact('sub_concept'));
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
        $sub_concept = SubConcept::findOrFail($id);

        return view('admin.subconcepts.edit', compact('sub_concept', 'categories'));
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
            'sub_concept.required' => 'Please enter sub concept',
            'sub_concept.max' => 'Maximum 50 characters allowed',
            'concept_id.required' => 'Please select concept'
        ];
        $validator = Validator::make($post, [
            'sub_concept' => 'required|max:50',
            'concept_id' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return redirect('admin/sub-concepts/'. $id .'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $sub_concept = SubConcept::findOrFail($id);

        $sub_concept->update($post);

        return redirect('admin/sub-concepts')->with('success', 'Sub Concept updated successfully.');
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
        
        $sub_concept = SubConcept::findOrFail($post['id']);

        $sub_concept->delete();

        return redirect('admin/sub-concepts')->with('success', 'Sub Concept deleted successfully.');
    }

    /**
     * function for datatable 
     */
    public function datatable(){
        $admin = Auth::guard('admin')->user();

        $sub_concepts = SubConcept::with('concept', 'category')->where('status', 1)->where('created_by', 'admin')->where('created_by_id', $admin->id);

        return Datatables::of($sub_concepts)
        ->editColumn('concept_id', function($sub_concepts){
            return $sub_concepts->concept->concept;
        })
        ->editColumn('category_id', function($sub_concepts){
            return $sub_concepts->category->category;
        })
        ->addColumn('action', function($sub_concepts) {
            return '<a class="btn btn-default" href="/admin/sub-concepts/'.$sub_concepts->id.'" style="margin-left:5px;"><i class="fa fa-eye"></i></a>'
            .'<a class="btn btn-primary" href="/admin/sub-concepts/'.$sub_concepts->id.'/edit" style="margin-left:5px;"><i class="fa fa-edit"></i></a>'
            .'<a data-id="'. $sub_concepts->id .'" class="btn btn-danger _remove_sub_concept" href="javascript:void(0);" style="margin-left:5px;"><i class="fa fa-trash"></i></a>';
        })
        ->rawColumns(['action', 'concept_id'])
        ->make();
    }

    /**
     * function for get concepts of particular category
     */
    public function concepts(Request $request){
        $post = $request->all();

        $concepts = Concept::where('category_id', $post['category_id'])->where('status', 1)->get();

        if($post['is_for'] == 'edit'){
            $sub_concept = SubConcept::find($post['sub_concept_id']);

            if($sub_concept){
                $selected_concept = $sub_concept->concept_id;
            } else {
                $selected_concept = 0;
            }

            return response()->json(['success' => true, 'concepts' => $concepts, 'selected_concept' => $selected_concept]);
        } else {
            return response()->json(['success' => true, 'concepts' => $concepts]);
        }
    }
}
