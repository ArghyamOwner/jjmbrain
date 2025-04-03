<?php

namespace App\Http\Livewire\News;

use App\Models\News;
use Livewire\Component;

class LatestFiveFeeds extends Component
{
    public $feeds;

    public function getFeeds()
    {
        $this->feeds = News::query()
            ->with('user')
            ->whereNull('deactivated_at')
            ->latest('id')
            ->limit(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.news.latest-five-feeds');
    }
}
