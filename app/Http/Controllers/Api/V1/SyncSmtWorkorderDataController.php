<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ContractorDetail;
use App\Models\Division;
use App\Models\Scheme;
use App\Models\Workdocument;
use App\Models\Workorder;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SyncSmtWorkorderDataController extends Controller
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
            'issuingAuthority' => ['required'],
            'division_id' => ['required'],
            'contractor_bid' => ['required'],
            'scheme_id' => ['required'],
            'workorder_number' => ['required'],
            'workorder_amount' => ['required'],
            'workorder_estimated_date' => ['nullable'],
            'pg_status' => ['nullable'],
            'workorder_status' => ['nullable'],
            'formal_workorder_number' => ['nullable'],
            'formal_workorder_date' => ['nullable'],
            'formal_workorder_amount' => ['nullable'],
            'ts_amount' => ['nullable'],
            'ts_document' => ['nullable'],
        ]);

        try {
            return DB::transaction(function () use ($validate, $workorder) {

                $division = Division::where('old_division_id', $validate['division_id'])->first();
                if (!$division) {
                    return response()->json([
                        'message' => 'Division Not Found.',
                    ], 422);
                }

                $contractor = ContractorDetail::withWhereHas('user')->where('bid_no', $validate['contractor_bid'])->first();
                if (!$contractor) {
                    return response()->json([
                        'message' => 'Contractor Not Found.',
                    ], 422);
                }

                $scheme = Scheme::where('old_scheme_id', $validate['scheme_id'])->first();
                if (!$scheme) {
                    return response()->json([
                        'message' => 'Scheme Not Found.',
                    ], 422);
                }

                if ($scheme->division_id !== $division->id) {
                    return response()->json([
                        'message' => 'Division Miss-Match.',
                    ], 422);
                }

                if ($validate['ts_document']) {
                    $imageUrl = $validate['ts_document'];

                    // Get the file name and extension
                    $fileName = pathinfo($imageUrl, PATHINFO_FILENAME);
                    $extension = pathinfo($imageUrl, PATHINFO_EXTENSION);

                    // Get the file size
                    $headers = get_headers($imageUrl, true);
                    $fileSize = isset($headers['Content-Length']) ? $headers['Content-Length'] : 0;
                    $originalName = $fileName . '.' . $extension;

                    // Upload file to Spaces
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

                $workorder->update([
                    'issuing_authority' => $validate['issuingAuthority'],
                    'contractor_id' => $contractor->user ? $contractor?->user?->id : null,
                    'circle_id' => $scheme->division->circle->id,
                    'division_id' => $division->id,
                    'workorder_number' => $validate['workorder_number'],
                    'workorder_amount' => $validate['workorder_amount'],
                    'workorder_estimated_date' => $validate['workorder_estimated_date'],
                    'pg_status' => $validate['pg_status'],
                    'workorder_status' => $validate['workorder_status'],
                    'formal_workorder_number' => $validate['formal_workorder_number'],
                    'formal_workorder_date' => $validate['formal_workorder_date'],
                    'formal_workorder_amount' => $validate['formal_workorder_amount'],
                    'ts_document' => $originalName ?? null,
                    'ts_amount' => $validate['ts_amount'],
                ]);

                $workorder->schemes()->sync($scheme->id);

                $changes = $workorder->getChanges();

                if (count($changes)) {
                    unset($changes['updated_at']);
                    $updatedKeys = implode(', ', array_keys($changes));

                    $workorder->schemeActivity()->create([
                        // 'scheme_id' => $workorder->user_id,
                        'activity_type' => 'smt_workorder_updated',
                        'content' => $workorder->workorder_number . ' - ' . $updatedKeys,
                    ]);
                }
                return $this->respondCreated();
            });
        } catch (\Exception $e) {
            return $this->respondWithUnprocessableEntity('Something went wrong. Try again.');
        }
    }
}