<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuperadminDetails extends Model
{
    protected $table = 'superadmin_details';

    public $timestamps = true;

    protected $fillable = ['superadmin_id', 'phone', 'image'];
}
