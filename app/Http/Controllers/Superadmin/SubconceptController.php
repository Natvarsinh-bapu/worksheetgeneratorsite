<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SubConcept;
use App\Concept;
use App\Category;
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
        return view('superadmin.subconcepts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $superadmin = Auth::guard('superadmin')->user();

        $categories = Category::where('created_by', 'superadmin')->where('created_by_id', $superadmin->id)->where('status', 1)->pluck('category', 'id');

        return view('superadmin.subconcepts.add', compact('categories'));
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
            return redirect('superadmin/sub-concepts/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $superadmin = Auth::guard('superadmin')->user();

        $post['created_by_id'] = $superadmin->id;
        $post['created_by'] = 'superadmin';

        $category = SubConcept::create($post)->id;

        if($category){
            return redirect('superadmin/sub-concepts')->with('success', 'Sub Concept created successfully.');
        } else {
            return redirect('superadmin/sub-concepts')->with('error', 'Sub Concept not created, Something went wrong.');
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
        $sub_concept = SubConcept::with('concept', 'category')->findOrFail($id);
        return view('superadmin.subconcepts.show', compact('sub_concept'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $superadmin = Auth::guard('superadmin')->user();

        $categories = Category::where('created_by', 'superadmin')->where('created_by_id', $superadmin->id)->where('status', 1)->pluck('category', 'id');
       
        $sub_concept = SubConcept::findOrFail($id);
        return view('superadmin.subconcepts.edit', compact('sub_concept', 'categories'));
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
            return redirect('superadmin/sub-concepts/'. $id .'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $sub_concept = SubConcept::findOrFail($id);

        $sub_concept->update($post);

        return redirect('superadmin/sub-concepts')->with('success', 'Sub Concept updated successfully.');
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

        return redirect('superadmin/sub-concepts')->with('success', 'Sub Concept deleted successfully.');
    }

    /**
     * function for datatable 
     */
    public function datatable(){
        $superadmin = Auth::guard('superadmin')->user();

        $sub_concepts = SubConcept::with('concept', 'category')->where('status', 1)->where('created_by', 'superadmin')->where('created_by_id', $superadmin->id);

        return Datatables::of($sub_concepts)
        ->editColumn('concept_id', function($sub_concepts){
            return $sub_concepts->concept->concept;
        })
        ->editColumn('category_id', function($sub_concepts){
            return $sub_concepts->category->category;
        })
        ->addColumn('action', function($sub_concepts) {
            return '<a class="btn btn-default" href="/superadmin/sub-concepts/'.$sub_concepts->id.'" style="margin-left:5px;"><i class="fa fa-eye"></i></a>'
            .'<a class="btn btn-primary" href="/superadmin/sub-concepts/'.$sub_concepts->id.'/edit" style="margin-left:5px;"><i class="fa fa-edit"></i></a>'
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
