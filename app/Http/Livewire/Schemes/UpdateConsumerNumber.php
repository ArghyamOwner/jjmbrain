<?php

namespace App\Http\Livewire\Schemes;

use App\Models\Scheme;
use App\Traits\InteractsWithBanner;
use App\Traits\InteractsWithSlideoverModal;
use Livewire\Component;

class UpdateConsumerNumber extends Component
{
    use InteractsWithSlideoverModal;
    use InteractsWithBanner;

    public $schemeId;
    public $consumer_no;
    
    protected $listeners = [
        'updateConsumerNoSlideover' => 'openModal'
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
            'consumer_no' => ['required'],
        ]);

        $this->scheme->updateQuietly($validatedData);

        $this->scheme->schemeActivity()->create([
            'user_id' => auth()->id(),
            'scheme_id' => $this->scheme->id,
            'activity_type' => 'consumer_updated',
            'content' => 'Scheme',
        ]);

        $this->reset();
        // $this->emit('refreshConsumerNo');
        $this->banner('Saved.');
        return redirect()->route('schemes.show', [$this->scheme->id, 'tab' => 'details']);
        // $this->close();
    }

    public function getSchemeProperty()
    {
        return Scheme::findOrFail($this->schemeId);
    }

    public function render()
    {
        return view('livewire.schemes.update-consumer-number');
    }
}
