<?php

namespace App\Http\Controllers\Institute;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\ClassName;
use Auth;
use DataTables;
use Illuminate\Validation\Rule;
use App\User;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('institute.class.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('institute.class.add');
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

        $institute = Auth::guard('institute')->user();

        $is_exist = ClassName::where('institute_id', $institute->id)->where('name', $post['name'])->count();
        if($is_exist > 0){
            return redirect()->back()->with('error', 'Class already exist with this name');
        }
        
        $messages = [
            'name.required' => 'Please enter class name',
            'name.max' => 'Maximum 50 characters allowed'
        ];
        $validator = Validator::make($post, [
            'name' => 'required|max:50'
        ], $messages);

        if ($validator->fails()) {
            return redirect('institute/class/create')
                        ->withErrors($validator)
                        ->withInput();
        }        

        $post['institute_id'] = $institute->id;

        $class_data = ClassName::create($post);

        if($class_data){
            return redirect('institute/class')->with('success', 'Class created successfully.');
        } else {
            return redirect('institute/class')->with('error', 'Class not created, Something went wrong.');
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
        $class_data = ClassName::with('classTeachers')->findOrFail($id);

        return view('institute.class.show', compact('class_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $class_data = ClassName::findOrFail($id);
        return view('institute.class.edit', compact('class_data'));
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

        $institute = Auth::guard('institute')->user();
        
        $is_exist = ClassName::where('institute_id', $institute->id)->where('id', '!=', $id)->where('name', $post['name'])->count();
        if($is_exist > 0){
            return redirect()->back()->with('error', 'Class already exist with this name');
        }
        
        $messages = [
            'name.required' => 'Please enter class name',
            'name.max' => 'Maximum 50 characters allowed'
        ];
        $validator = Validator::make($post, [
            'name' => [
                'required'
            ],
        ], $messages);

        if ($validator->fails()) {
            return redirect('institute/class/'. $id .'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $class_data = ClassName::findOrFail($id);

        $class_data->update($post);

        return redirect('institute/class')->with('success', 'Class updated successfully.');
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

        $students = User::where('class', $post['id'])->count();
        if($students > 0){
            return redirect('institute/class')->with('error', 'Student exist with this class.');
        }
        
        $class_data = ClassName::findOrFail($post['id']);

        $class_data->delete();

        return redirect('institute/class')->with('success', 'Class deleted successfully.');
    }

    /**
     * function for datatable 
     */
    public function datatable(){
        $institute = Auth::guard('institute')->user();

        $class_data = ClassName::where('status', 1)->where('institute_id', $institute->id);

        return Datatables::of($class_data)
        ->addColumn('action', function($class_data) {
            return '<a class="btn btn-default" href="/institute/class/'.$class_data->id.'" style="margin-left:5px;"><i class="fa fa-eye"></i></a>'
            .'<a class="btn btn-primary" href="/institute/class/'.$class_data->id.'/edit" style="margin-left:5px;"><i class="fa fa-edit"></i></a>'
            .'<a data-id="'. $class_data->id .'" class="btn btn-danger _remove_class" href="javascript:void(0);" style="margin-left:5px;"><i class="fa fa-trash"></i></a>';
        })
        ->rawColumns(['action'])
        ->make();
    }
}
