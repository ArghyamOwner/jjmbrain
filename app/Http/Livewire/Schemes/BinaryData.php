<?php

namespace App\Http\Livewire\Schemes;

use App\Models\Scheme;
use App\Models\SchemeActivity;
use App\Models\SchemeBinaryData;
use App\Traits\InteractsWithBanner;
use Illuminate\Validation\Rule;
use Livewire\Component;

class BinaryData extends Component
{
    use InteractsWithBanner;

    public $schemeId;

    public $source;
    public $source_date;

    public $tp;
    public $tp_date;

    public $ugr;
    public $ugr_date;

    public $esr;
    public $esr_date;

    public $pump_house;
    public $pump_house_date;

    public $apdcl;
    public $apdcl_date;

    public $internal_connection;
    public $internal_connection_date;

    public $gen_set;
    public $gen_set_date;

    public $lds;
    public $lds_date;

    public $site_development;
    public $site_development_date;

    public $boundary_wall;
    public $boundary_wall_date;

    public $painting;
    public $painting_date;

    public $rwp;
    public $rwp_date;

    public $cwp;
    public $cwp_date;

    public $network;
    public $network_date;

    public $fhtc;
    public $fhtc_date;

    public $trial_run;
    public $trial_run_date;

    public $work_completion;
    public $work_completion_date;

    public $scheme_handover;
    public $scheme_handover_date;

    public $panchayat_verified;
    public $panchayat_verified_date;

    public $preliminary_workorder;
    public $preliminary_workorder_date;

    public $preliminary_activities;
    public $preliminary_activities_date;

    public $formal_workorder;
    public $formal_workorder_date;

    public function mount(Scheme $scheme)
    {
        $this->schemeId = $scheme->id;
    }

    public function createActivity($content, $activityType)
    {
        SchemeActivity::create([
            'user_id' => auth()->id(),
            'scheme_id' => $this->schemeId,
            'activity_type' => $activityType,
            'content' => $content,
            'feedable_type' => get_class(new Scheme()),
            'feedable_id' => $this->schemeId,
        ]);
    }

