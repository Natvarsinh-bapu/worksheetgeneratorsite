<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * function for file upload
 * @param $file, $path
 * file = file which is post from form
 * path = path where file is stored
 */
if(!function_exists('file_upload')){
    function file_upload($file, $path){
        $original_name = str_replace('_', '-', $file->getClientOriginalName());
        $original_name = str_replace(' ', '-', $original_name);
        $timestamp = Carbon::now()->format('YmdHis');
        $filename = $timestamp.'_'.$original_name;
        Storage::disk('public')->put($path.'/'.$filename, file_get_contents($file));

        return $filename;
    }
}

//return default image url
if(!function_exists('default_image_url')){
    function default_image_url(){
        return url('/').'/images/default.png';
    }
}