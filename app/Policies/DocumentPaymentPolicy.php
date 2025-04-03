<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Tender;
use App\Models\DocumentPayment;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocumentPaymentPolicy
{
    use HandlesAuthorization;

    public function view(User $user, $tender)
    {
        $documentPayment = DocumentPayment::where('tender_id', $tender)
            ->where('user_id', $user->id)
            ->first();
        
        $tenderFound = Tender::findOrFail($tender); 

        return ($tenderFound && $tenderFound->tender_cost == 0.00) || $documentPayment ? true : false;
    }
}
