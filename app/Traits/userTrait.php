<?php

namespace App\Traits;
trait userTrait
{
    function saveImage($file,$folder)
    {
            $extention =$file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $path = $folder;
            $file->move($path,$filename);

            return $filename;
    }
}
