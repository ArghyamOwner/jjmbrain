<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Circle;
use App\Models\District;
use App\Models\User;
use App\Traits\InteractsWithBanner;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    use InteractsWithBanner;

    public $name;
    public $email;
    public $phone;
    public $designation;
    public $offices = [];
    public $division = [];
    public $subdivision = [];
    public $role;
    public $password;
    public $password_confirmation;
    public $divisionsOptions = [];
    public $subdivisionsOptions = [];
    public $districts = [];
    public $districtId;
    public $show = true;
    public $hide = false;
    public $hideForThirdParty = true;

    public function save()
    {
        $validated = $this->validate([
            'name' => ['required'],
            'phone' => ['required', 'digits:10'],
            'role' => ['required'],
            'designation' => ['nullable'],
            'email' => ['required', 'unique:users'],
            'password' => ['required', 'confirmed'],
            'offices' => ['bail', 'exclude_if:role,third-party,district-jaldoot-cell,gis-expert,iot,isa-coordinator,dc,ceo_zp', 'required', 'array', 'min:1', Rule::in($this->circles->pluck('id')->all())],
            'division' => ['bail', 'exclude_if:role,district-jaldoot-cell,gis-expert,iot,isa-coordinator,dc,ceo_zp', 'required', 'array', 'min:1', Rule::in(collect($this->divisionsOptions)->pluck('value')->all())],
            'subdivision' => ['bail', 'exclude_if:role,district-jaldoot-cell,gis-expert,iot,isa-coordinator,dc,ceo_zp', 'required', 'array', 'min:1', Rule::in(collect($this->subdivisionsOptions)->pluck('value')->all())],
            'districtId' => ['nullable', 'required_if:role,district-jaldoot-cell,isa-coordinator,dc,ceo_zp'],
        ]);
        try { 
            return DB::transaction(function () use ($validated) {
                $user = User::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'email_verified_at' => now(),
                    'password' => bcrypt($validated['password']),
                    'role' => $validated['role'],
                    'phone' => $validated['phone'],
                    'designation' => $validated['designation'],
                ]);
                if ($validated['role'] === 'third-party') {
                    // $user->districts()->sync($validated['districtId']);
                    $user->divisions()->sync($validated['division']);
                } else if ($validated['role'] === 'district-jaldoot-cell' || $validated['role'] === 'isa-coordinator' || $validated['role'] === 'dc' || $validated['role'] === 'ceo_zp') {
                    $user->districts()->sync($validated['districtId']);
                } else if ($validated['role'] === 'gis-expert' || $validated['role'] === 'iot') {
                    // $user;
                } else {
                    $user->offices()->sync($validated['offices']);
                    $user->divisions()->sync($validated['division']);
                    $user->subdivisions()->sync($validated['subdivision']);
                }
                if ($validated['role'] === 'third-party') {
                    $user->update([
                        'parent_id' => auth()->id(),
                    ]);
                }
                $this->banner('New user saved.');
                return redirect()->route('admin.users');
            });
        } catch (\Exception $e) {
            $this->bannerMessage('Something went wrong. Try again. ' . $e, 'danger');
        }
    }

    public function getCirclesProperty()
    {
        return Circle::with(['divisions.subdivisions'])->get();
    }

    public function getRolesProperty()
    {
        return match (auth()->user()->role) {
            'tpa-admin' => [
                'third-party' => 'Third Party',
            ],
            default => collect(config('freshman.roles'))->filter(function ($item, $key) {
                return $key != 'admin' && $key != 'super-admin' && $key != 'third-party';
            })->sort(),
        };
    }

    public function updatedRole($value)
    {
        if ($value === 'third-party') {
            $this->divisionsOptions = auth()->user()->divisions->map(fn($division) => [
                'label' => $division->name,
                'value' => $division->id,
            ])
                ->sortBy('label')
                ->values()
                ->all();
            $this->hideForThirdParty = false;
        }
        if ($value === 'district-jaldoot-cell' || $value === 'isa-coordinator' || $value === 'dc' || $value === 'ceo_zp') {
            $this->districts = District::query()->orderBy('name')->pluck('name', 'id');
            $this->show = false;
            $this->hide = true;
        } elseif ($value === 'gis-expert' || $value === 'iot') {
            $this->hide = false;
            $this->show = false;
        } else {
            $this->hide = false;
            $this->show = true;
        }

        // if ($value === 'tpa-admin' || $value === 'third-party') {
        //     $this->districts =  match ($value) {
        //         'tpa-admin' => District::query()->get()->map(fn ($item) => [
        //             "label" => $item->name,
        //             "value" => $item->id,
        //         ])->all(),

        //         'third-party' => auth()->user()->districts()->get()->map(fn ($item) => [
        //             "label" => $item->name,
        //             "value" => $item->id,
        //         ])->all(),
        //     };

        //     $this->hide = true;
        //     $this->show = false;
        // } else {
        //     $this->hide = false;
        //     $this->show = true;
        // }
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
        return view('livewire.admin.users.create', [
            'circles' => $this->circles
                ->map(fn($item) => [
                    'label' => $item->name,
                    'value' => $item->id,
                ])->sortBy('label')->values()->all(),

            'districts' => District::query()->pluck('name', 'id'),
        ]);
    }
}
