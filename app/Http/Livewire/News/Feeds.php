<?php

namespace App\Http\Livewire\News;

use App\Models\News;
use Livewire\Component;
use Livewire\WithPagination;

class Feeds extends Component
{
    use WithPagination;

    public $perPage = 10;

    public $name;
    public $email;
    public $photo;
    public $bio;

    public function getUserProperty()
    {
        return auth()->user();
    }

    public function userInfo()
    {
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->photo = $this->user->photo_url;
        $this->bio = $this->user->bio;
    }

    public function getCurrentUserInfo()
    {
        return [
            'name' => $this->user->name,
            'email' => $this->user->email,
            'photo' => $this->user->photo_url,
            'bio' => $this->user->bio,
        ];
    }

    public function render()
    {
        return view('livewire.news.feeds', [
            'feeds' => News::query()
                ->with('user')
                ->whereNull('deactivated_at')
                ->latest('id')
                ->simplePaginate($this->perPage),
        ]);
    }
}
