<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegistrationController;
use App\Http\Controllers\auth\ResetPasswordController;
use App\Http\Controllers\auth\ForgotPasswordController;

Route::post('/', [LoginController::class, 'login']);
Route::post('/register', [RegistrationController::class, 'register']);
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
Route::post('/reset-password/{token}', [ResetPasswordController::class, 'resetPassword']);

// Routes for tasks crud operation
Route::middleware(['auth:sanctum'])->prefix('tasks')->controller(TaskController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/store', 'store');
    Route::post('/update/{id}', 'update');
    Route::get('/view/{id}', 'view');
    Route::get('/delete/{id}', 'delete');
});