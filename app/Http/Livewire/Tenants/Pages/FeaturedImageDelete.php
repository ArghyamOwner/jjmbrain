<?php

namespace App\Http\Livewire\Tenants\Pages;

use App\Models\Page;
use App\Http\Livewire\DeleteModal;

class FeaturedImageDelete extends DeleteModal
{
    public function destroy()
    {
        $page = Page::findOrFail($this->deleteModalId);
		$page->featured_image = null;
		$page->save();

        $this->emit('refreshFeaturedImagePage');
        $this->notify('Featured image deleted!');

        $this->closeDeleteModal();
    }
}