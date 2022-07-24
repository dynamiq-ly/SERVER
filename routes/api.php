<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\SafetyMeasuresController;
use App\Http\Controllers\Api\ReminderCallController;
use App\Http\Controllers\Api\ActivitiesController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * safety measures api
 */
Route::get('/measures', [SafetyMeasuresController::class, 'index']);
Route::post('/measures', [SafetyMeasuresController::class, 'store']);
Route::get('/measures/{_uid}', [SafetyMeasuresController::class, 'show']);
Route::patch('/measures/{_uid}', [SafetyMeasuresController::class, 'update']);
Route::delete('/measures/{_uid}', [SafetyMeasuresController::class, 'destroy']);

/**
 * reminder call api
 */
Route::get('/reception/reminder', [ReminderCallController::class, 'index']);
Route::post('/reception/reminder', [ReminderCallController::class, 'store']);
Route::get('/reception/reminder/{_uid}', [ReminderCallController::class, 'show']);
Route::patch('/reception/reminder/{_uid}', [ReminderCallController::class, 'update']);
Route::delete('/reception/reminder/{_uid}', [ReminderCallController::class, 'destroy']);

/**
 * activites and excursion call api
 */
Route::get('/activities', [ActivitiesController::class, 'index']);
Route::post('/activities', [ActivitiesController::class, 'store']);
Route::get('/activities/{_uid}', [ActivitiesController::class, 'show']);
Route::patch('/activities/{_uid}', [ActivitiesController::class, 'update']);
Route::delete('/activities/{_uid}', [ActivitiesController::class, 'destroy']);
