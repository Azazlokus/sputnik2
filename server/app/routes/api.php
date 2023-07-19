<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Orion\Facades\Orion;

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

Orion::resource('/users', UserController::class);

Route::group(['prefix' => 'users'], function () {
    //Route::post('/', [UserController::class, 'create']);
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/logout', [UserController::class, 'logout']);
    //Route::post('/index', [UserController::class, 'index']);
})->middleware('api');

Route::group(['prefix' => 'notification'], function () {
    Route::get('/', [NotificationController::class, 'index'])->middleware('api');
});
