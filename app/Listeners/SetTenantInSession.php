<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class SetTenantInSession
{
    public function handle(Login $event)
    {
        // session()->put('tenant_id', $event->user->tenant_id);
    }
}
