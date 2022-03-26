<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassTeacher extends Model
{
    protected $table = 'class_teachers';

    public $timestamps = true;

    protected $fillable = [
        'class_id',
        'teacher_id'
    ];

    public function classname(){
        return $this->belongsTo(ClassName::class, 'class_id');
    }

    public function teacher(){
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
