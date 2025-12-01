<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('posts.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// 로그인 필요한 라우트들 (글 작성/수정/삭제 + 댓글 작성/수정/삭제)
Route::middleware(['auth'])->group(function () {
    // posts: index, show 빼고 전부
    Route::resource('posts', PostController::class)->except(['index', 'show']);

    // 댓글 생성
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])
        ->name('comments.store');

    // 댓글 수정 폼
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])
        ->name('comments.edit');

    // 댓글 수정 처리
    Route::put('/comments/{comment}', [CommentController::class, 'update'])
        ->name('comments.update');

    // 댓글 삭제
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
        ->name('comments.destroy');
});

// 누구나 볼 수 있는 목록/상세
Route::resource('posts', PostController::class)->only(['index', 'show']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';