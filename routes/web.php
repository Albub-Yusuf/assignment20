<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::post('user-registration',[UserController::class,'userRegistration']);
Route::post('user-login',[UserController::class,'userLogin']);
Route::post('send-otp',[UserController::class,'sendOtp']);
Route::post('verify-otp',[UserController::class,'verifyOTP']);
// verify token

Route::post('/reset-password',[UserController::class,'ResetPass'])
       ->middleware(TokenVerificationMiddleware::class);

Route::get('/logout',[UserController::class,'logout']);


//page routes
Route::get('/registration',[PageController::class,'registrationPage'])->name('registration.page');
Route::get('/',[PageController::class,'loginPage'])->name('login.page');
Route::get('/forgot-password',[PageController::class,'forgotPasswordPage'])->name('forgot.password.page');
Route::get('/confirm-otp',[PageController::class,'confirmOTPPage'])->name('confirm.otp.page');
Route::get('/password-reset',[PageController::class,'resetPasswordPage'])->name('reset.password.page');   

Route::get('/dashboard',[PageController::class,'dashboard']);

