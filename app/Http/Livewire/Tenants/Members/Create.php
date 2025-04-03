<?php

namespace App\Http\Livewire\Tenants\Members;

use App\Models\Member;
use Livewire\Component;
use App\Enums\MemberType;
use Livewire\WithFileUploads;
use App\Enums\DesignationTypes;
use App\Traits\InteractsWithBanner;
use App\Rules\CheckValidPhoneNumber;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules\File;

class Create extends Component
{
    use WithFileUploads;
    use InteractsWithBanner;

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

    public function save()
    {
        $validated = $this->validate([
            'memberType' => ['required', new Enum(MemberType::class)],
            'name' => ['required'],
            'phone' => ['required', new CheckValidPhoneNumber],
            'designation' => ['required', new Enum(DesignationTypes::class)],
            'workDetails' => ['nullable'],
            'wardNumber' => ['nullable'],
            'photo' => ['nullable', File::image()->max(1024)],
        ]);

        $member = Member::create([
            'type' => $validated['memberType'],
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'designation' => $validated['designation'],
            'work_details' => $validated['workDetails'],
            'ward_number' => $validated['wardNumber'],
        ]);

        if ($this->photo) {
            $member->update([
                'image' => $this->photo->storePublicly('/', 'public'), 
            ]);
        }

        $this->dispatchBrowserEvent('destroy-filepond');

        $this->banner('New member created!');

        return redirect()->route('tenant.members.all');
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
        return view('livewire.tenants.members.create');
    }
}
