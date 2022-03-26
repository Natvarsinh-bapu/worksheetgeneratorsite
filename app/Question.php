<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    public $timestamps = true;

    protected $fillable = [
        'question',  
        'medium_id', 
        'answer_type_id', 
        'category_id',
        'concept_id', 
        'sub_concept_id', 
        'question_type_id',
        'level_id', 
        'question_file', 
        'created_by', 
        'created_by_id', 
        'status'
    ];

    // related medium
    public function medium(){
        return $this->belongsTo(Medium::class, 'medium_id');
    }

    // related answer type
    public function answer_type(){
        return $this->belongsTo(AnswerType::class, 'answer_type_id');
    }

    // related category
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    // related concept
    public function concept(){
        return $this->belongsTo(Concept::class, 'concept_id');
    }

    // related sub concept
    public function sub_concept(){
        return $this->belongsTo(SubConcept::class, 'sub_concept_id');
    }

    // related question type
    public function question_type(){
        return $this->belongsTo(Type::class, 'question_type_id');
    }

    // related level
    public function level(){
        return $this->belongsTo(Level::class, 'level_id');
    }

    //for file with path
    public function getQuestionFilePathAttribute(){        
        return url('storage/question_files') . '/' . $this->question_file;
    }
}
