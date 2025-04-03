<?php

use Jalshalas\Dashboard;
use App\Http\Livewire\Isa;
use App\Http\Livewire\Map;
use App\Http\Livewire\Labs;
use App\Http\Livewire\Logs;
use App\Http\Livewire\News;
use App\Http\Livewire\Task;
use App\Http\Livewire\Wucs;
use Illuminate\Support\Str;
use App\Http\Livewire\Admin;
use App\Http\Livewire\Apdcl;
use App\Http\Livewire\Items;
use App\Http\Livewire\Assets;
use App\Http\Livewire\Issues;
use App\Http\Livewire\Office;
use App\Http\Livewire\Stocks;
use App\Http\Livewire\Article;
use App\Http\Livewire\Holiday;
use App\Http\Livewire\Jalkosh;
use App\Http\Livewire\Members;
use App\Http\Livewire\Notices;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Reports;
use App\Http\Livewire\Schemes;
use App\Http\Livewire\Subtask;
use App\Http\Livewire\Surveys;
use App\Http\Livewire\Category;
use App\Http\Livewire\JalAddas;
use App\Http\Livewire\JalMitra;
use App\Http\Livewire\Meetings;
use App\Http\Livewire\Campaigns;
use App\Http\Livewire\Lithologs;
use App\Http\Livewire\Questions;
use App\Http\Livewire\Transfers;
use App\Http\Livewire\Banner;
use App\Http\Livewire\Tutorials;
use App\Http\Livewire\Changelogs;
use App\Http\Livewire\Grievances;
use App\Http\Livewire\Workorders;
use App\Http\Livewire\Contractors;
use App\Http\Livewire\Beneficiaries;
use App\Http\Livewire\CanalTracking;
use App\Http\Livewire\FieldTestKits;
use App\Http\Livewire\MeetingMinutes;
use App\Http\Livewire\OAndMEstimates;
use App\Http\Livewire\Reviewsections;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ActivityDetails;
use App\Http\Livewire\AssignmentTasks;
use App\Http\Controllers\IotController;
use App\Http\Livewire\PanchayatPayment;
use App\Http\Livewire\PublicGrievances;
use App\Http\Livewire\SchemeArchiveRequest;
use App\Http\Livewire\ArticleCategories;
use App\Http\Controllers\Reports\TrainerListReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportsController;
use App\Http\Livewire\ContractorGrievances;
use App\Http\Controllers\MarkdownController;
use App\Http\Livewire\PerformanceGuarantees;
use App\Http\Livewire\DistrictLevelTrainings;
use App\Http\Livewire\Jalshalas\IndexTrainer;
use App\Http\Livewire\Jalshalas\ShowJalshala;
use App\Http\Livewire\WaterQualityParameters;
use App\Http\Controllers\SchemeShowController;
use App\Http\Livewire\Jalshalas\CreateTrainer;
use App\Http\Livewire\Jalshalas\IndexJalshala;
use App\Http\Controllers\PublicLinksController;
use App\Http\Livewire\Jalshalas\CreateJalshala;
use App\Http\Controllers\DivisionViewController;
use App\Http\Livewire\Jalshalas\EditPreJalshala;
use App\Http\Controllers\Reports\SchemesWithoutSo;
use App\Http\Livewire\Jalshalas\CreatePostJalshala;
use App\Http\Livewire\Jalshalas\EditJalshalaScheme;
use App\Http\Livewire\Jalshalas\JalshalaStatistics;
use App\Http\Controllers\LithologDownloadController;
use App\Http\Controllers\SchemeQrCodeScanController;
use App\Http\Livewire\Jalshalas\ShowJalshalaSchools;
use App\Http\Controllers\DivisionDashboardController;
use App\Http\Controllers\TinymceImageUploadController;
use App\Http\Livewire\Jalshalas\JalshalaSchoolsStudent;
use App\Http\Controllers\SchemeQrCodeDownloadController;
use App\Http\Controllers\GrievanceReferanceSlipController;
use App\Http\Controllers\Reports\SchemeWithoutOrWrongImis;
use App\Http\Controllers\Reports\DivisionWiseSoTaskSummary;
use App\Http\Livewire\Jalshalas\DistrictJalshalaStatistics;
use App\Http\Controllers\Reports\DistrictWiseJalshalaSummary;
use App\Http\Controllers\Reports\RoleBasedUserListController;
use App\Http\Controllers\ActivityDetails\BlockSummaryController;
use App\Http\Controllers\DistrictDashboardController;
use App\Http\Controllers\DistrictViewController;
use App\Http\Controllers\PublicDistrictDashboardController;
use App\Http\Livewire\Backups;
use App\Http\Livewire\Jalshalas\JalshalaSchoolApplicationForm;
use App\Http\Controllers\Reports\DivisionWiseSummaryController;
use App\Http\Controllers\Reports\WorkordersWithoutPgController;
use App\Http\Controllers\Reports\SoAssignedTaskCompletionReport;
use App\Http\Controllers\SchemeReviewsectionQuestionsController;
use App\Http\Controllers\Reports\ContractorsCompletedTasksReport;
use App\Http\Livewire\Jalshalas\EducationBlockJalshalaStatistics;
use App\Http\Controllers\Reports\SchemesWithoutIsaReportController;
use App\Http\Controllers\Reports\VillagesWithoutIsaReportController;
use App\Http\Controllers\Reports\DistrictWiseVillageSchemeWucSummary;
use App\Http\Controllers\Reports\DivisionHandoverSummaryReportController;
use App\Http\Controllers\Reports\DivisionWiseLithologReportController;
use App\Http\Controllers\Reports\PGSummaryIssuingAuthorityWiseController;
use App\Http\Controllers\Reports\SchemesWithMultipleWucsController;
use App\Http\Controllers\Reports\SchemewiseLatestFlowmeterReading;
use App\Http\Controllers\Reports\WaterDisruptionWeeklyReport;
use App\Http\Controllers\StateDashboardController;
use App\Http\Livewire\ApiLogStats;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Welcome page
Route::get('/', fn () => to_route('login'));

