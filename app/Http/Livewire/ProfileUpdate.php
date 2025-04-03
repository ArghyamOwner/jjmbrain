<?php

namespace App\Http\Livewire;

use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

// use Illuminate\Validation\Rule;
// use Illuminate\Support\Facades\Storage;

class ProfileUpdate extends Component
{
    use WithFileUploads;

    public $name;
    public $role;
    public $profileImage;
    public $profileImageUrl = null;

    public $gender;
    public $dob;

    public function updatedProfileImage()
    {
        $this->validate([
            'profileImage' => [
                'required',
                'mimes:jpeg,jpg,png',
                'max:1024',
                // 'dimensions:max_width=250,max_height=250'
            ],
        ]);
    }

    public function mount()
    {
        $this->name = $this->user->name;
        $this->role = $this->user->role;
        // $this->gender = $this->user->gender;
        $this->phone = $this->user->phone;
        $this->profileImage = $this->user->photo;
        $this->profileImageUrl = $this->user->photo_url ?? null;

        $this->gender = $this->user->gender;
        $this->dob = $this->user->dob?->format('Y-m-d');
    }

    public function getUserProperty()
    {
        return auth()->user();
    }

    public function updateProfile()
    {
        $this->validate([
            // 'name' => ['required'],
            'gender' => ['required', 'string', Rule::in(['male', 'female'])],
            // 'phone' => ['required', 'digits:10']
            'dob' => ['required'],
        ]);

        auth()->user()->update([
            // 'name' => $this->name,
            'gender' => $this->gender,
            // 'phone' => $this->phone,
            'dob' => $this->dob,
        ]);

        // Upload Profile Image of Customer/User if it's not String
        // If File Object
        if (!is_string($this->profileImage) && !is_null($this->profileImage)) {
            auth()->user()->update([
                'photo' => $this->profileImage->storePublicly('/', 'profile'),
            ]);

            // Repopulate with new image path
            $this->profileImageUrl = auth()->user()->photo_url;
        }

        // Refetch updated data.
        // $this->name = auth()->user()->name;

        $this->notify('Profile updated.', 'success');

        $this->emit('profileButtonRefresh');
        $this->emitSelf('saved');
        $this->emitSelf('$refresh');
    }

    public function removeImage()
    {
        // $storagePath = Storage::disk('profile')->path(auth()->user()->photo);

        // if (file_exists($storagePath)) {
        //     Storage::disk('public')->delete(auth()->user()->photo);

        //     auth()->user()->update([
        //         'photo' => null
        //     ]);
        // }

        // if (Storage::disk('profile')->exists(auth()->user()->photo)) {
        //     Storage::disk('profile')->delete(auth()->user()->photo);
        // }

        auth()->user()->update([
            'photo' => null,
        ]);

        $this->profileImageUrl = null;
        $this->profileImage = null;
        $this->emit('profileButtonRefresh');
        $this->emit('$refresh');
    }

    public function render()
    {
        return view('livewire.profile-update');
    }
}
