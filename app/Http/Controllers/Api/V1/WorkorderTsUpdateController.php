<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Workdocument;
use App\Models\Workorder;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkorderTsUpdateController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke($workorder, Request $request)
    {
        $workorder = Workorder::where('old_workorder_id', $workorder)->first();
        if (!$workorder) {
            return response()->json([
                'message' => 'Workorder Not Found.',
            ], 422);
        }

        $validate = $request->validate([
            'formal_workorder_number' => ['required'],
            'formal_workorder_date' => ['required'],
            'formal_workorder_amount' => ['required'],
            'ts_number' => ['nullable'],
            // 'ts_date' => ['required'],
            'ts_document' => ['nullable'],
            'ts_amount' => ['required'],
        ]);

        if ($validate['ts_document']) {
            $imageUrl = $validate['ts_document'];

            // Get the file name and extension
            $fileName = pathinfo($imageUrl, PATHINFO_FILENAME);
            $extension = pathinfo($imageUrl, PATHINFO_EXTENSION);

            // Get the file size
            $headers = get_headers($imageUrl, true);
            $fileSize = isset($headers['Content-Length']) ? $headers['Content-Length'] : 0;

            $originalName = $fileName . '.' . $extension;

            $fileContents = file_get_contents($imageUrl);
            Storage::disk('workorderdocs')->put($originalName, $fileContents);

            Workdocument::create([
                'workorder_id' => $workorder->id,
                'name' => $fileName,
                'path' => $originalName,
                'size' => $fileSize,
                'extension' => $extension,
            ]);

        }
        $workorder->update($validate + [
            'ts_document' => $originalName ?? null
        ]);
        
        $workorder->schemeActivity()->create([
            // 'scheme_id' => $workorder->user_id,
            'activity_type' => 'smt_workorder_ts_updated',
            'content' => $workorder->workorder_number,
        ]);

        return $this->respondCreated();
    }
}
