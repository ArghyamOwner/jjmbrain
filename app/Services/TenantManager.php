<?php

namespace App\Services;

use App\Models\Tenant;

class TenantManager
{
	/*
     * @var null|App\Tenant
     */
	private $tenant;

	public function setTenant(?Tenant $tenant)
	{
		$this->tenant = $tenant;
		return $this;
	}

	public function getTenant(): ?Tenant
	{
		return $this->tenant;
	}

	public function loadTenant(string $identifier, bool $subdomain): bool
	{
		$tenant = Tenant::query()->where($subdomain ? 'subdomain' : 'domain', '=', $identifier)->first();
		
		if ($tenant) {
			$this->setTenant($tenant);
			return true;
		}

		return false;
	}
}
