<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    
    protected $queryString = [
        'search' => ['except' => '']
    ];

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function resetFilter()
    {
        $this->reset(['search']);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.task.index', [
            'tasks' => Task::query()
                ->with('activity')
                ->withCount('subtasks', 'assignmentTask')
                ->when($this->search != '', fn ($query) => $query->whereLike(['task_name'], $this->search))
                ->latest('id')
                ->fastPaginate()
        ]);
    }
}
