<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadWorksheet extends Model
{
    protected $appends = [
        'worksheet_url'
    ];

    protected $table = 'upload_worksheets';

    public $timestamps = true;

    protected $fillable = [
        'worksheet_name',
        'created_by',
        'created_by_id'
    ];

    public function getWorksheetUrlAttribute(){
        return url('/') . '/storage/worksheets/' . $this->worksheet_name;
    }
}
