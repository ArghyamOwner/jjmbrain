<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class TenantOwnedScope implements Scope 
{
    public function apply(Builder $builder, Model $model) 
	{
        if (session()->has('tenant_id')) {
            $builder->where('tenant_id', session('tenant_id'));
        } else {
            $builder->whereNull('tenant_id');
        }
    }
    
    public function extend(Builder $builder) 
	{
        $this->addWithoutTenancy($builder);
    }
    
    protected function addWithoutTenancy(Builder $builder) 
	{
        $builder->macro('withoutTenancy', function (Builder $builder) {
            return $builder->withoutGlobalScope($this);
        });
    }
}