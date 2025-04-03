<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    // public function viewAny(User $user)
    // {
    //     //
    // }
 
    public function view(User $user, User $model)
    {
        return $user->isAdministratorOrSuper();
    }
 
    public function create(User $user)
    {
        return $user->isAdministratorOrSuper();
    }
 
    public function update(User $user)
    {
        return $user->isAdministratorOrSuper();
    }

    public function delete(User $user)
    {
        return $user->isAdministratorOrSuper();
    }
}
