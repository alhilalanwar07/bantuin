<?php

use Illuminate\Support\Facades\{Route, Auth};
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Models\User;
use App\Http\Controllers\FrontendController;

// disable register, reset password
Auth::routes(['register' => false, 'reset' => false]);

// Frontend routes
Route::get('/', [FrontendController::class, 'index'])->name('frontend.home');


Route::middleware('auth')->prefix('admin')->group(function () {
    Route::view('dashboard', 'dashboard')->name('home');
    Route::view('profil', 'profil')->name('profil');
    Route::view('manajemen-user', 'manajemen-user')->name('admin.manajemen-user');
    Route::view('customer', 'admin/customer')->name('admin.customer');
    Route::view('advertisement', 'admin/advertisement')->name('admin.advertisement');
    Route::view('specialization', 'admin/specialization')->name('admin.specialization');


    // report statistics
    Route::view('report-statistics', 'admin/report-statistics')->name('admin.report-statistics');

    // providers
    Route::view('providers', 'admin/providers')->name('admin.provider');

    // rating
    Route::view('rating', 'admin/rating')->name('admin.rating');
    // service request
    Route::view('service-request', 'admin/service-request')->name('admin.service-request');
});


Route::get('/email/verify/{id}/{hash}', function ($id, $hash) {
    $user = User::find($id);

    if (! $user) {
        return view('email-verification.user-not-found');
    }

    if (! hash_equals(sha1($user->getEmailForVerification()), $hash)) {
        return view('email-verification.invalid-link');
    }

    if ($user->hasVerifiedEmail()) {
        return view('email-verification.success');
    }

    $user->markEmailAsVerified();
    return view('email-verification.success');
    
})->middleware(['signed'])->name('verification.verify');

