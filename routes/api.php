<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CreditCardController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('/auth/register', 'register');
    Route::post('/auth/login', 'login');
});

Route::controller(TaskController::class)->group(function () {
    Route::post('/tasks/create', 'store');
    Route::patch('/tasks/update/{task}', 'update');
    Route::get('/tasks/latest-finished-tasks/{user_id}', 'latestFinishedTasks');
});

Route::apiResources([
    'merchants' => MerchantController::class,
    'credit-cards' => CreditCardController::class,
]);
