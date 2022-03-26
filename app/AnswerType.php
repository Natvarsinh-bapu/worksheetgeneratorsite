<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerType extends Model
{
    protected $table = 'answer_types';

    public $timestamps = true;

    protected $fillable = ['type'];
}
