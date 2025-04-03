<?php

namespace App\Repositories;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingRepository
{
    public function getKey(int $tenantId, string $key)
    {
        return Cache::remember("settings.{$tenantId}.{$key}", 60, function () use ($tenantId, $key) {
            return Setting::where('tenant_id', $tenantId)
                ->where('key', $key)
                ->first();
        });
    }

	public function get($tenantId)
    {
        return Cache::remember("settings.{$tenantId}", 60, function () use ($tenantId) {
            return Setting::where('tenant_id', $tenantId)->get();
        });
    }

    public function set(int $tenantId, string $key, $value)
    {
        Setting::updateOrCreate(
            ['tenant_id' => $tenantId, 'key' => $key],
            ['value' => $value]
        );

        Cache::forget("settings.{$tenantId}.{$key}");
    }
}