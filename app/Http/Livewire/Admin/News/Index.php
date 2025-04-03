<?php

namespace App\Http\Livewire\Admin\News;

use App\Models\News;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Utils\Datatable\Column;

class Index extends Component
{
    use WithPagination;

    public $search;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function resetFilter()
    {
        $this->reset(['search']);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getColumnsProperty()
    {
        return [
            Column::make('Title')
                ->key('title')
                ->toArray(),
            
            Column::make('Category')
                ->key('category')
                ->toArray(),
  
            Column::make('Status')
                ->theme('badge')
                ->key('status')
                ->colors([
                    'unpublished' => 'text-yellow-600 bg-yellow-100',
                    'published' => 'text-green-600 bg-green-100',
                ])
                ->toArray(),
  
            Column::make('Published on')
                ->key('published_at')
                ->format(function ($news) {
                    return $news->created_at->toFormattedDateString();
                })
                ->toArray(),
            
            Column::make('Action')
                ->format(function ($news) {
                    return Str::generateLink(route('admin.news.edit', $news->id), 'Edit');
                })
                ->toArray(),
        ];
    }

    public function render()
    {
        return view('livewire.admin.news.index', [
            'allNews' => News::query()
                ->when($this->search != '', fn ($query) => $query->whereLike(['title'], $this->search))
                ->latest('id')
                ->fastPaginate(),
            'columns' => $this->columns
        ]);
    }
}
