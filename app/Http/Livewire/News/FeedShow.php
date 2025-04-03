<?php

namespace App\Http\Livewire\News;

use App\Models\News as NewsModel;
use Livewire\Component;

class FeedShow extends Component
{
    public $news;

    public function mount(NewsModel $news)
    {
        $this->news = $news->loadMissing('user');    
    }

    public function render()
    {
        return view('livewire.news.feed-show')
            ->layoutData([
                'title' => $this->news->title,
                'metaTitle' => $this->news->title,
                'metaDescription' => $this->news->summary,
            ]);
    }
}
