<?php

namespace App\Http\Controllers\Institute;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Concept;
use Validator;
use Auth;
use DataTables;
use App\SubConcept;
use App\Question;

class ConceptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('institute.concepts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('institute.concepts.add');
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
            return redirect('institute/concepts/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $institute = Auth::guard('institute')->user();

        $post['created_by_id'] = $institute->id;
        $post['created_by'] = 'institute';

        $category = Concept::create($post)->id;

        if($category){
            return redirect('institute/concepts')->with('success', 'Concept created successfully.');
        } else {
            return redirect('institute/concepts')->with('error', 'Concept not created, Something went wrong.');
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
        $concept = Concept::findOrFail($id);
        return view('institute.concepts.show', compact('concept'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $concept = Concept::findOrFail($id);
        return view('institute.concepts.edit', compact('concept'));
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
            return redirect('institute/concepts/'. $id .'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $concept = Concept::findOrFail($id);

        $concept->update($post);

        return redirect('institute/concepts')->with('success', 'Concept updated successfully.');
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

        return redirect('institute/concepts')->with('success', 'Concept deleted successfully.');
    }

    /**
     * function for datatable 
     */
    public function datatable(){
        $institute = Auth::guard('institute')->user();

        $concepts = Concept::where('status', 1)->where('created_by', 'institute')->where('created_by_id', $institute->id);

        return Datatables::of($concepts)
        ->addColumn('action', function($concepts) {
            return '<a class="btn btn-default" href="/institute/concepts/'.$concepts->id.'" style="margin-left:5px;"><i class="fa fa-eye"></i></a>'
            .'<a class="btn btn-primary" href="/institute/concepts/'.$concepts->id.'/edit" style="margin-left:5px;"><i class="fa fa-edit"></i></a>'
            .'<a data-id="'. $concepts->id .'" class="btn btn-danger _remove_concept" href="javascript:void(0);" style="margin-left:5px;"><i class="fa fa-trash"></i></a>';
        })
        ->rawColumns(['action'])
        ->make();
    }
    
}
