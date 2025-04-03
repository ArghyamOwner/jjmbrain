<?php

namespace App\Http\Livewire\News;

use App\Models\News;
use Livewire\Component;
use App\Traits\WithMemoized;

class FeedLike extends Component
{
    use WithMemoized;

    public string $newsId;
    public int $count;
    public bool $newsIsLiked = false;

    public function mount()
    {
        $this->count = $this->news()->likes_count;
    }

    protected function news()
    {
        return $this->memoized(fn () => News::findOrFail($this->newsId));
    }

    public function like(): void
    {
        if ($this->news()->isLiked()) {
            $this->news()->removeLike();

            $this->count--;
        } else {
            $this->news()->likes()->create([
                'user_id' => auth()->id(),
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);

            $this->count++;
        }
    }

    public function render()
    {
        $this->newsIsLiked = $this->news()->isLiked();

        return view('livewire.news.feed-like');
    }
}
