<?php

use App\Http\Controllers\myController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/object', [myController::class, 'store']); 

Route::get('/object/get_all_records', [myController::class, 'getAll']);

Route::get('/object/{key}', [myController::class, 'get']);

