<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QrcodeController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TimeSheetController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

//ROUTE EMAIL
/* #region verify Email */
Route::get('/email/verify', function () {return view('auth.verify');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');
/* #endregion */
//
Auth::routes();

Route::get('/', function(){
    return redirect('/home');
});
Route::get('/home', [QrcodeController::class, 'index'])->middleware('auth');
/* #region users */
Route::middleware(['auth','roleAdmin'])->group(function () {
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/ajax-paginate', [UserController::class, 'paginate'])->name('ajax.paginate');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::patch('/users/{id}', [UserController::class, 'update'])->name('users.update');

    // ->middleware('qrCode')
    Route::post('/qrcode', [QrcodeController::class, 'store'])->name('qrcode.store');
    Route::get('/timesheet', [TimeSheetController::class, 'index'])->name('timesheet.index');
    Route::get('/salary', [SalaryController::class, 'show'])->name('salary.show');
    Route::patch('/salary/{id}', [SalaryController::class, 'update'])->name('salary.update');
    Route::get('/qrcode', [QrcodeController::class, 'index'])->name('qrcode.index')->middleware('qrCode');
});
/* #endregion */
Route::middleware('auth')->group(function(){
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.index');
    Route::patch('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/salary/{user}', [SalaryController::class, 'showId'])->name('salary.showId');
});