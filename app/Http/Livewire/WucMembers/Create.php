<?php

namespace App\Http\Livewire\WucMembers;

use App\Models\User;
use App\Models\WucMember;
use App\Traits\InteractsWithBanner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Create extends Component
{
    use InteractsWithBanner;

    public $wuc;
    public $name;
    public $phone;
    public $email;
    public $type;
    public $designation;

    public function save()
    {
        $validatedData = $this->validate([
            'name' => ['required'],
            'phone' => ['required', 'digits:10'],
            'designation' => ['required'],
        ]);

        DB::transaction(function () use ($validatedData) {
            $email = null;
            $user = null;
            $appendMessage = '';

            if ($validatedData['designation'] == WucMember::DESIGNATION_PRESIDENT) {
                $userExists = User::query()
                    ->where('phone', $validatedData['phone'])
                    ->exists();
                if ($userExists) {
                    return $this->notify('User with same Phone Number already Exists', 'error');
                }

                $presidentExists = WucMember::with('user')->where('wuc_id', $this->wuc->id)->where('designation', WucMember::DESIGNATION_PRESIDENT)->get();
                if ($presidentExists->isNotEmpty()) {
                    foreach ($presidentExists as $president) {
                        $president->user->update([
                            'blocked_at' => now(),
                            'blocked_by' => Auth::id()
                        ]);
                    }
                    $appendMessage = ' And Previous President has been Blocked';
                }

                $email = $validatedData['phone'] . "@jjmbrain.in";
                $user = User::create([
                    'name' => $validatedData['name'],
                    'phone' => $validatedData['phone'],
                    'designation' => $validatedData['designation'],
                    'email' => $email,
                    'role' => 'wuc',
                    'email_verified_at' => now(),
                    'password' => bcrypt('secret'),
                ]);

                $user->districts()->sync($this->wuc->district_id);
            }

            WucMember::create($validatedData + [
                'wuc_id' => $this->wuc->id,
                'email' => $email ?? null,
                'user_id' => $user ? $user?->id : null,
            ]);

            $this->banner('Member Details added Successfully.' . $appendMessage);
            return redirect()->route('wucs.show', $this->wuc->id);
        });

    }

    public function render()
    {
        return view('livewire.wuc-members.create', [
            'designations' => WucMember::getDesignationOptions(),
        ]);
    }
}
