<?php


use App\Http\Controllers\BCCStaffController;
use App\Http\Controllers\BjetController;
use App\Http\Controllers\BKIICTBatchController;
use App\Http\Controllers\BKIICTStudentController;
use App\Http\Controllers\BKIICTTeacherController;
use App\Http\Controllers\BKIICTCenterController;
use App\Http\Controllers\BKIICTCourseController;
use App\Http\Controllers\BKIICTCoursePdfController;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\IEENoticeController;
use App\Http\Controllers\ISPController;
use App\Http\Controllers\ITEEAdmitCardController;
use App\Http\Controllers\ITEEExamCategoryController;
use App\Http\Controllers\ITEEExamTypeController;
use App\Http\Controllers\ITEEBooksController;
use App\Http\Controllers\ITEEExamFeeController;
use App\Http\Controllers\ITEECourseOutlineController;
use App\Http\Controllers\ITEEExamApplicationController;
use App\Http\Controllers\IteeProgramsController;
use App\Http\Controllers\IteeRecentEventsController;
use App\Http\Controllers\ITEEResultPdfsController;
use App\Http\Controllers\ITEEResultsController;
use App\Http\Controllers\ITEEStudentsController;
use App\Http\Controllers\ITEESyllabusController;
use App\Http\Controllers\ITEEVenueController;
use App\Http\Controllers\NDCAppointmentController;
use App\Http\Controllers\NDCUserController;
use App\Http\Controllers\NTTNDataController;
use App\Http\Controllers\NttnProviderController;
use App\Http\Controllers\NTTNStaffController;
use App\Http\Controllers\PdfDownloadController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PutData;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UnionController;
use App\Http\Controllers\UpazilaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleManagementController;
use App\Http\Controllers\VMCarAssign;
use App\Http\Controllers\VMCarAssignController;
use App\Http\Controllers\VMCarController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    //want to remove to fit examinee routes
    // if (auth()->check()) {
    //     return redirect()->route('dashboard');
    // } else {
    //     return redirect()->route('login');
    // }

    return view('examinee.home');
});

