<?php

namespace App\Http\Livewire\Notices;

use App\Models\Notice;
use Livewire\Component;

class Show extends Component
{
    public $noticeId;

    public function mount($notice)
    {
        $this->noticeId = $notice;
    }

    public function getNoticeProperty()
    {
        return Notice::query()->with('user')->findOrFail($this->noticeId);
    }

    public function render()
    {
        return view('livewire.notices.show', [
            'notice' => $this->notice
        ]);
    }
}
