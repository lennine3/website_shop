<?php

namespace App\Libraries;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Upload
{
    public function doUpload($path, $file, $name = "", $resize = false, $size = false, $insertLogo=false)
    {
        $logoPath='public/admin/assets/img/logo/waterMark.png';
        $logo = Image::make($logoPath);
        $logo->resize(210, 110);

        if ($name == "") {
            $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $file_name = StripSlug($name) . '.' . $file->getClientOriginalExtension();
            $postfix = "-" . substr(time(), -5);
            if (file_exists(public_path('/storage') . '/' . $path . $file_name)) {
                $file_name = StripSlug($name) . $postfix . '.' . $file->getClientOriginalExtension();
                $name .= $postfix;
            }
        } else {
            $file_name = $name;
        }

        $image = $file->getRealPath();

        // if svg
        if ($file->getClientOriginalExtension() == 'svg') {
            $file->storeAs('/storage' . '/' . $path, $file_name);
            return $file_name;
        }

        $image = Image::make($file->getRealPath());
        $insertLogo ? $image->insert($logo, 'center') : '';
        $height = $image->height();
        $width = $image->width();
        if ($resize) {
            $image->resize($resize[0], $resize[1], function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        $directory = 'public/storage' . '/' . $path;
        File::isDirectory($directory) or File::makeDirectory($directory, 0777, true, true);
        $image->save($directory . $file_name);

        $path_parts = pathinfo($file_name);

        $webp_path = $path_parts['filename'] . '.webp';

        $this->convert_to_webp($directory.$file_name, $directory.$webp_path, $resize);

        return $size ? [
            'name' => $file_name,
            'width' => $width,
            'height' => $height
        ] : $file_name;
    }

    public function doUploadLogo($path, $file, $name = "", $resize = false, $size = false)
    {
        $file_name = 'logo' . '.' . $file->getClientOriginalExtension();
        $image = $file->getRealPath();

        if ($file->getClientOriginalExtension() == 'svg') {
            $file->storeAs('/storage', $file_name);
            return $file_name;
        }

        $image = Image::make($file->getRealPath());
        $height = $image->height();
        $width = $image->width();
        if ($resize) {
            $image->resize($resize[0], $resize[1], function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        $dictory = public_path('/storage') . '/';
        File::isDirectory($dictory) or File::makeDirectory($dictory, 0777, true, true);
        $image->save($dictory . $file_name);
        return $size ? [
            'name' => $file_name,
            'width' => $width,
            'height' => $height
        ] : $file_name;
    }

    public function doUploadBlog($path, $file, $name = "", $resize = false, $size = false, $insertLogo=false)
    {
        $logoPath='public/admin/assets/img/logo/waterMark.png';
        $logo = Image::make($logoPath);
        $logo->resize(210, 110);

        if ($name == "") {
            $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $file_name = StripSlug($name) . '.' . $file->getClientOriginalExtension();
            $postfix = "-" . substr(time(), -5);
            if (file_exists(public_path('/storage') . '/' . $path . $file_name)) {
                $file_name = StripSlug($name) . $postfix . '.' . $file->getClientOriginalExtension();
                $name .= $postfix;
            }
        } else {
            $file_name = $name;
        }

        $image = $file->getRealPath();

        $image = Image::make($file->getRealPath());
        $insertLogo ? $image->insert($logo, 'center') : '';
        $height = $image->height();
        $width = $image->width();
        if ($resize) {
            $image->resize($resize[0], $resize[1], function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        $directory = 'public/storage' . '/' . $path;
        File::isDirectory($directory) or File::makeDirectory($directory, 0777, true, true);
        $image->save($directory . $file_name);

        $path_parts = pathinfo($file_name);

        $webp_path = $path_parts['filename'] . '.webp';
        // dd($webp_path);
        $this->convert_to_webp($directory.$file_name, $directory.$webp_path, $resize);

        return $size ? [
            'name' => $file_name,
            'width' => $width,
            'height' => $height
        ] : [
            'name'=> $file_name,
            'webp_name'=>$webp_path,
        ];
    }

    public function doDirectory($path)
    {
        $destinationPath = storage_path('app/public');
        $dictory = $destinationPath . '/' . $path . '/';
        File::isDirectory($dictory) or File::makeDirectory($dictory, 0777, true, true);
    }


    public function convert_to_webp($jpg_path, $webp_path, $resize)
    {
        // Load the JPG image using Intervention Image
        $image = Image::make($jpg_path);

        // Convert the image to WebP format
        $image->encode('webp', 75);

        if ($resize) {
            $image->resize($resize[0], $resize[1], function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        // Save the WebP image to the specified path
        $image->save($webp_path);

        $filename = basename($webp_path);
    }
}
