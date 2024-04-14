<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RkksController;
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

Route::group(['middleware' => ['auth:api']], function () {
    // read xml to json
    Route::get('/xml-data', [RkksController::class, 'parse']);
    // create for uploaded xml file
    Route::post('/rkks-create', [RkksController::class, 'store']);
    // read xml data from database
    Route::get('/rkks', [RkksController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/login', [AuthController::class, 'login']);
