<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\ClassName;
use App\HtmlWorksheet;
use App\AssignedWorksheets;
use App\User;
use DB;

class WorksheetController extends Controller
{
    //list
    public function index(){
        $user = Auth::user();

        $worksheets = HtmlWorksheet::where('created_by', 'institute')->where('created_by_id', $user->institute_id)->paginate(6);

        return view('user.teacher.worksheet.index', compact('worksheets'));
    }

    //students by class
    public function studentsByClass($class_id){
        $user = Auth::user();

        $students = User::student()->where('institute_id', $user->institute_id)->where('class', $class_id)->get();

        $html = view('user.teacher.string_views.student_list', compact('students'))->render();

        return response()->json([
            'success' => true,
            'html' => $html
        ]);
    }

    //assign worksheets
    public function assignToStudents(Request $request){
        $post = $request->all();

        $user = Auth::user();
        
        DB::beginTransaction();
        try {
            if(!empty($post['selected_students'])){
                foreach ($post['selected_students'] as $student) {                            
                    foreach ($post['worskheets'] as $worskheet) {
                        AssignedWorksheets::create([
                            'teacher_id' => $user->id,
                            'student_id' => $student,
                            'worksheet_id' => $worskheet
                        ]);
                    }
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Worksheets assigned'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    //assigned worksheets
    public function assignedWorksheets($class_id){
        $classdata = ClassName::findOrFail($class_id);

        $assigned_worksheets = AssignedWorksheets::with('student')
                ->whereHas('student', function ($query) use ($class_id){
                    $query->where('class', $class_id);
                })
                ->where('teacher_id', Auth::id())
                ->select('student_id', DB::raw('count(*) as total'))
                ->groupBy('student_id')
                ->paginate(10);

        return view('user.teacher.worksheet.assigned_worksheets', compact('assigned_worksheets', 'classdata'));
    }

    //worksheet list of student
    public function studentWorksheets($student_id){
        $user = User::find($student_id);

        $worksheets = AssignedWorksheets::where('student_id', $student_id)
                ->where('teacher_id', Auth::id())
                ->latest()
                ->paginate(9);

        return view('user.teacher.worksheet.student_worksheets', compact('worksheets', 'user'));
    }
}
