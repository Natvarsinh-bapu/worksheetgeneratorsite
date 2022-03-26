<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Concept;
use Validator;
use Auth;
use DataTables;
use App\SubConcept;
use App\Question;
use App\Category;
use App\Superadmin;

class ConceptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('superadmin.concepts.index');
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

        return view('superadmin.concepts.add', compact('categories'));
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
            'category_id.required' => 'Please select category',
            'concept.required' => 'Please enter concept',
            'concept.max' => 'Maximum 50 characters allowed'
        ];
        $validator = Validator::make($post, [
            'category_id' => 'required',
            'concept' => 'required|max:50'
        ], $messages);

        if ($validator->fails()) {
            return redirect('superadmin/concepts/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $superadmin = Auth::guard('superadmin')->user();

        $post['created_by_id'] = $superadmin->id;
        $post['created_by'] = 'superadmin';

        $category = Concept::create($post);

        if($category){
            return redirect('superadmin/concepts')->with('success', 'Concept created successfully.');
        } else {
            return redirect('superadmin/concepts')->with('error', 'Concept not created, Something went wrong.');
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
        return view('superadmin.concepts.show', compact('concept'));
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
        $concept = Concept::findOrFail($id);

        return view('superadmin.concepts.edit', compact('concept', 'categories'));
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
            'category_id.required' => 'Please select category',
            'concept.required' => 'Please enter concept',
            'concept.max' => 'Maximum 50 characters allowed'
        ];
        $validator = Validator::make($post, [
            'category_id' => 'required',
            'concept' => 'required|max:50'
        ], $messages);

        if ($validator->fails()) {
            return redirect('superadmin/concepts/'. $id .'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $concept = Concept::findOrFail($id);

        $concept->update($post);

        return redirect('superadmin/concepts')->with('success', 'Concept updated successfully.');
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

        return redirect('superadmin/concepts')->with('success', 'Concept deleted successfully.');
    }

    /**
     * function for datatable 
     */
    public function datatable(){
        $superadmin = Auth::guard('superadmin')->user();

        $concepts = Concept::with('category')->where('status', 1)->where('created_by', 'superadmin')->where('created_by_id', $superadmin->id);

        return Datatables::of($concepts)
        ->editColumn('category_id', function($concepts){
            return $concepts->category->category;
        })
        ->addColumn('action', function($concepts) {
            return '<a class="btn btn-default" href="/superadmin/concepts/'.$concepts->id.'" style="margin-left:5px;"><i class="fa fa-eye"></i></a>'
            .'<a class="btn btn-primary" href="/superadmin/concepts/'.$concepts->id.'/edit" style="margin-left:5px;"><i class="fa fa-edit"></i></a>'
            .'<a data-id="'. $concepts->id .'" class="btn btn-danger _remove_concept" href="javascript:void(0);" style="margin-left:5px;"><i class="fa fa-trash"></i></a>';
        })
        ->rawColumns(['action'])
        ->make();
    }

}
