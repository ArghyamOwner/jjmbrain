<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Tender;
use App\Models\Bidding;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class BiddingPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param  \App\Models\User  $user
     * @param  string  $ability
     * @return void|bool
     */
    public function before(User $user, $ability)
    {
        if ($user->isAdministratorOrSuper() or $user->isMaker()) {
            return true;
        }
    }

    public function view(User $user, $tender)
    {
        $bidding = Bidding::where('tender_id', $tender)->where('user_id', $user->id)->first();
 
        return ($user->isCompany() && $bidding) ? false : true;
    }
}
