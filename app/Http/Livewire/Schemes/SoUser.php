<?php

namespace App\Http\Livewire\Schemes;

use Livewire\Component;
use Livewire\WithPagination;

class SoUser extends Component
{
    use WithPagination;

    public $scheme;
    public $user_id;
    public $search;
    public $showAddButton = false;
    public $showDeleteButton = true;

    public function mount()
    {
        $this->scheme->loadMissing('division.sectionOfficers', 'users.subdivisions');

        $user = auth()->user();
        if ($user->isAdministrator() || $user->isSdo()) {
            $this->showAddButton = true;
        }
        if($user->isDc()){
            $this->showDeleteButton = false; 
        }

    }

    protected $listeners = [
        'refreshData' => '$refresh',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function removeSoUser($user)
    {
        $this->scheme->users()->detach($user);
        $this->emit('refreshData');
        $this->notify('Section Officer Removed.');
    }

    public function getSoUsersProperty()
    {
        $existing = $this->scheme->users->pluck('id')->all();
        return $this->scheme->division->sectionOfficers->whereNotIn('id', $existing)->sortBy('name')->pluck('name', 'id')->all();
    }

    public function assignSo()
    {
        $validatedData = $this->validate([
            'user_id' => ['required'],
        ], [
            'user_id.required' => "Select Section Officer",
        ]);

        $this->scheme->users()->attach($validatedData['user_id']);

        $this->scheme->schemeActivity()->create([
            'user_id' => auth()->id(),
            'scheme_id' => $this->scheme->id,
            'activity_type' => 'so_assigned',
            'content' => 'Scheme SO Assigned',
        ]);

        $this->reset('user_id');

        $this->dispatchBrowserEvent('hide-modal');

        $this->emit('refreshData');

        $this->notify('Section Officer Assigned.');

        // $this->banner('Section Officer Assigned Successfully');
        // return redirect()->route('schemes.show', $this->scheme->id);
    }

    public function render()
    {
        return view('livewire.schemes.so-user', [
            'users' => $this->scheme->users,
        ]);
    }
}
