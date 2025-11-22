<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ArticleController;
use Illuminate\Support\Facades\Route;

// المسارات العامة
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');

// مسارات المصادقة (إذا لم تكوني أضفتها)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/admin', function () {
    return redirect('/admin/dashboard');
});

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/category/{id}', [HomeController::class, 'category'])->name('category.articles');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
Route::post('/articles/{id}/comments', [ArticleController::class, 'storeComment'])->name('articles.comments.store');