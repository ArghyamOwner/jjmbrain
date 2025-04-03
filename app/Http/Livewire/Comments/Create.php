<?php

namespace App\Http\Livewire\Comments;

use App\Models\Comment;
use App\Models\Grievance;
use App\Traits\InteractsWithBanner;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use InteractsWithBanner;
    use WithFileUploads;

    public $body;
    public $status;
    public $attachment;

    public $grievanceId;

    public function mount($grievance)
    {
        $this->grievanceId = $grievance;
    }

    public function save()
    {
        $validatedData = $this->validate([
            'body' => ['required'],
            'status' => ['required'],
            'attachment' => ['nullable', 'max:2048'],
        ]);

        $comment = $this->grievance->comments()->create([
            'body' => $validatedData['body'],
            'type' => Comment::TYPE_GRIEVANCE,
            'status' => $validatedData['status'],
            'commented_by' => auth()->id(),
        ]);

        if ($this->attachment) {
            $comment->update([
                'attachment' => $this->attachment->storePublicly('/', 'comments'),
            ]);
        }

        $this->reset();
        
        $this->dispatchBrowserEvent('destroy-filepond');

        $this->emit('refreshGrievance');

        $this->banner('Comment Added!');
    }

    public function getGrievanceProperty()
    {
        return Grievance::query()->findOrFail($this->grievanceId);
    }

    public function render()
    {
        return view('livewire.comments.create', [
            'statuses' => Comment::getStatusOptions(),
        ]);
    }
}
