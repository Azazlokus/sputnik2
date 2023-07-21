<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\RelaxPlaceController;
use App\Http\Controllers\RelaxPlaceImageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
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
Orion::resource('/relax-places', RelaxPlaceController::class);
Orion::resource('/wishlists', WishlistController::class);
Orion::resource('/notifications', NotificationController::class);
Orion::resource('/ratings', RatingController::class);
Orion::resource('/categories', CategoryController::class);
Orion::resource('/relax-place-images', RelaxPlaceImageController::class );
Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
})->middleware('api');

