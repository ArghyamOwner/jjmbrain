<?php

namespace App\Http\Livewire\Banner;

use App\Models\Banner;
use Livewire\Component;

class Index extends Component
{
    public $search;
    public $status;
    public $app_name = 'all';

    protected $queryString = [
        'search' => ['except' => ''],
        'app_name' => ['except' => 'all'],
    ];

    protected $listeners = [
        'refreshData' => '$refresh',
    ];

    public function resetFilter()
    {
        $this->reset(['search', 'app_name']);
    }

    public function render()
    {
        $showCreateButton = false;
        if (auth()->user()->isAdministratorOrSuper()) {
            $showCreateButton = true;
        }

        return view('livewire.banner.index', [
            'showCreateButton' => $showCreateButton,
            'appOptions' => config('freshman.apps'),
            'banners' => Banner::query()
                ->with('createdBy:id,name')
                ->when($this->search != '', fn($query) => $query->whereLike(['title', 'link'], $this->search))
                ->when($this->app_name != 'all', fn($query) => $query->where('app_name', $this->app_name))
                ->latest('id')
                ->fastPaginate(),
        ]);
    }
}
