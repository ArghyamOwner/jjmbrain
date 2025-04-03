<?php

use App\Http\Controllers\Api\V1\ActivityDetailsController;
use App\Http\Controllers\Api\V1\Assets;
use App\Http\Controllers\Api\V1\AssignmentSubTasks;
use App\Http\Controllers\Api\V1\AssignmentSubTasksFormDetailsController;
use App\Http\Controllers\Api\V1\AssignmentSubTasksReportController;
use App\Http\Controllers\Api\V1\AssignmentSubTasksReviewController;
use App\Http\Controllers\Api\V1\Beneficiary;
use App\Http\Controllers\Api\V1\BeneficiaryVoteridVerificationController;
use App\Http\Controllers\Api\V1\CheckJaldootRegistrationController;
use App\Http\Controllers\Api\V1\CheckLastMonthSalary;
use App\Http\Controllers\Api\V1\Circle;
use App\Http\Controllers\Api\V1\ContractorHomeController;
use App\Http\Controllers\Api\V1\ContractorShowController;
use App\Http\Controllers\Api\V1\ContractorStoreController;
use App\Http\Controllers\Api\V1\ContractorUpdateController;
use App\Http\Controllers\Api\V1\ContractorWorkorderGrievanceController;
use App\Http\Controllers\Api\V1\ContractorWorkorderSchemesController;
use App\Http\Controllers\Api\V1\ContractorWorkordersController;
use App\Http\Controllers\Api\V1\ExpenditureCategoryController;
use App\Http\Controllers\Api\V1\FinancialYearController;
use App\Http\Controllers\Api\V1\GrievanceCategoriesController;
use App\Http\Controllers\Api\V1\GrievanceReasonsController;
use App\Http\Controllers\Api\V1\Grievances;
use App\Http\Controllers\Api\V1\GrievanceSubcategoriesController;
use App\Http\Controllers\Api\V1\JalmitraSalaryController;
use App\Http\Controllers\Api\V1\Lithologs;
use App\Http\Controllers\Api\V1\MeController;
use App\Http\Controllers\Api\V1\MonthlyExpenditureStoreController;
use App\Http\Controllers\Api\V1\Notices;
use App\Http\Controllers\Api\V1\Otp;
use App\Http\Controllers\Api\V1\PattensController;
use App\Http\Controllers\Api\V1\Profiles\UpdateProfilePic;
use App\Http\Controllers\Api\V1\SalaryDetailsController;
use App\Http\Controllers\Api\V1\SchemeAaStoreController;
use App\Http\Controllers\Api\V1\SchemeBeneficiariesController;
use App\Http\Controllers\Api\V1\SchemeLocationUpdateController;
use App\Http\Controllers\Api\V1\Schemes;
use App\Http\Controllers\Api\V1\CanalTracking;
use App\Http\Controllers\Api\V1\CheckContractorExistsController;
use App\Http\Controllers\Api\V1\JaldootJalshalaSchemesController;
use App\Http\Controllers\Api\V1\SchemeStoreController;
use App\Http\Controllers\Api\V1\SchemeUpdateController;
use App\Http\Controllers\Api\V1\SchemeWorkordersController;
use App\Http\Controllers\Api\V1\SubTasksReviewQuestionsController;
use App\Http\Controllers\Api\V1\SyncSmtWorkorderDataController;
use App\Http\Controllers\Api\V1\Tasks;
use App\Http\Controllers\Api\V1\Tutorials;
use App\Http\Controllers\Api\V1\UpdateContractorDetailsController;
use App\Http\Controllers\Api\V1\UpdateJaldootController;
use App\Http\Controllers\Api\V1\UploadController;
use App\Http\Controllers\Api\V1\WhatsappGrievanceController;
use App\Http\Controllers\Api\V1\WorkorderDeleteController;
use App\Http\Controllers\Api\V1\WorkorderDetailsUpdateController;
use App\Http\Controllers\Api\V1\WorkordersOtpController;
use App\Http\Controllers\Api\V1\WorkordersOtpVerifyController;
use App\Http\Controllers\Api\V1\WorkorderStoreController;
use App\Http\Controllers\Api\V1\WorkorderTsUpdateController;
use App\Http\Controllers\Api\V1\WorkorderUpdateController;
use App\Http\Controllers\Api\V1\Wuc;
use App\Http\Controllers\Api\V1\Block;
use App\Http\Controllers\Api\V1\SchemeDailyFlowmeter;
use App\Http\Controllers\Api\V1\District;
use App\Http\Controllers\Api\V1\Banner;
use App\Http\Controllers\Api\V1\BeneficiaryVerificationController;
use App\Http\Controllers\Api\V1\Panchayat;
use App\Http\Controllers\Api\V1\Jalmitra;
use App\Http\Controllers\Api\V1\GeneralGrievances;
use App\Http\Controllers\Api\V1\LandSchemeDetailsController;
use App\Http\Controllers\Api\V1\WucDetailsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Floods;
use App\Http\Controllers\Api\V1\Sarathi;
use App\Http\Controllers\Api\V1\IOTUsers;
use App\Http\Controllers\Api\V1\MQTTDeviceSeederController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::prefix('v1')->group(function () {

    // Route::middleware(['treblle'])->group(function () {

        // Route::post('login', LoginController::class);
        Route::post('iot-users/import', IOTUsers\ImportController::class)->name('iot-users.import');
        Route::post('otp/request', Otp\RequestController::class)->name('otp.request');
        Route::post('otp/login', Otp\LoginController::class)->name('otp.login');

        Route::post('uploads', UploadController::class)->name('uploads');

        Route::get('schemes/{scheme}/workorders', SchemeWorkordersController::class)->name('schemes.workorders');
        Route::get('workorders/{workorder}/send-otp', WorkordersOtpController::class)->name('workorders.send-otp');
        Route::post('workorders/{workorder}/otp-verify', WorkordersOtpVerifyController::class)->name('workorders.otp-verify');

        Route::get('workorders/{workorder}/tasks', Tasks\IndexOldController::class)->name('workorders.tasks');
        Route::get('schemes/{scheme}/workorders/{workorder}/tasks', Tasks\IndexController::class)->name('workorders.tasks');

        Route::get('subtasks/{subtask}/form', AssignmentSubTasksFormDetailsController::class)->name('subtasks.form');
        Route::post('subtasks/{subtask}/report', AssignmentSubTasksReportController::class)->name('subtasks.report');
        Route::get('subtasks/{subtask}', AssignmentSubTasks\ShowController::class)->name('subtasks.show');

        Route::get('subtasks/{subtask}/review-questions', SubTasksReviewQuestionsController::class)->name('subtasks.review-questions');

        Route::group(['middleware' => 'auth:sanctum'], function () {
            // Profile
            Route::post('/profile/photo/update', UpdateProfilePic::class)->name('profile.photo.update');
            Route::post('/profile-details/store', Jalmitra\StoreUserDetailsController::class)->name('profile-details.store');


            // Contractors only endpoints
            Route::get('contractors/workorders', ContractorWorkordersController::class)->name('contractors.workorders');
            Route::get('contractors/details', ContractorShowController::class)->name('contractors.details');
            Route::get('contractors/workorders/{workorder}/schemes', ContractorWorkorderSchemesController::class)->name('contractors.workorders.schemes');
            Route::post('contractors/workorders/{workorder}/grievance', ContractorWorkorderGrievanceController::class)->name('contractors.workorders.grievance');
            Route::get('contractors/home', ContractorHomeController::class)->name('contractors.home');

            // Schemes
            Route::get('schemes', Schemes\IndexController::class)->name('schemes.index');
            Route::get('schemes/{scheme}', Schemes\ShowController::class)->name('schemes.show');
            Route::get('schemes/{scheme}/beneficiaries', SchemeBeneficiariesController::class)->name('schemes.beneficiaries');
            Route::post('schemes/{scheme}/location', SchemeLocationUpdateController::class)->name('schemes.location');
            // Route::post('schemes/flowmeter/store', Schemes\FlowmeterDetailsStoreController::class)->name('schemes.flowmeter.store');
            Route::get('schemes/{scheme}/flowmeter/index', Schemes\FlowmeterDetailsIndexController::class)->name('schemes.flowmeter.index');
            Route::post('schemes/{scheme}/store/qr-report', Schemes\QrReportStoreController::class)->name('schemes.qr-report.store');
            Route::get('jalmitra/schemes', Jalmitra\SchemeController::class)->name('jalmitra.schemes');

            Route::post('schemes/daily-flowmeter/update', SchemeDailyFlowmeter\StoreController::class)->name('schemes.daily-flowmeter.update');
            Route::get('daily-flowmeter/status', SchemeDailyFlowmeter\StatusController::class)->name('daily-flowmeter.status');

            // Canal Tracking
            Route::get('canal-tracking/pipe-options', CanalTracking\CreateOptionsController::class)->name('canal-tracking.pipe-options');
            Route::post('canal-tracking/{scheme}/create', CanalTracking\CreateController::class)->name('canal-tracking.create');
            Route::post('canal-points/{scheme}/create', CanalTracking\CreatePointsController::class)->name('canal-points.create');
            Route::get('canal-tracking/{scheme}/{type}/index', CanalTracking\IndexController::class)->name('canal-tracking.index');
            Route::post('geojson/{canalTracking}/update', CanalTracking\UpdateGeojsonController::class)->name('geojson.update');
            Route::get('canal-tracking/{canalTracking}/show', CanalTracking\ShowController::class)->name('canal-tracking.show');
            Route::post('canal-tracking/{canal}/edit', CanalTracking\EditController::class)->name('canal-tracking.edit');
            Route::post('canal-tracking/delete', CanalTracking\DeleteController::class)->name('canal-tracking.delete');
            Route::get('scheme-canal/{scheme}/show', CanalTracking\SchemeCanalShowController::class)->name('scheme-canal.show');
            Route::get('canal-tracking/point/categories', CanalTracking\PointCategoriesController::class)->name('canal-tracking.point-categories');
            Route::get('canal-tracking/{type}/types', CanalTracking\PointTypesController::class)->name('canal-tracking.types');
            Route::post('get-distance', CanalTracking\DistanceCalculateController::class)->name('get-distance');

            Route::post('subtasks/{subtask}/review', AssignmentSubTasksReviewController::class)->name('subtasks.review');

            Route::post('beneficiary/voterid/verify', BeneficiaryVoteridVerificationController::class)->name('beneficiary.voterid.verify');
            Route::post('beneficiary/create', Beneficiary\StoreController::class)->name('beneficiary.create');
            Route::post('beneficiary/verify', BeneficiaryVerificationController::class)->name('beneficiary.verify');
            Route::post('beneficiary/{beneficiary}/delete', Beneficiary\DeleteController::class)->name('beneficiary.delete');


            // Circle / Office
            Route::get('circles', Circle\IndexController::class)->name('circles.index');

            // Financial Year
            Route::get('financial-years', FinancialYearController::class)->name('financial-years');

            // Assets
            Route::get('asset-types', Assets\TypeController::class)->name('asset-types');
            Route::post('asset/{scheme}/store', Assets\StoreController::class)->name('asset.store');

            // WUC
            Route::post('oandm/collection/{wuc}/store', Wuc\OAndMCollectionStoreController::class)->name('oandm.collection.store');
            Route::post('oandm/expenditure/{wuc}/store', Wuc\OAndMExpenditureStoreController::class)->name('oandm.expenditure.store');
            Route::post('oandm/demand/{wuc}/store', Wuc\OAndMDemandStoreController::class)->name('oandm.demand.store');
            Route::get('expenditure/categories', ExpenditureCategoryController::class)->name('expenditure.categories');
            Route::post('monthly/expenditure/store', MonthlyExpenditureStoreController::class)->name('monthly.expenditure.store');
            Route::get('wuc/details', WucDetailsController::class)->name('wuc.details');
            Route::get('wuc/bylaws', Wuc\ByLawsController::class)->name('wuc.bylaws');

            // Litholog
            Route::get('litholog/options', Lithologs\OptionsController::class)->name('litholog.options');
            Route::post('litholog/store', Lithologs\StoreController::class)->name('litholog.store');
            Route::get('lithologs/{scheme}', Lithologs\IndexController::class)->name('lithologs.index');
            Route::get('patterns', PattensController::class)->name('patterns.index');
            Route::post('lithology/{litholog}/store', Lithologs\LithologyStoreController::class)->name('lithology.store');
            Route::get('lithology/{litholog}/index', Lithologs\LithologyIndexController::class)->name('lithology.index');
            Route::get('lithology/{litholog}/delete', Lithologs\LithologyDeleteController::class)->name('lithology.delete');

            // Grievances
            Route::get('grievances', Grievances\IndexController::class)->name('grievances.index');
            Route::get('reasons/{subCategory}', GrievanceReasonsController::class)->name('reasons.index');
            Route::post('reason/{grievance}/store', Grievances\SubmitReason::class)->name('reason.store');

            // General Grievance
            Route::post('general-grievance/store', GeneralGrievances\Create::class)->name('general-grievance.store');

            // Jal-mitra salary
            Route::post('jalmitra/salary', JalmitraSalaryController::class)->name('jalmitra.salary');
            Route::get('check/salary', CheckLastMonthSalary::class)->name('check.salary');
            Route::get('salary/details', SalaryDetailsController::class)->name('salary.details');

            Route::get('me', MeController::class)->name('me');

            // Notices
            Route::get('notices', Notices\IndexController::class)->name('notices.index');

            // Tutorials
            Route::get('tutorials', Tutorials\IndexController::class)->name('tutorials.index');

            // Banner
            Route::post('banners', Banner\IndexController::class)->name('banners.index');

            // Flood Info
            Route::get('flood-scheme-details/info', Floods\InfoController::class)->name('flood-scheme-details.info');
            Route::get('flood-scheme-details/index', Floods\IndexController::class)->name('flood-scheme-details.index');
            Route::post('flood-scheme-details/store', Floods\StoreController::class)->name('flood-scheme-details.store');
            Route::post('flood-scheme-details/{schemeFloodInfo}/update', Floods\UpdateController::class)->name('flood-scheme-details.update');
            Route::post('flood-scheme-details/delete', Floods\DeleteController::class)->name('flood-scheme-details.delete');
            // IOT Users
            // Route::post('iot-users/import', IOTUsers\ImportController::class);
            
        });

        // Jaldoot
        Route::post('jaldoots/update', UpdateJaldootController::class)->name('jaldoots.update');
        Route::post('jaldoot/registration/check', CheckJaldootRegistrationController::class)->name('jaldoot.registration.check');

        Route::post('jaldoot/jalshala/schemes', JaldootJalshalaSchemesController::class)->name('jaldoot.jalshala.schemes');

        // SMT - Scheme
        Route::post('scheme/store', SchemeStoreController::class)->name('scheme.store');
        Route::post('scheme/{scheme}/update', SchemeUpdateController::class)->name('scheme.update');
        Route::post('aa/{scheme}/store', SchemeAaStoreController::class)->name('aa.store');

        // SMT - Contractors
        Route::post('contractor/check', CheckContractorExistsController::class)->name('contractor.check');
        Route::post('contractor/store', ContractorStoreController::class)->name('contractor.store');
        Route::post('contractor/{contractor}/update', ContractorUpdateController::class)->name('contractor.update');
        Route::post('contractor-details/{contractor}/update', UpdateContractorDetailsController::class)->name('contractor-details.update');

        // SMT - Workorder
        Route::post('workorder/store', WorkorderStoreController::class)->name('workorder.store');
        Route::post('workorder/{workorder}/update', WorkorderUpdateController::class)->name('workorder.update');
        Route::post('workorder-details/{workorder}/update', WorkorderDetailsUpdateController::class)->name('workorder-details.update');
        Route::post('workorder-ts/{workorder}/update', WorkorderTsUpdateController::class)->name('workorder-ts.update');
        Route::post('workorder/delete', WorkorderDeleteController::class)->name('workorder.delete');
        // Route::post('workorder/{workorder}/sync', SyncSmtWorkorderDataController::class);

        // SMT - Activity
        Route::get('activity/{activity}/{scheme}/details', ActivityDetailsController::class)->name('activity.details');

        // Whatsapp Grievance
        Route::get('grievance/categories', GrievanceCategoriesController::class)->name('grievance.categories');
        Route::get('grievance/categories/{category}/subcategories', GrievanceSubcategoriesController::class)->name('grievance.subcategories');
        Route::post('grievance/whatsapp', WhatsappGrievanceController::class)->name('grievance.whatsapp');
        // Route::get('grievance/subcategories/{subcategory}/issues', GrievanceSubcategoriesIssuesController::class);

        // Jaldoot Whatsapp Bot
        Route::get('districts', District\IndexController::class)->name('districts.index');
        Route::post('blocks', Block\IndexController::class)->name('blocks.index');
        Route::post('panchayats', Panchayat\IndexController::class)->name('panchayats.index');
        Route::post('panchayat/schemes', Schemes\PanchayatWiseIndexController::class)->name('panchayat.schemes.index');
        Route::post('scheme-verify', Schemes\VerifySchemeController::class)->name('scheme.verify');
        Route::post('scheme-details', Schemes\JaldootSchemeDetails::class)->name('scheme.details');

        // Final Bill Approval
        Route::get('bill-approval/{scheme}', Schemes\FinalBillApprovalController::class)->name('bill-approval.index');
        Route::get('litholog-status/{scheme}', Schemes\LithologStatusController::class)->name('litholog-status.index');

        // Land Records - Scheme Details
        Route::get('land-scheme-details/{schemeId}', LandSchemeDetailsController::class)->name('land-scheme-details.index');

        // weekly reading
        Route::post('jm-weekly-reading', Sarathi\IndexController::class)->name('jm-weekly-reading.index');

        Route::post('schemes/flowmeter/store', Schemes\FlowmeterDetailsStoreController::class)->name('schemes.flowmeter.store');

    // });
});
