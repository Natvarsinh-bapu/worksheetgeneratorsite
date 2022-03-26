<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminDetails extends Model
{
    protected $table = 'admin_details';

    public $timestamps = true;

    protected $fillable = ['admin_id', 'phone', 'image',  'no_of_institutes'];

    //full image url
    public function getFullImageUrlAttribute(){
        if($this->image == null || $this->image == 'default.png'){
            return default_image_url();
        } else {
            return url('storage/admin_profile') . '/' . $this->image;
        }
    }
}
