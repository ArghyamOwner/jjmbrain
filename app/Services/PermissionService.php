<?php

namespace App\Services;

use App\Models\User;

class PermissionService
{
    public function has(User $user, string $permission): bool
    {
        return in_array($permission, $user->permissions, true);
    }

    public function hasAll(User $user, array $permissions): bool
    {
        foreach ($permissions as $permission) {
            if (! in_array($permission, $user->permissions, true)) {
                return false;
            }
        }

        return true;
    }

    public function hasAny(User $user, array $permissions): bool
    {
        foreach ($permissions as $permission) {
            if (in_array($permission, $user->permissions, true)) {
                return true;
            }
        }

        return false;
    }
    
    public function give(User $user, array $permissions): PermissionService
    {
        $permissions = array_filter(
            $permissions,
            fn ($permission) => in_array($permission, $this->permissions(), true)
        );
        
        $user->permissions = array_merge($user->permissions ?? [], $permissions);
        
        return $this;
    }

    public function revoke(User $user, array $permissions): PermissionService
    {
        $permissions = array_filter(
            $user->permissions,
            fn ($permission) => !in_array($permission, $permissions, true)
        );
        
        $user->permissions = $permissions;
        
        return $this;
    }
    
    public function clear(User $user): PermissionService
    {
        return $this->revoke($user, $this->permissions());
    }
    
    public function permissions()
    {
        return config('laravel-fresh.permissions');
    }
}
