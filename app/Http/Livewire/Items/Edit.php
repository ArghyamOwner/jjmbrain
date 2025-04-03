<?php

namespace App\Http\Livewire\Items;

use App\Models\Item;
use Livewire\Component;
use App\Enums\ItemCategory;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Traits\InteractsWithBanner;
use Illuminate\Validation\Rules\Enum;

class Edit extends Component
{
    use WithFileUploads;
    use InteractsWithBanner;

    public $itemId;
    public $category;
    public $itemName;
    public $itemCode;
    public $itemType;
    public $itemImage;
    public $itemImageUrl;
    public $itemDescription;
    public $natureOfUse;
    public $hazardLevel;
    public $unit;

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function mount(Item $item)
    {
        $this->itemId = $item->id;

        $this->category = $item->category;
        $this->itemName = $item->item_name;
        $this->itemCode = $item->item_code;
        $this->itemType = $item->type;
        $this->itemImageUrl = $item->itemImageUrl;
        $this->itemDescription = $item->item_description;
        $this->natureOfUse = $item->nature_of_use;
        $this->hazardLevel = $item->hazard_level;
        $this->unit = $item->unit;
    }

    public function save()
    {
        $validated = $this->validate([
            'category' => ['required', new Enum(ItemCategory::class)],
            'itemName' => ['required', Rule::unique('items', 'item_name')->ignore($this->itemId)],
            'itemCode' => ['required', Rule::unique('items', 'item_code')->ignore($this->itemId)],
            'itemType' => ['required', Rule::in(['Consumable', 'Non-consumable'])],
            'itemImage' => ['nullable', 'image', 'max:2024'],
            'itemDescription' => ['required'],
            'natureOfUse' => ['nullable'],
            'hazardLevel' => ['nullable'],
            'unit' => ['nullable'],
        ]);

        $this->item->update([
            'user_id' => auth()->id(),
            'category' => $validated['category'],
            'type' => $validated['itemType'],
            'item_name' => $validated['itemName'],
            'item_code' => $validated['itemCode'],
            'item_description' => $validated['itemDescription'],
            'nature_of_use' => $validated['natureOfUse'],
            'hazard_level' => $validated['hazardLevel'],
            'unit' => $validated['unit'],
        ]);

        if ($validated['itemImage']) {
            $this->item->update([
                'item_image' => $validated['itemImage']->storePublicly('/', 'uploads')
            ]);
        }

        $this->notify('Item updated.');

        $this->emit('refreshData');
    }

    public function getItemProperty()
    {
        return Item::findOrFail($this->itemId);
    }

    public function getItemTypesProperty()
    {
        return ItemCategory::cases();
    }

    public function render()
    {
        return view('livewire.items.edit');
    }
}
