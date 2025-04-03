<?php

namespace App\Http\Livewire\Lithologs;

use App\Models\Litholog;
use App\Traits\InteractsWithBanner;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Edit extends Component
{
    use InteractsWithBanner;

    public $litholog;
    public $completion_date;
    public $compressor_pressure;
    public $static_water;
    public $duration_pump;
    public $discharge;
    public $drawdown;
    public $status;
    public $advisory;
    public $comment;

    public function mount(Litholog $litholog)
    {
        $this->litholog = $litholog;
        $this->completion_date = $this->litholog->completion_date;
        $this->compressor_pressure = $this->litholog->compressor_pressure;
        $this->static_water = $this->litholog->static_water;
        $this->duration_pump = $this->litholog->duration_pump;
        $this->discharge = $this->litholog->discharge;
        $this->drawdown = $this->litholog->drawdown;
        $this->status = $this->litholog->status;
        // $this->advisory = $this->litholog->advisory;
        $this->comment = $this->litholog->comment;

    }

    public function update()
    {
        $validate = $this->validate([
            'completion_date' => ['required'],
            'compressor_pressure' => ['required'],
            'static_water' => ['required'],
            'duration_pump' => ['required'],
            'discharge' => ['required'],
            'drawdown' => ['required'],
            'status' => ['required'],
            // 'advisory' => ['required'],
            'comment' => ['required'],
        ]);

        $this->litholog->update($validate + [
            'checked_by' => Auth::id()
        ]);
        $this->banner('Updated Successfully');
        return redirect()->route('lithologs.show', $this->litholog->id);
    }

    public function render()
    {
        return view('livewire.lithologs.edit');
    }
}
