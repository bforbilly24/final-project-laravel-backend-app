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

// Rkks routes
// get xml uploaded in table rkks_xml
// upload xml file from front-end

// Auth routes
// Route::group(
//     ['prefix'],
//     function () {
//         Route::get('/xml-data', [RkksController::class, 'parse']);
//         Route::post('/rkks-create', [RkksController::class, 'store']);
//         Route::get('/rkks', [RkksController::class, 'index']);
//         Route::post('/login', [AuthController::class, 'login']);
//         Route::post('/logout', [AuthController::class, 'logout']);
//     }
// );





Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/xml-data', [RkksController::class, 'parse']);
    Route::post('/rkks-create', [RkksController::class, 'store']);
    Route::get('/rkks', [RkksController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
Route::post('/login', [AuthController::class, 'login']);
