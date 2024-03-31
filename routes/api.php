<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/xml-data', [RkksController::class, 'parse']);
Route::get('/rkks', [RkksController::class, 'index']);
Route::post('/rkks-create', [RkksController::class, 'store']);