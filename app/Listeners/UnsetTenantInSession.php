<?php

namespace App\Listeners;

class UnsetTenantInSession
{
    public function handle($event)
    {
        session()->remove('tenant');
    }
}
