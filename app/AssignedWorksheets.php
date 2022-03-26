<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignedWorksheets extends Model
{
    protected $table = 'assigned_worksheets';

    public $timestamps = true;

    protected $fillable = [
        'teacher_id',
        'student_id',
        'worksheet_id',
        'ans_worksheet',
        'is_submit',
        'is_checked'
    ];

    public function teacher(){
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function student(){
        return $this->belongsTo(User::class, 'student_id');
    }

    public function worksheet(){
        return $this->belongsTo(HtmlWorksheet::class, 'worksheet_id');
    }
}
