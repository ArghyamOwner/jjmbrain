<?php

namespace App\Http\Livewire\Lithologs;

use App\Traits\InteractsWithBanner;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateAdvisory extends Component
{
    use InteractsWithBanner;
    
    public $advisory;
    public $litholog;

    public function mount($litholog)
    {
        $this->litholog = $litholog;
    }

    public function save()
    {
        $validate = $this->validate([
            'advisory' => ['required']
        ]);

        $this->litholog->update([
            'advisory' => $validate['advisory'],
            'advised_by' => Auth::id()
        ]);

        $this->banner('Advisory Added successfully.');
        return redirect()->route('lithologs.show', $this->litholog->id);
    }

    
    public function render()
    {
        return view('livewire.lithologs.create-advisory');
    }
}
