<?php

namespace App\Http\Livewire\Surveys;

use App\Models\Beneficiary;
use App\Models\Campaign;
use App\Models\Question;
use App\Models\Survey;
use App\Models\User;
use App\Traits\InteractsWithBanner;
use Livewire\Component;

class Create extends Component
{
    use InteractsWithBanner;

    public $userName;
    public $userEmail;
    public $userPhone;
    public $userId;
    public $userRole;
    public $answer = [];

    public function mount(User $user)
    {
        $this->userId = $user->id;
        $this->userName = $user->name;
        $this->userEmail = $user->email;
        $this->userPhone = $user->phone;
        $this->userRole = $user->role;
    }

    public function save()
    {
        $validatedData = $this->validate([
            'answer' => ['required', 'array', 'min:2'],
            'answer.*' => ['required'],
        ]);

        Survey::create([
            'user_id' => $this->userId,
            'answer' => $validatedData['answer'],
            'campaign_id' => $this->campaign,
            'called_by' => auth()->id(),
        ]);

        $this->banner('Survey details saved.');

        return redirect()->route('outbound');
    }

    public function getCampaignProperty()
    {
        return Campaign::where('status', Campaign::STATUS_ACTIVE)->first()['id'];
    }

    public function getQuestionsProperty()
    {
        return Question::where('campaign_id', $this->campaign)->get();
    }

    public function render()
    {
        return view('livewire.surveys.create');
    }
}
