<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;

trait MyFile
{
    public static function FtpUpload($file, $directory, $width = null, $height = null, $old = null)
    {
        $path =  'public_html/' . $directory . '/' .today()->toDateString();
     

        if (!is_null($old) or !empty($old)) {
            Storage::disk('ftp')->delete($old);
        }

        if (!is_null($width) or !empty($width)) {
            $image = ImageManagerStatic::make($file->getRealPath());
            $file = $image->resize($width, $height);
        }
      

        $path = Storage::disk('ftp')->put($path, $file);

        return substr($path, 12);
    }

    public static function FtpDelete($file)
    {
        Storage::disk('ftp')->delete($file);
    }
}
