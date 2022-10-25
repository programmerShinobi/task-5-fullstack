<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DatatablesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('posts', PostsController::class);

Route::get('posts/{id}/publish', [PostsController::class, 'move_to_publish']);

Route::get('posts/{id}/draft', [PostsController::class, 'move_to_draft']);

Route::get('posts/{id}/trash', [PostsController::class, 'move_to_trash']);

Route::get('/', [PostsController::class, 'article']);
