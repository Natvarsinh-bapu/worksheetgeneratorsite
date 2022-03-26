<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubConcept extends Model
{
    protected $table = 'sub_concepts';

    public $timestamps = true;

    protected $fillable = ['sub_concept', 'category_id', 'concept_id', 'created_by', 'created_by_id', 'status'];

    /**
     * get related category
     */
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * get related concept
     */
    public function concept(){
        return $this->belongsTo(Concept::class, 'concept_id');
    }
}
