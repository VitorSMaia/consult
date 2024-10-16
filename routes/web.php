<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;

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



Route::view('/', 'layouts.guest')->name('/');
Route::get('/generatePDF', [\App\Http\Controllers\PDFController::class, 'generatePDF'])->name('generatePDF');
Route::view('/pdf', 'pdf')->name('pdf');

Route::middleware('guest')->group(function () {
    Route::view('login', 'auth.login')->name('login');
    Route::view('register', 'auth.register')->name('register');
    Route::view('forgot-password', 'auth.forgot-password')->name('password.request');
    Route::get('/reset-password/{token}', function ($token) {
        return view('auth.reset-password', ['token' => $token]);
    })->name('password.reset');

    Route::post('send-contact-form', [GuestController::class, 'sendContactForm'])->name('send.contact.form');
    Route::get('mail', function(){
        return new \App\Mail\SendContact();
    });
});


Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::view('profile', 'auth.profile')->name('profile');
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)->name('logout');

    Route::view('users', 'adm.user.index')->middleware('permission:user_view')->name('admUser');
    Route::view('role', 'adm.role.index')->middleware('permission:role_view')->name('admRole');
    Route::view('meeting-rooms', 'adm.meeting-rooms.index')->middleware('permission:meeting_rooms_view')->name('admMeeting');
});

