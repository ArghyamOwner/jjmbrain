<?php

namespace App\Http\Livewire\FieldTestKits;

use App\Models\FieldTestKit;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.field-test-kits.index', [
            'fieldtestkits' => FieldTestKit::query()
                ->with('division', 'district', 'block', 'panchayat', 'village', 'user')
                ->when(!(auth()->user()->isAdministratorOrSuper() || auth()->user()->isLabHo() || auth()->user()->isLabAdmin()), function ($query) {
                    $query->whereIn('district_id', auth()->user()->districts()->pluck('district_id'));
                })
                ->latest('id')
                ->fastPaginate(),
        ]);
    }
}
