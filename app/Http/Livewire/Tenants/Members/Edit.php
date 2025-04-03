<?php

namespace App\Http\Livewire\Tenants\Members;

use App\Enums\DesignationTypes;
use App\Models\Member;
use Livewire\Component;
use App\Enums\MemberType;
use App\Rules\CheckValidPhoneNumber;
use Illuminate\Validation\Rules\Enum;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $photoUrl;
    public $memberId;
    public $memberType;
    public $name;
    public $phone;
    public $designation;
    public $workDetails;
    public $wardNumber;
    public $photo;

    protected $listeners = [
        'refreshMember' => '$refresh'
    ];

    public function mount(Member $member)
    {
        $this->memberId = $member->id;
        $this->memberType = $member->type;
        $this->name = $member->name;
        $this->phone = $member->phone;
        $this->designation = $member->designation;
        $this->workDetails = $member->work_details;
        $this->wardNumber = $member->ward_number;
        $this->photoUrl = $member->imageUrl;
    }

    public function save()
    {
        $validated = $this->validate([
            'memberType' => ['required', new Enum(MemberType::class)],
            'name' => ['required'],
            'phone' => ['required', new CheckValidPhoneNumber],
            'designation' => ['required', new Enum(DesignationTypes::class)],
            'workDetails' => ['nullable'],
            'wardNumber' => ['nullable'],
            'photo' => ['nullable', 'image', 'max:1024'],
        ]);

        $this->member->update([
            'type' => $validated['memberType'],
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'designation' => $validated['designation'],
            'work_details' => $validated['workDetails'],
            'ward_number' => $validated['wardNumber'],
        ]);

        if ($this->photo) {
            $this->member->update([
                'image' => $this->photo->storePublicly('/', 'public'), 
            ]);
        }

        $member = $this->member->refresh();
        
        $this->memberType = $member->type;
        $this->name = $member->name;
        $this->phone = $member->phone;
        $this->designation = $member->designation;
        $this->workDetails = $member->work_details;
        $this->wardNumber = $member->ward_number;
        $this->photoUrl = $member->imageUrl;

        $this->dispatchBrowserEvent('destroy-filepond');
        $this->notify('Members details updated!');

        $this->emit('refreshMember');
    }

    public function getMemberProperty()
    {
        return Member::findOrFail($this->memberId);
    }

    public function getMemberTypesProperty()
    {
        return MemberType::cases();
    }

    public function getDesignationTypesProperty()
    {
        return DesignationTypes::cases();
    }

    public function render()
    {
        return view('livewire.tenants.members.edit');
    }
}
