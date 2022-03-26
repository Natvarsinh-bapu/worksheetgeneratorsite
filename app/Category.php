<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public $timestamps = true;

    protected $fillable = ['category', 'created_by', 'created_by_id', 'status'];

    //concepts
    public function concepts(){
        return $this->hasMany(Concept::class, 'category_id');
    }
}
