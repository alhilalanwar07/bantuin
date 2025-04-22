<?php

use Illuminate\Support\Facades\{Route, Auth};
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// disable register, reset password
Auth::routes(['register' => false, 'reset' => false]);

// jika ke /, redirect ke /login
Route::redirect('/', '/login');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::view('dashboard', 'dashboard')->name('home');
    Route::view('profil', 'profil')->name('profil');
    Route::view('manajemen-user', 'manajemen-user')->name('admin.manajemen-user');
    Route::view('customer', 'admin/customer')->name('admin.customer');
    Route::view('advertisement', 'admin/advertisement')->name('admin.advertisement');
});

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    // Biasanya redirect ke halaman login / dashboard
    return redirect('/email-verified-success');
})->middleware(['auth', 'signed'])->name('verification.verify');