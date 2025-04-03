<?php

namespace App\Http\Livewire\Tenants\Menulinks;

use Livewire\Component;
use App\Models\Menulink;
use Illuminate\Support\Str;
use App\Traits\WithSlideover;
use Illuminate\Validation\Rule;

class MenuCreateSlideover extends Component
{
    use WithSlideover;

    public $name;
    public $slug;
    public $parent_id;
    public $menu_type;

    protected $validationAttributes = [
        'name' => 'name',
        'slug' => 'slug',
        'parent_id' => 'parent',
        'menu_type' => 'menu type',
    ];


    public function mount()
    {
        $this->menu_type = Menulink::MENULINK_MAIN_MENU_ONLY;
    }

    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function getMenuTypesProperty()
    {
        return Menulink::menuTypes();
    }

    public function getParentlinksProperty()
    {
        return Menulink::whereNull('parent_id')->pluck('name', 'id')->all();
    }

    public function save()
    {
        $this->validate([
            'name' => ['required', 'string'],
            'slug' => ['required',  Rule::unique('menulinks', 'slug')->where('tenant_id', session('tenant_id'))],
            'parent_id' => ['nullable', Rule::in(array_merge(array_keys($this->parentlinks), ["no-parent"]))],
            'menu_type' => ['required', Rule::in($this->menu_types)]  
        ]);

        Menulink::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'parent_id' => $this->parent_id,
            'menu_type' => $this->menu_type,
            'order' => MenuLink::whereNull('parent_id')->max('order') + 1
        ]);
    
        $this->name = '';
        $this->slug = '';
 
        $this->emit('refreshMenus');
        $this->notify('Menu link saved.');

        $this->close();
    }
    
    public function render()
    {
        return view('livewire.tenants.menulinks.menu-create-slideover');
    }
}
