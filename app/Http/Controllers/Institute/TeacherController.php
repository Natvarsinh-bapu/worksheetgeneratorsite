<?php

namespace App\Http\Controllers\Institute;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\User;
use App\ClassName;
use App\ClassTeacher;
use Auth;
use DataTables;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('institute.teacher.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $institute = Auth::guard('institute')->user();

        $teachers_count = User::teacher()->where('institute_id', $institute->id)->count();
        if($teachers_count >= $institute->no_of_teacher){
            return redirect()->back()->with('error', 'You can add only ' . $institute->no_of_teacher . ' teachers');
        }
        
        
        $classes = ClassName::where('institute_id', $institute->id)->pluck('name', 'id');

        return view('institute.teacher.add', compact('classes'));
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
            'name.required' => 'Please enter name',
            'phone.required' => 'Please enter phone',
            'email.required' => 'Please enter email',
            'email.email' => 'Please enter valid email',
            'email.unique' => 'Email already used',
            'password.required' => 'Please enter password',
            'password.confirmed' => 'Confirm password does not match with password'
        ];
        $validator = Validator::make($post, [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ], $messages);

        if ($validator->fails()) {
            return redirect('institute/teachers/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $institute = Auth::guard('institute')->user();

        $post['institute_id'] = $institute->id;
        $post['password'] = \bcrypt($post['password']);
        $post['role'] = 'teacher';

        $teacher = User::create($post);

        if($teacher){
            if(isset($post['classes']) && !empty($post['classes'])){
                foreach ($post['classes'] as $tclass) {
                    ClassTeacher::create([
                        'class_id' => $tclass,
                        'teacher_id' => $teacher->id
                    ]);
                }
            }

            return redirect('institute/teachers')->with('success', 'Teacher created successfully.');
        } else {
            return redirect('institute/teachers')->with('error', 'Teacher not created, Something went wrong.');
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
        $teacher = User::findOrFail($id);
        $classes = ClassTeacher::with('classname')->where('teacher_id', $teacher->id)->get();
        return view('institute.teacher.show', compact('teacher', 'classes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher = User::findOrFail($id);
        $institute = Auth::guard('institute')->user();
        $classes = ClassName::where('institute_id', $institute->id)->pluck('name', 'id');
        $selected_classes = ClassTeacher::where('teacher_id', $teacher->id)->pluck('class_id')->toArray();

        return view('institute.teacher.edit', compact('teacher', 'classes', 'selected_classes'));
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

        $teacher = User::findOrFail($id);

        $rules = [
            'name' => 'required',
            'phone' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($teacher->id),
            ]
        ];

        if(isset($post['password']) && $post['password'] != null){
            $rules['password'] = 'required|confirmed';
        }
        
        $messages = [
            'name.required' => 'Please enter name',
            'phone.required' => 'Please enter phone',
            'email.required' => 'Please enter email',
            'email.email' => 'Please enter valid email',
            'email.unique' => 'Email already used',
            'password.required' => 'Please enter password',
            'password.confirmed' => 'Confirm password does not match with password'
        ];
        $validator = Validator::make($post, $rules, $messages);

        if ($validator->fails()) {
            return redirect('institute/teachers/'. $id .'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        if(isset($post['password']) && $post['password'] != null){
            $post['password'] = \bcrypt($post['password']);
        } else {
            unset($post['password']);
        }        

        $teacher->update($post);

        $teacher->teacherClasses()->delete();
        if(isset($post['classes']) && !empty($post['classes'])){
            foreach ($post['classes'] as $tclass) {
                ClassTeacher::create([
                    'class_id' => $tclass,
                    'teacher_id' => $teacher->id
                ]);
            }
        }

        return redirect('institute/teachers')->with('success', 'Teacher updated successfully.');
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
        
        $teacher = User::findOrFail($post['id']);

        $teacher->delete();

        return redirect('institute/teachers')->with('success', 'Teacher deleted successfully.');
    }

    /**
     * function for datatable 
     */
    public function datatable(){
        $institute = Auth::guard('institute')->user();

        $teachers = User::where('institute_id', $institute->id)->where('role', 'teacher');

        return Datatables::of($teachers)
        ->addColumn('action', function($teachers) {
            return '<a class="btn btn-default" href="/institute/teachers/'.$teachers->id.'" style="margin-left:5px;"><i class="fa fa-eye"></i></a>'
            .'<a class="btn btn-primary" href="/institute/teachers/'.$teachers->id.'/edit" style="margin-left:5px;"><i class="fa fa-edit"></i></a>'
            .'<a data-id="'. $teachers->id .'" class="btn btn-danger _remove_teacher" href="javascript:void(0);" style="margin-left:5px;"><i class="fa fa-trash"></i></a>';
        })
        ->rawColumns(['action'])
        ->make();
    }
}
