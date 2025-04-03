<?php

namespace App\Http\Livewire;

use App\Models\Article;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;

class HelpSearch extends Component
{
    public $query;
 
    public function searchHelp($value)
    {
        $result = Article::query()
            ->with(['category'])
            // ->whereFulltext(['title', 'content'], $value)
            ->when($value != '', fn($query) => $query->whereLike(['category.id','title', 'content'], $value))
            ->limit(5)
            ->latest('id')
            ->get()
            ->map(fn($item) => [
                'label' => Str::headline($item->category->name) . ': ' . $item->title,
                'value' => $item->id
            ])
            ->all();

        $this->emit('result-found-search-help', $result);
    }
    public function render()
    {
        return view('livewire.help-search');
    }
}
