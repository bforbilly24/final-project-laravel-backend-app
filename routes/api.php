<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RkksController;
use App\Http\Controllers\Api\XmlController;
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
    Route::post('/logout', [AuthController::class, 'logout']);
    // XML SAVE AS ALIASED COLOUMN CHILDREN
    Route::get('/user', [AuthController::class, 'getUser']);  // Add this line
    // upload for xml file
    Route::post('/upload-xml', [XmlController::class, 'uploadXml']);
    // read xml data from database
    Route::get('/xml-data', [XmlController::class, 'getData']);
});


// login
Route::post('/login', [AuthController::class, 'login']);



// XML SAVE AS PATH
// read xml to json
// Route::get('/xml', [RkksController::class, 'parse']);
// create for xml file
// Route::post('/rkks-create', [RkksController::class, 'store']);
// read xml data from database
// Route::get('/rkks', [RkksController::class, 'index']);
