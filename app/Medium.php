<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medium extends Model
{
    protected $table = 'medium';

    public $timestamps = true;

    protected $fillable = ['medium'];
}
