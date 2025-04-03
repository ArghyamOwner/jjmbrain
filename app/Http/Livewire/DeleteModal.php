<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DeleteModal extends Component
{
    public $showDeleteModal = false;

    public $deleteModalId;
    public $deleteModalTitle;
    public $deleteModalContent;
    public $deleteModalValue;
    public $confirmationButtonTile;

    protected function getListeners()
    {
        return array_merge($this->listeners, [
            'showDeleteModal',
        ]);
    }
    
    public function showDeleteModal($id, string $title, string $content, string $value = null, string $buttonTitle="Yes, delete")
    {
        $this->resetErrorBag();

        $this->deleteModalId = $id;
        $this->deleteModalTitle = $title;
        $this->deleteModalContent = $content;
        $this->deleteModalValue = $value;
        $this->confirmationButtonTile = $buttonTitle;

        $this->showDeleteModal = true;
    }

    public function closeDeleteModal()
    {
        $this->resetErrorBag();
        $this->showDeleteModal = false;
    }

    public function render()
    {
        return view('livewire.delete-modal');
    }
}
