<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/index', [PostController::class, 'index'])->middleware(['auth'])->name('index');
Route::get('/create', [PostController::class, 'create'])->middleware(['auth'])->name('create');
Route::post('/store', [PostController::class, 'store'])->middleware(['auth'])->name('store');
Route::get('/show/{id}', [PostController::class, 'show'])->middleware(['auth'])->name('show');
Route::get('/edit/{id}', [PostController::class, 'edit'])->middleware(['auth'])->name('edit');
Route::post('/update/{id}', [PostController::class, 'update'])->middleware(['auth'])->name('update');
Route::post('/destroy/{id}', [PostController::class, 'destroy'])->middleware(['auth'])->name('destroy');

Route::get('/create_comment/{id}', [CommentController::class, 'create'])->middleware(['auth'])->name('create_comment');
Route::post('/store_comment', [CommentController::class, 'store'])->middleware(['auth'])->name('store_comment');
Route::get('/edit_comment/{id}', [CommentController::class, 'edit'])->middleware(['auth'])->name('edit_comment');
Route::post('/update_comment/{id}', [CommentController::class, 'update'])->middleware(['auth'])->name('update_comment');
Route::post('/destroy_comment/{id}', [CommentController::class, 'destroy'])->middleware(['auth'])->name('destroy_comment');

Route::post('/store_like/{post_id}',[LikeController::class,'store'])->name('store_like');
Route::post('/store_destroy/{id}',[LikeController::class,'destroy'])->name('destroy_like');

require __DIR__.'/auth.php';
