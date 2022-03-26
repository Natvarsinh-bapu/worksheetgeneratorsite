<?php

namespace App\Http\Controllers\Institute;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Type;
use Validator;
use Auth;
use DataTables;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('institute.types.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('institute.types.add');
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
            'type.required' => 'Please enter type',
            'type.max' => 'Maximum 50 characters allowed'
        ];
        $validator = Validator::make($post, [
            'type' => 'required|max:50'
        ], $messages);

        if ($validator->fails()) {
            return redirect('institute/types/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $institute = Auth::guard('institute')->user();

        $post['created_by_id'] = $institute->id;
        $post['created_by'] = 'institute';

        $type = Type::create($post)->id;

        if($type){
            return redirect('institute/types')->with('success', 'Type created successfully.');
        } else {
            return redirect('institute/types')->with('error', 'Type not created, Something went wrong.');
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
        $type = Type::findOrFail($id);
        return view('institute.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = Type::findOrFail($id);
        return view('institute.types.edit', compact('type'));
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
            'type.required' => 'Please enter type',
            'type.max' => 'Maximum 50 characters allowed'
        ];
        $validator = Validator::make($post, [
            'type' => 'required|max:50'
        ], $messages);

        if ($validator->fails()) {
            return redirect('institute/types/'. $id .'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $type = Type::findOrFail($id);

        $type->update($post);

        return redirect('institute/types')->with('success', 'Type updated successfully.');
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
        
        $type = Type::findOrFail($post['id']);

        $type->delete();

        return redirect('institute/types')->with('success', 'Type deleted successfully.');
    }

    /**
     * function for datatable 
     */
    public function datatable(){
        $institute = Auth::guard('institute')->user();

        $type = Type::where('status', 1)->where('created_by', 'institute')->where('created_by_id', $institute->id);

        return Datatables::of($type)
        ->addColumn('action', function($type) {
            return '<a class="btn btn-default" href="/institute/types/'.$type->id.'" style="margin-left:5px;"><i class="fa fa-eye"></i></a>'
            .'<a class="btn btn-primary" href="/institute/types/'.$type->id.'/edit" style="margin-left:5px;"><i class="fa fa-edit"></i></a>'
            .'<a data-id="'. $type->id .'" class="btn btn-danger _remove_type" href="javascript:void(0);" style="margin-left:5px;"><i class="fa fa-trash"></i></a>';
        })
        ->rawColumns(['action'])
        ->make();
    }
}
