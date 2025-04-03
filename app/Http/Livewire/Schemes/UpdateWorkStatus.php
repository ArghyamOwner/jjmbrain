<?php

namespace App\Http\Livewire\Schemes;

use App\Enums\SchemeWorkStatus;
use App\Models\Scheme;
use App\Traits\InteractsWithBanner;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateWorkStatus extends Component
{
    use InteractsWithBanner;
    use WithFileUploads;

    public $show = true;
    public $scheme;
    public $schemeId;
    public $status;
    public $handoverDate;
    public $handoverDocument;
    public $isOperative;

    public function mount(Scheme $scheme)
    {
        $this->scheme = $scheme;
        $this->schemeId = $scheme->id;
        $this->isOperative = $this->scheme->operating_status?->value == 'operative';
    }

    public function update()
    {
        $validatedData = $this->validate([
            'status' => ['required'],
            'handoverDate' => ['nullable', 'required_if:status,handed-over', 'date'],
            'handoverDocument' => ['nullable', 'required_if:status,handed-over', 'mimes:pdf'],
        ]);

        if ($validatedData['status'] == 'handed-over') {
            if (!$this->isOperative) {
                return $this->notify("Scheme Operational/Functional status should be operative before handing over.", 'error');
            }
            if (!($this->scheme->verified_on)) {
                return $this->notify("The Conditions for Handover Have Not Yet Been Satisfied.", 'error');
            }

            if ($this->scheme->planned_fhtc > 50) {
                if (!$this->scheme->user_id) {
                    return $this->notify("The Conditions for Handover that is Jalmitra Not Assigned to Scheme.", 'error');
                }
            }

            if (!($this->scheme->energy_type === 'Solar' || $this->scheme->energy_type === 'Gravity')) {
                if (!$this->scheme->consumer_no) {
                    return $this->notify("The Conditions for Handover that is APDCL Consumer Number Not Assigned to Scheme.", 'error');
                }
            }
        }

        $this->scheme->updateQuietly([
            'work_status' => $validatedData['status'],
            'handover_date' => $validatedData['handoverDate'],
        ]);

        if ($validatedData['handoverDocument']) {
            $this->scheme->updateQuietly([
                'handover_document' => $validatedData['handoverDocument']->storePublicly('/', 'uploads'),
            ]);
        }

        $this->scheme->schemeActivity()->create([
            'user_id' => auth()->id(),
            'scheme_id' => $this->scheme->id,
            'activity_type' => 'status_updated',
            'content' => 'Scheme',
        ]);

        $this->banner('Saved.');
        return redirect()->route('schemes.show', [$this->scheme->id, 'tab' => 'details']);
    }

    public function updatedStatus()
    {
        $this->show = false;
        if ($this->status == 'handed-over') {
            $this->show = true;
        }
    }

    public function getSchemeStatusesProperty()
    {
        return SchemeWorkStatus::cases();
    }

    public function render()
    {
        return view('livewire.schemes.update-work-status');
    }
}
