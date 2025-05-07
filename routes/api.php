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
    Route::get('/profil-vendor', [UserController::class, 'profilVendor']);
    Route::get('/profil-customer', [UserController::class, 'profilCustomer']);
    Route::post('/fcm-token', [UserController::class, 'storeFcmToken']);
    Route::get('/logout', [UserController::class, 'logout']);
    Route::post('/upload-sertifikat', [UserController::class, 'simpanSertifikat']);
    Route::post('/tambah-keahlian', [UserController::class, 'tambahKeahlian']);
    Route::get('/list-keahlian-vendor', [UserController::class, 'listKeahlianVendor']);
    Route::post('/upload-foto', [UserController::class, 'uploadFoto']);
    Route::post('/upload-foto-customer', [UserController::class, 'uploadFotoCustomer']);
    Route::post('/update-profile-vendor', [UserController::class, 'updateProfileVendor']);
    Route::post('/update-profile-customer', [UserController::class, 'updateProfileCustomer']);
    Route::post('/broadcast-request-bantuan', [UserController::class, 'broadcastRequestBantuan']);
    Route::get('/list-broadcast', [UserController::class, 'listBroadcast']);
    Route::get('/detail-request/{id}', [UserController::class, 'detailRequest']);
    Route::post('/checkin-daily', [UserController::class, 'checkInDaily']);
    Route::post('/accept-job', [UserController::class, 'acceptJob']);
    Route::get('/list-transactions-vendor', [UserController::class, 'listTransactionsVendor']);
    Route::get('/list-transactions-customer', [UserController::class, 'listTransactionsCustomer']);
    Route::get('/detail-image/{image}', [UserController::class, 'lihatImage']);
    Route::post('/canceled-job', [UserController::class, 'canceledJob']);
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