<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Tender;
use App\Models\EmdPayment;
use App\Models\DocumentPayment;
use App\Enums\RazorpayPaymentStatus;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmdPaymentPolicy
{
    use HandlesAuthorization;

    public function view(User $user, $tender)
    {
        // $documentPayment = DocumentPayment::where('tender_id', $tender)
        //     ->where('user_id', $user->id)
        //     ->whereIn('status', [RazorpayPaymentStatus::AUTHORIZED, RazorpayPaymentStatus::CAPTURED])
        //     ->first();

        // TODO: Also check the
        $tenderEmdPayment = EmdPayment::query()
            ->where('tender_id', $tender)
            ->where('user_id', $user->id)
            ->exists();

        return ! $tenderEmdPayment ? true : false;        
    }
}
