<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostsController;
// use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\Auth\RegisterController;

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

Auth::routes();

// Route::post('token', [LoginController::class, 'getToken']);

Route::post('register', [RegisterController::class, 'register']);

Route::post('login', [LoginController::class, 'store']);

Route::delete('logout', [LoginController::class, 'destroy'])->middleware('auth:api');

Route::middleware(['auth:api'])->group(function () {
    Route::apiResource('categories', CategoriesController::class);
    Route::apiResource('posts', PostsController::class);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

