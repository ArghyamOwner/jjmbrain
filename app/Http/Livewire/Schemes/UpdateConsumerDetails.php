<?php

namespace App\Http\Livewire\Schemes;

use App\Models\Scheme;
use App\Traits\InteractsWithBanner;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateConsumerDetails extends Component
{
    use InteractsWithBanner;
    use WithFileUploads;

    public $scheme;
    public $schemeId;
    public $consumer_no;
    public $consumer_bill;
    public $updateBill = false;

    public function mount(Scheme $scheme)
    {
        $this->scheme = $scheme;
        $this->schemeId = $scheme->id;
        $this->updateBill = $scheme->consumer_bill ? false : true;
    }

    public function update()
    {
        $validatedData = $this->validate([
            'consumer_no' => ['required'],
            'consumer_bill' => ['nullable', 'mimes:pdf'],
        ]);

        $this->scheme->updateQuietly([
            'consumer_no' => $validatedData['consumer_no']
        ]);

        if ($validatedData['consumer_bill']) {
            $this->scheme->updateQuietly([
                'consumer_bill' => $validatedData['consumer_bill']->storePublicly('/', 'uploads'),
            ]);
        }

        $this->scheme->schemeActivity()->create([
            'user_id' => auth()->id(),
            'scheme_id' => $this->scheme->id,
            'activity_type' => 'consumer_updated',
            'content' => 'Scheme',
        ]);

        $this->banner('Saved.');
        return redirect()->route('schemes.show', [$this->scheme->id, 'tab' => 'details']);
    }

    public function render()
    {
        return view('livewire.schemes.update-consumer-details');
    }
}
