<?php

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

Route::name('api.')->group(function () {
    Route::post('users/{user}/subscriptions', [\App\Http\Controllers\UserSubscriptionController::class, 'store'])
        ->name('users.subscriptions.store');

    Route::apiResources([
        'websites' => \App\Http\Controllers\WebsiteController::class,
        'websites.posts' => \App\Http\Controllers\WebsitePostController::class,
    ]);
});

