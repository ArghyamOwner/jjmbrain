<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait WithFileAttachment
{
    public $files = [];

    public function completeUpload(string $uploadedFileName, string $eventName)
    {
        foreach ($this->files as $file) {
            if ($file->getFilename() === $uploadedFileName) {
                $url = Storage::disk($this->diskName)->url($file->store('/', $this->diskName));
                // $url = $file->temporaryUrl();
                $this->dispatchBrowserEvent($eventName, [
                    'url' => $url,
                    'href' => $url,
                ]);
            }
        }
    }

    public function removeUploadedFile(string $uploadedFileURL = null)
    {
        if ($uploadedFileURL == null) {
            return;
        }

        $file = new \SplFileInfo($uploadedFileURL);

        $exists = Storage::disk($this->diskName)->exists($file->getFilename());
        if ($exists) {
            Storage::disk($this->diskName)->delete($file->getFilename());

            return response()->json('Deleted', 200);
        }
    }
}
