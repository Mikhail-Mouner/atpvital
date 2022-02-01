<?php

use App\Http\Controllers\Api\{
    AdsController,
    AuthController,
    CategoryController,
    TagController
};
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

Route::prefix('v1')
    ->name('api.')
    ->group(function () {

        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/register', [AuthController::class, 'register'])->name('register');

        //api Resources routes for {Tag, Category, Ads}
        Route::apiResources([
            'tag' => TagController::class,
            'category' => CategoryController::class,
            'ads' => AdsController::class,
        ]);

        //api routes that User must be Authenticated
        Route::middleware('auth:api')->group(function () {
            Route::get('/me', [AuthController::class, 'me'])->name('me');
            Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        });
    });
