<?php

namespace App\Http\Livewire\IssueEscalation;

use App\Models\Issue;
use App\Models\IssueEscalation;
use App\Traits\InteractsWithBanner;
use Livewire\Component;

class Index extends Component
{
    use InteractsWithBanner;
    public $issueId;
    public $days;
    public $role;

    // protected $listeners = [
    //     'refreshEscalations' => '$refresh',
    // ];

    public function updateEscalationOrder($items)
    {
        foreach ($items as $item) {
            optional(IssueEscalation::find($item['value']))->update(['level' => (int) $item['order']]);
        }
    }

    public function save()
    {
        $validated = $this->validate([
            'role' => ['required'],
            'days' => ['required'],
        ], [], [
            'role' => 'Actor',
        ]);

        $exists = IssueEscalation::where('issue_id', $this->issueId)->where('role', $validated['role'])->exists();
        if ($exists) {
            return $this->notify('Actor Already Exists', 'error');
        }

        $escalations = IssueEscalation::where('issue_id', $this->issueId)->count();

        IssueEscalation::create([
            'role' => $this->role,
            'issue_id' => $this->issueId,
            'level' => ++$escalations,
            'days' => $this->days,
        ]);

        $totalSla = IssueEscalation::where('issue_id', $this->issueId)->sum('days');

        Issue::where('id', $this->issueId)->first()->update([
            'has_escalation' => Issue::ESCALATION,
            'sla' => $totalSla,
        ]);

        // $this->reset([
        //     'role',
        //     'days',
        // ]);

        // $this->dispatchBrowserEvent('hide-modal');
        // $this->emit('refreshEscalations');
        // $this->notify('Escalation Matrix Added.');
        $this->banner('Escalation Matrix Added.');
        return redirect()->route('issues.show', $this->issueId);
    }

    public function getRolesProperty()
    {
        return collect(config('freshman.roles'))->filter(function ($item, $key) {
            return $key != 'admin' && $key != 'super-admin';
        });
    }

    public function render()
    {
        $escalations = IssueEscalation::where('issue_id', $this->issueId)->orderBy('level')->get();
        return view('livewire.issue-escalation.index', [
            'escalations' => $escalations,
        ]);
    }
}
