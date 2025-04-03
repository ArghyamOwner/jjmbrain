<?php

namespace App\Console\Commands;

use App\Enums\JalshalaStatus;
use App\Models\Block;
use App\Models\District;
use App\Models\EducationBlock;
use App\Models\Jalshala;
use App\Models\JalshalaStatics;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class JalshalaStaticstics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:jalshala-staticstics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    protected $types = ['phase_I', 'phase_II']; 
    public function handle()
    {
        foreach ($this->types as $type) {
            $districts = District::all();
            $educationblocks = [];
            foreach ($districts as $district) {
                    $educationblocks[] = EducationBlock::query()
                    ->with([
                        $type === 'phase_I' ? 'phaseIOrganisedJalshalas' : 'phaseIIOrganisedJalshalas',
                    ])->withCount([
                        $type === 'phase_I' ? 'phaseIOrganisedJalshalas' : 'phaseIIOrganisedJalshalas',
                        $type === 'phase_I' ? 'phaseIPlannedJalshalas' : 'phaseIIPlannedJalshalas',
                    ])
                    ->where('district_id', $district->id)
                    ->whereRelation('jalshalas', 'type', $type)
                    ->orderBy('block_name')
                    ->lazy();
            }
            $blocksStats = [];
            foreach ($educationblocks as $educationblock) {
                foreach ($educationblock as $edub) {
                    $jaldoot_count = $edub->jalshalas()
                    ->where('type', $type)
                    ->with('jalshalaSchools.jaldoots')
                    ->lazy()
                    ->flatMap(function ($jalshala) {
                        return $jalshala->jalshalaSchools->flatMap(fn ($school) => $school->jaldoots);
                    });
                    $jaldootParticipated = $edub->{$type === 'phase_I' ? 'phaseIOrganisedJalshalas' : 'phaseIIOrganisedJalshalas'}
                        ->sum('total_student_attended'); 
                    $blocksStats[] = [
                        'id' => (string) Str::ulid(),
                        'block_name' => '',
                        'conducted' => $edub[$type === 'phase_I' ? 'phase_i_organised_jalshalas_count' : 'phase_i_i_organised_jalshalas_count'] ?? 0,
                        'pending' => $edub[$type === 'phase_I' ? 'phase_i_planned_jalshalas_count' :'phase_i_i_planned_jalshalas_count' ] ?? 0,
                        'pwss_mapped' => $edub->jalshalas()->where('type', $type)->with('schemes')->get()->pluck('schemes.*')->flatten()->unique()->count(),
                        'school_mapped' => $edub->jalshalas()->where('type', $type)->with('jalshalaSchools')->get()->pluck('jalshalaSchools.*')->flatten()->unique()->count(),
                        'jaldoot_mapped' => $jaldoot_count->count(),
                        'jaldoot_participated' => $jaldootParticipated,
                        'type' => $type,
                        'district_id' => $edub['district_id'] ?? 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
            JalshalaStatics::insert($blocksStats);
        }
    }
}
