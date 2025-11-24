<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ArticleController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// المسارات العامة
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/category/{id}', [HomeController::class, 'category'])->name('category.articles');

// مسارات المقالات والتعليقات (الواجهة العامة)
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
Route::post('/articles/{id}/comments', [ArticleController::class, 'storeComment'])->name('articles.comments.store');

// مسارات اتصل بنا
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// مسارات المصادقة
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// مسارات لوحة التحكم المحمية
Route::middleware(['auth', 'editor'])->group(function () {
    Route::prefix('admin')->group(function () {
        // لوحة التحكم الرئيسية
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        // إدارة المقالات
        Route::get('/articles', [AdminArticleController::class, 'index'])->name('admin.articles.index');
        Route::get('/articles/create', [AdminArticleController::class, 'create'])->name('admin.articles.create');
        Route::post('/articles', [AdminArticleController::class, 'store'])->name('admin.articles.store');
        Route::get('/articles/{article}', [AdminArticleController::class, 'show'])->name('admin.articles.show');
        Route::get('/articles/{article}/edit', [AdminArticleController::class, 'edit'])->name('admin.articles.edit');
        Route::put('/articles/{article}', [AdminArticleController::class, 'update'])->name('admin.articles.update');
        Route::delete('/articles/{article}', [AdminArticleController::class, 'destroy'])->name('admin.articles.destroy');
        Route::patch('/articles/{article}/toggle-publish', [AdminArticleController::class, 'togglePublish'])->name('admin.articles.toggle-publish');
        Route::patch('/articles/{article}/toggle-comments', [AdminArticleController::class, 'toggleArticleComments'])->name('admin.articles.toggle-comments');

        // إدارة التصنيفات
        Route::get('/categories', [AdminCategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/categories/{category}', [AdminCategoryController::class, 'show'])->name('admin.categories.show');
        Route::get('/categories/{category}/edit', [AdminCategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');

        // إدارة التعليقات
        Route::get('/comments', [AdminCommentController::class, 'index'])->name('admin.comments.index');
        Route::get('/comments/{comment}', [AdminCommentController::class, 'show'])->name('admin.comments.show');
        Route::patch('/comments/{comment}/approve', [AdminCommentController::class, 'approve'])->name('admin.comments.approve');
        Route::patch('/comments/{comment}/disapprove', [AdminCommentController::class, 'disapprove'])->name('admin.comments.disapprove');
        Route::delete('/comments/{comment}', [AdminCommentController::class, 'destroy'])->name('admin.comments.destroy');
        Route::post('/comments/bulk-action', [AdminCommentController::class, 'bulkAction'])->name('admin.comments.bulk-action');

        // إدارة رسائل الاتصال
        Route::get('/contact-messages', [AdminContactMessageController::class, 'index'])->name('admin.contact-messages.index');
        Route::get('/contact-messages/{contactMessage}', [AdminContactMessageController::class, 'show'])->name('admin.contact-messages.show');
        Route::patch('/contact-messages/{contactMessage}/mark-reviewed', [AdminContactMessageController::class, 'markAsReviewed'])->name('admin.contact-messages.mark-reviewed');
        Route::patch('/contact-messages/{contactMessage}/mark-unread', [AdminContactMessageController::class, 'markAsUnread'])->name('admin.contact-messages.mark-unread');
        Route::delete('/contact-messages/{contactMessage}', [AdminContactMessageController::class, 'destroy'])->name('admin.contact-messages.destroy');
        Route::post('/contact-messages/bulk-action', [AdminContactMessageController::class, 'bulkAction'])->name('admin.contact-messages.bulk-action');
    });
});

// مسارات إدارة المستخدمين (للمدير فقط)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
        Route::post('/users', [AdminUserController::class, 'store'])->name('admin.users.store');
        Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('admin.users.show');
        Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
        Route::patch('/users/{user}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('admin.users.toggle-status');
    });
});

// مسار احتياطي
Route::get('/home', function () {
    return redirect('/');
});