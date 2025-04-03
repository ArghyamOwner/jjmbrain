<?php

namespace App\View\Components;

use App\Enums\NewsCategory;
use App\Models\News as NewsModel;
use Illuminate\View\Component;

class News extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(protected $limit = 3)
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
        return view('components.app.news', [
            'news' => NewsModel::published()
                ->where('category', '!=', NewsCategory::EVENTS->value)
                ->latest('id')
                ->limit($this->limit)
                ->get()
        ]);
    }
}
