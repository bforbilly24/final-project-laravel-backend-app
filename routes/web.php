<?php

use App\Http\Controllers\XmlController;
use Illuminate\Support\Facades\Route;

Route::get('/read-xml', 'App\Http\Controllers\XmlController@readXml');

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


// Route for reading XML data
Route::get('/read-xml', [XmlController::class, 'readXml']);

// Route for displaying XML data in a table
Route::get('/xml-table', [XmlController::class, 'showXmlTable']);

