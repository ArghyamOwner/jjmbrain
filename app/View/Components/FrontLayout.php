<?php

namespace App\View\Components;

// use App\Models\Menulink;
use Illuminate\View\Component;

class FrontLayout extends Component
{
    // protected $hasSubDomain;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public ?string $title)
    {
        // $host = request()->getHost();

        // // TODO: Improve this code...
        // if ($host === config('app.tenant_domain')) {
        //     $this->hasSubDomain = false;
        // } else {
        //     $this->hasSubDomain = true;
        // }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.front', [
            'title' => $this->title
        ]);
    }
}
