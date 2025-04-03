<?php

namespace App\Console\Commands;

use App\Models\Scheme;
use Illuminate\Console\Command;

class AttachChildWucsToParentSchemes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:attach-child-wucs-to-parent-schemes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $parentSchemes = Scheme::query()
            ->parent()
            ->doesntHave('wucs')
            ->with('childSchemeWithWucs:id,name,parent_id', 'childSchemeWithWucs.wucs:id')
            ->whereHas('childSchemeWithWucs.wucs')
            ->get();

        foreach ($parentSchemes as $parentScheme) {
            $wucIds = $parentScheme->childSchemeWithWucs->flatMap(function ($childScheme) {
                return $childScheme->wucs->pluck('id');
            })->unique()->toArray();

            if (!empty($wucIds)) {
                $parentScheme->wucs()->attach($wucIds);
            }
        }
    }
}
