<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'question_types';

    public $timestamps = true;

    protected $fillable = ['type', 'category_id', 'concept_id', 'sub_concept_id', 'created_by', 'created_by_id', 'status'];
    
    // get related category
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    // get related concept
    public function concept(){
        return $this->belongsTo(Concept::class, 'concept_id');
    }

    // get related sub concept
    public function sub_concept(){
        return $this->belongsTo(SubConcept::class, 'sub_concept_id');
    }

    //get related images
    public function images()
    {
        return $this->hasMany(TypeImage::class, 'question_type_id');
    }
}