// Route::view('map', 'map-test');
// Route::get('/demo/pdf', DemoPdfController::class);

Route::view('grievance', 'grievance')->name('grievance');

Route::get('grievance/apply', PublicGrievances\Create::class)->name('grievance.apply');

Route::get('grievance/status', PublicGrievances\Track::class)->name('publicGrievance.status');

Route::get('grievance/{grievance}/myapplications', PublicGrievances\MyApplication::class)->name('myapplications');

Route::get('grievance/{grievance}/download', GrievanceReferanceSlipController::class)->name('grievance.download');

//Route::view('myapplications/{ref}', 'myapplications')->name('myapplications');

Route::view('privacy-policy', 'pages.privacy')->name('privacy');
Route::get('public/links', PublicLinksController::class)->name('publicLinks');
Route::get('schemes/{scheme}/qrcode-scan', SchemeQrCodeScanController::class)->name('schemes.qrcodeDetails');

Route::get('js/{jalshalaschool}', JalshalaSchoolApplicationForm::class)->name('jalshalaSchoolApplicationForm');

Route::get('jalshalas/{jalshala}/student', JalshalaSchoolsStudent::class)->name('jalshalaSchoolStudent');
// public scheme view
Route::get('/jjm-scheme-list/{districtId}/details', Schemes\PublicSchemes::class)->name('public.scheme.list');
Route::get('/jjm-scheme-list/{districtId}/{type?}/details', Schemes\PublicSchemes::class)->name('public.scheme.list');
Route::get('/jjm-district-dashboard', [PublicDistrictDashboardController::class, 'index'])->name('public.district.dashboard');

