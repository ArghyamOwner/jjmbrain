<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Salary;
use App\Models\SchemeActivity;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Show extends Component
{
    use WithFileUploads;

    public $userId;
    public $document;

    protected $listeners = [
        'refreshData' => '$refresh',
    ];

    public function mount($userId)
    {
        $this->userId = $userId;
    }

    public function resetPassword()
    {
        $this->user->update([
            'password' => bcrypt('secret'),
        ]);

        $this->dispatchBrowserEvent('hide-modal');
        $this->emit('refreshData');
        $this->notify('Password has been reset to default.');
    }

    public function blockUser()
    {
        $this->user->update([
            'blocked_at' => now(),
            'blocked_by' => Auth::id(),
        ]);

        SchemeActivity::create([
            'user_id' => auth()->id(),
            'activity_type' => 'user_blocked',
            'content' => 'Blocked',
            'feedable_type' => get_class($this->user),
            'feedable_id' => $this->user->id,
        ]);

        $this->dispatchBrowserEvent('hide-modal');
        $this->emit('refreshData');
        $this->notify('User has been blocked.');
    }

    public function unblockUser()
    {
        $this->user->update([
            'blocked_at' => null,
            'blocked_by' => Auth::id(),
        ]);

        SchemeActivity::create([
            'user_id' => auth()->id(),
            'activity_type' => 'user_blocked',
            'content' => 'Un-Blocked',
            'feedable_type' => get_class($this->user),
            'feedable_id' => $this->user->id,
        ]);

        $this->dispatchBrowserEvent('hide-modal');
        $this->emit('refreshData');
        $this->notify('User has been unblocked.');
    }

    public function update()
    {
        $validated = $this->validate([
            'document' => ['required', 'mimes:pdf', 'max:2048'],
        ]);

        $this->user->update([
            'joining_document' => $validated['document']->storePublicly('/', 'uploads'),
        ]);

        $this->reset('document');

        $this->closeModal();

        $this->emit('refreshData');

        $this->notify('Updated.');
    }

    public function getUserProperty()
    {
        return User::query()
            ->with('districts', 'divisions', 'blocks', 'subdivisions', 'offices', 'blockedBy:id,name', 'panchayat:id,panchayat_name')
            ->findOrFail($this->userId);
    }

    public function render()
    {
        return view('livewire.admin.users.show', [
            'user' => $this->user,
            'salaries' => Salary::query()->where('user_id', $this->userId)->orderBy('year')->get(),
            // 'salaries' => Salary::where('user_id', $this->userId)
            //             ->selectRaw('year')
            //             ->selectRaw('GROUP_CONCAT(month ORDER BY year, month) as months')
            //             ->groupBy('year')
            //             ->orderBy('year', 'asc')
            //             ->get(),
        ]);
    }
}
