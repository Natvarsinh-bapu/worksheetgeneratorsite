<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeImage extends Model
{
    protected $appends = ['image_url'];

    protected $table = 'question_type_images';

    public $timestamps = true;

    protected $fillable = ['question_type_id', 'image'];

    //full image url
    public function getImageUrlAttribute(){
        return url('/').'/storage/question_type_files/'.$this->image;
    }
}
