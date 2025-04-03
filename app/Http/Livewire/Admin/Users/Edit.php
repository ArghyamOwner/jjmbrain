<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use App\Models\District;
use Illuminate\Validation\Rule;

class Edit extends Component
{
    public $userId;
    public $name;
    public $email;
    public $phone;
    public $role;
    public $designation;

    // public $districtId;

    // public $show = true;
    // public $hide = false;

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function mount(User $user)
    {
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->role = $user->role;
        $this->designation = $user->designation ?? '';
       // $this->districtId = $user->districts->pluck('id')->all();

        // if ($this->role === 'tpa-admin' || $this->role === 'third-party') {
        //     $this->hide = true;
        //     $this->show = false;
        // } else {
        //     $this->hide = false;
        //     $this->show = true;
        // }
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => ['required'],
            'phone' => ['required', 'digits:10', Rule::unique('users', 'phone')->ignore($this->userId)],
            'email' => ['required', Rule::unique('users', 'email')->ignore($this->userId)],
            'role' => ['required', Rule::in($this->roles->keys()->all())],
          //  'districtId' => ['nullable', 'required_if:role,tpa-admin,third-party', 'array']
            'designation' => ['nullable']
        ]);

        $this->user->update($validated);

        // if ($validated['role'] === 'tpa-admin' || $validated['role'] === 'third-party') {
        //     $this->user->districts()->sync($validated['districtId']);
        // } else {
        //     $this->user->districts()->detach();
        // }

        $this->emit('refreshData');

        $this->bannerMessage('User details updated.');
    }

    public function getUserProperty()
    {
        return User::findOrFail($this->userId);
    }

    public function getRolesProperty()
    {
        return collect(config('freshman.roles'))->filter(function ($item, $key) {
            return $key != 'admin' && $key != 'super-admin';
        });
    }

    // public function getDistrictsProperty()
    // {
    //     return District::query()->get()->map(fn ($item) => [
    //         "label" => $item->name,
    //         "value" => $item->id,
    //     ])->all();
    // }

    // public function updatedRole($value)
    // {
    //     if ($value === 'tpa-admin' || $value === 'third-party') {
    //         $this->hide = true;
    //         $this->show = false;
    //     } else {
    //         $this->hide = false;
    //         $this->show = true;
    //     }
    // }

    public function render()
    {
        return view('livewire.admin.users.edit');
    }
}
