<?php
namespace App\Helpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;

class Resource {
    public static function delete($dirName, $file, $rootDir = 'images'){
        $path = $rootDir.'/'.$dirName.'/'.$file;
        if(File::exists($path)){
            return File::delete($path);
        }else{
            return true;
        }
    }

    public static function uploadImage($dirName, $image, $type = 'default', $rootDir = 'images')
    {
        $imageName = Carbon::now()->format('ymdhisu').'.'.$image->clientExtension();
        $img = Image::read($image->getPathname());

        switch ($type) {
            case 'avatar':
                $w = 512; $h = 512;
                break;

            case 'cccd':
                $w = 1600; $h = 1600;
                break;

            default:
                $w = 1280; $h = 1280;
                break;
        }

        $rs = $img->scale($w, $h, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save(public_path($rootDir.'/'.$dirName).'/'.$imageName);

        //Move original file to somewhere
        //$destinationPath = public_path('/images');
        //$image->move($destinationPath, $imageName);

        return ($rs) ? $imageName : false;
    }
}
