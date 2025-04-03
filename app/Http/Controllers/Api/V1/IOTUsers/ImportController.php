<?php

namespace App\Http\Controllers\Api\V1\IOTUsers;

use App\Http\Controllers\Controller;
use App\Models\IotUser;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use League\Csv\Reader;

class ImportController extends Controller
{
    use WithApiHelpers;

    public function __invoke(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
        ]);
        $file = $request->file;
        $csv = Reader::createFromPath($file->getRealPath(), 'r');
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();
        $iot_users = [];
        foreach ($records as $row) {
            $iot_users[] = [
                'id' => (string) Str::ulid(),
                'scheme_id' => $row['PK'],
                'user_name' => $row['Username'],
                'password' => $row['Password'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        // IotUser::insert($iot_users);
        return $this->respondWithSuccess($iot_users);
    }
}