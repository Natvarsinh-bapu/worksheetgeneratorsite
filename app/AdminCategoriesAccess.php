<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminCategoriesAccess extends Model
{
    protected $table = 'admin_categories_access';

    public $timestamps = true;

    protected $fillable = ['admin_id', 'category_id', 'status'];

    //related category
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
}
