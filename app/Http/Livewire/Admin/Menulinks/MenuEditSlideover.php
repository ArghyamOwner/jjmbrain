<?php

namespace App\Http\Livewire\Admin\Menulinks;

use Livewire\Component;
use App\Models\Menulink;
use App\Traits\WithSlideover;
use Illuminate\Validation\Rule;

class MenuEditSlideover extends Component
{
    use WithSlideover;

    public $menulink;
    
    protected $listeners = [
        'openMenuEditSlideover' => 'openEditModal'
    ];

    protected $validationAttributes = [
        'menulink.name' => 'name',
        'menulink.slug' => 'slug',
        'menulink.parent_id' => 'parent',
        'menulink.link' => 'link',
        'menulink.menu_type' => 'menu type',
    ];

    protected function rules()
    {
        return [
            'menulink.name' => ['required', 'string'],
            'menulink.slug' => ['required',  Rule::unique('menulinks', 'slug')->whereNull('tenant_id')->ignore($this->menulink->id)],
            'menulink.parent_id' => ['nullable', Rule::in(array_merge(array_keys($this->parentlinks), ["no-parent"]))],
            'menulink.link' => ['nullable', 'url'],
            'menulink.menu_type' => ['required', Rule::in($this->menu_types)]
        ];
    }

    public function openEditModal($id)
    {
        $this->resetErrorBag();

        $this->show = true;

        $this->menulink = Menulink::findOrFail($id);
    }

    public function save()
    {
        $this->validate();
 
        $this->menulink->update([
            'name' => $this->menulink->name,
            'slug' => $this->menulink->slug,
            'parent_id' => $this->menulink->parent_id === 'no-parent' ? null : $this->menulink->parent_id,
            'link' => $this->menulink->link,
            'menu_type' => $this->menulink->menu_type,
        ]);
 
        $this->show = false;
        $this->emit('refreshMenus');
        $this->notify('Menu link updated', 'success');
    }

    public function getParentlinksProperty()
    {
        return Menulink::whereNull('parent_id')->pluck('name', 'id')->all();
    }

    public function getMenuTypesProperty()
    {
        return Menulink::menuTypes();
    }
    
    public function render()
    {
        return view('livewire.admin.menulinks.menu-edit-slideover');
    }
}
