<?php

namespace App\Http\Livewire\Labs;

use App\Models\Lab;
use App\Models\User;
use Livewire\Component;

class AssignUser extends Component
{
    public $lab;
    public $userId;
    public $labs;

    public function mount(User $user)
    {
        $this->userId = $user->id;
        $this->labs = $user->labs->pluck('id')->all();
    }

    public function save()
    {
        $validated = $this->validate([
            'lab' => ['required'],
        ]);

        $this->user->labs()->sync($validated['lab']);

        $this->notify('lab Assigned.', 'success');
    }

    public function getUserProperty()
    {
        return User::findOrFail($this->userId);
    }

    public function getLabArrayProperty()
    {
        return Lab::query()->get()
            ->transform(fn ($item) => [
                'value' => $item->id,
                'label' => $item->lab_name,
            ])->all();
    }

    public function render()
    {
        return view('livewire.labs.assign-user');
    }
}
