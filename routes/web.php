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
// Route::middleware(['XssSanitizer'])->group(function () {});


Auth::routes();

Route::get('/', [PostsController::class, 'article']);

Route::get('/home', [PostsController::class, 'posts_management'])->name('home');

Route::get('home/{id}/publish', [PostsController::class, 'move_to_publish']);

Route::get('home/{id}/draft', [PostsController::class, 'move_to_draft']);

Route::get('home/{id}/trash', [PostsController::class, 'move_to_trash']);

Route::resource('posts', PostsController::class);

Route::resource('categories', CategoriesController::class);


// Route::get('post', [DatatablesController::class, 'view_post_management']);

// Route::post('get-post', [DatatablesController::class, 'get_post_listed']);

// Route::post('get-post-publish', [DatatablesController::class, 'get_post_listed_publish']);

// Route::post('get-post-draft', [DatatablesController::class, 'get_post_listed_draft']);

// Route::post('get-post-trash', [DatatablesController::class, 'get_post_listed_trash']);

// Route::get('post/{id}/publish', [DatatablesController::class, 'move_to_publish']);

// Route::get('post/{id}/draft', [DatatablesController::class, 'move_to_draft']);

// Route::get('post/{id}/trash', [DatatablesController::class, 'move_to_trash']);

// Route::get('/datatable-example', function () {
//     return view('datatables-example');
// });