    public function removeData($type)
    {
        if (!(auth()->user()->isAdministrator() || auth()->user()->isExecutiveEngineer() || auth()->user()->isSectionOfficer())) {
            return $this->notify('You don have permission to delete this data', 'error');
        }

        switch ($type) {
            case ('source'):
                SchemeBinaryData::where('scheme_id', $this->schemeId)->update(
                    [
                        'source' => null,
                        'source_date' => null,
                        'source_updated_by' => null,
                    ]
                );
                $this->createActivity($type, 'scheme_binary_data_deleted');
                $this->notify('Source Details Deleted.', 'error');
                break;

            case ('tp'):
                SchemeBinaryData::where('scheme_id', $this->schemeId)->update(
                    [
                        'tp' => null,
                        'tp_date' => null,
                        'tp_updated_by' => null,
                    ]
                );
                $this->createActivity($type, 'scheme_binary_data_deleted');
                $this->notify('TP details Deleted.', 'error');
                break;

            case ('ugr'):
                SchemeBinaryData::where('scheme_id', $this->schemeId)->update(
                    [
                        'ugr' => null,
                        'ugr_date' => null,
                        'ugr_updated_by' => null,
                    ]
                );
                $this->createActivity($type, 'scheme_binary_data_deleted');
                $this->notify('UGR details Deleted.', 'error');
                break;

            case ('esr'):
                SchemeBinaryData::where('scheme_id', $this->schemeId)->update(
                    [
                        'esr' => null,
                        'esr_date' => null,
                        'esr_updated_by' => null,
                    ]
                );
                $this->createActivity($type, 'scheme_binary_data_deleted');
                $this->notify('ESR details Deleted.', 'error');
                break;

            case ('pump_house'):
                SchemeBinaryData::where('scheme_id', $this->schemeId)->update(
                    [
                        'pump_house' => null,
                        'pump_house_date' => null,
                        'pump_house_updated_by' => null,
                    ]
                );
                $this->createActivity($type, 'scheme_binary_data_deleted');
                $this->notify('Pump House details Deleted.', 'error');
                break;

            case ('apdcl'):
                SchemeBinaryData::where('scheme_id', $this->schemeId)->update(
                    [
                        'apdcl' => null,
                        'apdcl_date' => null,
                        'apdcl_updated_by' => null,
                    ]
                );
                $this->createActivity($type, 'scheme_binary_data_deleted');
                $this->notify('APDCL details Deleted.', 'error');
                break;

            case ('internal_connection'):
                SchemeBinaryData::where('scheme_id', $this->schemeId)->update(
                    [
                        'internal_connection' => null,
                        'internal_connection_date' => null,
                        'internal_connection_updated_by' => null,
                    ]
                );
                $this->createActivity($type, 'scheme_binary_data_deleted');
                $this->notify('Internal Connection details Deleted.', 'error');
                break;

            case ('gen_set'):
                SchemeBinaryData::where('scheme_id', $this->schemeId)->update(
                    [
                        'gen_set' => null,
                        'gen_set_date' => null,
                        'gen_set_updated_by' => null,
                    ]
                );
                $this->createActivity($type, 'scheme_binary_data_deleted');
                $this->notify('Gen Set details Deleted.', 'error');
                break;

            case ('lds'):
                SchemeBinaryData::where('scheme_id', $this->schemeId)->update(
                    [
                        'lds' => null,
                        'lds_date' => null,
                        'lds_updated_by' => null,
                    ]
                );
                $this->createActivity($type, 'scheme_binary_data_deleted');
                $this->notify('LDS details Deleted.', 'error');
                break;

            case ('site_development'):
                SchemeBinaryData::where('scheme_id', $this->schemeId)->update(
                    [
                        'site_development' => null,
                        'site_development_date' => null,
                        'site_development_updated_by' => null,
                    ]
                );
                $this->createActivity($type, 'scheme_binary_data_deleted');
                $this->notify('Site Development details Deleted.', 'error');
                break;

            case ('boundary_wall'):
                SchemeBinaryData::where('scheme_id', $this->schemeId)->update(
                    [
                        'boundary_wall' => null,
                        'boundary_wall_date' => null,
                        'boundary_wall_updated_by' => null,
                    ]
                );
                $this->createActivity($type, 'scheme_binary_data_deleted');
                $this->notify('Boundary Wall details Deleted.', 'error');
                break;

            case ('painting'):
                SchemeBinaryData::where('scheme_id', $this->schemeId)->update(
                    [
                        'painting' => null,
                        'painting_date' => null,
                        'painting_updated_by' => null,
                    ]
                );
                $this->createActivity($type, 'scheme_binary_data_deleted');
                $this->notify('Painting details Deleted.', 'error');
                break;

            case ('rwp'):
                SchemeBinaryData::where('scheme_id', $this->schemeId)->update(
                    [
                        'rwp' => null,
                        'rwp_date' => null,
                        'rwp_updated_by' => null,
                    ]
                );
                $this->createActivity($type, 'scheme_binary_data_deleted');
                $this->notify('RWP details Deleted.', 'error');
                break;

            case ('cwp'):
                SchemeBinaryData::where('scheme_id', $this->schemeId)->update(
                    [
                        'cwp' => null,
                        'cwp_date' => null,
                        'cwp_updated_by' => null,
                    ]
                );
                $this->createActivity($type, 'scheme_binary_data_deleted');
                $this->notify('CWP details Deleted.', 'error');
                break;

            case ('network'):
                SchemeBinaryData::where('scheme_id', $this->schemeId)->update(
                    [
                        'network' => null,
                        'network_date' => null,
                        'network_updated_by' => null,
                    ]
                );
                $this->createActivity($type, 'scheme_binary_data_deleted');
                $this->notify('Network details Deleted.', 'error');
                break;

            case ('fhtc'):
                SchemeBinaryData::where('scheme_id', $this->schemeId)->update(
                    [
                        'fhtc' => null,
                        'fhtc_date' => null,
                        'fhtc_updated_by' => null,
                    ]
                );
                $this->createActivity($type, 'scheme_binary_data_deleted');
                $this->notify('FHTC details Deleted.', 'error');
                break;

            case ('trial_run'):
                SchemeBinaryData::where('scheme_id', $this->schemeId)->update(
                    [
                        'trial_run' => null,
                        'trial_run_date' => null,
                        'trial_run_updated_by' => null,
                    ]
                );
                $this->createActivity($type, 'scheme_binary_data_deleted');
                $this->notify('Trial Run details Deleted.', 'error');
                break;

            case ('work_completion'):
                SchemeBinaryData::where('scheme_id', $this->schemeId)->update(
                    [
                        'work_completion' => null,
                        'work_completion_date' => null,
                        'work_completion_updated_by' => null,
                    ]
                );
                $this->createActivity($type, 'scheme_binary_data_deleted');
                $this->notify('Work Completion details Deleted.', 'error');
                break;

            case ('scheme_handover'):
                SchemeBinaryData::where('scheme_id', $this->schemeId)->update(
                    [
                        'scheme_handover' => null,
                        'scheme_handover_date' => null,
                        'scheme_handover_updated_by' => null,
                    ]
                );
                $this->createActivity($type, 'scheme_binary_data_deleted');
                $this->notify('Scheme Handover details Deleted.', 'error');
                break;

            case ('panchayat_verified'):
                SchemeBinaryData::where('scheme_id', $this->schemeId)->update(
                    [
                        'panchayat_verified' => null,
                        'panchayat_verified_date' => null,
                        'panchayat_verified_updated_by' => null,
                    ]
                );
                $this->createActivity($type, 'scheme_binary_data_deleted');
                $this->notify('Panchayat Verified details Deleted.', 'error');
                break;

            case ('preliminary_workorder'):
                SchemeBinaryData::where('scheme_id', $this->schemeId)->update(
                    [
                        'preliminary_workorder' => null,
                        'preliminary_workorder_date' => null,
                        'preliminary_workorder_updated_by' => null,
                    ]
                );
                $this->createActivity($type, 'scheme_binary_data_deleted');
                $this->notify('Preliminary Workorder details Deleted.', 'error');
                break;

            case ('preliminary_activities'):
                SchemeBinaryData::where('scheme_id', $this->schemeId)->update(
                    [
                        'preliminary_activities' => null,
                        'preliminary_activities_date' => null,
                        'preliminary_activities_updated_by' => null,
                    ]
                );
                $this->createActivity($type, 'scheme_binary_data_deleted');
                $this->notify('Preliminary Activities details Deleted.', 'error');
                break;

            case ('formal_workorder'):
                SchemeBinaryData::where('scheme_id', $this->schemeId)->update(
                    [
                        'formal_workorder' => null,
                        'formal_workorder_date' => null,
                        'formal_workorder_updated_by' => null,
                    ]
                );
                $this->createActivity($type, 'scheme_binary_data_deleted');
                $this->notify('Preliminary Activities details Deleted.', 'error');
                break;

            default:
        }
    }

