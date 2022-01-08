<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\NewsLetterController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Services\NewsLetter;
use Database\Factories\UserFactory;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Stmt\TryCatch;


Route::post('newsletter', NewsLetterController::class);

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionController::class, 'create'])->middleware('guest');
Route::post('sessions', [SessionController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::post('posts/{post:slug}/comment', [PostCommentsController::class, 'store'])->middleware('auth');


//Admin routes
Route::middleware('can:admin')->group(function () {

    Route::resource('admin/posts', AdminPostController::class)->except('show');

    // Route::get('admin/posts', [AdminPostController::class, 'index']);

    // Route::get('admin/posts/create', [AdminPostController::class, 'create']);
    // Route::post('admin/posts', [AdminPostController::class, 'store']);

    // Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit']);
    // Route::patch('admin/posts/{post}', [AdminPostController::class, 'update']);

    // Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy']);
});

//->whereAlpha('post');
//->where('post', '[A-z_\-]+');
