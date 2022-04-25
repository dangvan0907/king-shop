<?php

namespace App\Traits;

use Image;

trait HandleImage
{
    protected $imageDefault = 'default.jpg';
    protected $path = 'images/';

    public function verifyImage($request)
    {
        return $request->hasFile('image');
    }

    public function saveImage($request)
    {
        $image = $this->imageDefault;
        if ($this->verifyImage($request)) {
            $destination = $request->file('image');
            $filename = time() . '.' . $destination->getClientOriginalExtension();
            $location = $this->path . $filename;
            Image::make($destination)->resize(300, 300)->save($location);
            $image = $filename;
        }

        return $image;
    }

    public function deleteImage($imageName)
    {
        $pathName = $this->path . $imageName;
        if (file_exists($pathName) && $imageName != $this->imageDefault) {
            unlink($pathName);
        }
    }

    public function updateImage($request, $currentImage)
    {

        if ($this->verifyImage($request)) {
            $this->deleteImage($currentImage);
            return $this->saveImage($request);
        }
        return $currentImage;
    }
}