    public function saveSource()
    {
        $validated = $this->validate([
            'source' => ['required', Rule::in(['yes', 'no'])],
            'source_date' => ['required', 'date'],
        ]);
        SchemeBinaryData::updateOrCreate(
            [
                'scheme_id' => $this->schemeId,
            ],
            [
                'source' => $validated['source'],
                'source_date' => $validated['source_date'],
                'source_updated_by' => auth()->id(),
            ]
        );
        $this->banner('Item-Wise Progress Detail saved.');
    }

    public function saveTp()
    {
        $validated = $this->validate([
            'tp' => ['required', Rule::in(['yes', 'no'])],
            'tp_date' => ['required', 'date'],
        ]);
        SchemeBinaryData::updateOrCreate(
            [
                'scheme_id' => $this->schemeId,
            ],
            [
                'tp' => $validated['tp'],
                'tp_date' => $validated['tp_date'],
                'tp_updated_by' => auth()->id(),
            ]
        );
        $this->banner('Item-Wise Progress Detail saved.');
    }

    public function saveUgr()
    {
        $validated = $this->validate([
            'ugr' => ['required', Rule::in(['yes', 'no'])],
            'ugr_date' => ['required', 'date'],
        ]);
        SchemeBinaryData::updateOrCreate(
            [
                'scheme_id' => $this->schemeId,
            ],
            [
                'ugr' => $validated['ugr'],
                'ugr_date' => $validated['ugr_date'],
                'ugr_updated_by' => auth()->id(),
            ]
        );
        $this->banner('Item-Wise Progress Detail saved.');
    }

