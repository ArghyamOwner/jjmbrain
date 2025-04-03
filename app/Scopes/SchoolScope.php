<?php

namespace App\Scopes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class SchoolScope implements Scope 
{
	public function apply(Builder $builder, Model $model) 
	{
        if (Auth::hasUser() && ! Auth::user()->isAdministrator()) {
            $builder->where($model->getTable().'.school_id', '=', Auth::user()->school_id);
        }
    }
}