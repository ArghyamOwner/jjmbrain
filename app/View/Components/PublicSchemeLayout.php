<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PublicSchemeLayout extends Component
{
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = null)
    {
        $this->title = $title ?? null;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.public-scheme', [
            'title' => $this->title
        ]);
    }
}