    public function saveEsr()
    {
        $validated = $this->validate([
            'esr' => ['required', Rule::in(['yes', 'no'])],
            'esr_date' => ['required', 'date'],
        ]);
        SchemeBinaryData::updateOrCreate(
            [
                'scheme_id' => $this->schemeId,
            ],
            [
                'esr' => $validated['esr'],
                'esr_date' => $validated['esr_date'],
                'esr_updated_by' => auth()->id(),
            ]
        );
        $this->banner('Item-Wise Progress Detail saved.');
    }

    public function savePumpHouse()
    {
        $validated = $this->validate([
            'pump_house' => ['required', Rule::in(['yes', 'no'])],
            'pump_house_date' => ['required', 'date'],
        ]);
        SchemeBinaryData::updateOrCreate(
            [
                'scheme_id' => $this->schemeId,
            ],
            [
                'pump_house' => $validated['pump_house'],
                'pump_house_date' => $validated['pump_house_date'],
                'pump_house_updated_by' => auth()->id(),
            ]
        );
        $this->banner('Item-Wise Progress Detail saved.');
    }

    public function saveApdcl()
    {
        $validated = $this->validate([
            'apdcl' => ['required', Rule::in(['yes', 'no'])],
            'apdcl_date' => ['required', 'date'],
        ]);
        SchemeBinaryData::updateOrCreate(
            [
                'scheme_id' => $this->schemeId,
            ],
            [
                'apdcl' => $validated['apdcl'],
                'apdcl_date' => $validated['apdcl_date'],
                'apdcl_updated_by' => auth()->id(),
            ]
        );
        $this->banner('Item-Wise Progress Detail saved.');
    }

    public function saveInternalConnection()
    {
        $validated = $this->validate([
            'internal_connection' => ['required', Rule::in(['yes', 'no'])],
            'internal_connection_date' => ['required', 'date'],
        ]);
        SchemeBinaryData::updateOrCreate(
            [
                'scheme_id' => $this->schemeId,
            ],
            [
                'internal_connection' => $validated['internal_connection'],
                'internal_connection_date' => $validated['internal_connection_date'],
                'internal_connection_updated_by' => auth()->id(),
            ]
        );
        $this->banner('Item-Wise Progress Detail saved.');
    }

    public function saveGenSet()
    {
        $validated = $this->validate([
            'gen_set' => ['required', Rule::in(['yes', 'no'])],
            'gen_set_date' => ['required', 'date'],
        ]);
        SchemeBinaryData::updateOrCreate(
            [
                'scheme_id' => $this->schemeId,
            ],
            [
                'gen_set' => $validated['gen_set'],
                'gen_set_date' => $validated['gen_set_date'],
                'gen_set_updated_by' => auth()->id(),
            ]
        );
        $this->banner('Item-Wise Progress Detail saved.');
    }

