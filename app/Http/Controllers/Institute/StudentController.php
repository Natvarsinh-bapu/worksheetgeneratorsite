<?php

namespace App\Http\Controllers\Institute;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\User;
use App\ClassName;
use Auth;
use DataTables;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('institute.student.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $institute = Auth::guard('institute')->user();
        $classes = ClassName::where('institute_id', $institute->id)->pluck('name', 'id');

        return view('institute.student.add', compact('classes'));
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

        if(isset($post['enrollment_no']) && $post['enrollment_no'] != null){
            $post['enrollment_no'] = $institute->id . '_' . $post['enrollment_no'];
        }
        
        $messages = [
            'name.required' => 'Please enter name',
            'enrollment_no.required' => 'Please enter enrollment number',
            'enrollment_no.unique' => 'Enrollment number is already exits',
            'email.required' => 'Please enter email',
            'email.email' => 'Please enter valid email',
            'email.unique' => 'Email already used',
            'password.required' => 'Please enter password',
            'password.confirmed' => 'Confirm password does not match with password'
        ];
        $validator = Validator::make($post, [
            'name' => 'required',
            'enrollment_no' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ], $messages);

        if ($validator->fails()) {
            return redirect('institute/students/create')
                        ->withErrors($validator)
                        ->withInput();
        }        

        $post['institute_id'] = $institute->id;
        $post['password'] = \bcrypt($post['password']);

        $student = User::create($post);

        if($student){
            return redirect('institute/students')->with('success', 'Student created successfully.');
        } else {
            return redirect('institute/students')->with('error', 'Student not created, Something went wrong.');
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
        $student = User::with('className')->findOrFail($id);
        return view('institute.student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $institute = Auth::guard('institute')->user();
        $classes = ClassName::where('institute_id', $institute->id)->pluck('name', 'id');        
        $student = User::findOrFail($id);

        return view('institute.student.edit', compact('student', 'classes'));
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

        $student = User::findOrFail($id);

        if(isset($post['enrollment_no']) && $post['enrollment_no'] != null){
            $post['enrollment_no'] = $student->institute_id . '_' . $post['enrollment_no'];
        }

        $rules = [
            'name' => 'required',
            'enrollment_no' => [
                'required',
                Rule::unique('users')->ignore($student->id)
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($student->id),
            ]
        ];
        if(isset($post['password']) && $post['password'] != null){
            $rules['password'] = 'required|confirmed';
        }
        
        $messages = [
            'name.required' => 'Please enter name',
            'enrollment_no.required' => 'Please enter enrollment number',
            'enrollment_no.unique' => 'Enrollment number is already exits',
            'email.required' => 'Please enter email',
            'email.email' => 'Please enter valid email',
            'email.unique' => 'Email already used',
            'password.required' => 'Please enter password',
            'password.confirmed' => 'Confirm password does not match with password'
        ];
        $validator = Validator::make($post, $rules, $messages);

        if ($validator->fails()) {
            return redirect('institute/students/'. $id .'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        if(isset($post['password']) && $post['password'] != null){
            $post['password'] = \bcrypt($post['password']);
        } else {
            unset($post['password']);
        }        

        $student->update($post);

        return redirect('institute/students')->with('success', 'Student updated successfully.');
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
        
        $student = User::findOrFail($post['id']);

        $student->delete();

        return redirect('institute/students')->with('success', 'Student deleted successfully.');
    }

    /**
     * function for datatable 
     */
    public function datatable(){
        $institute = Auth::guard('institute')->user();

        $students = User::with('className')->where('institute_id', $institute->id)->where('role', 'student');

        return Datatables::of($students)
        ->editColumn('enrollment_no', function($students){
            $data = explode('_', $students->enrollment_no);
            $en_no = isset($data[1]) ? $data[1] : $data[0];
            return $en_no;
        })
        ->editColumn('class', function($students){
            return $students->className ? $students->className->name : '';
        })
        ->addColumn('action', function($students) {
            return '<a class="btn btn-default" href="/institute/students/'.$students->id.'" style="margin-left:5px;"><i class="fa fa-eye"></i></a>'
            .'<a class="btn btn-primary" href="/institute/students/'.$students->id.'/edit" style="margin-left:5px;"><i class="fa fa-edit"></i></a>'
            .'<a data-id="'. $students->id .'" class="btn btn-danger _remove_student" href="javascript:void(0);" style="margin-left:5px;"><i class="fa fa-trash"></i></a>';
        })
        ->rawColumns(['action'])
        ->make();
    }
}
