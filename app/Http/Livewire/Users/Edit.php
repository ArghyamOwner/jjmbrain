<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use App\Models\Department;
use App\Traits\WithMemoized;
use Illuminate\Validation\Rule;
use App\Rules\CheckValidPhoneNumber;

class Edit extends Component
{
    use WithMemoized;

    public $departmentId;
    public $name;
    public $email;
    public $role;
    public $gender = 'male';
    public $phone;
    public $userId;

    protected $listeners = [
        'refresh-user' => '$refresh'
    ];

    protected function user(): User
    {
        return $this->memoized(fn () => User::findOrFail($this->userId));
    }

    public function mount(User $user)
    {
        $this->userId = $user->id;

        $this->departmentId = $user->department_id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->gender = $user->gender ?? 'male';
        $this->phone = $user->phone ?? null;
        $this->role = $user->role;
    }

    public function update()
    {
        $this->validate([
            'name' => ['required'],
            'departmentId' => ['required', Rule::in(array_keys($this->departments->all()))],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->user()->id),
            ],
            'role' => ['required', Rule::in(collect($this->roles)->pluck('value')->all())],
            'gender' => ['required', 'string', Rule::in(['male', 'female'])],
            'phone' => ['sometimes', new CheckValidPhoneNumber],
        ]);

        $this->user()->update([
            'department_id' => $this->departmentId,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'gender' => $this->gender,
            'phone' => $this->phone
        ]);

        $this->user()->refresh();

        $this->emit('refresh-user');

        $this->bannerMessage('User updated.');
    }

    public function getDepartmentsProperty()
    {
        return Department::pluck('name', 'id');
    }

    // public function getRolesProperty()
    // {
    //     return collect(config('freshman.roles'))
    //         ->map(fn ($item, $key) => [
    //             'label' => Str::title($item),
    //             'value' => $key,
    //             'summary' => ''
    //         ])
    //         ->values()
    //         ->all();
    // }

    public function getRolesProperty()
    {
        return [
            [
                'label' => 'Maker',
                'value' => 'maker',
                'summary' => 'This user can create tender'
            ],
            [
                'label' => 'Checker',
                'value' => 'checker',
                'summary' => 'This user can verify/publish the tender'
            ]
        ];
    }

    public function render()
    {
        return view('livewire.users.edit');
    }
}
