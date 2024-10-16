<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserAPIController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('auth:sanctum')->group(function(){
    Route::post('v1/logout', [APIPartner::class, 'logout'])->name('auth.logout');
    Route::post('v1/{slug}/send-form', [APIPartner::class, 'index'])->name('send.form');
});

//Route::post('v1/login', [APIPartner::class, 'login'])->name('auth.login');
Route::post('v1/users', [UserAPIController::class, 'index'])->name('user.index');