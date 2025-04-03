<?php

namespace App\Traits;

use SplFileObject;
use League\Csv\Writer;

trait WithExportToCsv
{
    public function exportToCsv(array $data = [], string $filename = 'export.csv')
    {
		throw_if(! is_array($data), 'The data provided must be an associative array.');

		throw_if(count($data) == 0, 'The data provided must be a valid associative array and cannot be empty.');

        $headers = [
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
            'Expires' => '0',
            'Pragma' => 'public',
        ];

        return response()->stream(function () use ($data) {
            $csvWriter = Writer::createFromFileObject(
                new SplFileObject('php://output', 'w+')
            );
            $csvWriter->insertOne(array_keys($data[0]));
            $csvWriter->insertAll($data);
        }, 200, $headers);
    }
}
