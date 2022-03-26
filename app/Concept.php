<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concept extends Model
{
    protected $table = 'concepts';

    public $timestamps = true;

    protected $fillable = ['concept', 'category_id', 'created_by', 'created_by_id', 'status'];

    // related category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
