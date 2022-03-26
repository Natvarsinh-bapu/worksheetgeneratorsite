<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $appends = ['image_url'];

    protected $table = 'templates';

    public $timestamps = true;

    protected $fillable = [
        'image', 
        'category_id', 
        'concept_id', 
        'sub_concept_id', 
        'question_type_id', 
        'created_by', 
        'created_by_id', 
        'status'
    ];

    //full image url
    public function getImageUrlAttribute(){
        return url('/').'/storage/templates/'.$this->image;
    }
}
