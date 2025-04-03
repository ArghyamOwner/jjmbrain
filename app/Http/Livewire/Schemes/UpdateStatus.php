<?php

namespace App\Http\Livewire\Schemes;

use App\Enums\SchemeWorkStatus;
use App\Models\Scheme;
use Livewire\Component;
use App\Traits\InteractsWithBanner;
use App\Traits\InteractsWithSlideoverModal;

class UpdateStatus extends Component
{
    use InteractsWithSlideoverModal;
    use InteractsWithBanner;

    public $schemeId;
    public $status;
    public $handoverDate;
    
    protected $listeners = [
        'updateSchemeStatusSlideover' => 'openModal'
    ];

    public function openModal($id)
    {
        $this->resetErrorBag();
        $this->show = true;
        $this->schemeId = $id;
    }

    public function update()
    {
        $validatedData = $this->validate([
            'status' => ['required'],
            'handoverDate' => ['nullable','required_if:status,handed-over', 'date']
        ]);

        $this->scheme->updateQuietly([
            'work_status' => $validatedData['status'],
            'handover_date' => $validatedData['handoverDate'],
        ]);

        $this->scheme->schemeActivity()->create([
            'user_id' => auth()->id(),
            'scheme_id' => $this->scheme->id,
            'activity_type' => 'status_updated',
            'content' => 'Scheme',
        ]);

        $this->reset();
        $this->emit('refreshSchemeStatus');
        $this->banner('Saved.');
        $this->close();
    }

    public function getSchemeProperty()
    {
        return Scheme::findOrFail($this->schemeId);
    }

    public function getSchemeStatusesProperty()
    {
        return SchemeWorkStatus::cases();
    }

    public function render()
    {
        return view('livewire.schemes.update-status');
    }
}