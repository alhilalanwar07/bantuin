<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ServiceProviderController;
use App\Http\Controllers\API\SpecializationController;
use App\Http\Controllers\API\ServiceRequestController;
use App\Http\Controllers\API\MessageController;
use App\Http\Controllers\API\AdvertisementController;
use App\Http\Controllers\API\RatingController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\ProviderCertificationController;
use App\Http\Controllers\API\UserController;

// route test
Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});

Route::post('/register-customer', [UserController::class, 'registerCustomer']);
Route::post('/register-service-provider', [UserController::class, 'registerServiceProvider']);
Route::post('/login-customer', [UserController::class, 'loginCustomer']);
Route::post('/login-vendor', [UserController::class, 'loginVendor']);
Route::get('/list-specializations', [UserController::class, 'listSpecializations']);

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::post('/fcm-token', [UserController::class, 'storeFcmToken']);
    Route::get('/logout', [UserController::class, 'logout']);
    Route::get('/advertise', [UserController::class, 'advertise']);

    // API for service provider
    Route::get('/profil-vendor', [UserController::class, 'profilVendor']);
    Route::post('/upload-sertifikat', [UserController::class, 'simpanSertifikat']);
    Route::post('/tambah-keahlian', [UserController::class, 'tambahKeahlian']);
    Route::get('/list-keahlian-vendor', [UserController::class, 'listKeahlianVendor']);
    Route::post('/upload-foto', [UserController::class, 'uploadFoto']);
    Route::post('/update-profile-vendor', [UserController::class, 'updateProfileVendor']);
    Route::get('/list-broadcast', [UserController::class, 'listBroadcast']);
    Route::get('/detail-request/{id}', [UserController::class, 'detailRequest']);
    Route::post('/checkin-daily', [UserController::class, 'checkInDaily']);
    Route::post('/accept-job', [UserController::class, 'acceptJob']);
    Route::get('/list-transactions-vendor', [UserController::class, 'listTransactionsVendor']);
    Route::get('/detail-image/{referencenumber}', [UserController::class, 'lihatImage']);
    Route::get('/detail-image-result/{referencenumber}', [UserController::class, 'lihatImageResult']);
    Route::post('/cancel-bid', [UserController::class, 'cancelBid']);
    Route::post('/cancel-job', [UserController::class, 'cancelJob']);
    Route::post('/start-work', [UserController::class, 'startWork']);
    Route::post('/upload-photo-result', [UserController::class, 'uploadPhotoResult']);
    Route::get('/job-completed-this-month', [UserController::class, 'jobCompletedThisMonth']);
    Route::get('/income-this-month', [UserController::class, 'incomeThisMonth']);
    Route::get('/history-job', [UserController::class, 'historyJob']);
    // API for customer
    Route::get('/customer-profile', [UserController::class, 'profilCustomer']);
    Route::post('/upload-customer-photo', [UserController::class, 'uploadFotoCustomer']);
    Route::post('/update-customer-profile', [UserController::class, 'updateProfileCustomer']);
    Route::post('/broadcast-job-request', [UserController::class, 'broadcastJobRequest']);
    Route::get('/list-transactions-customer', [UserController::class, 'listJobOpen']);
    Route::get('/list-job', [UserController::class, 'listJob']);
    Route::get('/detail-bid/{referencenumber}', [UserController::class, 'detailPenawaran']);
    Route::get('/job-progress/{referencenumber}', [UserController::class, 'jobProgress']);
    Route::get('/detail-provider/{id}', [UserController::class, 'detailProvider']);
    Route::post('/approve_bid', [UserController::class, 'approveBid']);
    Route::post('/approve-job-result', [UserController::class, 'approveJobResult']);
});

// Service Provider Routes
Route::apiResource('providers', ServiceProviderController::class);

// Specialization Routes
Route::apiResource('specializations', SpecializationController::class);

// Service Request Routes
Route::apiResource('service-requests', ServiceRequestController::class);
Route::get('service-requests/provider/{provider}', [ServiceRequestController::class, 'providerRequests']);

// Message Routes
Route::apiResource('messages', MessageController::class);
Route::patch('messages/read/{message}', [MessageController::class, 'markAsRead']);

// Advertisement Routes
Route::apiResource('advertisements', AdvertisementController::class);
Route::get('active-advertisements', [AdvertisementController::class, 'activeAds']);

// Rating Routes
Route::apiResource('ratings', RatingController::class);
Route::get('provider-ratings/{provider}', [RatingController::class, 'providerRatings']);

// Notification Routes
Route::prefix('notifications')->group(function () {
    Route::get('/', [NotificationController::class, 'index']);
    Route::patch('/{id}/read', [NotificationController::class, 'markAsRead']);
    Route::patch('/mark-all-read', [NotificationController::class, 'markAllAsRead']);
    Route::delete('/{id}', [NotificationController::class, 'destroy']);
});

// Provider Certification Routes
Route::apiResource('provider-certifications', ProviderCertificationController::class);
Route::get('provider/{provider}/certifications', [ProviderCertificationController::class, 'index']);
Route::post('provider-certifications/verify/{certification}', [ProviderCertificationController::class, 'verify']);

Route::get('/test', function () {
    return response()->json([
        'message' => 'Hello from Laravel!'
    ]);
});

Route::apiResource('users', UserController::class);