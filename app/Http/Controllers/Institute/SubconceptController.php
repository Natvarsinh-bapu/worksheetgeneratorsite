<?php

namespace App\Http\Controllers\Institute;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SubConcept;
use App\Concept;
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
        return view('institute.subconcepts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $concepts = Concept::where('status', 1)->pluck('concept', 'id');

        return view('institute.subconcepts.add', compact('concepts'));
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
            return redirect('institute/sub-concepts/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $institute = Auth::guard('institute')->user();

        $post['created_by_id'] = $institute->id;
        $post['created_by'] = 'institute';

        $category = SubConcept::create($post)->id;

        if($category){
            return redirect('institute/sub-concepts')->with('success', 'Sub Concept created successfully.');
        } else {
            return redirect('institute/sub-concepts')->with('error', 'Sub Concept not created, Something went wrong.');
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
        return view('institute.subconcepts.show', compact('sub_concept'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $concepts = Concept::where('status', 1)->pluck('concept', 'id');

        $sub_concept = SubConcept::findOrFail($id);
        return view('institute.subconcepts.edit', compact('sub_concept', 'concepts'));
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
            return redirect('institute/sub-concepts/'. $id .'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $sub_concept = SubConcept::findOrFail($id);

        $sub_concept->update($post);

        return redirect('institute/sub-concepts')->with('success', 'Sub Concept updated successfully.');
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

        return redirect('institute/sub-concepts')->with('success', 'Sub Concept deleted successfully.');
    }

    /**
     * function for datatable 
     */
    public function datatable(){
        $institute = Auth::guard('institute')->user();

        $sub_concepts = SubConcept::with('concept')->where('status', 1)->where('created_by', 'institute')->where('created_by_id', $institute->id);

        return Datatables::of($sub_concepts)
        ->editColumn('concept_id', function($sub_concepts){
            return $sub_concepts->concept->concept;
        })
        ->addColumn('action', function($sub_concepts) {
            return '<a class="btn btn-default" href="/institute/sub-concepts/'.$sub_concepts->id.'" style="margin-left:5px;"><i class="fa fa-eye"></i></a>'
            .'<a class="btn btn-primary" href="/institute/sub-concepts/'.$sub_concepts->id.'/edit" style="margin-left:5px;"><i class="fa fa-edit"></i></a>'
            .'<a data-id="'. $sub_concepts->id .'" class="btn btn-danger _remove_sub_concept" href="javascript:void(0);" style="margin-left:5px;"><i class="fa fa-trash"></i></a>';
        })
        ->rawColumns(['action', 'concept_id'])
        ->make();
    }
}
