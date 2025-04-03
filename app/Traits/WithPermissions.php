<?php

namespace App\Traits;

use App\Facades\Permission;

trait WithPermissions
{
    public function hasPermission(string $permission): bool
    {
        return Permission::has($this, $permission);
    }

    public function hasAllPermissions(array $permissions): bool
    {
        return Permission::hasAll($this, $permissions);
    }

    public function hasAnyPermissions(array $permissions): bool
    {
        return Permission::hasAny($this, $permissions);
    }
}
