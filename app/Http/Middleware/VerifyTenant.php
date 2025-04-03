<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\TenantManager;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class VerifyTenant
{
     /**
    * @var App\Services\TenantManager
    */
    protected $tenantManager;
    
    public function __construct(TenantManager $tenantManager)
    {
        $this->tenantManager = $tenantManager;
    }
    
    public function handle(Request $request, Closure $next)
    {
        $host = $request->getHost();
    
        $pos = strpos($host, config('app.tenant_domain'));
 
        if ($this->tenantManager->loadTenant($pos !== false ? substr($host, 0, $pos - 1) : $host, $pos !== false)) {
            // || config('app.tenant_domain') === $host
            // Append domain and tenant to the Request object
            // for easy retrieval in the application.
            // $request->merge([
            //     'domain' => $host,
            //     'tenant' => $this->tenantManager->getTenant()->name,
            //     'tenantId' => $this->tenantManager->getTenant()->id
            // ]);

            session()->put('tenant_id', $this->tenantManager->getTenant()->id);

            // Share tenant data with your views
            View::share('tenantHost', $host);
            View::share('mainDomainHost', config('app.url'));
            View::share('tenantId', $this->tenantManager->getTenant()->id);
            View::share('tenantName', $this->tenantManager->getTenant()->name);
            View::share('tenantUlbId', $this->tenantManager->getTenant()->ulb_id);

            // // Get all tenant related settings
            // $settings = Cache::rememberForever("settings.{$this->tenantManager->getTenant()->id}", function () {
            //     return DB::table('settings')->where('tenant_id', $this->tenantManager->getTenant()->id)->get();
            // });

            // $config = [];
    
            // foreach ($settings as $setting) {
            //     $config[$setting->key] = $setting->value;
            // }

            // View::share('tenantSettings', $config);
            
            return $next($request);
        }
    
        throw new NotFoundHttpException;
    }
}
