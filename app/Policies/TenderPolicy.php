<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Tender;
use Illuminate\Auth\Access\HandlesAuthorization;

class TenderPolicy
{
    use HandlesAuthorization;

    public function update(User $user, $tender)
    {
        $tender = Tender::query()
            ->where('department_id', $user->department_id)
            ->findOrFail($tender);
            
        return $tender ? true : false;
    }
}
