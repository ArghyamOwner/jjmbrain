<?php

namespace App\Http\Livewire\Admin\Menulinks;

use Livewire\Component;
use App\Models\Menulink;

class Index extends Component
{
    public $name;
    public $slug;
    public $parent_id;
    public $menu_type;

    protected $listeners = [
        'refreshMenus' => '$refresh'
    ];

    public function mount()
    {
        $this->menu_type = Menulink::MENULINK_MAIN_MENU_ONLY;
    }

    public function updateMenuGroupOrder($orderIds)
    {
        foreach($orderIds as $order){
            $this->saveMenu($order);
        }

        $this->emit('$refresh');
        $this->notify('Menu link order updated.');
    }

    public function updateLinksOrder($orderIds)
    {
        foreach($orderIds as $order) {
            $this->saveMenu($order);

            // Children
            if (count($order['items'])) {
                foreach($order['items'] as $item) {
                    $this->saveMenu($item, $order['value']);
                }
            }
        }

        $this->emit('$refresh');
        $this->notify('Menu link order updated.');
    }

    public function removeLink($menuId)
    {
        Menulink::findOrFail($menuId)->delete();

        $this->notify('Menu link removed.');
        $this->emit('$refresh');
    }

    public function removeMenu($menuId)
    {
        $menuLink = Menulink::with('children')->findOrFail($menuId);
       
        // $maxParentOrder = MenuLink::whereNull('parent_id')->max('order');
        if ($menuLink->children) {
            $menuLink->children->each(function($child) {
                // $child->order = $maxParentOrder + 1;
                $child->parent_id = null;
                $child->save();
            });
        }

        $menuLink->delete();

        $this->notify('Menu link removed.');
        $this->emit('$refresh');
    }

    protected function saveMenu($order, $parentId = null)
    {
        $menuLink = Menulink::find($order['value']);
        if ($menuLink) {
            $menuLink->order = $order['order'];
            if ($parentId) {
                $menuLink->parent_id = $parentId;
            }
            $menuLink->save();
        }
    }
 
    public function render()
    {
        return view('livewire.admin.menulinks.index', [
            'groups' => Menulink::query()
                ->with('children')
                ->whereNull('parent_id')
                ->whereNull('deactivated_at')
                ->where('menu_type', Menulink::MENULINK_MAIN_MENU_ONLY)
                ->orderBy('order')
                ->get(),

            'footermenulinks' => Menulink::query()
                ->whereNull('parent_id')
                ->whereNull('deactivated_at')
                ->where('menu_type', Menulink::MENULINK_FOOTER_ONLY)
                ->orderBy('order')
                ->get(),

            'othermenulinks' => Menulink::query()
                ->whereNull('parent_id')
                ->whereNull('deactivated_at')
                ->where('menu_type', Menulink::MENULINK_NO_MENU)
                ->orderBy('order')
                ->get(),
        ]);
    }
}