    public function saveLds()
    {
        $validated = $this->validate([
            'lds' => ['required', Rule::in(['yes', 'no'])],
            'lds_date' => ['required', 'date'],
        ]);
        SchemeBinaryData::updateOrCreate(
            [
                'scheme_id' => $this->schemeId,
            ],
            [
                'lds' => $validated['lds'],
                'lds_date' => $validated['lds_date'],
                'lds_updated_by' => auth()->id(),
            ]
        );
        $this->banner('Item-Wise Progress Detail saved.');
    }

    public function saveSiteDevelopment()
    {
        $validated = $this->validate([
            'site_development' => ['required', Rule::in(['yes', 'no'])],
            'site_development_date' => ['required', 'date'],
        ]);
        SchemeBinaryData::updateOrCreate(
            [
                'scheme_id' => $this->schemeId,
            ],
            [
                'site_development' => $validated['site_development'],
                'site_development_date' => $validated['site_development_date'],
                'site_development_updated_by' => auth()->id(),
            ]
        );
        $this->banner('Item-Wise Progress Detail saved.');
    }

    public function saveBoundaryWall()
    {
        $validated = $this->validate([
            'boundary_wall' => ['required', Rule::in(['yes', 'no'])],
            'boundary_wall_date' => ['required', 'date'],
        ]);
        SchemeBinaryData::updateOrCreate(
            [
                'scheme_id' => $this->schemeId,
            ],
            [
                'boundary_wall' => $validated['boundary_wall'],
                'boundary_wall_date' => $validated['boundary_wall_date'],
                'boundary_wall_updated_by' => auth()->id(),
            ]
        );
        $this->banner('Item-Wise Progress Detail saved.');
    }

    public function savePainting()
    {
        $validated = $this->validate([
            'painting' => ['required', Rule::in(['yes', 'no'])],
            'painting_date' => ['required', 'date'],
        ]);
        SchemeBinaryData::updateOrCreate(
            [
                'scheme_id' => $this->schemeId,
            ],
            [
                'painting' => $validated['painting'],
                'painting_date' => $validated['painting_date'],
                'painting_updated_by' => auth()->id(),
            ]
        );
        $this->banner('Item-Wise Progress Detail saved.');
    }

    public function saveRwp()
    {
        $validated = $this->validate([
            'rwp' => ['required', Rule::in(['yes', 'no'])],
            'rwp_date' => ['required', 'date'],
        ]);
        SchemeBinaryData::updateOrCreate(
            [
                'scheme_id' => $this->schemeId,
            ],
            [
                'rwp' => $validated['rwp'],
                'rwp_date' => $validated['rwp_date'],
                'rwp_updated_by' => auth()->id(),
            ]
        );
        $this->banner('Item-Wise Progress Detail saved.');
    }

    public function saveCwp()
    {
        $validated = $this->validate([
            'cwp' => ['required', Rule::in(['yes', 'no'])],
            'cwp_date' => ['required', 'date'],
        ]);
        SchemeBinaryData::updateOrCreate(
            [
                'scheme_id' => $this->schemeId,
            ],
            [
                'cwp' => $validated['cwp'],
                'cwp_date' => $validated['cwp_date'],
                'cwp_updated_by' => auth()->id(),
            ]
        );
        $this->banner('Item-Wise Progress Detail saved.');
    }

    public function saveNetwork()
    {
        $validated = $this->validate([
            'network' => ['required', Rule::in(['yes', 'no'])],
            'network_date' => ['required', 'date'],
        ]);
        SchemeBinaryData::updateOrCreate(
            [
                'scheme_id' => $this->schemeId,
            ],
            [
                'network' => $validated['network'],
                'network_date' => $validated['network_date'],
                'network_updated_by' => auth()->id(),
            ]
        );
        $this->banner('Item-Wise Progress Detail saved.');
    }

