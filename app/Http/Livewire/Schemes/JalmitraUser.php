<?php

namespace App\Http\Livewire\Schemes;

use App\Models\Scheme;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class JalmitraUser extends Component
{
    use WithFileUploads;

    public $schemeId;
    public $name;
    // public $email;
    public $phone;
    public $doj;
    public $joining_document;
    public $existingUserId;
    // public $password;
    // public $password_confirmation;

    protected $listeners = [
        'refreshData' => '$refresh',
    ];

    public function save()
    {
        $validated = $this->validate([
            'name' => ['required'],
            'doj' => ['required'],
            'phone' => ['required', 'digits:10', 'unique:users,phone'],
            'joining_document' => ['nullable', 'mimes:pdf'],

            // 'email' => ['required', 'unique:users'],
            // 'password' => ['required', 'confirmed'],
        ]);

        try {
            return DB::transaction(function () use ($validated) {
                $user = User::create([
                    'name' => $validated['name'],
                    'email' => $validated['phone'] . '@jjmbrain.in',
                    'email_verified_at' => now(),
                    'password' => bcrypt('secret'),
                    'role' => 'jal-mitra',
                    'phone' => $validated['phone'],
                    'doj' => $validated['doj'],
                ]);

                $user->divisions()->sync($this->scheme->division_id);
                $user->districts()->sync($this->scheme->district_id);

                if ($validated['joining_document']) {
                    $user->update([
                        'joining_document' => $validated['joining_document']->storePublicly('/', 'uploads'),
                    ]);
                }

                $this->scheme->updateQuietly([
                    'user_id' => $user->id,
                ]);

                $this->scheme->schemeActivity()->create([
                    'user_id' => auth()->id(),
                    'scheme_id' => $this->scheme->id,
                    'activity_type' => 'jm_assigned',
                    'content' => 'Scheme Jal-Mitra Assigned',
                ]);

                $this->emit('refreshData');

                $this->dispatchBrowserEvent('hide-modal');

                $this->notify('Jalmitra user saved.');
            });
        } catch (\Exception $e) {
            $this->bannerMessage('Something went wrong. Try again.' . $e->getMessage(), 'danger');
        }
    }

    public function updateExistingUser()
    {
        $validated = $this->validate([
            'existingUserId' => ['required', 'exists:users,id'],
            'doj' => ['required'],
            'joining_document' => ['required', 'mimes:pdf']
        ]);

        $jm = User::findOrFail($validated['existingUserId']);
        if(! $jm){
            return $this->notify('User does Not Exists');
        }
        try {
            return DB::transaction(function () use ($validated, $jm) {

                $jm->divisions()->sync($this->scheme->division_id);
                $jm->districts()->sync($this->scheme->district_id);

                if ($validated['joining_document']) {

                    if ($jm->joining_document && Storage::disk('uploads')->exists($jm->joining_document)) {
                        Storage::disk('uploads')->delete($jm->joining_document);
                    }

                    $jm->update([
                        'joining_document' => $validated['joining_document']->storePublicly('/', 'uploads'),
                    ]);
                }

                $this->scheme->updateQuietly([
                    'user_id' => $jm->id,
                ]);

                $this->scheme->schemeActivity()->create([
                    'user_id' => auth()->id(),
                    'scheme_id' => $this->scheme->id,
                    'activity_type' => 'existing_jm_updated',
                    'content' => 'Scheme Jal-Mitra Updated',
                ]);

                $this->emit('refreshData');

                $this->dispatchBrowserEvent('hide-modal');

                $this->notify('Jalmitra user assigned.');
            });
        } catch (\Exception $e) {
            $this->bannerMessage('Something went wrong. Try again.' . $e->getMessage(), 'danger');
        }
    }

    public function getJalmitrasProperty()
    {
        $result = User::where('role', 'jal-mitra')->active()->whereRelation('divisions', 'division_id', $this->scheme->division_id)->doesntHave('scheme')->orderBy('name')->select('id', 'name', 'phone')->get();
        return collect($result)->map(fn($item) => [
            "label" => $item->name . ' (' . $item->phone . ')',
            "value" => $item->id,
        ])->all();
    }

    public function getSchemeProperty()
    {
        return Scheme::with('user')->findOrFail($this->schemeId);
    }

    public function render()
    {
        return view('livewire.schemes.jalmitra-user', [
            'jalmitraUser' => $this->scheme->user,
        ]);
    }
}
