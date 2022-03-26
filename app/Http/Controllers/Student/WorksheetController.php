<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AssignedWorksheets;
use App\User;
use Auth;

class WorksheetController extends Controller
{
    //worksheet list assigned to student
    public function myWorksheets($teacher_id){
        $user = User::find($teacher_id);

        $worksheets = AssignedWorksheets::where('student_id', Auth::id())
                ->where('teacher_id', $teacher_id)
                ->latest()
                ->paginate(9);

        return view('user.student.my_worksheets', compact('worksheets', 'user'));
    }
}
