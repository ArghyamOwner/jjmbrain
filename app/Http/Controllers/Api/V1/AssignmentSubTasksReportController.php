<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use Illuminate\Validation\Rule;
use App\Models\AssignmentSubtask;
use App\Traits\WithApiFileUpload;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class AssignmentSubTasksReportController extends Controller
{
    use WithApiHelpers;
    use WithApiFileUpload;

    /**
     * Handle the incoming request.
     */
    public function __invoke(AssignmentSubtask $subtask, Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', Rule::exists('users', 'id')],
            'remarks' => ['required', 'string'],
            'answer' => ['required', 'string'],
            'images' => ['nullable', 'array', 'min:1']
        ]);

        try {
            return DB::transaction(function() use ($validated, $subtask) {
                $subtask->update([
                    'remarks' => $validated['remarks'],
                    'answer' => $validated['answer'],
                    'user_id' => $validated['user_id'],
                    'completed_at' => now()
                ]);
        
                if (isset($validated['images']) && count($validated['images']) > 0) {
                    foreach($validated['images'] as $validatedImage) {
                        if($validatedImage){
                            // Log::error($validatedImage);
                            // Log::channel('slack')->info('Sub Task Image : '.$validatedImage);;
                            $file = $this->createFileObject($validatedImage);
                            if(! $file){
                                Log::channel('slack')->info('No file - '.$validatedImage.' Subtask - '.$subtask->id);
                                // return $this->respondWithUnprocessableEntity('Invalid File.');
                            }else{
                                $subtask->assignmentImages()->create([
                                    'path' => $file->storePublicly('/', 'subtaskreports'),
                                    'caption' => null,
                                    'extension' => $file->getClientOriginalExtension(),
                                    'size' => $file->getSize()
                                ]);
                            }
                        }
                    }
                }
        
                return $this->respondCreated();
            });
        } catch (\Exception $e) {
            // dd($e->getMessage());
            // Log::info($e->getMessage());
            // return $e->getMessage();
            return $this->respondWithUnprocessableEntity('Something went wrong. Try again.');
        }
    }
}
