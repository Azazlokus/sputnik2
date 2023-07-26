<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RelaxPlaceCategoryController;
use App\Http\Controllers\RoleUserController;
use App\Http\Controllers\UserNotificationController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\RelaxPlaceController;
use App\Http\Controllers\RelaxPlaceImageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPhotoController;
use App\Http\Controllers\UserRecommendationController;
use App\Http\Controllers\UserWishlistController;
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
Orion::resource('/wishlists', UserWishlistController::class);
Orion::resource('/notifications', UserNotificationController::class);
Orion::resource('/ratings', RatingController::class);
Orion::resource('/relax-place-categories', RelaxPlaceCategoryController::class);
Orion::resource('/relax-place-images', RelaxPlaceImageController::class);
Orion::resource('/user-photos', UserPhotoController::class);
Orion::resource('/role-users', RoleUserController::class);
Orion::resource('/user-recommendations', UserRecommendationController::class);

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
})->middleware('api');

