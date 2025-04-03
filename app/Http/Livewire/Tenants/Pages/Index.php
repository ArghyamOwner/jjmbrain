<?php

namespace App\Http\Livewire\Tenants\Pages;

use App\Models\Page;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
 
    protected $listeners = [
        'refreshPage' => '$refresh'
    ];

    protected $queryString = [
        'search' => ['except' => '']
    ];
 
    public function render()
    {
        return view('livewire.tenants.pages.index', [
            'pages' => Page::query()
                // ->when($this->search != '', fn($query) => $query->whereLike('title', $this->search))
                ->latest('id')
                ->simplePaginate()
                ->withQueryString()
                ->through(fn ($page) => [
                    'id' => $page->id,
                    'summary' => $page->summary,
                    'title' => $page->title,
                    'slug' => url($page->slug),
                    'created_at' => $page->created_at->toFormattedDateString(),
                    'updated_at' => $page->updated_at->toFormattedDateString(),
                    'published_at' => $page->published_at->toFormattedDateString(),
                ])
        ]);
    }
}
