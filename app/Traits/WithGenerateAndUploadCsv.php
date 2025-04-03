<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use League\Csv\Writer;
use SplFileObject;

trait WithGenerateAndUploadCsv
{
    public function generateAndUpload(array $data = [], string $filename = 'export.csv', string $diskName = 'uploads')
    {
        throw_if(!is_array($data), 'The data provided must be an associative array.');
        throw_if(count($data) == 0, 'The data provided must be a valid associative array and cannot be empty.');

        // Create a temporary file path
        $tempFilePath = tempnam(sys_get_temp_dir(), 'csv_');

        $csvWriter = Writer::createFromFileObject(
            new SplFileObject($tempFilePath, 'w+')
        );
        $csvWriter->insertOne(array_keys($data[0]));
        $csvWriter->insertAll($data);

        // Read the content of the temporary file
        $fileContent = file_get_contents($tempFilePath);

        // Generate a unique hashed name for the file
        $hashedName = md5(uniqid('', true)) . '.' . pathinfo($filename, PATHINFO_EXTENSION);

        // Upload the file content to the "reports" disk
        Storage::disk($diskName)->put($hashedName, $fileContent);

        // Delete the temporary file
        unlink($tempFilePath);

        return $hashedName; // Return the hashed name of the uploaded file
    }
}
