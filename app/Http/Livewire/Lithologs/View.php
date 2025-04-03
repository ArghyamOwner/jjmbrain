<?php

namespace App\Http\Livewire\Lithologs;

use Livewire\Component;
use App\Models\Litholog;
use App\Models\Lithology;
use App\Models\WaterLevel;
use Illuminate\Support\Str;
use App\Services\PdfService;
use App\Models\CasingDiagram;
use App\Traits\WithLegacyApiFcm;
use App\Traits\InteractsWithBanner;

class View extends Component
{
    use InteractsWithBanner;
    use WithLegacyApiFcm;
    public $litholog;
    public $showSdoVerification = false;
    public $showAdvisory = false;
    public $showDeleteButton = false;

    protected $listeners = [
        'refreshData' => '$refresh',
    ];

    public function mount(Litholog $litholog)
    {
        $user = auth()->user();

        $this->litholog = $litholog->loadMissing('lithologies.pattern', 'casingDiagrams.pattern', 'waterLevels.pattern', 'verifiedBy:id,name', 'scheme.division');
        if ($this->litholog->show_diagram == Litholog::SHOW_DIAGRAM) {
            if($user->isSdo()){
                $this->showSdoVerification = $this->litholog->verification_status ? false : true;
            }
        }

        if($user->isGeologyHo()){
            $this->showAdvisory = $this->litholog->advisory ? false : ($this->litholog->verified_by ? true : false);
        }

        // Show Delete Button to Roles
        if($user->isAdministrator() || $user->isSectionOfficer() || $user->isSdo() || $user->isGeologyHo()) 
        {
            $this->showDeleteButton = true;
        }
    }

    public function generateDiagram()
    {
        $this->litholog->update([
            'show_diagram' => Litholog::SHOW_DIAGRAM,
        ]);

        $this->litholog->loadMissing('scheme.division.sdos.tokens');
        $userTokens = $this->litholog?->scheme?->division?->sdos?->pluck('tokens')?->flatten(1)?->pluck('name')->unique()->toArray() ?? [];
        $title = "Verify new lithology";
        $body = "A new lithology has been created for $this->litholog?->scheme?->name. You are requested to verify it now from JJM Brain web application.";
        foreach ($userTokens as $token) {
            if (Str::length($token) > 25) {
                $this->notifyFcm($token, ['title' => $title, 'body' => $body]);
            }
        }

        $this->banner('Lithology Image Generated Successfully');
        return redirect()->route('lithologs.show', $this->litholog->id);
    }

    public function downloadLitholog()
    {
        $lithologies = Lithology::query()
            ->with('pattern')
            ->where('litholog_id', $this->litholog->id)
            ->get()
            ->transform(fn($item) => [
                'from' => $item->start,
                'to' => $item->end,
                'code' => $item?->pattern?->number.'.svg',
                'code_name' => $item?->pattern?->category,
                'remarks' => $item->remarks,
            ]);
 
        $caseDiagram = CasingDiagram::query()
            ->with('pattern')
            ->where('litholog_id', $this->litholog->id)
            ->get()
            ->transform(fn($item) => [
                'from' => $item->start,
                'to' => $item->end,
                'code' => $item?->pattern?->number.'.svg',
                'code_name' => $item?->pattern?->category,
                'remarks' => $item->remarks,
            ]);

        $waterLevel = WaterLevel::query()
            ->with('pattern')
            ->where('litholog_id', $this->litholog->id)
            ->get()
            ->transform(fn($item) => [
                'from' => $item->start,
                'to' => $item->end,
                'code' => $item?->pattern?->number.'.svg',
                'code_name' => $item?->pattern?->category,
                'remarks' => $item->remarks,
            ]);
            
 
        return response()->streamDownload(function () use ($lithologies, $caseDiagram, $waterLevel) {
            echo PdfService::render(
                view('litholog-pdf', [
                    'lithologies' => $lithologies,
                    'caseDiagram' => $caseDiagram,
                    'waterLevel' => $waterLevel
                ])->render()
            );
        }, 'litholog.pdf', [
            'Content-Type' => 'application/pdf'
        ]);
    }

    public function render()
    {
        return view('livewire.lithologs.view');
    }
}