    public function saveFhtc()
    {
        $validated = $this->validate([
            'fhtc' => ['required', Rule::in(['yes', 'no'])],
            'fhtc_date' => ['required', 'date'],
        ]);
        SchemeBinaryData::updateOrCreate(
            [
                'scheme_id' => $this->schemeId,
            ],
            [
                'fhtc' => $validated['fhtc'],
                'fhtc_date' => $validated['fhtc_date'],
                'fhtc_updated_by' => auth()->id(),
            ]
        );
        $this->banner('Item-Wise Progress Detail saved.');
    }

    public function saveTrialRun()
    {
        $validated = $this->validate([
            'trial_run' => ['required', Rule::in(['yes', 'no'])],
            'trial_run_date' => ['required', 'date'],
        ]);
        SchemeBinaryData::updateOrCreate(
            [
                'scheme_id' => $this->schemeId,
            ],
            [
                'trial_run' => $validated['trial_run'],
                'trial_run_date' => $validated['trial_run_date'],
                'trial_run_updated_by' => auth()->id(),
            ]
        );
        $this->banner('Item-Wise Progress Detail saved.');
    }

    public function saveWorkCompletion()
    {
        $validated = $this->validate([
            'work_completion' => ['required', Rule::in(['yes', 'no'])],
            'work_completion_date' => ['required', 'date'],
        ]);
        SchemeBinaryData::updateOrCreate(
            [
                'scheme_id' => $this->schemeId,
            ],
            [
                'work_completion' => $validated['work_completion'],
                'work_completion_date' => $validated['work_completion_date'],
                'work_completion_updated_by' => auth()->id(),
            ]
        );
        $this->banner('Item-Wise Progress Detail saved.');
    }

    public function saveSchemeHandover()
    {
        $validated = $this->validate([
            'scheme_handover' => ['required', Rule::in(['yes', 'no'])],
            'scheme_handover_date' => ['required', 'date'],
        ]);
        SchemeBinaryData::updateOrCreate(
            [
                'scheme_id' => $this->schemeId,
            ],
            [
                'scheme_handover' => $validated['scheme_handover'],
                'scheme_handover_date' => $validated['scheme_handover_date'],
                'scheme_handover_updated_by' => auth()->id(),
            ]
        );
        $this->banner('Item-Wise Progress Detail saved.');
    }

    public function savePreliminaryWorkorder()
    {
        $validated = $this->validate([
            'preliminary_workorder' => ['required', Rule::in(['yes', 'no'])],
            'preliminary_workorder_date' => ['required', 'date'],
        ]);
        SchemeBinaryData::updateOrCreate(
            [
                'scheme_id' => $this->schemeId,
            ],
            [
                'preliminary_workorder' => $validated['preliminary_workorder'],
                'preliminary_workorder_date' => $validated['preliminary_workorder_date'],
                'preliminary_workorder_updated_by' => auth()->id(),
            ]
        );
        $this->notify('Item-Wise Progress Detail saved.');
    }

    public function savePreliminaryActivities()
    {
        $validated = $this->validate([
            'preliminary_activities' => ['required', Rule::in(['yes', 'no'])],
            'preliminary_activities_date' => ['required', 'date'],
        ]);
        SchemeBinaryData::updateOrCreate(
            [
                'scheme_id' => $this->schemeId,
            ],
            [
                'preliminary_activities' => $validated['preliminary_activities'],
                'preliminary_activities_date' => $validated['preliminary_activities_date'],
                'preliminary_activities_updated_by' => auth()->id(),
            ]
        );
        $this->notify('Item-Wise Progress Detail saved.');
    }

    public function saveFormalWorkorder()
    {
        $validated = $this->validate([
            'formal_workorder' => ['required', Rule::in(['yes', 'no'])],
            'formal_workorder_date' => ['required', 'date'],
        ]);
        SchemeBinaryData::updateOrCreate(
            [
                'scheme_id' => $this->schemeId,
            ],
            [
                'formal_workorder' => $validated['formal_workorder'],
                'formal_workorder_date' => $validated['formal_workorder_date'],
                'formal_workorder_updated_by' => auth()->id(),
            ]
        );
        $this->notify('Item-Wise Progress Detail saved.');
    }

