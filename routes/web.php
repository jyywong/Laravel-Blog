<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\PostDetailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\TopicCreatorController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\PostReplyController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TopicEditorController;
use App\Http\Controllers\TopicDeleteController;
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

require __DIR__.'/auth.php';


Route::get('/boards', [BoardController::class, 'listBoards'])->name('board');

Route::get('/{board}/topics', [TopicController::class, 'listTopics'])->name('topic');

Route::get('/{board}/topics/create', [TopicCreatorController::class, 'index'])->name('createTopic');
Route::post('/{board}/topics/create', [TopicCreatorController::class, 'createTopic']);

Route::get('/{board}/{topic}/edit', [TopicEditorController::class, 'index'])->name('editTopic');
Route::post('/{board}/{topic}/edit', [TopicEditorController::class, 'edit']);

Route::get('/{board}/{topic}/delete', [TopicDeleteController::class, 'index'])->name('deleteTopic');
Route::delete('/{board}/{topic}/delete', [TopicDeleteController::class, 'delete']);

Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::get('/{board}/{topic}/posts', [PostController::class, 'index'])->name('posts');
Route::post('/{board}/{topic}/posts', [PostController::class, 'post']);

Route::get('/{board}/{topic}/{post}/reply', [PostReplyController::class, 'index'])->name('postReply');
Route::post('/{board}/{topic}/{post}/reply', [PostReplyController::class, 'post']);

Route::post('/{board}/{topic}/{post}/like', [PostLikeController::class, 'like'])->name('postLike');

Route::post('/{board}/{topic}/{post}/dislike', [PostLikeController::class, 'dislike'])->name('postDislike');

// Route::get('/posts/{post}', [PostDetailController::class, 'index'])->name('postDetail');