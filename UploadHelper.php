<?php
namespace App\Helpers;

use Illuminate\Support\Str;

class UploadHelper {
    
    public static function upload_image($image, $old_image, $path) {
        $path = base_path($path);
        $path_old_image = $path.$old_image;
        if($old_image && file_exists($path_old_image) && ($old_image != 'default.jpg')){
            unlink($path_old_image);
        }
        $image_name = Str::random(30).'.'.$image->getClientOriginalExtension();
        $image->move($path, $image_name);
        return $image_name;
    }

    public static function delete_image($image_name, $path){
        if($image_name != 'default.jpg'){
           unlink (base_path($path).$image_name);
        }
    }
}