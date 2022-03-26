<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassName extends Model
{    
    protected $table = 'class_names';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'institute_id',
        'status',
    ];

    public function classTeachers(){
        return $this->hasMany(ClassTeacher::class, 'class_id');
    }
}
