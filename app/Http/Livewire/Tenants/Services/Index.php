<?php

namespace App\Http\Livewire\Tenants\Services;

use App\Models\Service;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Utils\Datatable\Column;

class Index extends Component
{
    public $status;

    protected $listeners = [
        'refreshServices' => '$refresh'
    ];

    public function getColumnsProperty()
    {
        return [
            Column::make('Title')
                ->key('title')
                ->toArray(),

            Column::make('Link')
                ->key('link')
                ->toArray(),

            //  Column::make('Actions')
            //     ->theme('actions')
            //     ->format(function ($service) {
            //         return [
            //             'edit' => [
            //                 route('tenant.news.show', $service->id)
            //             ],
            //             'destroy' => [
            //                 'App.Models.Service',
            //                 $service->id,
            //                 'Confirm Delete?',
            //                 'Are you sure?'
            //             ]
            //         ];
            //     })
            //     ->toArray(),
  
            // Column::make('Status')
            //     ->theme('badge')
            //     ->key('status')
            //     ->colors([
            //         'unpublished' => 'text-yellow-600 bg-yellow-100',
            //         'published' => 'text-green-600 bg-green-100',
            //     ])
            //     ->toArray(),

            Column::make('Status')
                ->format(fn ($service) => view('livewire.tenants.services._status-update', compact('service')))
                ->toArray(),

            Column::make('Edit')
                ->format(fn ($service) => view('livewire.tenants.services._service-edit-modal', compact('service')))
                ->toArray(),
        ];
    }
    
    public function render()
    {
        return view('livewire.tenants.services.index', [
            'services' => Service::simplePaginate(15),
            'columns' => $this->columns
        ]);
    }
}
