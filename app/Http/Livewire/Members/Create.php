<?php

namespace App\Http\Livewire\Members;

use App\Models\Member;
use App\Traits\InteractsWithBanner;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Create extends Component
{
    use InteractsWithBanner;

    public $member_name;
    public $member_phone;
    public $designation;
    public $department;

    public function save()
    {
        $validated = $this->validate([
            'member_name' => ['required', 'string'],
            'member_phone' => ['required', 'digits:10'],
            'designation' => ['required', Rule::in(collect($this->designations)->keys()->all())],
            'department' => ['required'],
        ]);

        Member::create([
            'member_name' => $validated['member_name'],
            'member_phone' => $validated['member_phone'],
            'designation' => $validated['designation'],
            'department' => $validated['department'],
            'user_id' => auth()->id(),
            'district_id' => auth()->user()->districts->first()['id']
        ]);

        $this->banner('Member added.');
       return redirect()->route('members');
    }


    public function getDesignationsProperty()
    {
        return [
            'chairman' => 'Chairman',
            'member' => 'Member'
        ];
    }

    public function render()
    {
        return view('livewire.members.create');
    }
}
