<?php

namespace App\Providers;

use App\Models\Tenant;
use Livewire\Livewire;
use NumberFormatter;
use App\Models\Setting;
use App\Models\Menulink;
use App\Services\TenantManager;
use Illuminate\Support\Str;
use App\Services\PermissionService;
// use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('permission', function () {
            return new PermissionService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Livewire::addPersistentMiddleware([
    
        ]);

        if (!app()->runningInConsole()) {
            // In Laravel, the session is handled by the StartSession middleware 
            // that runs after all service providers have booted. 
            // To share a session variable with all views, use a view composer in your service provider. 
            // The callback passed to the composer will be called when the view is rendered, 
            // after the StartSession has already executed.
            // view()->composer('*', function ($view) {
            //     $view->with('siteSettings', $this->siteSettings());    
            //     $view->with('menulinks', $this->siteMenus());    
            // }); 
        }

        Str::macro('amountInINR', function ($value) {
            if ($value > 10000000) {
                $INR = $value / 10000000;
                $ext = $INR == 1 ? "crore" : "crores";
                $INR = number_format($value / 10000000, 2) . ' ' . $ext;
            } elseif ($value > 100000) {
                $INR = $value / 100000;
                $ext = $INR == 1 ? "lakh" : "lakhs";
                $INR = number_format($value / 100000, 2) . ' ' . $ext;
            } elseif ($value > 1000) {
                $INR = $value / 1000;
                $ext = $INR == 1 ? "lakh" : "K";
                $INR = number_format($value / 1000, 2) . ' ' . $ext;
            } else {
                $INR = number_format($value, 2);
            }
            return str_replace(".00", "", $INR);
        });
    }

    // protected function siteMenus()
    // {
    //     return Cache::rememberForever('menulinks.admin', fn () => Menulink::query()
    //         ->with('children')
    //         ->whereNull('parent_id')
    //         ->where('menu_type', Menulink::MENULINK_MAIN_MENU_ONLY)
    //         ->orderBy('order')
    //         ->get()
    //     );
    // }

    // protected function siteSettings()
    // {
    //     return Cache::rememberForever('settings.admin', fn () => Setting::first([ 
    //         'contact_email',
    //         'contact_phone',
    //         'social_links',
    //         'metrics',
    //         'working_hours',
    //         'address',
    //         'latitude',
    //         'longitude',
    //         'meta_title',
    //         'meta_description',
    //         'logo'
    //     ]));
    // }
}
