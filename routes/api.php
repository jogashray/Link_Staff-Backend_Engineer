<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\PersonController;
use App\Http\Controllers\Api\FollowController;
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
Route::prefix('auth')->group(function () {
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('login', [RegisterController::class, 'login']);
});

Route::middleware('auth:api')->group(function () {

    Route::post('page/create', [PageController::class, 'create']);
    Route::post('page/{page_id}/attach-post', [PageController::class, 'attachPost']);

    Route::post('person/attach-post', [PersonController::class, 'attachPost']);
    Route::get('person/feed', [PersonController::class, 'getFeeds']);

    Route::post('follow/person/{persion_id}', [FollowController::class, 'followPerson']);
    Route::post('follow/page/{page_id}', [FollowController::class, 'followPage']);

});


