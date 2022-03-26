<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HtmlWorksheet extends Model
{

    protected $appends = [
        'image_url'
    ];

    protected $table = 'html_worksheets';

    public $timestamps = true;

    protected $fillable = [
        'html',
        'question',
        'file_name',
        'created_by',
        'created_by_id'
    ];

    public function getImageUrlAttribute(){
        return url('storage/worksheet_png') . '/' . $this->file_name;
    }
}
