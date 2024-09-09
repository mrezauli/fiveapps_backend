<?php

use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\AreaController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BKIICTController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\ISPController;
use App\Http\Controllers\Api\ITEEController;
use App\Http\Controllers\Api\VLMController;
use App\Http\Middleware\OptionalAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/registration', [AuthController::class, 'registration']);
Route::post('/registration/confirm_otp', [AuthController::class, 'registrationConfirmOtp']);
Route::post('/login', [AuthController::class, 'sign_in']);

#Forget Password
Route::post('/send/forget/password/otp', [AuthController::class, 'sendOtp']);
Route::post('/verify/otp', [AuthController::class, 'verifyOtp']);
Route::post('/forget/password', [AuthController::class, 'forgetPassword']);

Route::get('/user', function (Request $request) {
    return auth()->user();
})->middleware('auth:sanctum');
Route::get('/dashboard/demo', [HomeController::class, 'index']);

Route::get('/itee/dashboard', [HomeController::class, 'iteeDashboard'])->middleware('optional.auth');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('sign/out', [AuthController::class, 'sign_out']);
    Route::get('/notification/read', [HomeController::class, 'notificationRead']);
    Route::get('/user/profile', [AuthController::class, 'userProfile']);
    Route::post('/user/profile/update', [AuthController::class, 'updateProfile']);
    Route::post('/user/profile/photo/update', [AuthController::class, 'updateProfilePhoto']);
    Route::post('/update/password', [AuthController::class, 'updatePassword']);

    #new isp connection
    Route::get('/dashboard', [HomeController::class, 'index']);
    Route::get('/division', [AreaController::class, 'division']);
    Route::get('/district/{division_id}', [AreaController::class, 'district']);
    Route::get('/upazila/{district_id}', [AreaController::class, 'upazila']);
    Route::get('/union/{upazila_id}', [AreaController::class, 'union']);
    Route::get('/nttn/provider/{union_id}', [AreaController::class, 'nttnProvider']);
    Route::post('/isp/new-connection', [ISPController::class, 'newConnection']);
    Route::post('/isp/update-connection', [ISPController::class, 'updateConnection']);

    // acccept or reject
    Route::post('/connection/accept/or/reject', [ISPController::class, 'acceptOrReject']);

    Route::get('/bcc/getconnections/{uid}', [ISPController::class, 'getBCCConnections']);

    // nttn
    Route::get('/nttn/connection', [ISPController::class, 'nttnConnection']);

    // search nttn
    Route::post('filter/nttn/connection', [ISPController::class, 'filterNttnConnection']);

    Route::prefix('ndc')->group(function () {
        Route::get('/dashboard', [HomeController::class, 'ndcDashboard']);
        Route::post('/appointment', [AppointmentController::class, 'appointmentRequest']);
        Route::post('guest/appointment', [AppointmentController::class, 'guestAppointmentRequest'])->withoutMiddleware('auth:sanctum');
        Route::post('/appointment/accept/or/reject', [AppointmentController::class, 'acceptOrReject']);
        Route::post('/visitor/entry', [AppointmentController::class, 'visitorEntry']);
        Route::post('/pdf', [AppointmentController::class, 'getPdf']);
        Route::post('/filter/data', [AppointmentController::class, 'filterData']);
    });

    Route::prefix('itee')->group(function () {
        // Route::get('/itee/dashboard', [HomeController::class, 'iteeDashboard']);
        Route::get('/syllabus', [ITEEController::class, 'syllabus']);
        Route::get('/course/outline', [ITEEController::class, 'courseOutline']);
        Route::get('/student/individual/result/{id}', [ITEEController::class, 'studentIndividualResult']);
        // Route::get('/student/result/{category}/{type}', [ITEEController::class, 'studentResult']);
        Route::get('/get-personal-info', [ITEEController::class, 'getPersonalInfo']);
        Route::get('/my-results-list', [ITEEController::class, 'myResutsList']);
        Route::get('/my-admitcards-list', [ITEEController::class, 'myAdmitCardsList']);
        Route::get('/my-unpaid-list', [ITEEController::class, 'myUnpaidList']);
        Route::get('/exam/apply/info', [ITEEController::class, 'getExamApplyInfo']);
        Route::get('/category/types/{category_id}', [ITEEController::class, 'categoryTypes']);
        Route::get('/get/exam/fee/{category_id}/{type_id}', [ITEEController::class, 'getExamFee']);
        Route::get('/get/book/fee/{category_name}', [ITEEController::class, 'getBookFee']);
        Route::post('/exam/registration', [ITEEController::class, 'examRegistration']);
        Route::post('/payment/exam/registration', [ITEEController::class, 'paymentExamRegistration']); // Male, Female
        Route::get('/admit/{id}', [ITEEController::class, 'getAdmit']);
        // Route::get('/admit/getInfo', [ITEEController::class, 'getAdmitInfo']);
    });

    Route::prefix('vlm')->group(function () {
        Route::get('/dashboard', [HomeController::class, 'vlmDashboard']);
        Route::post('/trip/request', [VLMController::class, 'tripRequest']);
        Route::get('/trip/start/{id}', [VLMController::class, 'startTrip']);
        Route::get('/trip/stop/{id}', [VLMController::class, 'stopTrip']);
        Route::post('/trip/accept/or/reject', [VLMController::class, 'acceptOrReject']);
        Route::post('/trip/assign/car', [VLMController::class, 'assignCarInTrip']);
        Route::get('/available/driver', [VLMController::class, 'availableDriver']);
    });


    Route::prefix('bkiict')->group(function () {
        Route::get('/dashboard/{type}', [HomeController::class, 'bkiictDashboard']); // done
        Route::get('/student/individual/result/{id}', [BKIICTController::class, 'studentIndividualResult']);
        Route::get('/center', [BKIICTController::class, 'getCenter']); // done
        Route::get('/center/type/wise/course/{center_id}/{type}', [BKIICTController::class, 'getCourse']); // done
        Route::get('/get-batches/{course_id}', [BKIICTController::class, 'getBatches']); // done
        Route::post('/course/registration', [BKIICTController::class, 'courseRegistration']); // done
        Route::post('/payment/course/registration', [BKIICTController::class, 'paymentCourseRegistration']); // done
        Route::get('/courseinfo/{course_id}/{batch_id}', [BKIICTController::class, 'getCourseInfo']); // done
        Route::get('/coursepdf', [BKIICTController::class, 'getCoursePdf']);
        Route::get('/result/pdf', [BKIICTController::class, 'getResultPdf']);
    });
});
