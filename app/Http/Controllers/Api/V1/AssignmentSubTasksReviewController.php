<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Models\AssignmentSubtask;
use App\Traits\WithApiFileUpload;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\AssignmentSubtaskReview;

class AssignmentSubTasksReviewController extends Controller
{
    use WithApiHelpers;
    use WithApiFileUpload;

    /**
     * Handle the incoming request.
     */
    public function __invoke(AssignmentSubtask $subtask, Request $request)
    {
        $validated = $request->validate([
            'review' => ['nullable'],
            'comment' => ['required'],
            'status' => ['required', 'in:pass,fail,consideration'],
            'rating' => ['required', 'integer', 'gt:0'],
            'images' => ['required', 'array', 'min:1'],
        ]);

        try {
            return DB::transaction(function() use ($validated, $subtask) {
                 $review = AssignmentSubtaskReview::create([
                    'user_id' => auth()->id(),
                    'assignment_subtask_id' => $subtask->id,
                    'user_type' => auth()->user()->role,
                    'comment' => $validated['comment'],
                    'status' => $validated['status'],
                    'rating' => $validated['rating'],
                    'image' => $validated['review'] ?? []
                 ]);

                 $images = [];
        
                if (isset($validated['images']) && count($validated['images']) > 0) {
                    foreach($validated['images'] as $validatedImage) {
                        $file = $this->createFileObject($validatedImage);
                        $images[] = [
                            'path' => $file->storePublicly('/', 'uploads'),
                            'extension' => $file->getClientOriginalExtension(),
                            'size' => $file->getSize()
                        ];
                    }
                }

                $review->update([
                    'meta' => $images
                ]);
        
                return $this->respondCreated();
            });
        } catch (\Exception $e) {
            // dd($e->getMessage());
            Log::info($e->getMessage());
            // return $e->getMessage();
            return $this->respondWithUnprocessableEntity('Something went wrong. Try again.');
        }
    }
}