Route::get('scheme/{deviceid}/{schemeid}/iot', Schemes\IOT::class)->name('schemes.iot');
Route::group(['middleware' => 'auth'], function () {
	Route::get('holidays', Holiday::class)->name('holidays');
	// Route::get('map', Map\StateLevelClusterMap::class)->name('clusterMap');
	Route::get('district-map', Map\DistrictSvgMap::class)->name('districtMap');

	// Dashboard
	Route::get('dashboard', function () {
		return view('dashboard', [
			'user' => auth()->user()
		]);
	})->name('dashboard');

	Route::get('state-dashboard', [StateDashboardController::class, 'index'])->name('stateDashboard');

	Route::get('division-dashboard', [DivisionDashboardController::class, 'index'])->name('divisionDashboard');
	Route::get('division-dashboard/{division}', [DivisionViewController::class, 'index'])->name('divisionView');

	Route::get('district-dashboard', [DistrictDashboardController::class, 'index'])->name('districtDashboard');
	Route::get('district-dashboard/{district}', [DistrictViewController::class, 'index'])->name('districtView');
	
	Route::get('isa-activity/block/{block}', [BlockSummaryController::class, 'index'])->name('blockIsaActivity');

	Route::get('grievance-dashboard', function () {
		return view('grievance-dashboard');
	})->name('grievanceDashboard');

	Route::get('lab-management-dashboard', function () {
		return view('lab-management-dashboard');
	})->name('labDashboard');
	
	Route::get('wuc-dashboard', function () {
		return view('wuc-dashboard');
	})->name('wucDashboard');

	Route::get('litholog-dashboard', function () {
		return view('litholog-dashboard');
	})->name('lithologDashboard');

	Route::get('jal-mitra-dashboard', function () {
		return view('jal-mitra-dashboard');
	})->name('jmDashboard');

	Route::get('jalshala-dashboard', function() {
		return view('jalshala-dashboard');
	})->name('jalshala.dashboard');

	Route::get('isa-activity-dashboard', function () {
		return view('isa-activity-dashboard');
	})->name('isaActivityDashboard');

	// Schemes
	Route::get('schemes', Schemes\Index::class)->name('schemes');
	Route::get('archived-schemes', Schemes\IndexArchived::class)->name('archivedSchemes');
	Route::get('schemes/create', Schemes\Create::class)->name('schemes.create');
	Route::get('schemes/{scheme}/asset-create', Schemes\AssetCreate::class)->name('schemes.assetCreate');
	Route::get('schemes/{scheme}/inspections', Schemes\Inspections::class)->name('schemes.inspections');
	Route::get('schemes/{scheme}/networkmap', Map\SchemeNetworkMap::class)->name('networkMap');
	Route::get('schemes/{scheme}/flood-info-create', Schemes\CreateFloodInfoScheme::class)->name('schemes.floodInfoCreate');
	Route::get('schemes/{scheme}/esr-complaint-create', Schemes\CreateEsrComplaint::class)->name('schemes.esrComplaintCreate');

	// Scheme
	Route::get('scheme-archive-requests', SchemeArchiveRequest\Index::class)->name('archiveRequests');
	Route::get('archive/{request}/requests', SchemeArchiveRequest\Show::class)->name('archiveRequests.show');

	// Route::get('schemes/{scheme}', Schemes\Show::class)->name('schemes.show');
	Route::get('schemes/{scheme}/beneficiary-create', Beneficiaries\Create::class)->name('schemes.beneficiaryCreate');
	Route::get('schemes/{scheme}/edit', Schemes\Edit::class)->name('schemes.edit');
	Route::get('schemes/{scheme}/qrcode', SchemeQrCodeDownloadController::class)->name('schemes.qrcodeDownload');
	Route::get('schemes/{scheme}/{tab?}', SchemeShowController::class)->name('schemes.show');
	Route::get('scheme/{scheme}/update-consumer', Schemes\UpdateConsumerDetails::class)->name('schemes.updateConsumer');
	Route::get('scheme/{scheme}/update-status', Schemes\UpdateWorkStatus::class)->name('schemes.updateStatus');
	Route::get('scheme/{scheme}/aa-details', Schemes\AaDetails::class)->name('schemes.aa');

	Route::get('scheme/{scheme}/binary-data', Schemes\BinaryData::class)->name('schemes.binarydata');
	// Route::get('scheme/{deviceid}/{schemeid}/iot', Schemes\IOT::class)->name('schemes.iot');
	Route::get('scheme/users', Schemes\IOTUsers::class)->name('schemes.users');
	// Route::get('scheme/iot/{deviceId}/{type}/{schemeid}/charts', Schemes\IotCharts::class)->name('schemes.iot.charts');
	Route::get('fetch-scheme-workorder/{schemeId}', Schemes\FetchSmtWorkorder::class)->name('fetch.smtWorkorder');
	// Route::get('scheme/iot/{deviceId}/{schemeId}/graphs', Schemes\IotGraphDashboard::class)->name('iot.graph.dashboard');

	// Route::get('test-map', CanalTracking\Show::class)->name('canalShow');
	Route::get('canal-tracking/{scheme}/map', CanalTracking\Show::class)->name('canalShowMap');
	Route::get('panchayat-payment/{scheme}/create', PanchayatPayment\Create::class)->name('panchayatPayment.store');
	Route::get('panchayat-payments', PanchayatPayment\Index::class)->name('panchayatPayments');
	Route::get('state-panchayat-payments', PanchayatPayment\IndexCommissioner::class)->name('panchayatPaymentsCommissioner');
	Route::get('canal-tracking/{scheme}/upload-network', CanalTracking\UploadNetworkGeojson::class)->name('canalUploadNetwork');
	Route::get('canal-tracking/{network}/verify', CanalTracking\Verify::class)->name('verifyNetwork');

	// Offices
	Route::get('offices', Office\Index::class)->name('offices');
	Route::get('office/{office}/edit', Office\Edit::class)->name('office.edit');

	// Users
	Route::get('admin/users', Admin\Users\Index::class)->name('admin.users');
	Route::get('admin/users/create', Admin\Users\Create::class)->name('admin.users.create');
	Route::get('admin/users/{user}/edit', Admin\Users\Edit::class)->name('admin.users.edit');
	Route::get('admin/users/{userId}/show', Admin\Users\Show::class)->name('admin.users.show');

	// Contractors
	Route::get('contractors', Contractors\Index::class)->name('contractors');
	Route::get('contractors/create', Contractors\Create::class)->name('contractors.create');
	Route::get('contractors/{contractor}/edit', Contractors\Edit::class)->name('contractors.edit');
	Route::get('contractors/{contractor}/show', Contractors\Show::class)->name('contractors.show');

	// Contractor Grievances
	Route::get('contractor-grievances', ContractorGrievances\Index::class)->name('contractorGrievances');

	// Tasks and subtasks
	Route::get('tasks', Task\Index::class)->name('tasks');
	Route::get('tasks/create', Task\Create::class)->name('tasks.create');
	Route::get('tasks/{task}/edit', Task\Edit::class)->name('tasks.edit');
	Route::get('tasks/{task}/show', Task\Show::class)->name('tasks.show');
	Route::get('tasks/{task}/subtasks/create', Subtask\Create::class)->name('subtasks.create');
	Route::get('subtasks/{subtask}/edit', Subtask\Edit::class)->name('subtasks.edit');
	Route::get('subtasks/{subtask}/review-questions', Subtask\ReviewQuestions::class)->name('subtasks.reviewQuestions');
	Route::get('subtasks/{subtask}/review-questions/create', Subtask\ReviewQuestionCreate::class)->name('subtasks.reviewQuestionsCreate');

	// Workorders
	Route::get('workorders', Workorders\Index::class)->name('workorders');
	Route::get('workorders/create', Workorders\Create::class)->name('workorders.create');
	Route::get('workorders/{workorder}/show', Workorders\Show::class)->name('workorders.show');
	Route::get('workorders/{workorder}/progress', Workorders\Progress::class)->name('workorders.progress');
	Route::get('workorders/{workorder}/edit', Workorders\Edit::class)->name('workorders.edit');
	Route::get('workorders/{workorder}/pg/create', PerformanceGuarantees\Create::class)->name('pg.create');
	Route::get('workorders/{workorder}/assign-tasks', Workorders\AssignTasks::class)->name('workorders.assignTasks');
	Route::get('workorders/{workorder}/assign-scheme', Workorders\AssignScheme::class)->name('workorders.assignScheme');

	Route::get('assignmenttasks/{assignmenttask}/show', AssignmentTasks\Show::class)->name('assignmenttasks.show');

	// Assets
	Route::get('assets', Assets\Index::class)->name('assets');
	Route::get('assets/create', Assets\Create::class)->name('assets.create');
	Route::get('assets/{asset}/edit', Assets\Edit::class)->name('assets.edit');

	// PG
	Route::get('pg/dashboard', PerformanceGuarantees\Index::class)->name('pg.dashboard');
	Route::get('pg/{pg}/withdraw', PerformanceGuarantees\Withdraw::class)->name('pg.withdraw');
	Route::get('pg/{pg}', PerformanceGuarantees\Show::class)->name('pg.show');
	Route::get('performance-guarantee/create', PerformanceGuarantees\Create::class)->name('pgs.create');

	// Water Quality Parameters
	Route::get('water-quality-parameters', WaterQualityParameters\Index::class)->name('waterQualityParameters');

	// Items
	Route::get('items', Items\Index::class)->name('items');
	Route::get('items/create', Items\Create::class)->name('items.create');
	Route::get('items/{item}/edit', Items\Edit::class)->name('items.edit');
	Route::get('items/{item}/stocks/create', Stocks\Create::class)->name('stocks.create');

	// Stocks
	Route::get('stocks', Stocks\Index::class)->name('stocks');
	// Route::get('stocks/create', Stocks\Create::class)->name('stocks.create');
	Route::get('stocks/{stock}/edit', Stocks\Edit::class)->name('stocks.edit');

	// Stock Alert
	Route::get('stocks/alert', Labs\StockAlert::class)->name('stocks.alert');

	// Stock Transfers
	Route::get('stocks/{stock}/transfer', Transfers\Create::class)->name('stocks.transfer');

	Route::get('stocks/transfer', Labs\StockTransfer::class)->name('stocksTransfer.show');

	// Transfers
	Route::get('transfers', Transfers\Index::class)->name('transfers');
	Route::get('transfers/{transfer}/accept', Transfers\Accept::class)->name('transfers.accept');

	// Labs
	Route::get('labs', Labs\Index::class)->name('labs');
	Route::get('labs/create', Labs\Create::class)->name('labs.create');
	Route::get('labs/{lab}/edit', Labs\Edit::class)->name('labs.edit');

	//Route::get('labs/assign', Labs\AssignUser::class)->name('labs.assign');

	Route::get('labs/{lab}/district-lab', Labs\LabStatistics::class)->name('labs.district');

	// Campaign
	Route::get('campaigns', Campaigns\Index::class)->name('campaigns');
	Route::get('campaign/create', Campaigns\Create::class)->name('campaigns.create');
	Route::get('campaign/{campaign}/show', Campaigns\Show::class)->name('campaigns.show');
	Route::get('campaign/{campaign}/edit', Campaigns\Edit::class)->name('campaigns.edit');

	// Questions
	Route::get('question/{question}/edit', Questions\Edit::class)->name('questions.edit');

	// Issues
	Route::get('issues', Issues\Index::class)->name('issues');
	Route::get('issues/create', Issues\Create::class)->name('issues.create');
	Route::get('issues/{issue}/show', Issues\Show::class)->name('issues.show');

	// Category
	Route::get('categories', Category\Index::class)->name('categories');
	Route::get('category/create', Category\Create::class)->name('category.create');
	Route::get('category/{category}/show', Category\Show::class)->name('category.show');

	// Grievances
	Route::get('grievances', Grievances\Index::class)->name('grievances');
	Route::get('grievances/create', Grievances\CreateInbound::class)->name('grievancesInbound.create');
	Route::get('grievances/{grievanceId}/show', Grievances\Show::class)->name('grievances.show');
	Route::get('grievance/outbound', Grievances\Outbound::class)->name('outbound');

	Route::get('surveys/{user}/create', Surveys\Create::class)->name('surveys.create');
	Route::get('surveys/{survey}/show', Surveys\Show::class)->name('surveys.show');

	// Activity
	Route::get('activity-details', ActivityDetails\Index::class)->name('activityDetails');
	Route::get('activity-details/create', ActivityDetails\Create::class)->name('activityDetails.create');
	Route::get('activity-details/{detail}/show', ActivityDetails\Show::class)->name('activityDetails.show');
	Route::get('activity/{activity}/assign-isa', ActivityDetails\AssignIsa::class)->name('activity.assignIsa');

	// WUC
	Route::get('wucs', Wucs\Index::class)->name('wucs');
	Route::get('wuc/create', Wucs\Create::class)->name('wucs.create');
	Route::get('wuc/{wuc}/show', Wucs\Show::class)->name('wucs.show');
	Route::get('wuc/{wuc}/edit-bank', Wucs\EditBankDetails::class)->name('wucs.editBank');
	Route::get('wuc/{wuc}/Update-documents', Wucs\UpdateDocuments::class)->name('wucs.updateDocuments');

	// O & M
	Route::get('o-and-m-estimate/{wuc}/create', OAndMEstimates\Create::class)->name('estimate.create');

	// ISA
	Route::get('isa/create', Isa\Create::class)->name('isa.create');
	Route::get('isa', Isa\Index::class)->name('isa');
	Route::get('isa/{isa}/show', Isa\Show::class)->name('isa.show');
	Route::get('isa/{isa}/edit', Isa\Edit::class)->name('isa.edit');

	// Lithologs
	Route::get('lithologs', Lithologs\Index::class)->name('lithologs');
	Route::get('litholog/{litholog}/show', Lithologs\View::class)->name('lithologs.show');
	Route::get('litholog/{litholog}/update', Lithologs\Edit::class)->name('lithologs.edit');
	Route::get('litholog/{litholog}/download', LithologDownloadController::class)->name('lithologs.download');
	Route::get('litholog/map', Lithologs\Map::class)->name('lithologs.map');
	Route::get('litholog/heat-map', Lithologs\HeatMap::class)->name('lithologs.heatMap');

	// APDCL Application Status
	Route::get('apdcl/application-status', Apdcl\ApplicationStatus::class)->name('apdcl.status');

	// Logs
	Route::get('logs', Logs\Index::class)->name('logs');

	// Meetings
	Route::get('meetings', Meetings\Index::class)->name('meetings');
	Route::get('meetings/create', Meetings\Create::class)->name('meetings.create');

	// Meeting Minutes
	Route::get('meeting-minutes', MeetingMinutes\Index::class)->name('meetingMinutes');
	Route::get('meeting-minute/create', MeetingMinutes\Create::class)->name('meetingMinutes.create');
	Route::get('meeting-minute/{meeting}/show', MeetingMinutes\Show::class)->name('meetingMinutes.show');


	// Beneficiaries
	// Route::get('beneficiaries/create', Beneficiaries\Create::class)->name('beneficiaries.create');
	Route::get('beneficiaries/{beneficiary}/edit', Beneficiaries\Edit::class)->name('beneficiaries.edit');

	// News
	Route::get('news', News\Index::class)->name('news');
	Route::get('news/feeds', News\Feeds::class)->name('news.feeds');
	Route::get('news/create', News\Create::class)->name('news.create');
	Route::get('news/{news:slug}', News\FeedShow::class)->name('news.feedsShow');
	Route::get('news/{news}/edit', News\Edit::class)->name('news.edit');

	// Notices
	Route::get('notices', Notices\Index::class)->name('notices');
	Route::get('jm-notices', Notices\JalmitraNotice::class)->name('jm.notices');
	Route::get('notices/create', Notices\Create::class)->name('notices.create');
	Route::get('notices/{notice}/show', Notices\Show::class)->name('notices.show');

	// Review Sections, Questions
	Route::get('schemes/{scheme}/reviewsections/{reviewsection}/questions', SchemeReviewsectionQuestionsController::class)->name('schemesReviewsectionQuestions');
	Route::get('reviewsections', Reviewsections\Index::class)->name('reviewsections');
	Route::get('reviewsections/{reviewsection}/show', Reviewsections\Show::class)->name('reviewsections.show');
	Route::get('reviewsections/{reviewsection}/questions/create', Reviewsections\CreateQuestion::class)->name('reviewsections.questions.create');

	// Trainers
	Route::get('trainers', IndexTrainer::class)->name('trainers.index');
	Route::get('trainers/create', CreateTrainer::class)->name('trainers.create');

	// JalShala
	Route::get('jalshalas', IndexJalshala::class)->name('jalshalas.index');
	Route::get('jalshalas/create', CreateJalshala::class)->middleware('role:district-jaldoot-cell')->name('jalshalas.create');
	Route::get('jalshalas/{jalshala}/show', ShowJalshala::class)->name('jalshalas.show');
	Route::get('jalshalas/{jalshala}/pre', EditPreJalshala::class)->name('jalshalas.pre');
	Route::get('jalshalas/{jalshala}/post', CreatePostJalshala::class)->name('jalshalas.post');
	Route::get('jalshalasschools/{jalshalaschool}/show', ShowJalshalaSchools::class)->name('jalshalas.schools');
	// Route::get('jalshalasschools/{jalshalaschool}/edit', EditJalshalaSchoolsStudent::class)->name('jalshalas.schools');

	Route::get('jalshalas/{jalshala}/edit', EditJalshalaScheme::class)->name('jalshalas.edit');

	Route::get('jalshalas/district-statistics', DistrictJalshalaStatistics::class)->name('jalshalas.district-statistics');

	Route::get('jalshalas/{district}/block-statistics', EducationBlockJalshalaStatistics::class)->name('jalshalas.block-statistics');

	Route::get('jalshalas/{educationBlock}/jalshala-statistics', JalshalaStatistics::class)->name('jalshalas.statistics');

	// FieldTestKit (FTK)
	Route::get('fieldtestkits', FieldTestKits\Index::class)->name('fieldtestkits');
	Route::get('fieldtestkits/create', FieldTestKits\Create::class)->name('fieldtestkits.create');
	Route::get('fieldtestkits/{ftk:id}/edit', FieldTestKits\Edit::class)->name('fieldtestkits.edit');

	// Docs
	Route::get('docs/{file}', [MarkdownController::class, 'show'])->name('admin.docs');
	
	// Profile
	Route::view('profile-settings', 'profile-settings')->name('profile.edit');
	Route::get('profile', ProfileController::class)->name('profile');
	Route::get('profile-activities', Profile\Activities::class)->name('profile.activities');

	// Tutorials
	Route::get('tutorials', Tutorials\Index::class)->name('tutorials');
	Route::get('tutorials/create', Tutorials\Create::class)->name('tutorials.create');

	// Jal kosh Links
	Route::get('jalkoshlinks', jalkosh\Index::class)->name('jalkoshlinks');
	Route::get('jalkoshlinks/create', jalkosh\Create::class)->name('jalkoshlinks.create');

	// Jal Mitra
	Route::get('jalmitra/users', JalMitra\Users::class)->name('jm.users');
	Route::get('jalmitra/salaries', JalMitra\Salaries::class)->name('jm.salaries');

	// Reports
	Route::get('/reports', [ReportsController::class, 'index'])->name('reports');
	// Route::get('reports-state-isa', function () {return view('state-isa-reports');})->name('reportsStateIsa');    
	Route::get('/reports/division', Reports\DivisionWise::class)->name('reports.division');
    Route::get('/report-generate/{division}', [ReportsController::class, 'generate'])->name('report.generate');
    Route::get('/division-wise-summary/report', [DivisionWiseSummaryController::class, 'generate'])->name('divisionSummary.report');
    Route::get('/division-wise/handover-summary/report', [DivisionHandoverSummaryReportController::class, 'generate'])->name('divisionHandoverSummary.report');
    Route::get('/pg-summary/report', [PGSummaryIssuingAuthorityWiseController::class, 'generate'])->name('pgSummary.report');
    Route::get('/roles/report', Reports\RoleBasedUsers::class)->name('roleUser.report');
    Route::get('/division/village-ftk', Reports\DivisionWiseFtk::class)->name('divisionFtk.report');
    Route::get('/district/village-isa', Reports\DistrictWiseIsa::class)->name('districtIsa.report');
    Route::get('/district/schools', Reports\DistrictWiseSchools::class)->name('districtSchool.report');
    Route::get('/meter/readings', Reports\MeterReading::class)->name('meter.readings');
	Route::get('/users/{role}',[RoleBasedUserListController::class, 'generate'])->name('roleBased.download');
    Route::get('/jalshala/summary', [DistrictWiseJalshalaSummary::class, 'generate'])->name('jalshala.summary');
    Route::get('/so-task/summary', [DivisionWiseSoTaskSummary::class, 'generate'])->name('divisionSoTask.summary');
    Route::get('/so-task/report', [SoAssignedTaskCompletionReport::class, 'generate'])->name('soTask.report');
    Route::get('/schemes-without-so', [SchemesWithoutSo::class, 'generate'])->name('schemesWoSo.report');
    Route::get('/contractors/completed-tasks-report', [ContractorsCompletedTasksReport::class, 'generate'])->name('contractorsCompletedTask.report');
    Route::get('/schemes-without-imis/report', [SchemeWithoutOrWrongImis::class, 'generate'])->name('schemesWoImis.report');
    Route::get('/district-wise/summary', [DistrictWiseVillageSchemeWucSummary::class, 'generate'])->name('districtWise.summary');
    Route::get('/workorders/without-pg/report', WorkordersWithoutPgController::class)->name('woWithoutPg.report');
    Route::get('/district/wuc/', Reports\DistrictWiseWuc::class)->name('districtWuc.report');
	Route::get('villages-without-ias', [VillagesWithoutIsaReportController::class, 'generate'])->name('villagesWithoutIsa.report');
	Route::get('scheme-without-wuc', Reports\SchemesWithoutWuc::class)->name('schemeWithOutWuc.report');
	Route::get('schemes-without-ias', [SchemesWithoutIsaReportController::class, 'generate'])->name('schemesWithoutIsa.report');
	Route::get('/reports/division/litholog', Reports\DivisionWiseLitholog::class)->name('reports.divisionLitholog');
    Route::get('/{division}/litholog-reports', [DivisionWiseLithologReportController::class, 'generateLocation'])->name('division.locationLithologs');
    Route::get('/{division}/lithology-reports', [DivisionWiseLithologReportController::class, 'generateLithologies'])->name('division.lithologiesLithologs');
    Route::get('/{division}/casing-reports', [DivisionWiseLithologReportController::class, 'generateCasingReports'])->name('division.casingLithologs');
    Route::get('/{division}/aquifer-reports', [DivisionWiseLithologReportController::class, 'generateAquiferReports'])->name('division.aquiferLithologs');
    Route::get('/{division}/orientation-reports', [DivisionWiseLithologReportController::class, 'generateOrientationReports'])->name('division.orientationLithologs');
    Route::get('/multiple-wuc-scheme/report', [SchemesWithMultipleWucsController::class, 'generate'])->name('multipleWucReport');
	Route::get('/division/network-report', Reports\DivisionDistributionReport::class)->name('divisionNetwork.report');
    Route::get('/pg-detail/report', Reports\FavourWisePg::class)->name('pgDetailReport');
    Route::get('/schemes-latest-flowmeter', [SchemewiseLatestFlowmeterReading::class, 'generate'])->name('latestFlowmeter.report');
    Route::get('report/water-disruption-weekly-report', [WaterDisruptionWeeklyReport::class, 'generate'])->name('water-disruption-weekly.report');

	Route::get('trainer-lists', TrainerListReportController::class)->name('trainerList.report');

	// District Level Trainings
	Route::get('districtleveltraings', DistrictLevelTrainings\Index::class)->name('districtleveltraings');
	Route::get('districtleveltraings/create', DistrictLevelTrainings\Create::class)->name('districtleveltraings.create');

	// Helpdesk
	Route::get('article-categories', ArticleCategories\Index::class)->name('articlecategories');
	Route::get('article-categories/create', ArticleCategories\Create::class)->name('articlecategories.create');
	Route::get('article-categories/{articlecategory}/edit', ArticleCategories\Edit::class)->name('articlecategories.edit');

	Route::get('articles', Article\Index::class)->name('articles');
	Route::get('articles/create', Article\Create::class)->name('articles.create');
	Route::get('articles/{article}/edit', Article\Edit::class)->name('articles.edit');

	//Members
	Route::get('members', Members\Index::class)->name('members');
	Route::get('members/create', Members\Create::class)->name('members.create');

	// Changelogs
	Route::get('changelogs', Changelogs\Index::class)->name('changelogs');
	Route::get('changelogs/create', Changelogs\Create::class)->name('changelogs.create')->can('admin');

	// Jal Addas
	Route::get('jaladdas', JalAddas\Index::class)->name('jaladdas.index');
	Route::get('jaladdas/create', JalAddas\Create::class)->middleware('role:district-jaldoot-cell')->name('jaladdas.create');
	Route::get('jaladdas/{jaladda}/edit', JalAddas\Edit::class)->name('jaladdas.edit');
	Route::get('jaladdas/{jaladda}/show', JalAddas\Show::class)->name('jaladdas.show');
	Route::get('jaladdas/{jaladda}/student', JalAddas\Student::class)->name('jaladdas.student');
	Route::get('jaladdas/{jaladda}/image', JalAddas\Image::class)->name('jaladdas.image');

	// Banner
	Route::get('banners', Banner\Index::class)->name('banners');
	Route::get('banner/create', Banner\Create::class)->name('banner.create');

	// Demo IOT
	// Route::get('iot', IotController::class);

	//Backups
	Route::get('backups', Backups\Index::class)->name('backups');

	// Water Disruption Report
	Route::get('water-disruption-report', Schemes\WaterReport\Index::class)->name('no-water-report');
	Route::get('water-disruption-report/{waterReport}/show', Schemes\WaterReport\View::class)->name('no-water-report.show');

	// Logs
	Route::get('logs', ApiLogStats::class)->name('logs');

});

// Notifications
// Route::get('notifications', Notifications\Index::class)->middleware(['auth'])->name('notifications');

// Tinymce Image Upload Endpoint
Route::post('tinymce/upload', TinymceImageUploadController::class)->name('tinymce.upload');

//Testing Route
Route::get('schemes-map-public', Schemes\Map::class)->name('schemes.map');

// Whatsapp Link for Flowmeter
Route::get('/flowmeter-reading', function () {
    return redirect('https://play.google.com/store/apps/details?id=tech.sumato.jjm.jalmitra&hl=en');
});


require __DIR__ . '/auth.php';
