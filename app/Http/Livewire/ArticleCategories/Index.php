<?php

namespace App\Http\Livewire\ArticleCategories;

use App\Models\ArticleCategory;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function updateCategoryOrder($orderIds)
    {
        if (count($orderIds)) {
            foreach($orderIds as $order){
                $this->saveCategoryOrder($order);
            }
    
            $this->emit('refreshData');
            $this->notify('Category order updated.');
        }
    }

    protected function saveCategoryOrder($order)
    {
        $slider = ArticleCategory::find($order['value']);
        
        if ($slider) {
            $slider->order = $order['order'];
            $slider->save();
        }
    }

    public function render()
    {
        return view('livewire.article-categories.index', [
            'categories' => ArticleCategory::orderBy('order')->get()
        ]);
    }
}