    public function savePanchayatVerified()
    {
        $validated = $this->validate([
            'panchayat_verified' => ['required', Rule::in(['yes', 'no'])],
            'panchayat_verified_date' => ['required', 'date'],
        ]);
        SchemeBinaryData::updateOrCreate(
            [
                'scheme_id' => $this->schemeId,
            ],
            [
                'panchayat_verified' => $validated['panchayat_verified'],
                'panchayat_verified_date' => $validated['panchayat_verified_date'],
                'panchayat_verified_updated_by' => auth()->id(),
            ]
        );
        $this->banner('Item-Wise Progress Detail saved.');
    }

    public function render()
    {
        $schemeBinaryData = SchemeBinaryData::query()
            ->with([
                'sourceUpdatedBy:name,id',
                'tpUpdatedBy:name,id',
                'ugrUpdatedBy:name,id',
                'esrUpdatedBy:name,id',
                'pumpHouseUpdatedBy:name,id',
                'apdclUpdatedBy:name,id',
                'internalConnectionUpdatedBy:name,id',
                'genSetUpdatedBy:name,id',
                'ldsUpdatedBy:name,id',
                'siteDevelopmentUpdatedBy:name,id',
                'boundaryWallUpdatedBy:name,id',
                'paintingUpdatedBy:name,id',
                'rwpUpdatedBy:name,id',
                'cwpUpdatedBy:name,id',
                'networkUpdatedBy:name,id',
                'fhtcUpdatedBy:name,id',
                'trialRunUpdatedBy:id,name',
                'workCompletionUpdatedBy:id,name',
                'schemeHandoverUpdatedBy:id,name',
                'panchayatVerifiedUpdatedBy:id,name',
                'preliminaryActivitiesUpdatedBy:id,name',
                'preliminaryWorkorderUpdatedBy:id,name',
                'formalWorkorderUpdatedBy:id,name',
            ])
            ->where('scheme_id', $this->schemeId)
            ->first();

        return view('livewire.schemes.binary-data', [
            'sourceUser' => $schemeBinaryData?->sourceUpdatedBy?->name,
            'sourceDate' => $schemeBinaryData?->source_date ? $schemeBinaryData->source_date->format('d/m/Y') : null,

            'tpUser' => $schemeBinaryData?->tpUpdatedBy?->name,
            'tpDate' => $schemeBinaryData?->tp_date ? $schemeBinaryData->tp_date->format('d/m/Y') : null,

            'ugrUser' => $schemeBinaryData?->ugrUpdatedBy?->name,
            'ugrDate' => $schemeBinaryData?->ugr_date ? $schemeBinaryData->ugr_date->format('d/m/Y') : null,

            'esrUser' => $schemeBinaryData?->esrUpdatedBy?->name,
            'esrDate' => $schemeBinaryData?->esr_date ? $schemeBinaryData->esr_date->format('d/m/Y') : null,

            'pumpHouseUser' => $schemeBinaryData?->pumpHouseUpdatedBy?->name,
            'pumpHouseDate' => $schemeBinaryData?->pump_house_date ? $schemeBinaryData->pump_house_date->format('d/m/Y') : null,

            'apdclUser' => $schemeBinaryData?->apdclUpdatedBy?->name,
            'apdclDate' => $schemeBinaryData?->apdcl_date ? $schemeBinaryData->apdcl_date->format('d/m/Y') : null,

            'internalConnectionUser' => $schemeBinaryData?->internalConnectionUpdatedBy?->name,
            'internalConnectionDate' => $schemeBinaryData?->internal_connection_date ? $schemeBinaryData->internal_connection_date->format('d/m/Y') : null,

            'genSetUser' => $schemeBinaryData?->genSetUpdatedBy?->name,
            'genSetDate' => $schemeBinaryData?->gen_set_date ? $schemeBinaryData->gen_set_date->format('d/m/Y') : null,

            'ldsUser' => $schemeBinaryData?->ldsUpdatedBy?->name,
            'ldsDate' => $schemeBinaryData?->lds_date ? $schemeBinaryData->lds_date->format('d/m/Y') : null,

            'siteDevelopmentUser' => $schemeBinaryData?->siteDevelopmentUpdatedBy?->name,
            'siteDevelopmentDate' => $schemeBinaryData?->site_development_date ? $schemeBinaryData->site_development_date->format('d/m/Y') : null,

            'boundaryWallUser' => $schemeBinaryData?->boundaryWallUpdatedBy?->name,
            'boundaryWallDate' => $schemeBinaryData?->boundary_wall_date ? $schemeBinaryData->boundary_wall_date->format('d/m/Y') : null,

            'paintingUser' => $schemeBinaryData?->paintingUpdatedBy?->name,
            'paintingDate' => $schemeBinaryData?->painting_date ? $schemeBinaryData->painting_date->format('d/m/Y') : null,

            'rwpUser' => $schemeBinaryData?->rwpUpdatedBy?->name,
            'rwpDate' => $schemeBinaryData?->rwp_date ? $schemeBinaryData->rwp_date->format('d/m/Y') : null,

            'cwpUser' => $schemeBinaryData?->cwpUpdatedBy?->name,
            'cwpDate' => $schemeBinaryData?->cwp_date ? $schemeBinaryData->cwp_date->format('d/m/Y') : null,

            'networkUser' => $schemeBinaryData?->networkUpdatedBy?->name,
            'networkDate' => $schemeBinaryData?->network_date ? $schemeBinaryData->network_date->format('d/m/Y') : null,

            'fhtcUser' => $schemeBinaryData?->fhtcUpdatedBy?->name,
            'fhtcDate' => $schemeBinaryData?->fhtc_date ? $schemeBinaryData->fhtc_date->format('d/m/Y') : null,

            'trialRunUser' => $schemeBinaryData?->trialRunUpdatedBy?->name,
            'trialRunDate' => $schemeBinaryData?->trial_run_date ? $schemeBinaryData->trial_run_date->format('d/m/Y') : null,

            'workCompletionUser' => $schemeBinaryData?->workCompletionUpdatedBy?->name,
            'workCompletionDate' => $schemeBinaryData?->work_completion_date ? $schemeBinaryData->work_completion_date->format('d/m/Y') : null,

            'schemeHandoverUser' => $schemeBinaryData?->schemeHandoverUpdatedBy?->name,
            'schemeHandoverDate' => $schemeBinaryData?->scheme_handover_date ? $schemeBinaryData->scheme_handover_date->format('d/m/Y') : null,

            'panchayatVerifiedUser' => $schemeBinaryData?->panchayatVerifiedUpdatedBy?->name,
            'panchayatVerifiedDate' => $schemeBinaryData?->panchayat_verified_date ? $schemeBinaryData->panchayat_verified_date->format('d/m/Y') : null,

            'preliminaryWorkorderUser' => $schemeBinaryData?->preliminaryWorkorderUpdatedBy?->name,
            'preliminaryWorkorderDate' => $schemeBinaryData?->preliminary_workorder_date ? $schemeBinaryData->preliminary_workorder_date->format('d/m/Y') : null,

            'preliminaryActivitiesUser' => $schemeBinaryData?->preliminaryActivitiesUpdatedBy?->name,
            'preliminaryActivitiesDate' => $schemeBinaryData?->preliminary_activities_date ? $schemeBinaryData->preliminary_activities_date->format('d/m/Y') : null,

            'formalWorkorderUser' => $schemeBinaryData?->formalWorkorderUpdatedBy?->name,
            'formalWorkorderDate' => $schemeBinaryData?->formal_workorder_date ? $schemeBinaryData->formal_workorder_date->format('d/m/Y') : null,
        ]);
    }
}
