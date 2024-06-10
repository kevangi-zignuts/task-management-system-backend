<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::post('/', [LoginController::class, 'login']);
Route::post('/register', [RegistrationController::class, 'register']);
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/tasks', [TaskController::class, 'index']);