//make dashboard route to fit examinee
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    //notification
    Route::get('/notification/read', [DashboardController::class, 'notificationRead'])->name('notification.read');

    // ISP Connections
    Route::get('/isp-connections', [ConnectionController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of ISP Connection')->name('isp_connection.index');
    Route::get('/isp-connection/{id}', [ConnectionController::class, 'view'])->middleware('role_or_permission:Super Admin|View ISP Connection')->name('isp_connection.view');
    Route::post('/isp-connection/approve/{id}', [ConnectionController::class, 'approve'])->middleware('role_or_permission:Super Admin|Approve ISP Connection')->name('isp_connection.approve');
    Route::post('/isp-connection/reject/{id}', [ConnectionController::class, 'reject'])->middleware('role_or_permission:Super Admin|Approve ISP Connection')->name('isp_connection.reject');


    // ISP Connections
    Route::prefix('/isp')->name('isp.')->group(function () {
        Route::get('/', [ISPController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of ISP')->name('index');
        Route::get('/{id}', [ISPController::class, 'view'])->middleware('role_or_permission:Super Admin|View ISP')->name('view');
        Route::post('/approve/{id}', [ISPController::class, 'approve'])->middleware('role_or_permission:Super Admin|Approve ISP')->name('approve');
        Route::post('/delete/{id}', [ISPController::class, 'delete'])->middleware('role_or_permission:Super Admin|Approve ISP')->name('delete');
    });


    // ISP Connections Search
    Route::get('/connections-search', [ConnectionController::class, 'search'])->middleware('role_or_permission:Super Admin|Search ISP Connection')->name('ispconnection.search');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/permission-by-role', [PermissionController::class, 'getPermissionByRole'])->middleware('role_or_permission:Super Admin|Manage Permission')->name('get.permission.by.role');
    Route::match(['get', 'post'], '/permission/manage', [PermissionController::class, 'managePermission'])->middleware('role_or_permission:Super Admin|Manage Permission')->name('permission.manage');

    Route::post('/change/password/{id}', [BCCStaffController::class, 'changePassword'])->name('change.password');
    // user
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/index', [UserController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of User')->name('index');
        Route::get('/create', [UserController::class, 'create'])->middleware('role_or_permission:Super Admin|Create User')->name('create');
        Route::post('/save', [UserController::class, 'store'])->middleware('role_or_permission:Super Admin|Create User')->name('store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->middleware('role_or_permission:Super Admin|Manage User')->name('edit');
        Route::get('/delete/{id}', [UserController::class, 'delete'])->middleware('role_or_permission:Super Admin|Manage User')->name('delete');
        Route::get('/{id}', [UserController::class, 'view'])->name('view');
    });

    // BCC
    Route::get('/bcc-staffs', [BCCStaffController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of BCC Staff')->name('bcc_staff.index');
    Route::get('/bcc-staff/create', [BCCStaffController::class, 'create'])->middleware('role_or_permission:Super Admin|Create BCC Staff')->name('bcc_staff.create');
    Route::post('/bcc-staff/save', [BCCStaffController::class, 'store'])->middleware('role_or_permission:Super Admin|Create BCC Staff')->name('bcc_staff.store');
    Route::get('/bcc-staff/edit/{id}', [BCCStaffController::class, 'edit'])->middleware('role_or_permission:Super Admin|Manage BCC Staff')->name('bcc_staff.edit');
    Route::get('/bcc-staff/delete/{id}', [BCCStaffController::class, 'delete'])->middleware('role_or_permission:Super Admin|Manage BCC Staff')->name('bcc_staff.delete');
    Route::get('/bcc-staff/{id}', [BCCStaffController::class, 'view'])->name('bcc_staff.view');

    // NTTN
    Route::get('/nttn-sttafs', [NTTNStaffController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of NTTN Staff')->name('nttn_staff.index');
    Route::get('/nttn-sttaf/create', [NTTNStaffController::class, 'create'])->middleware('role_or_permission:Super Admin|Create NTTN Staff')->name('nttn_staff.create');
    Route::post('/nttn-sttaf/save', [NTTNStaffController::class, 'store'])->middleware('role_or_permission:Super Admin|Create NTTN Staff')->name('nttn_staff.save');
    Route::get('/nttn-sttaf/edit/{id}', [NTTNStaffController::class, 'edit'])->middleware('role_or_permission:Super Admin|Manage NTTN Staff')->name('nttn_staff.edit');
    Route::get('/nttn-sttaf/delete/{id}', [NTTNStaffController::class, 'delete'])->middleware('role_or_permission:Super Admin|Manage NTTN Staff')->name('nttn_staff.delete');
    Route::get('/nttn-sttaf/{id}', [NTTNStaffController::class, 'view'])->name('nttn_staff.view');

    // NTTN Datas
    Route::get('/nttn-datas', [NTTNDataController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of NTTN Datas')->name('nttn.index');
    // Route::get('/nttn-records/{type?}', [NTTNDataController::class, 'records'])->name('nttn.records');
    Route::match(['GET', 'POST'], '/nttn-data/create', [NTTNDataController::class, 'create'])->middleware('role_or_permission:Super Admin|Create NTTN Data')->name('nttn.create');
    Route::match(['GET', 'POST'], '/nttn-data/edit/{id}', [NTTNDataController::class, 'edit'])->middleware('role_or_permission:Super Admin|Manage NTTN Data')->name('nttn.edit');
    Route::get('/nttn-data/delete/{id}', [NTTNDataController::class, 'delete'])->middleware('role_or_permission:Super Admin|Manage NTTN Data')->name('nttn.delete');
    Route::get('/nttn-data/{id}', [NTTNDataController::class, 'view'])->name('nttn.view');

    Route::prefix('role')->name('role.')->group(function () {
        Route::get('/index', [RoleController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Role')->name('index');
        Route::get('/create', [RoleController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Role')->name('create');
        Route::get('/edit/{id}', [RoleController::class, 'manage'])->middleware('role_or_permission:Super Admin|Manage Role')->name('edit');
        Route::post('/save', [RoleController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Role|Manage Role')->name('save');
        Route::get('/delete/{id}', [RoleController::class, 'destroy'])->middleware('role_or_permission:Super Admin|Delete Role')->name('delete');
    });

    // Regions
    Route::prefix('regions')->name('regions.')->middleware('role_or_permission:Super Admin|Manage Regions')->group(function () {
        // Division
        Route::get('/division', [DivisionController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Regions')->name('division.index');
        Route::match(['GET', 'POST'], '/division/create', [DivisionController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Regions')->name('division.create');
        Route::match(['GET', 'POST'], '/division/edit/{id}', [DivisionController::class, 'edit'])->middleware('role_or_permission:Super Admin|Manage Regions')->name('division.edit');
        Route::get('/division/delete/{id}', [DivisionController::class, 'delete'])->middleware('role_or_permission:Super Admin|Delete Regions')->name('division.delete');

        // District
        Route::get('/district', [DistrictController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Regions')->name('district.index');
        Route::match(['GET', 'POST'], '/district/create', [DistrictController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Regions')->name('district.create');
        Route::match(['GET', 'POST'], '/district/edit/{id}', [DistrictController::class, 'edit'])->middleware('role_or_permission:Super Admin|Manage Regions')->name('district.edit');
        Route::get('/district/delete/{id}', [DistrictController::class, 'delete'])->middleware('role_or_permission:Super Admin|Delete Regions')->name('district.delete');

        // Upazila
        Route::get('/upazila', [UpazilaController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Regions')->name('upazila.index');
        Route::match(['GET', 'POST'], '/upazila/create', [UpazilaController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Regions')->name('upazila.create');
        Route::match(['GET', 'POST'], '/upazila/edit/{id}', [UpazilaController::class, 'edit'])->middleware('role_or_permission:Super Admin|Manage Regions')->name('upazila.edit');
        Route::get('/upazila/delete/{id}', [UpazilaController::class, 'delete'])->middleware('role_or_permission:Super Admin|Delete Regions')->name('upazila.delete');

        // Union
        Route::get('/union', [UnionController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Regions')->name('union.index');
        Route::match(['GET', 'POST'], '/union/create', [UnionController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Regions')->name('union.create');
        Route::match(['GET', 'POST'], '/union/edit/{id}', [UnionController::class, 'edit'])->middleware('role_or_permission:Super Admin|Manage Regions')->name('union.edit');
        Route::get('/union/delete/{id}', [UnionController::class, 'delete'])->middleware('role_or_permission:Super Admin|Delete Regions')->name('union.delete');
    });

    //NDC
    Route::prefix('ndc')->name('ndc.')->group(function () {
        Route::prefix('/user')->name('user.')->group(function () {
            Route::get('/index', [NDCUserController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of NDC User')->name('index');
            Route::get('/create', [NDCUserController::class, 'create'])->middleware('role_or_permission:Super Admin|Create NDC User')->name('create');
            Route::post('/save', [NDCUserController::class, 'store'])->middleware('role_or_permission:Super Admin|Create NDC User')->name('store');
            Route::get('/edit/{id}', [NDCUserController::class, 'edit'])->middleware('role_or_permission:Super Admin|Manage NDC User')->name('edit');
            Route::get('/delete/{id}', [NDCUserController::class, 'delete'])->middleware('role_or_permission:Super Admin|Manage NDC User')->name('delete');
            Route::get('/{id}', [NDCUserController::class, 'view'])->middleware('role_or_permission:Super Admin|List Of NDC User')->name('view');
        });

        Route::prefix('/appointment')->name('appointment.')->group(function () {
            Route::get('/index', [NDCAppointmentController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of NDC Appointment')->name('index');
            Route::get('/create', [NDCAppointmentController::class, 'create'])->middleware('role_or_permission:Super Admin|Create NDC Appointment')->name('create');
            Route::post('/save', [NDCAppointmentController::class, 'store'])->middleware('role_or_permission:Super Admin|Create NDC Appointment')->name('store');
            Route::post('/edit/{id}', [NDCAppointmentController::class, 'edit'])->middleware('role_or_permission:Super Admin|Manage NDC Appointment')->name('edit');
            Route::post('/transfer/{id}', [NDCAppointmentController::class, 'transfer'])->middleware('role_or_permission:Super Admin|Manage NDC Appointment')->name('transfer');
            Route::post('/update_entry_time', [NDCAppointmentController::class, 'update_entry_time'])->middleware('role_or_permission:Super Admin|Manage NDC Appointment')->name('update_entry_time');
            Route::get('/approve/{id}', [NDCAppointmentController::class, 'approve'])->middleware('role_or_permission:Super Admin|Approve NDC Appointment')->name('approve');
            Route::get('/decline/{id}', [NDCAppointmentController::class, 'decline'])->middleware('role_or_permission:Super Admin|Approve NDC Appointment')->name('decline');
            Route::get('/print/{id}', [NDCAppointmentController::class, 'print'])->middleware('role_or_permission:Super Admin|Print NDC Appointment')->name('print');
            Route::get('/{id}', [NDCAppointmentController::class, 'view'])->middleware('role_or_permission:Super Admin|List Of NDC Appointment')->name('view');
            Route::post('document/{id}', [NDCAppointmentController::class, 'documentUpload'])->middleware('role_or_permission:Super Admin|List Of NDC Appointment')->name('upload.document');
        });
    });

    // ITEE Exam
    Route::prefix('itee')->name('itee.')->group(function () {

        // Students
        Route::prefix('/students')->name('students.')->group(function () {
            Route::get('/index', [ITEEStudentsController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of ITEE Students')->name('index');
            Route::get('/create', [ITEEStudentsController::class, 'create'])->middleware('role_or_permission:Super Admin|Create ITEE Students')->name('create');
            Route::post('/save', [ITEEStudentsController::class, 'store'])->middleware('role_or_permission:Super Admin|Create ITEE Students')->name('store');
            Route::get('/student/edit/{id}', [ITEEStudentsController::class, 'edit'])->middleware('role_or_permission:Super Admin|Update ITEE Students')->name('edit');
            Route::get('/delete/{id}', [ITEEStudentsController::class, 'delete'])->middleware('role_or_permission:Super Admin|Delete ITEE Students')->name('delete');
            Route::get('/{id}', [ITEEStudentsController::class, 'view'])->middleware('role_or_permission:Super Admin|List Of ITEE Students')->name('view');
        });

        Route::prefix('/notice')->name('notice.')->group(function () {
            Route::get('/index', [IEENoticeController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of ITEE Notice')->name('index');
            Route::get('/create', [IEENoticeController::class, 'create'])->middleware('role_or_permission:Super Admin|Create ITEE Notice')->name('create');
            Route::post('/save', [IEENoticeController::class, 'store'])->middleware('role_or_permission:Super Admin|Create ITEE Notice')->name('store');
            Route::get('/edit/{id}', [IEENoticeController::class, 'edit'])->middleware('role_or_permission:Super Admin|Update ITEE Notice')->name('edit');
            Route::get('/delete/{id}', [IEENoticeController::class, 'delete'])->middleware('role_or_permission:Super Admin|Delete ITEE Notice')->name('delete');
        });

        Route::prefix('/venue')->name('venue.')->group(function () {
            Route::get('/index', [ITEEVenueController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of ITEE Venue')->name('index');
            Route::get('/create', [ITEEVenueController::class, 'create'])->middleware('role_or_permission:Super Admin|Create ITEE Venue')->name('create');
            Route::post('/save', [ITEEVenueController::class, 'store'])->middleware('role_or_permission:Super Admin|Create ITEE Venue')->name('store');
            Route::get('/edit/{id}', [ITEEVenueController::class, 'edit'])->middleware('role_or_permission:Super Admin|Update ITEE Venue')->name('edit');
            Route::get('/delete/{id}', [ITEEVenueController::class, 'delete'])->middleware('role_or_permission:Super Admin|Delete ITEE Venue')->name('delete');
        });

        Route::prefix('/exam/category')->name('exam.category.')->group(function () {
            Route::get('/index', [ITEEExamCategoryController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of ITEE Exam Category')->name('index');
            Route::get('/create', [ITEEExamCategoryController::class, 'create'])->middleware('role_or_permission:Super Admin|Create ITEE Exam Category')->name('create');
            Route::post('/save', [ITEEExamCategoryController::class, 'store'])->middleware('role_or_permission:Super Admin|Create ITEE Exam Category')->name('store');
            Route::get('/edit/{id}', [ITEEExamCategoryController::class, 'edit'])->middleware('role_or_permission:Super Admin|Update ITEE Exam Category')->name('edit');
            Route::get('/delete/{id}', [ITEEExamCategoryController::class, 'delete'])->middleware('role_or_permission:Super Admin|Delete ITEE Exam Category')->name('delete');
        });

        Route::prefix('/exam/type')->name('exam.type.')->group(function () {
            Route::get('/index', [ITEEExamTypeController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of ITEE Exam Type')->name('index');
            Route::get('/create', [ITEEExamTypeController::class, 'create'])->middleware('role_or_permission:Super Admin|Create ITEE Exam Type')->name('create');
            Route::post('/save', [ITEEExamTypeController::class, 'store'])->middleware('role_or_permission:Super Admin|Create ITEE Exam Type')->name('store');
            Route::get('/edit/{id}', [ITEEExamTypeController::class, 'edit'])->middleware('role_or_permission:Super Admin|Update ITEE Exam Type')->name('edit');
            Route::get('/delete/{id}', [ITEEExamTypeController::class, 'delete'])->middleware('role_or_permission:Super Admin|Delete ITEE Exam Type')->name('delete');
        });

        Route::prefix('/syllabus')->name('syllabus.')->group(function () {
            Route::get('/index', [ITEESyllabusController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of ITEE Syllabus')->name('index');
            Route::get('/create', [ITEESyllabusController::class, 'create'])->middleware('role_or_permission:Super Admin|Create ITEE Syllabus')->name('create');
            Route::post('/save', [ITEESyllabusController::class, 'store'])->middleware('role_or_permission:Super Admin|Create ITEE Syllabus')->name('store');
            Route::get('/edit/{id}', [ITEESyllabusController::class, 'edit'])->middleware('role_or_permission:Super Admin|Update ITEE Syllabus')->name('edit');
            Route::get('/delete/{id}', [ITEESyllabusController::class, 'delete'])->middleware('role_or_permission:Super Admin|Delete ITEE Syllabus')->name('delete');
        });

        Route::prefix('/course/outline')->name('course.outline.')->group(function () {
            Route::get('/index', [ITEECourseOutlineController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of ITEE Course Outline')->name('index');
            Route::get('/create', [ITEECourseOutlineController::class, 'create'])->middleware('role_or_permission:Super Admin|Create ITEE Course Outline')->name('create');
            Route::post('/save', [ITEECourseOutlineController::class, 'store'])->middleware('role_or_permission:Super Admin|Create ITEE Course Outline')->name('store');
            Route::get('/edit/{id}', [ITEECourseOutlineController::class, 'edit'])->middleware('role_or_permission:Super Admin|Update ITEE Course Outline')->name('edit');
            Route::get('/delete/{id}', [ITEECourseOutlineController::class, 'delete'])->middleware('role_or_permission:Super Admin|Delete ITEE Course Outline')->name('delete');
        });

        // Exam application list
        Route::prefix('/exam/application/')->name('exam.application.')->group(function () {
            Route::get('/index', [ITEEExamApplicationController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of ITEE Exam Application')->name('index');
            Route::match(['get', 'post'], '/import', [ITEEExamApplicationController::class, 'import'])->middleware('role_or_permission:Super Admin|Manage ITEE Exam Application')->name('import');
            Route::match(['get', 'post'], '/choose-export', [ITEEExamApplicationController::class, 'chooseExport'])->middleware('role_or_permission:Super Admin|Manage ITEE Exam Application')->name('choose-export');
            Route::get('/approve/{id}', [ITEEExamApplicationController::class, 'approve'])->middleware('role_or_permission:Super Admin|Manage ITEE Exam Application')->name('approve');
            Route::get('/{id}', [ITEEExamApplicationController::class, 'view'])->middleware('role_or_permission:Super Admin|List Of ITEE Exam Application')->name('view');
            Route::get('/delete/{id}', [ITEEExamApplicationController::class, 'delete'])->middleware('role_or_permission:Super Admin|Manage ITEE Exam Application')->name('delete');
        });

        // Books
        Route::prefix('/books')->name('books.')->group(function () {
            Route::get('/index', [ITEEBooksController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of ITEE Books')->name('index');
            Route::get('/create', [ITEEBooksController::class, 'create'])->middleware('role_or_permission:Super Admin|Create ITEE Books')->name('create');
            Route::post('/save', [ITEEBooksController::class, 'store'])->middleware('role_or_permission:Super Admin|Create ITEE Books')->name('store');
            Route::get('edit/{id}', [ITEEBooksController::class, 'edit'])->middleware('role_or_permission:Super Admin|Update ITEE Books')->name('edit');
            Route::get('/delete/{id}', [ITEEBooksController::class, 'delete'])->middleware('role_or_permission:Super Admin|Delete ITEE Books')->name('delete');
            Route::get('{id}', [ITEEBooksController::class, 'view'])->middleware('role_or_permission:Super Admin|List Of ITEE Books')->name('view');
        });

        // Exam fee
        Route::prefix('/exam-fee')->name('exam-fee.')->group(function () {
            Route::get('/index', [ITEEExamFeeController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of ITEE ExamFee')->name('index');
            Route::get('/create', [ITEEExamFeeController::class, 'create'])->middleware('role_or_permission:Super Admin|Create ITEE ExamFee')->name('create');
            Route::post('/save', [ITEEExamFeeController::class, 'store'])->middleware('role_or_permission:Super Admin|Create ITEE ExamFee')->name('store');
            Route::get('edit/{id}', [ITEEExamFeeController::class, 'edit'])->middleware('role_or_permission:Super Admin|Update ITEE ExamFee')->name('edit');
            Route::get('/delete/{id}', [ITEEExamFeeController::class, 'delete'])->middleware('role_or_permission:Super Admin|Delete ITEE ExamFee')->name('delete');
            Route::get('{id}', [ITEEExamFeeController::class, 'view'])->middleware('role_or_permission:Super Admin|List Of ITEE ExamFee')->name('view');
        });

        // Admit Card Data
        Route::prefix('/admit-card')->name('admit-card.')->group(function () {
            Route::get('/index', [ITEEAdmitCardController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of ITEE Admit Card')->name('index');
            Route::get('/create', [ITEEAdmitCardController::class, 'create'])->middleware('role_or_permission:Super Admin|Create ITEE Admit Card')->name('create');
            Route::match(['get', 'post'], '/import', [ITEEAdmitCardController::class, 'import'])->middleware('role_or_permission:Super Admin|Create ITEE Admit Card')->name('import');
            Route::post('/save', [ITEEAdmitCardController::class, 'store'])->middleware('role_or_permission:Super Admin|Create ITEE Admit Card')->name('store');
            Route::get('/edit/{id}', [ITEEAdmitCardController::class, 'edit'])->middleware('role_or_permission:Super Admin|Update ITEE Admit Card')->name('edit');
            Route::get('/delete/{id}', [ITEEAdmitCardController::class, 'delete'])->middleware('role_or_permission:Super Admin|Delete ITEE Admit Card')->name('delete');
            Route::get('/{id}', [ITEEAdmitCardController::class, 'view'])->middleware('role_or_permission:Super Admin|List Of ITEE Admit Card')->name('view');
        });

        // Results
        Route::prefix('/results')->name('results.')->group(function () {
            Route::get('/index', [ITEEResultsController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of ITEE Results')->name('index');
            Route::get('/create', [ITEEResultsController::class, 'create'])->middleware('role_or_permission:Super Admin|Create ITEE Results')->name('create');
            Route::match(['get', 'post'], '/import', [ITEEResultsController::class, 'import'])->middleware('role_or_permission:Super Admin|Create ITEE Results')->name('import');
            Route::post('/save', [ITEEResultsController::class, 'store'])->middleware('role_or_permission:Super Admin|Create ITEE Results')->name('store');
            Route::get('/edit/{id}', [ITEEResultsController::class, 'edit'])->middleware('role_or_permission:Super Admin|Update ITEE Results')->name('edit');
            Route::get('/delete/{id}', [ITEEResultsController::class, 'delete'])->middleware('role_or_permission:Super Admin|Delete ITEE Results')->name('delete');
            Route::get('/{id}', [ITEEResultsController::class, 'view'])->middleware('role_or_permission:Super Admin|List Of ITEE Results')->name('view');
        });

        // BJET Events
        Route::prefix('/bjet')->name('bjet.')->group(function () {
            Route::get('/index', [BjetController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Bjet Events')->name('index');
            Route::get('/create', [BjetController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Bjet Events')->name('create');
            Route::post('/save', [BjetController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Bjet Events')->name('store');
            Route::get('/edit/{id}', [BjetController::class, 'edit'])->middleware('role_or_permission:Super Admin|Update Bjet Events')->name('edit');
            Route::get('/delete/{id}', [BjetController::class, 'delete'])->middleware('role_or_permission:Super Admin|Delete Bjet Events')->name('delete');
            Route::get('/{id}', [BjetController::class, 'view'])->middleware('role_or_permission:Super Admin|List Of Bjet Events')->name('view');
        });

        // ITEE Programs
        Route::prefix('/programs')->name('programs.')->group(function () {
            Route::get('/index', [IteeProgramsController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of ITEE Programs')->name('index');
            Route::get('/create', [IteeProgramsController::class, 'create'])->middleware('role_or_permission:Super Admin|Create ITEE Programs')->name('create');
            Route::post('/save', [IteeProgramsController::class, 'store'])->middleware('role_or_permission:Super Admin|Create ITEE Programs')->name('store');
            Route::get('/edit/{id}', [IteeProgramsController::class, 'edit'])->middleware('role_or_permission:Super Admin|Update ITEE Programs')->name('edit');
            Route::get('/delete/{id}', [IteeProgramsController::class, 'delete'])->middleware('role_or_permission:Super Admin|Delete ITEE Programs')->name('delete');
            Route::get('/{id}', [IteeProgramsController::class, 'view'])->middleware('role_or_permission:Super Admin|List Of ITEE Programs')->name('view');
        });

        // Recent Events
        Route::prefix('/recent-events')->name('recent-events.')->group(function () {
            Route::get('/index', [IteeRecentEventsController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Recent Events')->name('index');
            Route::get('/create', [IteeRecentEventsController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Recent Events')->name('create');
            Route::post('/save', [IteeRecentEventsController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Recent Events')->name('store');
            Route::get('/edit/{id}', [IteeRecentEventsController::class, 'edit'])->middleware('role_or_permission:Super Admin|Update Recent Events')->name('edit');
            Route::get('/delete/{id}', [IteeRecentEventsController::class, 'delete'])->middleware('role_or_permission:Super Admin|Delete Recent Events')->name('delete');
            Route::get('/{id}', [IteeRecentEventsController::class, 'view'])->middleware('role_or_permission:Super Admin|List Of Recent Events')->name('view');
        });

    });

    // VM Log
    Route::prefix('vm')->name('vm.')->group(function () {
        // driver Information
        Route::prefix('user')->name('user.')->group(function () {
            Route::get('/index', [VehicleManagementController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of Vehicle Management User')->name('index');
            Route::get('/create', [VehicleManagementController::class, 'create'])->middleware('role_or_permission:Super Admin|Create Vehicle Management User')->name('create');
            Route::post('/save', [VehicleManagementController::class, 'store'])->middleware('role_or_permission:Super Admin|Create Vehicle Management User')->name('store');
            Route::get('/edit/{id}', [VehicleManagementController::class, 'edit'])->middleware('role_or_permission:Super Admin|Manage Vehicle Management User')->name('edit');
            Route::get('/delete/{id}', [VehicleManagementController::class, 'delete'])->middleware('role_or_permission:Super Admin|Delete Vehicle Management User')->name('delete');
            Route::get('/{id}', [VehicleManagementController::class, 'view'])->middleware('role_or_permission:Super Admin|List Of Vehicle Management User')->name('view');
        });

        Route::prefix('staff-heirarchy')->name('staff-hierarchy.')->group(function () {
            Route::match(['get', 'post'], '/index', [VehicleManagementController::class, 'staffHierarchy'])->middleware('role_or_permission:Super Admin|View Staff Hierarchy')->name('index');
            Route::get('/staffs', [VehicleManagementController::class, 'staffs'])->middleware('role_or_permission:Super Admin|View Staff Hierarchy')->name('staffs');
        });

        // Car Information
        Route::prefix('cars')->name('cars.')->group(function () {
            Route::get('/info/index', [VMCarController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of VM Car Information')->name('index');
            Route::get('/info/create', [VMCarController::class, 'create'])->middleware('role_or_permission:Super Admin|Create VM Car Information')->name('create');
            Route::post('/info/save', [VMCarController::class, 'store'])->middleware('role_or_permission:Super Admin|Create VM Car Information')->name('store');
            Route::get('/info/view/{id}', [VMCarController::class, 'view'])->middleware('role_or_permission:Super Admin|Update VM Car Information')->name('view');
            Route::get('/info/edit/{id}', [VMCarController::class, 'edit'])->middleware('role_or_permission:Super Admin|Update VM Car Information')->name('edit');
            Route::get('/info/delete/{id}', [VMCarController::class, 'delete'])->middleware('role_or_permission:Super Admin|Delete VM Car Information')->name('delete');

            Route::prefix('assign')->name('assign.')->group(function () {
                Route::get('/index', [VMCarAssignController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of VM User Car Assign')->name('index');
                Route::get('/create', [VMCarAssignController::class, 'create'])->middleware('role_or_permission:Super Admin|Create VM User Car Assign')->name('create');
                Route::post('/save', [VMCarAssignController::class, 'store'])->middleware('role_or_permission:Super Admin|Create VM User Car Assign')->name('store');
                // Route::get('/view/{id}', [VMCarAssignController::class, 'view'])->middleware('role_or_permission:Super Admin|Delete VM Car Information')->name('view');
                // Route::get('/edit/{id}', [VMCarAssignController::class, 'edit'])->middleware('role_or_permission:Super Admin|Delete VM Car Information')->name('edit');
                Route::get('/delete/{id}', [VMCarAssignController::class, 'delete'])->middleware('role_or_permission:Super Admin|Delete VM User Car Assign')->name('delete');
            });
            Route::prefix('trip')->name('trip.')->group(function () {
                Route::get('/index', [TripController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of VM Trip')->name('index');
                Route::get('/view/{id}', [TripController::class, 'view'])->middleware('role_or_permission:Super Admin|View VM Trip')->name('view');
                Route::get('/approve/{id}', [TripController::class, 'approve'])->middleware('role_or_permission:Super Admin|Approve VM Trip')->name('approve');
                Route::post('/driver/assign', [TripController::class, 'assignCarInTrip'])->middleware('role_or_permission:Super Admin|VM Car Assign Trip')->name('driver.assign');
            });
        });

    });

    // BKIICT
    Route::prefix('bkiict')->name('bkiict.')->group(function () {
        // User
        Route::prefix('/user')->name('user.')->group(function () {
            Route::get('/index', [BKIICTStudentController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of BKIICT User')->name('index');
            Route::get('/create', [BKIICTStudentController::class, 'create'])->middleware('role_or_permission:Super Admin|Create BKIICT User')->name('create');
            Route::post('/save', [BKIICTStudentController::class, 'store'])->middleware('role_or_permission:Super Admin|Create BKIICT User')->name('store');
            Route::get('/student/edit/{id}', [BKIICTStudentController::class, 'edit'])->middleware('role_or_permission:Super Admin|Update BKIICT User')->name('edit');
            Route::get('/delete/{id}', [BKIICTStudentController::class, 'delete'])->middleware('role_or_permission:Super Admin|Delete BKIICT User')->name('delete');
            Route::get('/{id}', [BKIICTStudentController::class, 'view'])->name('view');
        });

        // Teacher
        Route::prefix('/teacher')->name('teacher.')->group(function () {
            Route::get('/index', [BKIICTTeacherController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of BKIICT Teacher')->name('index');
            Route::get('/create', [BKIICTTeacherController::class, 'create'])->middleware('role_or_permission:Super Admin|Create BKIICT Teacher')->name('create');
            Route::post('/save', [BKIICTTeacherController::class, 'store'])->middleware('role_or_permission:Super Admin|Create BKIICT Teacher')->name('store');
            Route::get('/teacher/edit/{id}', [BKIICTTeacherController::class, 'edit'])->middleware('role_or_permission:Super Admin|Update BKIICT Teacher')->name('edit');
            Route::get('/delete/{id}', [BKIICTTeacherController::class, 'delete'])->middleware('role_or_permission:Super Admin|Delete BKIICT Teacher')->name('delete');
            Route::get('/{id}', [BKIICTTeacherController::class, 'view'])->name('view');
        });
        Route::prefix('center')->name('center.')->group(function () {
            Route::get('/index', [BKIICTCenterController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of BKIICT Center')->name('index');
            Route::get('/create', [BKIICTCenterController::class, 'create'])->middleware('role_or_permission:Super Admin|Create BKIICT Center')->name('create');
            Route::post('/save', [BKIICTCenterController::class, 'store'])->middleware('role_or_permission:Super Admin|Create BKIICT Center')->name('store');
            Route::get('/edit/{id}', [BKIICTCenterController::class, 'edit'])->middleware('role_or_permission:Super Admin|Update BKIICT Center')->name('edit');
            Route::get('/delete/{id}', [BKIICTCenterController::class, 'delete'])->middleware('role_or_permission:Super Admin|Delete BKIICT Center')->name('delete');
            // Route::get('/{id}', [BKIICTCenterController::class, 'view'])->middleware('role_or_permission:Super Admin|List BKIICT Center')->name('view');
        });

        Route::prefix('course')->name('course.')->group(function () {
            Route::get('/index', [BKIICTCourseController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of BKIICT Course')->name('index');
            Route::get('/create', [BKIICTCourseController::class, 'create'])->middleware('role_or_permission:Super Admin|Create BKIICT Course')->name('create');
            Route::post('/save', [BKIICTCourseController::class, 'store'])->middleware('role_or_permission:Super Admin|Create BKIICT Course')->name('store');
            Route::get('/edit/{id}', [BKIICTCourseController::class, 'edit'])->middleware('role_or_permission:Super Admin|Update BKIICT Course')->name('edit');
            Route::get('/delete/{id}', [BKIICTCourseController::class, 'delete'])->middleware('role_or_permission:Super Admin|Delete BKIICT Course')->name('delete');
            // Route::get('/{id}', [BKIICTCourseController::class, 'view'])->middleware('role_or_permission:Super Admin|List BKIICT course')->name('view');
        });

        Route::prefix('batch')->name('batch.')->group(function () {
            Route::get('/index', [BKIICTBatchController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of BKIICT Batch')->name('index');
            Route::get('/create', [BKIICTBatchController::class, 'create'])->middleware('role_or_permission:Super Admin|Create BKIICT Batch')->name('create');
            Route::post('/store', [BKIICTBatchController::class, 'store'])->middleware('role_or_permission:Super Admin|Create BKIICT Batch|Update BKIICT Batch')->name('store');
            Route::get('/edit/{id}', [BKIICTBatchController::class, 'edit'])->middleware('role_or_permission:Super Admin|Update BKIICT Batch')->name('edit');
            Route::get('/delete/{id}', [BKIICTBatchController::class, 'delete'])->middleware('role_or_permission:Super Admin|Delete BKIICT Batch')->name('delete');
            // Route::post('/{id}', [BKIICTBatchController::class, 'view'])->middleware('role_or_permission:Super Admin|List BKIICT Batch')->name('view');
        });

        Route::prefix('course_pdf')->name('course_pdf.')->group(function () {
            Route::match(['get', 'post'], '/index', [BKIICTCoursePdfController::class, 'index'])->middleware('role_or_permission:Super Admin|List Of BKIICT Course PDF')->name('index');
            Route::get('/create', [BKIICTCoursePdfController::class, 'create'])->middleware('role_or_permission:Super Admin|Create BKIICT Course PDF')->name('create');
            Route::post('/store', [BKIICTCoursePdfController::class, 'store'])->middleware('role_or_permission:Super Admin|Create BKIICT Course PDF|Update BKIICT Course PDF')->name('store');
            Route::get('/edit/{id}', [BKIICTCoursePdfController::class, 'edit'])->middleware('role_or_permission:Super Admin|Update BKIICT Course PDF')->name('edit');
            Route::get('/delete/{id}', [BKIICTCoursePdfController::class, 'delete'])->middleware('role_or_permission:Super Admin|Delete BKIICT Course PDF')->name('delete');
        });
    });
});


// push nttn datas to database
// Route::match(['get', 'post'], '/put_data', [PutData::class, 'index'])->name('put_data');
// ---------



// PDF Download routes
Route::get('/ndc/download/pdf/{id}', [PdfDownloadController::class, 'ndc'])->name('ndc.download.pdf');
Route::get('/itee/download/admit/{id}', [PdfDownloadController::class, 'itee_admit'])->name('itee.download.admit');

require __DIR__ . '/auth.php';