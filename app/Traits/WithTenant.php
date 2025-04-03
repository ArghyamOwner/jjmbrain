<?php

namespace App\Traits;

use App\Models\Tenant;
// use App\Services\TenantManager;
use App\Scopes\TenantOwnedScope;

trait WithTenant
{
	public static function bootWithTenant() 
	{
        static::addGlobalScope(new TenantOwnedScope);

        if (! app()->runningInConsole()) {
            static::creating(function ($model) {
                // if (! $model->tenant_id && ! $model->relationLoaded('tenant')) {
                //     $model->setRelation('tenant', app(TenantManager::class)->getTenant());
                // }
                // return $model;
                $model->tenant_id = session('tenant_id');
            });
        }
    }

    // public function scopeForTenant($query)
    // {
    //     $host = request()->getHost();

    //     if ($host === config('app.tenant_domain')) {
    //         return $query->whereNull('tenant_id');
    //     } else {
    //         return $query->where('tenant_id', session('tenantId'));
    //     }
    // }
    
    public function tenant() 
	{
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
}
