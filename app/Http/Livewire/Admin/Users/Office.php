<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use App\Models\Circle;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class Office extends Component
{
    public $userId;
    public $offices = [];
    public $division = [];
    public $subdivision = [];
    public $divisionsOptions = [];
    public $subdivisionsOptions = [];

    protected $listeners = [
        'refreshOffices' => '$refresh'
    ];

    public function mount()
    {
        $user = $this->user;

        $this->offices = $user->offices->pluck('id');
        $this->division = $user->divisions->pluck('id');
        $this->subdivision = $user->subdivisions->pluck('id');
        
        $circles = $this->circles->whereIn('id', $this->offices);
        $this->divisionsOptions = $circles->flatMap(fn($item) => $item->divisions->map(fn($division) => [
                'label' => $division->name,
                'value' => $division->id,
            ]))
            ->sortBy('label')
            ->values()
            ->all();

        $this->subdivisionsOptions = $this->circles
            ->flatMap(fn($item) => $item->divisions->whereIn('id', $this->division)->flatMap(fn($division) => $division->subdivisions->map(fn($subdivision) => [
                'label' => $subdivision->name,
                'value' => $subdivision->id,
            ])))
            ->sortBy('label')
            ->values()
            ->all();
    }

    public function updateUserOffice()
    {
        $validated = $this->validate([
            'offices' => ['required', 'array', 'min:1', Rule::in($this->circles->pluck('id')->all())],
            'division' => ['required', 'array', 'min:1', Rule::in(collect($this->divisionsOptions)->pluck('value')->all())],
            'subdivision' => ['required', 'array', 'min:1', Rule::in(collect($this->subdivisionsOptions)->pluck('value')->all())],
        ]);

        try {
            return DB::transaction(function () use ($validated) {
                $this->user->offices()->sync($validated['offices']);
                $this->user->divisions()->sync($validated['division']);
                $this->user->subdivisions()->sync($validated['subdivision']);
  
                $this->emit('refreshOffices');

                $this->notify('User office updated.');
            });
        } catch (\Exception $e) {
            $this->bannerMessage('Something went wrong. Try again.', 'danger');
        }
    }

    public function getUserProperty()
    {
        return User::with(['offices', 'divisions', 'subdivisions'])->findOrFail($this->userId);
    }
    
    public function getCirclesProperty()
    {
        return Circle::with(['divisions.subdivisions'])->get();
    }

    public function updatedOffices($values)
    {
        $circles = $this->circles->whereIn('id', $values);

        $this->divisionsOptions = $circles->flatMap(fn($item) => $item->divisions->map(fn($division) => [
                'label' => $division->name,
                'value' => $division->id,
            ]))
            ->sortBy('label')
            ->values()
            ->all();
    }

    public function updatedDivision($values)
    {
        $this->subdivisionsOptions = $this->circles
            ->flatMap(fn($item) => $item->divisions->whereIn('id', $values)->flatMap(fn($division) => $division->subdivisions->map(fn($subdivision) => [
                'label' => $subdivision->name,
                'value' => $subdivision->id,
            ])))
            ->sortBy('label')
            ->values()
            ->all();
    }

    public function render()
    {
        return view('livewire.admin.users.office', [
            'circles' => $this->circles
                ->map(fn($item) => [
                    'label' => $item->name,
                    'value' => $item->id
                ])->sortBy('label')->values()->all()
        ]);
    }
}
