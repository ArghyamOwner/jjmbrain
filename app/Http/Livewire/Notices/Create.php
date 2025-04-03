<?php

namespace App\Http\Livewire\Notices;

use Livewire\Component;
use App\Enums\NoticeType;
use App\Models\Notice;
use App\Traits\InteractsWithBanner;
use Illuminate\Validation\Rules\Enum;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    use InteractsWithBanner;

    public $title;
    public $description;
    public $role;
    public $type;
    public $document;

    public function save()
    {
        $validatedData = $this->validate([
            'title' => ['required', 'string'],
            'description' => ['required'],
            'role' => ['required'],
            'type' => ['required', new Enum(NoticeType::class)],
            'document' => ['nullable', 'mimes:pdf', 'max:2048']
        ]);

        $notice = Notice::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'role' => $validatedData['role'],
            'type' => $validatedData['type'],
            'user_id' => auth()->id()
        ]);

        if ($this->document) {
            $notice->update([
                'document' => $this->document->storePublicly('/', 'uploads'),
            ]);
        }

        $this->banner('Notice created successfully!');

        return redirect()->route('notices');
    }

    public function getTypesProperty()
    {
        return NoticeType::cases();
    }

    public function getRolesProperty()
    {
        return collect(config('freshman.roles'))->filter(function ($item, $key) {
            return $key != 'admin' && $key != 'super-admin';
        });
    }

    public function render()
    {
        return view('livewire.notices.create');
    }
}
