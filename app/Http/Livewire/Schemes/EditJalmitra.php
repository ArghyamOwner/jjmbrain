<?php

namespace App\Http\Livewire\Schemes;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditJalmitra extends Component
{
    use WithFileUploads;
    public $jalmitra;

    public $name;
    public $doj;
    public $joining_document;

    public function mount($jalmitra)
    {
        $this->jalmitra = $jalmitra->load('scheme');
        $this->name = $this->jalmitra->name;
        $this->doj = $this->jalmitra?->doj?->format('Y-m-d');
        $this->joining_document = $this->jalmitra->joining_document;
    }

    public function update()
    {
        $validated = $this->validate([
            'name' => ['required'],
            'doj' => ['required'],
            'joining_document' => ['nullable', 'mimes:pdf']
        ]);

        try {
            return DB::transaction(function () use ($validated) {
                $this->jalmitra->update([
                    'name' => $validated['name'],
                    'doj' => $validated['doj']
                ]);

                if ($validated['joining_document']) {
                    $this->jalmitra->update([
                        'joining_document' => $validated['joining_document']->storePublicly('/', 'uploads'),
                    ]);
                }

                $this->jalmitra?->scheme->schemeActivity()->create([
                    'user_id' => auth()->id(),
                    'scheme_id' => $this->jalmitra?->scheme?->id,
                    'activity_type' => 'jm_updated',
                    'content' => 'Scheme Jal-Mitra Updated',
                ]);

                $this->emit('refreshData');

                $this->dispatchBrowserEvent('hide-modal');

                $this->notify('Jalmitra user updated.');
            });
        } catch (\Exception $e) {
            $this->bannerMessage('Something went wrong. Try again.' . $e->getMessage(), 'danger');
        }
    }

    public function render()
    {
        return view('livewire.schemes.edit-jalmitra');
    }
}
