<?php

namespace App\Http\Livewire\Comments;

use App\Models\Comment;
use Livewire\Component;

class Show extends Component
{
    public $grievanceId;

    protected $listeners = ['refreshGrievance' => '$refresh'];

    public function mount($grievance)
    {
        $this->grievanceId = $grievance;
    }

    public function render()
    {
        return view('livewire.comments.show', [
            'comments' => Comment::query()
                ->with('commentedBy:id,name')
                ->where('commentable_id', $this->grievanceId)
                ->where('type', Comment::TYPE_GRIEVANCE)
                ->get(),
        ]);
    }
}
