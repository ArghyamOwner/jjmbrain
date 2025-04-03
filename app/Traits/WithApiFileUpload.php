<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait WithApiFileUpload
{
    protected function createFileObject($url)
    {
        $url = stripslashes($url);

        if (Storage::disk('public')->exists($url)) {
            $path = Storage::disk('public')->path($url);
           
            $originalName = File::basename($path);
            $mimeType = File::mimeType($path);

            return new UploadedFile(
                $path,
                $originalName,
                $mimeType,
                error: true,
                test: true
            );
        } else {
            return null;
        }
    }
}
