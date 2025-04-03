<?php

namespace App\Http\Livewire\Article;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    protected $queryString = [
        'search' => ['except' => '']
    ];
    
    public function updatedSearch()
    {
        return $this->resetPage();
    }

    public function render()
    {
        return view('livewire.article.index', [
            'articles' => Article::query()
                ->when($this->search != '', fn($query) => $query->whereLike('title', $this->search))
                ->latest('id')
                ->fastPaginate()
        ]);
    }
}
