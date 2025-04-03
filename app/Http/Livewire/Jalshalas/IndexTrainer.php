<?php

namespace App\Http\Livewire\Jalshalas;

use App\Models\Trainer;
use Livewire\Component;
use App\Models\District;
use Livewire\WithPagination;
use App\Models\EducationBlock;
use App\Enums\TrainerOrganisation;

class IndexTrainer extends Component
{
    use WithPagination;

    public $search;
    public $district = 'all';
    public $block = 'all';
    public $organisation = 'all';

    protected $queryString = [
        'search' => ['except' => ''],
        'district' => ['except' => 'all'],
        'block' => ['except' => 'all'],
        'organisation' => ['except' => 'all']
    ];

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function resetFilter()
    {
        $this->reset(['search', 'district', 'block', 'organisation']);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getDistrictsProperty()
    {
        return District::query()->orderBy('name')->pluck('name', 'id');
    }

    public function getEducationBlocksProperty()
    {
        return EducationBlock::query()->orderBy('block_name')->pluck('block_name', 'id');
    }

    public function getOrganisationsProperty()
    {
        return TrainerOrganisation::cases();
    }

    public function render()
    {
        return view('livewire.jalshalas.index-trainer', [
            'trainers' => Trainer::query()
                ->with(['district', 'educationBlock'])
                ->when(!auth()->user()->isAdministratorOrStateJaldootCell(), function ($query) {
                    $query->whereIn('district_id', auth()->user()->districts()->pluck('district_id'));
                })
                ->when($this->search != '', fn ($query) => $query->whereLike(['trainer_name', 'phone_number'], $this->search))
                ->when($this->district != 'all', fn ($query) => $query->where('district_id', $this->district))
                ->when($this->block != 'all', fn ($query) => $query->where('education_block_id', $this->block))
                ->when($this->organisation != 'all', fn ($query) => $query->where('organisation', $this->organisation))
                ->latest('id')
                ->fastPaginate()
        ]);
    }
}
