<?php

namespace App\View\Components;

use App\Models\Member;
use App\Enums\MemberType;
use Illuminate\View\Component;

class UlbMembers extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.app.ulb-members', [
            'ulbmembers' => Member::where('type', MemberType::ELECTED_MEMBERS->value)->get(),
        ]);
    }
}
