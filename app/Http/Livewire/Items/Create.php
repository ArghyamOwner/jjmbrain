<?php

namespace App\Http\Livewire\Items;

use App\Models\Item;
use Livewire\Component;
use App\Enums\ItemCategory;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Traits\InteractsWithBanner;
use Illuminate\Validation\Rules\Enum;

class Create extends Component
{
    use WithFileUploads;
    use InteractsWithBanner;

    public $category;
    public $itemName;
    public $itemCode;
    public $itemType;
    public $itemImage;
    public $itemDescription;
    public $natureOfUse;
    public $hazardLevel;
    public $unit;

    public function save()
    {
        $validated = $this->validate([
            'category' => ['required', new Enum(ItemCategory::class)],
            'itemName' => ['required', Rule::unique('items', 'item_name')],
            'itemCode' => ['required', Rule::unique('items', 'item_code')],
            'itemType' => ['required', Rule::in(['Consumable', 'Non-consumable'])],
            'itemImage' => ['nullable', 'image', 'max:2024'],
            'itemDescription' => ['required'],
            'natureOfUse' => ['nullable'],
            'hazardLevel' => ['nullable'],
            'unit' => ['nullable'],
        ]);

        $item = Item::create([
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
            $item->update([
                'item_image' => $validated['itemImage']->storePublicly('/', 'uploads')
            ]);
        }

        $this->banner('New item added.');

        return redirect()->route('items');
    }


    public function getItemTypesProperty()
    {
        return ItemCategory::cases();
    }

    public function render()
    {
        return view('livewire.items.create');
    }
}
