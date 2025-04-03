<?php

namespace App\Http\Controllers\Api\V1\Grievances;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Grievance;
use App\Traits\WithApiFileUpload;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubmitReason extends Controller
{
    use WithApiHelpers;
    use WithApiFileUpload;


    /**
     * Handle the incoming request.
     */
    public function __invoke(Grievance $grievance, Request $request)
    {
        $validated = $request->validate([
            'status' => ['required'],
            'issue_id' => ['required', Rule::exists('issues', 'id')],
            'attachment' => ['nullable'],
            'body' => ['required'],
        ]);

        $grievance->update([
            'issue_id' => $validated['issue_id'],
        ]);

        $comment = $grievance->comments()->create([
            'type' => Comment::TYPE_GRIEVANCE,
            'status' => $validated['status'],
            'body' => $validated['body'],
            'commented_by' => auth()->id(),
        ]);

        if (!blank($validated['attachment'])) {
            $file = $this->createFileObject($validated['attachment']);

            $comment->update([
                'attachment' => $file->storePublicly('/', 'comments'),
            ]);
        }

        return $this->respondCreated();
    }
}
