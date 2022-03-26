<?php

namespace App\Http\Controllers\Api\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AssignedWorksheets;
use App\ClassTeacher;
use App\User;
use Auth;

class WorksheetController extends Controller
{
    //teachers list
    public function teachers(){
        $user = Auth::user();

        $teachers = ClassTeacher::with('teacher')->where('class_id', $user->class)->get();

        return response()->json([
            'success' => true,
            'worksheets' => $teachers
        ]);
    }

    //worksheet list assigned to student
    public function myWorksheets($teacher_id){
        $user = User::find($teacher_id);

        $worksheets = AssignedWorksheets::with('worksheet')->where('student_id', Auth::id())
                ->where('teacher_id', $teacher_id)
                ->latest()
                ->paginate(10);

        return response()->json([
            'success' => true,
            'worksheets' => $worksheets,
            'teacher' => $user
        ]);
    }
}
